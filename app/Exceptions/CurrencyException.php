<?php


namespace App\Exceptions;


use \Exception;

class CurrencyException extends Exception
{
    protected $message = 'ERROR! Can not connect to source API. Data not updated!';
}
