<?php

namespace App\Http\Controllers;

use App\Urn;
use Illuminate\Http\Request;

class ElectorController extends Controller
{
    public function index()
    {
        $urns = Urn::all();
        return view('elector.home', compact('urns'));
    }
}
