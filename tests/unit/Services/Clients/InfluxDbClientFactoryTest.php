<?php
//declare(strict_types=1);

namespace Algatux\InfluxDbBundle\Tests\unit\Services\Clients;

use Algatux\InfluxDbBundle\Services\Clients\InfluxDbClientFactory;
use InfluxDB\Client;
use InfluxDB\Database;
use InfluxDB\Driver\Guzzle;
use InfluxDB\Driver\UDP;

class InfluxDbClientFactoryTest extends \PHPUnit_Framework_TestCase
{

    const TEST_HOST = 'localhost';
    const TEST_DB = 'udp';
    const TEST_UDP = '4444';
    const TEST_HTTP = '8086';

    public function test_client_factory_test_exists()
    {
        $factory = new InfluxDbClientFactory(self::TEST_HOST,self::TEST_DB,self::TEST_UDP,self::TEST_HTTP);
        $this->assertInstanceOf(InfluxDbClientFactory::class, $factory);
    }

    public function test_build_udp_client_returns_a_valid_client()
    {
        $factory = new InfluxDbClientFactory(self::TEST_HOST,self::TEST_DB,self::TEST_UDP,self::TEST_HTTP);
        $database = $factory->buildUdpClient();

        $this->assertInstanceOf(Database::class, $database);
        $this->assertEquals(self::TEST_DB, $database->getName());
        $this->assertInstanceOf(UDP::class,$database->getClient()->getDriver());
    }

    public function test_build_http_client_returns_a_valid_client()
    {
        $factory = new InfluxDbClientFactory(self::TEST_HOST,self::TEST_DB,self::TEST_UDP,self::TEST_HTTP);
        $database = $factory->buildHttpClient();

        $this->assertInstanceOf(Database::class, $database);
        $this->assertEquals(self::TEST_DB, $database->getName());
        $this->assertInstanceOf(Guzzle::class,$database->getClient()->getDriver());
    }

}