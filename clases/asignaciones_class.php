<?php
class Asignaciones
{
    private $id;
    private $asunto;
    private $paciente;
    private $cedula;
    private $usuario_numero;
    private $idtipoasignacion;
    private $responsable;
    private $estado_registro;
    private $empresa_numero;
    private $created_at;
    private $updated_at;
    private $en_movil;
    
    

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of asunto.
     *
     * @return mixed
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Sets the value of asunto.
     *
     * @param mixed $asunto the asunto
     *
     * @return self
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Gets the value of responsable.
     *
     * @return mixed
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Sets the value of responsable.
     *
     * @param mixed $responsable the responsable
     *
     * @return self
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Gets the value of paciente.
     *
     * @return mixed
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Sets the value of paciente.
     *
     * @param mixed $paciente the paciente
     *
     * @return self
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;

        return $this;
    }

    
    /**
     * Gets the value of estado_registro.
     *
     * @return mixed
     */
    public function getEstado_registro()
    {
        return $this->estado_registro;
    }

    /**
     * Sets the value of estado_registro.
     *
     * @param mixed $estado_registro the estado_registro
     *
     * @return self
     */
    public function setEstado_registro($estado_registro)
    {
        $this->estado_registro = $estado_registro;

        return $this;
    }

     /**
     * Gets the value of created_at.
     *
     * @return mixed
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Sets the value of created_at.
     *
     * @param mixed $created_at the created_at
     *
     * @return self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Gets the value of updated_at.
     *
     * @return mixed
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Sets the value of updated_at.
     *
     * @param mixed $updated_at the updated_at
     *
     * @return self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

     /**
     * Gets the value of empresa_numero.
     *
     * @return mixed
     */
    public function getEmpresa_numero()
    {
        return $this->empresa_numero;
    }

    /**
     * Sets the value of empresa_numero.
     *
     * @param mixed $empresa_numero the empresa_numero
     *
     * @return self
     */
    public function setEmpresa_numero($empresa_numero)
    {
        $this->empresa_numero = $empresa_numero;

        return $this;
    }

     /**
     * Gets the value of usuario_numero.
     *
     * @return mixed
     */
    public function getUsuario_numero()
    {
        return $this->usuario_numero;
    }

    /**
     * Sets the value of usuario_numero.
     *
     * @param mixed $usuario_numero the usuario_numero
     *
     * @return self
     */
    public function setUsuario_numero($usuario_numero)
    {
        $this->usuario_numero = $usuario_numero;

        return $this;
    }

    /**
     * Gets the value of idtipoasignacion.
     *
     * @return mixed
     */
    public function getIdtipoasignacion()
    {
        return $this->idtipoasignacion;
    }

    /**
     * Sets the value of idtipoasignacion.
     *
     * @param mixed $idtipoasignacion the idtipoasignacion
     *
     * @return self
     */
    public function setIdtipoasignacion($idtipoasignacion)
    {
        $this->idtipoasignacion = $idtipoasignacion;

        return $this;
    }

    /**
     * Gets the value of cedula.
     *
     * @return mixed
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Sets the value of cedula.
     *
     * @param mixed $cedula the cedula
     *
     * @return self
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Gets the value of en_movil.
     *
     * @return mixed
     */
    public function getEn_movil()
    {
        return $this->en_movil;
    }

    /**
     * Sets the value of en_movil.
     *
     * @param mixed $en_movil the en_movil
     *
     * @return self
     */
    public function setEn_movil($cedula)
    {
        $this->cedula = $en_movil;

        return $this;
    }

    

    function __construct($id="")
    {
        global $db;

        if ($id!="")
        {
            $sql="SELECT * FROM asignaciones WHERE id=".$id." ";
            //echo $sql;
            $result=$db->executeQuery($sql);
            $db->commit();

            if (isset($result))
            {
                if (count($result)>0)
                {
                    foreach($result[0] as $key=>$value)
                    {
                        $this->$key=$value;
                    }
                }
            }
            return $this;
        }
        
    }

    public function buscar($aWhere=array(),$aOrWhere=array(),$page="",$per_page="20",$orderby="",$orderType="",$groupBy="",$select="")
    {
        global $db;

        $resultado=array();

        if ($select=="")
        {
            $sql="SELECT a.* FROM asignaciones as a inner join usuarios as u ON u.usuario_numero=a.usuario_numero
          ";
        }
        else
        {
            $sql="SELECT ".$select." FROM asignaciones as a inner join usuarios as u ON u.usuario_numero=a.usuario_numero
          ";
        }
        $condicion="";
        if (count($aWhere)>0)
            {
                if ($condicion=="")
                    $condicion.=" WHERE ";
                $i=0;
                foreach($aWhere as $key=>$value)
                {
                    $type="<";
                    $pos = strpos($key, "<") ;
                    if ($pos===false)
                    {
                        $type=">";
                        $pos = strpos($key, ">");
                        if ($pos===false)
                        {
                            $type="ilike";
                            $pos =strpos($key, "ilike");
                            if ($pos===false)
                            {
                                $type="IN";
                                $pos =strpos($key, "IN");
                            }
                        }
                    }

                    if ($pos===false)
                    {
                        $comparar="=";
                    }
                    else
                    {
                        $pos=strpos($key, $type);
                       
                        $comparar=substr($key,$pos);
                        $key=substr($key, 0,$pos);
                    }
                    if ($i==0)
                    {
                        if ($comparar=="ilike")
                            $condicion.=" ".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" ".$key.$comparar."".$value."";
                        else   
                            $condicion.=" ".$key.$comparar."'".$value."'";
                    }
                    else
                    {
                        if ($comparar=="ilike")
                            $condicion.=" AND ".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" AND ".$key.$comparar."".$value."";
                        else
                            $condicion.=" AND ".$key.$comparar."'".$value."'";
                    }
                    
                    
                    $i++;
                }
            }

        if (count($aOrWhere)>0)
        {
            if ($condicion=="")
                $condicion.=" WHERE ";
            else
                $condicion.=" AND ";
            $i=0;
            foreach($aOrWhere as $key=>$value)
            {
                $type="<";
                $pos = strpos($key, "<") ;
                if ($pos===false)
                {
                    $type=">";
                    $pos = strpos($key, ">");
                    if ($pos===false)
                    {
                        $type="ilike";
                        $pos =strpos($key, "ilike");
                        if ($pos===false)
                        {
                            $type="IN";
                            $pos =strpos($key, "IN");
                        }
                    }
                }

                if ($pos===false)
                {
                    $comparar="=";
                }
                else
                {
                    $pos=strpos($key, $type);
                   
                    $comparar=substr($key,$pos);
                    $key=substr($key, 0,$pos);
                }
                if ($i==0)
                {
                    if ($comparar=="ilike")
                        $condicion.=" (".$key." ".$comparar." '%".$value."%'";
                    else if ($comparar=="IN")
                        $condicion.=" (".$key.$comparar."".$value."";
                    else   
                        $condicion.=" (".$key.$comparar."'".$value."'";
                }
                else
                {
                    if ($comparar=="ilike")
                        $condicion.=" OR ".$key." ".$comparar." '%".$value."%'";
                    else if ($comparar=="IN")
                        $condicion.=" OR ".$key.$comparar."".$value."";
                    else
                        $condicion.=" OR ".$key.$comparar."'".$value."'";
                }

                $i++;
            }
            $condicion.=") ";
        }
        $sql.=$condicion;
            
            if ($groupBy!="")
            {
                 $sql.=" GROUP BY ".$groupBy." ";
            }

            if ($orderby!="")
            {
                $sql.=" ORDER BY ".$orderby." ".$orderType." ";
            }

            if ($page!="")
            {
                $sql.=" LIMIT ".$per_page." OFFSET ".$page;
            }
                //echo $sql;
                $result=$db->executeQuery($sql);
                $db->commit();

                if (isset($result))
                {
                    if (count($result)>0)
                    {
                        $index=0;
                        foreach($result as $objeto)
                        {   
                            $resultado[$index]=new self();
                            foreach($objeto as $key=>$value)
                            {
                                $resultado[$index]->$key=$value;
                            }
                            $index++;
                        }
                    }
                }
                
        

        return $resultado;

    }

    public function buscar_frecuencia($aWhere=array(),$aOrWhere=array(),$page="",$per_page="20",$orderby="",$orderType="",$groupBy="",$select="",$count="")
    {
        global $db;

        $resultado=array();
        $sql="";
        if ($count!="")
        {
            $sql.="SELECT count(t.*) as total FROM (";
        }

        if ($select=="")
        {
            $sql.="SELECT a.* FROM asignaciones as a inner join usuarios as u ON u.usuario_numero=a.usuario_numero
            inner join asignaciones_puntos as ap ON ap.idasignacion=a.id 
            inner join puntos_chequeo as p ON p.id=ap.idpunto
            inner join asignaciones_puntos as ap_dest ON ap_dest.idasignacion=a.id AND ap_dest.orden=(ap.orden+1)
            inner join puntos_chequeo as p_dest ON p_dest.id=ap_dest.idpunto
            
          ";
        }
        else
        {
            $sql.="SELECT ".$select." FROM asignaciones as a inner join usuarios as u ON u.usuario_numero=a.usuario_numero
            inner join asignaciones_puntos as ap ON ap.idasignacion=a.id 
            inner join puntos_chequeo as p ON p.id=ap.idpunto
             inner join asignaciones_puntos as ap_dest ON ap_dest.idasignacion=a.id AND ap_dest.orden=(ap.orden+1)
            inner join puntos_chequeo as p_dest ON p_dest.id=ap_dest.idpunto
        
          ";
        }
        $condicion="";
        if (count($aWhere)>0)
            {
                if ($condicion=="")
                    $condicion.=" WHERE ";
                $i=0;
                foreach($aWhere as $key=>$value)
                {
                    $type="<";
                    $pos = strpos($key, "<") ;
                    if ($pos===false)
                    {
                        $type=">";
                        $pos = strpos($key, ">");
                        if ($pos===false)
                        {
                            $type="ilike";
                            $pos =strpos($key, "ilike");
                            if ($pos===false)
                            {
                                $type="IN";
                                $pos =strpos($key, "IN");
                            }
                        }
                    }

                    if ($pos===false)
                    {
                        $comparar="=";
                    }
                    else
                    {
                        $pos=strpos($key, $type);
                       
                        $comparar=substr($key,$pos);
                        $key=substr($key, 0,$pos);
                    }
                    if ($i==0)
                    {
                        if ($comparar=="ilike")
                            $condicion.=" ".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" ".$key.$comparar."".$value."";
                        else   
                            $condicion.=" ".$key.$comparar."'".$value."'";
                    }
                    else
                    {
                        if ($comparar=="ilike")
                            $condicion.=" AND ".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" AND ".$key.$comparar."".$value."";
                        else
                            $condicion.=" AND ".$key.$comparar."'".$value."'";
                    }
                    
                    
                    $i++;
                }
            }

        if (count($aOrWhere)>0)
        {
            if ($condicion=="")
                $condicion.=" WHERE ";
            else
                $condicion.=" AND ";
            $i=0;
            foreach($aOrWhere as $key=>$value)
            {
                $type="<";
                $pos = strpos($key, "<") ;
                if ($pos===false)
                {
                    $type=">";
                    $pos = strpos($key, ">");
                    if ($pos===false)
                    {
                        $type="ilike";
                        $pos =strpos($key, "ilike");
                        if ($pos===false)
                        {
                            $type="IN";
                            $pos =strpos($key, "IN");
                        }
                    }
                }

                if ($pos===false)
                {
                    $comparar="=";
                }
                else
                {
                    $pos=strpos($key, $type);
                   
                    $comparar=substr($key,$pos);
                    $key=substr($key, 0,$pos);
                }
                if ($i==0)
                {
                    if ($comparar=="ilike")
                        $condicion.=" (".$key." ".$comparar." '%".$value."%'";
                    else if ($comparar=="IN")
                        $condicion.=" (".$key.$comparar."".$value."";
                    else   
                        $condicion.=" (".$key.$comparar."'".$value."'";
                }
                else
                {
                    if ($comparar=="ilike")
                        $condicion.=" OR ".$key." ".$comparar." '%".$value."%'";
                    else if ($comparar=="IN")
                        $condicion.=" OR ".$key.$comparar."".$value."";
                    else
                        $condicion.=" OR ".$key.$comparar."'".$value."'";
                }

                $i++;
            }
            $condicion.=") ";
        }
        $sql.=$condicion;
            
            if ($groupBy!="")
            {
                 $sql.=" GROUP BY ".$groupBy." ";
            }

            if ($orderby!="")
            {
                $sql.=" ORDER BY ".$orderby." ".$orderType." ";
            }

            if ($page!="")
            {
                $sql.=" LIMIT ".$per_page." OFFSET ".$page;
            }

            if ($count!="")
            {
                $sql.=") as t";
            }
                //echo $sql;
                $result=$db->executeQuery($sql);
                $db->commit();

                if (isset($result))
                {
                    if (count($result)>0)
                    {
                        $index=0;
                        foreach($result as $objeto)
                        {   
                            $resultado[$index]=new self();
                            foreach($objeto as $key=>$value)
                            {
                                $resultado[$index]->$key=$value;
                            }
                            $index++;
                        }
                    }
                }
                
        

        return $resultado;

    }

    function getUltimoId() 
    {
        global $db;

        $sql = "SELECT max(id) FROM asignaciones";
        $res = $db->executeQuery($sql);
        $db->commit();

        if (isset($res)) {
            if (count($res) > 0) {
                foreach($res as $obj) {
                    foreach($obj as $value) {
                        return $value;
                    }
                }
            }
        }
    }

    function getRutaChequeo() 
        {
            global $db;
            //$result=array();
            $sql = "SELECT idruta FROM asignaciones_puntos WHERE idasignacion=".$this->getId()." group by idruta";
            $res = $db->executeQuery($sql);
            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                       foreach($obj as $value) {
                        return $value;
                        }
                    }
                }
            }

           // return $result;
        }

    function getAlertaNovedades() 
        {
            global $db;
            $result=array();
            $sql = "SELECT * FROM (
                    SELECT a.observacion,a.idasignacion,a.responsable,a.leido,a.created_at,a.empresa_numero,a.estado_registro,'0' as idtiponovedad FROM alertas as a WHERE a.idasignacion=".$this->getId()." UNION 
                    SELECT n.observacion,n.idasignacion,n.responsable,n.leido,n.created_at,n.empresa_numero,n.estado_registro,n.idtiponovedad FROM novedades as n WHERE n.idasignacion=".$this->getId().") as detalle 
                    ORDER BY detalle.created_at DESC";
            $res = $db->executeQuery($sql);
            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                       $result[]=$obj; 
                    }
                }
            }

            return $result;
        }

    function getPuntosChequeo() 
        {
            global $db;
            $result=array();
            $sql = "SELECT * FROM asignaciones_puntos WHERE idasignacion=".$this->getId()." ORDER BY orden ASC";
            $res = $db->executeQuery($sql);
            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                       $result[]=$obj; 
                    }
                }
            }

            return $result;
        }

        function getUltimoPuntoChequeoM() 
        {
            global $db;
            $result=array();
            $sql = "SELECT idpunto,updated_at FROM asignaciones_puntos WHERE idasignacion=".$this->getId()." AND checkpoint='1' ORDER BY orden DESC LIMIT 1 OFFSET 0";
            $res = $db->executeQuery($sql);
            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                       $result[]=$obj; 
                    }
                }
            }

            return $result;
        }

        function getPorcentajePuntoChequeoM() 
        {
            global $db;
            $result=array();
            $sql = "SELECT count(*) as total, (SELECT count(*) FROM asignaciones_puntos 
                                                WHERE idasignacion=".$this->getId()." 
                                                AND checkpoint='1') as marcados 
                    FROM asignaciones_puntos 
                    WHERE idasignacion=".$this->getId()."";
            $res = $db->executeQuery($sql);
            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                       $result[]=$obj; 
                    }
                }
            }

            return $result;
        }

        function getAsignacionesPorArea($aWhere=array()) 
        {
            global $db;
            $result=array();
            $sql = "SELECT a.* FROM asignaciones as a 
            INNER JOIN usuarios as u ON u.usuario_numero=a.usuario_numero ";
            $condicion="";
            if (count($aWhere)>0)
            {
                if ($condicion=="")
                    $condicion.=" WHERE ";
                $i=0;
                foreach($aWhere as $key=>$value)
                {
                    $type="<";
                    $pos = strpos($key, "<") ;
                    if ($pos===false)
                    {
                        $type=">";
                        $pos = strpos($key, ">");
                        if ($pos===false)
                        {
                            $type="ilike";
                            $pos =strpos($key, "ilike");
                            if ($pos===false)
                            {
                                $type="IN";
                                $pos =strpos($key, "IN");
                            }
                        }
                    }

                    if ($pos===false)
                    {
                        $comparar="=";
                    }
                    else
                    {
                        $pos=strpos($key, $type);
                       
                        $comparar=substr($key,$pos);
                        $key=substr($key, 0,$pos);
                    }
                    if ($i==0)
                    {
                        if ($comparar=="ilike")
                            $condicion.=" ".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" ".$key.$comparar."".$value."";
                        else   
                            $condicion.=" ".$key.$comparar."'".$value."'";
                    }
                    else
                    {
                        if ($comparar=="ilike")
                            $condicion.=" AND ".$key." ".$comparar." '%".$value."%'";
                        else if ($comparar=="IN")
                            $condicion.=" AND ".$key.$comparar."".$value."";
                        else
                            $condicion.=" AND ".$key.$comparar."'".$value."'";
                    }
                    
                    
                    $i++;
                }
            }
            $sql.=$condicion;
            $res = $db->executeQuery($sql);

            $db->commit();

            if (isset($res)) {
                if (count($res) > 0) {
                    foreach($res as $obj) {
                       $result[]=$obj; 
                    }
                }
            }

            return $result;
        }

    function agregar($array_puntos=array()){
        global $db;

        $resultado=false;
        if ($this->getIdtipoasignacion()=="") $idasig=0;
        else if ($this->getIdtipoasignacion()!="") $idasig=$this->getIdtipoasignacion();

			$fechaHoy = date("Y-m-d H:i:s");
			$nuevafecha = date("Y-m-d H:i:s",strtotime ( '-12 minute' , strtotime ( $fechaHoy ) ));//Esto hay que sacarlo, solo lo puse porque la hora del servidor daba mal
        $sql="INSERT INTO asignaciones (asunto,paciente,cedula,usuario_numero,idtipoasignacion,responsable,estado_registro,empresa_numero,updated_at,created_at) 
              VALUES ('".$this->getAsunto()."','".$this->getPaciente()."','".$this->getCedula()."'
                ,'".$this->getUsuario_numero()."','".$idasig."','".$this->getResponsable()."',
                '".$this->getEstado_registro()."','".$this->getEmpresa_numero()."','".$nuevafecha."','".$nuevafecha."')";
        
        //echo $sql;
        $result=$db->executeQuery($sql);
        $db->commit();

        $asignacion=$this->getUltimoId();

        if (count($array_puntos)>0)
        {
            $orden=1;
            foreach($array_puntos as $val)
            {
                $ins="INSERT INTO asignaciones_puntos (idasignacion,idruta,idpunto,checkpoint,updated_at,created_at,orden) 
                VALUES ('".$asignacion."','".$val['idruta']."','".$val['idpunto']."','0','".$nuevafecha."','".$nuevafecha."','".$orden."') ";
                //echo $ins;
                $resQuery = $db->executeQuery($ins);
                $db->commit();
                $orden++;
            }
        }

        if (isset($result))
        {
        		$this->enviarNotificacionPush();
            $resultado=true;
        }

        return $resultado;


    }

    function modificar($array_puntos=array()){
        global $db;

        $resultado=false;
        if ($this->getIdtipoasignacion()=="") $idasig=0;
        else if ($this->getIdtipoasignacion()!="") $idasig=$this->getIdtipoasignacion();


        $sql="UPDATE asignaciones SET asunto='".$this->getAsunto()."',
                    paciente='".$this->getPaciente()."',
                    cedula='".$this->getCedula()."',
                    idtipoasignacion='".$idasig."',
                    responsable='".$this->getResponsable()."',
                    usuario_numero='".$this->getUsuario_numero()."',
                    estado_registro='".$this->getEstado_registro()."',
                    empresa_numero='".$this->getEmpresa_numero()."',
                    updated_at=NOW()
                WHERE id='".$this->getId()."'";

        $result=$db->executeQuery($sql);
        $db->commit();

        $aWhere=array();
        $aWhere['a.id']=$this->getId();
        $aAsignaciones=$this->buscar($aWhere);

        $del="DELETE FROM asignaciones_puntos where idasignacion='".$aAsignaciones[0]->getId()."'";
        $resQuery = $db->executeQuery($del);
        $db->commit();

        if (count($array_puntos)>0)
        {   
            $orden=1;
            foreach($array_puntos as $val)
            {
                $ins="INSERT INTO asignaciones_puntos (idasignacion,idruta,idpunto,checkpoint,updated_at,created_at,orden) 
                VALUES ('".$aAsignaciones[0]->getId()."','".$val['idruta']."','".$val['idpunto']."','0',NOW(),NOW(),'".$orden."') ";
                $resQuery = $db->executeQuery($ins);
                $db->commit();
                $orden++;
            }
        }

        if (isset($result))
        {
        	   $this->enviarNotificacionPush();
            $resultado=true;
        }

        return $resultado;

    }

    function eliminar(){
        global $db;

        $resultado=false;

        $sql="UPDATE asignaciones SET 
                    estado_registro='".$this->getEstado_registro()."',
                    updated_at=NOW()
                WHERE id='".$this->getId()."'";

        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;

    }
    
    /*Agregamos esta funcion para enviar una notificacion cuando se crea o modifica una asignacion*/
    function enviarNotificacionPush() {
    	global $db;
    	global $gcm;
    	
		$usuario_numero = $this->getUsuario_numero();
      $query ="SELECT * FROM usuarios WHERE usuario_numero=$usuario_numero";
		$userToDatos=$db->executeQuery($query);
      $db->commit();
      
      if(count($userToDatos) > 0 && !empty($userToDatos[0]["gcm_token"])) {
				$gcm->setDevices(array($userToDatos[0]["gcm_token"]));
				$response = $gcm->send(substr($mensaje, 0, 150), array(
					'notification_type' => 'sync_data'
				));
			}
			
		return 'OK';
    	
    	
    }
}
?>