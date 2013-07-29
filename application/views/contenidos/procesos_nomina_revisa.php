  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'procesos_nomina_revisa');
    echo form_open('procesos/sumit_tabla_prenomina_revisa', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id
$data_fecha = array(
              'name'        => 'fecha',
              'id'          => 'fecha',
              'type'        => 'date'
            );
    ?>
  
  <table>
  
<tr>
	<th align="center" ><font size="+1">HISTORICO DE MOVIMIENTOS CAPTURADOS POR EL SUPERVISOR</font></th>
</tr>
<tr>
	<td align="center"><?php echo form_dropdown('motivo', $motivox, '', 'id="motivo"') ;?> </td>
</tr>

<tr>
    <td colspan="2">FECHA: <?php echo form_input($data_fecha, "", 'required').'AAAA-MM-DD'; ?></td>
</tr>
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Ver');?></td>
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
   
   
   
   $(function() {
		$( "#fecha" ).datepicker();
	});
     
    $('#motivo').blur(function(){
            motivo = $('#motivo').attr("value");
     });
/////////////////////////////////////////////////


    $('#procesos_nomina_revisa').submit(function() {
        var motivo = $('#motivo').attr("value").length;
          if( motivo>0){

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