<?php


namespace App\Services;


use App\Interfaces\iCurrency;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;

abstract class CurrencyService implements iCurrency
{

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var array
     */
    protected $currency_codes;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var  Response
     */
    protected $resource;

    /**
     * @var CurrencyCollection
     */
    protected $collection;

    /**
     * @var string
     */
    protected $error;

    /**
     * Service constructor.
     * @param CurrencyCollection $collection
     */
    public function __construct(CurrencyCollection $collection)
    {
        if (is_null($this->client)) {
            $this->client = new Client(['base_uri' => static::BASE_URI]);
        }
        $this->currency_codes = config('currency_codes');
        $this->collection = $collection;
    }

    /**
     * @return CurrencyCollection
     */
    public function getCurrency() : CurrencyCollection
    {
        $content = $this->resource->getBody()->getContents();
        $result = json_decode($content, true);
        return $this->normalizeData($result);
    }

    /**
     * @return bool
     */
    public function isResourceAvailable() : bool
    {
        if ($this->setResourceInstance()) {
            return $this->resource->getStatusCode() == 200;
        }
        return false;
    }

    /**
     * @return string
     */
    public function getResourceName() : string
    {
        return static::SOURCE_NAME;
    }

    /**
     * @return string|null
     */
    public function getResourceError() : ? string
    {
        return $this->error;
    }

    protected function setResourceInstance()
    {
        if (is_null($this->resource)) {
            try {
                $this->resource = $this->client->get($this->uri);
                return true;
            } catch (ClientException $exception) {
                $this->error = 'No connection to source ' . static::SOURCE_NAME . '. ';
                return false;
            }
        }
        return true;
    }

    /**
     * @param array $data
     * @return CurrencyCollection
     */
    abstract protected function normalizeData($data);
}
