{{-- si está en clientes index --}}
@if (Request::route()->getName()=='clientes.index')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            "serverSide": true,
            "ajax": "{{route('clientes.index')}}",
            "columns": [{
                    data: "nombre"
                },
                {
                    data: 'tipo'
                },
                {
                    data: 'email'
                },
                {
                    data: 'telefono'
                },
                {
                    data: 'direccion'
                },
                {
                    data: 'btn'
                },
            ],
            "language": {
                "info": "_TOTAL_ Registros",
                "search": "Buscar",
                "paginate": {
                    "next": "siguiente",
                    "previous": "anterior"
                },
                "lengthMenu": 'Mostrar<select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> registros',
                "emptyTable": "No hay datos",
                "zeroRecords": "Sin resultados",
            }
        });
    });
</script>
@endif

{{-- si está en clientes show --}}
@if (Request::route()->getName()=='clientes.show')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            "serverSide": true,
            "ajax": "{{Request::url()}}",
            "columns": [{
                    data: "numero_serie"
                },
                {
                    data: 'part_number'
                },
                {
                    data: 'incidencia'
                },
                {
                    data: 'modelo'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'marca'
                },
                {
                    data: 'modelo'
                },
                {
                    data: 'almacen'
                },
                {
                    data: 'btn'
                },
            ],
            "language": {
                "info": "_TOTAL_ Registros",
                "search": "Buscar",
                "paginate": {
                    "next": "siguiente",
                    "previous": "anterior"
                },
                "lengthMenu": 'Mostrar<select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> registros',
                "emptyTable": "No hay datos",
                "zeroRecords": "Sin resultados",
            }
        });
    });
</script>
@endif

{{-- si está en productos index --}}
@if (Request::route()->getName()=='producto.index')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            "serverSide": true,
            "ajax": "{{route('producto.index')}}",
            "columns": [{
                    data: "numero_serie"
                },
                {
                    data: 'part_number'
                },
                {
                    data: 'incidencia'
                },
                {
                    data: 'modelo'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'marca'
                },
                {
                    data: 'cantidad'
                },
                {
                    data: 'cliente'
                },
                {
                    data: 'almacen'
                },
                {
                    data: 'btn'
                },
            ],
            "language": {
                "info": "_TOTAL_ Registros",
                "search": "Buscar",
                "paginate": {
                    "next": "siguiente",
                    "previous": "anterior"
                },
                "lengthMenu": 'Mostrar<select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> registros',
                "emptyTable": "No hay datos",
                "zeroRecords": "Sin resultados",
            }
        });
    });
</script>
@endif

{{-- si está en almacenes show --}}
@if (Request::route()->getName()=='almacenes.show')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            "serverSide": true,
            "ajax": "{{Request::url()}}",
            "columns": [{
                    data: "numero_serie"
                },
                {
                    data: 'part_number'
                },
                {
                    data: 'incidencia'
                },
                {
                    data: 'modelo'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'marca'
                },
                {
                    data: 'cantidad'
                },
                {
                    data: 'cliente'
                },
                {
                    data: 'btn'
                },
            ],
            "language": {
                "info": "_TOTAL_ Registros",
                "search": "Buscar",
                "paginate": {
                    "next": "siguiente",
                    "previous": "anterior"
                },
                "lengthMenu": 'Mostrar<select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> registros',
                "emptyTable": "No hay datos",
                "zeroRecords": "Sin resultados",
            }
        });
    });
</script>
@endif


{{-- si está en users index --}}
@if (Request::route()->getName()=='user.index')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            "serverSide": true,
            "ajax": "{{route('user.index')}}",
            "columns": [{
                    data: "name"
                },
                {
                    data: 'email'
                },
                {
                    data: 'btn'
                },
            ],
            "language": {
                "info": "_TOTAL_ Registros",
                "search": "Buscar",
                "paginate": {
                    "next": "siguiente",
                    "previous": "anterior"
                },
                "lengthMenu": 'Mostrar<select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> registros',
                "emptyTable": "No hay datos",
                "zeroRecords": "Sin resultados",
            }
        });
    });
</script>
@endif


{{-- si está en roles show --}}
@if (Request::route()->getName()=='user.show')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            "serverSide": true,
            "ajax": "{{Request::url()}}",
            "columns": [{
                    data: "name"
                },
                {
                    data: 'slug'
                },
                {
                    data: 'description'
                },
                {
                    data: 'btn'
                },
            ],
            "language": {
                "info": "_TOTAL_ Registros",
                "search": "Buscar",
                "paginate": {
                    "next": "siguiente",
                    "previous": "anterior"
                },
                "lengthMenu": 'Mostrar<select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> registros',
                "emptyTable": "No hay datos",
                "zeroRecords": "Sin resultados",
            }
        });
    });
</script>
@endif

{{-- si está en roles index --}}
@if (Request::route()->getName()=='roles.index')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').DataTable({
            "serverSide": true,
            "ajax": "{{route('roles.index')}}",
            "columns": [{
                    data: "name"
                },
                {
                    data: "description"
                },
                {
                    data: "btn"
                },
            ],
            "language": {
                "info": "_TOTAL_ Registros",
                "search": "Buscar",
                "paginate": {
                    "next": "siguiente",
                    "previous": "anterior"
                },
                "lengthMenu": 'Mostrar<select>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">Todos</option>' +
                    '</select> registros',
                "emptyTable": "No hay datos",
                "zeroRecords": "Sin resultados",
            }
        });
    });
</script>
@endif
