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
$Rotas->onGroup("api-usuario","POST","update/{p}","update");


// -- Rotas sem grupo
$Rotas->on("GET","login","Principal::login");
$Rotas->on("GET","sair","Principal::sair");

// -- Rotas dashboard
$Rotas->on("GET","","Principal::dashboard");

// -- Rotas usuarios
$Rotas->on("GET","usuarios","Principal::usuarios");
$Rotas->on("GET","usuario/adicionar","Principal::usuarioAdicionar");
$Rotas->on("GET","usuario/editar/{p}","Principal::usuarioEditar");

// -- Rotas funcionarios
$Rotas->on("GET","funcionarios","Principal::funcionarios");

// -- Rotas empresas
$Rotas->on("GET","empresas","Principal::empresas");

// -- Rotas equipamentos
$Rotas->on("GET","equipamentos","Principal::equipamentos");

// -- Rotas projetos
$Rotas->on("GET","projetos","Principal::projetos");

