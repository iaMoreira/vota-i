@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Cadastrar usuário</h1>
@stop

@section('content')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
</div>
@if(isset($errors) && count($errors->all()) > 0 )
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <strong>Aviso. </strong>
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
</div>
@endif
<div >
    <form method="POST"
        @if(isset($user))
            action="{{ route('user.update', $user->id) }}"
        @else
            action="{{ route('user.store') }}"
        @endif
        >
        @csrf
        @if(isset($user))
            <input name="_method" type="hidden" value="PUT">
            <input name="id" type="hidden" value="{{$user->id}}">
        @endif
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name"  required class="form-control @error('name') is-invalid @enderror" placeholder="Insira o nome do usuário"
            @if(isset($user)) value="{{$user->name}}" @endif value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" name="email" id="email" required class="form-control @error('email') is-invalid @enderror" placeholder="Insira o email do usuário"
            @if(isset($user)) value="{{$user->email}}" @endif value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="name">Senha</label>
            <input type="password" name="password" id="password" required class="form-control @error('password') is-invalid @enderror" placeholder="Insira a senha do usuário"
            >
        </div>
        <div class="form-group">
            <label id="label-password-confirm" for="name">Confirme sua senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirme a senha do usuário">
        </div>

        <div class="form-group">
            <label for="name">nível de acesso</label>
            <select name="role_id" id="role_id" class="form-control form-control-sm" required>
                <option value="2" selected>Candidato</option>
                <option value="1" selected>Administrador</option>
            </select>
        </div>


        <button class="btn btn-primary" type="submit">
            @if(isset($user))
                Atualizar
            @else
                Cadastrar
            @endif
        </button>
        <a href="{{ route('user.index') }}" class="btn" type="submit">Voltar</a>
    </form>
</div>

@stop


@section('adminlte_js')
    <script src="https://rawgit.com/RobinHerbots/Inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script>
            $("#password-confirm").keyup(function(){
                if ($("#password").val() != $("#password-confirm").val()) {
                    $("#label-password-confirm").css("color","red");
                    $("#password-confirm").css("color","red");
                }else{
                    $("#label-password-confirm").css("color","green");
                    $("#password-confirm").css("color","green");
                }
            });
    </script>
@endsection
