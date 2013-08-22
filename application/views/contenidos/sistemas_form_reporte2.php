<div align="center">
  <?php
	$atributos = array('id' => 'sistemas_form_reporte2');
    echo form_open('sistemas/agrega_reporte', $atributos);
     $data_solucion = array(
              'name'        => 'solucion',
              'id'          => 'solucion',
              'value'       => '',
              'maxlength'   => '250',
              'size'        => '100'
            );
     $data_antes = array(
              'name'        => 'antes',
              'id'          => 'antes',
              'value'       => '',
              'maxlength'   => '250',
              'size'        => '50'
            );
     $data_ahora = array(
              'name'        => 'ahora',
              'id'          => 'ahora',
              'value'       => '',
              'maxlength'   => '250',
              'size'        => '50'
            );
  ?>

<table align="center">
<tr>
	<td><?php echo $tabla0;?></td>
</tr>
</table>
 
<table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="center" colspan="2"><?php echo form_input($data_solucion, "", 'required');?></td>
</tr>
<tr>
	<td align="center">Antes</td>
	<td align="center">Ahora</td>
</tr>
<tr>
	<td><?php echo form_input($data_antes, "", 'required');?></td>
	<td><?php echo form_input($data_ahora, "", 'required');?></td>
</tr>

<tr>
	<td align="center" colspan="2"><?php echo form_submit('envio', 'acepta');?></td>
</tr>
</table>


  <?php
	echo form_close();
  ?>


</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#solucion").focus();
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

    $('#suc').blur(function(){
      var suc = $('#suc').attr("value"); 
     if(suc > ' '){
            $.post("<?php echo site_url();?>/sistemas/busca_nomina/", { suc: suc}, function(data){
                if(data == ' '){
                    alert('Producto ' + suc + ' no encontrado.');
                    $('#suc').val('').focus();
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
    $('#sistemas_form_reporte2').submit(function() {
       
        var suc = $('#suc').attr("value").length;
        var nom = $('#nom').attr("value").length;
        var problema = $('#problema').attr("value").length;
       
          if(suc >0  && problema<>' '){
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