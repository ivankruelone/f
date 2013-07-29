  <blockquote>
    
   <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
 </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_compra_form_fecha_ctl');
    echo form_open('a_compra/imprime_compra_factura_ya', $atributos);
     $data_fec = array(
              'name'        => 'fec',
              'id'          => 'fec',
              'size'        => '10',
              'type'        => 'date',
              'value'       => $fec,
              'required'   => 'required'
            );
 
  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="center" colspan="2"><font size="+1" color="#FC0303">ALMACEN CENTRAL CEDIS</font></td>

</tr>
<tr>
	<td align="left" ><font size="+1">FACTURA: </font></td>
	<td colspan="1"><?php echo form_input($data_fec);?><span id="mensaje"></span></td>
 </tr>

	<td colspan="2" align="center"><?php echo form_submit('envio', 'aceptar');?></td>
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

  <?php

    
	echo form_close();
  

  ?>
</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#fec").focus();
    });
    
    $(document).ready(function(){
    
    $('#fec').blur(function(){
            fec = $('#fec').attr("value");
     });
     ////////////////////////////
 
    $('#a_compra_form_fecha_ctl').submit(function() {
         if(confirm("Seguro que los datos son correctos?")){
    	   
         }else{

    	    alert('Verifica la informacion');
    	    $('#fec').focus();
            
    	    return false    

    	        }
          
    	  });
          


  </script>