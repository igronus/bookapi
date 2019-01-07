<?php

namespace Tests\Unit;

use App\Downloader;
use Tests\TestCase;

class DownloaderTest extends TestCase
{
    public function testUnavailable()
    {
        $this->expectException(\Exception::class);

        $d = new Downloader();
        $d->setUrl(sprintf('http://unexisting-domain-%s.ru', md5(time() . rand(0, 100))));
        $d->download();
    }
}
