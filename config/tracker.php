<?php

return [
    'clockify' => [
        'api' => [
            'key' => env('CLOCKIFY_API_KEY', null),
        ],
        'test' => [
            'workspace' => [
                'id' => env('CLOCKIFY_TEST_WORKSPACE_ID', null),
            ],
            'user' => [
                'id' => env('CLOCKIFY_TEST_USER_ID', null),
            ],
        ],
    ],
];
