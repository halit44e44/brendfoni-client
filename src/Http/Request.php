<?php

namespace ConnectProf\App\Model\Brendfoni\Http;

use ConnectProf\App\Model\Brendfoni\Constants;

/**
 * Class Request
 * @package ConnectProf\App\Model\Brendfoni\Http
 * @author Polat Abdulkadir <abdulkadir.polat@tsoft.com.tr>
 */
class Request
{
    /**
     * POST Request Body Raw
     * @var bool $raw
     */
    private $raw = false;

    /**
     * POST Requst Single
     * @var bool $single
     */
    private $single = false;

    /**
     * @var bool $CURLOPT_POST
     */
    private $CURLOPT_POST = false;

    /**
     * @var bool $CURLOPT_PUT
     */
    private $CURLOPT_PUT = false;

    /**
     * @var array $CURLOPT_POSTFIELDS
     */
    private $CURLOPT_POSTFIELDS = [];

    /**
     * @var array $CURLOPT_HTTPHEADER
     */
    private $CURLOPT_HTTPHEADER = [
        'Accept: application/json'
    ];

    /**
     * @var string $QUERY_PARAMS
     */
    private $QUERY_PARAMS;

    /**
     * cURL Request Options
     * @var array $options
     */
    private $options = [];

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return Response
     */
    public function send(string $method, string $uri, array $options = []): Response
    {
        switch ($method) {
            case 'POST':
                $this->CURLOPT_POST = true;
                break;
            case 'PUT':
                $this->CURLOPT_PUT = true;
                break;
        }

        if (!empty($options)) {
            /**
             * FormData Check
             */
            if (isset($options['form_data'])) {
                $this->CURLOPT_POSTFIELDS = $options['form_data'];
            }

            /**
             * Query Params Check
             */
            if (isset($options['query_params'])) {
                $this->QUERY_PARAMS = http_build_query($options['query_params']);
            }

            /**
             * Header Check
             */
            if (isset($options['header'])) {
                foreach ($options['header'] as $option) {
                    array_push($this->CURLOPT_HTTPHEADER, $option);
                }
            }

            /**
             * Raw Body Check
             */
            if (isset($options['raw'])) {
                $this->raw = $options['raw'];
            }

            /**
             * Single Post Data Check
             */
            if (isset($options['single'])) {
                $this->single = $options['single'];
            }
        }


        return $this->cURL($method, $uri);
    }

    /**
     * @return array|string[]
     */
    public function getHeader(): array
    {
        return $this->CURLOPT_HTTPHEADER;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param $method
     * @param $uri
     * @return Response
     */
    private function cURL($method, $uri): Response
    {
        $ct = curl_init();

        $this->options = [
            CURLOPT_HEADER => Constants::DEBUG,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => 'Connectprof Brendfoni Client',
            CURLOPT_ENCODING => '',
            CURLOPT_VERBOSE => Constants::DEBUG,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $this->CURLOPT_HTTPHEADER,
        ];

        /**
         * Post Request Check
         */
        if ($this->CURLOPT_POST || $this->CURLOPT_PUT) {
            $this->options[CURLOPT_POST] = $this->CURLOPT_POST;
            if ($this->raw) {
                $this->options[CURLOPT_HTTPHEADER][] = 'Content-type: application/json';
                if ($this->single) {
                    $this->options[CURLOPT_POSTFIELDS] = json_encode($this->CURLOPT_POSTFIELDS[0]);
                } else {
                    $this->options[CURLOPT_POSTFIELDS] = json_encode($this->CURLOPT_POSTFIELDS);
                }
            } else {
                if ($this->single) {
                    $this->options[CURLOPT_POSTFIELDS] = $this->CURLOPT_POSTFIELDS[0];
                } else {
                    $this->options[CURLOPT_POSTFIELDS] = $this->CURLOPT_POSTFIELDS;
                }
            }
        }

        /**
         * Query Params
         */
        if (!empty($this->QUERY_PARAMS)) {
            $this->options[CURLOPT_URL] = $uri . $this->QUERY_PARAMS;
        } else {
            $this->options[CURLOPT_URL] = $uri;
        }

//        /**
//         * PUT Request Modify
//         */
//        if ($this->CURLOPT_PUT) {
//            $this->options[CURLOPT_PUT] = $this->CURLOPT_PUT;
//        }

//        print_r($this->options); die;
        curl_setopt_array($ct, $this->options);
        return new Response($ct);
    }
}