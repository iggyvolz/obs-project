<?php

declare(strict_types=1);

namespace iggyvolz\ObsProject;

class Container extends \Nette\DI\Container
{
    protected array $types = ['container' => 'Nette\DI\Container'];
    protected array $aliases = [];

    protected array $wiring = [
        'Nette\DI\Container' => [['container']],
        'Psr\Http\Message\RequestFactoryInterface' => [['psr17']],
        'Psr\Http\Message\ResponseFactoryInterface' => [['psr17']],
        'Psr\Http\Message\ServerRequestFactoryInterface' => [['psr17']],
        'Psr\Http\Message\StreamFactoryInterface' => [['psr17']],
        'Psr\Http\Message\UploadedFileFactoryInterface' => [['psr17']],
        'Psr\Http\Message\UriFactoryInterface' => [['psr17']],
        'Nyholm\Psr7\Factory\Psr17Factory' => [['psr17']],
        'Psr\Log\AbstractLogger' => [['logger']],
        'Psr\Log\LoggerInterface' => [['logger']],
        'iggyvolz\ObsProject\Logger' => [['logger']],
        'Amp\Http\Server\HttpServer' => [['http']],
        'Amp\Http\Server\RequestHandler' => [['requestHandler']],
        'iggyvolz\ObsProject\RequestHandler' => [['requestHandler']],
        'iggyvolz\obs\Obs' => [['obs']],
        'iggyvolz\ObsProject\App' => [['app']],
        'Ramsey\Uuid\UuidFactoryInterface' => [['uuidFactory']],
        'Ramsey\Uuid\UuidFactory' => [['uuidFactory']],
        'iggyvolz\obs\RequestIdGenerator' => [['requestGenerator']],
        'iggyvolz\ObsProject\UuidRequestIdGenerator' => [['requestGenerator']],
        'Amp\Socket\SocketServer' => [['tcpServer']],
        'Amp\ByteStream\ResourceStream' => [['tcpServer']],
        'Amp\ByteStream\ClosableStream' => [['tcpServer']],
        'Amp\Socket\ResourceSocketServer' => [['tcpServer']],
    ];

    public function __construct(array $params = [])
    {
        parent::__construct($params);
        $this->parameters += [
            'port' => 8080,
            'obsConnection' => 'ws://192.168.1.118:4444',
            'obsPassword' => 'IEAL8ig3QxEcaJiD',
        ];
    }

    public function createServiceApp(): App
    {
        return new App($this->getService('http'), $this->getService('obs'));
    }

    public function createServiceContainer(): self
    {
        return $this;
    }

    public function createServiceHttp(): \Amp\Http\Server\HttpServer
    {
        return new \Amp\Http\Server\HttpServer(
            [$this->getService('tcpServer')],
            $this->getService('requestHandler'),
            $this->getService('logger'),
        );
    }

    public function createServiceLogger(): Logger
    {
        return new Logger;
    }

    public function createServiceObs(): \iggyvolz\obs\Obs
    {
        return new \iggyvolz\obs\Obs(
            'ws://192.168.1.118:4444',
            'IEAL8ig3QxEcaJiD',
            $this->getService('requestGenerator'),
            $this->getService('logger'),
        );
    }

    public function createServicePsr17(): \Nyholm\Psr7\Factory\Psr17Factory
    {
        return new \Nyholm\Psr7\Factory\Psr17Factory;
    }

    public function createServiceRequestGenerator(): UuidRequestIdGenerator
    {
        return new UuidRequestIdGenerator($this->getService('uuidFactory'));
    }

    public function createServiceRequestHandler(): RequestHandler
    {
        return new RequestHandler($this->getService('logger'));
    }

    public function createServiceTcpServer(): \Amp\Socket\ResourceSocketServer
    {
        return \Amp\Socket\listen('0.0.0.0:8080');
    }

    public function createServiceUuidFactory(): \Ramsey\Uuid\UuidFactory
    {
        return new \Ramsey\Uuid\UuidFactory;
    }

    public function initialize()
    {
    }
}
