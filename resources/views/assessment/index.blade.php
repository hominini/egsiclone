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
        @endslot

        @slot('card_body')
        
        <table id="assessment-table" class="table table-striped table-bordered data-table" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Institución</th>
                    <th>Hito cumplido</th>
                    <th>Fecha de cumplimiento</th>
                    <th>Accion</th>
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
            // nombre de la institucion
            {data: 'name', name: 'institutions.name'},
            // informacion del hito
            {
                data: 'milestone_number',
                name: 'milestones.milestone_number',
                render: function (data, type, row) {
                    return '<strong>' + row.milestone_number + '</strong> ' + row.description;
                },
            },
            // fecha de cumplimiento
            {data: 'fulfillment_date', name: 'fulfillment_date'},
            // columna de botones
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
        },
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

    $('body').on('click', '.grade', function () {
      var activity_id = $(this).data('id');
      console.log(activity_id);
      $.get("{{ route('fulfillment_activities.index') }}" +'/' + activity_id +'/edit', function (data) {
          $('#modelHeading').html("Editar actividad");
          $('#saveBtn').val("edit-activity");
          $('#ajaxModel').modal('show');
          $('#activity_id').val(data.id);
          $('#fulfillment_id').val(data.fulfillment_id);
          $('#activity_summary').val(data.activity_summary);
      })
   });
});

</script>
@endsection
    
@endsection
