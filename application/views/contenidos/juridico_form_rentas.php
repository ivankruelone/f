  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'juridico_form_rentas');
    echo form_open('juridico/agrega_rentas', $atributos);
    $data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
$data_imp = array(
              'name'        => 'imp',
              'id'          => 'imp',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
              
              
            );
    $data_nom = array(
              'name'        => 'nom',
              'id'          => 'nom',
              'value'       => '',
              'maxlength'   => '70',
              'size'        => '70'
            );
  $data_icedular = array(
              'name'        => 'icedular',
              'id'          => 'icedular',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
      $data_contrato = array(
              'name'        => 'contrato',
              'id'          => 'contrato',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
            );
       $data_incremento = array(
              'name'        => 'incremento',
              'id'          => 'incremento',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
             
            );
  ?>
  
  <table>
<th colspan="2">AGREGAR ARRENDATARIO </th>
<tr>
	<td align="left" ><font size="+1">SUCURSAL: </font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">PERSONA: </font></td>
    <td align="left"> 
    <select name="auxi" id="auxi">
    <option value="7003" > <?php if($auxi=='7003')?>Fisica</option>
    <option value="7004" > <?php if($auxi=='7004')?>Moral</option>
    </select>
    </td>
</tr>

<tr>
	<td align="left" ><font size="+1">RFC: </font></td>
    <td><?php echo form_input($data_rfc, "", 'required');?></td>
</tr> 
<tr>
	<td align="left" ><font size="+1">NOMBRE: </font></td>
	<td><?php echo form_input($data_nom, "", 'required');?></td>
    </select> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">IMPORTE: </font></td>
	<td><?php echo form_input($data_imp, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">PAGO: </font></td>
    <td align="left"> 
    <select name="pago" id="pago">
    <option value="MN"> <?php if($pago=='MN')?>MONEDA NACIONAL</option>
    <option value="USD"> <?php if($pago=='USD')?><strong>DOLAR</strong></option>
    </select>
    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">FECHA DE CONTRATO: </font></td>
	<td><?php echo form_input($data_contrato, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">INCREMENTO ANUAL: </font></td>
	<td><?php echo form_input($data_incremento, "", 'required');?></td>
</tr>
<tr>
<td align="left" ><font size="+1">IMPUESTO CEDULAR: </font></td>
<td><?php echo form_input($data_icedular, "", '');?> <strong>%</strong></td>
</tr>
<tr>
	<td align="left" ><font size="+1">REDONDEO: </font></td>
    <td align="left"> 
    <select name="redon" id="redon">
    <option value="0.00"><?php if($redon=='0.00')?>0.00</option>
    <option value="0.01"><?php if($redon=='0.01')?>0.01</option>
    <option value="-0.01"><?php if($redon=='-0.01')?><strong>-0.01</strong></option>
    </select>
    </td>
</tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
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
        $("#suc").focus();
    });
    
    $(document).ready(function(){
    
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
var correo = $('#correo').attr("value");
    $('#juridico_form_rentas').submit(function() {
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