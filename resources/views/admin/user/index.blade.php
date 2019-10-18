@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')


    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
    </div>

    <div >
        <table id="tableUser" class="table table-bordered table-hover dataTable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col" style="text-transform: uppercase; font-weight: 700">NOMES</th>
                <th scope="col" style="text-align: center;text-transform: uppercase; font-weight: 700">ATIVO</th>
                <th scope="col" style="text-align: center;text-transform: uppercase; font-weight: 700">Ações</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td style="text-transform: uppercase; font-weight: 400; font-style: italic">{{ $user->name }}</td>
                        <td style="text-align: center; text-transform: uppercase; font-weight: 400; font-style: italic">
                            @if($user->active == 1)
                                Sim
                            @else
                                Não
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <a class="btn btn-warning" href="{{ route('user.show', ['id' => $user->id]) }}"><i class="fa fa-search"></i></a>
                            <a class="btn btn-primary" href="{{ route('user.edit', ['id' => $user->id]) }}"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger" href="{{ route('user.destroy', ['id' => $user->id]) }}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary" href="{{ route('user.create') }}">Cadastrar usuário</a>
    </div>
@stop
@section('adminlte_js')

    <script>
        var table = $('#tableUser').DataTable({
            'paging'      : true,
            "columns": [
                { "width": "5%" },
                null,
                { "width": "5%" },
                { "width": "15%" },
                        ],
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "oLanguage": {
                "oPaginate":
                   {
                       "sFirst": "&lt&lt",
                       "sLast": "&gt&gt",
                       "sNext": "&gt",
                       "sPrevious": "&lt"
                   },
               "sEmptyTable": "Nenhum registro encontrado",
               "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
               "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
               "sInfoFiltered": "(Filtrados de _MAX_ registros)",
               "sInfoPostFix": "",
               "sInfoThousands": ".",
               "sLengthMenu": "_MENU_ Resultados por página",
               "sLoadingRecords": "Carregando...",
               "sProcessing": "Processando...",
               "sZeroRecords": "Nenhum registro encontrado",
               "sSearch": "Pesquisar ",

           }        });

    </script>
@stop
