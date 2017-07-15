<?php

	class Postmark {
		private $api_key;
		private $attachment_count = 0;
		private $data = array();
		function __construct($key, $from, $reply = ''){
			$this->api_key = $key;
			$this->data['From'] = $from;
			$this->data['ReplyTo'] = $reply;
		}
		function send()
		{
			$headers = array(
				'Accept: application/json',
				'Content-Type: application/json',
				'X-Postmark-Server-Token: '.$this->api_key
			);
			
			$data = $this->data;
			$ch = curl_init('http://api.postmarkapp.com/email');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$return = curl_exec($ch);
			$curl_error = curl_error($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			if($http_code !== 200)
				return false;
			else
				return true;
		}
		function to($to)
		{
			$this->data['To'] = $to;
			return $this;
		}
		function subject($subject)
		{
			$this->data['Subject'] = $subject;
			return $this;
		}
		function html_message($body)
		{
			$this->data['HtmlBody'] = $body;
			return $this;
		}
		function plain_message($msg)
		{
			$this->data['TextBody'] = $msg;
			return $this;
		}
		function tag($tag)
		{
			$this->data['Tag'] = $tag;
			return $this;
		}
		function reply($reply)
		{
			$this->data['ReplyTo'] = $reply;
			return $this;
		}
		
		function adjunta_vato($arr){
			
			if(count($arr)>0){
				foreach($arr as $data){
					$url = $data;
					$headers = get_headers($url, 1);
					$parts = parse_url($url);
					$filename = basename($parts["path"]);
					if ($headers[0] == 'HTTP/1.1 200 OK') {
						$mime = get_headers($url, 1)["Content-Type"]; 
						if($mime){
							$this->attachment($filename, file_get_contents($url), $mime);
						}
					}
				}
			}
		}
		
		function attachment($name, $content, $content_type)
		{
			$this->data['Attachments'][$this->attachment_count]['Name']		= $name;
			$this->data['Attachments'][$this->attachment_count]['ContentType']	= $content_type;
		
			if( ! base64_decode($content, true))
				$this->data['Attachments'][$this->attachment_count]['Content']	= base64_encode($content);
			else
				$this->data['Attachments'][$this->attachment_count]['Content']	= $content;
				
			$this->attachment_count++;
			return $this;
		}
	}
	