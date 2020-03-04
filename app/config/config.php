<?php

// URL base do site.
defined('BASE_URL') OR define('BASE_URL', 'http://localhost/git/manada-checklist/');

// URL base do storage
defined('BASE_STORANGE') OR define('BASE_STORAGE', 'http://localhost/git/manada-checklist/storage');

// Session | Caso deseje que a session seja iniciada em todas as páginas
// Apenas mude a constante para true.
defined("OPEN_SESSION") OR define('OPEN_SESSION', true);


$pluginsAutoLoad = [
    "sweetalert" => [
        "js" => ["sweetalert2.all"],
        "css" => null,
    ],
    "owl-carousel" => [
        "js" => ["owl.carousel.min"],
        "css" => ["owl.carousel.min"]
    ],
    "mascara" => [
        "js" => ["mascara"],
        "css" => null,
    ],
    "dropify" => [
        "js" => ["js/dropify.min"],
        "css" => ["css/dropify.min"],
    ]
];

// Salva como constant
defined("PLGUINS_AUTOLOAD") OR define("PLGUINS_AUTOLOAD", serialize($pluginsAutoLoad));