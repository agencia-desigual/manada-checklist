<?php

// Erro 404
$Rotas->onError("404", function (){
   echo "Erro - 404";
});

// -- Seta os grupos
//$Rotas->group("Principal","api","Principal");

// -- Rotas de Grupos
//$Rotas->onGroup("Principal","GET","a","index");

// -- Grupo Usuario
$Rotas->group("api-usuario","api/usuario","Api\Usuario");

$Rotas->onGroup("api-usuario","POST","insert","insert");
$Rotas->onGroup("api-usuario","POST","login","login");
$Rotas->onGroup("api-usuario","POST","delete/{p}","delete");
$Rotas->onGroup("api-usuario","PUT","update","update");


// -- Rotas sem grupo
$Rotas->on("GET","","Principal::index");
$Rotas->on("GET","login","Principal::login");
$Rotas->on("GET","sair","Principal::sair");

$Rotas->on("GET","usuarios","Principal::usuarios");

