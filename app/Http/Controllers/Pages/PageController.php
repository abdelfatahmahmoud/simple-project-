<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        $title = ' Hello to index';
        return view('collections.index')->with('title',$title);
    }

    public function about() {
        return view('collections.about');
    }

    public function services() {

        $data = [
            'title' => ' The following services are provided: ',
            'services' => [
                'programming','automation',' web desing'
            ]
        ];
        return view('collections.services')->with($data);
    }
}
