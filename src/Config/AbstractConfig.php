<?php

declare(strict_types=1);

namespace HydrogenpayAfrica\Config;

use HydrogenpayAfrica\EventHandlers\EventHandlerInterface;
use HydrogenpayAfrica\HydrogenpayAfrica;
use HydrogenpayAfrica\Contract\ConfigInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use HydrogenpayAfrica\Helper\EnvVariables;

abstract class AbstractConfig
{
    public const LIVE_API_KEY = 'LIVE_API_KEY';
    public const SANDBOX = 'SANDBOX';
    // public const ENCRYPTION_KEY = 'ENCRYPTION_KEY';
    public const MODE = 'MODE';
    public const DEFAULT_PREFIX = 'HY|PHP';
    public const LOG_FILE_NAME = 'hydrogenpay-php.log';
    protected Logger $logger;
    protected string $secret;
    protected string $public;

    protected static ?ConfigInterface $instance = null;
    protected string $mode;
    private ClientInterface $http;
    // protected string $enc;

    protected function __construct(string $sandbox, string $live_api_key, string $mode)

    {
        $this->secret = $sandbox;
        $this->public = $live_api_key;
        // $this->enc = $encrypt_key;
        $this->mode = $mode;

        $this->http = new Client(
            [
            'base_uri' => EnvVariables::BASE_URL,
            'timeout' => 60,
            RequestOptions::VERIFY => \Composer\CaBundle\CaBundle::getSystemCaRootBundlePath()
            ]
        );

        $log = new Logger('HydrogenpayAfrica/PHP');
        $this->logger = $log;
    }

    abstract public static function setUp(
        string $secretKey,
        string $publicKey,
        // string $enc,
        string $mode
    ): ConfigInterface;

    public function getHttp(): ClientInterface
    {
        return $this->http;
    }

    public function getLoggerInstance(): LoggerInterface
    {
        return $this->logger;
    }

    // abstract public function getEncryptkey(): string;

    abstract public function getPublicKey(): string;

    abstract public function getSecretKey(): string;

    abstract public function getMode(): string;

    public static function getDefaultTransactionPrefix(): string
    {
        return self::DEFAULT_PREFIX;
    }
}
