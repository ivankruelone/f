  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_empleados_cambios_1');
    echo form_open('catalogo/cambia_empleados_archi', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id

$data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'value'       => $rfc,
              'maxlength'   => '20',
              'size'        => '20',
             
            );
$data_curp = array(
              'name'        => 'curp',
              'id'          => 'curp',
              'value'       => $curp,
              'maxlength'   => '20',
              'size'        => '20',
              
            );
$data_afilia = array(
              'name'        => 'afilia',
              'id'          => 'afilia',
              'value'       =>$rfc,
              'maxlength'   => '20',
              'size'        => '20',
              
            );
$data_registro_pat = array(
              'name'        => 'registro_pat',
              'id'          => 'registro_pat',
              'value'       => $registro_pat,
              'maxlength'   => '20',
              'size'        => '20',
              
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
  
<tr>
<th colspan="3"><font size="+1">CONTROL  DE <?php echo $motivo?>  DE NOMINAS<font size="+1"></th>
</tr>
<tr>
<td colspan="3"><font size="+1">EMPLEADO.: <?php echo $nomina." ".$id_nomx?></font></td>
</tr>
<tr>
<td colspan="1" align="left" ><font size="+1">COMPA&Ntilde;IA.:</font></td>
<td colspan="2" align="left" ><?php echo $cia_act?></td>
</tr>

<tr>
<td colspan="1" align="left" ><font size="+1">SUCURSAL.:</font></td>
<td colspan="1"><?php echo $suc_act." ".$sucursal?></td>
<td colspan="1" align="center" ><font size="+1"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
<td colspan="1" align="left" ><font size="+1">PUESTO.:</font></td>
<td colspan="2"><?php echo $pue_act." ".$puestox?></td>

</tr>
<tr>
    <td>RFC:<?php echo $rfc;?></td>
	<td>CURP: <?php echo$curp?></td>
	<td>No. DE AFILIACION:<?php echo $afilia?></td>
</tr> 
<tr>
    <td colspan="1">REGISTRO PATRONAL: <?php echo $registro_pat?></td>
	<td colspan="2">AUTORIZA: <?php echo form_input($data_autoriza, "", 'required');?></td>
</tr>
<tr>
    <td colspan="3">CAUSA: <?php echo form_input($data_causa, "", 'required');?></td>

</tr>
<tr>

</tr>
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Cambiar');?></td>
</tr>
<input type="hidden" value="<?php echo $id_nom ?>" name="id_nom" id="id_nom" />
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


    $('#catalogo_form_empleados_cambios_1').submit(function() {
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