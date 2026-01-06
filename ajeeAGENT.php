<?php
try{
$conn = new PDO("mysql:host=localhost;dbname=teste","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $error) {   
$conn = array('status'=>'sucess','data'=>"Nao foi possivel conectar a base de dados:".$error->getMessage());
}
/**
 * Description of ajeeAGENT
 *
 * @author ajee
 */
class ajeeAGENT{
function executa($rmi,$fields){    
global $conn;  
//===Autentication
if(array_key_exists("token",$rmi)){
return "Acesso negado, chave invalida ou expirada..!";    
}
else{
//===Verificar se o cliente esta conectado a internet
if(array_key_exists("status",$rmi)){
return $rmi['message'];   
}    
try{
$stmt = $conn->prepare($rmi["cmd"]);
$stmt->execute($fields);
return (
$rmi["request"]=="findById" 
|| $rmi["request"]=="findAll"
|| $rmi["request"]=="findByCostumiseQuery")?
$stmt->fetchAll(PDO::FETCH_ASSOC):TRUE;
}catch(PDOException $e){
error_log($e->getMessage());
return false;
}    
}
}
}