<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sandbox
    |--------------------------------------------------------------------------
    |
    | Checa se utilizará o Sandbox ou Production.
    |
    */
    'sandbox' => env('PAGSEGURO_SANDBOX', false),

    /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    |
    | Conta de email do Vendedor.
    |
    */
    'email' => env('PAGSEGURO_EMAIL', 'youremail@gmail.com'),

    /*
    |--------------------------------------------------------------------------
    | Token
    |--------------------------------------------------------------------------
    |
    | Token do Vendedor.
    |
    */
    'token' => env('PAGSEGURO_TOKEN', 'token do pagSeguro'),

    /*
    |--------------------------------------------------------------------------
    | NotificationURL
    |--------------------------------------------------------------------------
    |
    | URL de resposta para notificações do Pagseguro.
    |
    */
    'notificationURL' => env('PAGSEGURO_NOTIFICATION', 'rota para notificações'),

];
