<?php

require_once "user.php";
require_once "RestC.php";

class Rest extends RestC{
	function handle_post($urlpart,$data){
		$response["status"] = "error";
		$response["desc"] = "URI is not available in method POST";
		
		echo json_encode($response);
	}
	
	function handle_put($urlpart,$data){
		$response["status"] = "error";
		$response["desc"] = "URI is not available in method PUT";
		
		echo json_encode($response);
	}
	
	function handle_get($urlpart,$data){
		$response["status"] = "error";
		$response["desc"] = "URI is not available in method GET";
		if ($urlpart[0]=="login"){
			$response = login($data["username"],$data["password"]);
		}
		
		if ($urlpart[0]=="getprofile"){
			$response = getprofile($data["username"]);
		}
		echo json_encode($response);
	}
	
	function handle_delete($urlpart,$data){
		$response["status"] = "error";
		$response["desc"] = "URI is not available in method DELETE";
		echo json_encode($response);
	}
	function handle_default($urlpart,$data,$method){
		$response["status"] = "error";
		$response["desc"] = "METHOD '$method' is not available";
		echo json_encode($response);
	}
}

$handler = new Rest();
$handler->handle();

?>