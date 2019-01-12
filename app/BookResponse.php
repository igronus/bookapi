<?php

namespace App;

/**
 * The response from the api.
 *
 * @author igronus
 */
class BookResponse
{
    /**
     * Total items
     *
     * @var integer
     * @required
     */
    public $totalItems;

    /**
     * Books
     *
     * @var Book[]
     * @required
     */
    public $items = array();
}
