<h2 align="center">CAPTURA Y GENERACI&Oacute;N DE LA PRE NOMINA</h2>
<br />

<div align="center">
<span id="error" style="color: red; font-family: cursive;"></span>
<?php
	echo form_open('prenomina/submit_periodo', 'id="form_penomina"');
?>
<table>
<thead>
<th></th>
<th align="left">Periodo de trabajo</th>
</thead>

<tbody>
<tr>
<td>Quincena:</td>
<td><?php
    echo form_dropdown('quincena', $quincena, null, 'id="quincena"');
?>
</td>
</tr>

<tr>
<td>Mes:</td>
<td> <?php
    echo form_dropdown('mes', $mesx, null, 'id="mes"');
?></td>
</tr>

<tr>
<td>A&ntilde;o:</td>
<td> <?php
    echo form_dropdown('ano', $ano, null, 'id="ano"');
?></td>
</tr>
</tbody>
</table>


<input type="submit" value="Generar Periodo" class="button-link blue"/>
</div>

</form>

<div id="mostrar_periodo" align="center">
<?php
	echo $mostrar_periodo;
?>
</div>
<script language="javascript" type="text/javascript">

        $('#form_penomina').submit(function() {
            
            var quincena = $('#quincena').attr("value");
            var mes = $('#mes').attr("value");
            var ano = $('#ano').attr("value");
            
            if(quincena == 0){var texto1 = "Debes elegir una Quincena.";}else{ var texto1 = "";}
            if(mes == 0){var texto2 = "Debes elegir un mes valido.";}else{ var texto2 = "";}
            if(ano == 0){var texto3 = "Debes elegir un a" + "\u00f1" + "o valido.";}else{ var texto3 = "";}

    	  if(quincena != 0 && mes != 0 && ano != 0){
    	    
    	    if(confirm("¿ Seguro que deseas guardar ?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    //alert(texto1 + "\n" + texto2 + "\n" + texto3);
            $('#error').html(texto1 + "\n" + texto2 + "\n" + texto3);
    	    $('#quincena').focus();
    	    return false    

    	  }
    	}); 


</script>