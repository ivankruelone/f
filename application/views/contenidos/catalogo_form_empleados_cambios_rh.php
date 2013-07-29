  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_empleados_cambios_rh');
    echo form_open('recursos_humanos/cambia_empleados_rh', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id


$data_clave = array(
              'name'        => 'clave_rh',
              'id'          => 'clave_rh',
              'value'       => '',
              'maxlength'   => '33',
              'size'        => '33'
            );
$data_empleado = array(
              'name'        => 'empleado',
              'id'          => 'empleado',
              'value'       => '',
              'maxlength'   => '6',
              'size'        => '6'
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
<td colspan="2" align="left" ><?php echo $cia?></td>

</tr>

<tr>
<td colspan="1" align="left" ><font size="+1">SUCURSAL.:</font></td>
<td colspan="2"><?php echo $suc." ".$sucursal?></td>

</tr>
<tr>
<td colspan="1" align="left" ><font size="+1">PUESTO.:</font></td>
<td colspan="2"><?php echo $puestox?></td>

</tr>
<tr>
    <td>RFC:<?php echo $rfc ?></td>
	<td>CURP: <?php echo $curp ?></td>
	<td>No. DE AFILIACION:<?php echo $afilia;?></td>
</tr> 
<tr>
    <td colspan="1">REGISTRO PATRONAL: <?php echo $registro_pat?></td>
	<td colspan="2">AUTORIZA: <?php echo $autoriza?></td>
</tr>
<tr>
    <td colspan="3">CAUSA: <?php echo $causa?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">Clave: </font></td>
	<td colspan="1"><?php echo form_input($data_clave, "", 'required');?></td>
    <td colspan="1"> <?php echo $cla?></td>
</tr>
<?php
if($motivo=='ALTA'){	
?>
<tr>
	<td align="left" ><font size="+1">No. de nomina: </font></td>
	<td colspan="2"><?php echo form_input($data_empleado, "", 'required');?></td>
    
</tr>
<?php
    }
?>
<tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Cambiar');?></td>
</tr>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<input type="hidden" value="<?php echo $nomina?>" name="nomina" id="nomina" />
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


    $('#catalogo_form_empleados_cambios_rh').submit(function() {
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