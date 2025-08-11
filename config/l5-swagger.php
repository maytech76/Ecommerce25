<?php

return [
    'default' => 'default',

    'documentations' => [
        'default' => [
            'api' => [
                'title' => 'MAYDEV API',
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

            // ===== CAMBIO PRINCIPAL: Agregar 'servers' para usar APP_URL =====
            'servers' => [
                [
                    'url' => env('APP_URL') . '/api', // **** Usa APP_URL del .env ****
                    'description' => 'Servidor principal',
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
            // ===== CAMBIO OPCIONAL: Eliminar L5_SWAGGER_CONST_HOST si ya usas APP_URL =====
            'L5_SWAGGER_CONST_HOST' => env('APP_URL'), // Opcional: reemplazar por APP_URL
        ],

        'securityDefinitions' => [
            'securitySchemes' => [],
            'security' => [],
        ],

        'securityDefinitions' => [
            'securitySchemes' => [], // Vacío porque este endpoint no requiere autenticación
            'security' => []
        ]
    ],
];