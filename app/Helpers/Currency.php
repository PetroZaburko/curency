<?php


namespace App\Helpers;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Exceptions\CurrencyException;

class Currency
{
    protected $client;
    protected $version;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('currency.base_uri')]);
        $this->version = config('currency.api_version');
    }

    /**
     * @param null $date
     * @param null $valcode
     * @return mixed
     * @throws CurrencyException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     */
    public function getCurrency($date = null, $valcode = null)
    {
        try {
            $response = $this->client->get("/NBUStatService/$this->version/statdirectory/exchange?valcode=$valcode&date=$date&json");
            $content = $response->getBody()->getContents();
        } catch (RequestException $exception) {
            throw new CurrencyException();
        }
        return json_decode($content, true);
    }

}
