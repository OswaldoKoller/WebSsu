$('.bt-edit').on('click',function(){
    $tr = $(this).closest('tr');
    let datos= $tr.children("td").map(function(){
        return $(this).text();
    });
    $('#id_persona').val(datos[0]);
    $('#nombre_persona').val(datos[1]);
    $('#apellido_persona').val(datos[2]);
    $('#telefono').val(datos[3]);
    $('#direccion').val(datos[4]);
    $('#id_usuario').val(datos[5]);
    $('#nombre_usuario').val(datos[6]);
})