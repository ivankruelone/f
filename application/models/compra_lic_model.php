<?php
class Compra_lic_model extends CI_Model
{
    var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function nuevo($nombre)
{
$data = array(
'nombre'=>strtoupper($nombre),
'fecha' =>date('Y-m-d'),
'tipo'  =>0);
$this->db->insert('compras.licita_g', $data);
$id_g= $this->db->insert_id();

$s0="insert into compras.licita_c(id_g, codigo, susa, grameje, contenido, presenteta, marca, lab, registro, tipo, clagob)
(SELECT $id_g,codigo,susa,gramaje,contenido,presenta,marca_comercial,lab,registro,0,clagob FROM catalogo.cat_nuevo_general where tipo='A')";
$this->db->query($s0);
$s1="insert into compras.licita_d(codigo, prv, costo, referencia, id_g, id_user, tipo)
(select codigo,prv,costo,preferencia,$id_g,0,0 FROM catalogo.cat_nuevo_general_prv where tipo='A')";
$this->db->query($s1);

    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function compra_lic1()
    {
        
        $id_user= $this->session->userdata('id');
        $plaza= $this->session->userdata('plaza');
        $s="select *from compras.licita_g where tipo=0";   
        $q = $this->db->query($s);
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\">
        <thead>
        
        <tr>
        <th>#</th>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>FECHA</th>
        <th></th>
        </tr>

        </thead>
        <tbody>
        ";
        $color='black';
         foreach($q->result() as $r)
        {
        $l1 = anchor('compra_lic/seleccion_pro/'.$r->id, '<img src="'.base_url().'img/edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para seleccionar!', 'class' => 'encabezado'));    
		$num=$num+1;
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->id."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->nombre."</font></td>
            <td align=\"left\"><font color=\"$color\">".$r->fecha."</font></td>
            <td align=\"left\"><font color=\"$color\">".$l1."</font></td>
            </tr>
            ";
         $pedtot=0;  
        }
         $tabla.="
        </tbody>
        </table>";
        
        return $tabla;
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function general_seleccion($tit)
    {
     $sql = "select *from catalogo.cat_nuevo_general where  tipo='A'
     order by susa,gramaje,contenido,presenta";
     $query = $this->db->query($sql);
         $tabla= "
        <table cellpadding=\"2\" border=\"1\" id=\"tabla\" class=\"display\" style=\"font-size: 10px;\" >
        <caption>$tit</caption>
        <thead>
        <tr>
        <th>#</th>
        <th>Codigo</th>
        <th>Sec</th>
        <th>Clave</th>
        <th colspan=\"1\">Sustancia Activa</th>
        <th colspan=\"1\">Marca Comercial</th>
        <th>Laboratorio</th>
        <th>Registro</th>
        <th>Producto</th>
        <th>Archivo</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        ";
        $color='blue';
        $num=1;
        foreach($query->result() as $row)
        {
         $tabla.="
            <tr>
            <td align=\"left\"><font color=\"$color\">".$num."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->codigo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->sec_cedis."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->clagob."</font></td>
            <td align=\"left\"><font color=\"$color\">".trim($row->susa)." ".trim($row->gramaje)." ".trim($row->contenido)." ".trim($row->presenta)."</font></td>
            <td align=\"left\"><font color=\"$color\">".trim($row->marca_comercial)." ".trim($row->gramaje)." ".trim($row->contenido)." ".trim($row->presenta)."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->lab."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->registro."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->ramo."</font></td>
            <td align=\"left\"><font color=\"$color\">".$row->e_registro."</font></td>
            <td align='right'><button id=\"upload_button_".$row->id."_".trim($row->clagob)."_".trim($row->lab)."\">Registro</button></td>
            </tr>
            ";
         $num=$num+1;
        }
        
        $tabla.="
        </tbody>
        </table>
<script type='text/javascript' language=\"javascript\">
    $(document).on(\"ready\", inicio);
	function inicio(){
	   
       
	}
    $('button[id^=\"upload_button_\"]').on(\"click\", comprobante);
   
  
    function comprobante(datos)
    {
        var boton = datos.currentTarget.attributes.id.value;
        var variables = boton.split('_');
       
      
        id = variables[2];
        clave = variables[3];
        lab = variables[4];
        sube(boton, id, clave,lab);
      
    }
    
    function sube(boton, id, clave, lab){
        
       	var button = $('#' + boton), interval;
        
    	new AjaxUpload('#' + boton, {
    	    action: '".site_url()."/cat_generico/upload_registro/' + id + '/' + clave + '/' + lab,
            
    		onSubmit : function(file , ext){
    		
    		if (! (ext && /^(png|jpg|gif)$/.test(ext))){
    			alert('Error: Solo se permiten .jpg, .png, .gif');
    			return false;
    		} else {
    			button.text('Subiendo el  archivo. Espere un momento por favor...');
    			this.disable();
    		  }
    		},
    		onComplete: function(file, response){
    			button.text('comprobante');
    			this.enable();
    		}	
    
    	});
    }
</script>
";     
        return $tabla;
    
    
    
    
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}