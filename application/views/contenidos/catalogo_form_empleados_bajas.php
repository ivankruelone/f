  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_empleados_bajas');
    echo form_open('catalogo/agrega_empleados_bajas', $atributos);
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
	<td colspan="3">FECHA DE BAJA DE LABORES: <?php echo form_input($data_fecha_i, "", 'required');?></td>
</tr>
<tr>
    <td colspan="3">CAUSA: <?php echo form_input($data_causa, "", 'required');?></td>

</tr>
<tr>
	<td colspan="3">AUTORIZA: <?php echo form_input($data_autoriza, "", 'required');?></td>
</tr>
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
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
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
var correo = $('#correo').attr("value");
    $('#catalogo_form_empleados_bajas').submit(function() {
        
        
        var id_nom = $('#id_nom').attr("value").length;
        var causa = $('#causa').attr("value").length;
        var autoriza = $('#autoriza').attr("value").length;
        
        if(autoriza>0 && causa>0  && id_nom>0){
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