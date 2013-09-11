<?php
class Reportes_model extends CI_Model
{
var $is_logged_in;
    function __construct()
    {
        parent::__construct();
        $is_logged_in = $this->session->userdata('is_logged_in');
        $this->load->helper('form');
    }
     
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    function reporte_diario_encabezado($sucursal)
    {
        $tabla = "
        <table>
        <tr>
        <td align=\"center\">FARMACIAS EL FENIX DEL CENTRO S.A. DE C.V.</td>
        </tr>
        <tr>
        <td align=\"center\">REPORTE DE LA SUCURSAL $sucursal PARA DAR DE ALTA</td>
        </tr>
        <tr>
        <td colspan=\"1\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_diario($sucursal)
    {
        $this->db->select('a.tipo2, a.suc, a.nombre, a.rfc, a.cia, b.razon, a.dire, a.cp, a.col, a.pobla, a.plaza, c.plazax, a.suc_contable');
        $this->db->from('catalogo.sucursal a');
        $this->db->join('catalogo.compa b', 'a.cia=b.cia', 'LEFT');
        $this->db->join('catalogo.cat_plaza c', 'a.plaza=c.id_plaza', 'LEFT');
        $this->db->where('a.suc', $sucursal);
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        
        <table cellpadding=\"6\" border=\"1\">
        <tbody>

        ";
        
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"left\">STATUS:</td><td>".$row->tipo2."</td>
            </tr>
            <tr>
            <td align=\"left\">SUCURSAL:</td><td>".$row->suc." - ".$row->nombre."</td>
            </tr>
            <tr>
            <td align=\"left\">DIRECCION:</td><td>".$row->dire." - ".$row->col." - ".$row->cp." - ".$row->pobla."</td>
            </tr>
            <tr>
            <td align=\"left\">RFC:</td><td>".$row->rfc."</td>
            </tr>
            <tr>
            <td align=\"left\">COMPA&Ntilde;IA:</td><td>".$row->cia." - ".$row->razon."</td>
            </tr>
            <tr>
            <td align=\"left\">PLAZA CONTABLE:</td><td>".$row->plaza."</td>
            </tr>
            <tr>
            <td align=\"left\">SUCURSAL CONTABLE:</td><td>".$row->suc_contable."</td>
            </tr>
            ";
        
       
        }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
    }
    
    
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    function reporte_ruta_encabezado($folio1, $folio2)
    {
        $tabla = "
        <table>
        <tr>
        <td align=\"center\">FARMACIAS EL FENIX DEL CENTRO S.A. DE C.V.</td>
        </tr>
        <tr>
        <td align=\"center\">REPORTE DEL FOLIO $folio1 AL FOLIO $folio2</td>
        </tr>
        <tr>
        <td colspan=\"1\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_ruta($fecha1, $fecha2)
    {
        $this->db->select('a.id, a.suc, a.fechas, c.nombre, c.dia, b.nom');
        $this->db->from('catalogo.folio_pedidos_cedis a');
        $this->db->join('catalogo.almacen_rutas b', 'a.suc=b.suc', 'LEFT');
        $this->db->join('catalogo.sucursal c', 'a.suc=c.suc', 'LEFT');
        $this->db->where("a.fechas between '$fecha1' and '$fecha2'", null, false);
        $this->db->order_by('b.nom');
        $this->db->order_by('b.suc');
        $this->db->order_by('a.id');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        
        <table border=\"1\">
        <thead>
        <tr>
        <th align=\"center\">FOLIO</th>
        <th align=\"center\">SUCURSAL</th>
        <th align=\"center\">DIA</th>
        <th align=\"center\">RUTA</th>
        </tr>
        </thead>
        <tbody>
        ";
       
        
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td align=\"center\">".$row->id."</td>
        
            <td align=\"left\">".$row->suc." - ".$row->nombre."</td>
         
            <td align=\"center\">".$row->dia."</td>
         
            <td align=\"center\">".$row->nom."</td>
            </tr>
            ";
        
       
        }
    $tabla.= "
    </tbody>
    </table>";
        
        return $tabla;
        
    }
    
    
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    function reporte_esp_metro_encabezado($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td align=\"center\">FARMACIAS EL FENIX DEL CENTRO S.A. DE C.V.</td>
        </tr>
        <tr>
        <td align=\"center\">RUTA: ESPECIALES Y METRO DE $fecha1 A $fecha2</td>
        </tr>
        <tr>
        <td colspan=\"1\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_esp_metro($fecha1, $fecha2)
    {
        $this->db->select('f.id, p.tsuc, f.suc, nombre, mue, sum(ped) as ped, sum(ped*vta) as result');
        $this->db->from('catalogo.folio_pedidos_cedis_especial f');
        $this->db->join('desarrollo.pedidos p', 'p.fol=f.id', 'LEFT');
        $this->db->join('catalogo.sucursal s', 's.suc=p.suc', 'LEFT');
        $this->db->where("f.fechas between '$fecha1' and '$fecha2'", null, false);
        $this->db->where('tid', 'c');
        $this->db->where("invcedis > 0", '', false);
        $this->db->group_by('f.id');
        $this->db->order_by('f.suc');
        $this->db->order_by('f.id');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        
        <table border=\"1\">
        <thead>
        <tr>
        <th width=\"50\" align=\"center\">#</th>
        <th width=\"100\" align=\"left\">FOLIO</th>
        <th width=\"50\" align=\"center\">TIPO</th>
        <th width=\"250\" align=\"left\">SUCURSAL</th>
        <th width=\"50\" align=\"center\">MUEBLE</th>
        <th width=\"100\" align=\"right\">CAN. PEDIDA</th>
        <th width=\"100\" align=\"right\">IMPORTE</th>
        </tr>
        </thead>
        <tbody>
        ";
        $n=1;
        
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td width=\"50\" align=\"center\">".$n."</td>
            <td width=\"100\" align=\"left\">".$row->id."</td>
            <td width=\"50\" align=\"center\">".$row->tsuc."</td>
            <td width=\"250\" align=\"left\">".$row->suc." - ".$row->nombre."</td>
            <td width=\"50\" align=\"center\">".$row->mue."</td>
            <td width=\"100\" align=\"right\">".$row->ped."</td>
            <td width=\"100\" align=\"right\">$".number_format($row->result,2)."</td>
            </tr>
            ";
        $n++;
        $ped = $ped + $row->ped;
        $result = $result + $row->result;
       
        }
    $tabla.= "
    </tbody>
    <tfoot>
        <tr>
        <td align=\"right\" colspan=\"5\">TOTAL CANTIDAD</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        <td align=\"right\">$".number_format($result,2)."</td>
        </tr>
        </tfoot>
    </table>";
        
        return $tabla;
        
    }
    
    
    
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function reporte_esp_metro_encabezado1($fecha1, $fecha2)
    {
        $tabla = "
        <table>
        <tr>
        <td align=\"center\">FARMACIAS EL FENIX DEL CENTRO S.A. DE C.V.</td>
        </tr>
        <tr>
        <td align=\"center\">REPORTE DE PRODUCTOS X CLAVE ESPECIALES Y METRO DE $fecha1 A $fecha2</td>
        </tr>
        <tr>
        <td colspan=\"1\" align=\"right\"> Fecha de Impresion: ".date('d/m/Y H:i:s')."</td>
        </tr>
        </table>";
        
        return $tabla;
    }
    
