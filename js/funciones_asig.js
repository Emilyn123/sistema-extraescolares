// Esta función usa serialize() y funciona con el nuevo formulario
function agregardatosSerializados(datos){ 


	$.ajax({
		type:"POST",
		url:"php/agregarDatos_asig.php", 
		data:datos,
		success:function(r){
			var id_generada = parseInt(r.trim());
			if(r==1){
				$('#tabla').load('componentes/tabla_asigtal.php');
				$('#modalNuevo').modal('hide'); 
				alertify.success("Agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :( Razón: " + r);
			}
		}
	});
}

// Esta función rellena el modal de edición con 6 campos
function agregaform(datos){
	d=datos.split('||');

	$('#idoriginal').val(d[0]); 	  // id_asignacion (oculto)
	$('#id_asignacion_u').val(d[0]);  // id_asignacion
	$('#id_tallerista_u').val(d[1]);  // id_tallerista
	$('#matricula_u').val(d[2]); 	  // matricula
	$('#nombre_act_u').val(d[3]); 	  // nombre_act
	$('#estado_u').val(d[4]);         // estado
	$('#puntos_u').val(d[5]);         // puntos
}

// Esta función envía los datos actualizados
function actualizaDatos(){

	idoriginal=$('#idoriginal').val(); 
	id_asignacion_u=$('#id_asignacion_u').val();
	id_tallerista_u=$('#id_tallerista_u').val(); // <-- Campo de 6 datos

	matricula=$('#matricula_u').val();
	nombre_act=$('#nombre_act_u').val();
	estado=$('#estado_u').val();
	puntos=$('#puntos_u').val();

	// Cadena de datos (Ahora con 6 campos + el original)
	cadena= "idoriginal=" + idoriginal + 
			"&id_asignacion=" + id_asignacion_u + 
			"&id_tallerista=" + id_tallerista_u + // <-- Campo de 6 datos
			"&matricula=" + matricula + 
			"&nombre_act=" + nombre_act +
			"&estado=" + estado +
			"&puntos=" + puntos;

	$.ajax({
		type:"POST",
		url:"php/actualizarDatos_asig.php", 
		data:cadena,
		success:function(r){
			
			// CAMBIO: r.trim() corrige el error
			if(r.trim() == "1"){
				$('#tabla').load('componentes/tabla_asig.php'); 
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

	cadena="id=" + id; 

		$.ajax({
			type:"POST",
			url:"php/eliminarDatos_asig.php", 
			data:cadena,
			success:function(r){
				
				// CAMBIO: r.trim() corrige el error
				if(r.trim() == "1"){
					$('#tabla').load('componentes/tabla_asig.php'); 
					alertify.success("Eliminado con exito!");
				}else{
					alertify.error("Fallo el servidor :( Razón: " + r);
				}
			}
		});
}