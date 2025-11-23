// Dentro de funciones_asigtal.js
function agregardatosSerializados(datos){
    $.ajax({
        // ...
        success:function(r){
            var respuesta = $.trim(r);       // Limpia espacios (ej: " 122 ")
            var id_asignado = parseInt(respuesta); // Convierte a número (ej: 122)

            if(id_asignado > 0){ 
                // Esto es éxito (cualquier ID positivo)
                $('#tabla').load('componentes/tabla_asig.php');
				$('#ultimoIDAsignado').text(id_asignado);
        		$('#mensajeExito').fadeIn(500).delay(5000).fadeOut(500);
                alertify.success("¡Asignación guardada con éxito! ID asignado: " + id_asignado); 
                $('#modalNuevo').modal('hide');
                $('#frmnuevo')[0].reset();
            } else {
                // Esto es fallo (0, NaN, o un mensaje de error)
                alertify.error("Fallo el servidor :( Razón: " + r);
            }
        }
    });
}

// Rellena el modal de edición, ahora con el campo de ID visible y el oculto
function agregaform(datos){
	d=datos.split('||');

	// CAMBIO: 'idoriginal_u_hidden' guarda el ID original (oculto)
	$('#idoriginal_u_hidden').val(d[0]); 
	// CAMBIO: 'id_asignacion_u' es el campo visible que se puede editar
	$('#id_asignacion_u').val(d[0]);      
	
	$('#matricula_u').val(d[1]);          // matricula
	$('#nombre_act_u').val(d[2]); 		  // nombre_act
	$('#estado_u').val(d[3]);             // estado
	$('#puntos_u').val(d[4]);             // puntos
}

// Envía el ID original y el ID nuevo (que puede ser el mismo o no)
function actualizaDatos(){

	// CAMBIO: Se obtienen ambos IDs
	idoriginal=$('#idoriginal_u_hidden').val(); 
	id_asignacion=$('#id_asignacion_u').val(); // ID (potencialmente) nuevo
	
	matricula=$('#matricula_u').val(); 
	nombre_act=$('#nombre_act_u').val();
	estado=$('#estado_u').val();
	puntos=$('#puntos_u').val();

	// CAMBIO: Cadena de datos incluye 'idoriginal' y 'id_asignacion'
	cadena= "idoriginal=" + idoriginal +
	        "&id_asignacion=" + id_asignacion + 
			"&matricula=" + matricula +
			"&nombre_act=" + nombre_act + 
			"&estado=" + estado +
			"&puntos=" + puntos;

	$.ajax({
		type:"POST",
		url:"php/actualizarDatos_asigtal.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('componentes/tabla_asigtal.php');
				alertify.success("Actualizado con exito :)");
			}else{
				alertify.error("Fallo el servidor :( Razón: " + r);
			}
		}
	});
}