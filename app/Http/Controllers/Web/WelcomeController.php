<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

/**
 *
 */
class WelcomeController extends Controller
{
    /**
     * @return View
     */
    public function home(){
        return view('welcome');
    }
}