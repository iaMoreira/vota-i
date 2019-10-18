<?php

namespace App\Http\Controllers;

use App\Urn;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class UrnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urns = Urn::all();
        return view('admin.urn.index', compact('urns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.urn.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        list($begin, $end) = explode('-', $input['date']);
        $begin = Carbon::createFromDate($begin);
        $end = Carbon::createFromDate($end);
        $urn = Urn::create([
            'title' => $input['title'],
            'begin' => $begin,
            'end'   => $end
        ]);
        Session::flash('alert-success', 'Urna cadastrada com sucesso. ');
        return redirect()->route('urn.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Urn  $urn
     * @return \Illuminate\Http\Response
     */
    public function show(Urn $urn)
    {
        $candidates = $urn->candidates;
        $ballots = $urn->ballots()->with('candidate')->groupBy('candidate_id')
            ->selectRaw('count(*) as total, candidate_id')
            ->get();
        return view('admin.urn.show', compact('urn', 'candidates', 'ballots'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Urn  $urn
     * @return \Illuminate\Http\Response
     */
    public function edit(Urn $urn)
    {

        return view('admin.urn.create', compact('urn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Urn  $urn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Urn $urn)
    {
        $input = $request->except('_token');
        list($begin, $end) = explode('-', $input['date']);
        $begin = Carbon::createFromDate($begin);
        $end = Carbon::createFromDate($end);
        $urn->update([
            'title' => $input['title'],
            'begin' => $begin,
            'end'   => $end
        ]);
        Session::flash('alert-success', 'Urna ' . $urn->title . ' atualizada com sucesso. ');
        return redirect()->route('urn.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Urn  $urn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Urn $urn)
    {
        //
    }
}
