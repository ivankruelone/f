  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'juridico_form_rentas_cambia');
    echo form_open('juridico/cambia_rentas', $atributos);
    $data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'value'       => $rfc,
              'maxlength'   => '15',
              'size'        => '15'
            );
$data_imp = array(
              'name'        => 'imp',
              'id'          => 'imp',
              'value'       => $imp,
              'maxlength'   => '11',
              'size'        => '11'
              
              
            );
$data_diferencia = array(
              'name'        => 'diferencia',
              'id'          => 'diferencia',
              'value'       => $diferencia,
              'maxlength'   => '11',
              'size'        => '11'
              
              
            );
    $data_nom = array(
              'name'        => 'nom',
              'id'          => 'nom',
              'value'       => $nom,
              'maxlength'   => '70',
              'size'        => '70'
            );
  $data_icedular = array(
              'name'        => 'icedular',
              'id'          => 'icedular',
              'value'       => $icedular,
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_contrato = array(
              'name'        => 'contrato',
              'id'          => 'contrato',
              'value'       => $contrato,
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
      $data_fecha_termino = array(
              'name'        => 'fecha_termino',
              'id'          => 'fecha_termino',
              'value'       => $fecha_termino,
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
      $data_cierre = array(
              'name'        => 'cierre',
              'id'          => 'cierre',
              'value'       => $cierre,
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
      $data_incremento = array(
              'name'        => 'incremento',
              'id'          => 'incremento',
              'value'       => $incremento,
              'maxlength'   => '7',
              'size'        => '7'
             
            );
      $data_expediente = array(
              'name'        => 'expediente',
              'id'          => 'expediente',
              'value'       => $expediente,
              'maxlength'   => '7',
              'size'        => '7'
             
            );
            $data_motivo_cierre = array(
              'name'        => 'motivo_cierre',
              'id'          => 'motivo_cierre',
              'value'       => $motivo_cierre,
              'maxlength'   => '50',
              'size'        => '50'
             
            );
      $data_observacion = array(
              'name'        => 'observacion',
              'id'          => 'observacion',
              'value'       => $observacion,
              'maxlength'   => '200',
              'size'        => '70'
             
            );
  ?>
  
  <table>
<th colspan="2">AGREGAR ARRENDADOR </th>
<tr>
	<td align="left" ><font size="+1">SUCURSAL: </font></td>
	<td align="left"><font size="+1"><?php	echo $suc_a." - ".$nombre?></font><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">PERSONA: </font></td>
    <td align="left"> 
    <select name="auxi" id="auxi">
    <option value="7003" <?php if($auxi=='7003') echo "Selected"?> >FISICA</option>
    <option value="7004" <?php if($auxi=='7004') echo "Selected"?> >MORAL</option>
    </select>
    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">RFC: </font></td>
    <td><?php echo form_input($data_rfc, "", 'required');?></td>
</tr> 
<tr>
	<td align="left" ><font size="+1">ARRENDATARIO: </font></td>
	<td><?php echo form_input($data_nom, "", 'required');?></td>
    </select> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">IMPORTE: </font></td>
	<td><?php echo form_input($data_imp, "", 'required');?>
    <font size="+1">DIFERENCIA.: </font>
	<?php echo form_input($data_diferencia, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">PAGO: </font></td>
    <td align="left"> 
    <select name="pago" id="pago">
    <option value="MN" <?php if($pago=='MN') echo "Selected"?> >MONEDA NACIONAL</option>
    <option value="USD" <?php if($pago=='USD') echo "Selected"?> ><strong>DOLAR</strong></option>
    </select>
	<font size="+1">EN: </font>
    <select name="tipo_pago" id="tipo_pago">
    <option value="DEPOSITO" > <?php if($tipo_pago=='DEPOSITO')?>DEPOSITO</option>
    <option value="CHEQUE" > <?php if($tipo_pago=='CHEQUE')?>CHEQUE</option>
    </select>
    </td>
</tr>
    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">FECHA DE CONTRATO: </font></td>
	<td><?php echo form_input($data_contrato, "", 'required');?>
	<font size="+1">TERMINO DE CONTRATO: </font>
	<?php echo form_input($data_fecha_termino, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">INCREMENTO ANUAL: </font></td>
	<td><?php echo form_input($data_incremento, "", 'required');?></td>
    
</tr>
<tr>
<td align="left" ><font size="+1">IMPUESTO CEDULAR: </font></td>
<td><?php echo form_input($data_icedular, "", '');?> <strong>%</strong>
	<font size="+1">REDONDEO: <?php echo $redondeo?></font>
     <select name="redon" id="redon">
    <option value="0.00" <?php if($redon=='0.00') echo "Selected"?> >0.00</option>
    <option value="0.01" <?php if($redon=='0.01') echo "Selected"?> >0.01</option>
    <option value="0.02" <?php if($redon=='0.02') echo "Selected"?> >0.02</option>
    <option value="-0.01" <?php if($redon=='-0.01') echo "Selected"?> ><strong>-0.01</strong></option>
    <option value="-0.02" <?php if($redon=='-0.02') echo "Selected"?> ><strong>-0.02</strong></option>
    </select>
    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">EXPEDIENTE</font></td>
	<td><?php echo form_input($data_expediente, "", 'required');?>
    <font size="+1">ENTREGA LOCAL.: </font><?php echo form_input($data_cierre, "", 'required');?></td>
</tr>

<tr>
	<td align="left" colspan="1"><font size="+1">MOTIVO</font></td>
    <td><?php echo form_input($data_motivo_cierre, "", 'required');?></td>
</tr>
<tr>
    <td align="left" colspan="1"><font size="+1">OBSERVACION</td>
    <td></font><?php echo form_input($data_observacion, "", 'required');?></td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Cambiar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
<input type="hidden" value="<?php echo $suc_a ?>" name="suc_a" id="suc_a" />
<?php echo $tabla  ?>

  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#suc").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
var correo = $('#correo').attr("value");
    $('#juridico_form_rentas_cambia').submit(function() {
        var suc = $('#suc').attr("value");
        var rfc = $('#rfc').attr("value").length;
        var nom = $('#nom').attr("value").length;
        var imp = $('#imp').attr("value").length;
        var pago = $('#pago').attr("value").length;
        var auxi = $('#auxi').attr("value").length;
     
          if( nom>0 && imp>0){
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