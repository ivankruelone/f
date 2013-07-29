  <div id="main">
  <?php $this->load->view('head/head'); ?>
    <div id="site_content">
    <?php 
    
    if(isset($sidebar)){
        $sidebar = $sidebar;
    }else{
        $sidebar = "sidebar";
    }
    
    $this->load->view('sidebar/' . $sidebar);
    ?>

      <div id="content">
        <?php $this->load->view('contenidos/' . $contenido); ?>
      </div>

    </div>
    <?php $this->load->view('foot/footer'); ?>
  </div>
  
<div id="notificacion" style="display:none">
 
    <!-- 
    Later on, you can choose which template to use by referring to the 
    ID assigned to each template.  Alternatively, you could refer
    to each template by index, so in this example, "basic-tempate" is
    index 0 and "advanced-template" is index 1.
    -->
    <div id="basic-template">
        <a class="ui-notify-cross ui-notify-close" href="#">x</a>
        <h1>#{title}</h1>
        <p>#{text}</p>
    </div>
 
    <div id="advanced-template">
        <!-- ... you get the idea ... -->
    </div>
 
</div>

<script language="javascript" type="text/javascript">
$("#notificacion").notify({expires: false});
</script>

<!-- (1) Aqui empieza la parte que muestra un mensaje cuando el pedido de la sucursal fue recibido de forma satisfactoria. -->
<?php
	$sqlres = "SELECT 
    count(*) as cuenta, sum(can) as can, fechas, 
    case when mue = 6 then 6 when mue <> 6 then 5 end as mue, fol 
    FROM pedidos p 
    where date(fechas) = date(now()) and suc = ?
    group by case when mue = 6 then 6 when mue <> 6 then 5 end 
    order by mue;";
    $qres = $this->db->query($sqlres, array($this->session->userdata('suc')));
    
    $numrowsr = $qres->num_rows();
    if($numrowsr > 0){
        
        $cuenta = 0;
        $can = 0;
        $l1 = null;
        $l2 = null;
        foreach($qres->result() as $row)
        {
            $cuenta = $cuenta + $row->cuenta;
            $can = $can + $row->can;
            $fechas = $row->fechas;
            if($row->mue == 5){
                $l1 = anchor('pedido/imprime_pedidos/'.$row->fol.'/'.$this->session->userdata('suc'), 'Ver aqui', 'target="_blank"');
            }elseif($row->mue == 6){
                $l2 = anchor('pedido/imprime_pedidos_06/'.$row->fol.'/'.$this->session->userdata('suc'), 'y aqui', 'target="_blank"');
            }
        }
?>
<script language="javascript" type="text/javascript">
$("#notificacion").notify("create", {
    title: 'Mensaje del Depto. de Sistemas',
    text: 'Te informamos que tu pedido fue recibido exitosamente el dia de hoy registrado fecha y hora como sigue <?php echo $fechas?> con un total de <?php echo $cuenta?> productos, sumando un total de <?php echo $can?> piezas y fue recibido en el area de Sistemas.<br />Nota: Tu pedido se divide en:<br /><?php echo $l1;?> | <?php echo $l2;?>'
});
</script>
<?php
    }
?>
<!-- (1) Aqui termina -->


<!-- (2) Aqui empieza la parte que muestra un mensaje cuando el pedido de la sucursal NO HA SIDO recibido de forma satisfactoria. -->
<?php
    $sql_dia = "select dayofweek(date(now())) as dia";
    $dia = $this->db->query($sql_dia);
    
    $diaw = $dia->row();
    
    $a = array(
            1 => 'DOM',
            2 => 'LUN',
            3 => 'MAR',
            4 => 'MIE',
            5 => 'JUE',
            6 => 'VIE',
            7 => 'SAB'
    );
    
    
    
	$sqlres = "SELECT suc FROM catalogo.sucursal s where dia = ? and suc not in(select suc from desarrollo.pedidos where date(fechas) = date(now())) and suc = ?;";
    $qres = $this->db->query($sqlres, array($a[$diaw->dia], $this->session->userdata('suc')));
    
        $numrowsr = $qres->num_rows();
    
        if($numrowsr > 0){
?>
<script language="javascript" type="text/javascript">
$("#notificacion").notify("create", {
    title: 'Mensaje del Depto. de Sistemas',
    text: 'Te informamos que tu pedido "NO HA SIDO RECIBIDO" el dia de Hoy o esta "INCORRECTO" y necesitamos que lo envies.<br />Tienes hasta las 2 P. M. Hora de la Ciudad de Mexico.'
});
</script>
<?php
	   }
?>
<!-- (2) Aqui termina -->

<!-- (3) Aqui empieza la parte que muestra un mensaje cuando HAY UN PEDIDO GENERADO EN EL CALL CENTER. -->
<?php
	//$sqlres = "SELECT count(*) as cuenta FROM cat.pedidos p where suc = ? and estatus = 1;";
    //$qres = $this->db->query($sqlres, array($this->session->userdata('suc')));
    
        //$numrowsr = $qres->num_rows();
        
        $numrowsr = 0;
    
        if($numrowsr > 0){
            
            $ro = $qres->row();
?>
<script language="javascript" type="text/javascript">
$("#notificacion").notify("create", {
    title: 'Mensaje del Depto. de Sistemas',
    text: 'Tienes <?php echo $ro->cuenta;?> pedido(s) pendientes. <?php echo anchor('callcenter', 'DETALLES');?>'
});
</script>
<?php
	   }
?>
<!-- (3) Aqui termina -->

<?php
	if(isset($mensaje)){
?>
<script language="javascript" type="text/javascript">
$("#notificacion").notify("create", {
    title: 'Mensaje del Depto. de Sistemas',
    text: '<?php echo $mensaje; ?>'
});
</script>

<?php
	}
?>