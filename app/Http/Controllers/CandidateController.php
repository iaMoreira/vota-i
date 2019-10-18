<?php

namespace App\Http\Controllers;

use App\Urn;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $urns = Urn::all();
        return view('candidate.home', compact('urns'));
    }
}
