<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>fullcalendar/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='<?php echo base_url();?>fullcalendar/fullcalendar.js'></script>
<div align="center">
<table>
    <tr>
        <td style="background-color: #32CD32;">&nbsp;</td>
        <td>Altas de Personal</td>
        <td>Solo podras dar de alta en estos dias.</td>
    </tr>
    <tr>
        <td style="background-color: #DC143C;">&nbsp;</td>
        <td>Cambios y Bajas de Personal</td>
        <td>Solo podras dar de Cambios y Bajas en estos dias.</td>
    </tr>
    <tr>
        <td style="background-color: #FFD700;">&nbsp;</td>
        <td>Retenciones de Personal</td>
        <td>Solo podras hacer Retenciones en estos dias.</td>
    </tr>
    <tr>
        <td style="background-color: #1E90FF;">&nbsp;</td>
        <td>Prenomina</td>
        <td></td>
    </tr>
</table>
</div>
<div id="calendar">
</div>
<script type='text/javascript' language="javascript">
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
        var fechas = "<?php echo site_url();?>/calendario/fechas";

		$('#calendar').fullCalendar({
            theme: true,
            header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: false,
			events: fechas
		});
	});
</script>
