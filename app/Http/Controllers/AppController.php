<?php

namespace App\Http\Controllers;

use App\Response;
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

        return new Response(true, sprintf('Search parameter get: %s', $request->search));
    }
}
