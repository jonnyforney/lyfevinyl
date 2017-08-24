<?php

namespace App\Classes;

use App\Classes\Step;
use App\Classes\Payment;

class Preview implements Step
{
    function __construct()
    {
    }

    public function save($data)
    {        
        return $this->store($data);
    }

    public function store($data)
    {
        return (new Payment)->save($data);
    }
}
