<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * 关联角色
     */
    public function roles()
    {
        return $this->belongsToMany(Role,'roles_permissions');
    }
}
