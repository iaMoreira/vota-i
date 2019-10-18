@extends('adminlte::page')

@section('title', 'Candidatos')

@section('content_header')
    <h1>Cadastrar candidato</h1>
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
            @if(isset($candidate))
                action="{{ route('candidate.update', [$candidate->id, $urn->id]) }}"
            @else
                action="{{ route('candidate.store', $urn->id) }}"
            @endif
            >
            @csrf
            @if(isset($candidate))
                <input name="_method" type="hidden" value="PUT">
            @endif
            <div class="form-group">
                <label for="ad">Nome</label>
                <input type="text"  required name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Insira o nome d@ candidadt@"
                @if(isset($candidate)) value="{{$candidate->name}}" @endif value="{{old('name')}}">
            </div>

            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file"  required name="avatar" class="form-control @error('avatar') is-invalid @enderror">
            </div>

            <button class="btn btn-primary" type="submit">
                    @if(isset($candidate))
                        Atualizar
                    @else
                        Cadastrar
                    @endif
                </button>
            <a href="{{ route('candidate.index', $urn->id) }}" class="btn" >Voltar</a>
        </form>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
@stop

@section('js')
<script>



    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'DD/MM/YYYY hh:mm A' }})

</script>
@stop
