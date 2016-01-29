<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private function my_query(Request $request, array $fields)
    {
        $query = User::query();
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
//        $role = User::find(1)->role;
//        echo '<pre>';print_r($role->name);exit;
        $users = $this->my_query($request, ['id', 'username', 'mobile', 'status'])->paginate($request->get('paginate', 25));//echo '<pre>';print_r($users);exit;
        $users->appends($request->except(['page']));
        $search_values = $this->my_search_values($request, ['id', 'username', 'mobile', 'status']);
        return view('user.index',compact('users', 'search_values'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create',compact('roles'));
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
            'name'=>'required|max:64',
            'username'=>'required|max:64|unique:users',
            'mobile'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6',
            'role_id'=>'required',
            'status' => 'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->save();
        $this->alert('创建用户成功');
        return redirect(route('user.index'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('user.edit',compact('user','roles'));
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
        $user = User::findOrFail($id);
        $this->validate($request,[
            'name'=>'required|max:64',
            'username'=>'required|max:64',
            'mobile'=>'required',
            'email'=>'required|email',
            'role_id'=>'required',
            'status' => 'required',
        ]);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->save();
        $this->alert('更新用户信息成功');
        return redirect(route('user.edit',$user->id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        User::destroy($id);
        if($request->isXmlHttpRequest()) {
            return 'ok';
        } else {
            $this->alert('删除成功');
            return redirect(route('user.index'));
        }
    }
    /**
     * 用户名唯一性验证
     */
    public function uniqueUsername(Request $request){
        if( empty($request->username) ){
            echo '用户名不能为空';exit;
        }

        $user = User::where('username',$request->username);
        if( !empty($request->id) ){
            $user = $user->where('id','!=',$request->id);
        }
        $user = $user->first();
        if( !isset($user->id) ){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    /**
     * 手机号唯一性验证
     */
    public function uniqueMobile(Request $request){
        if( empty($request->mobile) ){
            echo '手机号不能为空';exit;
        }
        $user = User::where('mobile',$request->mobile);
        if( !empty($request->id) ){
            $user = $user->where('id','!=',$request->id);
        }
        $user = $user->first();
        if( !isset($user->id) ){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    /**
     * 邮箱唯一性验证
     */
    public function uniqueEmail(Request $request){
        if( empty($request->email) ){
            echo '邮箱不能为空';exit;
        }
        $user = User::where('email',$request->email);
        if( !empty($request->id) ){
            $user = $user->where('id','!=',$request->id);
        }
        $user = $user->first();
        if( !isset($user->id) ){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    /**
     * 修改密码
     */
    public function changePassword($id)
    {
        $user = User::findOrFail($id);
        return view('user.changePassword',compact('user'));
    }
    /**
     * 修改密码保存
     */
    public function storePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);
        $user->password = $request->get('password');
        $user->save();
        $this->alert('修改密码成功');
        return redirect(route('user.index'));
    }
    /**
     * 修改当前用户密码
     */
    public function changePersonalPassword()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('user.changePersonalPassword',compact('user'));
    }
    /**
     * 修改当前用户密码 密码验证
     */
    public function checkPersonalPassword(Request $request){
        if( empty($request->password_old) ){
            echo '密码不能为空';exit;
        }
        if (Auth::attempt(['id' => Auth::user()->id, 'password' => $request->password_old])){
            echo 'true';
        }else{
            echo 'false';
        }
    }
    /**
     * 修改当前用户密码 保存
     */
    public function storePersonalPassword(Request $request)
    {
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->password_old])){
            $user = User::findOrFail(Auth::user()->id);
            $this->validate($request, [
                'password' => 'required|confirmed|min:6'
            ]);
            $user->password = $request->get('password');
            $user->save();
            $this->alert('修改密码成功');
            return redirect(route('user.index'));
        }else{
            return \Redirect::back()->withErrors((['status' => '旧密码错误 请重新输入']));
        }
    }

    public function editPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $stores = Warehouse::with('city')->where('type','store')->get()->groupBy('city_id');
        $active_store_id = $stores->keys()->first();
        $warehouses = Warehouse::with('city')->where('type','warehouse')->get()->groupBy('city_id');
        $active_warehouse_id = $warehouses->keys()->first();
        $cities = City::all()->keyBy('id');
        $roles = Role::where('is_active',1)->get();
        return view('user.editPermissions',compact('user','stores','warehouses','roles','cities','active_store_id','active_warehouse_id'));
    }


    public function storePermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request,
            [
                'store_permission_type' =>'required:int',
                'warehouse_permission_type' =>'required:int',
            ]);

        $user->store_permission_type = $request->get('store_permission_type');

        $user->warehouse_permission_type = $request->get('warehouse_permission_type');

        $user->save();

        $user->roles()->sync($request->get('roles',[]));

        if($request->get('store_permission_type') == 0){
            $warehouses_store = [];
        }
        else{
            $warehouses_store = $request->get('warehouses_store',[]);
        }
        if($request->get('warehouse_permission_type') == 0){
            $warehouses_house = [];
        }
        else{
            $warehouses_house = $request->get('warehouses_house',[]);
        }

        $warehouses = array_merge($warehouses_store, $warehouses_house);
        $user->warehouses()->sync($warehouses);

        $this->alert('修改用户权限成功');

        return redirect(route('user.show',$user->id));
    }
}