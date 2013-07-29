<?php
class Mensajes_model extends CI_Model {
    
    var $id = null;
    var $checador_id = null;

    function __construct()
    {
        parent::__construct();
        $this->id = $this->session->userdata('id');
        $this->checador_id = $this->session->userdata('tipo');
    }
    
    function get_atributos_empleado()
    {
        $this->db->where('id', $this->id);
        $query = $this->db->get('catalogo.cat_empleado');
        return $query;
    }
    
}