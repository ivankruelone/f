<?php
	$row = $row->row();
    
?>
            <!-- Example row of columns -->
            <div class="row">
                <div class="span4">
                    <h5><?php echo $row->completo; ?></h5>
                    <p>Fecha: <?php echo $row->fecha; ?></p>
                    <?php if($row->falta == 1){ ?>
                    <p>Argumento para justificar la falta.</p>
                    <?php }else{?>
                    <p>Argumento para justificar el retardo.</p>
                    
                    <?php }?>
                    
                    <?php echo form_open('checador/gerente_justificar_guardar', array('id' => 'form_guardar_justificacion'));?>
                    
                    <p>
                    <?php
                    
                    $data = array(
                      'name'        => 'motivo',
                      'id'          => 'motivo',
                      'rows'        => 5,
                      'cols'        => 100,
                      'required'    => 'required',
                      'autofocus'   => 'autofocus',
                      'value'       => $row->motivo
                    );

                    echo form_textarea($data);
                    
                    ?>
                    </p>
                    
                    <p>
                        <input type="hidden" id="id" value="<?php echo $row->id_registro; ?>" />
                        <input type="submit" name="submit" value="Guardar" class="btn" />
                    </p>
                    
                    <?php echo form_close();?>
                    
                </div>
            </div>
<script type="text/javascript">
$('#form_guardar_justificacion').on('submit', guardado);

function guardado(datos2){
    datos2.preventDefault();
    
    var url = datos2.currentTarget.attributes.action.value
    var id = $('#id').attr('value');
    var motivo = $('#motivo').attr('value');
    
    var variables = {
        id: id,
        motivo: motivo
    };
    
    $.post( url, variables, function(data) {
        if(data = 1)
        {
            $( "#dialog" ).dialog('close');
            window.location.reload();
        }
    });
    
}
</script>