<?php

namespace ConnectProf\App\Model\Brendfoni\Features;

use ConnectProf\App\Model\Brendfoni\Constants;
use ConnectProf\App\Model\Brendfoni\Http\Request;

/**
 * Brendfoni Class Order
 * @package ConnectProf\App\Model\Brendfoni\Features
 * @author Halit DOĞAN <halit.dogan@tsoft.com>
 */
class Order
{
    /**
     * Order constructor.
     * @param array $information
     */
    public function __construct(array $information)
    {
        $this->request = new Request();
        $this->information = $information;
    }

    /**
     * Brendfoni Get All Orders
     * @param array $query
     * @return array|mixed
     *
     * @example Available Query Params
     * order_number | optional
     * status_id | optional
     * page | optional
     * per_page | optional
     * from | optional, date filter, format yyyy-mm-dd
     * to | optional, date filter, format yyyy-mm-dd
     */
    public function getOrders(array $query = [])
    {
        /**
         * Request Options
         */
        $options = [
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ];

        /**
         * Query Params Check
         */
        if (!empty($query)) {
            $options['query_params'] = $query;
        }

        $response = $this->request->send(Constants::ENDPOINTS['order']['get']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['order']['get']['uri'], $options);

        return $response->getArray();
    }

    /**
     * Brendfoni Get All Order Statutes
     * @return array|mixed
     */
    public function getAllOrderStatus()
    {
        $response = $this->request->send(Constants::ENDPOINTS['order']['allOrderStatus']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['order']['allOrderStatus']['uri'], [
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ]);

        return $response->getArray();
    }

    /**
     * Brendfoni Get All Cargo Company
     * @return array|mixed
     */
    public function getAllCargoCompany()
    {
        $response = $this->request->send(Constants::ENDPOINTS['order']['allCargoCompany']['method'], Constants::ENDPOINTS['base'] . Constants::ENDPOINTS['order']['allCargoCompany']['uri'], [
            'header' => [
                'Authorization: Bearer ' . $this->information['token']
            ]
        ]);

        return $response->getArray();
    }
}