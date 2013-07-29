<script type="text/javascript">
$(document).on("ready", inicio);
function inicio () 
{
	$("#fecha1").datepicker({ dateFormat: "yy-mm-dd", dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ], monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]});
	$("#fecha2").datepicker({ dateFormat: "yy-mm-dd", dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ], monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]});
}

$("#sanciones").on("submit", enviaSanciones);
function enviaSanciones(data)
{
    var fechas = $("#quincena option:selected").text();
    if(confirm("Estas seguro que deseas pasar las sanciones de este periodo: " + fechas + "?")){
        
    }else{
        data.preventDefault();
    }
}

</script>