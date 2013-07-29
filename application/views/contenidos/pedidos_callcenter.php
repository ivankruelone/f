<h1>Pedidos pendientes generados en el Call Center</h1>
<div id="medicamentos" style="margin-top: 15px;">
<?php
    $this->db->select('id, alta');
	$this->db->where('suc', $this->session->userdata('suc'));
    $this->db->where('estatus', 1);
    $query = $this->db->get('cat.pedidos');
    
    foreach($query->result() as $row)
    {
        
?>
<h2>ID Pedido: <?php echo $row->id.' | '.$row->alta.' | '.anchor('callcenter/detalle/'.$row->id, 'Surtir este pedido'); ?></h2>
<?php
	}
?>
</div>

