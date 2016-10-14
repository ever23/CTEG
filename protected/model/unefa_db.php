<?php

/**
 * ADMINISTRADOR DE BASES DE DATOS EXTENDIDO DE MySQLi FUNCIONALIDAD INTERNA DE CcMvc
 * @package CTEG
 * @subpackage DataBase
 */

namespace Cc\Mvc;

class UNEFA_DB extends MySQLi
{

    /**
     * TABLAS QUE DEVE CONTENER LA BASE DE DATOS
     * @var array 
     */
    private $tables = array('autores', 'carrera', 'jurados', 'menciones', 'teg_autor', 'teg_jurado', 'trabajo_eg', 'tutores', 'users', 'vteg', 'vtutor', 'vautor', 'vjurado', 'vtegall');

    /**
     * VERIFICA QUE LA BASE DE DATOS TENGA TODAS LAS TABLAS 
     * @return boolean
     */
    public function VerificaTables()
    {
        $this->consulta("SHOW TABLES");
        $r = 1;
        $tables = array();
        while ($t = $this->result())
        {
            array_push($tables, $t['Tables_in_' . $this->db]);
        }
        $t = '';
        /* echo "<pre>";
          print_r($tables);
          print_r($this->tables); */
        foreach ($this->tables as $t)
        {
            $r = in_array($t, $tables) * $r;
            //var_dump(in_array($t,$tables)); echo $t;
        }
        return $r;
    }

    /**
     * INSERTA UNA CARRERA 
     * @param string $carrea
     * @return boolean TRUE SI TUVO EXITO DE LO CONTRARIO FALSE
     */
    public function InsertarCarrera($carrea)
    {

        $this->Tab('carrera')->Insert(NULL, strtoupper($carrea));
        if ($this->error())
        {
            return false;
        }
        return true;
    }

    /**
     * INSERTA UNA MENCION 
     * @param string $Mencion
     * @return boolean TRUE SI TUVO EXITO DE LO CONTRARIO FALSE
     */
    public function InsertarMencion($Mencion)
    {
        $meciones = $this->Tab('menciones');
        $meciones->Insert(['desc_menc' => strtoupper($Mencion)]);
        if ($meciones->error())
        {
            return false;
        }
        return true;
    }

    /**
     * INSERTA UN  TUTOR 
     * @param array $HTTP_VAR DEVE CONTENER LOS MISMOS INDICES QUE LA TABLA TUTORES DE LA BASE DE DATOS
     * @return boolean
     */
    public function InsertarTutor(array $HTTP_VAR)
    {
        $T = $this->Tab('tutores');
        $tutores = $T->NewRow();
        $tutores->nom1_tutor = ucfirst($HTTP_VAR['nom1_tutor']);
        $tutores->nom2_tutor = ucfirst($HTTP_VAR['nom2_tutor']);
        $tutores->ape1_tutor = ucfirst($HTTP_VAR['ape1_tutor']);
        $tutores->ape2_tutor = ucfirst($HTTP_VAR['ape2_tutor']);
        $tutores->emai_tutor = strtolower($HTTP_VAR['emai_tutor']);
        $tutores->telf_tutor = $HTTP_VAR['telf_tutor'];
        $tutores->telf_tutor = $HTTP_VAR['telf_tutor'];
        $tutores->ci_tutor = $HTTP_VAR['ci_tutor'];
        $T->Insert($tutores);
        if ($T->error())
        {
            if ($T->errno == $this->_ERRNO['DUPLICATE_KEY'])
            {
                $e = new CcException("EL TUTOR YA EXISTE EN LA BASE DE DATOS");
            }
            return false;
        } else
        {
            return true;
        }
    }

    /**
     * EDITA UN  TUTOR 
     * @param array $HTTP_VAR DEVE CONTENER LOS MISMOS INDICES QUE LA TABLA TUTORES DE LA BASE DE DATOS
     * @return boolean
     */
    public function EditarTutor(array $HTTP_VAR)
    {
        $tutores = $this->Tab('tutores')->NewRow();
        $tutores->nom1_tutor = ucfirst($HTTP_VAR['nom1_tutor']);
        $tutores->nom2_tutor = ucfirst($HTTP_VAR['nom2_tutor']);
        $tutores->ape1_tutor = ucfirst($HTTP_VAR['ape1_tutor']);
        $tutores->ape2_tutor = ucfirst($HTTP_VAR['ape2_tutor']);
        $tutores->emai_tutor = strtolower($HTTP_VAR['emai_tutor']);
        $tutores->telf_tutor = $HTTP_VAR['telf_tutor'];
        $tutores->telf_tutor = $HTTP_VAR['telf_tutor'];
        $tutores->ci_tutor = $HTTP_VAR['ci_tutor'];
        $tutores->Update();
        if ($tutores->error())
        {

            return false;
        } else
        {
            return true;
        }
    }

