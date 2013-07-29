<div align="center" id="tabla" style="width: 100%; height: 175px; overflow: auto;">
<?php
	echo $tabla
?>

</div>
<div id="mostrar_archivo"></div>
<script language="javascript" type="text/javascript">
$('a[id^="link_"]').click(
                function()
                {
                    var a = $(this).attr('id');
                    a = a.split('_');
                    var id = a[1];
                    $.post("<?php echo site_url();?>/contacto/busca_archivo/", { valor: id }, function(data){
                    $("#mostrar_archivo").html(data);
                    });
           
           
           });
</script>