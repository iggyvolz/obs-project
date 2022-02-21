<?php

namespace iggyvolz\ObsProject;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Http\Status;
use Psr\Log\LoggerInterface;
use Throwable;

class RequestHandler implements \Amp\Http\Server\RequestHandler
{
    public function __construct(
        private readonly LoggerInterface $logger,
    )
    {
    }

    public function handleRequest(Request $request): Response
    {
        try {
            if($request->getUri()->getPath() === "/image.png") {
                $image = \Nette\Utils\Image::fromBlank(1920, 1080);
                $white = $image->colorAllocate(random_int(0, 255), random_int(0, 255), random_int(0, 255));
                $image->fill(0, 0, $white);
                return new Response(Status::OK, [
                    "content-type" => "image/png",
                ], $image->toString(IMAGETYPE_PNG));
            }
            return new Response(Status::OK, [
                "content-type" => "text/html; charset=utf-8",
            ], "Hello, World!");
        } catch(Throwable $t) {
            $this->logger->error($t);
            throw $t;
        }
    }
}