<?php
class Vacaciones_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    
    
     function busca_empleado()
    {
        
        $sql = "SELECT * FROM catalogo.cat_empleado where tipo=1 order by completo";
        $query = $this->db->query($sql);
        
        $empleadox = array();
        $empleadox[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox[$row->nomina] = $row->completo;
        }
        
        return $empleadox;  
    }
    
    function busca_empleado1()
    {
        
        $sql = "SELECT * FROM catalogo.cat_empleado where tipo=1 order by completo";
        $query = $this->db->query($sql);
        
        $empleadox = array();
        $empleadox[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox[$row->id] = $row->completo;
        }
        
        return $empleadox;  
    }
    
    function busca_empleado2()
    {
        
        $sql = "SELECT * FROM catalogo.cat_empleado where tipo=1 order by completo";
        $query = $this->db->query($sql);
        
        $empleadox1 = array();
        $empleadox1[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox1[$row->id] = $row->completo;
        }
        
        return $empleadox1;  
    }
    
    function busca_empleado3()
    {
        
        $sql = "SELECT * FROM catalogo.cat_empleado where tipo=1 order by completo";
        $query = $this->db->query($sql);
        
        $empleadox2 = array();
        $empleadox2[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox2[$row->id] = $row->completo;
        }
        
        return $empleadox2;  
    }
    
    function busca_empleado4()
    {
        
        $sql = "SELECT * FROM catalogo.cat_empleado where tipo=1 order by completo";
        $query = $this->db->query($sql);
        
        $empleadox3 = array();
        $empleadox3[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox3[$row->id] = $row->completo;
        }
        
        return $empleadox3;  
    }
    
    function busca_empleado5()
    {
        
        $sql = "SELECT * FROM catalogo.cat_empleado where tipo=1 order by completo";
        $query = $this->db->query($sql);
        
        $empleadox4 = array();
        $empleadox4[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox4[$row->id] = $row->completo;
        }
        
        return $empleadox4;  
    }
    
     function busca_ciclo($empleadox)
    {
        
        $sql = "SELECT * FROM periodo_vacas where nomina=$empleadox tomados<dias";
        $query = $this->db->query($sql);
        
        $ciclox = array();
        $ciclox[0] = "Selecciona el Periodo Vacacional";
        
        foreach($query->result() as $row){
            $ciclox[$row->periodo] = $row->periodo;
        }
        
        return $ciclox;  
    }
    
     function selec_asunto()
    {
        
        $sql = "SELECT * FROM salida_asunto";
        $query = $this->db->query($sql);
        
        $asuntox = array();
        $asuntox[0] = "Selecciona el Asunto";
        
        foreach($query->result() as $row){
            $asuntox[$row->asunto] = $row->asunto;
        }
        
        return $asuntox;  
    }
    
     function regreso()
    {
        
        $sql = "SELECT * FROM salida_regreso";
        $query = $this->db->query($sql);
        
        $regresox = array();
        $regresox[0] = "Selecciona si regresara";
        
        foreach($query->result() as $row){
            $regresox[$row->regreso] = $row->regreso;
        }
        
        return $regresox;  
    }
    
    public function guardar_vacaciones()
    {
        $data = array(
        
        'nomina' => $this->input->post('nombre'),
        'ciclo' => $this->input->post('ciclo'),
        'fec1' => $this->input->post('fec1'),
        'fec2' => $this->input->post('fec2'),
        'dias' => $this->input->post('dias')
        
         );
    
         
         $this->db->set('fec_elab', 'now()', false);
         
         $this->db->insert('desarrollo.reg_vacaciones', $data);
         return $this->db->insert_id();
       
    }
    
    
    function historico_vacaciones($limit, $offset = 0)
    {
        if($offset == null){
            $offset = 0;
        }
        
        $nivel= $this->session->userdata('nivel');
        
        $sql = "SELECT r.*, m.mes, c.succ, a.nombre as sucursal, c.completo as empleado
        FROM reg_vacaciones r
        left join catalogo.cat_empleado c on r.nomina=c.nomina
        left join catalogo.sucursal a on c.succ=a.suc
        left join catalogo.mes m on extract(month from r.fec1) = m.num
        where r.fec1>0 
        order by id desc
        limit $limit offset $offset";
        
        
        $query = $this->db->query($sql);
        
        $tabla = $this->pagination->create_links()."
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th>Departamento</th>
        <th>Empleado</th>
        <th>Fecha I.</th>
        <th>Fecha F</th>
        <th>Dias</th>
        <th>Imp. Formato</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        
        {
            
            $impresion=anchor('vacaciones/imprime/'.$row->id.'/'.$row->succ,'IMPRESION');
        
            
            $tabla.= "
        <tr>
        <td>$row->sucursal</td>
        <td>$row->empleado</td>
        <td>$row->fec1</td>
        <td>$row->fec2</td>
        <td>$row->dias</td>
        <td>$impresion</td>
        </tr>
            ";
        }
        $tabla.='</table>'.$this->pagination->create_links();
        return $tabla;
    }
    
    function busca_vacaciones()
    {
        $empleado=$this->input->post('empleado');
        $fec1=$this->input->post('fec1');
        $ciclo=$this->input->post('ciclo');
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        $sql = "SELECT r.*, m.mes, c.succ, a.nombre as sucursal, c.completo as empleado, z.periodo 
        FROM reg_vacaciones r
        left join catalogo.cat_empleado c on r.nomina=c.nomina
        left join catalogo.sucursal a on c.succ=a.suc
        left join catalogo.mes m on extract(month from r.fec1) = m.num
        left join periodo_vacas z on z.id=r.ciclo
        where c.nomina like '%$empleado%' and r.fec1 like '%$fec1%' and z.periodo like '%$ciclo%'";

        $query = $this->db->query($sql);

        //echo $this->db->last_query();
        //die ();
        
        $tabla1 = "
        <table>
        <thead>
        <tr>
        <th>Departamento</th>
        <th>Empleado</th>
        <th>Fecha I.</th>
        <th>Fecha F</th>
        <th>Dias</th>
        <th>Imp. Formato</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $impresion=anchor('vacaciones/imprime/'.$row->id.'/'.$row->succ,'IMPRESION');
            $tabla1.= "
        <tr>
        <td>$row->sucursal</td>
        <td>$row->empleado</td>
        <td>$row->fec1</td>
        <td>$row->fec2</td>
        <td>$row->dias</td>
        <td>$impresion</td>
        </tr>
            ";
        }
        
        
        $tabla1.= "</table>
        ";
        
        return $tabla1;
    }
    
    function cuenta_vacaciones()
    {
        $sql="SELECT count(*) as cuenta 
		FROM reg_vacaciones r
        left join catalogo.cat_empleado c on r.nomina=c.nomina
        left join catalogo.sucursal a on c.succ=a.suc
        left join catalogo.mes m on extract(month from r.fec1) = m.num;";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
    
    function reporte_vacas($id, $succ)
    {
        $s = "SELECT r.id, r.nomina, r.ciclo, DATE_FORMAT(r.fec1, '%d/%m/%Y') as fec1, DATE_FORMAT(r.fec2, '%d/%m/%Y') as fec2, DATE_FORMAT(r.fec_elab, '%d/%m/%Y %T') as fec_elab, r.dias, b.id_empleado, m.mes, c.succ, a.nombre as sucursal, c.completo as empleado 
        FROM reg_vacaciones r
        left join catalogo.cat_empleado c on r.nomina=c.nomina
        left join catalogo.sucursal a on c.succ=a.suc
        left join catalogo.mes m on extract(month from r.fec1) = m.num
        left join catalogo.jefes_depto b on c.succ=b.suc
        where r.id=$id
        ";
       
       $q = $this->db->query($s);
       
       $s1 = "SELECT b.completo FROM catalogo.jefes_depto a
                left join catalogo.cat_empleado b on b.id=a.id_empleado
                where a.suc=$succ
        ";
       
       $q1 = $this->db->query($s1);
       
       $r1 = $q1->row();
       
       $s2 = "SELECT completo FROM catalogo.cat_empleado where id = ?;";
       $q2 = $this->db->query($s2, GERENTE_RH_ID);
       $r2 = $q2->row();
       
       if($q->num_rows() > 0){
       $row = $q->row();
       $dias=$row->dias;
       $fec1=$row->fec1;
       $fec2=$row->fec2;
       $ciclo=$row->ciclo;
       $sucursal=$row->sucursal;
       
       $tabla = "
        
        <table border=\"0\">
        <tbody>

       
       <tr>
       <td> <img style=\"position:relative; width:184px;\", src=\"'.base_url().'../../imagenes/logo1.png\" /></td>
       <td align=\"center\">Fecha de impresion.:<br />".date('Y-m-d H:i:s')." </td>
       </tr>
       
       <tr>
       <td width=\"475\" align=\"rigth\" style=\"font-size: x-large;\">Dia(s): <b>".$row->dias."</b></td>
       </tr>
       
       <tr>
       <td width=\"475\" align=\"center\">".$row->sucursal." </td>
       </tr>
       
       <tr>
       <td width=\"475\" align=\"center\">Departamento o Sucursal</td>
       </tr>
       
       <tr>
       <td width=\"475\" align=\"center\">N° de Nomina <b>".$row->nomina."</b></td>
       </tr>
       
       <tr>
       <td width=\"475\" align=\"justify\">En cumplimiento al Articulo 76 de la Ley Federal del Trabajo. Hago constar que he disfrutado de mis vacaciones a partir del dia: <b>".$row->fec1."</b>
       para presentarme a mi trabajo el dia de: <b>".$row->fec2."</b> correspondiente al ciclo <b>".$row->ciclo."</b><br /><br />Asi mismo manifiesto que me fue pagada anticipadamente la prima vacacional
       del 25% correspondiente al periodo mencionado.</td>
       </tr>
       
       <tr>
       <td width=\"475\" align=\"rigth\"><br /><br /><br />Elaborado el dia:<br /><b>".$row->fec_elab."</b><br /><br /></td>
       </tr>
       
       ";
          
       
       
       foreach($q->result() as $row)
         {
            
            //$e.="
            
          }
          
        }else{
            
        }
    
         
        $tabla.="    
        <tr>
        
        <td width=\"163\" align=\"center\">Firma del Empleado<br /><br /></td>
        
        <td width=\"163\" align=\"center\">Jefe del Departamento<br /><br /></td>
        
        <td width=\"163\" align=\"center\">Jefe de Recursos Humanos<br /><br /></td>
        
        </tr>
        
        <tr>
        
        <td align=\"center\">___________________</td>
        
        <td align=\"center\">___________________</td>
         
        <td align=\"center\">___________________</td>
        
        </tr>
        
        
        <tr>
        <td align=\"center\">".$row->empleado."</td>
        
        <td align=\"center\">".$r1->completo."</td>
        
        <td align=\"center\">".$r2->completo."</td>
        </tr>";
        
        
        $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
    }
 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    
    function reporte_salida_encabezado()
    {
        $tabla = "
        <table>        
        <tr>
        <td align=\"left\"> <img style=\"position:relative; width:150px;\", src=\"'.base_url().'../../imagenes/logo1.png\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SALIDA AUTORIZADA POR:______________________<br /></td>
        </tr>
        <tr>
        <td align=\"center\">FARMACIAS EL FENIX DEL CENTRO S.A. DE C.V.</td>
        </tr>
        <tr>
        <td align=\"center\">SALIDA AUTORIZADA DEL EDIFICIO</td>
        </tr>
        </table>";
        
        return $tabla;
    } 
    
    function reporte_salida ($empleadox, $empleadox1, $empleadox2, $empleadox3, $empleadox4, $asuntox, $regresox)
    {
        
        $s="SELECT a.id, a.succ, b.nombre, a.nomina, a.completo FROM catalogo.cat_empleado a
            left join catalogo.sucursal b on b.suc=a.succ
            where a.id in ($empleadox, $empleadox1, $empleadox2, $empleadox3, $empleadox4)";
        
        $q = $this->db->query($s);
        
        
        //echo $this->db->last_query();
        //die ();
       
       $a = array(
            '01' => 'ENERO',
            '02' => 'FEBRERO',
            '03' => 'MARZO',
            '04' => 'ABRIL',
            '05' => 'MAYO',
            '06' => 'JUNIO',
            '07' => 'JULIO',
            '08' => 'AGOSTO',
            '09' => 'SEPTIEMBRE',
            '10' => 'OCTUBRE',
            '11' => 'NOVIEMBRE',
            '12' => 'DICIEMBRE'
        );          

        $empleados = null;
                
        foreach($q->result() as $row)
         {
            
            $empleados.= $row->completo.", ";
            
            
    
    
         $s1 = "SELECT b.completo FROM catalogo.jefes_depto a
                left join catalogo.cat_empleado b on b.id=a.id_empleado
                where a.suc=$row->succ
        ";
       
       $q1 = $this->db->query($s1);
       $r1 = $q1->row();
       
       

       
       //echo $this->db->last_query();
       //die ();
          
       
         }
         
         $empleados = substr($empleados, 0, -2).".";
       

       $tabla = "
        
       <table border=\"0\" cellspacing=\"7\">
       <tbody>
       
       
       <tr>
       <td colspan=\"2\" align=\"left\">Nombre:  <b>".$empleados."</b></td>
       </tr>
       
       <tr>
       <td align=\"left\">Departamento:  <b>".$row->nombre."</b></td>
       </tr>
       
       <tr>
       <td align=\"left\">Asunto:  <b>".$asuntox."</b></td>
       <td align=\"left\">Bultos: __________________________________</td>
       </tr>
       
       <tr>
       <td></td>
       <td align=\"left\">Descripcion:______________________________</td>
       </tr>
       
       <tr>
       <td align=\"left\">Autorizo:  <b>".$r1->completo."</b></td>
       <td align=\"left\">Superviso: _______________________________</td>
       </tr>
       
       <tr>
       <td align=\"left\">Firma: __________________________________</td>
       <td align=\"left\">Firma: __________________________________</td>
       </tr>
       
       <tr>
       <td align=\"left\">Regresara:  <b>".$regresox."</b></td>
       <td align=\"left\">Salio:________________________________HRS</td>
       </tr>
       
       
       <tr>
       <td align=\"left\">Expedido a las:  <b>".date('H:i:s')."Hrs</b></td>
       <td align=\"left\">Regres&oacute;:_____________________________HRS<br /><br /></td>
       </tr>
       
       <tr>
       <td colspan=\"2\" align=\"center\"> M&Eacute;XICO, D.F., A ".date('d')." DE ".$a[date('m')]." DEL ".date('Y')."</td>
       </tr>
       
       <tr>
       <td colspan=\"2\" style=\"border-bottom: black; border-bottom-style: dashed; border-bottom-width: thin;\"></td>
       </tr>
       
       ";        
        $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
    }
    
    function reporte_salida1($id_reg)
    {
        
        $s="SELECT r.*, c.succ, a.nombre as sucursal, c.completo as empleado, extract(year from fec_elab) as anio, extract(month from fec_elab) as mes, extract(day from fec_elab) as dia, extract(hour from fec_elab) as tiempo, extract(minute from fec_elab) as tiempo1, extract(second from fec_elab) as tiempo2
        FROM desarrollo.reg_salidas r
        left join desarrollo.reg_salidas_empleados b on r.id=b.id_reg
        left join catalogo.cat_empleado c on b.id_empleado=c.id
        left join catalogo.sucursal a on c.succ=a.suc
        where b.id_reg=$id_reg";
        
        $q = $this->db->query($s);
        
        $a = array(
            '01' => 'ENERO',
            '02' => 'FEBRERO',
            '03' => 'MARZO',
            '04' => 'ABRIL',
            '05' => 'MAYO',
            '06' => 'JUNIO',
            '07' => 'JULIO',
            '08' => 'AGOSTO',
            '09' => 'SEPTIEMBRE',
            '10' => 'OCTUBRE',
            '11' => 'NOVIEMBRE',
            '12' => 'DICIEMBRE'
        );
        
        $empleados = null;
        
        //echo $this->db->last_query();
        //die ();
          
        foreach($q->result() as $row)
         {
    
    
        $empleados.= $row->empleado.", ";
    
         $s1 = "SELECT b.completo FROM catalogo.jefes_depto a
                left join catalogo.cat_empleado b on b.id=a.id_empleado
                where a.suc=$row->succ
        ";
       
       $q1 = $this->db->query($s1);
       
       //echo $this->db->last_query();
       //die ();
       
       $r1 = $q1->row();  
         
       }
       
       
      $empleados = substr($empleados, 0, -2).".";
       
       $tabla = "
        
       <table border=\"0\" cellspacing=\"7\">
       <tbody>
       
       
       <tr>
       <td colspan=\"2\" align=\"left\">Nombre:  <b>".$empleados."</b></td>
       </tr>
       
       <tr>
       <td align=\"left\">Departamento:  <b>".$row->sucursal."</b></td>
       </tr>
       
       <tr>
       <td align=\"left\">Asunto:  <b>".$row->asunto."</b></td>
       <td align=\"left\">Bultos: __________________________________</td>
       </tr>
       
       <tr>
       <td></td>
       <td align=\"left\">Descripcion:______________________________</td>
       </tr>
       
       <tr>
       <td align=\"left\">Autorizo:  <b>".$r1->completo."</b></td>
       <td align=\"left\">Superviso: _______________________________</td>
       </tr>
       
       <tr>
       <td align=\"left\">Firma: __________________________________</td>
       <td align=\"left\">Firma: __________________________________</td>
       </tr>
       
       <tr>
       <td align=\"left\">Regresara:  <b>".$row->regreso."</b></td>
       <td align=\"left\">Salio:________________________________HRS</td>
       </tr>
       
       
       <tr>
       <td align=\"left\">Expedido a las:  <b>".$row->tiempo.":".$row->tiempo1.":".$row->tiempo2."Hrs</b></td>
       <td align=\"left\">Regres&oacute;:_____________________________HRS<br /><br /></td>
       </tr>
       
       <tr>
       <td colspan=\"2\" align=\"center\"> M&Eacute;XICO, D.F., A ".$row->dia." DE ".$a[$row->mes]." DEL ".$row->anio."</td>
       </tr>
       
       <tr>
       <td colspan=\"2\" style=\"border-bottom: black; border-bottom-style: dashed; border-bottom-width: thin;\"></td>
       </tr>
       
       ";
          
       
         
       
        
        $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
    }
    
    public function guardar_salidas()
    {
        $data = array(
        
      
        'asunto' => $this->input->post('asunto'),
        'regreso' => $this->input->post('regreso')
      
        
         );
    
         
         $this->db->set('fec_elab', 'now()', false);
         
         $this->db->insert('desarrollo.reg_salidas', $data);
         $id = $this->db->insert_id();
         
         $emp1= $this->input->post('nombre');
         $emp2= $this->input->post('nombre1');
         $emp3= $this->input->post('nombre2');
         $emp4= $this->input->post('nombre3');
         $emp5= $this->input->post('nombre4');
         //echo $emp1;
         $a=array();
         
         if ($emp1>0){
            $b=array("id_reg"=>$id, "id_empleado"=>$emp1);
            array_push($a, $b);
            
         }
         
         if ($emp2>0){
            $b=array("id_reg"=>$id, "id_empleado"=>$emp2);
            array_push($a, $b);
            
         }
         
         if ($emp3>0){
            $b=array("id_reg"=>$id, "id_empleado"=>$emp3);
            array_push($a, $b);
            
         }
         
         if ($emp4>0){
            $b=array("id_reg"=>$id, "id_empleado"=>$emp4);
            array_push($a, $b);
            
         }
         
         if ($emp5>0){
            $b=array("id_reg"=>$id, "id_empleado"=>$emp5);
            array_push($a, $b);
            
         }
         
         $this->db->insert_batch('reg_salidas_empleados', $a);
         
         //echo "<pre>";
         //print_r($a);
         //echo "</pre>";
         //die();
       
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function cuenta_salidas()
    {
        $sql="SELECT count(*) as cuenta
		FROM desarrollo.reg_salidas r
        left join desarrollo.reg_salidas_empleados b on r.id=b.id_reg
        left join catalogo.cat_empleado c on b.id_reg=c.id
        left join catalogo.sucursal a on c.succ=a.suc";
        
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
    function historico_salidas($limit, $offset = 0)
    {
        if($offset == null){
            $offset = 0;
        }
        
        $nivel= $this->session->userdata('nivel');
        
        $sql = "SELECT r.*, b.*, c.succ, a.nombre as sucursal, c.completo as empleado
        FROM desarrollo.reg_salidas r
        left join desarrollo.reg_salidas_empleados b on r.id=b.id_reg
        left join catalogo.cat_empleado c on b.id_empleado=c.id
        left join catalogo.sucursal a on c.succ=a.suc
        order by b.id desc
        limit $limit offset $offset";
        
        
        $query = $this->db->query($sql);
        
        $tabla = $this->pagination->create_links()."
        <table cellpadding=\"3\">
        <thead>
        <tr>
        <th>Departamento</th>
        <th>Empleado</th>
        <th>Asunto</th>
        <th>Regres&oacute;</th>
        <th>Fecha de elaboraci&oacute;n</th>
        <th>Imp. Formato</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        
        {
            
            $impresion=anchor('vacaciones/imprime1/'.$row->id_reg.'/'.$row->succ,'IMPRESION');
        
            
            $tabla.= "
        <tr>
        <td>$row->sucursal</td>
        <td>$row->empleado</td>
        <td>$row->asunto</td>
        <td>$row->regreso</td>
        <td>$row->fec_elab</td>
        <td>$impresion</td>
        </tr>
            ";
        }
        $tabla.='</table>'.$this->pagination->create_links();
        return $tabla;
    }
    
    function busca_salidas()
    {
        $empleado=$this->input->post('empleado');
        $fec1=$this->input->post('fec1');
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        
        $sql = "SELECT r.*, b.*, c.succ, a.nombre as sucursal, c.completo as empleado
        FROM desarrollo.reg_salidas r
        left join desarrollo.reg_salidas_empleados b on r.id=b.id_reg
        left join catalogo.cat_empleado c on b.id_empleado=c.id
        left join catalogo.sucursal a on c.succ=a.suc
        where c.completo like '%$empleado%' and r.fec_elab like '%$fec1%'
        order by b.id desc";

        $query = $this->db->query($sql);

        //echo $this->db->last_query();
        //die ();
        
        $tabla1 = "
        <table>
        <thead>
        <tr>
        <th>Departamento</th>
        <th>Empleado</th>
        <th>Asunto</th>
        <th>Regres&oacute;</th>
        <th>Fecha de elaboraci&oacute;n</th>
        <th>Imp. Formato</th>
        </tr>
        </thead>";
        
        foreach($query->result() as $row)
        {
            $impresion=anchor('vacaciones/imprime1/'.$row->id.'/'.$row->succ,'IMPRESION');
            $tabla1.= "
        <tr>
        <td>$row->sucursal</td>
        <td>$row->empleado</td>
        <td>$row->asunto</td>
        <td>$row->regreso</td>
        <td>$row->fec_elab</td>
        <td>$impresion</td>
        </tr>
            ";
        }
        
        
        $tabla1.= "</table>
        ";
        
        return $tabla1;
    }
    
    
}