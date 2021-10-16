<?php

// config for cleverly/backend
return [

    'user_class' => \App\Models\User::class,

    'database' => [
        'table_names' => [
            'user' => 'users',
            'page' => 'pages',
            'blog_post' => 'blog_posts',
            'meta_tag' => 'meta_tags',
            'festival_day' => 'festival_days',
            'festival_day_stage' => 'festival_day_stage',
            'festival_day_performer' => 'festival_day_performer',
            'festival_stage' => 'festival_stages',
            'festival_stage_performer' => 'festival_stage_performer',
            'festival_performer' => 'festival_performers',
            'file' => 'files',
        ],
    ],
];
