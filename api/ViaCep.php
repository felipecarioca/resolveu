<?php

	class ViaCep
	{
		
		function getDados($cep)
		{
			$url = 'http://viacep.com.br/ws/'.$cep.'/json/';

	        $ch = curl_init($url);

	        curl_setopt($ch, CURLOPT_HTTPGET, true);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        
	        $response_json = curl_exec($ch);
	        
	        curl_close($ch);
	        
	        return json_decode($response_json, true);

		}
	}
?>