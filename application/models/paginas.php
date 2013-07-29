<?php
class Paginas extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function cuenta()
    {
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $ip_address = $this->session->userdata('ip_address');
        $nivel = $this->session->userdata('nivel');
        
        
        $this->db->select('*');
        $this->db->from('paginas_control');
        $this->db->where('activo', '1');
        
        
        //echo $is_logged_in;
        //echo "<br />";
        //echo $nivel;
        
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
            
        }elseif($is_logged_in == TRUE && $nivel == 2 ){
            $this->db->where('tipo', 'F');
            $this->db->or_where('tipo', 'A');
            
            
        }else{
            
        }    
        $query = $this->db->get();
        
        //echo $this->db->last_query();
        
        return $query->num_rows();
    }
    
    function construye_pika($limit, $offset = 0)
    {
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $ip_address = $this->session->userdata('ip_address');
        $nivel = $this->session->userdata('nivel');
        
        $this->db->select('id');
        $this->db->from('paginas_control');
        $this->db->where('activo', '1');
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
          
        }elseif($is_logged_in == TRUE && $nivel == 2 ){
            $this->db->where('tipo', 'F');
            $this->db->or_where('tipo', 'A');
            
            
        }else{
            
        }    
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        
        $a = null;
        
        foreach($query->result() as $row) {
            
            //$a.="$(\"#pikame$row->id\").PikaChoose({showTooltips:true});
            //";
            $a='<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />';
            }
            
            return $a;
        
    }

function construye_categoria($categoria)
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $ip_address = $this->session->userdata('ip_address');
        $nivel = $this->session->userdata('nivel');
        
        $this->db->select('id');
        $this->db->from('paginas_control');
        $this->db->where('activo', '1');
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
        
        }elseif($is_logged_in == TRUE && $nivel == 2 ){
            $this->db->where('tipo', 'F');
            $this->db->or_where('tipo', 'A');
            
            
        }else{
            
        }    
        $this->db->where('categoria',$categoria);
        $query = $this->db->get();
        
        $a = null;
        
        foreach($query->result() as $row) {
            
            $a.="$(\"#pikame$row->id\").PikaChoose({showTooltips:true});
            ";
            
            }
            
            return $a;
        
    }


    function trae_sitios($limit, $offset = 0)
    {
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $ip_address = $this->session->userdata('ip_address');
        $nivel = $this->session->userdata('nivel');
        
        $this->db->select('*');
        $this->db->from('paginas_control');
        $this->db->where('activo', '1');
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
           
        }elseif($is_logged_in == TRUE && $nivel == 2 ){
            $this->db->where('tipo', 'F');
            $this->db->or_where('tipo', 'A');
            
            
        }else{
            
        }   
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        
        $a = "<div align=\"center\">".$this->pagination->create_links()."</div>";
        
        $a.= "<br /><br />";
        
    
        foreach($query->result() as $row) {

        $a.= "<div class=\"pikachoose\">";
            
            $a.="      
	<ul id=\"pikame$row->id\">";
            
            $a.= $this->trae_detalles($row->id);
    
            $a.= "</ul>
            <br />
            <p align=\"center\"><a href=\"$row->link\" target=\"_blank\">$row->descripcion</a></p>";

        $a.= "
        </div>";

        }
        
        $a.= "<br /><br />";
        $a.= "<div align=\"center\">".$this->pagination->create_links()."</div>";
        
        
        return $a;

    }
    
    
    function trae_sitios_categoria($categoria)
    {
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $ip_address = $this->session->userdata('ip_address');
        $nivel = $this->session->userdata('nivel');
        
        $this->db->select('*');
        $this->db->from('paginas_control');
        $this->db->where('activo', '1');
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
           
        }elseif($is_logged_in == TRUE && $nivel == 2 ){
            $this->db->where('tipo', 'F');
            $this->db->or_where('tipo', 'A');
            
            
        }else{
            
        }   
        $this->db->where('categoria', $categoria);
        $query = $this->db->get();
        
        $a = "<br /><br />";
        
    
        foreach($query->result() as $row) {

        $a.= "<div class=\"pikachoose\">";
            
            $a.="      
	<ul id=\"pikame$row->id\">";
            
            $a.= $this->trae_detalles($row->id);
    
            $a.= "</ul>
            <br />
            <p align=\"center\"><a href=\"$row->link\" target=\"_blank\">$row->descripcion</a></p>";

        $a.= "
        </div>";

        }
        
        $a.= "<br /><br />";
        
        
        return $a;

    }

    function trae_detalles($id)
    {

        $this->db->select('*');
        $this->db->from('paginas_detalle');
        $this->db->where('sitio_id', $id);
        $this->db->limit(4);
        $query = $this->db->get();
        
        $b = null;
        
        foreach($query->result() as $row)
        {
            
            $b.= "
            <li><img src=\"".base_url()."imagenes/proyectos/$row->imagen\" /><span>$row->descripcion</span></li> 
            ";
        }
        
        return $b;
    }
    
    function categorias()
    {
        $is_logged_in = $this->session->userdata('is_logged_in');
        $ip_address = $this->session->userdata('ip_address');
        $nivel = $this->session->userdata('nivel');

        $this->db->select('c.id, c.categoria');
        $this->db->from('categorias_paginas c');
        $this->db->join('paginas_control p', 'c.id = p.categoria');
        $this->db->where('p.activo', '1');
        $this->db->group_by('categoria');
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('tipo', 'F');
            
        }elseif($is_logged_in == TRUE && $nivel == 2 ){
            $this->db->where('tipo', 'F');
            $this->db->or_where('tipo', 'A');
            
            
        }else{
            
        }   
        $query = $this->db->get();
        
        
        $a = "
        <ul>";
        
        foreach($query->result() as $row)
        {
            $a.= "
            <li><a href=\"".site_url()."/welcome/categoria/$row->id\">$row->categoria</a></li>";
        }
        
            $a.= "
            <li><a href=\"".site_url()."/welcome/index\">TODAS</a></li>";

        $a.= "
        </ul>";
        
        return $a;
    }

}
