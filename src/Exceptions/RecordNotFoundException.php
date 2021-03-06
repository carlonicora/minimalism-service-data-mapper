<?php
namespace CarloNicora\Minimalism\Services\DataMapper\Exceptions;

use Exception;
use Throwable;

class RecordNotFoundException extends Exception
{
    /**
     * DbRecordNotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code!==0?$code:404, $previous);
    }
}