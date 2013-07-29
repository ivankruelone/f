<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.button.min.js"></script>
<script src="<?php echo base_url();?>jquery-ui/minified/jquery.ui.dialog.min.js"></script>
<script type='text/javascript' language="javascript">
    $(document).on("ready", inicio);
	function inicio(){
	   
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
        var eventos = "<?php echo site_url();?>/checador/eventos";

		var calendar = $('#calendar').fullCalendar({
            theme: true,
            header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: false,
            select: function(event) {
                
                alert(event.id);
				
			},
			selectable: false,
			selectHelper: true,
            events: eventos,
            eventClick: function(event) {
                    var liga = "<?php echo site_url();?>/checador/evento_dialogo/" + event.id;
                    $( "#dialog" ).dialog({
            			autoOpen: true,
                        title: "Detalle de la asistencia",
                        open: function ()
                        {
                            $(this).load(liga);
                        }
            		});

                    return false;
            }
		});
        

	}
</script>
