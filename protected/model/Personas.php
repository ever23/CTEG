<?php
/**
 * DEFINE LA FUNCION GENERAL PARA CREAR LA LISTA DE JURADOS,TUTORES Y AUTORES
 * @package CTEG
 * @subpackage MODEL
 */
namespace Cc\Mvc;

trait Personas
{
    /**
     * crea una tabla para fpdf 
     * @param DBtabla|array $persona
     * @param string $t
     * @return TablePdfIterator
     */
    protected  function &GetTablePdf($persona,$t)
    {
        
        $tabla = new \TablePdfIterator(5, [90, 90, 90], 'arial', 10);

        $tabla->AddCollHead('ci', 'CI:', 20);
        $tabla->AddCollHead('n', 'NOMBRES', 45);
        $tabla->AddCollHead('a', 'APELLIDOS', 45);
        $tabla->AddCollHead('e', 'EMAIL', 40);
        $tabla->AddCollHead('t', 'TELEFONO', 40);
        $fil = true;
        if(is_array($persona) || $persona instanceof DBtabla)
        foreach($persona as $campo)
        {
            $tabla->AddRow(5, 'arial', 10, $fil = !$fil, [185, 185, 185]);
            $tabla->AddCell('ci', $campo['ci_' . $t]);
            $tabla->AddCell('n', $campo['nom1_' . $t] . ' ' . $campo['nom2_' . $t]);
            $tabla->AddCell('a', $campo['ape1_' . $t] . ' ' . $campo['ape2_' . $t]);
            $tabla->AddCell('e', $campo['emai_' . $t]);
            $tabla->AddCell('t', $campo['telf_' . $t]);
        }
        return $tabla;
    }

}
