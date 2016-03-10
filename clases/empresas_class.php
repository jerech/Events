<?php
class Empresas{

	private $id;
	private $empresa_numero;
	private $tipo_documento;
	private $documento;
	private $nombre_empresa;
	private $contacto;
	private $telefono;
	private $email;
	private $fecha_inicio;
	private $fecha_corte;
	private $dias_corte;
	private $cantidad_usuarios;
	private $paquete;
	private $estado_registro;
	private $ciudad;
	private $direccion;
	private $created_at;
	private $updated_at;
	private $logo_empresa;
	private $background_inicial;
	private $footer_empresa;
    private $dias_prueba;
    private $etapa;
    private $background_movil;
    

	function __construct($id="",$empresa_numero="")
        {
            global $db;

            if ($id!="")
            {
                $sql="SELECT * FROM empresa WHERE id=".$id." AND estado_registro=1 LIMIT 1";
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
            else if ($empresa_numero!="")
            {
                 $sql="SELECT * FROM empresa WHERE empresa_numero=".$empresa_numero." AND estado_registro=1 LIMIT 1";
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
     * Gets the value of tipo_documento.
     *
     * @return mixed
     */
    public function getTipo_documento()
    {
        return $this->tipo_documento;
    }

    /**
     * Sets the value of tipo_documento.
     *
     * @param mixed $tipo_documento the tipo_documento
     *
     * @return self
     */
    public function setTipo_documento($tipo_documento)
    {
        $this->tipo_documento = $tipo_documento;

        return $this;
    }

    /**
     * Gets the value of documento.
     *
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Sets the value of documento.
     *
     * @param mixed $documento the documento
     *
     * @return self
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Gets the value of nombre_empresa.
     *
     * @return mixed
     */
    public function getNombre_empresa()
    {
        return $this->nombre_empresa;
    }

    /**
     * Sets the value of nombre_empresa.
     *
     * @param mixed $nombre_empresa the nombre_empresa
     *
     * @return self
     */
    public function setNombre_empresa($nombre_empresa)
    {
        $this->nombre_empresa = $nombre_empresa;

        return $this;
    }

    /**
     * Gets the value of contacto.
     *
     * @return mixed
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Sets the value of contacto.
     *
     * @param mixed $contacto the contacto
     *
     * @return self
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Gets the value of telefono.
     *
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Sets the value of telefono.
     *
     * @param mixed $telefono the telefono
     *
     * @return self
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of fecha_inicio.
     *
     * @return mixed
     */
    public function getFecha_inicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Sets the value of fecha_inicio.
     *
     * @param mixed $fecha_inicio the fecha_inicio
     *
     * @return self
     */
    public function setFecha_inicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    /**
     * Gets the value of fecha_corte.
     *
     * @return mixed
     */
    public function getFecha_corte()
    {
        return $this->fecha_corte;
    }

    /**
     * Sets the value of fecha_corte.
     *
     * @param mixed $fecha_corte the fecha_corte
     *
     * @return self
     */
    public function setFecha_corte($fecha_corte)
    {
        $this->fecha_corte = $fecha_corte;

        return $this;
    }

    /**
     * Gets the value of dias_corte.
     *
     * @return mixed
     */
    public function getDias_corte()
    {
        return $this->dias_corte;
    }

    /**
     * Sets the value of dias_corte.
     *
     * @param mixed $dias_corte the dias_corte
     *
     * @return self
     */
    public function setDias_corte($dias_corte)
    {
        $this->dias_corte = $dias_corte;

        return $this;
    }

    /**
     * Gets the value of cantidad_usuarios.
     *
     * @return mixed
     */
    public function getCantidad_usuarios()
    {
        return $this->cantidad_usuarios;
    }

    /**
     * Sets the value of cantidad_usuarios.
     *
     * @param mixed $cantidad_usuarios the cantidad_usuarios
     *
     * @return self
     */
    public function setCantidad_usuarios($cantidad_usuarios)
    {
        $this->cantidad_usuarios = $cantidad_usuarios;

        return $this;
    }

    /**
     * Gets the value of paquete.
     *
     * @return mixed
     */
    public function getPaquete()
    {
        return $this->paquete;
    }

    /**
     * Sets the value of paquete.
     *
     * @param mixed $paquete the paquete
     *
     * @return self
     */
    public function setPaquete($paquete)
    {
        $this->paquete = $paquete;

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
     * Gets the value of ciudad.
     *
     * @return mixed
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Sets the value of ciudad.
     *
     * @param mixed $ciudad the ciudad
     *
     * @return self
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Gets the value of direccion.
     *
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Sets the value of direccion.
     *
     * @param mixed $direccion the direccion
     *
     * @return self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

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
     * Gets the value of logo_empresa.
     *
     * @return mixed
     */
    public function getLogo_empresa()
    {
        return $this->logo_empresa;
    }

    /**
     * Sets the value of logo_empresa.
     *
     * @param mixed $logo_empresa the logo_empresa
     *
     * @return self
     */
    public function setLogo_empresa($logo_empresa)
    {
        $this->logo_empresa = $logo_empresa;

        return $this;
    }

    /**
     * Gets the value of background_inicial.
     *
     * @return mixed
     */
    public function getBackground_inicial()
    {
        return $this->background_inicial;
    }

    /**
     * Sets the value of background_inicial.
     *
     * @param mixed $background_inicial the background_inicial
     *
     * @return self
     */
    public function setBackground_inicial($background_inicial)
    {
        $this->background_inicial = $background_inicial;

        return $this;
    }

    /**
     * Gets the value of footer_empresa.
     *
     * @return mixed
     */
    public function getFooter_empresa()
    {
        return $this->footer_empresa;
    }

    /**
     * Sets the value of footer_empresa.
     *
     * @param mixed $footer_empresa the footer_empresa
     *
     * @return self
     */
    public function setFooter_empresa($footer_empresa)
    {
        $this->footer_empresa = $footer_empresa;

        return $this;
    }

    /**
     * Gets the value of dias_prueba.
     *
     * @return mixed
     */
    public function getDias_prueba()
    {
        return $this->dias_prueba;
    }

    /**
     * Sets the value of dias_prueba.
     *
     * @param mixed $dias_prueba the dias_prueba
     *
     * @return self
     */
    public function setDias_prueba($dias_prueba)
    {
        $this->dias_prueba = $dias_prueba;

        return $this;
    }

    /**
     * Sets the value of etapa.
     *
     * @param mixed $etapa the etapa
     *
     * @return self
     */
    public function setEtapa($etapa)
    {
        $this->etapa = $etapa;

        return $this;
    }

     /**
     * Gets the value of etapa.
     *
     * @return mixed
     */
    public function getEtapa()
    {
        return $this->etapa;
    }

    /**
     * Gets the value of background_movil.
     *
     * @return mixed
     */
    public function getBackground_movil()
    {
        return $this->background_movil;
    }

    /**
     * Sets the value of background_movil.
     *
     * @param mixed $background_movil the background_movil
     *
     * @return self
     */
    public function setBackground_movil($background_movil)
    {
        $this->background_movil = $background_movil;

        return $this;
    }


    public function buscar($aWhere=array(),$aOrWhere=array(),$page="",$per_page="20")
        {
            global $db;

            $resultado=array();

            $sql="SELECT * FROM empresa 
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

        function eliminar(){
            global $db;

            $resultado=false;

            $sql="UPDATE empresa SET estado_registro='".$this->getEstado_registro()."',
                        updated_at=NOW()
                    WHERE id='".$this->getId()."'";

            $result=$db->Query($sql);
            if ($result)
            {
               // $db->commit();

               
                    $resultado=true;
            }
            return $resultado;

        }


        function agregar(){
            global $db;

            $resultado=false;

            $sql="INSERT INTO empresa (tipo_documento,documento,nombre_empresa,contacto,telefono,email,
                fecha_inicio,fecha_corte,dias_corte,cantidad_usuarios,paquete,ciudad,direccion,estado_registro,
                logo_empresa,background_inicial,footer_empresa,background_movil,updated_at,created_at,dias_prueba,etapa) 
                  VALUES ('".$this->getTipo_documento()."','".$this->getDocumento()."','".$this->getNombre_empresa()."','".$this->getContacto()."','".$this->getTelefono()."',
                    '".$this->getEmail()."','".$this->getFecha_inicio()."','".$this->getFecha_corte()."','".$this->getDias_corte()."',
                    '".$this->getCantidad_usuarios()."','".$this->getPaquete()."','".$this->getCiudad()."','".$this->getDireccion()."',
                    '".$this->getEstado_registro()."','".$this->getLogo_empresa()."','".$this->getBackground_inicial()."','".$this->getFooter_empresa()."',
                    '".$this->getBackground_movil()."',NOW(),NOW(),'".$this->getDias_prueba()."','".$this->getEtapa()."')";
            
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

            $sql="UPDATE empresa SET tipo_documento='".$this->getTipo_documento()."',
                        documento='".$this->getDocumento()."',
                        nombre_empresa='".$this->getNombre_empresa()."',
                        contacto='".$this->getContacto()."',
                        telefono='".$this->getTelefono()."',
                        email='".$this->getEmail()."',
                        fecha_inicio='".$this->getFecha_inicio()."',
                        fecha_corte='".$this->getFecha_corte()."',
                        dias_corte='".$this->getDias_corte()."',
                        cantidad_usuarios='".$this->getCantidad_usuarios()."',
                        paquete='".$this->getPaquete()."',
                        ciudad='".$this->getCiudad()."',
                        direccion='".$this->getDireccion()."',
                        logo_empresa='".$this->getLogo_empresa()."',
                        background_inicial='".$this->getBackground_inicial()."',
                        footer_empresa='".$this->getFooter_empresa()."',
                        background_movil='".$this->getBackground_movil()."',
                        dias_prueba='".$this->getDias_prueba()."',
                        etapa='".$this->getEtapa()."',
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