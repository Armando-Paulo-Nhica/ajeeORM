<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
<meta charset="UTF-8">
<title></title>
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
var_dump($retorno);
}
//==Buscar por id, devolve um registo
//$retorno = $orm->findById("pai","id",54);
//var_dump($retorno);

//==Buscar todos registos da tabela, devolve um array
$retorno = $orm->findAll("pai");
var_dump($retorno);

//==Buscar por consulta personalizada, 
//devolve o (s) registo (s) conforme a consulta
//$retorno = $orm->findByCostumiseQuery("SELECT *FROM pai WHERE id=31");
//var_dump($retorno);

//===Metodo apagar por id, devolve um boolean
//$retorno = $orm->delete("pai","id",33);
//var_dump($retorno);

//===Metodo actualizar, devolve um boolean
//$retorno = $orm->update("pai","id",31,
//["nome"=> "Abner",
//"email"=> "antonionhica@gmail.com",
//"telefone"=> "879305719"]);
//var_dump($retorno);
?>
<form action="#" method="POST">
<input name="nome"> 
<input name="email">
<input name="telefone">
<button type="submit" name="salva">Salvar</button>
</form>
</body>
</html>
