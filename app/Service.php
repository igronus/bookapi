<?php

namespace App;

/**
 * The main service.
 *
 * @author igronus
 */
class Service implements ServiceInterface
{
    private $downloader;

    public function setDownloader(DownloaderInterface $f) {
        $this->downloader = $f;
    }


    /**
     * Getting data (without caching yet).
     *
     * @return string
     * @throws \Exception
     */
    public function getData()
    {
        if ( ! $this->downloader) {
            throw new \Exception('Service: No url specified');
        }

        return $this->downloader->download();
    }
}
