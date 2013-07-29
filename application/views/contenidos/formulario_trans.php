  <blockquote>
    
    <p align="center"><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">

<?php
	$atributos = array('id' => '#transporte');
    echo form_open('trans/agrega_datos', $atributos);


  $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
    $data_obser = array(
              'name'        => 'obser',
              'id'          => 'obser',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
            );

  ?>




<table>
    <th colspan="2">AGREGAR</th>
    
    <tr>
    	<td align="left" ><font size="+1">TIPO: </font></td>
    	<td align="left"><?php echo form_dropdown('tipo', $tipo, '', 'id="tipo"') ;?> </td>
    </tr>
    <tr>
    <td align="left" ><font size="+1">FECHA: </font></td>
    <td><?php echo form_input($data_fec1, "", 'required').'AAAA-MM-DD'; ?></td>
    </tr>
    <tr>
	<td align="left" ><font size="+1">Observaciones: </font></td>
	<td><?php echo form_input($data_obser, "", 'required');?></td>
    </select> </td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
    </tr>
</table>

<?php
	echo form_close();
  ?>

</div>

<script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#tipo").focus();
    });
    
    $(document).ready(function(){
    
    $('#fec1').datepicker();
    
/////////////////////////////////////////////////
/////////////////////////////////////////////////

    $('#transporte').submit(function() {
        var fec1 = $('#fec1').attr("value").length;
        var obser = $('#obser').attr("value").length;
        
        
          if(fec1 == 10 && obser>0){
    	    if(confirm("Seguro que los datos son correctos?")){
    	    return true;
    	    }else{
    	    return false;
    	    }
    	    
    	  }else{

    	    alert('Verifica la informacion');
    	    $('#usuario').focus();
            
    	    return false    

    	        }
    	  });
          
          
        
     
});
  </script> 
  