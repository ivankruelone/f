<div align="center">
  <?php
	$atributos = array('id' => 'sistemas_form_reporte1');
    echo form_open('sistemas/agrega_reporte', $atributos);
     $data_problema = array(
              'name'        => 'problema',
              'id'          => 'problema',
              'value'       => '',
              'maxlength'   => '250',
              'size'        => '50'
            );
  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
	<td align="left" ><font size="+1">Depto o Sucursal: </font></td>
	<td><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
</tr>
<tr>
	<td>Persona: </td>
	<td align="left">
    <select name="nom" id="nom">
      
    </select>

    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">Solicitud: </font></td>
	<td><?php echo form_input($data_problema, "", 'required');?></td>
</tr>

	<td align="center" colspan="2"><?php echo form_submit('envio', 'acepta');?></td>
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
        $("#solicitud").focus();
    });
    
    $(document).ready(function(){
   ///////////////////////////////////////////////////////////////////////            
        function enter2tab(e) { 
       if (e.keyCode == 8) { 
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
    $('#suc').change(function(){
     var suc = $('#suc').attr("value"); 

     if(suc > ' '){
            $.post("<?php echo site_url();?>/sistemas/busca_nomina/", { suc: suc}, function(data){
                 if(data == ' '){
                    alert('Producto ' + suc + ' no encontrado.');
                    $('#suc').val('').focus();
                    $('#nom').val('');
                }else{
                
            $("#nom").html(data);
            $('#nom').focus();
            }
             });
             }
     
      });
     ////////////////////////////
 /////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#sistemas_form_reporte1').submit(function() {
       
         suc = $('#suc').attr("value");
         nom = $('#nom').attr("value");
         problema = $('#problema').attr("value").length;
          if(suc >0  && problema>15 && nom>3){
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