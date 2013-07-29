<div class="sidebar">
<?php
	$this->db->select('ruta, nom');
    $this->db->group_by('ruta, nom');
    $query = $this->db->get('catalogo.almacen_rutas');
    
    $rutas = array();
    
    $rutas[0] = "Selecciona una Ruta";
    
    foreach($query->result() as $row)
    {
        $rutas[$row->nom] = $row->ruta.' - '.$row->nom;
    }
    
    echo form_dropdown('rutas', $rutas, '', 'id="rutas"');
    
?>
</div>