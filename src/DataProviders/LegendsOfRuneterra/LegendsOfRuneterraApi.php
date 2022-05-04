<?php

namespace iggyvolz\ObsProject\DataProviders\LegendsOfRuneterra;

use Amp\Http\Client\HttpClientBuilder;
use Amp\Http\Client\Psr7\PsrAdapter;
use Amp\Http\Client\Psr7\PsrHttpClient;
use CuyZ\Valinor\Mapper\Source\JsonSource;
use CuyZ\Valinor\Mapper\TreeMapper;
use CuyZ\Valinor\MapperBuilder;
use iggyvolz\ObsProject\DataProviders\DataProvider;
use iggyvolz\ObsProject\Lua\LuaException;
use iggyvolz\ObsProject\Lua\LuaState;
use iggyvolz\ObsProject\Lua\LuaString;
use iggyvolz\ObsProject\Lua\LuaValue;
use JetBrains\PhpStorm\Internal\TentativeType;
use JsonSerializable;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class LegendsOfRuneterraApi extends DataProvider
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

    public function getIndex(string $index): ?array
    {

        $res = match($index) {
            "activeDeck" => $this->getActiveDeck(),
            "cardPositions" => $this->getCardPositions(),
            "expeditions" => $this->getExpeditions(),
            "gameResult" => $this->getGameResult(),
            default => null
        };
        return json_decode(json_encode($res), associative: true);
    }

    public function dataProvider(LuaState $lua): mixed
    {
        $index = $lua[2];
        if(!$index instanceof LuaString) throw new LuaException("Invalid");
        $index = $index->value();

        $res = match($index) {
            "ActiveDeck" => $this->getActiveDeck(),
            "CardPositions" => $this->getCardPositions(),
            "Cxpeditions" => $this->getExpeditions(),
            "GameResult" => $this->getGameResult(),
            default => throw new LuaException("Invalid")
        };
        return LuaValue::new($lua, json_decode(json_encode($res), associative: true), forcetop: true);
    }
}