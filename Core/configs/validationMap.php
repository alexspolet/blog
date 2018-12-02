<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 02.12.18
 * Time: 15:42
 */

return
    [
        'login_form' =>
            [
                'fields' =>
                    [
                        'login', 'pass'
                    ],
                'rules' =>
                    [
                        'not_empty' =>
                            [
                                'login', 'pass'
                            ],
                        'minlength' =>
                            [
                                'login' => 4,
                                'pass' => 6
                            ],
                        'maxlength' =>
                            [
                                'login' => 20,
                                'pass' => 20
                            ]
                    ],
            ]
    ];