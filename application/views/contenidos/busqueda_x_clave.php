<div align="center">
    <h2>Formato de Busqueda</h2>
    
    <h4>MOVIMIENTOS X CLAVE</h4><br />
    
    
    <?php
        
        $data_clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'type'        => 'number',
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );
            
        echo form_label('Clave: ', 'clave');
        echo form_input($data_clave);
        
        
        $data_lote = array(
              'name'        => 'lote',
              'id'          => 'lote',
              'type'        => 'texto',
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );
            
        echo form_label('  Lote: ', 'lote');
        echo form_input($data_lote);
        
        echo "<br />";echo "<br />";

        $data1 = array(
              'name'        => 'fecha1',
              'id'          => 'fecha1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );
        echo form_label('Fecha Inicial: ', 'fecha1');
        echo form_input($data1);
        
        $data2 = array(
              'name'        => 'fecha2',
              'id'          => 'fecha2',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '20',
              'required'    => 'required'
            );

        echo form_label(' Fecha Final: ', 'fecha2');
        echo form_input($data2);
        echo "<br />";
        echo "<br />";
        
        
        ?>
        
<br /><br />
            <button id="folio_boton" onclick="tabla_folio();" class="button-link blue">Buscar</button><br /><br /><br />

<div id="tabla1">
<?php
	echo $tabla;
?>
</div>
</div>


<script language="javascript" type="text/javascript">

function tabla_folio(){
    
    var clave = document.getElementById("clave").value;
    var lote = document.getElementById("lote").value;
    var fecha1 = document.getElementById("fecha1").value;
    var fecha2 = document.getElementById("fecha2").value;
    
    $.post("<?php echo site_url();?>/a_inv/busca_clave/", { clave: clave, lote: lote, fecha1: fecha1, fecha2: fecha2 }, function(data){
                    $("#tabla1").html(data);
                });
    $('#clave').val('');
    $('#lote').val('');
    $('#fecha1').val('');
    $('#fecha2').val('');
                
                
}

</script>
