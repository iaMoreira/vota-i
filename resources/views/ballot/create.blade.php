@extends('candidate.page')

@section('title', 'Vota-I')

@section('content_header')
    <h1>Candidatos</h1>
@stop

@section('content')
    <form action="{{route('ballot.store')}}" method="post">
        @csrf
        <input type="hidden" name="urn_id" value="{{$urn->id}}">
        <div class="row">
            @foreach ($urn->candidates as $candidate)
                <div class="col-md-4 col-sm-6 col-lg-3" onclick="" >
                    <img src="{{asset($candidate->avatar)}}" alt="" class="img-responsive img-thumbnail"/>
                    <div class="radio">
                        <label><input type="radio" name="candidate_id" value="{{$candidate->id}}">{{$candidate->name}}</label>
                    </div>
                </div>

            @endforeach
        </div>
        <a href="{{route('candidate')}}" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-default">Branco</button>
        <button type="reset" class="btn btn-warning">Corrigir</button>
        <button type="submit" class="btn btn-success">Confirmar</button>
    </form>
@stop
