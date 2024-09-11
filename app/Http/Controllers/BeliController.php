<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beli;
use Illuminate\View\View;

class belicontroller extends Controller
{
    public function index()
    {
        $data = beli::all();
        return view('dashboard', ['beli' => $data]);
    }
}
