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

// -- Grupo Funcionarios
$Rotas->group("api-funcionario","api/funcionario","Api\Funcionario");
$Rotas->onGroup("api-funcionario","POST","insert","insert");
$Rotas->onGroup("api-funcionario","POST","delete/{p}","delete");
$Rotas->onGroup("api-funcionario","POST","update/{p}","update");

// -- Grupo Cliente
$Rotas->group("api-cliente","api/cliente","Api\Cliente");
$Rotas->onGroup("api-cliente","POST","insert","insert");
$Rotas->onGroup("api-cliente","POST","delete/{p}","delete");
$Rotas->onGroup("api-cliente","POST","update/{p}","update");

// -- Grupo Equipamento
$Rotas->group("api-equipamento","api/equipamento","Api\Equipamento");
$Rotas->onGroup("api-equipamento","POST","insert","insert");
$Rotas->onGroup("api-equipamento","POST","delete/{p}","delete");
$Rotas->onGroup("api-equipamento","POST","update/{p}","update");

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
$Rotas->on("GET","funcionario/adicionar","Principal::funcionarioAdicionar");
$Rotas->on("GET","funcionario/editar/{p}","Principal::funcionarioEditar");

// -- Rotas empresas
$Rotas->on("GET","empresas","Principal::empresas");
$Rotas->on("GET","empresa/adicionar","Principal::empresaAdicionar");
$Rotas->on("GET","empresa/editar/{p}","Principal::empresaEditar");

// -- Rotas equipamentos
$Rotas->on("GET","equipamentos","Principal::equipamentos");
$Rotas->on("GET","equipamento/adicionar","Principal::equipamentoAdicionar");
$Rotas->on("GET","equipamento/editar/{p}","Principal::equipamentoEditar");

// -- Rotas projetos
$Rotas->on("GET","projetos","Principal::projetos");