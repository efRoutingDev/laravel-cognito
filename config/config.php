<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AWS configuration
    |--------------------------------------------------------------------------
    */
    'aws_access_key'    => env('AWS_ACCESS_KEY_ID'),
    'aws_secret_key'    => env('AWS_SECRET_ACCESS_KEY'),


    /*
    |--------------------------------------------------------------------------
    | Cognito configuration
    |--------------------------------------------------------------------------
    */
    'app_client_id'     => env('AWS_COGNITO_CLIENT_ID'),
    'app_client_secret' => env('AWS_COGNITO_CLIENT_SECRET'),
    'user_pool_id'      => env('AWS_COGNITO_USER_POOL_ID'),
    'region'            => env('AWS_COGNITO_REGION', 'us-east-1'),
    'version'           => env('AWS_COGNITO_VERSION', 'latest'),

    /*
    |--------------------------------------------------------------------------
    | Key configuration
    |--------------------------------------------------------------------------
    */
    'jwt_key_path'     => env('JWT_KEY_PATH'),
];