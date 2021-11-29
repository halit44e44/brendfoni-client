<?php

namespace ConnectProf\App\Model\Brendfoni\Http;

/**
 * Class Response
 * @package ConnectProf\App\Model\Brendfoni\Http
 * @author Polat Abdulkadir <abdulkadir.polat@tsoft.com.tr>
 */
class Response
{
    /**
     * @var $curlInstance
     */
    private $curlInstance;

    /**
     * @var $response
     */
    private $response;

    /**
     * Response constructor.
     * @param $curlInstance
     */
    public function __construct($curlInstance)
    {
        $this->curlInstance = $curlInstance;
        $this->response = $this->getCurlResponse($curlInstance);
    }

    /**
     * Response destructor.
     */
    public function __destruct()
    {
        curl_close($this->curlInstance);
    }

    /**
     * @return mixed
     */
    public function getArray(): array
    {
        return json_decode($this->response, true);
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return json_decode($this->response);
    }

    /**
     * @return mixed
     */
    public function getOriginal(): string
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getInfo(): array
    {
        return curl_getinfo($this->curlInstance);
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        $headers = [];
        $header_text = substr($this->response, 0, strpos($this->response, "\r\n\r\n"));
        foreach (explode("\r\n", $header_text) as $i => $line) {
            if ($i === 0) {
                $headers['http_code'] = $line;
            } else {
                [$key, $value] = explode(': ', $line);
                $headers[$key] = $value;
            }
        }
        return $headers;
    }

    /**
     * @param $curlInstance
     * @return string
     */
    private function getCurlResponse($curlInstance): string
    {
        return curl_exec($curlInstance);
    }

}