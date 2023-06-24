<?php
return [
    "shopify_api_key"=>env('SHOPIFY_API_KEY', '63f2fa001dd7228268d7c5f920f9b28b'),
    "shopify_api_secret"=>env('SHOPIFY_API_SECRET', '47f72686a3950d8f9bf307f5eea1f071'),
    "scopes"=>env('SHOPIFY_API_SCOPES', 'read_products,write_products'),
    "webhooks"=>env('SHOPIFY_WEBHOOKS', 'APP_UNINSTALLED,THEMES_PUBLISH,SHOP_UPDATE'),
    "billing" => [
        "required" => env('SHOPIFY_BILLING', false),

        // Example set of values to create a charge for $5 one time
        "chargeName" => "My Shopify App Billing",
        "amount" => 5.0,
        "currencyCode" => "USD", // Currently only supports USD
        "interval" => 'EVERY_30_DAYS', //ANNUAL|EVERY_30_DAYS|INTERVAL_ONE_TIME
    ],
    'appbridge_enabled' => (bool) env('APPBRIDGE_ENABLED', true),
    "appbridge_version"=>env('APPBRIDGE_VERSION', '3'),
    "footer"=>env('SHOPIFY_FOOTER', '<p>Copyright &copy; All right reserved.</p>'),
    "menu"=>[
        'logo'=>[
            'type'=>'url',//image,url,
            'value'=>'https://cdn-icons-png.flaticon.com/512/7190/7190597.png'
        ],
        'list'=>[
            [
                'label'=> 'Dashboard',
                'destination'=> 'home',
                'position'=>'topbar',//sidebar,topbar*,all,
                'type'=>'web' //vue,web*,laravel
            ],
            [
                'label'=> 'Setting',
                'destination'=> 'setting',
                'type'=>'web' //vue,web*,laravel
            ]
        ]
    ]
];
