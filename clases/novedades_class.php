<?php
class Novedades
{
	private $id;
	private $observacion;
	private $responsable;
	private $estado_registro;
    private $empresa_numero;
	private $created_at;
	private $updated_at;
    private $idasignacion;
    private $leido;
	private $idtiponovedad;
	

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
     * Gets the value of observacion.
     *
     * @return mixed
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Sets the value of observacion.
     *
     * @param mixed $observacion the observacion
     *
     * @return self
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

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
     * Gets the value of leido.
     *
     * @return mixed
     */
    public function getLeido()
    {
        return $this->leido;
    }

    /**
     * Gets the value of idasignacion.
     *
     * @return mixed
     */
    public function getIdasignacion()
    {
        return $this->idasignacion;
    }

    /**
     * Sets the value of leido.
     *
     * @param mixed $leido the leido
     *
     * @return self
     */
    public function setLeido($leido)
    {
        $this->leido = $leido;

        return $this;
    }

    /**
     * Sets the value of idasignacion.
     *
     * @param mixed $idasignacion the idasignacion
     *
     * @return self
     */
    public function setIdasignacion($idasignacion)
    {
        $this->idasignacion = $idasignacion;

        return $this;
    }

    /**
     * Gets the value of idtiponovedad.
     *
     * @return mixed
     */
    public function getIdtiponovedad()
    {
        return $this->idtiponovedad;
    }

    /**
     * Sets the value of idtiponovedad.
     *
     * @param mixed $idtiponovedad the idtiponovedad
     *
     * @return self
     */
    public function setIdtiponovedad($idtiponovedad)
    {
        $this->idtiponovedad = $idtiponovedad;

        return $this;
    }

    function __construct($id="")
    {
        global $db;

        if ($id!="")
        {
            $sql="SELECT * FROM novedades WHERE id=".$id." ";
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

    public function buscar($aWhere=array(),$aOrWhere=array(),$page="",$per_page="20")
    {
        global $db;

        $resultado=array();

     		$sql="SELECT n.* FROM novedades as n
            inner join asignaciones as asig ON asig.id=n.idasignacion
            inner join usuarios as u ON u.usuario_numero=asig.usuario_numero
          ";

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
                        $type="like";
                        $pos =strpos($key, "like");
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
                    if ($comparar=="like")
                        $condicion.=" (".$key." ".$comparar." '%".$value."%'";
                    else if ($comparar=="IN")
                        $condicion.=" (".$key.$comparar."".$value."";
                    else   
                        $condicion.=" (".$key.$comparar."'".$value."'";
                }
                else
                {
                    if ($comparar=="like")
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

    function agregar(){
        global $db;

        $resultado=false;

        $sql="INSERT INTO novedades (observacion,responsable,idasignacion,leido,estado_registro,empresa_numero,updated_at,created_at) 
              VALUES ('".$this->getObservacion()."','".$this->getResponsable()."','".$this->getIdasignacion()."','".$this->getLeido()."','".$this->getEstado_registro()."','".$this->getEmpresa_numero()."',NOW(),NOW())";
        
        //echo $sql;
        $result=$db->executeQuery($sql);
        $db->commit();

        if (isset($result))
        {
            $resultado=true;
        }

        return $resultado;


    }

    function modificar(){
        global $db;

        $resultado=false;

        $sql="UPDATE novedades SET observacion='".$this->getObservacion()."',
                    responsable='".$this->getResponsable()."',
                    idasignacion='".$this->getIdasignacion()."',
                    leido='".$this->getLeido()."',
                    estado_registro='".$this->getEstado_registro()."',
                    empresa_numero='".$this->getEmpresa_numero()."',
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

    function pasarAleido()
    {
        global $db;

        $resultado=false;

        $sql="UPDATE novedades SET 
                    leido='1',
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

    function eliminar(){
        global $db;

        $resultado=false;

        $sql="UPDATE novedades SET 
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

    

    
}
?>