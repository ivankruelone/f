<?php
class Bitacora_model extends CI_Model {

    var $nivel = '';
    var $id = '';
    var $suc = '';
    var $plaza = '';
    var $nomina = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->nivel = $this->session->userdata('nivel');
        $this->id = $this->session->userdata('id');
        $this->plaza = $this->session->userdata('plaza');
        $this->nomina = $this->session->userdata('nomina');
    }
    
    function sucursales()
    {
        $this->db->select('suc, nombre');
        if($this->nivel == 14)
        {
            $this->db->where('superv', $this->plaza);
        }elseif($this->nivel == 21)
        {
            $this->db->where('regional', $this->plaza);
        }
        
        $query = $this->db->get('catalogo.sucursal');
        
        $a = array();
        
        if($query->num_rows() > 0){
            
            $a[0] = "Selecciona una Sucursal";
            
            foreach($query->result() as $row)
            {
                $a[$row->suc] = $row->suc." - ".$row->nombre;
            }
        }
        
        return $a;
        
    }

    function asuntos()
    {
        $query = $this->db->get('bitacora_asuntos');
        
        $a = array();
        
        if($query->num_rows() > 0){
            
            $a[0] = "Selecciona un Motivo";
            
            foreach($query->result() as $row)
            {
                $a[$row->id_asunto] = $row->id_asunto." - ".$row->asunto_desc;
            }
        }
        
        return $a;
        
    }
    
    function agregar_evento()
    {
        //id, suc, fecha, hora_inicio, hora_fin, asunto, estatus, detalle, supervisor, gerente, alta, modi
        $data->suc = $this->input->post('suc');
        $data->fecha = $this->input->post('fecha');
        $data->hora_inicio = $this->input->post('hora_inicio');
        $data->hora_fin = $this->input->post('hora_fin');
        $data->asunto = $this->input->post('asunto');
        $data->estatus = 1;
        $data->detalle = $this->input->post('detalle');
        $data->titulo = $this->input->post('titulo');
        $data->id_user = $this->session->userdata('id');
        if($this->nivel == 14){
            $data->supervisor = $this->plaza;
            $data->gerente = 0;
        }elseif($this->nivel == 21){
            $data->supervisor = 0;
            $data->gerente = $this->plaza;
        }
        
        $this->db->set('alta', 'now()', false);
        $this->db->set('modi', 'now()', false);
        
        $this->db->insert('bitacora', $data);
        
        return $this->db->insert_id();
        
    }
    
    function modificar_evento()
    {
        //id, suc, fecha, hora_inicio, hora_fin, asunto, estatus, detalle, supervisor, gerente, alta, modi
        $data->suc = $this->input->post('suc');
        $data->fecha = $this->input->post('fecha');
        $data->hora_inicio = $this->input->post('hora_inicio');
        $data->hora_fin = $this->input->post('hora_fin');
        $data->asunto = $this->input->post('asunto');
        $data->estatus = 1;
        $data->detalle = $this->input->post('detalle');
        $data->titulo = $this->input->post('titulo');
        $data->id_user = $this->session->userdata('id');
        if($this->nivel == 14){
            $data->supervisor = $this->plaza;
            $data->gerente = 0;
        }elseif($this->nivel == 21){
            $data->supervisor = 0;
            $data->gerente = $this->plaza;
        }
        
        $this->db->set('modi', 'now()', false);
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('bitacora', $data);
        
        return $this->db->affected_rows();
        
    }

    function eventos()
    {
        if($this->nivel == 14){
            $this->db->where('supervisor', $this->plaza);
        }elseif($this->nivel == 21){
            $this->db->where('gerente', $this->plaza);
        }
        $this->db->join('bitacora_asuntos a', 'b.asunto = a.id_asunto', 'LEFT');
        $query = $this->db->get('bitacora b');
        $a = array();
        foreach($query->result() as $row)
        {
            
            array_push($a, array(
                        'id'    => $row->id,
            			'title' => $row->titulo,
            			'start' => $row->fecha." ".$row->hora_inicio,
            			'end' => $row->fecha." ".$row->hora_fin,
                        'color' => $row->color,
                        'allDay' => false
      		));
            
        }
        
        return json_encode($a);
    }
    
    function eventos_gerente_supervisor($supervisor)
    {
        $this->db->where('supervisor', $supervisor);
        $this->db->join('bitacora_asuntos a', 'b.asunto = a.id_asunto', 'LEFT');
        $query = $this->db->get('bitacora b');
        $a = array();
        foreach($query->result() as $row)
        {
            
            array_push($a, array(
                        'id'    => $row->id,
            			'title' => $row->titulo,
            			'start' => $row->fecha." ".$row->hora_inicio,
            			'end' => $row->fecha." ".$row->hora_fin,
                        'color' => $row->color,
                        'allDay' => false
      		));
            
        }
        
        return json_encode($a);
    }

    function ver_evento($id)
    {
        $this->db->where('id', $id);
        $this->db->join('bitacora_asuntos a', 'b.asunto = a.id_asunto', 'LEFT');
        $query = $this->db->get('bitacora b');
        return $query->row();
    }

}