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


    private $cacher;

    public function setCacher(CacherInterface $c) {
        $this->cacher = $c;
    }


    /**
     * Getting data (without caching yet).
     *
     * @return string
     * @throws \Exception
     */
    public function getData($request)
    {
        if ($this->cacher) {
            if ($this->cacher->get($request) !== null) {
                return $this->cacher->get($request);
            }
        }


        if ( ! $this->downloader) {
            throw new \Exception('Service: No url specified');
        }


        $data = $this->downloader->download($request);

        if ($this->cacher) {
            $this->cacher->put($request, $data);
        }

        return $data;
    }
}
