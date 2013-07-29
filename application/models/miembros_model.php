<?php

class Miembros_model extends CI_Model {

	function validate()
	{
	    $this->db->select('u.*, s.nom_suc, s.tipo as razon, p.nombre as plaza_nombre');
        $this->db->from('usuarios u');
        $this->db->join('sucursales s', 'u.suc = s.suc', 'LEFT');
        $this->db->join('plaza p', 'u.plaza = p.no_plaza and u.cia = p.no_cia', 'LEFT');
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', $this->input->post('password'));
        $this->db->where('activo', 1);
		
        
        $a = $this->db->get();
        
        if($a->num_rows() >= 1)
        {
            return $a;
        }else{
            $this->db->select("c.nomina as username, c.nomina, '5000' as nivel, completo as nombre, c.id, id_checador as tipo, puestox as puesto, 'email' as email, succ as suc, s.nombre as nom_suc, c.cia, ciax as razon, c.plaza, 'plaza_nombre' as plaza_nombre", false);
            $this->db->from('catalogo.cat_empleado c');
            $this->db->join('catalogo.sucursal s', 'c.succ = s.suc', 'LEFT');
            $this->db->join('catalogo.cat_compa_nomina n', 'c.cia = n.cia', 'LEFT');
            $this->db->where('c.tipo', 1);
            $this->db->where('c.nomina', $this->input->post('username'));
            $this->db->where('c.pass', $this->input->post('password'));
            $b = $this->db->get();
            
            return $b;
        }
		
	}
    
    function datos_usuario($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('usuarios');
    }
    
    function update_usuario()
    {
        $update = array(
                'username'      => $this->input->post('username'),
                'nombre'        => $this->input->post('nombre'),
                'puesto'        => $this->input->post('puesto'),
                'email'         => $this->input->post('email')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('usuarios', $update);
        $this->session->set_userdata($update);
    }
    
    function update_avatar_cat_empleado($avatar)
    {
        $update = array(
                'imagen' => $avatar
        );
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('catalogo.cat_empleado', $update);
        $this->session->set_userdata($update);
        return "<img src=\"".base_url()."img/avatar/".$avatar."\" />";
    }
	
}