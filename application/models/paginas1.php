<?php
class Paginas1 extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function trae_sitios($limit, $offset)
    {
        $this->db->select('*');
        $this->db->from('imagenes_control');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        
        $a = "<div align=\"center\">".$this->pagination->create_links()."</div>";
        
        $a.= "<br /><br />";


        foreach($query->result() as $row) {

        $a.= "<div class=\"pikachoose\">";
            
            $a.="      
	<ul id=\"pikame$row->id\">";
            
            $a.= $this->trae_detalles($row->categoria);
    
            $a.= "</ul>
            <br />
            <p align=\"center\">$row->empresa</p>";

        $a.= "
        </div>";

        }
        
        $a.= "<br /><br />";
        $a.= "<div align=\"center\">".$this->pagination->create_links()."</div>";
        
        
        return $a;

    }
    
    
    function trae_detalles($categoria)
    {
        $this->db->select('*');
        $this->db->from('imagenes');
        $this->db->where('categoria', $categoria);
        $query = $this->db->get();
        
        $b = null;
        
        foreach($query->result() as $row)
        {
            $b.= "
            <li><img src=\"".base_url()."imagenes/empresa/$row->imagen\" /><span>$row->descripcion</span></li> 
            ";
        }
        
        return $b;
    }

}