    function reporte_esp_metro1($fecha1, $fecha2)
    {
        $this->db->select('mue, sec, susa, sum(ped) as ped');
        $this->db->from('catalogo.folio_pedidos_cedis_especial f');
        $this->db->join('desarrollo.pedidos p', 'p.fol=f.id', 'LEFT');
        $this->db->where("f.fechas between '$fecha1' and '$fecha2'", null, false);
        $this->db->where('tid', 'c');
        $this->db->where("invcedis > 0", '', false);
        $this->db->group_by('p.sec');
        $this->db->order_by('mue');
        $this->db->order_by('p.sec');
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //die();
        
        $tabla = "
        
        <table border=\"1\">
        <thead>
        <tr>
        <th width=\"50\" align=\"center\">#</th>
        <th width=\"50\" align=\"center\">UBIC</th>
        <th width=\"50\" align=\"center\">SEC</th>
        <th width=\"400\" align=\"left\">SUSTANCIA ACTIVA</th>
        <th width=\"100\" align=\"center\">CAN. PEDIDA</th>
        </tr>
        </thead>
        <tbody>
        ";
        $n=1;
        
        foreach($query->result() as $row)
       
       {
        
            $tabla.="
            <tr>
            <td width=\"50\" align=\"center\">".$n."</td>
            <td width=\"50\" align=\"center\">".$row->mue."</td>
            <td width=\"50\" align=\"center\">".$row->sec."</td>
            <td width=\"400\" align=\"left\">".$row->susa."</td>
            <td width=\"100\" align=\"right\">".$row->ped."</td>
            </tr>
            ";
        $n++;
        $ped = $ped + $row->ped;
       
        }
    $tabla.= "
    </tbody>
    <tfoot>
        <tr>
        <td align=\"right\" colspan=\"4\">TOTAL CANTIDAD</td>
        <td align=\"right\">".number_format($ped,0)."</td>
        </tr>
        </tfoot>
    </table>";
        
        return $tabla;
        
    }

}