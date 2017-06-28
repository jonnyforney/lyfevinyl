<?php
namespace App\Classes;

interface Step {
    //  save in session
    public function save($data);
    //  save in database
    public function store($data);
}