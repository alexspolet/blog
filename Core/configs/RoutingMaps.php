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
        '/article' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'articleAction'
            ],
        '/add' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'addAction'
            ],
        '/edit' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'editAction'
            ],
        '/delete' =>
            [
                'controller' => 'Controllers\ArticleController',
                'action' => 'deleteAction'
            ],
        '/auth' =>
            [
                'controller' =>'Controllers\UserController',
                'action' => 'authAction'
            ],

        '/account' =>
            [
                'controller' =>'Controllers\UserController',
                'action' => 'accountAction'
            ]
    ];