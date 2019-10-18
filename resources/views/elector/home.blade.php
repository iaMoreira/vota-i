@extends('elector.page')

@section('title', 'Vota-I')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @endforeach
    </div>
        <div class="row">
            @foreach ($urns as $urn)
            <div class="col-md-4 col-sm-6 col-lg-3" onclick="" >
                <img src="https://www.politize.com.br/wp-content/uploads/2016/09/urna-eletronica-polemicas-eleicoes.jpg" alt="" class="img-responsive img-thumbnail"/>
                <div class="text-center">
                    <a href="{{route('ballot.create', $urn->id)}}"><h3>{{$urn->title}} </h3></a>
                </div>
            </div>
            @endforeach
        </div>
@stop
