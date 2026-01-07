<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
<meta charset="UTF-8">
<title>Teste ajeeORM</title>
</head>
<body>
<?php
require_once './ajeeSDK.php';
$orm = new ajeeSDK("20260501130637");

//===Metodo create, devolve um boolean
if(isset($_POST["salva"])){
    $retorno = $orm->create("pai",
    ["nome"=> $_POST["nome"],
    "email"=> $_POST["email"],
    "telefone"=> $_POST["telefone"]]);  
    //==Mostrar o retorno
    echo "<h3>Resultado CREATE:</h3>";
    var_dump($retorno);
}

//==Buscar todos registos da tabela, devolve um array
if(isset($_GET["teste"]) && $_GET["teste"]=="findAll" || !isset($_GET["teste"])){
    echo "<h3>Resultado FIND ALL:</h3>";
    $retorno = $orm->findAll("pai");
    var_dump($retorno);
}

//==Buscar por id, devolve um registo
if(isset($_GET["teste"]) && $_GET["teste"]=="findById"){
    $id = isset($_GET["id"]) ? $_GET["id"] : 1;
    echo "<h3>Resultado FIND BY ID (ID: {$id}):</h3>";
    $retorno = $orm->findById("pai","id",$id);
    var_dump($retorno);
}

//==Buscar por consulta personalizada, 
//devolve o (s) registo (s) conforme a consulta
if(isset($_GET["teste"]) && $_GET["teste"]=="findByQuery"){
    $query = isset($_GET["query"]) ? $_GET["query"] : "SELECT * FROM pai WHERE id=1";
    echo "<h3>Resultado FIND BY CUSTOM QUERY:</h3>";
    echo "<p>Query: {$query}</p>";
    $retorno = $orm->findByCostumiseQuery($query);
    var_dump($retorno);
}

//===Metodo actualizar, devolve um boolean
if(isset($_POST["atualizar"])){
    $id = isset($_POST["id_update"]) ? $_POST["id_update"] : 1;
    echo "<h3>Resultado UPDATE (ID: {$id}):</h3>";
    $retorno = $orm->update("pai","id",$id,
    ["nome"=> $_POST["nome_update"],
    "email"=> $_POST["email_update"],
    "telefone"=> $_POST["telefone_update"]]);
    var_dump($retorno);
}

//===Metodo apagar por id, devolve um boolean
if(isset($_POST["deletar"])){
    $id = isset($_POST["id_delete"]) ? $_POST["id_delete"] : 1;
    echo "<h3>Resultado DELETE (ID: {$id}):</h3>";
    $retorno = $orm->delete("pai","id",$id);
    var_dump($retorno);
}
?>

<hr>
<h2>CREATE - Criar Registro</h2>
<form action="#" method="POST">
    <input name="nome" placeholder="Nome"> 
    <input name="email" placeholder="Email">
    <input name="telefone" placeholder="Telefone">
    <button type="submit" name="salva">Salvar</button>
</form>

<hr>
<h2>Buscar Todos</h2>
<a href="?teste=findAll">Buscar Todos os Registros</a>

<hr>
<h2>Buscar por ID</h2>
<form method="GET">
    <input type="hidden" name="teste" value="findById">
    <input name="id" type="number" placeholder="ID" value="1">
    <button type="submit">Buscar por ID</button>
</form>

<hr>
<h2>Consulta Personalizada</h2>
<form method="GET">
    <input type="hidden" name="teste" value="findByQuery">
    <input name="query" type="text" placeholder="SELECT * FROM pai WHERE id=1" 
           style="width:400px;" value="SELECT * FROM pai WHERE id=1">
    <button type="submit">Executar Query</button>
</form>

<hr>
<h2>Update</h2>
<form method="POST">
    <input name="id_update" type="number" placeholder="ID">
    <input name="nome_update" placeholder="Nome" >
    <input name="email_update" placeholder="Email">
    <input name="telefone_update" placeholder="Telefone">
    <button type="submit" name="atualizar">Atualizar</button>
</form>

<hr>
<h2>DELETE</h2>
<form method="POST" onsubmit="return confirm('Tem certeza que deseja deletar?');">
    <input name="id_delete" type="number" placeholder="ID" value="1">
    <button type="submit" name="deletar">Deletar</button>
</form>
</body>
</html>
