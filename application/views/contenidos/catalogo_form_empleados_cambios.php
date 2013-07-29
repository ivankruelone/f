  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_empleados_cambios');
    echo form_open('catalogo/tabla_empleados_cambios', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id

$data_fecha_i = array(
              'name'        => 'fecha_i',
              'id'          => 'fecha_i',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
$data_autoriza = array(
              'name'        => 'autoriza',
              'id'          => 'autoriza',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
            );
$data_causa = array(
              'name'        => 'causa',
              'id'          => 'causa',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
            );
    ?>
  
  <table>
<th colspan="3">CONTROL  DE <?php echo $motivo?>  DE NOMINAS</th>
<tr>
	<td colspan="3" align="center" ><font size="+1">NOMBRE DEL PATRON O RAZON SOCIAL</font></td>
</tr>
<tr>
<td colspan="3" align="center" ><font size="+1"><?php echo form_dropdown('id_nom', $id_nomx, '', 'id="id_nom"') ;?> </td>
</tr>
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Secelccionar');?></td>
</tr>
<input type="hidden" value="<?php echo $motivo ?>" name="motivo" id="motivo" />

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
        $("#id_nom").focus();
    });
    
    $(document).ready(function(){
    
    $('#id_nom').blur(function(){
            id_nom = $('#id_nom').attr("value");
     });
/////////////////////////////////////////////////


    $('#catalogo_form_empleados_cambios').submit(function() {
        var id_nom = $('#id_nom').attr("value").length;
          if( id_nom>0){

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