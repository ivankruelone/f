<?php
class Paginas2 extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    
    function trae_detalles()
    {    
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $ip_address = $this->session->userdata('ip_address');
        
        $this->db->select('*');
        $this->db->from('imagenes');
        if($is_logged_in == FALSE && $ip_address == '192.168.1.6'){
            $this->db->where('categoria', 'F');
        }
        $this->db->group_by('categoria');
        $this->db->order_by('id');
        $query = $this->db->get();
        
        $b = null;
        
        foreach($query->result() as $row)
        {
            
            $this->db->select('*');
            $this->db->from('imagenes');
            $this->db->where('categoria', $row->categoria);
            $this->db->where('imagen <>', $row->imagen);
            $query1 = $this->db->get();
            
            
            
            $b.= "
            
            <h2>$row->empresa</h2>
			<div class=\"item-image\">
                <div class=\"gallery clearfix\" >
                <a href=\"".base_url()."imagenes/empresa/$row->imagen\" rel=\"gallery[gallery1]\"><img height=\"250\" width=\"550\" src=\"".base_url()."imagenes/empresa/$row->imagen\" alt=\"$row->descripcion\"></a>                                                  
                   <div class=\"hidden\"> 
                   ";
                
        foreach($query1->result() as $row)
        {
             
             $b.="
                    <a href=\"".base_url()."imagenes/empresa/$row->imagen\" rel=\"gallery[gallery1]\"></a>  
            ";
        }
        
        $b.= "
                </div> 
                </div> 
            </div>
        ";
        
        }
        
        $b.= "
        <script type=\"text/javascript\">
        $(\".gallery a[rel^='gallery']\").prettyPhoto({
            animation_speed:'normal',
            theme:'pp_default',
            deeplinking:false,
            slideshow:3000
            });

		</script>
        ";
        
        
        return $b;
    }
        

}
