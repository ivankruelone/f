<?php
class R_ventas_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
    
    
    function reporte_diario_encabezado($fecha1, $fecha2, $sucursal)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE DESPLAZAMIENTO DE MEDICAMENTOS DEL DIA $fecha1 AL $fecha2 DE LA SUCURSAL $sucursal</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_diario($fecha1, $fecha2, $sucursal)
    {
        $this->db->select('a.suc, a.fecha, a.codigo, r.sec, a.descri, sum(can) as can');
        $this->db->from('vtadc.venta_detalle a');
        $this->db->join('catalogo.almacen r', 'a.codigo=r.codigo', 'LEFT');
        $this->db->where('r.sec>0', '', false);
        $this->db->where('a.suc', $sucursal);
        $this->db->where("date(a.fecha) between '$fecha1' and '$fecha2'", '', false);
        $this->db->group_by('a.codigo');
        $this->db->order_by('r.sec');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>DESPLAZAMENTO DE MEDICAMENTOS </h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"10%\">#</th>
        <th width=\"20%\">CODIGO</th>
        <th width=\"10%\">SEC.</th>
        <th width=\"50%\">DESCRIPCION</th>
        <th width=\"10%\">CANTIDAD</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $can = 0;
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"right\" width=\"10%\">".$n."</td>
            <td align=\"right\" width=\"20%\">".$row->codigo."</td>
            <td align=\"right\" width=\"10%\">".$row->sec."</td>
            <td align=\"left\" width=\"50%\">".$row->descri."</td>
            <td align=\"right\" width=\"10%\">".number_format($row->can,0)."</td>
            </tr>
            ";
            
            $n++;
            $can = $can + $row->can;
            
        }
        
       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($can,0)."</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
    
    
    function reporte_semanal_encabezado($semana, $anio, $sucursal)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE DESPLAZAMIENTO DE MEDICAMENTOS DE LA SEMANA $semana Y A&Ntilde;O $anio DE LA SUCURSAL $sucursal</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_semanal_total($semana, $anio, $sucursal)
    {
        $this->db->select('a.suc, a.fecha, a.codigo, r.sec, a.descri, sum(can) as can');
        $this->db->from('vtadc.venta_detalle a');
        $this->db->join('catalogo.almacen r', 'a.codigo=r.codigo', 'LEFT');
        $this->db->where('r.sec>0', '', false);
        $this->db->where('a.suc', $sucursal);
        $this->db->where("yearweek(fecha)=$anio$semana", '', false);
        $this->db->group_by('a.codigo');
        $this->db->order_by('r.sec');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>DESPLAZAMENTO DE MEDICAMENTOS </h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"10%\">#</th>
        <th width=\"20%\">CODIGO</th>
        <th width=\"10%\">SEC.</th>
        <th width=\"50%\">DESCRIPCION</th>
        <th width=\"10%\">CANTIDAD</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $can = 0;
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"right\" width=\"10%\">".$n."</td>
            <td align=\"right\" width=\"20%\">".$row->codigo."</td>
            <td align=\"right\" width=\"10%\">".$row->sec."</td>
            <td align=\"left\" width=\"50%\">".$row->descri."</td>
            <td align=\"right\" width=\"10%\">".number_format($row->can,0)."</td>
            </tr>
            ";
            
            $n++;
            $can = $can + $row->can;
            
        }
        
       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($can,0)."</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
        
    
    function __dia_de_la_semana($diaint)
    {
        $dias = array(
            '1' => 'DOMINGO',
            '2' => 'LUNES',
            '3' => 'MARTES',
            '4' => 'MIERCOLES',
            '5' => 'JUEVES',
            '6' => 'VIERNES',
            '7' => 'SABADO'
        );
        
        return $dias[$diaint];
    }
    
    function reporte_mensual_encabezado($mes, $anio, $sucursal)
    {
        $tabla = "
        <table>
        <tr>
        <td>CENTRO DE DISTRIBUCION DE FARMACIAS EL FENIX</td>
        <td>REPORTE DE DESPLAZAMIENTO DE MEDICAMENTOS DEL MES $mes Y A&Ntilde;O $anio DE LA SUCURSAL $sucursal</td>
        </tr>
        <tr>
        <td colspan=\"2\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_mensual_total($mes, $anio, $sucursal)
    {
        $this->db->select('a.suc, a.fecha, a.codigo, r.sec, a.descri, sum(can) as can');
        $this->db->from('vtadc.venta_detalle a');
        $this->db->join('catalogo.almacen r', 'a.codigo=r.codigo', 'LEFT');
        $this->db->where('r.sec>0', '', false);
        $this->db->where('a.suc', $sucursal);
        $this->db->where("month(fecha)=$mes", '', false);
        $this->db->where("year(fecha)=$anio", '', false);
        $this->db->group_by('a.codigo');
        $this->db->order_by('r.sec');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();

        $tabla = "
        <h1>DESPLAZAMENTO DE MEDICAMENTOS </h1>
        <table cellpadding=\"3\" border=\"1\">
        <thead>
        <tr>
        <th width=\"10%\">#</th>
        <th width=\"20%\">CODIGO</th>
        <th width=\"10%\">SEC.</th>
        <th width=\"50%\">DESCRIPCION</th>
        <th width=\"10%\">CANTIDAD</th>
        </tr>

        </thead>
        <tbody>
        ";
        
        $n = 1;
        $can = 0;
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"right\" width=\"10%\">".$n."</td>
            <td align=\"right\" width=\"20%\">".$row->codigo."</td>
            <td align=\"right\" width=\"10%\">".$row->sec."</td>
            <td align=\"left\" width=\"50%\">".$row->descri."</td>
            <td align=\"right\" width=\"10%\">".number_format($row->can,0)."</td>
            </tr>
            ";
            
            $n++;
            $can = $can + $row->can;
            
        }
        
       
        $tabla.="</tbody>
        <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTALES</td>
        <td align=\"right\">".number_format($can,0)."</td>
        </tr>
        </tfoot>
        </table>";
        return $tabla;
        
    }
        
        
        

}