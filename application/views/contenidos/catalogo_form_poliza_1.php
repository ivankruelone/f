  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'catalogo_form_poliza_1');
    echo form_open('catalogo/cambio_c_poliza', $atributos);
    $data_cuenta = array(
              'name'        => 'cuenta',
              'id'          => 'cuenta',
              'value'       => $cuenta,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
              
              
            );
    $data_auxi = array(
              'name'        => 'auxi',
              'id'          => 'auxi',
              'value'       => $auxi,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'       =>'5'
              
            );
    $data_cuenta_ivar = array(
              'name'        => 'cuenta_ivar',
              'id'          => 'cuenta_ivar',
              'value'       => $cuenta_ivar,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
            );
    $data_cuenta_iva = array(
              'name'        => 'cuenta_iva',
              'id'          => 'cuenta_iva',
              'value'       => $cuenta_iva,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
            );
    $data_cuenta_isr = array(
              'name'        => 'cuenta_isr',
              'id'          => 'cuenta_isr',
              'value'       => $cuenta_isr,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
            );
    $data_cuenta_varios = array(
              'name'        => 'cuenta_varios',
              'id'          => 'cuenta_varios',
              'value'       => $cuenta_varios,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
            );
   $data_auxi_ivar = array(
              'name'        => 'auxi_ivar',
              'id'          => 'auxi_ivar',
              'value'       => $auxi_ivar,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
            );
   $data_auxi_iva = array(
              'name'        => 'auxi_iva',
              'id'          => 'auxi_iva',
              'value'       => $auxi_iva,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
            );
  $data_auxi_isr = array(
              'name'        => 'auxi_isr',
              'id'          => 'auxi_isr',
              'value'       => $auxi_isr,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
            );
  $data_auxi_varios = array(
              'name'        => 'auxi_varios',
              'id'          => 'auxi_varios',
              'value'       => $auxi_varios,
              'maxlength'   => '5',
              'type'        => 'number',
              'size'        => '5'
            );
   $data_descri = array(
              'name'        => 'descri',
              'id'          => 'descri',
              'value'       => $descri,
              'maxlength'   => '50',
              'size'        => '50'
            );  
  ?>
  
  <table>
<th colspan="4">AGREGAR POLIZA</th>
<tr>
	<td  align="left" ><font size="+1">Descripcion: </font></td>
	<td colspan="3"><?php echo form_input($data_descri, "", 'required');?></td>
 </tr>
<tr>
	<td  align="left" ><font size="+1">Poliza: </font></td>
	<td><?php echo form_input($data_cuenta, "", 'required');?></td>
	<td  align="left" ><font size="+1">Auxiliar: </font></td>
	<td><?php echo form_input($data_auxi, "", 'required');?></td>
 </tr>
<tr>
	<td align="left" ><font size="+1">Poliza Iva: </font></td>
	<td><?php echo form_input($data_cuenta_iva, "", 'required');?></td>
	<td align="left" ><font size="+1">Auxiliar Iva: </font></td>
    <td><?php echo form_input($data_auxi_iva, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">Poliza Iva Retenido: </font></td>
	<td><?php echo form_input($data_cuenta_ivar, "", 'required');?></td>
	<td align="left" ><font size="+1">Auxiliar Iva retenido: </font></td>
		<td><?php echo form_input($data_auxi_ivar, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Poliza ISR: </font></td>
	<td><?php echo form_input($data_cuenta_isr, "", 'required');?></td>
	<td align="left" ><font size="+1">Auxiliar ISR: </font></td>
	<td><?php echo form_input($data_auxi_isr, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Poliza Varios: </font></td>
	<td><?php echo form_input($data_cuenta_varios, "", 'required');?></td>
	<td align="left" ><font size="+1">Auxiliar Varios: </font></td>
	<td><?php echo form_input($data_auxi_varios, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Iva: </font></td>
    <td align="left" colspan="3"> 
    <select name="iva" id="iva">
    <option value="S" <?php if($iva=='S') echo "Selected"?> >SI</option>
    <option value="N" <?php if($iva=='N') echo "Selected"?> >NO</option>
    </select>
    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">Activo: </font></td>
    <td align="left" colspan="3"> 
    <select name="activo" id="activo">
    <option value="1" <?php if($activo=='1') echo "Selected"?> >Activo</option>
    <option value="0" <?php if($activo=='0') echo "Selected"?> >Inactivo</option>
    </select>
    </td>
</tr>
<tr>
	<td colspan="4" align="center"><?php echo form_submit('envio', 'Cambiar Poliza');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#descri").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#catalogo_form_poliza_1').submit(function() {
       
        var descri = $('#descri').attr("value").length;
        var cuenta = $('#cuenta').attr("value");
        var auxi = $('#auxi').attr("value");
        var activo = $('#activo').attr("value");
      alert(activo);
      
          if(descri >0  && cuenta>0 && auxi>0){
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