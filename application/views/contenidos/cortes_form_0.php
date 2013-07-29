  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cortes_form_0');
    echo form_open('cortes/insert_c', $atributos);
 

   $data_fecha = array(
              'name'        => 'fechac',
              'id'          => 'fechac',
              'value'       => $fechac,
              'maxlength'   => '10',
              
              'size'        => '10',
              'type'        => 'date'
            );
      $data_vta = array(
              'name'        => 'vta',
              'id'          => 'vta',
              'value'       => '',
              'maxlength'   => '15',
             
              'size'        => '15',
            );


  ?>
  
  <table>


<tr>
<th colspan="8"><font size="+1"> CAPTURE LOS DATOS SOLICITADOS </font></th>
</tr>

<tr>
  <th colspan="8"><?php echo $titulo;?></th>
</tr>

 <tr>
	<td>SUCURSAL: </td>
	<td align="left" colspan="3"><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
    <td>FECHA: </td>
	<td><?php echo form_input($data_fecha, "", 'required');?><span id="mensaje"></span></td>
</tr>
 <tr>
    <td colspan="4">VENTA TOTAL (INCLUYE CREDITO): </td>
	<td colspan="4"><?php echo form_input($data_vta, "", 'required');?><span id="mensaje"></span></td>
</tr>

<tr>
	<td colspan="6"align="center"><?php echo form_submit('envio', 'GENERAR CORTE');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>
<table align="center">
<tr>
	<td><?php echo $tabla;?></td>
</tr>
</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#suc").focus();
    });
    
    $(document).ready(function(){
    
    $('#suc').blur(function(){
            suc = $('#suc').attr("value"); 
     });
     $('#fechac').blur(function(){
            fechac = $('#fechac').attr("value"); 
     });
     $('#vta').blur(function(){
            vta = $('#vta_tot').attr("value"); 
     });
     
//////////////////////////////////////////////////
////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#cortes_form_0').submit(function() {
    var suc = $('#suc').attr("value");
    var fechac = $('#fechac').attr("value");
    var vta = $('#vta').attr("value");
      
    
           if(suc > 0 && vta_tot>0 )
          {
    	  }else{
    	    alert('VERIFIQUE INFORMACION suc fechac');
    	    return false    
    	        }
    	  });
          
          
        
     
});
  </script>