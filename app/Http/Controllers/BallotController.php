<?php

namespace App\Http\Controllers;

use App\Ballot;
use App\Urn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BallotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Urn $urn)
    {
        $user = Auth::user();
        $hash = Hash::make($user->id);
        $ballots = Ballot::where('urn_id', $urn->id)->get();
        foreach ($ballots as $ballot) {
            if (Hash::check($user->id, $ballot->elector)) {
                Session::flash('alert-warning', 'Urna ' . $urn->title . ' já foi votada, você não pode votar novamente.');
                return redirect()->route('elector');
            }
        }
        return view('ballot.create', compact('urn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $hash = Hash::make($user->id);
        $ballots = Ballot::where('urn_id', $request['urn_id'])->get();
        foreach ($ballots as $ballot) {
            if (Hash::check($user->id, $ballot->elector)) {
                $request->session()->flash('alert-warning', 'Urna já foi votada, você não pode votar novamente.');
                return redirect()->route('elector');
            }
        }
        Ballot::create([
            'urn_id'    => $request['urn_id'],
            'elector'   => $hash,
            'candidate_id' => $request['candidate_id'],

        ]);

        $request->session()->flash('alert-success', 'Voto na urna efetuado com sucesso.');
        return redirect()->route('elector');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ballot  $ballot
     * @return \Illuminate\Http\Response
     */
    public function show(Ballot $ballot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ballot  $ballot
     * @return \Illuminate\Http\Response
     */
    public function edit(Ballot $ballot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ballot  $ballot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ballot $ballot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ballot  $ballot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ballot $ballot)
    {
        //
    }
}
