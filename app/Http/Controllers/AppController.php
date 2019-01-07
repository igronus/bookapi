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
            $service = new Service();

            $downloader = new Downloader();
            $downloader->setUrl(sprintf(config('app.api_url_mask'), config('app.api_url'), $request->search));
            $service->setDownloader($downloader);

            $cacher = new Cacher();
            $service->setCacher($cacher);

            $data = $service->getData($request->search);
        }  catch (\Exception $e) {
            return new Response(false, $e->getMessage());
        }

        return new Response(true, $data);
    }
}
