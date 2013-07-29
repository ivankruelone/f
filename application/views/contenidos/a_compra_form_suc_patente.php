  <blockquote>
    
   <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
 </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_compra_form_suc_patente');
    echo form_open('a_compra/agrega_ctl_patente', $atributos);
     $data_prv = array(
              'name'        => 'prv',
              'id'          => 'prv',
              'size'        => '9',
              'type'        => 'number',
              'required'   => 'required'
            );
    $data_fac = array(
              'name'        => 'fac',
              'id'          => 'fac',
              'size'        => '15',
              'type'        => 'text',
              'required'   => 'required'
            );
  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="center" colspan="2"><font size="+1" color="#FC0303">ALMACEN CENTRAL CEDIS MEDICAMENTO PATENTE</font></td>

</tr>
<tr>
	<td align="left" ><font size="+1">FACTURA: </font></td>
	<td colspan="1"><?php echo form_input($data_fac);?><span id="mensaje"></span></td>
 </tr>

<tr>
	<td align="left" ><font size="+1">PROVEEDOR: </font></td>
	<td colspan="1"><?php echo form_input($data_prv);?></td>
 </tr>
 


</table>
  <?php
  echo form_submit('', 'ACEPTAR');
	echo form_close();
  ?>
  
  
  <div align="center" id="resultado"></div>
  
<table align="center">
<tr>
	<td><?php echo $tabla;?></td>
</tr>
</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#fac").focus();
    });
    
    $(document).ready(function(){
      
   
     $('#a_compra_form_suc_patente').submit(function() {
        
        
        var fac = $('#fac').attr("value").length;
        var prv = $('#prv').attr("value").length;
        
          if(fac > 0 && prv > 0 ){
    	  }else{
            alert('VERIFIQUE LOS DATOS');
    	    return false    
         }
   
   });
          
          
        
     
});
  </script>