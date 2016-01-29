<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    private function my_query(Request $request, array $fields)
    {
        $query = Role::query();
        foreach ($fields as $field) {
            if ($request->has($field)) {
                if( $field == 'id' || $field == 'status' ){
                    $query->where( $field, '=', trim($request->$field) );
                }else{
                    $query->where($field, 'like', '%'.trim($request->$field).'%');
                }
            }
        }
        return $query->orderBy('id', 'desc');
    }
    private function my_search_values(Request $request, array $fields)
    {
        $values = array();
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $values[$field] = $request->$field;
            }
        }
        return $values;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->my_query($request, ['id', 'name', 'description', 'status'])->paginate($request->get('paginate', 25));//echo '<pre>';print_r($users);exit;
        $roles->appends($request->except(['page']));
        $search_values = $this->my_search_values($request, ['id', 'name', 'description', 'status']);
        return view('role.index',compact('roles', 'search_values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('role.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:64|unique:roles',
            'description'=>'required|max:100',
            'status' => 'required',
        ]);

        //Role::create($request->only(['name','description','status']));
        $role = new Role;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->status = $request->status;
        $role->save();
        $this->alert('创建角色成功');
        return redirect(route('role.index'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|max:64',
            'description'=>'required|max:100',
            'status' => 'required',
        ]);

        $role->name = $request->name;
        $role->description = $request->description;
        $role->status = $request->status;
        $role->save();

        $this->alert('更新角色信息成功');

        return redirect(route('role.show',$role->id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        Role::destroy($id);
        if($request->isXmlHttpRequest()) {
            return 'ok';
        } else {
            $this->alert('删除成功');
            return redirect(route('role.index'));
        }
    }
    /**
     * 权限
     *
     * @param  int  $id
     * @return Response
     */
    public function editPermission($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy('group');
        return view('role.editPermission',compact('role','permissions'));
    }
    /**
     * 权限保存
     *
     * @param  int  $id
     * @return Response
     */
    public function storePermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->get('permissions',[]));

        $this->alert('配置权限成功');

        return redirect(route('role.editPermission',$role->id));
    }
}