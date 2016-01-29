<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile','username', 'status'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * 权限缓存
     */
    protected $permissionCache = [];
    /**
     * 密码加密
     */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }
    /**
     * 角色
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    /**
     * 是否具有该route的权限
     * @param $name route name
     */
    public function hasPermission($name)
    {
        if($this->isSuperAdmin())
            return true;

        //使用数组缓存,在一个action中重复判断权限时,能有缓存作用
        if (!isset($this->permissionCache[$name]))
        {
            $this->permissionCache[$name] = Role::find($this->role_id)->permissions->contains(function($key, $value) use ($name) {
                return  $value->name == $name;
            });
        }
        return $this->permissionCache[$name];
    }
    /**
     * 是否是超级管理员
     */
    public function isSuperAdmin()
    {
        if (!isset($this->permissionCache['SuperAdmin']))
        {
            $this->permissionCache['SuperAdmin'] = $this->username == 'ming'?true:false;
        }
        return $this->permissionCache['SuperAdmin'];
    }
}
