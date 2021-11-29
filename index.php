<?php
echo (memory_get_usage() / (10 ** 6)) . '/mb' . PHP_EOL;

require_once 'vendor/autoload.php';

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZjFhZDk5MjY5MDBiNGJkYWIzOGI4ODcyNDJhYzc5YjJjMGQ4NGIyYTFkZWZlZTg1ZWMwY2QyMzNkMzE2MTBmYzNhYjlhMDYwZTg1YmY0NzYiLCJpYXQiOjE2MzgxNzExMzIsIm5iZiI6MTYzODE3MTEzMiwiZXhwIjoxNjM5NDY3MTMyLCJzdWIiOiI5MCIsInNjb3BlcyI6W119.cjTva9l1ScEbQJMCvxu7wQbF_KMoQjcLqtX7rkm5JZqk-Km4myAQA5Ma1S-YTDH4EhJ9vSgZKTAoqhGRMrx7fjVe5d8jAJ_T_4feJq2CadvNtrqyI6HxwSCu0wjOlmsjYn34VfGr3Tp926BvFJD0mjtw4b5aXKxk-JuTog8CE4FbYFReh4rJYvRbcE7xb-LhKetSWRf3VzVRlsGI85tSt3CCF7VJ_3ilbKrgeAei2u0_bQ45VJE4y_25YmM8jQGm5x05C2XdNWugLrn1wwWyNhdTRYOXeAd2FPMpED72NJXwDjadneIlHNPu8cB8HG9Sv-IrKlQTXtSxfDUCJJ9Z1ItQfdYMXzOO2GtuIweP2X6nhoOzeFOycgdIa9rWmIeSD5gRnpAjHk1Dq0pcfxffw5lsiHDkeEXZOKu6OimM_N8pf8qDjMYME0N2YfJY8myisp8YrpiWzU3_r50As2rr6JJSgseqATil-nvLoWEs1DA8R6RD4zW33LWNIPNf2w4epRqi6xTfEkQTRmCAswV_bvSpI2NIU3ogGBg2f4X2jzOrl8BSp0Ujfg9ZqS83xIDeOzS6IJMFhNn8BcYzCpWgqmsVUEzijjmNB9vWxUgfSCoGTidEsEBMtl255QVBtHpRROce0Dzlpz3sLiHLB61E50IipFFi-cLqKiXrCnBTli8';
$refreshToken = 'def50200710b57051bab48599726eb1973492915bc877c4f831d740f17a943e6a931618e4a86641ced9f869a39a7fa48d035de7d01fa15df7d2a54b02d5151f15e8e0d0432bd1781b966b920dc6be2160ca9c8ee1ecad5ade6b923fa505b244535d7235be300fa7d940f01c02a5b9bbaa9baf69658b8199cd86856713539a1b557d8b4e182faf319f4757840feda5f11544cffd0cd21390c84ca83a68cbee45a5883abadbeae518540415962432fe6cf4e5608d6421c70222fb807a816c5da92cf072a6266cab620680635d85383cfa4ad3a48e1588ff5caa57a20776550a855709016cf3f75a230035fb56a7ac2b73bec0b5e8d66794512abd5f482c92c12cd2c821d1cafba371406f7fce451794af38c16df40eca230b0ddd2d63045a788fd950f1241192682dc0e9a3648549e9c49435cddb1031b9284608fc2a713096fc920af6327fed2b5b8331038b7c461a6236a24704bc828ebc0022d3447d17ab80757c5';
$brendfoni = new \ConnectProf\App\Model\Brendfoni\Brendfoni('connectprof-api-jQ9yWBb6Eo', 'qlwImMWpGXQL6zTif3opiwIydKtUy4Etf3hcqLg1', $token, $refreshToken, 129600);
//$brendfoni = new \ConnectProf\App\Model\Brendfoni\Brendfoni('connectprof-api-jQ9yWBb6Eo', 'qlwImMWpGXQL6zTif3opiwIydKtUy4Etf3hcqLg1');
//print_r($brendfoni->getAuthInformation()); die;

//print_r($brendfoni->product->getAllCategories()); die;
//print_r($brendfoni->product->getAllVariants());
//print_r($brendfoni->product->getAllProducts());
//print_r($brendfoni->product->getAllPromotions());
//print_r($brendfoni->product->getAllFeatures());
//print_r($brendfoni->order->getAllOrderStatus());
//print_r($brendfoni->order->getAllCargoCompany());
//print_r($brendfoni->order->getOrders([
//    'page' => 1
//]));

$brendfoni->product->createSingleProductModel(
    'Connectprof Deneme Ürün',
    10.90,
    9.90,
    'Connectprof Deneme Ürün Kısa Açıklama',
    'Connectprof Deneme Ürün Genel Açıklama',
    'family-sdcd',
    [407], // Category ID
    ['https://www.connectprof.com/image/referanslar/ref03.png']
)->addCombination(
    10,
    'CP-002',
    'CP001X002',
    199.90,
    true,
    null,
    null,
    null,
    null,
    [ // Combination Variant
        [
            'feature_id' => 3,
            'variant_id' => 616,
        ]
    ]
)->addCommonVariants(
    1,
    655
)->addCommonVariants(
    5,
    655
);

$a = $brendfoni->product->createProduct(true);
print_r($a);
echo (memory_get_usage() / (10 ** 6)) . '/mb' . PHP_EOL;