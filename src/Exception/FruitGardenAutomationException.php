<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

/**
 * Class FruitGardenAutomationException
 * @package App\Exception
 */
final class FruitGardenAutomationException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        // modify message
        $message = $message . PHP_EOL;
        parent::__construct($message, $code, $previous);
    }
}
