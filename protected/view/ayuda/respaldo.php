<?PHP
/**
 * @package CTEG
 * @subpackage VIEW
 */
?>
<DIV STYLE="MARGIN: 20PX">
  <H1><P ALIGN="CENTER">RESPALDAR  LA BASE DE DATOS</P></H1>
  <P>EN CASO DE SER NECESARIO CAMBIAR  EL SISTEMA DE EQUIPO O DE SERVIDOR ESTE CUENTA CON SU PROPIO GESTOR DE  RESPALDOS ESTO SE PUEDE REALIZAR DIRIGIÉNDOSE AL MENÚ EN LA OPCIÓN  MANTENIMIENTO Y LA SUB OPCIÓN RESPALDO DEL LA BD </P>
  <P><IMG SRC="IMG/AYUDA/RESPALDO-1.JPG" WIDTH="507" HEIGHT="306"></P>
  <P>PARA GENERAR UN RESPALDO DEBES  PRESIONAR EL BOTÓN RESPALDAR UNA VEZ REALIZADO   ESTO SE EMPEZARA A DESCARGAR UNA ARCHIVO LLAMADO BDTEG.ZIP QUE CONTENDRÁ  LA INFORMACIÓN DE LA BASE DE DATOS </P>
  <H2>POSIBLES  PROBLEMAS</H2>
  <P>UNO DE LOS PROBLEMAS QUE PUEDEN  SURGIR ES QUE SE EMITA UN MENSAJE DE ERROR INDICANDO QUE NO SE REALIZÓ EL  RESPALDO ESTO SOLO OCURRE SI NO SE REALIZÓ LA CONFIGURACIÓN INICIAL  CORRECTAMENTE EN ESPECIAL EL CAMPO MYSQL DONDE TENÍAS QUE AGREGAR LA DIRECCIÓN  LOCAL DE LOS BINARIOS DEL MYSQL QUE SE ESTÉ UTILIZANDO ESTO SE PUEDE REPARAR  DIRIGIÉNDOSE AL DIRECTORIO DONDE SE INSTALÓ EN SISTEMA Y ABRIENDO EL ARCHIVO  PROTECTED/MYSQLUSER.PHP CON UN EDITOR DE TEXTO DONDE APARECERA UN CODIGO COMO ESTE <BR>
        <P> <?PHP      highlight_string("<?php define('__MYSQL_HOME_','C:\\\\xampp2\\\\mysql\\\\bin'); 
define('USER','bd_teg'); 
define('PASS','8W3rGfYzM2d62IpM');
define('HOST','localhost'); 
define('DB','bd_teg');
define('__PROTOCOLO__','http');")?></P><BR>LUEGO MODIFICAR LA CONSTANTE</P>
  <P>__MYSQL_HOME_</P>

SE DEBE MODIFICAR EL SEGUNDO CAMPO ENTRE LAS  COMILLAS SIMPLES ESTE DEBE SER LA DIRECCIÓN DONDE SE ENCUENTRA LOS BINARIOS DE  MYSQL SI USA SLACH INVERTIDOS POR FAVOR USE DOBLES SLACH
<P></P>
</DIV>