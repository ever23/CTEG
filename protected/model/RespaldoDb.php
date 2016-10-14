<?php

/**
 * CREA Y RECUPERA RESPALDOS DE LA BASE DE DATOS
 * @package CTEG
 * @subpackage MODEL
 */

namespace Cc\Mvc;

use Cc\Inyectable;
use \ZipArchive;

class RespaldoDb implements Inyectable
{

    /**
     * referencia a la base de datos
     * @var MySQLi 
     */
    protected $db;

    /**
     * DIRECCION DONDE SE ALMACENAN LOS ARCHIVOS PDF
     * @var string 
     */
    protected $data;

    /**
     * DIRECCION TEMPORAL
     * @var string
     */
    protected $tmp = '';

    /**
     * sera llamado cuando sea inyectado el objeto
     * @return array
     */
    public static function CtorParam()
    {
        return ['{DB}'];
    }

    /**
     * 
     * @param MySQLi $db
     */
    public function __construct(MySQLi &$db)
    {
        $this->db = $db;
        $this->data = realpath('protected/data');
        $this->tmp = realpath('protected/tmp');
    }

    /**
     * CREA UN ARCHIVO ZIP CON EL RESPALDO DE LA BASE DE DATOS 
     * @return string nombre del archivo temporal donde se almaceno el zip
     */
    public function CreateZip()
    {
        $db = $this->db->ExportDBGzip(__MYSQL_HOME_);
        $zip = new ZipArchive();
        $zip->open($this->tmp . '/DB.zip', ZIPARCHIVE::CREATE);


        $zip->addFromString('DbTeg.teg', $db);
        $dir = dir($this->data);
        while ($file = $dir->read())
        {
            if ($file != '.' && $file != '..')
            {
                $zip->addFromString('data/' . $file, file_get_contents($this->data . '/' . $file));
            }
            // $zip->addFile("data/".$row['codi_teg'].".pdf", $data.$row['codi_teg'].".pdf");
        }
        $zip->close();


        return $this->tmp . '/DB.zip';
    }

    /**
     * CARGA UN RESPALDO DESDE UN ARCHIVO ZIP RECIVIDO MEDIANTE POST
     * @param PostFiles $resp
     * @return boolean
     */
    public function LoadZip(PostFiles &$resp)
    {
        $zip = new ZipArchive();
        $zip->open($resp['tmp_name']);

        if ($this->db->ImportDB(gzdecode($zip->getFromName("DbTeg.teg"))))
        {
            $this->UnlinkData();
            for ($i = 0; $i < $zip->numFiles; $i++)
            {
                $name = $zip->getNameIndex($i);
                $na = explode('/', $name);
                if ($na[0] == 'data')
                {
                    $f = fopen($this->data . '/' . $na[1], 'w+');
                    fwrite($f, $zip->getFromIndex($i));
                    fclose($f);
                }
            }
            $zip->close();
            return true;
        } else
        {
            return $this->db->error();
        }
    }

    /**
     * ELIMIA EL CONTENIDO DE EL DIRECORIO {@see data} 
     */
    private function UnlinkData()
    {
        $dir = dir($this->data);
        while ($file = $dir->read())
        {
            if ($file != '.' && $file != '..')
            {
                unlink($this->data . DIRECTORY_SEPARATOR . $file);
            }
        }
        $dir->close();
    }

}
