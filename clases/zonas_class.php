<?php
class Zonas
{
	private $id;
	private $descripcion;
	private $estado;
    private $empresa_numero;
	
	

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
     * Gets the value of descripcion.
     *
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Sets the value of descripcion.
     *
     * @param mixed $descripcion the descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    
    /**
     * Gets the value of estado_registro.
     *
     * @return mixed
     */
    public function getEstado_registro()
    {
        return $this->estado;
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
        $this->estado = $estado_registro;

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

    function __construct($id="")
    {
        global $db;

        if ($id!="")
        {
            $sql="SELECT * FROM zonas WHERE id=".$id." ";
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

     		$sql="SELECT * FROM zonas 
          ";

        $condicion="";
        if (count($aWhere)>0)
        {
            if ($condicion=="")
                $condicion.=" WHERE ";
            $i=0;
            foreach($aWhere as $key=>$value)
            {
                $pos = strpos($key, "<") || strpos($key, ">");

                if ($pos===false)
                {
                    $comparar="=";
                }
                else
                {
                    $comparar=substr($key,$pos);
                    $key=substr($key, 0,$pos);
                }
                if ($i==0)
                    $condicion.=" ".$key.$comparar.$value;
                else
                    $condicion.=" AND ".$key.$comparar.$value;
                
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

        $sql="INSERT INTO zonas (descripcion,estado,empresa_numero) 
              VALUES ('".$this->getDescripcion()."','".$this->getEstado_registro()."','".$this->getEmpresa_numero()."')";
        
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

        $sql="UPDATE zonas SET 
                    descripcion='".$this->getDescripcion()."',
                    estado='".$this->getEstado_registro()."',
                    empresa_numero='".$this->getEmpresa_numero()."'
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

        $sql="UPDATE zonas SET 
                    estado='".$this->getEstado_registro()."'
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