  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'recursos_humanos_form_empleados_captura');
    echo form_open('recursos_humanos/tabla_empleados_agrega_ab', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id
    ?>
  
  <table>
<th colspan="3">CAPTURA DE MOVIMIENTOS</th>
<tr>
	<td colspan="3" align="center" ><font size="+1">SELECCIONAR EL MOVIMIENTO A REALIZAR</font></td>
</tr>

<tr>
<td colspan="3" align="center" ><font size="+1"><?php echo form_dropdown('motivo', $motx, '', 'id="motivo"') ;?> </td>
</tr>
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>

</table>

<?php echo $tabla  ?>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#motivo").focus();
    });
    
    $(document).ready(function(){
  

    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#recursos_humanos_form_empleados_captura').submit(function() {
        
         motivo = $('#motivo').attr("value").length;
          if( motivo > 0){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#usuario').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>