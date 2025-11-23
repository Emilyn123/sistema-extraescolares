// ELIMINA LA FUNCIÓN agregardatos(id_tallerista_n, nombre, apellido, telefono)
// Y SUSTITÚYELA POR LA SIGUIENTE FUNCIÓN QUE USA SERIALIZE
function agregardatosSerializados(datos){ 

    // 'datos' ya es la cadena serializada: id_tallerista=X&nombre=Y...
	cadena = datos; 

	$.ajax({
		type:"POST",
		url:"php/agregarDatos.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('componentes/tabla.php');
				$('#modalNuevo').modal('hide'); 
				alertify.success("agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :( Razón: " + r);
			}
		}
	});
}
// MANTÉN EL RESTO DE FUNCIONES (agregaform, actualizaDatos, etc.) INTACTAS
// ... dentro de funciones.js

function agregaform(datos){
	d=datos.split('||');

	$('#idoriginal').val(d[0]); // ID original (oculto)
    $('#idtallu').val(d[0]);      // ID en el campo editable (nuevo ID)
	$('#nombreu').val(d[1]);
	$('#apellidou').val(d[2]);
	$('#telefonou').val(d[3]);	
}

// ... dentro de funciones.js

function actualizaDatos(){

    // ID del registro que estamos editando (el original)
	idoriginal=$('#idoriginal').val(); 
    // NUEVO ID que el usuario quiere asignar
    idtallu=$('#idtallu').val(); 
    
	nombre=$('#nombreu').val();
	apellido=$('#apellidou').val();
	telefono=$('#telefonou').val();

    // Enviamos el ID original, el nuevo ID y los demás datos
	cadena= "idoriginal=" + idoriginal + 
            "&idtallu=" + idtallu + 
			"&nombre=" + nombre + 
			"&apellido=" + apellido +
			"&telefono=" + telefono;

	$.ajax({
		type:"POST",
		url:"php/actualizaDatos.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				$('#tabla').load('componentes/tabla.php');
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

	// La clave 'id' debe coincidir con el $_POST en eliminarDatos.php
	cadena="id=" + id;

		$.ajax({
			type:"POST",
			url:"php/eliminarDatos.php",
			data:cadena,
			success:function(r){
				if(r==1){
					$('#tabla').load('componentes/tabla.php');
					alertify.success("Eliminado con exito!");
				}else{
					alertify.error("Fallo el servidor :( Razón: " + r);
				}
			}
		});
}