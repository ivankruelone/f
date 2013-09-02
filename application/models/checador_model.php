<?php
class Checador_model extends CI_Model {
    
    var $id = null;
    var $checador_id = null;
    var $depto = null;

    function __construct()
    {
        parent::__construct();
        $this->id = $this->session->userdata('id');
        $this->checador_id = $this->session->userdata('tipo');
        $this->depto = $this->session->userdata('suc');
    }
    
    function get_atributos_empleado()
    {
        $this->db->where('id', $this->id);
        $query = $this->db->get('catalogo.cat_empleado');
        return $query;
    }
    
    function get_atributos_empleado_id($empleado_id)
    {
        $this->db->where('id', $empleado_id);
        $query = $this->db->get('catalogo.cat_empleado');
        return $query;
    }

    function inserta_datos($a)
    {
        $this->db->insert_batch('checador_eventos', $a);
        $sql = "insert into checador_eventos_final (equipo, checador_id, checado) (SELECT equipo, checador_id, checado FROM checador_eventos c group by equipo, checador_id, checado) on duplicate key update equipo = values (equipo), checador_id = values(checador_id), checado = values(checado);";
        $this->db->query($sql);
        $sql_delete = "delete from checador_eventos;";
        $this->db->query($sql_delete);
    }
    
    function get_registros()
    {
        $this->db->select("e.checador_id, DATE_FORMAT(e.checado, '%d/%m/%Y') as checado, DATE_FORMAT(e.checado, '%H:%i') as hora, DAYOFWEEK(e.checado) as dia", false);
        $this->db->from('checador_eventos_final e');
        $this->db->where('checador_id', $this->checador_id);
        $this->db->order_by('e.checado', 'DESC');
        $this->db->limit(200);
        $query = $this->db->get();
        
        return $query;
    }
    
