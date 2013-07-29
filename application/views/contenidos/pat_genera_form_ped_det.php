<div align="center">
    <?php
//////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////// 

	$atributos = array('id' => 'pat_genera_form_ped_det');
    echo form_open('mercadotecnia/agrega_det', $atributos);
    $data_cod = array(
              'name'        => 'cod',
              'id'          => 'cod',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_costo = array(
              'name'        => 'costo',
              'id'          => 'costo',
              'value'       => '',
              'maxlength'   => '11',
              'size'        => '11'
            );

  ?>
  


<table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1">Descripcion: </font></td>
	<td><?php echo form_input($data_cod, "", 'required');?><span id="mensaje"></span></td>
</tr>
<tr>
	<td>Producto: </td>
	<td align="left">
    <select name="codx" id="codx">
      
    </select>

    </td>
<tr>
	<td align="left" ><font size="+1">Cantidad: </font></td>
	<td><?php echo form_input($data_can, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Costo: </font></td>
	<td><?php echo form_input($data_costo, "", 'required');?></td>
</tr>

	<td colspan="2" align="center"><?php echo form_submit('envio', 'aceptar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
<input type="hidden" value="<?php echo $prv?>" name="prv" id="prv" />
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
///////////////////////////////////////////////////////////////////////            
        function enter2tab(e) { 
       if (e.keyCode == 13) { 
           cb = parseInt($(this).attr('tabindex')); 
     
           if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null) { 
               $(':input[tabindex=\'' + (cb + 1) + '\']').focus(); 
               $(':input[tabindex=\'' + (cb + 1) + '\']').select(); 
               e.preventDefault(); 
     
               return false; 
           } 
       } 
   }
///////////////////////////////////////////////////////////////////////    
    $('#cod').blur(function(){
     var cod = $('#cod').attr("value"); 
  if(cod > ' '){
            $.post("<?php echo site_url();?>/mercadotecnia/busca_producto/", { cod: cod}, function(data){
                if(data == ' '){
                    alert('Producto ' + cod + ' no encontrado.');
                    $('#cod').val('').focus();
                }else{
                
            $("#codx").html(data);

            $('#codx').focus();
            }
             });
             }
  });    
      ////////////////////////////
     $('#can').blur(function(){
            can = $('#can').attr("value");
     });
      ////////////////////////////
     $('#costo').blur(function(){
            costo = $('#costo').attr("value");
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
    $('#pat_genera_form_ped_det').submit(function() {
       
        var cod = $('#cod').attr("value").length;
        var can = $('#can').attr("value");
        var costo = $('#costo').attr("costo").length;
      
       alert(cod);alert(can);alert(costo);
          if(cod >0  && can>0 && costo>1){
    	    
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#cod').focus();
            
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