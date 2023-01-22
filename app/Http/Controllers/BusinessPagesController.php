<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessPagesController extends Controller
{
    public function business1() {

        return view('business-pages.business1');

    }

    public function business2() {
        return view('business-pages.business2');
    }

    public function business3() {
        return view('business-pages.business3');
    }

    public function business4() {
        return view('business-pages.business4');
    }

    public function business5() {
        return view('business-pages.business5');
    }
}
