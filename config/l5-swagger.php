<?php

return [
    'default' => 'default',

    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'Music API',
                'description' => 'API REST Ecomerce',
                'version' => '1.0.0',
                'termsOfService' => '',
                'contact' => [
                    'email' => 'soport@maydev.tech',
                ],
                'license' => [
                    'name' => 'MIT',
                    'url' => 'https://opensource.org/licenses/MIT',
                ],
            ],

            'routes' => [
                'api' => 'api/documentation', // Ruta para acceder a la documentación
            ],

            'paths' => [
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),
                'annotations' => [
                    base_path('app/Models'),
                    base_path('app/Http/Controllers'),
                ],
            ],
        ],
    ],

    'defaults' => [
        'routes' => [
            'docs' => 'docs',
            'oauth2_callback' => 'api/oauth2-callback',
            'middleware' => [
                'api' => [],
                'asset' => [],
                'docs' => [],
            ],
        ],

        'paths' => [
            'docs' => storage_path('api-docs'),
            'views' => base_path('resources/views/vendor/l5-swagger'),
            'base' => env('L5_SWAGGER_BASE_PATH', null),
            'excludes' => [],
            'docs_json' => 'api-docs.json',
            'docs_yaml' => 'api-docs.yaml',
        ],

        'generate_always' => env('L5_SWAGGER_GENERATE_ALWAYS', false),
        'generate_yaml_copy' => env('L5_SWAGGER_GENERATE_YAML_COPY', false),
        'proxy' => env('L5_SWAGGER_PROXY', null),
        'operations_sort' => env('L5_SWAGGER_OPERATIONS_SORT', null),
        'additional_config_url' => env('L5_SWAGGER_ADDITIONAL_CONFIG_URL', null),
        'validator_url' => env('L5_SWAGGER_VALIDATOR_URL', null),

        'constants' => [
            'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://localhost:8000'),
        ],

        'securityDefinitions' => [
            'securitySchemes' => [],
            'security' => [],
        ],

    ],
];
