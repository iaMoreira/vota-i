{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Candidatos')

@section('content_header')
    <h1>Candidatos - ({{$urn->id}}) Urna {{$urn->title}}</h1>
@stop

@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))

        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
        @endforeach
    </div>
    <div id="table_content">
        <table id="tableUrns" class="table table-bordered table-hover dataTable">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col" style="text-transform: uppercase; font-weight: 700">Candidato</th>
                <th scope="col" style="text-align: center; text-transform: uppercase; font-weight: 700">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                    <tr>
                        <th scope="row">{{ $candidate->id }}</th>
                        <td style="text-transform: uppercase; font-style: italic">{{ $candidate->name }}</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary" href="{{ route('candidate.edit', [$candidate->id, $urn->id]) }}" ><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger" href="{{ route('candidate.destroy', [$candidate->id, $urn->id]) }}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary" href="{{ route('candidate.create', $urn->id) }}" >Cadastrar</a>
    </div>

@stop

@section('css')
@stop

@section('js')
    <script>
        var table = $('#tableUrns').DataTable({
            'paging'      : true,
            'lengthChange': false,
            "columns": [
                { "width": "5%" },
                null,
                { "width": "15%" },
                        ],
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

            }
        });

        function editService (id) {
            // ajax para editar a profissão
        }

        function deleteService (id) {
            // ajax para destruir uma profissão
        }

        function addService () {
            // abrir modal para adicionar profissão
        }

    </script>
@stop
