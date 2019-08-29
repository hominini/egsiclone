@extends('admin.layouts.base')

@section('scoped_css_imports')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('scoped_js_imports')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('content')

    @component('admin.components.card')

        @slot('card_header')

            Evaluación de cumplimiento de hitos
            <div class="card-header-actions">
                <a class="btn btn-primary" href="{{ route('fulfillments.create') }}"> Nuevo cumplimiento</a>
            </div>

        @endslot

        @slot('card_body')
        
        <table id="assessment-table" class="table table-striped table-bordered data-table" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Institución</th>
                    <th>Hito cumplido</th>
                    <th>Fecha de cumplimiento</th>
                    <th>Fecha de cumplimiento</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
            
        @endslot
    @endcomponent

@section('custom_scripts')
<script type="text/javascript">

  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('assessment.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'fulfillment_date', name: 'fulfillment_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        responsive: true,
    });
});

</script>
@endsection
    
@endsection
