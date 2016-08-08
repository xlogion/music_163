<?php
class music163 {
	
	public $api_url='http://music.163.com';
	public $info='';
	function __construct($url) {
		if ($url!='') {
			$turl=parse_url($url);
			if ($turl['host']=='music.163.com') {
				$t_url = parse_url($turl['fragment']);
				$arr_query = $this->convertUrlQuery($t_url['query']);

				if ($t_url['path']=='/song' || $t_url['path']=='/m/song' ) {
				$this->info=$this->song($arr_query['id']);

				}

				if ($t_url['path']=='/mv/' ) {
				$this->info=$this->getmv($arr_query['id']);

				}
			}

		}

	

	}
	

	function convertUrlQuery($query){
		$queryParts = explode('&', $query);
		$params = array();
		foreach ($queryParts as $param){
			$item = explode('=', $param);
			$params[$item[0]] = $item[1];
		}
		return $params;
	}

	function get($url,$parameters = array()) {
		$response = $this->http($url,'GET', $parameters);
		return $response;
	}


	function post($url,$parameters = array()) {
		$response = $this->http($url,'POST', $parameters);
		return $response;
	}

	function http($url,$method, $parameters) {
		$headers[] = 'Origin:'.$this->api_url.'';
		$headers[] = 'Referer:'.$this->api_url.'';
		$headers[] = 'Content-Type:application/x-www-form-urlencoded';
		$ch = curl_init();  	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true); 
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($ch,  CURLOPT_FOLLOWLOCATION, 1);
		switch ($method) {
			case 'GET':
				//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
				$url = $url. '?' . http_build_query($parameters);
				//echo $url;
				curl_setopt($ch, CURLOPT_URL,$url);
				break;
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
				break;
		}
		

		$result =curl_exec($ch);  
		curl_close($ch);
		return $result;
	}


	function search($s, $limit = 3, $offset = 0){
			$url=$this->api_url.'/api/search/suggest/web';
			$parameters=array(
					's'=>$s,
					'limit'=>$limit,
					'type'=>$type,
					'offset'=>$offset,
					);

			$re=$this->post($url,$parameters);
			return json_decode($re,true);
	}

	function song($id){
			$url=$this->api_url.'/api/song/detail';
			$parameters=array(
					'ids'=>'['.$id.']'
					 );

			$re=$this->get($url,$parameters);
			return json_decode($re,true,512,JSON_BIGINT_AS_STRING);
	}

	function lrc($id){
			$url=$this->api_url.'/api/song/lyric';
			$parameters=array(
					'lv'=>-1,
					'kv'=>-1,
					'tv'=>-1,
					'id'=>$id
					 );

			$re=$this->get($url,$parameters);
			return json_decode($re,true,512,JSON_BIGINT_AS_STRING);
	}


	function getplaylists($id){
			$url=$this->api_url.'/api/playlist/detail';
			$parameters=array(
					'id'=>$id
					 );

			$re=$this->get($url,$parameters);
			return json_decode($re,true,512,JSON_BIGINT_AS_STRING);
	}


	function getartistalbums($id){
			$url=$this->api_url.'/api/artist/albums/'.$id;
			$parameters=array(
					'offset'=>0,
					'limit'=>3
					 );

			$re=$this->get($url,$parameters);
			return json_decode($re,true,512,JSON_BIGINT_AS_STRING);
	}

	function getalbums($id){
			$url=$this->api_url.'/api/album/'.$id;
			$parameters=array(
					 );

			$re=$this->get($url,$parameters);
			return json_decode($re,true,512,JSON_BIGINT_AS_STRING);
	}

	function getmv($id){
			$url=$this->api_url.'/api/mv/detail';
			$parameters=array(
				'id'=>$id,
				'type'=>'mp4'
					 );

			$re=$this->get($url,$parameters);
			return json_decode($re,true,512,JSON_BIGINT_AS_STRING);
	}
	

}