  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cat_generico_form_alta');
    echo form_open('cat_generico/agrega_alta', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id

$data_cod = array(
              'name'        => 'cod',
              'id'          => 'cod',
              'value'       => '',
              'maxlength'   => '13',
              'size'        => '13'
              
            );
$data_descri = array(
              'name'        => 'descri',
              'id'          => 'descri',
              'value'       => '',
              'maxlength'   => '255',
              'size'        => '50'
            );
$data_susa = array(
              'name'        => 'susa',
              'id'          => 'susa',
              'value'       => '',
              'maxlength'   => '255',
              'size'        => '50'
            );
$data_prvx = array(
              'name'        => 'prvx',
              'id'          => 'prvx',
              'value'       => '',
              'maxlength'   => '50',
              'size'        => '50'
            );
$data_costo = array(
              'name'        => 'costo',
              'id'          => 'costo',
              'value'       => '',
              'maxlength'   => '11,2',
              'size'        => '11,2'
            );
                     
$data_pub = array(
              'name'        => 'pub',
              'id'          => 'pub',
              'value'       => '',
              'maxlength'   => '11,2',
              'size'        => '11,2'
            );
$data_lin = array(
              'name'        => 'lin',
              'id'          => 'lin',
              'value'       => '',
              'maxlength'   => '2',
              'size'        => '2'
            );
$data_slin = array(
              'name'        => 'slin',
              'id'          => 'slin',
              'value'       => '',
              'maxlength'   => '2',
              'size'        => '2'
            );
$data_claves = array(
              'name'        => 'claves',
              'id'          => 'claves',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
    ?>
  
  <table>
<th colspan="3">COPIAR PRODUCTO PARA OTRO COMPRADOR PARA METRO</th>
<tr>
<td align="center" colspan="2"><?php echo '<font size="+3">'.($sec+1).'</font>' ?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">LO COMPRA: </font></td>
	<td align="left" colspan="1"><?php echo form_dropdown('per', $perr, '', 'id="per"') ;?> </td>
 </tr>

<tr>
	<td align="left" ><font size="+1">CODIGO: </font></td>
	<td><?php echo form_input($data_cod, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">CLAVE GOBIERNO: </font></td>
	<td><?php echo form_input($data_claves, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">SUSTANCIA ACTIVA: </font></td>
	<td><?php echo form_input($data_susa, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">DESCRIPCION: </font></td>
	<td><?php echo form_input($data_descri, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">LINEA: </font></td>
	<td><?php echo form_input($data_lin, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">SUB-LINEA: </font></td>
	<td><?php echo form_input($data_slin, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">Costo: </font></td>
	<td><?php echo form_input($data_costo, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Publico: </font></td>
	<td><?php echo form_input($data_pub, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">PROVEEDOR: </font></td>
   	<td align="left" colspan="1"><?php echo form_dropdown('prov', $prvv, '', 'id="prov"') ;?> </td>
 </tr>
 <tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Aceptar');?></td>
</tr>
<input type="hidden" value="<?php echo $sec ?>" name="sec" id="sec" />
<input type="hidden" value="<?php echo $sec1 ?>" name="sec1" id="sec1" />
<input type="hidden" value="<?php echo $sec2 ?>" name="sec2" id="sec2" />

</table>


  <?php
	echo form_close();
  ?>
<table align="center">

</table>

</div>    
  <script language="javascript" type="text/javascript">
    $(window).load(function () {
        $("#per").focus();
    });
    
    $(document).ready(function(){
    
    $('#descri').blur(function(){
            descri = $('#descri').attr("value");
     });
/////////////////////////////////////////////////


    $('#cat_generico_form_alta').submit(function() {
        var descri = $('#descri').attr("value").length;
        var per = $('#per').attr("value");
        var prov = $('#prov').attr("value");
          if( descri>0 and per>'' and prov>0 ){

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