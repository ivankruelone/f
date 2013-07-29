<?php
class Fac_juridico extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function guardar_nueva()
    {
        $data = array(
           'recepcion' => $this->input->post('recepcion'),
           'razon_social' => $this->input->post('razon_social'),
           'concepto' => $this->input->post('concepto'),
           'factura' => $this->input->post('factura'),
           'importe' => $this->input->post('importe'),  
           'ingreso_caja' => $this->input->post('ingreso_caja'),      
        );
      
     $this->db->insert('cfd', $data);
     return $this->db->insert_id();
    }


    function guardar_deposito()
    {
        $data = array(
          
           'fec_cap' => $this->input->post('fec_cap'),
           'ingreso_brenda' => $this->input->post('ingreso_brenda'),
           'num_recibo' => $this->input->post('num_recibo'),
           'depositos' => $this->input->post('depositos'), 
           'destino' => $this->input->post('destino'),
           'observaciones' => $this->input->post('observaciones'),
                      
        );
      $this->db->where('id',$this->input->post('id'));
     $this->db->update('cfd', $data);
     return $this->db->insert_id();
    }    
    
    
    function guardar_modifica()
    {
        $data = array(
           'recepcion' => $this->input->post('recepcion'),
           'razon_social' => $this->input->post('razon_social'),
           'concepto' => $this->input->post('concepto'),
           'factura' => $this->input->post('factura'),
           'importe' => $this->input->post('importe'),  
           'ingreso_caja' => $this->input->post('ingreso_caja'),
           'ingreso_brenda' => $this->input->post('ingreso_brenda'),
           'num_recibo' => $this->input->post('num_recibo'),
           'depositos' => $this->input->post('depositos'), 
           'destino' => $this->input->post('destino'),
           'observaciones' => $this->input->post('observaciones'),
                      
        );
      $this->db->where('id',$this->input->post('id'));
     $this->db->update('cfd', $data);
     return $this->db->insert_id();
    }    
    
    }