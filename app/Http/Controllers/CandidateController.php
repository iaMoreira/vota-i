<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Urn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Urn $urn)
    {
        $candidates = $urn->candidates;
        return view('admin.candidate.index', compact('candidates', 'urn'));
    }

    public function candidates()
    {
        $urns = Urn::all();
        return view('admin.candidate.urns', compact('urns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Urn $urn)
    {
        return view('admin.candidate.create', compact('urn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Urn $urn)
    {
        $input = $request->except('_token');
        if ($request->hasfile('avatar')) {
            $name = $request->avatar->hashName();
            $upload = $request->avatar->storeAs('public/candidate/avatar', $name);
            if (!$upload) {
                Session::flash('error', 'Falha ao fazer o upload da imagem. ');
            } else {
                $path = 'storage/candidate/avatar/' . $name;
            }
        }
        $candidate = Candidate::create([
            'name'      => $input['name'],
            'avatar'    => $path,
            'urn_id'    => $urn->id
        ]);
        Session::flash('alert-success', 'Candidato ' . $input['name'] . ' cadastro com sucesso. ');
        return redirect()->route('candidate.create', $urn->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate, Urn $urn)
    {
        return view('admin.candidate.create', compact('urn', 'candidate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
