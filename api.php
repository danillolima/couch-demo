<?php
require 'vendor/autoload.php'; 

	$request = htmlspecialchars($_GET["request"]);

	switch($request){
		case 'dbs':
			print_databases();
			break;
		case 'createdb':	
			create_db(htmlspecialchars($_GET["dbname"]));	
			break;
		case 'readdocs':
			read_docs(htmlspecialchars($_GET["dbname"]));	
			break;
		case 'createdoc':
			create_doc(htmlspecialchars($_GET["dbname"]), $_POST["docbody"]);	
			break;
		default:
			echo "Requisição inválida";
	}

	function print_databases(){
		$client = new GuzzleHttp\Client();
		$res = $client->request('GET', 'http://127.0.0.1:5984/_all_dbs');
		echo $res->getBody();
	}

	function create_db($name){
			try{	
				$client = new GuzzleHttp\Client();
				$res = $client->request('PUT', 'http://admin:root@127.0.0.1:5984/' . $name, ['http_errors' => false]);
				echo $res->getBody();
			}catch(\GuzzleHttp\Exception\ClientException $e){
				if($e->hasResponse()){
					var_dump($e);
				}
			}
	}

	function read_docs($dbname){
		try{	
			$client = new GuzzleHttp\Client();
			$res = $client->request('GET', 'http://admin:root@127.0.0.1:5984/' . $dbname . '/_all_docs', ['http_errors' => false]);
			echo $res->getBody();
		}catch(\GuzzleHttp\Exception\ClientException $e){
			if($e->hasResponse()){
				var_dump($e);
			}
		}
	}

	function create_doc($dbname, $body){
		try{	
			$client = new GuzzleHttp\Client();
			$res = $client->request('POST', 'http://admin:root@127.0.0.1:5984/' . $dbname . '/' , [
				'http_errors' => false,
				'headers' => [
					'Content-Type' => 'application/json'
				],
				'body' => $body,
				'debug' => false
			]);
			echo $res->getBody();
		}catch(\GuzzleHttp\Exception\ClientException $e){
			if($e->hasResponse()){
				var_dump($e);
			}
		}
	}
