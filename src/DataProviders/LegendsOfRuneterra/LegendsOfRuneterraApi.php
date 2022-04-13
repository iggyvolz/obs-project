<?php

namespace iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra;

use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Psr7\PsrAdapter;
use Amp\Http\Client\Psr7\PsrHttpClient;
use CuyZ\Valinor\Mapper\Source\JsonSource;
use CuyZ\Valinor\Mapper\TreeMapper;
use CuyZ\Valinor\MapperBuilder;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class LegendsOfRuneterraApi
{
    private readonly ClientInterface $client;
    private readonly RequestFactoryInterface $requestFactory;
    private readonly TreeMapper $mapper;

    public function __construct(
        private readonly int $port = 21337,
        private readonly string $ip = "127.0.0.1",
        ?ClientInterface $client = null,
    )
    {
        $factory = new Psr17Factory();
        $this->requestFactory = $factory;
        $this->client = $client ?? new PsrHttpClient(HttpClientBuilder::buildDefault(), new PsrAdapter($factory, $factory));
        $this->mapper = (new MapperBuilder())->mapper();
    }

    public function getActiveDeck(): ActiveDeck
    {
        return $this->mapper->map(ActiveDeck::class, $this->request("static-decklist"));
    }
    public function getCardPositions(): CardPositions
    {
        return $this->mapper->map(CardPositions::class, $this->request("positional-rectangles"));
    }
    public function getExpeditions(): Expeditions
    {
        return $this->mapper->map(Expeditions::class, $this->request("expeditions-state"));
    }
    public function getGameResult(): GameResult
    {
        return $this->mapper->map(GameResult::class, $this->request("game-result"));
    }

    private function request(string $endpoint): JsonSource
    {
        $response = $this->client->sendRequest($this->requestFactory->createRequest("GET", "http://$this->ip:$this->port/$endpoint"));
        if(($responseCode = $response->getStatusCode()) !== 200) {
            throw new \RuntimeException("Unexpected response code $responseCode");
        }
        return new JsonSource($response->getBody()->getContents());
    }


}