<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 30.11.18
 * Time: 16:13
 */

return
    ['/' =>
        [
            'controller' => 'Controllers\ArticleController',
            'action' => 'indexAction'
        ],
        '/article/int' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'articleAction',
                'params' =>
                    [
                      'int' => 'id'
                    ]
            ],
        '/add' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'addAction'
            ],
        '/edit/int' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'editAction',
                'params' =>
                    [
                        'int' => 'id'
                    ]
            ],
        '/delete/int' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'deleteAction',
                'params' =>
                    [
                        'int' => 'id'
                    ]
            ],
        '/auth' =>
            [
                'controller' => 'Controllers\UserController',
                'action' => 'authAction'
            ],
        '/admin' =>
            [
                'controller' => 'Controllers\AdminController',
                'action' => 'AdminAction'
            ],
        '/admin/addRole' =>
            [
                'controller' => 'Controllers\AdminController',
                'action' => 'addRoleAction'
            ],

        '/account' =>
            [
                'controller' => 'Controllers\UserController',
                'action' => 'accountAction'
            ]
    ];