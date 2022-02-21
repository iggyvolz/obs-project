<?php

namespace iggyvolz\ObsProject;

use Amp\Cancellation;
use Amp\Socket\BindContext;
use Amp\Socket\EncryptableSocket;
use Amp\Socket\ResourceSocket;
use Amp\Socket\SocketAddress;
use Amp\Socket\SocketServer as ISocketServer;
use function Amp\Socket\listen;

class SocketServer implements ISocketServer
{
    private ISocketServer $socket;

    public function __construct(
        string $uri,
        ?BindContext $context = null,
        int $chunkSize = ResourceSocket::DEFAULT_CHUNK_SIZE)
    {
        $this->socket = listen($uri, $context, $chunkSize);
    }

    public function close(): void
    {
        $this->socket->close();
    }

    public function isClosed(): bool
    {
        return $this->socket->isClosed();
    }

    public function reference(): void
    {
        $this->socket->reference();
    }

    public function unreference(): void
    {
        $this->socket->unreference();
    }

    public function getResource()
    {
        return $this->socket->getResource();
    }

    public function accept(?Cancellation $cancellation = null): ?EncryptableSocket
    {
        return $this->socket->accept($cancellation);
    }

    public function getAddress(): SocketAddress
    {
        return $this->socket->getAddress();
    }
}