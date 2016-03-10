<?php
class Turnos
{
	private $id;
	private $nombre;
	private $descripcion;
	private $hora_inicio;
	private $hora_fin;
	private $lunes;
	private $martes;
	private $miercoles;
	private $jueves;
	private $viernes;
	private $sabados;
	private $domingo;
	private $estado_registro;
    private $empresa_numero;
	private $created_at;
	private $updated_at;
	
	

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
     * Gets the value of nombre.
     *
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the value of nombre.
     *
     * @param mixed $nombre the nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

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
     * Gets the value of hora_inicio.
     *
     * @return mixed
     */
    public function getHora_inicio()
    {
        return $this->hora_inicio;
    }

    /**
     * Sets the value of hora_inicio.
     *
     * @param mixed $hora_inicio the hora_inicio
     *
     * @return self
     */
    public function setHora_inicio($hora_inicio)
    {
        $this->hora_inicio = $hora_inicio;

        return $this;
    }

    /**
     * Gets the value of hora_fin.
     *
     * @return mixed
     */
    public function getHora_fin()
    {
        return $this->hora_fin;
    }

    /**
     * Sets the value of hora_fin.
     *
     * @param mixed $hora_fin the hora_fin
     *
     * @return self
     */
    public function setHora_fin($hora_fin)
    {
        $this->hora_fin = $hora_fin;

        return $this;
    }

    /**
     * Gets the value of lunes.
     *
     * @return mixed
     */
    public function getLunes()
    {
        return $this->lunes;
    }

    /**
     * Sets the value of lunes.
     *
     * @param mixed $lunes the lunes
     *
     * @return self
     */
    public function setLunes($lunes)
    {
    	if ($lunes=='')
    		$lunes=0;

        $this->lunes = $lunes;

        return $this;
    }

    /**
     * Gets the value of martes.
     *
     * @return mixed
     */
    public function getMartes()
    {
        return $this->martes;
    }

    /**
     * Sets the value of martes.
     *
     * @param mixed $martes the martes
     *
     * @return self
     */
    public function setMartes($martes)
    {
        if ($martes=='')
    		$martes=0;
    	
    	$this->martes = $martes;

        return $this;
    }

    /**
     * Gets the value of miercoles.
     *
     * @return mixed
     */
    public function getMiercoles()
    {
        return $this->miercoles;
    }

    /**
     * Sets the value of miercoles.
     *
     * @param mixed $miercoles the miercoles
     *
     * @return self
     */
    public function setMiercoles($miercoles)
    {
    	if ($miercoles=='')
    		$miercoles=0;

        $this->miercoles = $miercoles;

        return $this;
    }

    /**
     * Gets the value of jueves.
     *
     * @return mixed
     */
    public function getJueves()
    {
        return $this->jueves;
    }

    /**
     * Sets the value of jueves.
     *
     * @param mixed $jueves the jueves
     *
     * @return self
     */
    public function setJueves($jueves)
    {
    	if ($jueves=='')
    		$jueves=0;

        $this->jueves = $jueves;

        return $this;
    }

    /**
     * Gets the value of viernes.
     *
     * @return mixed
     */
    public function getViernes()
    {
        return $this->viernes;
    }

    /**
     * Sets the value of viernes.
     *
     * @param mixed $viernes the viernes
     *
     * @return self
     */
    public function setViernes($viernes)
    {
    	if ($viernes=='')
    		$viernes=0;

        $this->viernes = $viernes;

        return $this;
    }

    /**
     * Gets the value of sabados.
     *
     * @return mixed
     */
    public function getSabados()
    {
        return $this->sabados;
    }

    /**
     * Sets the value of sabados.
     *
     * @param mixed $sabados the sabados
     *
     * @return self
     */
    public function setSabados($sabados)
    {
    	if ($sabados=='')
    		$sabados=0;

        $this->sabados = $sabados;

        return $this;
    }

    /**
     * Gets the value of domingo.
     *
     * @return mixed
     */
    public function getDomingo()
    {
        return $this->domingo;
    }

    /**
     * Sets the value of domingo.
     *
     * @param mixed $domingo the domingo
     *
     * @return self
     */
    public function setDomingo($domingo)
    {
    	if ($domingo=='')
    		$domingo=0;
    	
        $this->domingo = $domingo;

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

    function __construct($id="")
    {
        global $db;

        if ($id!="")
        {
            $sql="SELECT * FROM turnos WHERE id=".$id." ";
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

     		$sql="SELECT * FROM turnos 
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

        $sql="INSERT INTO turnos (nombre,descripcion,hora_inicio,hora_fin,lunes,martes,miercoles,jueves,viernes,sabados,domingo,
            estado_registro,empresa_numero,updated_at,created_at) 
              VALUES ('".$this->getNombre()."','".$this->getDescripcion()."','".$this->getHora_inicio()."',
                '".$this->getHora_fin()."','".$this->getLunes()."','".$this->getMartes()."','".$this->getMiercoles()."'
                ,'".$this->getJueves()."','".$this->getViernes()."','".$this->getSabados()."','".$this->getDomingo()."'
                ,'".$this->getEstado_registro()."','".$this->getEmpresa_numero()."',NOW(),NOW())";
        
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

        $sql="UPDATE turnos SET nombre='".$this->getNombre()."',
                    descripcion='".$this->getDescripcion()."',
                    hora_inicio='".$this->getHora_inicio()."',
                    hora_fin='".$this->getHora_fin()."',
                    lunes='".$this->getLunes()."',
                    martes='".$this->getMartes()."',
                    miercoles='".$this->getMiercoles()."',
                    jueves='".$this->getJueves()."',
                    viernes='".$this->getViernes()."',
                    sabados='".$this->getSabados()."',
                    domingo='".$this->getDomingo()."',
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

    function eliminar(){
        global $db;

        $resultado=false;

        $sql="UPDATE turnos SET 
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