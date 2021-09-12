<?php
// config for cleverly/backend
return [

    'user_class' => \App\Models\User::class,

    'database' => [
        'table_names' => [
            'page' => 'pages',
            'blog_post' => 'blog_posts',
            'meta_tag' => 'meta_tags',
            'festival' => 'festivals',
            'performer' => 'performers',
        ]
    ]
];
