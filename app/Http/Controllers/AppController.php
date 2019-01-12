<?php

namespace App\Http\Controllers;

use App\Cacher;
use App\Response;
use App\Service;
use App\Downloader;
use Illuminate\Http\Request;

/**
 * The app controller.
 *
 * @author igronus
 */
class AppController extends Controller
{
    /**
     * Getting searched data.
     *
     * @param Request $request
     *
     * @return string
     */
    public function search(Request $request)
    {
        if ( ! $request->search) {
            return new Response(false, 'No search parameter');
        }

        try {
            $search = $request->search;
            $page = $request->page ?: 0;


            $service = new Service();

            $downloader = new Downloader();
            $downloader->setUrl(sprintf(config('app.api_url_mask'), config('app.api_url'), $search, $page*10));

            $cacher = new Cacher();
            $downloader->setCacher($cacher);
            $service->setDownloader($downloader);

            $mapper = new \JsonMapper();
            $mapper->undefinedPropertyHandler = '\App\Book::setUndefinedProperty';
            $mapper->bExceptionOnMissingData = true;
            $service->setMapper($mapper);

            $data = $service->getData($search, $page);
        }  catch (\Exception $e) {
            return new Response(false, $e->getMessage());
        }

        return new Response(true, $data);
    }
}
