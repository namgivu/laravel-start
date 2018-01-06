<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{

    /*
     * Authenticating All Task Routes
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

}