    /**
     * INSERTA UN  JURADO 
     * @param array $HTTP_VAR DEVE CONTENER LOS MISMOS INDICES QUE LA TABLA JURADOS DE LA BASE DE DATOS
     * @return boolean
     */
    public function InsertarJurado(array $HTTP_VAR)
    {

        $jurado = $this->Tab('jurados')->NewRow();
        $jurado->nom1_jurado = ucfirst($HTTP_VAR['nom1_jurado']);
        $jurado->nom2_jurado = ucfirst($HTTP_VAR['nom2_jurado']);
        $jurado->ape1_jurado = ucfirst($HTTP_VAR['ape1_jurado']);
        $jurado->ape2_jurado = ucfirst($HTTP_VAR['ape2_jurado']);
        $jurado->emai_jurado = strtolower($HTTP_VAR['emai_jurado']);
        $jurado->telf_jurado = $HTTP_VAR['telf_jurado'];
        $jurado->ci_jurado = $HTTP_VAR['ci_jurado'];
        $jurado->Insert();

        if ($jurado->error())
        {
            if ($jurado->errno() == $this->_ERRNO['DUPLICATE_KEY'])
            {
                $e = new CcException("EL JURADO YA EXISTE EN LA BASE DE DATOS");
            }
            return false;
        } else
        {
            return true;
        }
    }

    /**
     * EDITA UN  JURADO 
     * @param array $HTTP_VAR DEVE CONTENER LOS MISMOS INDICES QUE LA TABLA JURADOS DE LA BASE DE DATOS
     * @return boolean
     */
    public function EditarJurado(array $HTTP_VAR)
    {
        $jurado = $this->Tab('jurados')->NewRow();
        $jurado->nom1_jurado = ucfirst($HTTP_VAR['nom1_jurado']);
        $jurado->nom2_jurado = ucfirst($HTTP_VAR['nom2_jurado']);
        $jurado->ape1_jurado = ucfirst($HTTP_VAR['ape1_jurado']);
        $jurado->ape2_jurado = ucfirst($HTTP_VAR['ape2_jurado']);
        $jurado->emai_jurado = strtolower($HTTP_VAR['emai_jurado']);
        $jurado->telf_jurado = $HTTP_VAR['telf_jurado'];
        $jurado->ci_jurado = $HTTP_VAR['ci_jurado'];
        $jurado->Update();

        if ($jurado->error())
        {
            return false;
        } else
        {
            return true;
        }
    }

    /**
     * INSERTA UN  AUTOR 
     * @param array $HTTP_VAR DEVE CONTENER LOS MISMOS INDICES QUE LA TABLA AUTOR DE LA BASE DE DATOS
     * @return boolean
     */
    public function InsertarAutor(array $HTTP_VAR)
    {
        $autores = $this->Tab('autores');
        $autor = $this->Tab('autores')->NewRow();
        $autor->nom1_autor = ucfirst($HTTP_VAR['nom1_autor']);
        $autor->nom2_autor = ucfirst($HTTP_VAR['nom2_autor']);
        $autor->ape1_autor = ucfirst($HTTP_VAR['ape1_autor']);
        $autor->ape2_autor = ucfirst($HTTP_VAR['ape2_autor']);
        $autor->emai_autor = strtolower($HTTP_VAR['emai_autor']);
        $autor->telf_autor = $HTTP_VAR['telf_autor'];
        $autor->ci_autor = $HTTP_VAR['ci_autor'];
        $autores->Insert($autor);

        if ($autores->error())
        {
            if ($autores->errno == $this->_ERRNO['DUPLICATE_KEY'])
            {
                $e = new CcException("EL AUTOR YA EXISTE EN LA BASE DE DATOS");
            }
            return false;
        } else
        {
            return true;
        }
    }

