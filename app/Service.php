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
     * Getting data (with caching if cacher exists).
     *
     * @return string
     * @throws \Exception
     */
    public function getData($request, $page)
    {
        if ($this->cacher) {
            $key = sprintf('%s_%s', $request, $page);

            if ($this->cacher->get($key) !== null) {
                return $this->cacher->get($key);
            }
        }


        if ( ! $this->downloader) {
            throw new \Exception('Service: No url specified');
        }


        $data = $this->downloader->download($key);

        if ($this->cacher) {
            $this->cacher->put($key, $data);
        }

        return $data;
    }
}
