  <blockquote>
    
   <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
 </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_compra_form_suc');
    echo form_open('a_compra/agrega_ctl_patente', $atributos);
     $data_orden = array(
              'name'        => 'orden',
              'id'          => 'orden',
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
	<td align="center" colspan="2"><font size="+1" color="#FC0303">ALMACEN CENTRAL CEDIS</font></td>

</tr>
<tr>
	<td align="left" ><font size="+1">FACTURA: </font></td>
	<td colspan="1"><?php echo form_input($data_fac);?><span id="mensaje"></span></td>
 </tr>

<tr>
	<td align="left" ><font size="+1">ORDEN DE COMPRA: </font></td>
	<td colspan="1"><?php echo form_input($data_orden);?><span id="mensaje"></span></td>
 </tr>
 


</table>
  <?php
  echo form_submit('', 'Buscar');
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
      
   
    $('#a_compra_form_suc').submit(function(event) {
       event.preventDefault();
       
        var url = "<?php echo site_url();?>/a_compra/busca_orden";
        var variables = {
            orden: $('#orden').attr('value'),
            fac: $('#fac').attr('value')
        };
        $.post( url, variables, function(data) {
            $('#resultado').html(data);
            
        });        
        
       
    });
          
          
        
     
}
);
  </script>