<?php

namespace iggyvolz\ObsProject\DataProviders\MelonDs;

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
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;

class MelonDsApi extends DataProvider
{

    private readonly Psr17Factory $requestFactory;
    private readonly ClientInterface $client;

    public function __construct(
        private readonly int $port = 8080,
        private readonly string $ip = "127.0.0.1",
        ?ClientInterface $client = null,
    )
    {
        $factory = new Psr17Factory();
        $this->requestFactory = $factory;
        $this->client = $client ?? new PsrHttpClient(HttpClientBuilder::buildDefault(), new PsrAdapter($factory, $factory));
    }

    public function get(ArmRegion $region, int $address, int $size): int
    {
//        echo "GET http://$this->ip:$this->port/$region->value/$address/$size\n";
        $response = $this->client->sendRequest($this->requestFactory->createRequest("GET", "http://$this->ip:$this->port/$region->value/$address/$size"));
        if(($responseCode = $response->getStatusCode()) !== 200) {
            throw new \RuntimeException("Unexpected response code $responseCode");
        }
        return intval($response->getBody()->getContents());
    }

    public function getIndex(string $index): int|bool|null
    {
        foreach (MalbisMemoryAddress::cases() as $case) {
            if($case->name === $index) {
                return $case->get($this);
            }
        }
        return null;
    }


    public function dataProvider(LuaState $lua): int|bool|null
    {
        $index = $lua[1];
        if(!$index instanceof LuaString) throw new LuaException("Invalid");
        $index = $index->value();

        foreach (MalbisMemoryAddress::cases() as $case) {
            if($case->name === $index) {
                return $case->get($this);
            }
        }
        return null;
    }
}