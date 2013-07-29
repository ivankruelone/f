  <blockquote>
    
    <p><strong><?php echo $titulo;?></strong></p>
  </blockquote>
<div align="center">
  <?php
	$atributos = array('id' => 'cat_generico_form_copia');
    echo form_open('cat_generico/agrega_copia', $atributos);
    //cia, rfc, cur, afilia, pat, mat, nom, puesto, suc, fecha_i, salario, integrado, registro_pat, id_user, motivo, causa, id

$data_cod = array(
              'name'        => 'cod',
              'id'          => 'cod',
              'value'       => $cod,
              'maxlength'   => '13',
              'size'        => '13'
              
            );
$data_descri = array(
              'name'        => 'descri',
              'id'          => 'descri',
              'value'       => $descri,
              'maxlength'   => '50',
              'size'        => '50'
            );
$data_prvx = array(
              'name'        => 'prvx',
              'id'          => 'prvx',
              'value'       => $prvx,
              'maxlength'   => '50',
              'size'        => '50'
            );
$data_costo = array(
              'name'        => 'costo',
              'id'          => 'costo',
              'value'       => $costo,
              'maxlength'   => '11,2',
              'size'        => '11,2'
            );
$data_tsec = array(
              'name'        => 'tsec',
              'id'          => 'tsec',
              'value'       => $tsec,
              'maxlength'   => '1',
              'size'        => '1'
            );
    ?>
  
  <table>
<th colspan="3">COPIAR PRODUCTO PARA OTRO COMPRADOR PARA METRO</th>
<tr>
	<td align="left" ><font size="+1">LO COMPRA: </font></td>
	<td><?php echo $personax?></td>
</tr>
<tr>
	<td align="left" colspan="2"><?php echo form_dropdown('per', $perr, '', 'id="per"') ;?> </td>
 </tr>
<tr>
	<td align="left" ><font size="+1">T.Secuencia: </font></td>
	<td><?php echo form_input($data_tsec, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">CODIGO: </font></td>
	<td><?php echo form_input($data_cod, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">SUSTANCIA ACTIVA: </font></td>
	<td><?php echo $susa;?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">DESCRIPCION: </font></td>
	<td><?php echo form_input($data_descri, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Costo: </font></td>
	<td><?php echo form_input($data_costo, "", 'required');?></td>
</tr>

<tr>
	<td align="left" ><font size="+1">PROVEEDOR: </font></td>
    <td align="left"><?php echo  $prvx ;?> </td>
</tr>
<tr>
	<td align="left" colspan="2"><?php echo form_dropdown('prov', $prvv, '', 'id="prov"') ;?> </td>
 </tr>
 <tr>
	<td colspan="3" align="center"><?php echo form_submit('envio', 'Aceptar');?></td>
</tr>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
<input type="hidden" value="<?php echo $sec ?>" name="sec" id="sec" />
<input type="hidden" value="<?php echo $sec1 ?>" name="sec1" id="sec1" />
<input type="hidden" value="<?php echo $sec2 ?>" name="sec2" id="sec2" />
</table>

<?php echo $tabla  ?>

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


    $('#cat_generico_form_copia').submit(function() {
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