<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('/bgsource', 'CustomController@bgsource');
    $router->resource('product', ProductController::class);
    $router->resource('banner', BannerController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('bulletin', BulletinController::class);
    $router->resource('advertising', AdvertisingController::class);
    $router->resource('custom', CustomController::class);
    $router->resource('users', UsersController::class);
    $router->resource('share', ShareController::class);

    $router->resource('order', OrderController::class);

    $router->resource('extract', ExtractController::class);
    $router->resource('moneylog', MoneylogController::class);
    $router->resource('distribution_setting', DistributionSettingController::class);
    $router->resource('collision_setting', CollisionSettingController::class);
    $router->resource('sendlog', SendLogController::class);
    $router->resource('incomelog', IncomeLogsController::class);
    $router->get('api/getchina/{type}/{id}', 'OrderController@getchina');
});
