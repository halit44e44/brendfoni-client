<?php

namespace ConnectProf\App\Model\Brendfoni;

use ConnectProf\App\Model\Brendfoni\Features\Auth;
use ConnectProf\App\Model\Brendfoni\Features\Order;
use ConnectProf\App\Model\Brendfoni\Features\Product\Product;
use ConnectProf\App\Model\Brendfoni\Http\Request;

/**
 * Class Brendfoni
 * @package ConnectProf\App\Model\Brendfoni
 * @author Halit DOĞAN <halit.dogan@tsoft.com.tr>
 */
class Brendfoni implements Constants
{
    /**
     * Brendfoni Auth Information
     * @var array $information
     */
    protected $information = [
        'loginRequired' => true,
        'username' => '',
        'password' => '',
        'token' => '',
        'refreshToken' => '',
        'expiresIn' => ''
    ];

    /**
     * Brendfoni Product Feature
     * @var Product $product
     */
    public $product;

    /**
     * Brendfoni Order Feature
     * @var Order $order
     */
    public $order;

    /**
     * Brendfoni constructor.
     * @param string $username
     * @param string $password
     * @param string $token
     * @param string $refreshToken
     * @param null|integer $expireIn
     */
    public function __construct(string $username = '', string $password = '', string $token = '', string $refreshToken = '', int $expireIn = 0)
    {
        /**
         * Set the information
         */
        $this->setInformation($username, $password, $token, $refreshToken, $expireIn);

        /**
         * Login Required Check!
         */
        if ($this->information['loginRequired']) {
            $this->login();
            // TODO :: MongoDB Token Güncellemesini Yap
        }

        /**
         * Features Loaded
         */
        $this->product = new Product($this->information);
        $this->order = new Order($this->information);
    }

    /**
     * Brendfoni destructor
     */
    public function __destruct()
    {
        unset($this->order);
        unset($this->product);
    }

    /**
     * Brendfoni Auth Information
     * @return array
     */
    public function getAuthInformation(): array
    {
        return $this->information;
    }

    /**
     * Brendfoni Client Set Auth Data
     * @param string $username
     * @param string $password
     * @param string $token
     * @param string $refreshToken
     * @param int $expireIn
     */
    private function setInformation(string $username, string $password, string $token, string $refreshToken, int $expireIn)
    {
        $this->information['username'] = $username;
        $this->information['password'] = $password;

        /**
         * Token field check
         */
        if (!empty($token) && !empty($refreshToken)) {
            $this->information['loginRequired'] = false;
            $this->information['token'] = $token;
            $this->information['refreshToken'] = $refreshToken;
            $this->information['expiresIn'] = $expireIn;
        }

    }

    /**
     * Brendfoni login and token update
     */
    protected function login()
    {
        $request = new Request();
        $response = $request->send(self::ENDPOINTS['auth']['login']['method'], self::ENDPOINTS['base'] . self::ENDPOINTS['auth']['login']['uri'], [
            'form_data' => [
                'username' => $this->information['username'],
                'password' => $this->information['password']
            ]
        ]);

        $this->information['loginRequired'] = false;
        $this->information['token'] = $response->getObject()->access_token;
        $this->information['refreshToken'] = $response->getObject()->refresh_token;
        $this->information['expiresIn'] = $response->getObject()->expires_in;
    }

    protected function refreshToken()
    {
        //
    }

}