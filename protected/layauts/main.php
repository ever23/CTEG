<?php

namespace Cc\Mvc;

$Layaut = LayautManager::BeginConten('login');
?>
<div class="menu"  align="center">
    <ul>
        <a href="">
            <li> INICIO </li>
        </a>
        <li > T.E.G
            <ul>
                <a href="?page=teg">
                    <li class="menu_n1">CONSULTAR</li>
                </a> <a href="?page=teg::insertar">
                    <li class="menu_n1"> INSERTAR </li>
                </a>
            </ul>
        </li>
        <li>CONSULTAS
            <UL>
                <a href="?page=autor">
                    <li>LISTA DE AUTORES </li>
                </a> <a href="?page=tutor">
                    <li>LISTA DE TUTORES </li>
                </a> <a href="?page=jurado">
                    <li>LISTA DE JURADOS </li>
                </a>
            </UL>
        </li>
        <?php
        if (!empty($_SESSION['perm_user']) && $_SESSION['perm_user'] == 'admi')
        {
            ?>
            <li>MANTENIMIENTO
                <ul>
                    <a href="?page=mantenimiento::carrera">
                        <li>INSERTAR CARRERA</li>
                    </a> <a href="?page=mantenimiento::mencion">
                        <li>INSERTAR MENCION</li>
                    </a> <a href="?page=mantenimiento">
                        <li>RESPALDO DE LA BD</li>

                    </a> <a href="?page=mantenimiento::usuarios">
                        <li>REGISTRAR USUARIO</li>
                    </a>

                </ul>
            </li>
            <?php
        }
        ?>
        <a href="?page=ayuda">
            <li>AYUDA</li>
        </a> <a href="?page=login">
            <li>SALIR </li>
        </a>
    </ul>
</div>
<div class="content"><?php echo $content ?></div>
<?php
$Layaut->EndConten();
