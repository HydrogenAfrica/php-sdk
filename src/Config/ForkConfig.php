<?php

/**
 * Handle Configuration for Composer Installation.
 */

declare(strict_types=1);

namespace HydrogenpayAfrica\Config;

use HydrogenpayAfrica\Contract\ConfigInterface;
use GuzzleHttp\Client;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;

use function is_null;

final class ForkConfig extends AbstractConfig implements ConfigInterface
{
    private function __construct(string $secretKey, string $publicKey, string $mode)
    {
        parent::__construct($secretKey, $publicKey, $mode);

        $this->logger->pushHandler(new RotatingFileHandler(__DIR__ . "/../../" . self::LOG_FILE_NAME, 90));
    }
    public static function setUp(string $secretKey, string $publicKey, string $mode): ConfigInterface

    {
        if (is_null(self::$instance)) {
            // return new self($secretKey, $publicKey, $enc, $env);
            return new self($secretKey, $publicKey, $mode);

        }
        return self::$instance;
    }
    public function getPublicKey(): string
    {
        return $this->public;
    }

    public function getSecretKey(): string
    {
        return $this->secret;
    }

    public function getMode(): string
    {
        return $this->mode;
    }
}
