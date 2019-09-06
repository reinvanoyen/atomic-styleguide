<?php

return [
    'name' => 'Atomic Styleguide',
    'directory' => base_path('resources/views/components'),
    'types' => [
        [
            'name' => 'Atoms',
            'slug' => 'a',
            'directory' => 'atoms',
        ],
        [
            'name' => 'Molecules',
            'slug' => 'm',
            'directory' => 'molecules',
        ],
        [
            'name' => 'Organisms',
            'slug' => 'o',
            'directory' => 'organisms',
        ],
    ],
    'default_columns' => 1,
    'default_description' => '',
];