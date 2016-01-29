<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * 关联用户
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
    /**
     * 关联权限
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission','roles_permissions');
    }
    /**
     * 是否有权限权限
     */
    public function hasPermission($permission_id)
    {
        return $this->permissions->contains(function($key, $value) use ($permission_id) {
            return  $value->id == $permission_id;
        });
    }
}
