  <blockquote>
    
   <p align='center'><strong><?php echo $titulo;?></strong></p>
     <p align='center'><strong><?php echo $titulo1;?></strong></p>
 </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'a_traspaso_form_suc');
    echo form_open('a_traspaso/agrega_ctl', $atributos);
  ?>
  
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>


<tr>
	<td align="center" colspan="2"><font size="+1" color="#FC0303">ALMACEN CENTRAL CEDIS</font></td>

</tr>
<tr>
	<td align="left" ><font size="+1">TIPO: </font></td>
    <td align="left" colspan="3"> 
    <select name="tipo" id="tipo">
    <option value=" " <?php if($tipo==' ') echo "Selected"?> >Selecciona tipo</option>
    <option value="E" <?php if($tipo=='E') echo "Selected"?> >ENTRA MERCANCIA DE</option>
    <option value="S" <?php if($tipo=='S') echo "Selected"?> >SALE MERCANCIA A</option>
    </select>
    </td>
</tr>
<tr>
	<td align="left" ><font size="+1">SUCURSAL: </font></td>
	<td><?php echo form_dropdown('suc', $sucx, '', 'id="suc"') ;?> </td>
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
        $("#tipo").focus();
    });
    
    $(document).ready(function(){
    
    $('#tipo').blur(function(){
            tipo = $('#tipo').attr("value");
            $("#suc").focus();
     });
     ////////////////////////////
     $('#suc').blur(function(){
            suc = $('#suc').attr("value");
     });
/////////////////////////////////////////////////
/////////////////////////////////////////////////
    $('#a_traspaso_form_suc').submit(function() {
       
        var suc = $('#suc').attr("value").length;
        var tipo = $('#tipo').attr("value").length;
       
          if(suc >0  && can>0){
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