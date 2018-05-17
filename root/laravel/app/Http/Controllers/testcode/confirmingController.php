<?php

namespace App\Http\Controllers\testcode;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class confirmingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
    }

    public function showList(){
        $datas = [];

        return view('testcode.confirming.list', compact('datas'));
    }

    public function create(){
        return view('testcode.confirming.create');
    }

    public function confirm( $request ){
        return view('testcode.confirming.confirm');
    }

    public function insert( $request ){
        return view('testcode.confirming.insert');
    }









}
