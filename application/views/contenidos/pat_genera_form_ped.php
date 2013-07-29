  
<div align="center">
    <?php
///////////////////////////////////////////////////////////////////////////////////// 

	$atributos = array('id' => 'a_compra_form_cerrar');
    echo form_open('mercadotecnia/agrega_ctl', $atributos);
    $data_cod = array(
              'name'        => 'cod',
              'id'          => 'cod',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
            );
   
  ?>
  


<table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1">ALMACEN: </font></td>
<td><?php echo form_dropdown('tipo', $tipo, '', 'id="tipo"') ;?> </td>
</tr>
<tr>
	<td align="left" ><font size="+1">MAYORISTA: </font></td>
    <td><?php echo form_dropdown('prv', $prv, '', 'id="prv"') ;?> </td>
</tr>

	<td align="center" colspan="2"><?php echo form_submit('envio', 'Generar');?></td>
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
        $("#cod").focus();
    });
    
    $(document).ready(function(){
    
    $('#cod').blur(function(){
            cod = $('#cod').attr("value");
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
    $('#a_compra_form_captura').submit(function() {
       
        var cod = $('#cod').attr("value").length;
        var can = $('#can').attr("value").length;
        var lote = $('#lote').attr("value").length;
        var cadu = $('#cadu').attr("value").length;
       
          if(cod >0  && can>0 && lote>0 && cadu==10){
    	    
    	    
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
    $('#a_compra_form_cerrar').submit(function() {
         if(confirm("Seguro que los datos son correctos?")){
    	   
         }else{

    	    alert('Verifica la informacion');
    	    $('#suc').focus();
            
    	    return false    

    	        }
          
    	  });
          

///////////////////////////////////////////////////////

  </script>