  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cheques_form_leo_2');
    echo form_open('cheques/cambio_c', $atributos);
    $data_cheque = array(
              'name'        => 'cheque',
              'id'          => 'cheque',
              'value'       => $cheque,
              'maxlength'   => '10',
              'size'        => '10'
            );
    $data_fecha = array(
              'name'        => 'fecha',
              'id'          => 'fecha',
              'value'       => $fecha,
              'maxlength'   => '10',
              'size'        => '10'
            );

    $data_subtotal = array(
              'name'        => 'subtotal',
              'id'          => 'subtotal',
              'value'       => $subtotal,
              'maxlength'   => '15',
              'size'        => '15,2'
            );
    $data_ieps = array(
              'name'        => 'ieps',
              'id'          => 'ieps',
              'value'       => $ieps,
              'maxlength'   => '15',
              'size'        => '15,2'
            );
    $data_iva = array(
              'name'        => 'iva',
              'id'          => 'iva',
              'value'       => $iva,
              'maxlength'   => '15',
              'size'        => '15,2'
            );
    $data_iva_retenido = array(
              'name'        => 'iva_retenido',
              'id'          => 'iva_retenido',
              'value'       => $iva_retenido,
              'maxlength'   => '15',
              'size'        => '15,2'
            );
    $data_iva_cedular = array(
              'name'        => 'iva_cedular',
              'id'          => 'iva_cedular',
              'value'       => $iva_cedular,
              'maxlength'   => '15',
              'size'        => '15,2'
            );
    $data_iva_transp = array(
              'name'        => 'iva_transp',
              'id'          => 'iva_transp',
              'value'       => $iva_transp,
              'maxlength'   => '15',
              'size'        => '15,2'
            );
    $data_varios_sin_iva = array(
              'name'        => 'varios_sin_iva',
              'id'          => 'varios_sin_iva',
              'value'       => $varios_sin_iva,
              'maxlength'   => '15',
              'size'        => '15,2'
            );
    $data_imp_cheque = array(
              'name'        => 'imp_cheque',
              'id'          => 'imp_cheque',
              'value'       => $imp_cheque,
              'maxlength'   => '15',
              'size'        => '15,2'
            );

  ?>

  <table>
<tr>
	<th align="center" colspan="2"><font size="+1">MODIFICAR CHEQUE MANUALMENTE</font></th>

</tr>
<tr>
	<td align="left" ><font size="1"><?php echo $clave?></font></td>
	<td align="left"><?php echo form_dropdown('con', $polizax, '', 'id="con"') ;?><span id="mensaje"></span> </td>
</tr>  
<tr>
	<td align="left" ><font size="1"><?php echo $sucursal?></font></td>
	<td align="left"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?><span id="mensaje"></span> </td>
</tr>

<tr>
	<td align="left" ><font size="+1"><?php echo $receptor?></font></td>
    <td align="left">
    <select name="rec" id="rec">
    </select>
    </td>
</tr>

<tr>
	<td align="left" ><font size="1">CHEQUE: </font></td>
	<td><?php echo form_input($data_cheque, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="1">SUBTOTAL: </font></td>
	<td><?php echo form_input($data_subtotal, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="1">IEPS: </font></td>
	<td><?php echo form_input($data_ieps, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="1">IVA: </font></td>
	<td><?php echo form_input($data_iva, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="1">IVA RETENIDO: </font></td>
	<td><?php echo form_input($data_iva_retenido, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="1">IVA CEDULAR: </font></td>
	<td><?php echo form_input($data_iva_cedular, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="1">IVA DE TRANSPORTE: </font></td>
	<td><?php echo form_input($data_iva_transp, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="1">VARIOS GASTOS SIN IVA: </font></td>
	<td><?php echo form_input($data_varios_sin_iva, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="1">IMPORTE DE CHEQUE: </font></td>
	<td><?php echo form_input($data_imp_cheque, "", 'required');?></td>
</tr>


	<th colspan="2" align="center"><?php echo form_submit('envio', 'CAMBIAR CHEQUE');?></th>
</tr>
</table>
<input type="hidden" value="<?php echo $fec ?>" name="fec" id="fec" />
<input type="hidden" value="<?php echo $conta ?>" name="conta" id="conta" />
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
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
    
    $('#rec').blur(function(){
            rec = $('#rec').attr("value");
            $("#importe").focus();
     });
     ////////////////////////////
     $('#suc').blur(function(){
            suc = $('#suc').attr("value");
     });
     ////////////////////////////
    $('#imp_cheque').blur(function(){
            imp_cheque = $('#imp_cheque').attr("value"); 
     });
     ////////////////////////////
     $('#cheque').blur(function(){
            cheque = $('#cheque').attr("value"); 
     });
 /////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////valida equipo para traer accesorio   
    $('#suc').change(
        function()
        {
        suc=$('#suc').attr("value");
        con=$('#con').attr("value");
 
        if(suc>0){
                        // Llamamos al archivo combo1.php
            $.post("<?php echo site_url();?>/catalogo/busca_recep/", { suc: suc, con: con }, function(data){
			$("#rec").html(data);
            
                        // reseteamos el combo3
        });
   }
   
   
   
   
   });  
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#cheques_form_leo_2').submit(function() {
       
        var suc = $('#suc').attr("value");
        var rec = $('#rec').attr("value").length;
        var imp_cheque = $('#imp_cheque').attr("value");
        var cheque = $('#cheque').attr("value");
          if(suc >0  && rec>0 && imp_cheque>0  && cheque>0){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>