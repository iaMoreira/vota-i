{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Urnas')

@section('content_header')
    <h1>Candidatos por urna</h1>
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
                <th scope="col" style="text-transform: uppercase; font-weight: 700">Urna</th>
                <th scope="col" style="text-align: right; text-transform: uppercase; font-weight: 700">Inicio</th>
                <th scope="col" style="text-align: right; text-transform: uppercase; font-weight: 700">Fim</th>
                <th scope="col" style="text-align: center; text-transform: uppercase; font-weight: 700">Ações</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($urns as $urn)
                    <tr>
                        <th scope="row">{{ $urn->id }}</th>
                        <td style="text-transform: uppercase; font-weight: 400; font-style: italic">{{ $urn->title }}</td>
                        <td style="text-align: right; text-transform: uppercase; font-weight: 400; font-style: italic">{{ date_format(date_create($urn->begin), 'H:i:s - d/m/Y') }}</td>
                        <td style="text-align: right; text-transform: uppercase; font-weight: 400; font-style: italic">{{ date_format(date_create($urn->end), 'H:i:s - d/m/Y') }}</td>
                        <td style="text-align: center;">
                            <a class="btn btn-primary" href="{{ route('candidate.index', $urn->id) }}" ><i class="fa fa-users"> Candidatos</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                null,
                null,
                { "width": "15%" },
                        ],
            'searching'   : false,
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
