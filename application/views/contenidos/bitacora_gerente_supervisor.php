<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>fullcalendar/fullcalendar.print.css' media='print' />
<script src="<?php echo base_url();?>scripts/minified/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/minified/jquery.ui.position.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>scripts/minified/jquery.ui.dialog.min.js" type="text/javascript"></script>

<script type='text/javascript' src='<?php echo base_url();?>fullcalendar/fullcalendar.js'></script>
<div>
<?php
	if($this->session->userdata('nivel') == 21){
	   
       $sql = "SELECT s.regional,s.superv,u.nombre
 FROM catalogo.sucursal s
left join usuarios u on s.superv = u.plaza
where s.regional = ?  and u.activo=1
group by s.superv;";
        $query = $this->db->query($sql, array($this->session->userdata('plaza')));
        $supervisores = array();
        foreach($query->result() as $row)
        {
            $supervisores[$row->superv] = $row->superv." - ".$row->nombre;
        }
        
        $this->db->where('plaza', $supervisor);
        $this->db->where('nivel', 14);
        
        $query10 = $this->db->get('usuarios');
        $row10 = $query10->row();
?>
    <div align="center" id="gerente_uspervisores">
    <?php
    echo form_open('bitacora/gerente_supervisor');
    echo form_dropdown('supervisor', $supervisores, $supervisor, 'id="supervisor"'); 
    echo form_submit('', 'Ver su Bitacora');
    echo form_close();
    ?>
    </div>
    <div id="datos">
    <h1>Bitacora de <?php echo $row10->nombre."<br />Puesto: ".$row10->puesto; ?></h1>
    <h3 align="center"><?php echo anchor('bitacora', 'Regresar a mi Bitacora...'); ?></h3>
    </div>
<?php
	}
?>
<div id="dialog">
</div>

    <div id="calendar">
    
    </div>
</div>
<script type='text/javascript' language="javascript">
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
        var eventos = "<?php echo site_url();?>/bitacora/eventos_gerente_supervisor/" + "<?php echo $supervisor?>";

		var calendar = $('#calendar').fullCalendar({
            theme: true,
            header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: false,
            select: function(start, end, allDay) {
				var title = prompt('Asunto:');
				if (title) {
				    
                    window.location = "<?php echo site_url();?>/bitacora/agregar_evento/" + title + "/" + start;

				}
				calendar.fullCalendar('unselect');
			},
			selectable: false,
			selectHelper: false,
            events: eventos,
            eventClick: function(event) {
                    
                    //window.location = "<?php //echo site_url();?>/bitacora/evento/" + event.id;
                    var liga = "<?php echo site_url();?>/bitacora/evento_dialogo/" + event.id;
                    
                    $( "#dialog" ).dialog({
            			autoOpen: true,
                        title: "Detales del evento",
                        open: function ()
                        {
                            $(this).load(liga);
                        },
                        width: 460
            		});

                    return false;
            }
		});
        

	});
</script>
