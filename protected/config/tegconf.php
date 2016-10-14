<?php

/**
 * CONFIGURACION PARA CcMvc 
 * @package CTEG
 * @subpackage CONFIGURACION
 * @uses TegHtml SE DECLARA  COMO CLASE MANEJADORA DE RESPUESTA DE PETICIONES 'text/html'
 * @uses AutenticaTeg  SE DECLARA COMO CLASE AUTENTICADORA
 * @uses UNEFA_DB SE DECLARA COMO CLASE MANEJADORA DE BASES DE DATOS 
 * 
 */

namespace Cc\Mvc;

return
        [
            /**
             * indica si el sistema esta en modo depuracion 
             * para activar el modo depuracion solo hay que eliminar la siguente linea 
             */
            //'debung' => false,
            'Cache' => ['debung' => true],
            'App' => ['app' => dirname(__FILE__) . '/../'],
            'AutoloadLibs' =>
            [
                'UseStandarAutoloader' => true
            /* 'UseStandarAutoloader' => [
              'PHPoffice/Common-develop/src/',
              'PHPoffice/PHPWord-develop/src/',
              'PHPoffice/zend-escaper-master/src',
              'PHPoffice/zend-stdlib-master/src',
              'PHPoffice/zend-validator-master/src',
              ], 'NamespacesForDir' => [
              // '\\PhpOffice\\PhpWord' => '/PHPoffice/Common-develop/src/PhpWord/'
              //'namespace'=>'path' o 'namespace'=>['path1','path2']
              ], */
            ],
            /**
             * AGREGANDO LA CLASE TegHtml COMO CLASE MANEJADORA DE RESPUESTA DE PETICIONES 'text/html'
             */
            'Response' =>
            [
                'Accept' =>
                [
                    'text/html' =>
                    [
                        /**
                         * @see TegHtml
                         */
                        'class' => 'Cc\\Mvc\\TegHtml',
                        'param' =>
                        [
                            true,
                            false
                        ],
                        /**
                         * @uses main.php LAYAUT POR DEFECTO PARA LA SALIDA HTML
                         */
                        'layaut' => 'main'
                    ],
                ]
            ],
            /**
             * ESTABLECIENDO LA CLASE AutenticaTeg COMO CLASE AUTENTICADORA
             * @see AutenticaTeg
             */
            'Autenticate' =>
            [
                'class' => 'Cc\\Mvc\\AutenticaTeg',
                'param' =>
                [
                    ['login::*', 'install::*', 'ayuda::*'], // CONTROLADORES QUE NO SERAN AFECTADOS POR LA AUTENTICACION
                    ['user', 'pass', 'permisos']// INDICES DE  _SESSION QUE SE EVALUARAN EN AL AUTENTICACION
                ],
                'SessionName' => 'TEG_UNEFA', //NOMBRE DE LA SESSION
                /**
                 * PARAMETRO DE LAS COOKIES DE SESSION
                 */
                'SessionCookie' =>
                [
                    'path' => NULL,
                    'cahe' => 'nocache,private',
                    'time' => 21600,
                    'dominio' => NULL,
                    'httponly' => true,
                    'ReadAndClose' => true
                ],
            ],
            /**
             * ESTABLECION EL TIEMPO DE EXPIRACION DEL CACHE DEL NAVEGADOR
             */
            'Router' =>
            [
                'GetControllerFormat' => Router::Get,
                'protocol' => __PROTOCOLO__,
            ],
            /**
             * ESTABLECIENDO UNEFA_DB COMO CLASE MANEJADORA DE BASES DE DATOS
             * @see UNEFA_DB
             */
            'DB' =>
            [
                'class' => 'Cc\\Mvc\\UNEFA_DB',
                'param' =>
                [
                    defined('HOST') ? HOST : '',
                    defined('USER') ? USER : '',
                    defined('PASS') ? PASS : '',
                    defined('DB') ? DB : ''
                ]
            ]
];


