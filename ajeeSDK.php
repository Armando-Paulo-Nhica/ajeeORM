<?php
require_once './ajeeAGENT.php';
$agent = new ajeeAGENT();
/**
 * Description of ajeeSDK
 *
 * @author ajee
 */
class ajeeSDK{ 
private $url_web = "http://api.ajee.me/api_orm/";
private $api_key=NULL;
public function __construct($api_key){
$this->api_key=$api_key;
}
//$tabela= nome da tabela da DB,
//$json = colunas da DB que pretende preencher e seus respectivos valores 
//por ex do json: ["nome"=> "Ivan Horacio","email"=> "ajee@ajee.me"] 
//Nota B: Se a chave primaria for autoincrement, nao precisa incluir no json 
//Retorna true caso tenha criado o registo e false se nao tiver exito
function create($tabela,$json){
global $agent;    
return $agent->executa($this->rmi(array(
"meta"=>array(
"request"=> "create",
"tabela"=> $tabela),
"params"=>$json        
)),
$json); 
}
//$tabela= nome da tabela da DB,
//$chave= id ou chave primaria da DB,
//$valor= o valor do ID
//Nota B: Retorna um registo
function findById($tabela,$chave,$valor){ 
global $agent;    
return $agent->executa($this->rmi(array(
"meta"=>array(
"request"=> "findById",
"tabela"=> $tabela),
"params"=>["chave"=> $chave]     
)),
["valor"=> $valor]);  
}
//$tabela= nome da tabela da DB,
//$chave= id ou chave primaria da DB,
//$valor= o valor do ID
//Nota B: Retorna todos registos
function findAll($tabela){
global $agent;    
return $agent->executa($this->rmi(array(
"meta"=>array(
"request"=> "findAll",
"tabela"=> $tabela),
"params"=>NULL     
)),
NULL);    
}
//$tabela= nome da tabela da DB,
//$chave= id ou chave primaria da DB,
//$valor= o valor do ID 
//Retorna true caso tenha removido o registo e false se nao tiver exito
public function delete($tabela,$chave,$valor){  
global $agent;    
return $agent->executa($this->rmi(array(
"meta"=>array(
"request"=> "delete",
"tabela"=> $tabela),
"params"=>["chave"=> $chave]     
)),
["valor"=> $valor]); 
}
//$tabela= nome da tabela da DB,
//$chave= id ou chave primaria da DB,
//$valor= o valor do ID 
//$json = colunas da DB que pretende actualizar e seus respectivos valores 
//por ex do json: ["nome"=> "Ivan Horacio","email"=> "ajee@ajee.me"] 
//Nota B: Retorna true caso tenha actualizado o registo e false se nao tiver exito
function update($tabela,$chave,$valor,$json){
global $agent;    
return $agent->executa($this->rmi(array(
"meta"=>array(
"request"=> "update",
"tabela"=> $tabela,
"chave"=> $chave,    
"valor"=> $valor),
"params"=>$json        
)),
$json); 
} 
//===Buscar por consulta do cliente
function findByCostumiseQuery($query){
global $agent;    
return $agent->executa($this->rmi(array(
"meta"=>array(
"request"=> "findByCostumiseQuery"),
"params"=>["query"=>$query]     
)),
NULL);    
}
private function rmi($fields){    
global $token;     
$context = stream_context_create([
'http' => [
'method'=> 'POST',
'header'=>
"Authorization: Bearer $this->api_key\r\n" .
"Content-Type: application/json\r\n" .
"Accept: application/json\r\n",
'content' => json_encode($fields) 
]
]);
$response = @file_get_contents(
$this->url_web,
false,
$context
); 
return ($response===false)?[
'status'=>'error',
'message'=>'Internet desligada ou servidor indisponivel'    
]:json_decode($response,true);
}
}
