
function agregardatosSerializados(datos){ 
	cadena = datos; 
	$.ajax({
		type:"POST",
		url:"php/agregarDatos_regtal.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('componentes/tabla_regtal.php');
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
	$('#id_registro_original').val(d[0]); // id_original (oculto)
	$('#id_registro_u').val(d[0]);      // id_registro (visible)
	$('#matricula_u').val(d[1]);	    // matricula
	$('#id_actividad_u').val(d[2]);	    // id_actividad
	$('#nombre_act_u').val(d[3]); 	    // nombre_act
	$('#nombrea_u').val(d[4]);		    // nombrea
	$('#apellidoa_u').val(d[5]);	    // apellidoa
	$('#carrera_u').val(d[6]);		    // carrera
	$('#semestre_u').val(d[7]);		    // semestre
}


function actualizaDatos(){

	id_original=$('#id_registro_original').val();
	id_nuevo=$('#id_registro_u').val(); 
	matricula=$('#matricula_u').val(); 
	id_actividad=$('#id_actividad_u').val();
	nombre_act=$('#nombre_act_u').val();
	nombrea=$('#nombrea_u').val();
	apellidoa=$('#apellidoa_u').val();
	carrera=$('#carrera_u').val();
	semestre=$('#semestre_u').val();

	cadena= "id_original=" + id_original +
			"&id_registro=" + id_nuevo + 
			"&matricula=" + matricula +
			"&id_actividad=" + id_actividad + 
			"&nombre_act=" + nombre_act +
			"&nombrea=" + nombrea +
			"&apellidoa=" + apellidoa +
			"&carrera=" + carrera +
			"&semestre=" + semestre;

	$.ajax({
		type:"POST",
		url:"php/actualizarDatos_regtal.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('componentes/tabla_regtal.php');
				alertify.success("Actualizado con exito :)");
			}else{
				alertify.error("Fallo el servidor :( Razón: " + r);
			}
		}
	});
}