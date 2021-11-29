<?php

namespace ConnectProf\App\Model\Brendfoni\Features\Product;

use ConnectProf\App\Model\Brendfoni\Constants;
use ConnectProf\App\Model\Brendfoni\Features\Auth;
use ConnectProf\App\Model\Brendfoni\Http\Request;
use stdClass;

/**
 * Class Product
 * @package ConnectProf\App\Model\Brendfoni\Features\Product
 * @author Halit DOĞAN <halit.dogan@tsoft.com.tr>
 */
class Product extends ProductFactory
{

    /**
     * Product constructor.
     * @param array $information
     */
    public function __construct(array $information)
    {
        $this->request = $request = new Request();
        $this->information = $information;
    }

    /**
     * Brendfoni Create Product
     * @param bool $single
     * @return array
     */
    public function createProduct(bool $single = false): array
    {
        $response = $this->request->send(Constants::ENDPOINTS['product']['create']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['product']['create']['uri'], [
            'single' => $single,
            'raw' => true,
            'form_data' => $this->getProductModel(),
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ]);

        return $response->getArray();
    }

    /**
     * @param int $per_page
     * @param int $page
     * @param int $active
     * @return array
     */
    public function getAllProducts(int $per_page = 15, int $page = 0, int $active = 1): array
    {
        $response = $this->request->send(Constants::ENDPOINTS['product']['get']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['product']['get']['uri'], [
            'query_params' => [
                'per_page' => $per_page,
                'page' => $page,
                'active' => $active
            ],
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ]);

        return $response->getArray();
    }

    /**
     * Brendfoni All Categories
     * @return array
     */
    public function getAllCategories(): array
    {
        $response = $this->request->send(Constants::ENDPOINTS['product']['allCategories']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['product']['allCategories']['uri'], [
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ]);

        return $response->getArray();
    }

    /**
     * Brendfoni All Variants
     * @param int|null $feature_id
     * @return array|mixed
     */
    public function getAllVariants(int $feature_id = null)
    {
        $response = $this->request->send(Constants::ENDPOINTS['product']['allVariants']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['product']['allVariants']['uri'], [
            'query_params' => [
                'feature_id' => $feature_id
            ],
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ]);

        return $response->getArray();
    }

    /**
     * Brendfoni All Promotions
     * @return array|mixed
     */
    public function getAllPromotions()
    {
        $response = $this->request->send(Constants::ENDPOINTS['product']['allPromotions']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['product']['allPromotions']['uri'], [
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ]);

        return $response->getArray();
    }

    /**
     * Brendfoni All Promotions
     * @return array|mixed
     */
    public function getAllFeatures()
    {
        $response = $this->request->send(Constants::ENDPOINTS['product']['allFeatures']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['product']['allFeatures']['uri'], [
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ]);

        return $response->getArray();
    }
}