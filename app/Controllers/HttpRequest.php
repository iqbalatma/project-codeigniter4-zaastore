<?php

namespace App\Controllers;

class HttpRequest extends BaseController
{
    public function __construct()
    {
        parent::check_login();
    }

    public function index()
    {
        return view('view_401');
    }
}
