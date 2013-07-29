<?php
echo form_open('bitacora/submit_modificar', array('id' => 'form_agregar'));
	
?>
<div style="width: 100%;" align="center">
<table style="font-size: large; width: 100%;">
    <thead>
        <th colspan="2">Agregar un evento a la bitacora</th>
    </thead>
    <tbody>
        <tr>
            <td>
            <?php
            $data = array(
              'name'        => 'titulo',
              'id'          => 'titulo',
              'maxlength'   => '50',
              'size'        => '50',
              'value'       => $row->titulo
            );
            echo form_label('Titulo:', 'titulo');
            ?>
            </td>
            <td>
            <?php
            
            echo form_input($data);
            
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            echo form_label('Sucursal:', 'suc');
            ?>
            </td>
            <td>
            <?php
            echo form_dropdown('suc', $suc, $row->suc, 'id="suc"');
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            echo form_label('Asunto:', 'asunto');
            ?>
            </td>
            <td>
            <?php
            echo form_dropdown('asunto', $asuntos, $row->asunto, 'id="asunto"');
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            $data = array(
              'name'        => 'fecha',
              'id'          => 'fecha',
              'value'       => $row->fecha,
              'maxlength'   => '10',
              'size'        => '20'
            );
            echo form_label('Fecha:', 'fecha');
            ?>
            </td>
            <td>
            <?php
            echo form_input($data);
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            $data = array(
              'name'        => 'hora_inicio',
              'id'          => 'hora_inicio',
              'maxlength'   => '10',
              'size'        => '20',
              'type'        => 'time',
              'value'       => $row->hora_inicio
            );
            echo form_label('Hora de Inicio:', 'hora_inicio');
            ?>
            </td>
            <td>
            <?php
            echo form_input($data);
            ?>
            </td>
        </tr>

        <tr>
            <td>
            <?php
            $data = array(
              'name'        => 'hora_fin',
              'id'          => 'hora_fin',
              'maxlength'   => '10',
              'size'        => '20',
              'type'        => 'time',
              'value'       => $row->hora_fin
            );
            echo form_label('Hora de Fin:', 'hora_fin');
            ?>
            </td>
            <td>
            <?php
            echo form_input($data);
            ?>
            </td>
        </tr>

        <tr>
            <td colspan="2">
            Detalles:
            </td>
        </tr>

        <tr>
            <td colspan="2">
            <?php
            $data = array(
              'name'        => 'detalle',
              'id'          => 'detalle',
              'rows'        => '30',
              'class'   => 'tinymce',
              'style'   => 'width:100%'
            );
            ?>
            <?php
            echo form_textarea($data, $row->detalle);
            ?>
            </td>
        </tr>
        
        <tr>
            <td colspan="2">
            <?php
            echo form_submit('', 'Agregar a la bitacora');
            ?>
            </td>
        </tr>

    </tbody>
</table>

<?php
echo form_hidden('id', $row->id);
echo form_close();

?>
</div>
<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>css/jquery-ui-timepicker-addon.css' />
<script type='text/javascript' src='<?php echo base_url();?>time/jquery-ui-timepicker-addon.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>time/jquery-ui-sliderAccess.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>time/localization/jquery-ui-timepicker-es.js'></script>
<!--<script type="text/javascript" src="<?php //echo base_url();?>tiny_mce/jquery.tinymce.js"></script>-->
<script language="javascript" type="text/javascript">
$(document).ready(function(){
    $('#titulo').focus();
   $('#fecha').datepicker();
   $('#hora_inicio').timepicker({});
   $('#hora_fin').timepicker({});
   /*
   $(function() {
                $('textarea.tinymce').tinymce({
                        // Location of TinyMCE script
                        script_url : '<?php echo base_url();?>tiny_mce/tiny_mce.js',
                         language : 'en',

                        // General options
                        theme : "advanced",
                        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

                        // Theme options
                        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
                        theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,cleanup|,insertdate,inserttime|,forecolor,backcolor",
                        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,visualchars",
                        theme_advanced_buttons4 : "",
                        theme_advanced_toolbar_location : "top",
                        theme_advanced_toolbar_align : "left",
                        theme_advanced_statusbar_location : "bottom",
                        theme_advanced_resizing : true,

                        // Example content CSS (should be your site CSS)
                        content_css : "css/content.css",

                        // Drop lists for link/image/media/template dialogs
                        template_external_list_url : "lists/template_list.js",
                        external_link_list_url : "lists/link_list.js",
                        external_image_list_url : "lists/image_list.js",
                        media_external_list_url : "lists/media_list.js",

                        // Replace values for the template plugin
                        template_replace_values : {
                                username : "Some User",
                                staffid : "991234"
                        }
                });
        });
        */
        $('#form_agregar').submit(function(event){
            
            event.preventDefault();
            
            var titulo = $('#titulo').attr('value');
            var suc = $('#suc').attr('value');
            var asunto = $('#asunto').attr('value');
            var fecha = $('#fecha').attr('value');
            var hora_inicio = $('#hora_inicio').attr('value');
            var hora_fin = $('#hora_fin').attr('value');
            var detalle = $('#detalle').attr('value');
            var id = <?php echo $row->id; ?>;
            
            var url = "<?php echo site_url();?>/bitacora/submit_modificar";
            
            var variables = {
                titulo: titulo,
                suc: suc,
                asunto: asunto,
                fecha: fecha,
                hora_inicio: hora_inicio,
                hora_fin: hora_fin,
                detalle: detalle,
                id: id
            };
            
            if(titulo.length >=3 && suc > 0 && asunto > 0 && fecha.length == 10 && (hora_inicio.length == 5 || hora_inicio.length == 8) && (hora_fin.length == 5 || hora_fin.length == 8))
            {
                if(confirm("Seguro que deseas modificar este evento?")){
                    $.post( url, variables, function(data) {
                        if(data > 0)
                        {
                            window.location = "<?php echo site_url();?>/bitacora";
                        }else{
                            alert('No se pudo modificar el evento');
                        }
                        
                        
                    });
                }else{
                    return false;
                }
            }else{
                alert("Verifica los datos");
                return false;
            }
            
        });
        
        
});
</script>