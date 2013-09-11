  <blockquote>
    
    <p align='center'><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
    <?php
////////////////////////////////////////////////////////////////////////////////////// 

	$atributos = array('id' => 'compra_lic_form_nuevo');
    echo form_open('compra_lic/agrega_nuevo', $atributos);
    $data_nombre = array(
              'name'        => 'nombre',
              'id'          => 'nombre',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
    
  ?>
  


<table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1">Nombre: </font></td>
	<td><?php echo form_input($data_nombre, "", 'required');?></td>
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
        $("#nombre").focus();
    });
    
    $(document).ready(function(){
    
    $('#nombre').blur(function(){
            nombre = $('#nombre').attr("value");
           
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#compra_lic_form_nuevo').submit(function() {
       
        var nombre = $('#nombre').attr("value").length;
        
          if(nombre >0){
    	    
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#nombre').focus();
            
    	    return false    

    	        }
    	  });
          
      ////////////////////////////
    /////////////////////////////////////////////
         
        
     
});


  </script>