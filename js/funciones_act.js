// Esta función usa serialize() y funciona con el nuevo formulario
function agregardatosSerializados(datos){ 

	// 'datos' ya es la cadena serializada: id_actividad=X&id_tallerista=Y...
	cadena = datos; 

	$.ajax({
		type:"POST",
		url:"php/agregarDatos_act.php", // Ruta al PHP de agregar
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('componentes/tabla_act.php'); // Recarga la tabla
				$('#modalNuevo').modal('hide'); 
				alertify.success("Agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :( Razón: " + r);
			}
		}
	});
}

// Esta función rellena el modal de edición
function agregaform(datos){
	d=datos.split('||');

	// Asigna los 6 campos a los inputs del modal de edición
	$('#idoriginal').val(d[0]); 	  // ID original (oculto)
	$('#id_actividad_u').val(d[0]);   // id_actividad
	$('#id_tallerista_u').val(d[1]);  // id_tallerista
	$('#nombre_act_u').val(d[2]); 	  // nombre_act
	$('#fecha_inicio_u').val(d[3]);   // fecha_inicio
	$('#fecha_final_u').val(d[4]);    // fecha_final
	$('#puntuacion_u').val(d[5]);     // puntuacion
}

// Esta función envía los datos actualizados
function actualizaDatos(){

	// ID del registro que estamos editando (el original)
	idoriginal=$('#idoriginal').val(); 
	// NUEVO ID que el usuario quiere asignar (puede ser el mismo)
	id_actividad=$('#id_actividad_u').val(); 
	
	// El resto de los campos
	id_tallerista=$('#id_tallerista_u').val();
	nombre_act=$('#nombre_act_u').val();
	fecha_inicio=$('#fecha_inicio_u').val();
	fecha_final=$('#fecha_final_u').val();
	puntuacion=$('#puntuacion_u').val();

	// Cadena de datos con todos los campos
	cadena= "idoriginal=" + idoriginal + 
			"&id_actividad=" + id_actividad +
			"&id_tallerista=" + id_tallerista + 
			"&nombre_act=" + nombre_act +
			"&fecha_inicio=" + fecha_inicio +
			"&fecha_final=" + fecha_final +
			"&puntuacion=" + puntuacion;

	$.ajax({
		type:"POST",
		url:"php/actualizarDatos_act.php", // Ruta al PHP de actualizar
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('componentes/tabla_act.php'); // Recarga la tabla
				alertify.success("Actualizado con exito :)");
			}else{
				alertify.error("Fallo el servidor :( Razón: " + r);
			}
		}
	});
}

// Pregunta de confirmación
function preguntarSiNo(id){
	alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
					function(){ eliminarDatos(id) }
				, function(){ alertify.error('Se cancelo')});
}

// Elimina el dato
function eliminarDatos(id){

	// La clave 'id' debe coincidir con el $_POST en eliminarDatos_act.php
	cadena="id=" + id;

		$.ajax({
			type:"POST",
			url:"php/eliminarDatos_act.php", // Ruta al PHP de eliminar
			data:cadena,
			success:function(r){
				if(r==1){
					$('#tabla').load('componentes/tabla_act.php'); // Recarga la tabla
					alertify.success("Eliminado con exito!");
				}else{
					alertify.error("Fallo el servidor :( Razón: " + r);
				}
			}
		});
}