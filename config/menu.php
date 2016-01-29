<?php

/*
 * 菜单
 */
return [
    ['name'=>'首页', 'icon'=>'fa-desktop','link'=>'home'],
    ['name'=>'用户管理', 'icon'=>'fa-users','link'=>'user.index',
        'sons' => [
            ['name'=>'用户管理', 'link'=>'user.index'],
            ['name'=>'角色管理', 'link'=>'role.index'],
        ],
    ],
//    ['name'=>'系统设置', 'icon'=>'fa-cog','link'=>'#',
//        'sons' => [
//            ['name'=>'基础设置', 'link'=>'/settingBase'],
//            ['name'=>'设置1', 'link'=>'/setting1',
//                'sons' => [
//                    ['name'=>'设置11', 'link'=>'/setting11'],
//                    ['name'=>'设置12', 'link'=>'/setting12'],
//                ],
//            ],
//        ],
//    ],
];