    /**
     * EDITA UN  AUTOR 
     * @param array $HTTP_VAR DEVE CONTENER LOS MISMOS INDICES QUE LA TABLA AUTOR DE LA BASE DE DATOS
     * @return boolean
     */
    public function EditarAutor(array $HTTP_VAR)
    {
        $autores = $this->Tab('autores');
        $autor = $autores->NewRow();
        $autor->nom1_autor = ucfirst($HTTP_VAR['nom1_autor']);
        $autor->nom2_autor = ucfirst($HTTP_VAR['nom2_autor']);
        $autor->ape1_autor = ucfirst($HTTP_VAR['ape1_autor']);
        $autor->ape2_autor = ucfirst($HTTP_VAR['ape2_autor']);
        $autor->emai_autor = strtolower($HTTP_VAR['emai_autor']);
        $autor->telf_autor = $HTTP_VAR['telf_autor'];
        $autor->ci_autor = $HTTP_VAR['ci_autor'];
        $autor->Update();

        if ($autor->error())
        {
            return false;
        } else
        {
            return true;
        }
    }

    /**
     * INSERTA UN TRABAJO ESPECIAL DE GRADO
     * @param array $HTTP_VAR DEVE CONTENER LOS MISMOS INDICES QUE LA TABLA AUTOR DE LA BASE DE DATOS ADEMAS DEVE CONTENER LOS INDICES ci_autor,ci_jurado,ci_tutor QUE DEVEN SER ARRAY CON LOS INDICES DE SUS RESPECTIVAS TABLAS
     * @return boolean
     */
    public function InsertarTeg(array $HTTP_VAR)
    {
        $this->autocommit(false);

        foreach ($HTTP_VAR['ci_autor'] as $i => $ci_tutor)
        {
            $autor = array(
                'ci_autor' => $ci_tutor,
                'nom1_autor' => $HTTP_VAR['nom1_autor'][$i],
                'nom2_autor' => $HTTP_VAR['nom2_autor'][$i],
                'ape1_autor' => $HTTP_VAR['ape1_autor'][$i],
                'ape2_autor' => $HTTP_VAR['ape2_autor'][$i],
                'emai_autor' => $HTTP_VAR['emai_autor'][$i],
                'telf_autor' => $HTTP_VAR['telf_autor'][$i],
            );
            //$this->consulta("SELECT * FROM autores where ci_autor='".$ci_tutor."'");
            $autores = $this->Tab('autores');
            $autores->Select("ci_autor='" . $ci_tutor . "'");
            if ($autores->num_rows == 0)
            {
                if (!$this->InsertarAutor($autor))
                {
                    $e = new CcException("ERROR AL INSERTAR UN AUTOR");
                    break;
                }
            } else
            {
                if (!$this->EditarAutor($autor))
                {
                    $e = new CcException("ERROR AL EDITAR UN AUTOR");
                    break;
                }
            }
        }
        $tutores = ['ci_tutor' => $HTTP_VAR['ci_tutor'][0],
            'nom1_tutor' => $HTTP_VAR['nom1_tutor'][0],
            'nom2_tutor' => $HTTP_VAR['nom2_tutor'][0],
            'ape1_tutor' => $HTTP_VAR['ape1_tutor'][0],
            'ape2_tutor' => $HTTP_VAR['ape2_tutor'][0],
            'emai_tutor' => $HTTP_VAR['emai_tutor'][0],
            'telf_tutor' => $HTTP_VAR['telf_tutor'][0],
        ];
        $tutor = $this->Tab('tutores');
        $tutor->Select("ci_tutor='" . $HTTP_VAR['ci_tutor'][0] . "'");
        //$this->consulta("SELECT * FROM tutores where ci_tutor='".$HTTP_VAR['ci_tutor'][0]."'");
        if ($tutor->num_rows == 0)
        {
            if (!$this->InsertarTutor($tutores))
            {
                $e = new CcException("ERROR AL INSERTAR UN TUTOR");
                return false;
            }
        } else
        {
            if (!$this->EditarTutor($tutores))
            {
                $e = new CcException("ERROR AL EDITAR UN TUTOR");
                return false;
            }
        }
        foreach ($HTTP_VAR['ci_jurado'] as $i => $ci_jurado)
        {
            $jurados = array(
                'ci_jurado' => $ci_jurado,
                'nom1_jurado' => $HTTP_VAR['nom1_jurado'][$i],
                'nom2_jurado' => $HTTP_VAR['nom2_jurado'][$i],
                'ape1_jurado' => $HTTP_VAR['ape1_jurado'][$i],
                'ape2_jurado' => $HTTP_VAR['ape2_jurado'][$i],
                'emai_jurado' => $HTTP_VAR['emai_jurado'][$i],
                'telf_jurado' => $HTTP_VAR['telf_jurado'][$i],
            );
            $jurado = $this->Tab('jurados');
            $jurado->Select("ci_jurado='" . $ci_jurado . "'");
            //$this->consulta("SELECT * FROM jurados where ci_jurado='".$ci_jurado."'");
            if ($jurado->num_rows == 0)
            {
                if (!$this->InsertarJurado($jurados))
                {
                    $e = new CcException("ERROR AL INSERTAR UN JURADO");
                    break;
                }
            } else
            {
                if (!$this->EditarJurado($jurados))
                {
                    $e = new CcException("ERROR AL EDITAR UN JURADO");
                    break;
                }
            }
        }
        $Trabajo_eg = $this->Tab('trabajo_eg');
        $teg = $Trabajo_eg->NewRow();
        $teg->titulo_teg = strtoupper($HTTP_VAR['titulo_teg']);
        $teg->obse_teg = $HTTP_VAR['obse_teg'];
        $teg->codi_carr = $HTTP_VAR['codi_carr'];
        $teg->ci_tutor = $tutores['ci_tutor'];
        $teg->codi_menc = $HTTP_VAR['codi_menc'];
        $teg->peri_acad = $HTTP_VAR['peri_acad'];
        $Trabajo_eg->Insert($teg);
        $codi_teg = $Trabajo_eg->AutoIncrement();

        //$codi_teg=$this->GetAutoIncremet('trabajo_eg','codi_teg');
        foreach ($HTTP_VAR['ci_autor'] as $ci_autor)
        {
            //if(!$this->consulta("INSERT INTO `teg_autor` VALUES ('".$codi_teg."', '".$ci_autor."')"))
            if (!$this->Tab('teg_autor')->Insert([$codi_teg, $ci_autor]))
            {

                break;
            }
        }
        foreach ($HTTP_VAR['ci_jurado'] as $ci_jurado)
        {
            //	if(!$this->consulta("INSERT INTO `teg_jurado` VALUES ('".$codi_teg."', '". $ci_jurado."')"))
            if (!$this->Tab('teg_jurado')->Insert([$codi_teg, $ci_jurado]))
            {
                break;
            }
        }


        if ($this->error())
        {
            $this->rollback();
            return false;
        } else
        {
            $this->autocommit(true);
            return $codi_teg;
        }
    }

