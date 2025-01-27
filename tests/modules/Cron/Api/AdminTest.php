<?php

namespace Box\Mod\Cron\Api;

class AdminTest extends \BBTestCase
{
    public function testgetDi()
    {
        $di = new \Pimple\Container();
        $api_admin = new Admin();
        $api_admin->setDi($di);
        $getDi = $api_admin->getDi();
        $this->assertEquals($di, $getDi);
    }

    public function testinfo()
    {
        $serviceMock = $this->getMockBuilder('\\' . \Box\Mod\Cron\Service::class)->getMock();
        $serviceMock->expects($this->atLeastOnce())->method('getCronInfo')->willReturn([]);

        $api_admin = new Admin();
        $api_admin->setService($serviceMock);

        $result = $api_admin->info([]);
        $this->assertIsArray($result);
    }

    public function testrun()
    {
        $serviceMock = $this->getMockBuilder('\\' . \Box\Mod\Cron\Service::class)->getMock();
        $serviceMock->expects($this->atLeastOnce())->method('runCrons')->willReturn(true);

        $api_admin = new Admin();
        $api_admin->setService($serviceMock);

        $result = $api_admin->run([]);
        $this->assertIsBool($result);
    }
}
