<?php
namespace Msdev2\Shopify;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Msdev2\Shopify\Http\Middleware\EnsureShopifyInstalled;
use Msdev2\Shopify\Http\Middleware\VerifyShopify;
use Msdev2\Shopify\Http\Middleware\EnsureShopifySession;
use Msdev2\Shopify\Lib\DbSessionStorage;
use Shopify\ApiVersion;
use Shopify\Context;

class ShopifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views/','msdev2');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        // $this->loadModelsFrom(__DIR__.'/Models');
        $this->mergeConfigFrom(__DIR__.'/config/msdev2.php','msdev2');
        $this->publishes([__DIR__.'/config/msdev2.php'=>config_path("msdev2.php")]);
        //    $this->loadTranslationsFrom(__DIR__.'/../lang', 'courier');
        $this->app['router']->aliasMiddleware('msdev2.shopify.verify', VerifyShopify::class);
        $this->app['router']->aliasMiddleware('msdev2.shopify.auth', EnsureShopifySession::class);
        $this->app['router']->aliasMiddleware('msdev2.shopify.installed', EnsureShopifyInstalled::class);

        $host = str_replace('https://', '', env('APP_URL', 'not_defined'));

        $customDomain = env('SHOP_CUSTOM_DOMAIN', null);
        Context::initialize(
            env('SHOPIFY_API_KEY', 'not_defined'),
            env('SHOPIFY_API_SECRET', 'not_defined'),
            env('SHOPIFY_API_SCOPES', 'not_defined'),
            $host,
            new DbSessionStorage(),
            ApiVersion::LATEST,
            true,
            false,
            null,
            '',
            null,
            (array)$customDomain,
        );

        URL::forceRootUrl("https://$host");
        URL::forceScheme('https');
    }
    public function register()
    {
        //code here to register
    }
}
