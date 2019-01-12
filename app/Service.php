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


    private $mapper;

    /**
     * Should use proxy mapper interface later maybe, but this first version uses
     * netresearch/jsonmapper only and map() method will fit in the future.
     */
    public function setMapper($m) {
        $this->mapper = $m;
    }


    /**
     * Getting data (with caching if cacher exists).
     *
     * @return string
     * @throws \Exception
     */
    public function getData()
    {
        if ( ! $this->downloader) {
            throw new \Exception('Service: No url specified');
        }

        if ( ! $this->mapper) {
            throw new \Exception('Service: No datamapper specified');
        }


        $data = $this->downloader->download();

        $r = new BookResponse();
        $this->mapper->map(json_decode($data), $r);

        return json_encode($r);
    }
}
