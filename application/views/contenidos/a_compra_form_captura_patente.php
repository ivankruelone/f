  <blockquote>
    
    <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
  </blockquote>
<div align="center">
    <?php
//////////////////////////////////////////////////////////////////////////////////////

      $atributos1 = array('id' => 'a_compra_form_cerrar_patente');
    echo form_open('a_compra/cerrar_patente', $atributos1);
 ?>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
<input type="hidden" value="<?php echo $orden?>" name="orden" id="orden" />

  <tr>
<td></td>
	<td><?php echo form_submit('envio', 'Cerrar folio');?></td>
</tr>
  <?php
  	echo form_close();

////////////////////////////////////////////////////////////////////////////////////// 

	$atributos = array('id' => 'a_compra_form_cerrar_patente');
    echo form_open('a_compra/agrega_detalle_patente', $atributos);
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '5',
              'size'        => '5'
            );
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_cod = array(
              'name'        => 'cod',
              'id'          => 'cod',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
            );
    $data_canr = array(
              'name'        => 'canr',
              'id'          => 'canr',
              'value'       => 0,
              'maxlength'   => '7',
              'size'        => '7'
            );
            $data_pub = array(
              'name'        => 'pub',
              'id'          => 'pub',
              'value'       => 0,
              'maxlength'   => '7',
              'size'        => '7'
            );

    $data_lote = array(
              'name'        => 'lote',
              'id'          => 'lote',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
    $data_cadu = array(
              'name'        => 'cadu',
              'id'          => 'cadu',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => date('Y-m-d')
            );    
  ?>
  


<table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1">SECUENCIA: </font></td>
	<td><?php echo form_input($data_sec, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">CANTIDAD: </font></td>
	<td><?php echo form_input($data_can, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">CANTIDAD REGALADA: </font></td>
	<td><?php echo form_input($data_canr, "", 'required');?></td>
</tr>

	<td colspan="2" align="center"><?php echo form_submit('envio', 'aceptar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
<input type="hidden" value="<?php echo $orden?>" name="orden" id="orden" />
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
        $("#sec").focus();
    });
    
    $(document).ready(function(){
    
    $('#sec').blur(function(){
            sec = $('#sec').attr("value");
            $("#lote").focus();
     });
     ////////////////////////////
     $('#lote').blur(function(){
            lote = $('#lote').attr("value");
     $("#cadu").focus();
     });
     ////////////////////////////
      ////////////////////////////
     $('#cadu').blur(function(){
            cadu = $('#cadu').attr("value");
      $("#can").focus();
     });
     ////////////////////////////
      ////////////////////////////
     $('#can').blur(function(){
            can = $('#can').attr("value");
     });
     ////////////////////////////
      ////////////////////////////
    ////////////////////////////
    /////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////
 
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_compra_form_captura_patente').submit(function() {
       
        var sec = $('#sec').attr("value").length;
        var can = $('#can').attr("value").length;
        var lote = $('#lote').attr("value").length;
        var cadu = $('#cadu').attr("value").length;
       
          if(sec >0  && can>0 && lote>0 && cadu==10){
    	    
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
    	  });
          
      ////////////////////////////
    /////////////////////////////////////////////
         
        
     
});
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_compra_form_cerrar_patente').submit(function() {
         if(confirm("Seguro que los datos son correctos?")){
    	   
         }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
          
    	  });
          

///////////////////////////////////////////////////////

  </script>