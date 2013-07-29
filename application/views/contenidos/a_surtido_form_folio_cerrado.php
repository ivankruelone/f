  <blockquote>
    
   <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
 </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_surtido_form_folio_cerrado');
    echo form_open('a_surtido/tabla_control_his_detalle', $atributos);
    $data_fol = array(
              'name'        => 'fol',
              'id'          => 'fol',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
              
              
            );
    $data_con = array(
              'name'        => 'con',
              'id'          => 'con',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15',
              'type'        =>'password'
              
              
            );

  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>



<tr>
	<td align="left" ><font size="+1">FOLIO: </font></td>
	<td><?php echo form_input($data_fol, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">CONTRASE&Ntilde;A: </font></td>
	<td><?php echo form_input($data_con, "", 'required');?></td>
</tr>



	<td colspan="2"><?php echo form_submit('envio', 'acepta');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#fol").focus();
    });
    
    $(document).ready(function(){
    
    $('#fol').blur(function(){
            sec = $('#fol').attr("value");
            $("#con").focus();
     });
     ////////////////////////////
     $('#con').blur(function(){
            con = $('#con').attr("value");
     });
     ////////////////////////////
    /////////////////////////////////////////////
/////////////////////////////////////////////////
/////////////////////////////////////////////////
///////////////////////////////////////////////////////valida equipo para traer accesorio   
 
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_surtido_form_folio_cerrado').submit(function() {
       
        var fol = $('#fol').attr("value");
        var con = $('#con').attr("value").length;
         if(fol >0  && con>0){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#fol').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script>