    function get_quincenas()
    {
        $query = $this->db->get('checador_quincenas');
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->id] = $row->inicio." al ".$row->fin;
        }
        
        return $a;
    }
    
    function get_quincenas_sanciones()
    {
        $sql = "SELECT * FROM checador_quincenas c where id not in (select quincena from checador_sanciones);";
        $query = $this->db->query($sql);
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->id] = $row->inicio." al ".$row->fin;
        }
        
        return $a;
    }

    function get_sucursales()
    {
        $sql = "SELECT succ, s.nombre FROM catalogo.cat_empleado c
left join catalogo.sucursal s on c.succ = s.suc
where tipo = 1 and id_checador > 0
group by succ
order by s.nombre;";
        $query = $this->db->query($sql);
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->succ] = $row->nombre;
        }
        
        return $a;
    }

    function get_quincena($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('checador_quincenas');
        return $query;
    }
    
    function get_asistencias_periodo($inicio, $fin)
    {
        $this->db->select("checa, c.*, DATE_FORMAT(c.entrada, '%H:%i') as entradah, DATE_FORMAT(c.salida, '%H:%i') as salidah, DAYOFWEEK(c.fecha) as dia, completo, nomina", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->where('empleado_id', $this->id);
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        $this->db->order_by('c.fecha', 'ASC');
        $query = $this->db->get();
        
        return $query;
    }

    function get_asistencias_sin_huella($succ = null)
    {
        $this->db->select("checa,f.nombre as sucursal,c.*");
        $this->db->from('catalogo.cat_empleado c');
        $this->db->join('catalogo.sucursal f', 'c.succ = f.suc', 'LEFT');
        $this->db->where('succ > 90005 and succ<>90034 and tipo=1 and id_checador=0 or succ=100 and succ<>90034 and tipo=1 and id_checador=0  or succ=900 and succ<>90034 and tipo=1 and id_checador=0 ');
        
        
        $this->db->order_by('checa,sucursal');
        $query = $this->db->get();
        
        //echo $this->db->last_query();
        
        return $query;
    }
    function get_asistencias_periodo_gerente_concentrado($inicio, $fin, $succ = null)
    {
    $id_user= $this->session->userdata('id');
    if($id_user==885){
    $this->db->select("e.entrada,e.salida,checa,f.nombre as depto,DATE_FORMAT(c.entrada, '%H:%i') as entradah, DATE_FORMAT(c.salida, '%H:%i') as salidah, DAYOFWEEK(c.fecha) as dia, completo, e.nomina, sum(horas_decimal) as horas_decimal, sum(falta) as falta, sum(retardo) as retardo, sum(justificada) as justificada, empleado_id", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->join('catalogo.sucursal f', 'e.succ = f.suc', 'LEFT');
        $this->db->where("fecha between '$inicio' and '$fin' and succ=90014 or fecha between '$inicio' and '$fin' and succ=90028", null, FALSE);
        $this->db->where('tipo', 1);
        $this->db->order_by('checa');
        $this->db->group_by('e.id');
        $query = $this->db->get();  
        
    }else{
        $this->db->select("e.entrada,e.salida,checa,f.nombre as depto,DATE_FORMAT(c.entrada, '%H:%i') as entradah, DATE_FORMAT(c.salida, '%H:%i') as salidah, DAYOFWEEK(c.fecha) as dia, completo, e.nomina, sum(horas_decimal) as horas_decimal, sum(falta) as falta, sum(retardo) as retardo, sum(justificada) as justificada, empleado_id", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->join('catalogo.sucursal f', 'e.succ = f.suc', 'LEFT');
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        $this->db->where('tipo', 1);
        if(isset($succ)){
            $this->db->where('succ', $succ);
        }else{
            $this->db->where('succ', $this->depto);
        }

        $this->db->order_by('checa');
        $this->db->group_by('e.id');
        $query = $this->db->get();
  }   
        //echo $this->db->last_query();
        
        return $query;
    }
    ////////////////////////////////////////////
    function get_asistencias_periodo_gerente_concentrado_ger($inicio, $fin, $succ = null)
    {
        $this->db->select("e.entrada,e.salida,checa,f.nombre as depto,DATE_FORMAT(c.entrada, '%H:%i') as entradah, DATE_FORMAT(c.salida, '%H:%i') as salidah, DAYOFWEEK(c.fecha) as dia, completo, e.nomina, sum(horas_decimal) as horas_decimal, sum(falta) as falta, sum(retardo) as retardo, sum(justificada) as justificada, empleado_id", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->join('catalogo.sucursal f', 'e.succ = f.suc', 'LEFT');
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        if(isset($succ)){
            $this->db->where('depto', $succ);
        }else{
            $this->db->where('depto', $this->depto);
        }

        $this->db->order_by('checa');
        $this->db->group_by('e.id');
        $query = $this->db->get();
        
        //echo $this->db->last_query();
        
        return $query;
    }

    function get_asistencias_periodo_gerente_concentrado_retardos($inicio, $fin, $succ = null)
    {
        $this->db->select("e.depto,checa,completo, e.nomina, sum(case when justificada = 1 then 0 else retardo end) as retardo, sum(justificada) as justificada, empleado_id, s.nombre as sucursal, e.puestox", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->join('catalogo.sucursal s', 'e.succ = s.suc', 'LEFT');
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        $this->db->where('succ', $succ);
        $this->db->where('checa', 1);
        $this->db->where('e.tipo', 1);
        $this->db->order_by('e.completo', 'ASC');
        $this->db->group_by('e.id');
        $this->db->having('sum(case when justificada = 1 then 0 else retardo end) >= 3', '', false);
        $query = $this->db->get();
        
        return $query;
    }

    function get_asistencias_periodo_gerente_concentrado_faltas($inicio, $fin, $succ = null)
    {
        $this->db->select("checa,completo, e.nomina, sum(case when justificada = 1 then 0 else falta end) as falta, sum(justificada) as justificada, empleado_id, s.nombre as sucursal, e.puestox", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->join('catalogo.sucursal s', 'e.succ = s.suc', 'LEFT');
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        $this->db->where('succ', $succ);
        $this->db->where('checa', 1);
        $this->db->where('e.tipo', 1);
        $this->db->order_by('e.completo', 'ASC');
        $this->db->group_by('e.id');
        $this->db->having('sum(case when justificada = 1 then 0 else falta end) > 0', '', false);
        $query = $this->db->get();
        
        return $query;
    }

    function get_asistencias_periodo_admin_concentrado($inicio, $fin)
    {
        $this->db->select("checa,succ, s.nombre as sucursal, sum(horas_decimal) as horas_decimal, sum(falta) as falta, sum(retardo) as retardo, sum(justificada) as justificada", FALSE);
        $this->db->from('catalogo.cat_empleado c');
        $this->db->join('catalogo.sucursal s', 'c.succ = s.suc', 'LEFT');
        $this->db->join('checador_asistencia a', "c.id = a.empleado_id and fecha between '$inicio' and '$fin'", 'LEFT');
        $this->db->where('id_checador > 0');
        $this->db->where('checa',1);
        $this->db->where('tipo',1);
        $this->db->group_by('succ');
        $this->db->order_by('s.nombre');
        $query = $this->db->get();
        
        return $query;
    }
    
    function get_justificaciones_incidencias()
    {
        $query = $this->db->get('catalogo.cat_justificacion');
        return $query;
    }
    
    function get_registro($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('checador_asistencia');
        return $query->row();
    }
    
    function inserta_incidencia($asistencia, $justificacion, $observaciones)
    {
        $data = array(
                'asistencia'    => $asistencia,
                'justificacion' => $justificacion,
                'observaciones' => $observaciones
                );
                
        $this->db->insert('checador_incidencias', $data);
        $id = $this->db->insert_id();
        if ( $id > 0 ){
            
            $data2 = array('incidencia' => $id);
            $this->db->where('id', $asistencia);
            $this->db->update('checador_asistencia', $data2);
            
        }
        
        return $id;
    }
    
    function get_incidencia_detalle($incidencia)
    {
        $sql = "SELECT concat(date_format(i.fecha_captura, '%Y%m%d'), '-', LPAD(i.incidencia, 6, '0')) as folio, DATE_FORMAT(i.fecha_captura, '%d/%m/%Y') as fecha_captura, i.incidencia, completo, e.nomina, puestox, DATE_FORMAT(a.fecha, '%d') as fechad, DATE_FORMAT(a.fecha, '%m') as fecham, DATE_FORMAT(a.fecha, '%Y') as fechay, falta, retardo, justifica, UPPER(justificantes) as justificantes, UPPER(observaciones) as observaciones, nombre as sucursal, e.succ
FROM checador_incidencias i
join checador_asistencia a on i.incidencia = a.incidencia
join catalogo.cat_empleado e on a.empleado_id = e.id
join catalogo.cat_justificacion j on j.id = i.justificacion
left join catalogo.sucursal s on s.suc = e.succ
where a.incidencia = ?;";

        $query = $this->db->query($sql, $incidencia);
        
        $incidencia = $query->row();
        
        $sql_jefe = "SELECT concat(trim(titulo), '. ', trim(nom), ' ', trim(pat), ' ', trim(mat)) as jefe FROM catalogo.jefes_depto j
left join catalogo.cat_empleado e on j.id_empleado = e.id
where succ = ?;";

        $query_jefe = $this->db->query($sql_jefe, $incidencia->succ);
        $jefe = $query_jefe->row();
        
        $sql_rh = "SELECT concat(trim(titulo), '. ', trim(nom), ' ', trim(pat), ' ', trim(mat)) as jefe FROM catalogo.jefes_depto j
left join catalogo.cat_empleado e on j.id_empleado = e.id
where id_empleado = ?;";
        
        $query_rh = $this->db->query($sql_rh, GERENTE_RH_ID);
        
        $rh = $query_rh->row();
        
        if ( $incidencia->falta  == 1){ $falta ="FALTA"; }else{ $falta = "RETARDO";}
        
        
        $tabla = "
        <table style=\"width: 100%; font-size: 36px; \">

<tr>
    <td rowspan=\"2\" style=\"width: 20%;\"><img style=\"position:relative; width:150px;\" src=\"".base_url()."imagenes/logo1.png\" /></td>
    <td rowspan=\"2\" style=\"width: 50%; text-align: center; font-size: 50px; \"><b>INCIDENCIAS DE PERSONAL</b></td>
    <td style=\"width: 30%; text-align: center;\">No. Folio</td>
</tr>
<tr>
    <td style=\"width: 30%; text-align: center;\"><b>$incidencia->folio</b></td>
</tr>

<tr>
    <td colspan=\"3\"><hr /></td>
</tr>

<tr>
    <td style=\"width: 70%;\">NOMBRE: </td>
    <td style=\"width: 30%;\" colspan=\"2\">DEPARTAMENTO: </td>
</tr>

<tr>
    <td style=\"width: 70%;\"><b>$incidencia->completo</b></td>
    <td colspan=\"2\" style=\"width: 30%; font-size: 30px; \"><b>$incidencia->sucursal</b></td>
</tr>

<tr>
    <td style=\"width: 25%;\">NO. NOMINA</td>
    <td style=\"width: 50%;\">PUESTO</td>
    <td style=\"width: 25%;\">FECHA</td>
</tr>

<tr>
    <td style=\"width: 25%;\"><b>$incidencia->nomina</b></td>
    <td style=\"width: 50%;\"><b>$incidencia->puestox</b></td>
    <td style=\"width: 25%;\"><b>$incidencia->fecha_captura</b></td>
</tr>

<tr>
    <td>&nbsp;</td>
</tr>

<tr>
    <td colspan=\"3\">JUSTIFICACION: </td>
</tr>

<tr>
    <td colspan=\"3\">MANIFIESTO EL MOTIVO POR EL CUAL REGISTRE INCIDENCIA POR <b>$falta</b> EL DIA <b>$incidencia->fechad DEL MES DE ".nombre_del_mes($incidencia->fecham)." DEL $incidencia->fechay</b>.</td>
</tr>

<tr>
    <td colspan=\"3\"><b><i>$incidencia->justifica</i></b></td>
</tr>

<tr>
    <td colspan=\"3\"><b><i>$incidencia->justificantes</i></b></td>
</tr>

<tr>
    <td colspan=\"3\">OBSERVACIONES: </td>
</tr>

<tr>
    <td colspan=\"3\" style=\"width: 100%; font-size: 30px; height: 80px; \"><b>$incidencia->observaciones</b></td>
</tr>

<tr>
    <td style=\"width: 50%; text-align: center; font-size: 30px; \">SOLICITA $jefe->jefe</td>
    <td colspan=\"2\" style=\"width: 50%; text-align: center; font-size: 30px; \">AUTORIZA $rh->jefe</td>
</tr>

<tr>
    <td>&nbsp;</td>
</tr>

<tr>
    <td style=\"width: 50%; text-align: center; font-size: 30px; \">________________________________________</td>
    <td colspan=\"2\" style=\"width: 50%; text-align: center; font-size: 30px; \">________________________________________</td>
</tr>

<tr>
    <td style=\"width: 50%; text-align: center; font-size: 20px; \">NOMBRE Y FIRMA</td>
    <td colspan=\"2\" style=\"width: 50%; text-align: center; font-size: 20px; \">NOMBRE Y FIRMA</td>
</tr>

<tr>
    <td>&nbsp;</td>
</tr>

<tr>
    <td colspan=\"3\" style=\"font-size: 30px;\"><b>NOTA: TODAS LAS JUSTIFICACIONES DEBEN VENIR DOCUMENTADAS</b></td>
</tr>

<tr>
    <td style=\"text-align: center;\" COLSPAN=\"3\">*** COPIA RECURSOS HUMANOS ***</td>
</tr>

</table>

<br />
<hr />

        <table style=\"width: 100%; font-size: 36px; \">

<tr>
    <td rowspan=\"2\" style=\"width: 20%;\"><img style=\"position:relative; width:150px;\" src=\"".base_url()."imagenes/logo1.png\" /></td>
    <td rowspan=\"2\" style=\"width: 50%; text-align: center; font-size: 50px; \"><b>INCIDENCIAS DE PERSONAL</b></td>
    <td style=\"width: 30%; text-align: center;\">No. Folio</td>
</tr>
<tr>
    <td style=\"width: 30%; text-align: center;\"><b>$incidencia->folio</b></td>
</tr>

<tr>
    <td colspan=\"3\"><hr /></td>
</tr>

<tr>
    <td style=\"width: 70%;\">NOMBRE: </td>
    <td style=\"width: 30%;\" colspan=\"2\">DEPARTAMENTO: </td>
</tr>

<tr>
    <td style=\"width: 70%;\"><b>$incidencia->completo</b></td>
    <td colspan=\"2\" style=\"width: 30%; font-size: 30px; \"><b>$incidencia->sucursal</b></td>
</tr>

<tr>
    <td style=\"width: 25%;\">NO. NOMINA</td>
    <td style=\"width: 50%;\">PUESTO</td>
    <td style=\"width: 25%;\">FECHA</td>
</tr>

<tr>
    <td style=\"width: 25%;\"><b>$incidencia->nomina</b></td>
    <td style=\"width: 50%;\"><b>$incidencia->puestox</b></td>
    <td style=\"width: 25%;\"><b>$incidencia->fecha_captura</b></td>
</tr>

<tr>
    <td>&nbsp;</td>
</tr>

<tr>
    <td colspan=\"3\">JUSTIFICACION: </td>
</tr>

<tr>
    <td colspan=\"3\">MANIFIESTO EL MOTIVO POR EL CUAL REGISTRE INCIDENCIA POR <b>$falta</b> EL DIA <b>$incidencia->fechad DEL MES DE ".nombre_del_mes($incidencia->fecham)." DEL $incidencia->fechay</b>.</td>
</tr>

<tr>
    <td colspan=\"3\"><b><i>$incidencia->justifica</i></b></td>
</tr>

<tr>
    <td colspan=\"3\"><b><i>$incidencia->justificantes</i></b></td>
</tr>

<tr>
    <td colspan=\"3\">OBSERVACIONES: </td>
</tr>

<tr>
    <td colspan=\"3\" style=\"width: 100%; font-size: 30px; height: 80px; \"><b>$incidencia->observaciones</b></td>
</tr>

<tr>
    <td style=\"width: 50%; text-align: center; font-size: 30px; \">SOLICITA $jefe->jefe</td>
    <td colspan=\"2\" style=\"width: 50%; text-align: center; font-size: 30px; \">AUTORIZA $rh->jefe</td>
</tr>

<tr>
    <td>&nbsp;</td>
</tr>

<tr>
    <td style=\"width: 50%; text-align: center; font-size: 30px; \">________________________________________</td>
    <td colspan=\"2\" style=\"width: 50%; text-align: center; font-size: 30px; \">________________________________________</td>
</tr>

<tr>
    <td style=\"width: 50%; text-align: center; font-size: 20px; \">NOMBRE Y FIRMA</td>
    <td colspan=\"2\" style=\"width: 50%; text-align: center; font-size: 20px; \">NOMBRE Y FIRMA</td>
</tr>

<tr>
    <td>&nbsp;</td>
</tr>

<tr>
    <td colspan=\"3\" style=\"font-size: 30px;\"><b>NOTA: TODAS LAS JUSTIFICACIONES DEBEN VENIR DOCUMENTADAS</b></td>
</tr>

<tr>
    <td style=\"text-align: center;\" COLSPAN=\"3\">*** COPIA EMPLEADO ***</td>
</tr>

</table>
        ";
        
        return $tabla;
    }

    function get_asistencias_periodo_gerente_empleado($empleado_id, $inicio, $fin)
    {
        $this->db->select("checa,c.*, DATE_FORMAT(c.entrada, '%H:%i') as entradah, DATE_FORMAT(c.salida, '%H:%i') as salidah, DAYOFWEEK(c.fecha) as dia, completo, nomina, c.id as id_registro", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->where('empleado_id', $empleado_id);
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        $this->db->order_by('c.fecha', 'ASC');
        $query = $this->db->get();
        
        return $query;
    }

    function get_asistencias_empleado()
    {
        $this->db->where('empleado_id', $this->id);
        $query = $this->db->get('checador_asistencia');
        
        return $query;
    }
    
    function get_asistencias_id($id)
    {
        $this->db->select("e.checa,c.*, DATE_FORMAT(c.entrada, '%H:%i') as entradah, DATE_FORMAT(c.salida, '%H:%i') as salidah, DAYOFWEEK(c.fecha) as dia, completo, nomina, c.id as id_registro", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        return $query;
    }

    function valida_cambio_password()
    {
        $pw1 = $this->input->post('password_nuevo1');
        $pw2 = $this->input->post('password_nuevo2');
        
        if($pw1 == $pw2){
            $this->db->where('id', $this->id);
            $this->db->where('pass', $this->input->post('password_actual'));
            $query = $this->db->get('catalogo.cat_empleado');
            $numrows = $query->num_rows();
            
            if($numrows == 1){
                $this->cambio_password($pw2);
                return TRUE;
            }else{
                return FALSE;
            }
            
        }else{
            return FALSE;
        }
    }
    
    private function cambio_password($pass)
    {
        $a = array('pass' => $pass);
        $this->db->where('id', $this->id);
        $this->db->update('catalogo.cat_empleado', $a);
    }
    
    function procesar_datos()
    {
        $sql = "SELECT date(checado) as fecha FROM desarrollo.checador_eventos_final
where checado between ? and ?
group by date(checado);";
        $query = $this->db->query($sql, array($this->input->post('fecha1'), $this->input->post('fecha2')." 23:59:59"));
        
        //echo $this->db->last_query();
        foreach($query->result() as $row)
        {
            $this->calcular($row->fecha);
        }
    }
    
    function procesar_datos_fecha($fecha1, $fecha2)
    {
        $sql = "SELECT date(checado) as fecha FROM desarrollo.checador_eventos_final
where checado between ? and ?
group by date(checado);";
        $query = $this->db->query($sql, array($fecha1, $fecha2." 23:59:59"));
        
        //echo $this->db->last_query();
        foreach($query->result() as $row)
        {
            $this->calcular($row->fecha);
        }
    }

    function calcular($fecha)
    {
        $sql_llenar_asistencias = "insert into checador_asistencia (fecha, empleado_id, hentrada, hsalida) (SELECT ? as fecha, id, entrada, salida FROM catalogo.cat_empleado c where tipo = 1 and id_checador >0) on duplicate key update fecha = values(fecha), empleado_id = values(empleado_id), falta = 0, retardo = 0";
        $this->db->query($sql_llenar_asistencias, $fecha);
        
        //Empieza valuación Turno Diurno
        $sql_updated = "SELECT c.id as id_asistencia, TIMEDIFF(max(checado), min(checado)) as hrstra, TIME_TO_SEC(TIMEDIFF(max(checado), min(checado)))/3600 as hrtradec, min(checado) as min, max(checado) as max
FROM checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join checador_eventos_final f on e.id_checador = f.checador_id
where  c.fecha = '$fecha' and checado between '$fecha' and '$fecha 23:59:59'
and nocturno = 0
group by f.checador_id;";

        $query = $this->db->query($sql_updated);
        
        $a = array();
        foreach($query->result() as $row)
        {
            $b = array(
                'id' => $row->id_asistencia,
                'entrada' => $row->min,
                'salida' => $row->max,
                'horas_tiempo' => $row->hrstra,
                'horas_decimal' => $row->hrtradec
                );
                
            array_push($a, $b);
                
        }
        
        if(count($a) > 0){
            $this->db->update_batch('checador_asistencia', $a, 'id');
        }
        
        //Termina valuacion Turno Diurno
        
        //Empieza valuación Turno Nocturno
        $sql_updated = "SELECT c.id as id_asistencia, TIMEDIFF(max(checado), min(checado)) as hrstra, TIME_TO_SEC(TIMEDIFF(max(checado), min(checado)))/3600 as hrtradec, min(checado) as min, max(checado) as max
FROM checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join checador_eventos_final f on e.id_checador = f.checador_id
where  c.fecha = '$fecha' and checado between '$fecha 12:00:00' and '$fecha 11:59:59' + interval 1 day
and e.nocturno = 1
group by f.checador_id;";

        $query = $this->db->query($sql_updated);
        
        $a = array();
        foreach($query->result() as $row)
        {
            $b = array(
                'id' => $row->id_asistencia,
                'entrada' => $row->min,
                'salida' => $row->max,
                'horas_tiempo' => $row->hrstra,
                'horas_decimal' => $row->hrtradec
                );
                
            array_push($a, $b);
                
        }
        
        if(count($a) > 0){
            $this->db->update_batch('checador_asistencia', $a, 'id');
        }
        
        //Termina valuacion Turno Nocturno

        $this->db->select('id');
        $this->db->from('checador_asistencia');
        $this->db->where('fecha', $fecha);
        $this->db->where('entrada', '0000-00-00 00:00:00');
        $this->db->where('salida', '0000-00-00 00:00:00');
        $query2 = $this->db->get();
        
        $c = array();
        
        foreach($query2->result() as $row2)
        {
            $d = array(
                'id' => $row2->id,
                'falta' => 1
                );
                
            array_push($c, $d);
        }

        $this->db->update_batch('checador_asistencia', $c, 'id');
        

        $this->db->select("c.id, c.fecha, tolerancia, c.entrada, c.hentrada, TIME_TO_SEC(TIMEDIFF(c.entrada, concat(c.fecha, ' ', c.hentrada)))/3600 as diferencia, (tolerancia * 60) / 3600 as tolerancia", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->where('c.fecha', $fecha);
        $this->db->where('falta', 0);
        $this->db->where('e.checa', 1);
        $this->db->having("diferencia > tolerancia", null, FALSE);
        $query3 = $this->db->get();
        
        //echo $this->db->last_query();

        $e = array();
        
        foreach($query3->result() as $row3)
        {
            $f = array(
                'id' => $row3->id,
                'retardo' => 1
                );
                
            array_push($e, $f);
        }
        
        
        if(count($e) > 0){

            $this->db->update_batch('checador_asistencia', $e, 'id');
        
        }
        
        $this->db->select("c.id, TIME_TO_SEC(TIMEDIFF(c.entrada, concat(c.fecha, ' ', t.hentrada_alt)))/3600 as diferencia, (tolerancia * 60) / 3600 as tolerancia", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->join('checador_turnos_alt t', 'e.succ = t.succ', 'LEFT');
        $this->db->where('c.fecha', $fecha);
        $this->db->where('falta', 0);
        $this->db->where('retardo', 1);
        $this->db->where('e.checa', 1);
        $this->db->where('e.turnan', 1);
        $this->db->having("diferencia <= tolerancia and diferencia > -3", null, FALSE);
        $query4 = $this->db->get();

        
        $g = array();
        
        foreach($query4->result() as $row4)
        {
            $h = array(
                'id' => $row4->id,
                'retardo' => 0
                );
                
            array_push($g, $h);
        }

        if(count($g) > 0){

            $this->db->update_batch('checador_asistencia', $g, 'id');
        
        }
        
        
        $sql_dia = "select weekday(?) as dia";
        
        $q_dia = $this->db->query($sql_dia, $fecha);
        
        $r_dia = $q_dia->row();
        
        if($r_dia->dia == 5 || $r_dia->dia == 6){
            $this->db->where('fecha', $fecha);
            $z = array(
                'retardo' => 0,
                'falta' => 0
                );
            $this->db->update('checador_asistencia', $z);
        }
        
        $this->__festivo($fecha);
        $this->__vacaciones($fecha);
        $this->__incapacidades($fecha);
        $this->__memos($fecha);
        $this->__sabado_domingo($fecha);
        
    }
    
    function __festivo($fecha)
    {
        $this->db->where('edificio', $fecha);
        $query = $this->db->get('catalogo.cat_festivo');
        
        if($query->num_rows() > 0){
            $this->db->where('fecha', $fecha);
            $z = array(
                'retardo' => 0,
                'falta' => 0
                );
            $this->db->update('checador_asistencia', $z);
        }
    }
    
    function __vacaciones($fecha)
    {
        $sql = "SELECT e.id
FROM reg_vacaciones r
left join catalogo.cat_empleado e on r.nomina = e.nomina
where ? between fec1 and fec2 and validado = 1;";
        $query = $this->db->query($sql, $fecha);
        
        foreach($query->result() as $row)
        {
            $this->db->where('fecha', $fecha);
            $this->db->where('empleado_id', $row->id);
            
            $z = array(
                'justificada' => 1,
                'motivo' => 'VACACIONES'
                );

            $this->db->update('checador_asistencia', $z);
        }
    }
    
    function __incapacidades($fecha)
    {
        $sql = "SELECT e.id, folio_inca FROM mov_supervisor m
jOIN catalogo.cat_empleado e on m.nomina = e.nomina
JOIN checador_asistencia c on e.id = c.empleado_id
where m.motivo = 5 and m.tipo = 2 and ? between m.fecha_mov and DATE_ADD(m.fecha_mov, interval dias day) and c.fecha = ?;";
        $query = $this->db->query($sql, array($fecha, $fecha));
        
        foreach($query->result() as $row)
        {
            $this->db->where('fecha', $fecha);
            $this->db->where('empleado_id', $row->id);
            
            $z = array(
                'justificada' => 1,
                'motivo' => 'INCAPACIDAD LABORAL, FOLIO: '.$row->folio_inca
                );

            $this->db->update('checador_asistencia', $z);
        }
    }

    function __memos($fecha)
    {
        $sql = "SELECT e.id, asunto, u.nombre, id_validacion FROM reg_memo r
left join catalogo.cat_empleado e on r.nomina = e.nomina
left join usuarios u on r.id_validacion = u.id
where ? between fec1 and fec2 and validado = 1;";
        $query = $this->db->query($sql, array($fecha));
        
        foreach($query->result() as $row)
        {
            $this->db->where('fecha', $fecha);
            $this->db->where('empleado_id', $row->id);
            
            $z = array(
                'justificada' => 1,
                'motivo' => 'MEMORANDUM: '.$row->asunto.', VALIDO: '.$row->nombre,
                'id_justifica' => $row->id_validacion
                );

            $this->db->update('checador_asistencia', $z);
        }
    }
    
    function __sabado_domingo($fecha)
    {
        $sql = "update 
        checador_asistencia 
        set falta = 0, retardo = 0, justificada = 0 
        where fecha = ? and DAYOFWEEK(?) in (1, 7);";
        $this->db->query($sql, array($fecha, $fecha));
    }

    function gerente_justificar_guarda()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->set('fecha_justifica', 'now()', false);
        $a = array('motivo' => $this->input->post('motivo'), 'justificada' => 1, 'id_justifica' => $this->session->userdata('id'));
        $this->db->update('checador_asistencia', $a);
        
        return $this->db->affected_rows();
    }

    function gerente_justificar_quita($id)
    {
        $this->db->where('id', $id);
        $a = array('motivo' => '', 'justificada' => 0, 'id_justifica' => $this->session->userdata('id'));
        $this->db->set('fecha_justifica', 'now()', false);
        $this->db->update('checador_asistencia', $a);
        
        return $this->db->affected_rows();
    }
    
    function get_asistencias_periodo_empleado($empleado_id, $perini, $perfin)
    {
        $sql = "SELECT diac, DATE_FORMAT(fecha, '%d') as fecha1, DATE_FORMAT(entrada, '%H:%i') as entrada, DATE_FORMAT(salida, '%H:%i') as salida, retardo, falta, horas_decimal
FROM checador_asistencia c
LEFT JOIN dias d on DAYOFWEEK(fecha) = dian
where empleado_id = ? and fecha between ? and ?
order by c.fecha;";

        $query = $this->db->query($sql, array($empleado_id, $perini, $perfin));
        
        $this->db->select('c.nomina, c.completo, s.nombre as sucursal');
        $this->db->from('catalogo.cat_empleado c');
        $this->db->join('catalogo.sucursal s', 'c.succ = s.suc', 'LEFT');
        $this->db->where('c.id', $empleado_id);
        $q = $this->db->get();
        
        $r = $q->row();
        
        $dia1 = date("d", strtotime($perini));
        $dia2 = date("d", strtotime($perfin));
        $mes = date("m", strtotime($perfin));
        $anio = date("Y", strtotime($perfin));
        
        $a = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
            );
        
        
        $tabla = '
        <div  style="width: 100%;">
        <table style="width: 80%;" cellpading="0">
        <tr>
        <td style="width: 80%;">Listado de asistencia<br />Del '.$dia1.' al '.$dia2.' de '.$a[$mes].' del '.$anio.'</td>
        <td align="right" style="font-size: large;"><b>'.$r->nomina.'</b></td>
        </tr>
        <tr>
        <td colspan="2"><br /><br /><b>'.$r->completo.'</b><br />'.$r->sucursal.'</td>
        </tr>
        </table>
        <br />  
        <table  style="width: 100%;" cellpadding="7" >
        <thead>
        <tr>
        <th align="center">Dia</th>
        <th align="center">Entrada</th>
        <th align="center">Salida</th>
        <th align="center">Retardo</th>
        <th align="center">Falta</th>
        </tr>
        </thead>
        <tbody>';
        
        $retardo = 0;
        $falta = 0;
        
        foreach($query->result() as $row)
        {
            
            $tabla.= '
            <tr>
            <td style="border-bottom: black; border-bottom-width: 1px; padding-bottom: 10px;">'.$row->diac.' '.$row->fecha1.'</td>
            <td align="center" style="border-bottom: black; border-bottom-width: 1px;">'.$row->entrada.'</td>
            <td align="center" style="border-bottom: black; border-bottom-width: 1px;">'.$row->salida.'</td>
            <td align="right" style="border-bottom: black; border-bottom-width: 1px;">'.$row->retardo.'</td>
            <td align="right" style="border-bottom: black; border-bottom-width: 1px;">'.$row->falta.'</td>
            </tr>';
            
            $retardo = $retardo + $row->retardo;
            $falta = $falta + $row->falta;
        }
        

        $tabla.= '        
        </tbody>
        <tfoot>
        <tr>
        <td colspan="3" align="right">Totales</td>
        <td align="right"><b>'.$retardo.'</b></td>
        <td align="right"><b>'.$falta.'</b></td>
        </tr>
        <tr>
        <td colspan="5" align="center"><br /><br /><br /><br /><br /><br /><br />______________________________</td>
        </tr>
        <tr>
        <td colspan="5" align="center"><br />FIRMA</td>
        </tr>
        </tfoot>
        </table>
        </div>';
        return $tabla;
    }
    
    function get_arreglo($quincena, $succ)
    {
        
        $sql = "SELECT c.id
, sum(case when justificada = 0 and falta = 1 then 1 else 0 end) as faltota
, floor(sum(case when justificada = 0 and retardo = 1 then 1 else 0 end)/3) as falta_retardo
FROM catalogo.cat_empleado c
left join desarrollo.checador_asistencia a on c.id = a.empleado_id
where tipo = 1 and id_checador > 0 and succ = ? and checa = 1 and fecha between ? and ?
group by c.id
having faltota >= 1 or falta_retardo >= 1;";
        
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        $r1 = $q1->row();
        
        $this->procesar_datos_fecha($r1->inicio, $r1->fin);
        
        
        $q2 = $this->db->query($sql, array($succ, $r1->inicio, $r1->fin));
        $a = array();
        
        foreach($q2->result() as $row)
        {
            array_push($a, $this->get_asistencias_periodo_empleado($row->id, $r1->inicio, $r1->fin));
        
        }
        
        return $a;
        
    }
    
    function get_arreglo_retardos($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
                
        $q2 = $this->get_asistencias_periodo_gerente_concentrado_retardos($r1->inicio, $r1->fin, $succ);
        
        $a = array();
        
        foreach($q2->result() as $row)
        {
            array_push($a, $this->get_reporte_retardo($row->nomina, $row->completo, $row->puestox, $row->sucursal, $row->retardo, $r1->inicio, $r1->fin));
            
        }
        
        return $a;
        
    }
    
    function get_reporte_retardo($nomina, $completo, $puesto, $depto, $retardos, $perini, $perfin)
    {
        $faltas = floor($retardos / 3);

        $dia1 = date("d", strtotime($perini));
        $dia2 = date("d", strtotime($perfin));
        $mes = date("m", strtotime($perfin));
        $anio = date("Y", strtotime($perfin));

        $a = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
            );
            
        $b = array(
            '1' => 'UNO',
            '2' => 'DOS',
            '3' => 'TRES',
            '4' => 'CUATRO'
            );

        $a = '<table cellpadding="5">
        <tr>
        <td colspan="4" style="font-size: xx-large; text-align: center;">REPORTE DE AUSENCIA DE PERSONAL</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: right;">DEPARTAMENTO: </td>
        <td colspan="2" style="border-bottom: black; border-bottom-width: 1px; text-align: center;">'.$depto.'</td>
        </tr>
        <tr>
        <td>NOMBRE: </td>
        <td style="text-align: center; border-bottom: black; border-bottom-width: 1px;">'.$completo.'</td>
        <td>FECHA: </td>
        <td style="text-align: center; border-bottom: black; border-bottom-width: 1px;">'.date('d').' DE '.strtoupper($a[date('m')]).' DEL '.date('Y').'</td>
        </tr>
        <tr>
        <td>PUESTO: </td>
        <td style="text-align: center; border-bottom: black; border-bottom-width: 1px;">'.$puesto.'</td>
        <td>DIAS QUE FALTO: </td>
        <td style="text-align: center; border-bottom: black; border-bottom-width: 1px;">'.$faltas.' '.$b[$faltas].'</td>
        </tr>
        <tr>
        <td>MOTIVO: </td>
        <td colspan="3" style="border-bottom: black; border-bottom-width: 1px;">DEBIDO A '.$retardos.' RETARDOS ACUMULADOS DEL '.$dia1.' AL '.$dia2.' DE '.strtoupper($a[$mes]).' DEL '.$anio.'</td>
        </tr>
        <tr>
        <td colspan="4" style="border-bottom: black; border-bottom-width: 1px;">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="2">FUE REPORTADO: </td>
        <td colspan="2" style="text-align: center;">SI _____________ NO _____________</td>
        </tr>
        <tr>
        <td colspan="2">SI FUE POR ENFERMEDAD, PRESENTO POSTERIORMENTE JUSTIFICANTE</td>
        <td colspan="2" style="text-align: center;">SI _____________ NO _____________</td>
        </tr>
        <tr>
        <td>OBSERVACIONES: </td>
        <td colspan="3" style="border-bottom: black; border-bottom-width: 1px;"></td>
        </tr>
        <tr>
        <td colspan="4" style="border-bottom: black; border-bottom-width: 1px;">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;">_____________________</td>
        <td colspan="2" style="text-align: center;">_____________________</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;">FIRMA DEL EMPLEADO</td>
        <td colspan="2" style="text-align: center;">FIRMA DEL JEFE DEPTO.</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4" style="border-top: silver; border-top-color: silver; border-top-width: 1px; border-top-style: dashed;">&nbsp;</td>
        </tr>
        </table>';
        
        return $a;
    }

    function get_arreglo_faltas($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
                
        $q2 = $this->get_asistencias_periodo_gerente_concentrado_faltas($r1->inicio, $r1->fin, $succ);
        
        $a = array();
        
        foreach($q2->result() as $row)
        {
            array_push($a, $this->get_reporte_falta($row->nomina, $row->completo, $row->puestox, $row->sucursal, $row->falta, $r1->inicio, $r1->fin));
            
        }
        
        return $a;
        
    }

    function get_reporte_falta($nomina, $completo, $puesto, $depto, $falta, $perini, $perfin)
    {

        $dia1 = date("d", strtotime($perini));
        $dia2 = date("d", strtotime($perfin));
        $mes = date("m", strtotime($perfin));
        $anio = date("Y", strtotime($perfin));

        $a = array(
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
            );
            
        $b = array(
            '1' => 'UNO',
            '2' => 'DOS',
            '3' => 'TRES',
            '4' => 'CUATRO',
            '5' => 'CINCO',
            '6' => 'SEIS',
            '7' => 'SIETE',
            '8' => 'OCHO',
            '9' => 'NUEVE',
            '10' => 'DIEZ',
            '11' => 'ONCE',
            '12' => 'DOCE',
            '13' => 'TRECE',
            '14' => 'CATORCE',
            '15' => 'QUINCE'
            );

        $a = '<table cellpadding="5">
        <tr>
        <td colspan="4" style="font-size: xx-large; text-align: center;">REPORTE DE AUSENCIA DE PERSONAL</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: right;">DEPARTAMENTO: </td>
        <td colspan="2" style="border-bottom: black; border-bottom-width: 1px; text-align: center;">'.$depto.'</td>
        </tr>
        <tr>
        <td>NOMBRE: </td>
        <td style="text-align: center; border-bottom: black; border-bottom-width: 1px;">'.$completo.'</td>
        <td>FECHA: </td>
        <td style="text-align: center; border-bottom: black; border-bottom-width: 1px;">'.date('d').' DE '.strtoupper($a[date('m')]).' DEL '.date('Y').'</td>
        </tr>
        <tr>
        <td>PUESTO: </td>
        <td style="text-align: center; border-bottom: black; border-bottom-width: 1px;">'.$puesto.'</td>
        <td>DIAS QUE FALTO: </td>
        <td style="text-align: center; border-bottom: black; border-bottom-width: 1px;">'.$falta.' '.$b[$falta].'</td>
        </tr>
        <tr>
        <td>MOTIVO: </td>
        <td colspan="3" style="border-bottom: black; border-bottom-width: 1px;">DEBIDO A '.$falta.' FALTA(S) ACUMULADAS DEL '.$dia1.' AL '.$dia2.' DE '.strtoupper($a[$mes]).' DEL '.$anio.'</td>
        </tr>
        <tr>
        <td colspan="4" style="border-bottom: black; border-bottom-width: 1px;">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="2">FUE REPORTADO: </td>
        <td colspan="2" style="text-align: center;">SI _____________ NO _____________</td>
        </tr>
        <tr>
        <td colspan="2">SI FUE POR ENFERMEDAD, PRESENTO POSTERIORMENTE JUSTIFICANTE</td>
        <td colspan="2" style="text-align: center;">SI _____________ NO _____________</td>
        </tr>
        <tr>
        <td>OBSERVACIONES: </td>
        <td colspan="3" style="border-bottom: black; border-bottom-width: 1px;"></td>
        </tr>
        <tr>
        <td colspan="4" style="border-bottom: black; border-bottom-width: 1px;">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;">_____________________</td>
        <td colspan="2" style="text-align: center;">_____________________</td>
        </tr>
        <tr>
        <td colspan="2" style="text-align: center;">FIRMA DEL EMPLEADO</td>
        <td colspan="2" style="text-align: center;">FIRMA DEL JEFE DEPTO.</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="4" style="border-top: silver; border-top-color: silver; border-top-width: 1px; border-top-style: dashed;">&nbsp;</td>
        </tr>
        </table>';
        return $a;
    }
    
    public function get_reporte_juntificacion($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "SELECT f.suc, f.nombre, e.nomina, completo, fecha, motivo, ifnull(u.nombre, 'PREDETERMINADO') as usuario FROM desarrollo.checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal f on e.succ = f.suc
left join usuarios u on c.id_justifica = u.id
where justificada = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ?
order by nombre, e.completo, fecha;";

        $query = $this->db->query($sql, array($r1->inicio, $r1->fin, $succ));
        
        $tabla = '
        <h4>REPORTE DE JUSTIFICACIONES APLICADAS.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="20%" style="font-size: 18px;">Depto.</th>
                <th width="6%" style="font-size: 18px;"># Nomina</th>
                <th width="25%" style="font-size: 18px;">Nombre</th>
                <th width="6%" style="font-size: 18px;">Fecha</th>
                <th width="43%" style="font-size: 18px;">Motivo</th>
            </tr>
        </thead>
        <tbody>';
        
        foreach($query->result() as $row)
        {
            $tabla .= '<tr>
                <td width="20%" style="font-size: 18px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->nomina . '</td>
                <td width="25%" style="font-size: 18px;">' . $row->completo . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->fecha . '</td>
                <td width="43%" style="font-size: 18px;">' . $row->motivo . ' (' . $row->usuario . ')</td>
            </tr>';
        }
        
        $tabla .= '</tbody>
        <tfoot>
        <tr>
        <td colspan="5">
            <p align="center" style="font-size: 18px; padding-top: 80px;"><br /><br /><br /><br /><br />__________________________________</p>
            <p align="center" style="font-size: 18px;">NOMBRE Y FIRMA</p>
        </td>
        </tr>
        </tfoot>
        </table>';
        
        
        return $tabla;
        
    }
    
    public function get_reporte_juntificacion2($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "SELECT DATE_FORMAT(c.entrada, '%H:%i:%s') as entrada, DATE_FORMAT(c.salida, '%H:%i:%s') as salida, f.suc, f.nombre, e.nomina, completo, fecha, motivo, case when falta = 1 then 'FALTA' when retardo = 1 then 'RETARDO' else '' end as ley1, case when justificada = 0 then 'NO JUST.' when justificada = 1 then 'JUST.' else '' end as ley2, ifnull(u.nombre, 'PREDETERMINADO') as usuario 
        FROM desarrollo.checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal f on e.succ = f.suc
left join usuarios u on c.id_justifica = u.id
where (justificada = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ? ) or (falta = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ?) or (retardo = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ?)
order by nombre, e.completo, fecha;";

        $query = $this->db->query($sql, array($r1->inicio, $r1->fin, $succ, $r1->inicio, $r1->fin, $succ, $r1->inicio, $r1->fin, $succ));
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = '
        <h4>REPORTE DE JUSTIFICACIONES APLICADAS.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="17%" style="font-size: 18px;">Depto.</th>
                <th width="6%" style="font-size: 18px;"># Nomina</th>
                <th width="19%" style="font-size: 18px;">Nombre</th>
                <th width="6%" style="font-size: 18px;">Fecha</th>
                <th width="6%" style="font-size: 18px;">Entrada</th>
                <th width="6%" style="font-size: 18px;">Salida</th>
                <th width="6%" style="font-size: 18px;">Tip</th>
                <th width="6%" style="font-size: 18px;">Sta</th>
                <th width="28%" style="font-size: 18px;">Motivo</th>
            </tr>
        </thead>
        <tbody>';
        
        foreach($query->result() as $row)
        {
            $tabla .= '<tr>
                <td width="17%" style="font-size: 18px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->nomina . '</td>
                <td width="19%" style="font-size: 18px;">' . $row->completo . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->fecha . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->entrada . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->salida . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->ley1 . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->ley2 . '</td>
                <td width="28%" style="font-size: 18px;">' . $row->motivo . ' (' . $row->usuario . ')</td>
            </tr>';
        }
        
        $tabla .= '</tbody>
        <tfoot>
        <tr>
        <td colspan="9">
            <p align="center" style="font-size: 18px; padding-top: 80px;"><br /><br /><br /><br /><br />__________________________________</p>
            <p align="center" style="font-size: 18px;">NOMBRE Y FIRMA</p>
        </td>
        </tr>
        </tfoot>
        </table>';
        
        
        return $tabla;
        
    }
    
    public function get_reporte_juntificacion2_marysol($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "SELECT DATE_FORMAT(c.entrada, '%H:%i:%s') as entrada, DATE_FORMAT(c.salida, '%H:%i:%s') as salida, f.suc, f.nombre, e.nomina, completo, fecha, motivo, case when falta = 1 then 'FALTA' when retardo = 1 then 'RETARDO' else '' end as ley1, case when justificada = 0 then 'NO JUST.' when justificada = 1 then 'JUST.' else '' end as ley2, ifnull(u.nombre, 'PREDETERMINADO') as usuario 
        FROM desarrollo.checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal f on e.succ = f.suc
left join usuarios u on c.id_justifica = u.id
where (justificada = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ? and motivo<>'vacaciones' and motivo not like 'incapacidad laboral, folio:%' ) or (falta = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ? and motivo<>'vacaciones' and motivo not like 'incapacidad laboral, folio:%') or (retardo = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ?)
order by nombre, e.completo, fecha;";

        $query = $this->db->query($sql, array($r1->inicio, $r1->fin, $succ, $r1->inicio, $r1->fin, $succ, $r1->inicio, $r1->fin, $succ));
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = '
        <h4>REPORTE DE JUSTIFICACIONES APLICADAS.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="17%" style="font-size: 18px;">Depto.</th>
                <th width="6%" style="font-size: 18px;"># Nomina</th>
                <th width="19%" style="font-size: 18px;">Nombre</th>
                <th width="6%" style="font-size: 18px;">Fecha</th>
                <th width="6%" style="font-size: 18px;">Entrada</th>
                <th width="6%" style="font-size: 18px;">Salida</th>
                <th width="6%" style="font-size: 18px;">Tip</th>
                <th width="6%" style="font-size: 18px;">Sta</th>
                <th width="28%" style="font-size: 18px;">Motivo</th>
            </tr>
        </thead>
        <tbody>';
        
        foreach($query->result() as $row)
        {
            $tabla .= '<tr>
                <td width="17%" style="font-size: 18px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->nomina . '</td>
                <td width="19%" style="font-size: 18px;">' . $row->completo . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->fecha . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->entrada . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->salida . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->ley1 . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->ley2 . '</td>
                <td width="28%" style="font-size: 18px;">' . $row->motivo . ' (' . $row->usuario . ')</td>
            </tr>';
        }
        
        $tabla .= '</tbody>
        <tfoot>
        <tr>
        <td colspan="9">
            <p align="center" style="font-size: 18px; padding-top: 80px;"><br /><br /><br /><br /><br />__________________________________</p>
            <p align="center" style="font-size: 18px;">NOMBRE Y FIRMA</p>
        </td>
        </tr>
        </tfoot>
        </table>';
        
        
        return $tabla;
        
    }
    
    public function get_reporte_horas_marysol($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "SELECT sum(c.horas_decimal)
                + sum(case when falta = 1 and justificada = 1 and motivo = 'VACACIONES' then 9 * falta else 0 end)
                + sum(case when falta = 1 and justificada = 1 and motivo like '%incapacidad laboral, folio%' then 9 * falta else 0 end) as horas, f.suc, f.nombre, e.nomina, completo, sum(falta), sum(justificada), motivo
                FROM desarrollo.checador_asistencia c
                left join catalogo.cat_empleado e on c.empleado_id = e.id
                left join catalogo.sucursal f on e.succ = f.suc
                left join desarrollo.usuarios u on c.id_justifica = u.id
                where fecha between ? and ? and e.tipo = 1 and f.suc = ?
                group by c.empleado_id
                order by horas;";

        $query = $this->db->query($sql, array($r1->inicio, $r1->fin, $succ));
        
         $s1 = "SELECT * FROM desarrollo.checador_quincenas where inicio = ? and fin = ?
        ";
       
       $q1 = $this->db->query($s1, array($r1->inicio, $r1->fin));
       $r1 = $q1->row();
        
        //echo $this->db->last_query();
        //die();
         
        
        $tabla = '
        <h4>REPORTE DE HORAS LABORADAS.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="17%" style="font-size: 20px;">Depto.</th>
                <th width="6%" style="font-size: 20px;"># Nomina</th>
                <th width="19%" style="font-size: 20px;">Nombre</th>
                
                <th width="10%" style="font-size: 20px;">Horas Trabajadas</th>
                <th width="10%" style="font-size: 20px;">Horas a Trabajar</th>
                <th width="10%" style="font-size: 20px;">Tiempo Faltante</th>
               
              
            </tr>
        </thead>
        <tbody>';
        
        foreach($query->result() as $row)
        {
            
        $horas_faltantes =$r1->horas_laboradas - $row->horas;   
            
            
            $tabla .= '<tr>
                <td width="17%" style="font-size: 20px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 20px;">' . $row->nomina . '</td>
                <td width="19%" style="font-size: 20px;">' . $row->completo . '</td>
                
                <td width="10%" style="font-size: 20px;">' . $row->horas . '</td>
                <td width="10%" style="font-size: 20px;">' . $r1->horas_laboradas . '</td>
                <td width="10%" style="font-size: 20px;">' . $horas_faltantes . '</td>
                
               
            </tr>';
        }
        
        $tabla .= '</tbody>
        <tfoot>
        <tr>
        <td colspan="6">
            <p align="center" style="font-size: 18px; padding-top: 80px;"><br /><br /><br /><br /><br />__________________________________</p>
            <p align="center" style="font-size: 18px;">NOMBRE Y FIRMA</p>
        </td>
        </tr>
        </tfoot>
        </table>';
        
        
        return $tabla;
        
    }
    
    public function get_reporte_juntificacion2_gerente($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "SELECT DATE_FORMAT(c.entrada, '%H:%i:%s') as entrada, DATE_FORMAT(c.salida, '%H:%i:%s') as salida, f.suc, f.nombre, e.nomina, completo, fecha, motivo, case when falta = 1 then 'FALTA' when retardo = 1 then 'RETARDO' else '' end as ley1, case when justificada = 0 then 'NO JUST.' when justificada = 1 then 'JUST.' else '' end as ley2, ifnull(u.nombre, 'PREDETERMINADO') as usuario 
        FROM desarrollo.checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal f on e.succ = f.suc
left join usuarios u on c.id_justifica = u.id
where (justificada = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ? and motivo<>'vacaciones' and motivo not like 'incapacidad laboral, folio:%' ) or (falta = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ? and motivo<>'vacaciones' and motivo not like 'incapacidad laboral, folio:%') or (retardo = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ?)
order by nombre, e.completo, fecha;";

        $query = $this->db->query($sql, array($r1->inicio, $r1->fin, $succ, $r1->inicio, $r1->fin, $succ, $r1->inicio, $r1->fin, $succ));
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = '
        <h4>REPORTE DE JUSTIFICACIONES APLICADAS.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="17%" style="font-size: 18px;">Depto.</th>
                <th width="6%" style="font-size: 18px;"># Nomina</th>
                <th width="19%" style="font-size: 18px;">Nombre</th>
                <th width="6%" style="font-size: 18px;">Fecha</th>
                <th width="6%" style="font-size: 18px;">Entrada</th>
                <th width="6%" style="font-size: 18px;">Salida</th>
                <th width="6%" style="font-size: 18px;">Tip</th>
                <th width="6%" style="font-size: 18px;">Sta</th>
                <th width="28%" style="font-size: 18px;">Motivo</th>
            </tr>
        </thead>
        <tbody>';
        
        foreach($query->result() as $row)
        {
            $tabla .= '<tr>
                <td width="17%" style="font-size: 18px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->nomina . '</td>
                <td width="19%" style="font-size: 18px;">' . $row->completo . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->fecha . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->entrada . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->salida . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->ley1 . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->ley2 . '</td>
                <td width="28%" style="font-size: 18px;">' . $row->motivo . ' (' . $row->usuario . ')</td>
            </tr>';
        }
        
        $tabla .= '</tbody>
        <tfoot>
        <tr>
        <td colspan="9">
            <p align="center" style="font-size: 18px; padding-top: 80px;"><br /><br /><br /><br /><br />__________________________________</p>
            <p align="center" style="font-size: 18px;">NOMBRE Y FIRMA</p>
        </td>
        </tr>
        </tfoot>
        </table>';
        
        
        return $tabla;
        
    }
    
    public function get_reporte_horas_gerente($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "SELECT sum(c.horas_decimal)
                + sum(case when falta = 1 and justificada = 1 and motivo = 'VACACIONES' then 9 * falta else 0 end)
                + sum(case when falta = 1 and justificada = 1 and motivo like '%incapacidad laboral, folio%' then 9 * falta else 0 end) as horas, f.suc, f.nombre, e.nomina, completo, sum(falta), sum(justificada), motivo
                FROM desarrollo.checador_asistencia c
                left join catalogo.cat_empleado e on c.empleado_id = e.id
                left join catalogo.sucursal f on e.succ = f.suc
                left join desarrollo.usuarios u on c.id_justifica = u.id
                where fecha between ? and ? and e.tipo = 1 and f.suc = ?
                group by c.empleado_id
                order by horas;";

        $query = $this->db->query($sql, array($r1->inicio, $r1->fin, $succ));
        
         $s1 = "SELECT * FROM desarrollo.checador_quincenas where inicio = ? and fin = ?
        ";
       
       $q1 = $this->db->query($s1, array($r1->inicio, $r1->fin));
       $r1 = $q1->row();
        
        //echo $this->db->last_query();
        //die();
         
        
        $tabla = '
        <h4>REPORTE DE HORAS LABORADAS.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="17%" style="font-size: 20px;">Depto.</th>
                <th width="6%" style="font-size: 20px;"># Nomina</th>
                <th width="19%" style="font-size: 20px;">Nombre</th>
                
                <th width="10%" style="font-size: 20px;">Horas Trabajadas</th>
                <th width="10%" style="font-size: 20px;">Horas a Trabajar</th>
                <th width="10%" style="font-size: 20px;">Tiempo Faltante</th>
               
              
            </tr>
        </thead>
        <tbody>';
        
        foreach($query->result() as $row)
        {
            
        $horas_faltantes =$r1->horas_laboradas - $row->horas;   
            
            
            $tabla .= '<tr>
                <td width="17%" style="font-size: 20px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 20px;">' . $row->nomina . '</td>
                <td width="19%" style="font-size: 20px;">' . $row->completo . '</td>
                
                <td width="10%" style="font-size: 20px;">' . $row->horas . '</td>
                <td width="10%" style="font-size: 20px;">' . $r1->horas_laboradas . '</td>
                <td width="10%" style="font-size: 20px;">' . $horas_faltantes . '</td>
                
               
            </tr>';
        }
        
        $tabla .= '</tbody>
        <tfoot>
        <tr>
        <td colspan="6">
            <p align="center" style="font-size: 18px; padding-top: 80px;"><br /><br /><br /><br /><br />__________________________________</p>
            <p align="center" style="font-size: 18px;">NOMBRE Y FIRMA</p>
        </td>
        </tr>
        </tfoot>
        </table>';
        
        
        return $tabla;
        
    }
    
    public function get_reporte_juntificacion2_moronatti($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "select f.nombre, e.nomina, e.completo, dias_laborados, count(*) as eficiencia, c.id, c.fecha, c.entrada, c.hentrada, TIME_TO_SEC(TIMEDIFF(c.entrada, concat(c.fecha, ' ', c.hentrada)))/3600 as diferencia
from desarrollo.checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join desarrollo.checador_quincenas q on c.fecha >= inicio and c.fecha <= fin
left join catalogo.sucursal f on e.succ=f.suc
where c.entrada between ? and ? and falta = 0 and checa = 1 and succ = ? and e.nocturno=0 and dayofweek(c.fecha) not in(7, 1) and e.cia <> 8 and TIME_TO_SEC(TIMEDIFF(c.entrada, concat(c.fecha, ' ', c.hentrada)))/3600 <= 0
group by empleado_id
order by eficiencia desc";

        $query = $this->db->query($sql, array($r1->inicio, $r1->fin.' 11:59:59', $succ));
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = '
        <h4>REPORTE DE PUNTUALIDAD TURNO MATUTINO.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="6%" style="font-size: 25px;">#</th>
                <th width="17%" style="font-size: 25px;">Depto.</th>
                <th width="6%" style="font-size: 25px;"># Nomina</th>
                <th width="29%" style="font-size: 25px;">Nombre</th>
                <th width="6%" style="font-size: 25px;">Dias Totales</th>
                <th width="6%" style="font-size: 25px;">Dias Puntuales</th>
            </tr>
        </thead>
        <tbody>';
        $num=0;
        
        foreach($query->result() as $row)
        {
            $num=$num+1;
            
            $tabla .= '<tr>
                <td width="6%" style="font-size: 25px;">' .$num. '</td>
                <td width="17%" style="font-size: 25px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 25px;">' . $row->nomina . '</td>
                <td width="29%" style="font-size: 25px;">' . $row->completo . '</td>
                <td width="6%" style="font-size: 25px;">' . $row->dias_laborados . '</td>
                <td width="6%" style="font-size: 25px;">' . $row->eficiencia . '</td>
            </tr>';
        }
        
        $tabla .= '</tbody>
        </table>';
        
        
        return $tabla;
        
    }
    
    public function get_reporte_juntificacion1_moronatti($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "select f.nombre, e.nomina, e.completo, dias_laborados, count(*) as eficiencia, c.id, c.fecha, c.entrada, c.hentrada, TIME_TO_SEC(TIMEDIFF(c.entrada, concat(c.fecha, ' ', c.hentrada)))/3600 as diferencia
from desarrollo.checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join desarrollo.checador_quincenas q on c.fecha >= inicio and c.fecha <= fin
left join catalogo.sucursal f on e.succ=f.suc
where c.entrada between ? and ? and falta = 0 and checa = 1 and succ= ? and nocturno=1 and dayofweek(c.fecha) not in(7, 1) and e.cia <> 8 and TIME_TO_SEC(TIMEDIFF(c.entrada, concat(c.fecha, ' ', c.hentrada)))/3600 <= 0
group by empleado_id
order by eficiencia desc";

        $query = $this->db->query($sql, array($r1->inicio.' 12:00:00', $r1->fin.' 23:59:59', $succ));
        
        //echo $this->db->last_query();
        //die();
        
        $tabla = '
        <h4>REPORTE DE PUNTUALIDAD TURNO NOCTURNO.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="6%" style="font-size: 25px;">#</th>
                <th width="17%" style="font-size: 25px;">Depto.</th>
                <th width="6%" style="font-size: 25px;"># Nomina</th>
                <th width="29%" style="font-size: 25px;">Nombre</th>
                <th width="6%" style="font-size: 25px;">Dias Totales</th>
                <th width="6%" style="font-size: 25px;">Dias Puntuales</th>
            </tr>
        </thead>
        <tbody>';
        $num=0;
        
        foreach($query->result() as $row)
        {
            $num=$num+1;
            
            $tabla .= '<tr>
                <td width="6%" style="font-size: 25px;">' .$num. '</td>
                <td width="17%" style="font-size: 25px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 25px;">' . $row->nomina . '</td>
                <td width="29%" style="font-size: 25px;">' . $row->completo . '</td>
                <td width="6%" style="font-size: 25px;">' . $row->dias_laborados . '</td>
                <td width="6%" style="font-size: 25px;">' . $row->eficiencia . '</td>
            </tr>';
        }
        
        $tabla .= '</tbody>
        </table>';
        
        
        return $tabla;
        
    }
    

    public function get_reporte_juntificacion3($quincena, $succ)
    {
        $this->db->where('id', $quincena);
        $q1 = $this->db->get('checador_quincenas');
        
        $r1 = $q1->row();
        
        $sql = "SELECT f.suc, f.nombre, e.nomina, completo, sum(falta) as falta, sum(retardo) as retardo, sum(justificada) as justificada
        FROM desarrollo.checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal f on e.succ = f.suc
left join usuarios u on c.id_justifica = u.id
where (justificada = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ? ) or (falta = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ?) or (retardo = 1 and fecha between ? and ? and e.tipo = 1 and f.suc = ?)
group by e.completo
order by nombre, e.completo, fecha;";

        $query = $this->db->query($sql, array($r1->inicio, $r1->fin, $succ, $r1->inicio, $r1->fin, $succ, $r1->inicio, $r1->fin, $succ));
        
        //echo $this->db->last_query();
        
        $tabla = '
        <h4>REPORTE DE JUSTIFICACIONES APLICADAS.</h4>
        <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
            <tr>
                <th width="20%" style="font-size: 18px;">Depto.</th>
                <th width="6%" style="font-size: 18px;"># Nomina</th>
                <th width="20%" style="font-size: 18px;">Nombre</th>
                <th width="6%" style="font-size: 18px;">Faltas</th>
                <th width="6%" style="font-size: 18px;">Retardos</th>
                <th width="6%" style="font-size: 18px;">Just.</th>
            </tr>
        </thead>
        <tbody>';
        
        $faltas = 0;
        $retardos = 0;
        $justificaciones = 0;
        
        foreach($query->result() as $row)
        {
            $tabla .= '<tr>
                <td width="20%" style="font-size: 18px;">' . $row->nombre . '</td>
                <td width="6%" style="font-size: 18px;">' . $row->nomina . '</td>
                <td width="20%" style="font-size: 18px;">' . $row->completo . '</td>
                <td width="6%" style="font-size: 18px; text-align: right;">' . $row->falta . '</td>
                <td width="6%" style="font-size: 18px; text-align: right;">' . $row->retardo . '</td>
                <td width="6%" style="font-size: 18px; text-align: right;">' . $row->justificada . '</td>
            </tr>';
            
            $faltas = $faltas + $row->falta;
            $retardos = $retardos + $row->retardo;
            $justificaciones = $justificaciones + $row->justificada;
        }
        
        $tabla .= '</tbody>
        <tfoot>
        <tr>
        <td colspan="3" style="font-size: 18px; text-align: right;">Totales</td>
        <td style="font-size: 18px; text-align: right;">' . $faltas . '</td>
        <td style="font-size: 18px; text-align: right;">' . $retardos . '</td>
        <td style="font-size: 18px; text-align: right;">' . $justificaciones . '</td>
        </tr>
        <tr>
        <td colspan="6">
            <p align="center" style="font-size: 18px; padding-top: 80px;"><br /><br /><br /><br /><br />__________________________________</p>
            <p align="center" style="font-size: 18px;">NOMBRE Y FIRMA</p>
        </td>
        </tr>
        </tfoot>
        </table>';
        
        
        return $tabla;
        
    }
    //Vacaciones
    
    public function guardar_vacaciones()
    {
        $fec1 = $this->input->post('fec1');
        $fec2 = $this->input->post('fec2');
        $dias = (integer)$this->dias_vacaciones($fec1, $fec2);
        
        $data = array(
        
        'nomina' => $this->session->userdata('nomina'),
        'ciclo' => $this->busca_ciclo($dias),
        'fec1' => $fec1,
        'fec2' => $fec2,
        'fec3' => $this->busca_dia3($fec2),
        'dias' => $dias
        
         );
    
         
         $this->db->set('fec_elab', 'now()', false);
         
         $this->db->insert('desarrollo.reg_vacaciones', $data);
         return $this->db->insert_id();
       
    }
    
    
    function calcula_dia($actual, $final)
    {
        $sql = "select dayofweek(?) as dia, datediff(?, ?) as diferencia, (select count(*) from catalogo.cat_festivo where edificio = ?) as festivo, ? + interval 1 day as dia_siguiente";
        
        $a = array($actual, $final, $actual, $actual, $actual);
        
        $query = $this->db->query($sql, $a);
        
        $row = $query->row();
        
        $b = array(
            'dia'       => $row->dia,
            'diferencia' => $row->diferencia,
            'festivo' => $row->festivo,
            'dia_siguiente' => $row->dia_siguiente
            );
            
        return $b;
    }

    private function dias_vacaciones($fec1, $fec2)
    {
        $j = 0;
        
        $actual = $fec1;
        
        for ($i = 1; ; $i++) {
            
            
            $a = $this->checador_model->calcula_dia($actual, $fec2);
            
            $actual = $a['dia_siguiente'];
            
            if($a['dia'] == 7 || $a['dia'] == 1){
                $j = $j;
            }elseif($a['festivo'] == 1){
                $j = $j;
            }else{
                $j++;
            }
            
            
            if ($a['diferencia'] == 0) {
                break;
            }
        
            }
        return $j;
    }

    function busca_ciclo($dias)
    {
        
        $sql = "SELECT * FROM periodo_vacas_detaller where nomina = ? and dias > 0 order by aaa1;";
        $query = $this->db->query($sql, $this->session->userdata('nomina'));
        
        $ciclo = null;
        foreach($query->result() as $row){
        
            if($row->dias >= $dias && $dias <> 0){
                
                $ciclo.= $row->aaa1." - ".$row->aaa2.", ";
                $dias = 0;
            }elseif($dias <> 0){
                $ciclo.= $row->aaa1." - ".$row->aaa2.", ";
                $dias = (integer)$dias - (integer)$row->dias;
            }else{
                
            }
        
        }
        
        $ciclo = substr($ciclo, 0, -2);
        
        return $ciclo;  
    }
    
    function busca_dia3($perfin)
    {
        for($i = 1; ; $i++){
            
            $sql = "SELECT ? + interval $i day as fecha, WEEKDAY(? + interval $i day) as dia";
            $q = $this->db->query($sql, array($perfin, $perfin));
            $r = $q->row();
            
            $sql2 = "Select * from catalogo.cat_festivo where edificio = ?;";
            $q2 = $this->db->query($sql2, array($r->fecha));
            $n = $q2->num_rows();
            
            if(($r->dia == 0 || $r->dia == 1 || $r->dia == 2 || $r->dia == 3 || $r->dia == 4) && $n == 0){
                
                return $r->fecha;
                break;
            }
            
        }
    }
    
    
    function get_vacaciones()
    {   
        $this->db->select('v.*, u.nombre');
        $this->db->from('reg_vacaciones v');
        $this->db->join('usuarios u', 'v.id_validacion = u.id', 'LEFT');
        $this->db->where('v.nomina', $this->session->userdata('nomina'));
        $this->db->order_by('v.id', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    function reporte_vacas($id, $succ)
    {
        $nivel = $this->session->userdata('nivel');
        
        $s = "SELECT r.id, r.nomina, r.ciclo, DATE_FORMAT(r.fec1, '%d/%m/%Y') as fec1, DATE_FORMAT(r.fec3, '%d/%m/%Y') as fec3, DATE_FORMAT(r.fec_elab, '%d/%m/%Y %T') as fec_elab, r.dias, b.id_empleado, m.mes, c.succ, a.nombre as sucursal, c.completo as empleado 
        FROM reg_vacaciones r
        left join catalogo.cat_empleado c on r.nomina=c.nomina
        left join catalogo.sucursal a on c.succ=a.suc
        left join catalogo.mes m on extract(month from r.fec1) = m.num
        left join catalogo.jefes_depto b on c.succ=b.suc
        where r.id=$id and c.tipo=1
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
       $fec3=$row->fec3;
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
       para presentarme a mi trabajo el dia de: <b>".$row->fec3."</b> correspondiente al ciclo <b>".$row->ciclo."</b><br /><br />Asi mismo manifiesto que me fue pagada anticipadamente la prima vacacional
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

    function get_periodos()
    {
        $sql = "SELECT * FROM periodo_vacas_detaller where nomina = ? order by aaa1;";
        $query = $this->db->query($sql, $this->session->userdata('nomina'));
        return $query;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function get_vacaciones1($limit, $offset = 0)
    {
        if($offset == null){
            $offset = 0;
        }
        
        $sql = "SELECT r.*, a.completo, b.nombre FROM reg_vacaciones r
                left join catalogo.cat_empleado a on r.nomina=a.nomina
                left join catalogo.sucursal b on a.succ=b.suc
                where r.validado=1 limit $offset, $limit;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();       
        return $query;
    }
    
    function cuenta_historico_vacaciones()
    {
        $sql="SELECT count(*) as cuenta 
		FROM reg_vacaciones r
        left join catalogo.cat_empleado a on r.nomina=a.nomina
        left join catalogo.sucursal b on a.succ=b.suc
        where r.validado=1;";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function get_vacaciones2($limit, $offset = 0)
    {
        if($offset == null){
            $offset = 0;
        }
        
        $sql = "SELECT r.*, a.completo, b.nombre FROM reg_vacaciones r
                left join catalogo.cat_empleado a on r.nomina=a.nomina
                left join catalogo.sucursal b on a.succ=b.suc
                where r.validado=0 and a.tipo=1 limit $offset, $limit;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();       
        return $query;
    }
    
    function cuenta_vacaciones_novalidadas()
    {
        $sql="SELECT count(*) as cuenta 
		FROM reg_vacaciones r
        left join catalogo.cat_empleado a on r.nomina=a.nomina
        left join catalogo.sucursal b on a.succ=b.suc
        where r.validado=0;";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
    function get_incidencias_no_validadas($limit, $offset = 0)
    {
        $this->db->select("concat(date_format(i.fecha_captura, '%Y%m%d'), '-', LPAD(i.incidencia, 6, '0')) as folio, DATE_FORMAT(i.fecha_captura, '%d/%m/%Y') as fecha_captura, i.incidencia, completo, e.nomina, puestox, DATE_FORMAT(a.fecha, '%d/%m/%Y') as fecha, falta, retardo, justifica, justificantes, s.nombre as sucursal, i.estatus, asistencia", false);
        $this->db->from('checador_incidencias i');
        $this->db->join('checador_asistencia a', 'i.incidencia = a.incidencia');
        $this->db->join('catalogo.cat_empleado e', 'a.empleado_id = e.id');
        $this->db->join('catalogo.cat_justificacion j', 'j.id = i.justificacion');
        $this->db->join('catalogo.sucursal s', 'e.succ = s.suc', 'left');
        $this->db->where('i.estatus', 0);
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query;
    }
    
    function get_incidencias_validadas($limit, $offset = 0)
    {
        $this->db->select("concat(date_format(i.fecha_captura, '%Y%m%d'), '-', LPAD(i.incidencia, 6, '0')) as folio, DATE_FORMAT(i.fecha_captura, '%d/%m/%Y') as fecha_captura, i.incidencia, completo, e.nomina, puestox, DATE_FORMAT(a.fecha, '%d/%m/%Y') as fecha, falta, retardo, justifica, justificantes, s.nombre as sucursal, i.estatus, asistencia", false);
        $this->db->from('checador_incidencias i');
        $this->db->join('checador_asistencia a', 'i.incidencia = a.incidencia');
        $this->db->join('catalogo.cat_empleado e', 'a.empleado_id = e.id');
        $this->db->join('catalogo.cat_justificacion j', 'j.id = i.justificacion');
        $this->db->join('catalogo.sucursal s', 'e.succ = s.suc', 'left');
        $this->db->where('i.estatus in(1, 2)', null, false);
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get();
        return $query;
    }

    function actualiza_incidencia($incidencia, $estatus)
    {
        $data = array(
            'estatus' => $estatus,
            'usuario_valida' => $this->session->userdata('id')
        );
        $this->db->set('fecha_valida', 'now()', false);
        $this->db->where('incidencia', $incidencia);
        $this->db->update('checador_incidencias', $data);
        $afectadas = $this->db->affected_rows();
        
        if( $afectadas > 0 && $estatus == 1) {
            $data2 = array(
                'justificada'   => 1,
                'motivo'        => $this->get_justificacion_incidencia($incidencia),
                'id_justifica'  => $this->session->userdata('id')
                );
            $this->db->set('fecha_justifica', 'now()', false);
            $this->db->update('checador_asistencia', $data2);
        }
        
        return $afectadas;
    }
    
    function get_justificacion_incidencia($incidencia)
    {
        $sql = "SELECT justifica FROM checador_incidencias c
join catalogo.cat_justificacion j on j.id = c.justificacion
where c.incidencia = ?;";
        $query = $this->db->query($sql, $incidencia);
        $row = $query->row();
        return $row->justifica;
    }
    
    function cuenta_incidencias_novalidadas()
    {
        $sql="SELECT count(*) as cuenta FROM checador_incidencias c where estatus = 0;";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }

    function cuenta_incidencias_validadas()
    {
        $sql="SELECT count(*) as cuenta FROM checador_incidencias c where estatus in(1,2);";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }

    function get_dias_vacaciones($id)
    {
        $this->db->select('dias');
        $this->db->where('validado', 0);
        $this->db->where('id', $id);
        $query = $this->db->get('reg_vacaciones');
        
        $row = $query->row();
        
        return $row->dias;
    }
    
    
    function get_periodos_pendientes($nomina)
    {
        $sql = "SELECT id, dias FROM periodo_vacas_detaller where nomina = ? and dias > 0 order by aaa1;";
        $query = $this->db->query($sql, $nomina);
        
        return $query;
        
    }
    
    function personal_eliminar($id)
    {
        $this->db->delete('reg_vacaciones',  array('id' => $id));
    }
    
    function formato_credencial($nomina)
    {
        $this->db->select('e.*, s.nombre as sucursal, ciax');
        $this->db->from('catalogo.cat_empleado e');
        $this->db->join('catalogo.sucursal s', 'e.succ = s.suc', 'LEFT');
        $this->db->join('catalogo.cat_compa_nomina c', 'e.cia = c.cia', 'LEFT');
        $this->db->where('e.nomina', $nomina);
        $this->db->where('tipo', 1);
        $query = $this->db->get();
        
        $row = $query->row();
        
        if($row->id_checador > 0){
            $eti = 'DEPTO.: ';
        }else{
            $eti = 'SUCURSAL: ';
        }
        
        $mes = array(
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
        
        
        $a = '<table cellpadding="2" width="300px">
            <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td width="30%" style="text-align: center; vertical-align: top; padding-top: 50px;">
                <b>'.$row->nomina.'</b>
                </td>
                <td width="70%">
                <img style="position:relative; width:200px; text-align: center;" src="'.base_url().'/imagenes/logo1.png" />
                <br />
                <b>'.$row->ciax.'</b><br />
                <b>'.$row->pat.'</b><br />
                <b>'.$row->mat.'</b><br />
                <b>'.$row->nom.'</b><br />
                PUESTO: <b>'.$row->puestox.'</b><br />
                '.$eti.' <b>'.$row->sucursal.'</b><br /><br />
                FECHA: <b>'.date('d').' DE '.$mes[date('m')].' DEL '.date('Y').'</b>
                </td>
            </tr>
            <tr>
            <td colspan="2">&nbsp;</td>
            </tr>
        </table>';
        
        $b = '<table cellpadding="5" width="90%">
            <tr>
                <td style="font-size: small;">
                <br /><br /><br /><br />
                <ol type="1" start="1">
                	<li>Esta credencial es una constancia de que el titular de la misma presta sus servicios en esta empresa y en cualquier momento requerido debera mostrarla.</li>
                	<li>Esta credencial es intransferible, el usuario que la preste o permita el mal uso de la misma, se hara acreedor a la sancion correspondiente.</li>
                	<li>Al termino de la relacion laboral, esta credencial debera ser devuelta al departamento de Recursos Humanos.</li>
                	<li>Para cualquier aclaracion llame al 91-400-700.</li>
                </ol>
                <br /><br /><br />
                <p style="text-align: center;">________________________________</p>
                <p style="text-align: center;">FIRMA</p>
                </td>
            </tr>
        </table>';
        
        
        $tabla = '<table width="650" cellpaddind="0" cellspacing="0">
            <tr>
                <td style="border-bottom: black; border-bottom-style: dashed; border-bottom-width: 0.5px;border-top: black; border-top-style: dashed; border-top-width: 0.5px;border-left: black; border-left-style: dashed; border-left-width: 0.5px;border-right: black; border-right-style: dashed; border-right-width: 0.5px;">
                '.$a.'
                </td>
                <td style="border-bottom: black; border-bottom-style: dashed; border-bottom-width: 0.5px;border-top: black; border-top-style: dashed; border-top-width: 0.5px;border-right: black; border-right-style: dashed; border-right-width: 0.5px;">
                '.$b.'
                </td>
            </tr>
        </table>';
        
        return $tabla;
    }
    
    function busca_empleado()
    {
        $this->db->select('completo, nomina');
        $this->db->where('tipo', 1);
        $this->db->where('nomina > 0', '', false);
        $this->db->order_by('completo', 'ASC');
        $query = $this->db->get('catalogo.cat_empleado');
        
        $row = $query->row();
        
        $empleado = array();
        $empleado['0'] = "Selecciona un empleado";
        
        foreach($query->result() as $row){
            $empleado[$row->nomina] = $row->completo;
        }
        
        return $empleado;  
    }
    
    function get_periodos1($empleado)
    {
        $sql = "SELECT a.*, b.completo FROM periodo_vacas_detaller a left join catalogo.cat_empleado b on a.nomina=b.nomina where a.nomina = ? order by aaa1;";
        $query = $this->db->query($sql, $empleado);
        //echo $this->db->last_query();
        
        return $query;
    
    }
    
    function editar_periodo_vac($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('periodo_vacas_detaller');
        //echo $this->db->last_query();
        
        return $query;
        
    }
    
    function editar_periodo_vacaciones($dias, $id)
    {
        $data = array(
           'dias' => $this->input->post('dias')
           
        );
        
        $this->db->where('id', $id);
        $this->db->update('periodo_vacas_detaller', $data);
        //echo $this->db->last_query();
        //die();
        
        return $this->db->affected_rows(); 
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    function busca_empleado1()
    {
        
        $sql = "SELECT * FROM catalogo.cat_empleado where tipo=1 and succ = ? order by completo";
        $query = $this->db->query($sql, $this->session->userdata('suc'));
        
        $empleadox = array();
        $empleadox[0] = "Selecciona un Empleado";
        
        foreach($query->result() as $row){
            $empleadox[$row->id] = $row->completo;
        }
        
        return $empleadox;  
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
            '1' => 'ENERO',
            '2' => 'FEBRERO',
            '3' => 'MARZO',
            '4' => 'ABRIL',
            '5' => 'MAYO',
            '6' => 'JUNIO',
            '7' => 'JULIO',
            '8' => 'AGOSTO',
            '9' => 'SEPTIEMBRE',
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
      $empl=explode(',', $empleados);
      $num_empl=count($empl);
      
       
       $tabla = "
        
       <table border=\"0\" cellspacing=\"7\">
       <tbody>
       
       
       <tr>
       <td colspan=\"2\" align=\"left\">Nombre:  <b>".$empleados."</b></td>
       </tr>
       
       <tr>
       <td align=\"left\">Departamento:  <b>".$row->sucursal."</b></td>
       <td align=\"left\">  <b>".$num_empl." PERSONA(S)</b></td>
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
       <td colspan=\"2\" style=\"border-bottom: black; border-bottom-style: dashed; border-bottom-width: 1px;\"></td>
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
         
       
    }
    
    function cuenta_salidas()
    {
        $sql="SELECT count(*) as cuenta FROM reg_salidas r
left join reg_salidas_empleados e on r.id = e.id_reg where id_empleado = ?;";
        
        
        $query = $this->db->query($sql, $this->session->userdata('id'));
        $r = $query->row();
        return $r->cuenta;
    }
    
    function historico_salidas($limit, $offset = 0)
    {
        if($offset == null){
            $offset = 0;
        }
        
        $sql = "SELECT r.*, b.*, c.succ, a.nombre as sucursal, c.completo as empleado, r.id as busca
        FROM desarrollo.reg_salidas r
        left join desarrollo.reg_salidas_empleados b on r.id=b.id_reg
        left join catalogo.cat_empleado c on b.id_empleado=c.id
        left join catalogo.sucursal a on c.succ=a.suc
        where b.id_empleado = ?
        order by b.id desc
        limit $offset, $limit";
        $query = $this->db->query($sql, $this->session->userdata('id'));
        //echo $this->db->last_query();       
        return $query;
    }
    
    function nombre_salida($id)
    {
        $sql = "SELECT trim(completo) as completo FROM reg_salidas r
left join reg_salidas_empleados e on r.id = e.id_reg
left join catalogo.cat_empleado c on e.id_empleado = c.id
where r.id = ?;";

        $query = $this->db->query($sql, $id);
        
        $a = null;
        
        foreach($query->result() as $row)
        {
            $a .= $row->completo. ", ";
        }
        
        $a = trim($a);
        $a = substr($a, 0, -1).".";
        
        return $a;
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function selec_asunto1()
    {
        
        $sql = "SELECT * FROM memo_asunto";
        $query = $this->db->query($sql);
        
        $asuntox = array();
        $asuntox[0] = "Selecciona el Asunto";
        
        foreach($query->result() as $row){
            $asuntox[$row->asunto] = $row->asunto;
        }
        
        return $asuntox;  
    }
    
    public function guardar_memo()
    {
        $fec1 = $this->input->post('fec1');
        $fec2 = $this->input->post('fec2');
        $asuntox = $this->input->post('asunto');
        $obser = $this->input->post('obser');
        
        
        $data = array(
        
        'nomina' => $this->session->userdata('nomina'),
        'fec1' => $fec1,
        'fec2' => $fec2,
        'asunto' => $asuntox,
        'observacion' => $obser
        
         );
    
         
         $this->db->set('fec_elab', 'now()', false);
         
         $this->db->insert('desarrollo.reg_memo', $data);
         return $this->db->insert_id();
       
    }
    
    function historico_memo()
    {
        
        $sql = "SELECT a.*, b.completo, b.succ, c.nombre as sucursal FROM reg_memo a
                left join catalogo.cat_empleado b on a.nomina=b.nomina and tipo=1
                left join catalogo.sucursal c on b.succ=c.suc
                where a.nomina=?";
        $query = $this->db->query($sql, $this->session->userdata('nomina'));
        //echo $this->db->last_query();       
        return $query;
    }
    
    function reporte_memo_encabezado1()
    {
        $tabla = "
        <table>        
        <tr>
        <td align=\"center\"> <img style=\"position:relative; width:60px;\", src=\"'.base_url().'../../imagenes/logo.png\" />  FARMACIAS EL FENIX DEL CENTRO S.A. DE C.V.<br /><br /></td>
        </tr>
        <tr>
        <td align=\"center\" style=\"font-size: xx-large;\"><b>MEMORANDUM</b><br /><br /></td>
        </tr>
        </table>";
        
        return $tabla;
    } 
 
    function reporte_memo1($id)
    {
        
        $s="
        SELECT a.*, b.completo, b.succ, c.nombre as sucursal, extract(year from fec_elab) as anio, extract(month from fec_elab) as mes, extract(day from fec_elab) as dia, extract(hour from fec_elab) as tiempo, extract(minute from fec_elab) as tiempo1, extract(second from fec_elab) as tiempo2
        FROM reg_memo a
        left join catalogo.cat_empleado b on a.nomina=b.nomina and tipo=1
        left join catalogo.sucursal c on b.succ=c.suc
        where a.id=$id";
        
        $q = $this->db->query($s);
       
        
        //echo $this->db->last_query();
        //die ();
          
        foreach($q->result() as $row)
         {
    
         $s1 = "SELECT b.completo, a.cargo, a.titulo FROM catalogo.jefes_depto a
                left join catalogo.cat_empleado b on b.id=a.id_empleado
                where a.suc=$row->succ
        ";
       
       $q1 = $this->db->query($s1);
       
       //echo $this->db->last_query();
       //die ();
       
       $r1 = $q1->row();  
         
       }
       
       $s2 = "SELECT completo FROM catalogo.cat_empleado where id = ?;";
       $q2 = $this->db->query($s2, GERENTE_RH_ID);
       $r2 = $q2->row();
      
       
       $tabla = '
        
       <table>
       <tbody>
       
       
       <tr>
       <td>De:  <b>'.$r1->titulo.'. '.$r1->completo.'</b><br /></td>
       <td>Expedido el: <b>'.$row->fec_elab.'</b></td>
       </tr>
       
       <tr>
       <td>Para: <b>LIC. '.$r2->completo.'</b><br /><br /><br /><br /></td>
       <td>Asunto: <b>'.$row->asunto.'</b></td>
       </tr>
       
       <tr>
       <td colspan="2" style="text-align: justify;">Por medio del presente, aprovecho la oportunidad para saludarle y al mismo tiempo informarle que a partir de la fecha <b>'.$row->fec1.'</b> hasta la fecha <b>'.$row->fec2.'</b> el empleado <b>'.$row->completo.'</b> con n&uacute;mero de n&oacute;mina <b>'.$row->nomina.'</b> se presentar&aacute; tarde a trabajar o no asistir&aacute; por el asunto arriba mencionado.<br />  </td>
       </tr>
       
       <tr>
       <td colspan="2" style="text-align: justify;">Observaciones: <b>'.$row->observacion.'</b> <br />  </td>
       </tr>
       
       <tr>
       <td colspan="2" style="text-align: justify;">A si mismo agradecer&eacute; mucho a usted gire sus respetables &oacute;rdenes a quien corresponda, con el fin de que no se les marque retardo o falta seg&uacute;n sea el caso.<br /></td>
       </tr>
       
       <tr>
       <td colspan="2" style="text-align: justify;">Sin m&aacute;s por el momento agradezco su valiosa atenci&oacute;n y quedo de usted para cualquier duda y/o aclaraci&oacute;n.<br /><br /><br /><br /></td>
       </tr>
       
       <tr>
       <td colspan="2" style="text-align: center;">ATENTAMENTE<br /><br /></td>
       </tr>
       
       <tr>
       <td colspan="2" style="text-align: center;">________________________________________</td>
       </tr> 
       
       <tr>
       <td colspan="2" style="text-align: center;"><b>'.$r1->titulo.'. '.$r1->completo.'</b></td>
       </tr>
       <tr>
       <td colspan="2" style="text-align: center;"><b>'.$r1->cargo.' DE '.$row->sucursal.'</b></td>
       </tr>
       ';
       
        
        $tabla.= '
        </tbody>
        </table>';
        
        return $tabla;
        
    }   
    
    function get_memo2($limit, $offset = 0)
    {
        if($offset == null){
            $offset = 0;
        }
        
        $sql = "SELECT r.*, a.completo, b.nombre FROM reg_memo r
                left join catalogo.cat_empleado a on r.nomina=a.nomina
                left join catalogo.sucursal b on a.succ=b.suc
                where r.validado=0 and a.tipo=1 limit $offset, $limit;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();       
        return $query;
    }
    
    function cuenta_memos_novalidados()
    {
        $sql="SELECT count(*) as cuenta 
		FROM reg_memo r
        left join catalogo.cat_empleado a on r.nomina=a.nomina
        left join catalogo.sucursal b on a.succ=b.suc
        where r.validado=0;";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
    function memos_eliminar($id)
    {
        $this->db->delete('reg_memo',  array('id' => $id));
    }
    
    function get_memo1($limit, $offset = 0)
    {
        if($offset == null){
            $offset = 0;
        }
        
        $sql = "SELECT r.*, a.completo, b.nombre FROM reg_memo r
                left join catalogo.cat_empleado a on r.nomina=a.nomina
                left join catalogo.sucursal b on a.succ=b.suc
                where r.validado=1 limit $offset, $limit;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();       
        return $query;
    }
    
    function cuenta_historico_memo()
    {
        $sql="SELECT count(*) as cuenta 
		FROM reg_memo r
        left join catalogo.cat_empleado a on r.nomina=a.nomina
        left join catalogo.sucursal b on a.succ=b.suc
        where r.validado=1;";
        
        $query = $this->db->query($sql);
        $r = $query->row();
        return $r->cuenta;
    }
    
    function entrega_de_password()
    {
        $sql = "SELECT nombre as sucursal, e.completo, e.nomina, e.pass
FROM catalogo.cat_empleado e
left join catalogo.sucursal s on e.succ = s.suc
where e.tipo = 1 and e.id_checador
order by e.succ, e.completo;";
        $query = $this->db->query($sql);
        return $query;
    }
    
    function get_deptos_justi()
    {
        
        if($this->session->userdata('nivel') == 54){
            $where = " and c.depto = ".$this->session->userdata('suc');
        }else{
            $where = null;
        }
        
        $sql = "SELECT succ, s.nombre
FROM catalogo.cat_empleado c
left join catalogo.sucursal s on c.succ = s.suc
where c.tipo = 1 and c.id_checador > 0 $where
group by succ
order by s.nombre;";
        $query = $this->db->query($sql);
        return $query;
    }
    
    function get_deptos_justi1()
    {
        
        if($this->session->userdata('nivel') == 55){
            $where = " and c.depto in (100,90002,6050)";
        }else{
            $where = null;
        }
        
        $sql = "SELECT succ, s.nombre
FROM catalogo.cat_empleado c
left join catalogo.sucursal s on c.succ = s.suc
where c.tipo = 1 and c.id_checador > 0 $where
group by succ
order by s.nombre;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $query;
    }
    
    function grafica1($inicio, $fin, $horas_laboradas)
    {
        $this->db->select("sum(c.retardo) as retardo, sum(c.falta) as falta, sum(c.justificada) as justificada, sum(c.horas_decimal) as horas", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->where('empleado_id', $this->id);
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        $this->db->order_by('c.fecha', 'ASC');
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        
        
        $row = $query->row();
        
        $b = round(($row->horas / $horas_laboradas) * 100, 0);
        $c = 100 - $b;
        
        $a = "[['Trabajadas',$b],['Pendientes',$c]]
        ";
                
        return $a;
        
    }
    
    function grafica2($inicio, $fin, $dias_laborados)
    {
        $this->db->select("sum(c.retardo) as retardo, sum(c.falta) as falta, sum(c.justificada) as justificada, sum(c.horas_decimal) as horas", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->where('empleado_id', $this->id);
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        $this->db->order_by('c.fecha', 'ASC');
        $query = $this->db->get();
        
        $row = $query->row();
        
        $b = round(($row->falta / $dias_laborados) * 100, 0);
        $c = 100 - $b;
        
        $a = "[['Faltas',$b],['Asistencias',$c]]
        ";
                
        return $a;
        
    }

    function grafica3($inicio, $fin, $dias_laborados)
    {
        $this->db->select("sum(c.retardo) as retardo, sum(c.falta) as falta, sum(c.justificada) as justificada, sum(c.horas_decimal) as horas", FALSE);
        $this->db->from('checador_asistencia c');
        $this->db->join('catalogo.cat_empleado e', 'c.empleado_id = e.id', 'LEFT');
        $this->db->where('empleado_id', $this->id);
        $this->db->where("fecha between '$inicio' and '$fin'", null, FALSE);
        $this->db->order_by('c.fecha', 'ASC');
        $query = $this->db->get();
        
        $row = $query->row();
        
        $b = round(($row->retardo / $dias_laborados) * 100, 0);
        $c = 100 - $b;
        
        $a = "[['Retardos',$b],['Puntualidad',$c]]
        ";
                
        return $a;
        
    }
    
    function grafica4($inicio, $fin, $horas_laboradas)
    {
        $this->db->select("sum(horas_decimal) as horas, sum(falta) as falta, sum(retardo) as retardo, sum(justificada) as justificada", FALSE);
        $this->db->from('catalogo.cat_empleado c');
        $this->db->join('catalogo.sucursal s', 'c.succ = s.suc', 'LEFT');
        $this->db->join('checador_asistencia a', "c.id = a.empleado_id and fecha between '$inicio' and '$fin'", 'LEFT');
        $this->db->where('id_checador > 0');
        $this->db->where('checa',1);
        $this->db->where('tipo',1);
        $query = $this->db->get();
       
        $row = $query->row();
        
        $this->db->select("count(*) as cuenta", FALSE);
        $this->db->from('catalogo.cat_empleado');
        $this->db->where("id_checador > 0  and tipo=1 and checa = 1", null, FALSE);
        $query2 = $this->db->get();
        
        
        $row1 = $query2->row();
        
        $f = $horas_laboradas * $row1->cuenta;
        
        
        $b = round(($row->horas / $f) * 100, 2);
        
        $c = round(100 - $b, 2);
        
        $a = "[['Trabajadas',$b],['Pendientes',$c]]
        ";
                
        return $a;
        
    }
    
    function grafica5($inicio, $fin, $dias_laborados)
    {
        $this->db->select("sum(horas_decimal) as horas, sum(falta) as falta, sum(retardo) as retardo, sum(justificada) as justificada", FALSE);
        $this->db->from('catalogo.cat_empleado c');
        $this->db->join('catalogo.sucursal s', 'c.succ = s.suc', 'LEFT');
        $this->db->join('checador_asistencia a', "c.id = a.empleado_id and fecha between '$inicio' and '$fin'", 'LEFT');
        $this->db->where('id_checador > 0');
        $this->db->where('checa',1);
        $this->db->where('tipo',1);
        $query = $this->db->get();
       
        $row = $query->row();
        
        $this->db->select("count(*) as cuenta", FALSE);
        $this->db->from('catalogo.cat_empleado');
        $this->db->where("id_checador > 0  and tipo=1 and checa = 1", null, FALSE);
        $query2 = $this->db->get();
        
        
        $row1 = $query2->row();
        
        $f = $dias_laborados * $row1->cuenta;
        
        
        $b = round(($row->falta / $f) * 100, 2);
        
        $c = round(100 - $b, 2);
        
        $a = "[['Faltas',$b],['Asistencias',$c]]
        ";
                
        return $a;
        
    }
    
    function grafica6($inicio, $fin, $dias_laborados)
    {
        $this->db->select("sum(horas_decimal) as horas, sum(falta) as falta, sum(retardo) as retardo, sum(justificada) as justificada", FALSE);
        $this->db->from('catalogo.cat_empleado c');
        $this->db->join('catalogo.sucursal s', 'c.succ = s.suc', 'LEFT');
        $this->db->join('checador_asistencia a', "c.id = a.empleado_id and fecha between '$inicio' and '$fin'", 'LEFT');
        $this->db->where('id_checador > 0');
        $this->db->where('checa',1);
        $this->db->where('tipo',1);
        $query = $this->db->get();
       
        $row = $query->row();
        
        $this->db->select("count(*) as cuenta", FALSE);
        $this->db->from('catalogo.cat_empleado');
        $this->db->where("id_checador > 0  and tipo=1 and checa = 1", null, FALSE);
        $query2 = $this->db->get();
        
        
        $row1 = $query2->row();
        
        $f = $dias_laborados * $row1->cuenta;
        
        
        $b = round(($row->retardo / $f) * 100, 2);
        
        $c = round(100 - $b, 2);
        
        $a = "[['Retardos',$b],['Puntualidad',$c]]
        ";
                
        return $a;
        
    }
    
    function insert_comprobante($imagen, $id)
    {
        $update = array(
                'c_id'  => $id,
                'imagen' => $imagen
        );
        
        $this->db->insert('checador_comprobantes', $update);
    }
    
    function nombre_comprobante($id)
    {
        $this->load->helper('string');
        $sql = "SELECT max(SUBSTRING_INDEX(imagen, '.', 1)) as imagen_alt FROM checador_comprobantes c where c_id = ?;";
        $query = $this->db->query($sql, $id);
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            if($row->imagen_alt == null){
                return $id;
            }else{
                return increment_string($row->imagen_alt);
            }
        }else{
            return $id;
        }
        
    }
    
    function reporte_incidencias_faltas($perini, $perfin)
    {
        $sql = "SELECT e.cia, razon, succ, nombre, e.nomina, e.completo, count(*) as faltas
FROM checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal s on e.succ = s.suc
left join catalogo.compa o on e.cia = o.cia
where c.fecha between ? and ? and e.tipo = 1 and e.checa = 1 and justificada = 0 and falta = 1
group by e.nomina
order by cia, succ, completo;";

        $query = $this->db->query($sql, array($perini, $perfin));
        
        return $query;
    }

    function reporte_incidencias_retardos($perini, $perfin)
    {
        $sql = "SELECT e.cia, razon, succ, nombre, e.nomina, e.completo, floor(sum(retardo)/3) as retardos
FROM checador_asistencia c
left join catalogo.cat_empleado e on c.empleado_id = e.id
left join catalogo.sucursal s on e.succ = s.suc
left join catalogo.compa o on e.cia = o.cia
where c.fecha between ? and ? and e.tipo = 1 and e.checa = 1 and justificada = 0 and retardo = 1
group by empleado_id
having retardos >= 1
order by succ, completo;";

        $query = $this->db->query($sql, array($perini, $perfin));
        
        return $query;
    }

}