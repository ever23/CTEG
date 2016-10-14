<?php
/**
 * layaut login: este layaut no contara con la barra de menu 
 * @package CTEG
 * @subpackage LAYAUTS
 */
//var $this de la clase Html
////var $conten contenido html del documento
$this->addlink_js(["{src}jquery-1.8.2.min.js", "{src}jquery-ui.min.js", '{src}sysunefa.min.js'], 'U');
$this->addlink_css(['{src}sysunefa.min.css', '{src}jquery-ui.min.css'], 'U');
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset='utf-8' >
        <?php echo $this->GetContenHead() ?>
    </head>
    <body>
        <div id="wrap">
            <div id="main_container">
                <div class="center_content">
                    <div class="cargando"></div>
                    <header>
                        <div class="logo_fanb"></div>
                        <div class="logo_unefa"></div>
                        <br>
                        <h1 align="center" class="title">CONTROL DE T.E.G <BR>
                            UNEFA NUCLEO TRUJILLO</h1>
                    </header>
                    <div class="content"> <?php echo $content ?> </div>
                    <div class="clear"></div>
                </div>
                <div class="footer">
                    <div class="copyright"> </div>
                    <div class="footer_links"></div>
                </div>
            </div>
        </div>
        <div id='errores' class='errores'  title='<?php echo htmlentities("<H2>!! ERROR ¡¡</H2>") ?>' style='display:none;'>
            <div id='error_div'><?php echo $this->errores ?></div>
        </div>
    </body>
</html>
