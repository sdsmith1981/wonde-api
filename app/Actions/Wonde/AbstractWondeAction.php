<?php

namespace App\Actions\Wonde;

use Wonde\Client;

class AbstractWondeAction
{
    protected Client $client;

    protected $school;

    public function __construct()
    {
        $this->client = new \Wonde\Client(config('services.wonde.token'));
        $this->school = $this->client->school(config('services.wonde.school_id'));
    }
}