    /**
     * EDITA UN TRABAJO ESPECIAL DE GRADO
     * @param Request $HTTP_VAR DEVE CONTENER LOS MISMOS INDICES QUE LA TABLA AUTOR DE LA BASE DE DATOS 
     * @return boolean
     */
    public function EditarTeg(Request &$HTTP_VAR)
    {

        $this->autocommit(false);
        $this->begin_transaction();
        $teg = $this->Tab('trabajo_eg')->NewRow();
        $teg->titulo_teg = strtoupper($HTTP_VAR['titulo_teg']);
        $teg->obse_teg = $HTTP_VAR['obse_teg'];
        $teg->codi_carr = $HTTP_VAR['codi_carr'];
        $teg->ci_tutor = $HTTP_VAR['ci_tutor'];
        $teg->codi_menc = $HTTP_VAR['codi_menc'];
        $teg->peri_acad = $HTTP_VAR['peri_acad'];
        $teg->codi_teg = $HTTP_VAR['codi_teg'];
        $teg->Update();
        $error = $teg->errno();
        $this->Tab('teg_jurado')->Delete(['codi_teg' => $HTTP_VAR['codi_teg']]);
        foreach ($HTTP_VAR['ci_jurado'] as $ci_jurado)
        {
            $this->Tab('teg_jurado')->Insert($HTTP_VAR['codi_teg'], $ci_jurado);
            $error += $teg->errno();
        }
        $this->Tab('teg_autor')->Delete(['codi_teg' => $HTTP_VAR['codi_teg']]);
        foreach ($HTTP_VAR['ci_autor'] as $ci_autor)
        {
            $this->Tab('teg_autor')->Insert($HTTP_VAR['codi_teg'], $ci_autor);
            $error += $teg->errno();
        }

        if ($error)
        {

            $this->rollback();
            $e = new CcException("OCURRIO UN ERROR AL MODIFICAR EL TRABAJO ESPECIAL DE GRADO");
            RETURN FALSE;
        } else
        {
            $this->commit();
            return true;
        }
    }

    /**
     * @deprecated 
     * @return int
     * @ignore
     */
    public function ExportDbTeg()
    {
        if ($this->connect_error)
        {
            return 0;
        }
        $exp = $this->ExportDBGzip();
        if (!is_null($exp))
        {
            $time = new DateTimeEx();

            $name = "respaldo_F_" . $time->format('Y-m-d') . '_H_' . $time->format('H:i:s') . '.teg';
            header('Content-type: text/x-teg');
            header('Content-Disposition: attachment; filename="' . $name . '"');
            echo $exp;
            exit;
        }
    }

}
