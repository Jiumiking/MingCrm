<?php

use Illuminate\Database\Seeder;
use Illuminate\Routing\Router;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    protected  $router;
    protected  $routes;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->routes = $router->getRoutes();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->routes as $route) {
            if(array_search('permission',$route->middleware()) !== false){
                if(!empty($route->getName())) {
                    $params = explode('.',$route->getName());
                    $data = ['name'=>$route->getName()];
                    if (count($params)>1) {
                        $data['group'] = $params[0];
                    } else {
                        $data['group'] = 'base';
                    }
                    if(!Permission::where('name',$data['name'])->exists()) {
                        Permission::create($data);
                    }
                }
            };
        }
    }
}
