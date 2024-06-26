<?php

declare(strict_types=1);

namespace HydrogenpayAfrica\Contract;

use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;

interface ConfigInterface
{
    // public static function setUp(string $secretKey, string $publicKey, string $enc, string $env): ConfigInterface;
    public static function setUp(string $secretKey, string $publicKey, string $mode): ConfigInterface;

    public function getHttp(): ClientInterface;

    public function getLoggerInstance(): LoggerInterface;

    // public function getEncryptkey(): string;

    public function getPublicKey(): string;

    public function getSecretKey(): string;

    public function getMode(): string;

    public static function getDefaultTransactionPrefix(): string;
}
