<?php
class Inv_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function inv_todos()
    {
        $sql = "SELECT tipo2, s.suc, nombre, fechai, ifnull(sum(cantidad), 0) as can FROM
catalogo.sucursal s
left join inv i on s.suc = i.suc and dayofweek(fechai) in(3, 4, 5, 6) and fechai in(date(now()), date(DATE_SUB(now(), INTERVAL 1 DAY)), date(DATE_SUB(now(), INTERVAL 2 DAY)), date(DATE_SUB(now(), INTERVAL 3 DAY)))
where tlid = 1 and s.suc between 101 and 2000
group by s.suc
order by suc;";
        return $this->db->query($sql);
    }
    
    function inv_xsucursal()
    {
        $this->db->select('tipo2, s.suc, nombre, fechai, ifnull(sum(cantidad), 0) as can', false);
        $this->db->from('catalogo.sucursal s');
        $this->db->join('inv i', "s.suc = i.suc and dayofweek(fechai) in(2,3,4,5,6) and fechai in(date(now()), date(DATE_SUB(now(), INTERVAL 1 DAY)), date(DATE_SUB(now(), INTERVAL 2 DAY)), date(DATE_SUB(now(), INTERVAL 3 DAY)))", 'LEFT');
        
        $this->db->where('tlid', '1');
        $this->db->where('s.suc', $this->session->userdata('suc'));
        $this->db->group_by('s.suc');
       
        
        $query = $this->db->get();
      
        //echo $this->db->last_query();
        //die();
        
        
        return $query;
    }
    
    
    function inv_findemes()
    {
        $sql = "SELECT tipo2, s.suc, nombre, fechai, ifnull(sum(cantidad), 0) as can FROM
catalogo.sucursal s
left join inv i on s.suc = i.suc and dayofweek(fechai) in(1, 2, 7) and fechai in(date(now()), date(DATE_SUB(now(), INTERVAL 1 DAY)), date(DATE_SUB(now(), INTERVAL 2 DAY)), date(DATE_SUB(now(), INTERVAL 3 DAY)))
where tlid = 1 and s.suc between 101 and 2000
group by s.suc
order by suc;";
        return $this->db->query($sql);
    }

    function inv_pendientes()
    {
        $sql = "SELECT tipo2, s.suc, nombre, ifnull(fechai, 'PENDIENTE') as fechai, ifnull(sum(cantidad), 0) as can FROM
catalogo.sucursal s
left join inv i on s.suc = i.suc and dayofweek(fechai) in(3, 4, 5, 6) and fechai in(date(now()), date(DATE_SUB(now(), INTERVAL 1 DAY)), date(DATE_SUB(now(), INTERVAL 2 DAY)), date(DATE_SUB(now(), INTERVAL 3 DAY)))
where tlid = 1 and s.suc between 101 and 2000
group by s.suc
having sum(cantidad) is null
order by suc
;";
        return $this->db->query($sql);
    }
    
    function inv_pendientes_findemes()
    {
        $sql = "SELECT tipo2, s.suc, nombre, ifnull(fechai, 'PENDIENTE') as fechai, ifnull(sum(cantidad), 0) as can FROM
catalogo.sucursal s
left join inv i on s.suc = i.suc and dayofweek(fechai) in(1, 2, 7) and fechai in(date(now()), date(DATE_SUB(now(), INTERVAL 1 DAY)), date(DATE_SUB(now(), INTERVAL 2 DAY)), date(DATE_SUB(now(), INTERVAL 3 DAY)))
where tlid = 1 and s.suc between 101 and 2000
group by s.suc
having sum(cantidad) is null
order by suc
;";
        return $this->db->query($sql);
    }

    function inv_todos_resp()
    {
        $sql = "SELECT tipo2, i.suc, nombre, fechai, sum(cantidad) as can
FROM inv i
LEFT JOIN catalogo.sucursal s on i.suc = s.suc
group by i.suc, fechai
order by i.suc, fechai;";
        return $this->db->query($sql);
    }

    function detalle_suc_07($suc)
    {
        if($suc == 1600 || $suc == 1601 || $suc == 1602 || $suc == 1603){
            $sql = "SELECT i.*, susa1, susa2 FROM inv i
LEFT JOIN catalogo.catalogo_bodega c on i.sec = c.clabo
where suc = ? and mov = 7 order by sec;";
            
        }else{
        $sql = "SELECT e.sec as desconti, i.*, susa1 FROM inv i
left join catalogo.sec_generica s on i.sec = s.sec
left join catalogo.almacen_borrar e on i.sec = e.sec
where suc = ? and mov = 7 order by sec;";
        }
        return $this->db->query($sql, array($suc));
    }
    
    function detalle_suc_03($suc)
    {
        $sql = "SELECT i.*, descripcion FROM inv i
left join desarrollo.catbackoffice s on i.codigo = s.ean
where suc = ? and mov = 3 order by i.codigo;";
        return $this->db->query($sql, array($suc));
    }

    function titulo_sucursal($suc)
    {
       $sql = "select nombre from catalogo.sucursal where suc = ?";
       $query = $this->db->query($sql, array($suc));
       $row = $query->row();
       
       $a = "<h2>$suc - $row->nombre</h2>
       ";
       
       return $a;
    }

    function con_clave_generica()
    {
        $sql = "SELECT i.sec, sum(cantidad) as can, susa1
FROM inv i
left join catalogo.sec_unica s on i.sec = s.sec
where suc not in(1600, 1601) and mov = 7
group by sec
order by sec;";
        return $this->db->query($sql);
    }

    function sin_clave_generica()
    {
        $sql = "SELECT i.codigo as sec, sum(cantidad) as can, descripcion as susa1
FROM inv i
left join facturacion.concepto s on i.codigo = s.ean
where suc not in(1600, 1601) and mov = 3
group by sec
order by sec;";
        return $this->db->query($sql);
    }

/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
    function busca_clave()
    {
        
        $sql = "SELECT * FROM catalogo.almacen where tsec='G' and sec<2001;";
        $query = $this->db->query($sql);
        
        $clave = array();
        $clave[0] = "Selecciona una clave";
        
        foreach($query->result() as $row){
            $clave[$row->sec] = $row->sec."-".$row->susa1;
        }
        
        return $clave;  
    }
    


    function datos_clave($id)
    {
        
        $s = "SELECT a.*, b.nombre as sucursal FROM desarrollo.inv a
            left join catalogo.sucursal b on a.suc=b.suc
            where a.sec=$id and a.mov=7 group by a.suc;";
        $query = $this->db->query($s);
        
       $tabla = "<table>
        <tr>
        <th>SUCURSAL</th>
        <th>SECUENCIA</th>
        <th>CANTIDAD</th>
        <th>FECHA INV.</th>
        </tr>
        ";
         foreach($query->result() as $row)
        {
          
        
            $tabla.="
        <tr>
        <td>".$row->suc." ".$row->sucursal."</td>
        <td>".$row->sec."</td>
        <td align=\"right\">".$row->cantidad."</td>
        <td>".$row->fechai."</td>
        </tr>
            ";
             }
            $tabla.= "
    </tbody>
    </table>";
      
        return $tabla;
	
        
        
    }


}
