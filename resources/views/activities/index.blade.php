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

<div class="container">
    <a class="btn btn-success" href="javascript:void(0)" id="createNewActivity"> Nueva actividad</a>
    <table class="table table-striped table-bordered data-table" >
        <thead>
            <tr>
                <th>No</th>
                <th>Resumen</th>
                <th>Verificable interno</th>
                <th width="280px">Acción</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

{{-- Modal para ingreso de actividades --}}
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="activityForm" name="activityForm" class="form-horizontal" enctype="multipart/form-data">

                   <input type="hidden" name="activity_id" id="activity_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Id cumplimiento</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="fulfillment_id" name="fulfillment_id" placeholder="Id" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Resumen</label>
                        <div class="col-sm-12">
                            <textarea id="activity_summary" name="activity_summary" required="" placeholder="Resumen de actividades realizadas." class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Verificable</label>
                        <div class="col-sm-12">
                            <div class="custom-file">
                                <input name="evidence_file" type="file" class="custom-file-input" aria-describedby="inputGroupFileAddon01" lang="es">
                                <label class="custom-file-label" for="inputGroupFile01">Seleccionar archivo</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
        ajax: "{{ route('fulfillment_activities.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'activity_summary', name: 'activity_summary'},
            {
                data: 'evidence_file_path',
                name: 'evidence_file_path',
                render: function (data, type, row) {
                    let file_path = "{{ url('storage') }}" + "/" + data;
                    return '<a href="' + file_path + '">Ver</a>';
                },
            },
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

    $('#createNewActivity').click(function () {
        $('#saveBtn').val("create-activity");
        $('#activity_id').val('');
        $('#activityForm').trigger("reset");
        $('#modelHeading').html("Ingresar nueva actividad");
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editActivity', function () {
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

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        //$(this).html('Pensando..');

        let url;

        // Get form
        let form = $('#activityForm')[0];

        var data = new FormData(form);
       

        data.get('activity_id');

        if ($('#saveBtn').val() == 'create-activity') {
            url = "{{ route('fulfillment_activities.store') }}";
        } else {
            url = "{{ route('fulfillment_activities.index') }}" + '/' + data.get('activity_id');
            data.append('_method', 'PATCH');
        }

        console.warn(data);
        $.ajax({
          data,
          url,
          type: 'POST',
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function (data) {

            $('#activityForm').trigger("reset");
            $('#ajaxModel').modal('hide');
            table.draw();
            $('#saveBtn').html('Guardar');

          },
          error: function (error) {
              $('#activityForm').trigger("reset");
              console.error('Error:', error);

          }
      });
    });

    $('body').on('click', '.deleteActivity', function () {

        var activity_id = $(this).data("id");
        confirm("¿Está seguro de que desea eliminar la actividad?");

        $.ajax({
            type: "DELETE",
            url: "{{ route('fulfillment_activities.store') }}"+'/'+activity_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

  });
</script>
@endsection

@endsection
