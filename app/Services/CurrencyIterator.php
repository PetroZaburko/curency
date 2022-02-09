<?php


namespace App\Services;


use App\Exceptions\CurrencyException;

final class CurrencyIterator
{
    private $currencies;
    private $errors;

    public function __construct(iterable $currencies)
    {
        $this->currencies = $currencies;
    }

    public function exchange()
    {
        /**
         * @var $currency CurrencyService
         */
        foreach ($this->currencies as $currency) {
            if ($currency->isResourceAvailable()) {
                return $currency;
            }
            $this->errors[]=  $currency->getResourceError();
        }
        if ($this->currencies->count() == count($this->errors)) {
            $message = implode(' ', $this->errors);
            throw new CurrencyException($message);
        }
    }


}
