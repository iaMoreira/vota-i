@extends('adminlte::page')

@section('title', 'Urnas')

@section('content_header')
    <h1>Cadastrar de Urna</h1>
@stop

@section('content')
    @if(isset($errors) && count($errors->all()) > 0 )
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Aviso. </strong>
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
    @endif
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @endforeach
    </div>
    <div id="formCreate" style=" display: block; margin: auto; padding: 1rem; background: white">
        <form method="POST" enctype="multipart/form-data"
            @if(isset($urn))
                action="{{ route('urn.update', $urn->id) }}"
            @else
                action="{{ route('urn.store') }}"
            @endif
            >
            @csrf
            @if(isset($urn))
                <input name="_method" type="hidden" value="PUT">
            @endif
            <div class="form-group">
                <label for="ad">Nome</label>
                <input type="text"  required name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Insira o nome da urna"
                @if(isset($urn)) value="{{$urn->title}}" @endif value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label>Data de expiração</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="date" class="form-control pull-left"  id="reservationtime"
                    @if(isset($urn)) @endif value="{{old('date')}}">
                </div>
                <!-- /.input group -->
            </div>
            <button class="btn btn-primary" type="submit">
                    @if(isset($urn))
                        Atualizar
                    @else
                        Cadastrar
                    @endif
                </button>
            <a href="{{ route('urn.index') }}" class="btn" >Voltar</a>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@stop

@section('js')
<script src="https://adminlte.io/themes/AdminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>



    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'DD/MM/YYYY hh:mm A' }})

</script>
@stop
