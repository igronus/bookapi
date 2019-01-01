<?php

namespace App;

/**
 * The response object.
 *
 * Becomes a text json object in case of string representation.
 *
 * @author igronus
 */
class Response
{
    public $status;
    public $data;

    public function __construct($status, $data)
    {
        $this->status = (bool) $status;
        $this->data = $data;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
