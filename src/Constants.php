<?php

namespace ConnectProf\App\Model\Brendfoni;

/**
 * Brendfoni Interface Constants
 * @package ConnectProf\App\Model\Brendfoni
 * @author Halit DOĞAN <halit.dogan@tsoft.com.tr>
 */
interface Constants
{
    /**
     * Application Debug
     */
    const DEBUG = false;

    /**
     * Brendfoni API Endpoints
     */
    const ENDPOINTS = [
        'base' => 'https://brendfoni.com.tr/api/v1',
        'auth' => [
            'login' => [
                'method' => 'POST',
                'uri' => '/login'
            ]
        ],
        'product' => [
            'get' => [
                'method' => 'GET',
                'uri' => '/products'
            ],
            'create' => [
                'method' => 'POST',
                'uri' => '/products'
            ],
            'update' => [
                'quick' => [
                    'method' => 'POST',
                    'uri' => '/products/quick-update'
                ],
                'normal' => [
                    'method' => 'PUT',
                    'uri' => '/products'
                ]
            ],
            'allVariants' => [
                'method' => 'GET',
                'uri' => '/variants'
            ],
            'allCategories' => [
                'method' => 'GET',
                'uri' => '/categories'
            ],
            'allPromotions' => [
                'method' => 'GET',
                'uri' => '/promotions'
            ],
            'allFeatures' => [
                'method' => 'GET',
                'uri' => '/features'
            ]
        ],
        'order' => [
            'get' => [
                'method' => 'GET',
                'uri' => '/order/list'
            ],
            'confirmQuantity' => [
                'method' => 'POST',
                'uri' => '/order/confirm-quantity'
            ],
            'completeOrder' => [
                'method' => 'POST',
                'uri' => '/order/complete-order'
            ],
            'addShippingDetail' => [
                'method' => 'POST',
                'uri' => '/order/add-shipping-details'
            ],
            'shipped' => [
                'method' => 'POST',
                'uri' => '/order/shipped'
            ],
            'allOrderStatus' => [
                'method' => 'GET',
                'uri' => '/statuses'
            ],
            'allCargoCompany' => [
                'method' => 'GET',
                'uri' => '/cargos'
            ]
        ]
    ];
}