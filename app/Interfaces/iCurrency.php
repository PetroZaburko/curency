<?php


namespace App\Interfaces;


use App\Services\CurrencyCollection;

interface iCurrency
{
    function __construct(CurrencyCollection $collection);

    function getCurrency() : CurrencyCollection;

    function isResourceAvailable() : bool ;

    function getResourceName() : string ;

    function getResourceError(): ? string;
}
