<div align="center">
    <h2>Formato de Busqueda de Folios</h2>
    
    <h4>Folio</h4>
    <?php
        
        $data_folio = array(
              'name'        => 'fol',
              'id'          => 'fol',
              'type'        => 'number'
            );

        echo form_input($data_folio);
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
    
    var folio = document.getElementById("fol").value;
   
    
    $.post("<?php echo site_url();?>/a_surtido/busca_folio/", { folio: folio}, function(data){
                    $("#tabla1").html(data);
                });
    $('#fol').val('');
  
                
                
}

</script>