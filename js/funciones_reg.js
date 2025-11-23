
function agregardatosSerializados(datos){ 
	cadena = datos; 
	$.ajax({
		type:"POST",
		url:"php/agregarDatos_reg.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('componentes/tabla_reg.php');
				$('#modalNuevo').modal('hide'); 
				alertify.success("Agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :( Razón: " + r);
			}
		}
	});
}


function agregaform(datos){
	d=datos.split('||');

	$('#id_registro_original').val(d[0]); 
	$('#id_registro_u').val(d[0]);      
	
	$('#matricula_u').val(d[1]);	
	$('#id_actividad_u').val(d[2]);	
	$('#id_tallerista_u').val(d[3]);
	$('#nombre_act_u').val(d[4]); 
	$('#nombrea_u').val(d[5]);		
	$('#apellidoa_u').val(d[6]);
	$('#carrera_u').val(d[7]);		
	$('#semestre_u').val(d[8]);		
}


function actualizaDatos(){

	// Leemos ambos IDs
	id_original=$('#id_registro_original').val();
	id_nuevo=$('#id_registro_u').val(); 
	
	matricula=$('#matricula_u').val(); 
	id_actividad=$('#id_actividad_u').val();
	id_tallerista=$('#id_tallerista_u').val();
	nombre_act=$('#nombre_act_u').val();
	nombrea=$('#nombrea_u').val();
	apellidoa=$('#apellidoa_u').val();
	carrera=$('#carrera_u').val();
	semestre=$('#semestre_u').val();

	
	cadena= "id_original=" + id_original +
			"&id_registro=" + id_nuevo + 
			"&matricula=" + matricula +
			"&id_actividad=" + id_actividad + 
			"&id_tallerista=" + id_tallerista +
			"&nombre_act=" + nombre_act +
			"&nombrea=" + nombrea +
			"&apellidoa=" + apellidoa +
			"&carrera=" + carrera +
			"&semestre=" + semestre;

	$.ajax({
		type:"POST",
		url:"php/actualizarDatos_reg.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('componentes/tabla_reg.php');
				alertify.success("Actualizado con exito :)");
			}else{
				alertify.error("Fallo el servidor :( Razón: " + r);
			}
		}
	});
}


function preguntarSiNo(id){
	alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
					function(){ eliminarDatos(id) } 
				, function(){ alertify.error('Se cancelo')});
}


function eliminarDatos(id){

	cadena="id_registro=" + id; 

		$.ajax({
			type:"POST",
			url:"php/eliminarDatos_reg.php",
			data:cadena,
			success:function(r){
				if(r==1){
					$('#tabla').load('componentes/tabla_reg.php');
					alertify.success("Eliminado con exito!");
				}else{
					alertify.error("Fallo el servidor :( Razón: " + r);
				}
			}
		});
}