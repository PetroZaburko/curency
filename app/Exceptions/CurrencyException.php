<?php


namespace App\Exceptions;


use \Exception;
use Throwable;

class CurrencyException extends Exception
{
    protected $customMessage = 'Can not connect to API sources. Data not updated!';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = $message . $this->customMessage;
    }
}
