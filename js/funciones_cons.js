/* CAMBIO TOTAL:
Este archivo ya no necesita las funciones:
- agregardatosSerializados
- agregaform
- actualizaDatos
- preguntarSiNo
- eliminarDatos

Solo se usará el script en 'index_cons.php' para cargar la tabla.
Si quieres mantener este archivo, puedes dejarlo vacío o 
mover el script de carga de 'index_cons.php' aquí:
*/

$(document).ready(function(){
	$('#tabla').load('componentes/tabla_cons.php');
});