<?php

use App\Models\User;

return [
    'tables' => [
        'prefix' => 'blog_',
    ],
    'route' => [
        'prefix' => 'blog',
        'middleware' => ['web'],
    ],
    'user' => [
        'model' => User::class,
        'foreign_key' => 'user_id',
        'columns' => [
            'name' => 'name',
            'slug' => 'slug',
        ],
    ],
    'heading_permalink' => [
        'html_class' => 'scroll-mt-40',
    ],
    'dropdown' => [
        'name' => 'Posts',
    ],
    'crm' => [
        'name' => 'CRM',
        'link' => '#',
    ],
];
