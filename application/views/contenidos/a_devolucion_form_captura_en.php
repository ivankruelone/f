  <blockquote>
    
    <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
  </blockquote>
<div align="center">
    <?php
//////////////////////////////////////////////////////////////////////////////////////
      $atributos1 = array('id' => 'a_devolucion_form_cerrar');
    echo form_open('a_devolucion/cerrar', $atributos1);
 ?>
  <tr>
<td></td>
	<td><?php echo form_submit('envio', 'Cerrar folio');?></td>
</tr>
<input type="hidden" value="<?php echo $fol?>" name="fol" id="fol" />
<input type="hidden" value="<?php echo $tipo?>" name="tipo" id="tipo" />
<input type="hidden" value="<?php echo $mov?>" name="mov" id="mov" />
  <?php
  	echo form_close();

////////////////////////////////////////////////////////////////////////////////////// 

	$atributos = array('id' => 'a_devolucion_form_captura_en');
    echo form_open('a_devolucion/agrega_detalle', $atributos);
    $data_codigo = array(
              'name'        => 'cod',
              'id'          => 'cod',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
            );
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
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
	<td align="left" ><font size="+1">LOTE: </font></td>
	<td><?php echo form_input($data_lote, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">CADUCIDAD: </font></td>
	<td><?php echo form_input($data_cadu, "", 'required');?>AAA-MM-DD</td>
</tr>
<tr>
	<td align="left" ><font size="+1">CANTIDAD: </font></td>
	<td><?php echo form_input($data_can, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Codigo: </font></td>
	<td><?php echo form_input($data_codigo, "", 'required');?></td>
</tr>
<tr>
	<td>sec: </td>
	<td align="sec">
    <select name="sec" id="sec">
      
    </select>

    </td>
</tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'aceptar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $fol?>" name="fol" id="fol" />
<input type="hidden" value="<?php echo $tipo?>" name="tipo" id="tipo" />

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
        $("#lote").focus();
    });
    
    $(document).ready(function(){
    
    $('#lote').blur(function(){
            lote = $('#lote').attr("value");
           
      
      
      
      
      
           
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
 $('#cod').blur(function(){
            cod = $('#cod').attr("value");
alert(cod);
 if(cod > 0){
            $.post("<?php echo site_url();?>/a_devolucion/busca_pro/", { cod: cod}, function(data){
                if(data == '0'){
                    alert('La cod ' + cod + ' no tiene existencia.');
                    $('#cod').val('').focus();
                    $('#sec').val('');
                }else{
                
            $("#sec").html(data);
            $('#sec').focus();
            }
             });
             }
     });
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_devolucion_form_captura_en').submit(function() {
       
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
    $('#a_devolucion_form_cerrar').submit(function() {
         if(confirm("Seguro que los datos son correctos?")){
    	   
         }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
          
    	  });
          

///////////////////////////////////////////////////////

  </script>