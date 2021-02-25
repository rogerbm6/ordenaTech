@if (session('eliminar') == 'si')
<script>
    Swal.fire(
            '¡Eliminado!',
            'Se eliminó con éxito',
            'success'
            );    
</script>
@endif

<script>

$('.eliminar').submit(function(e){
    console.log('si');
    e.preventDefault();

    Swal.fire({
    title: '¿Estás seguro?',
    text: "Se eliminará por completo!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!',
    cancelButtonText: 'cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
            
        }
    });
});

</script>