<?php

function redirect($url, $permanent=true) {
	ob_end_clean(); // Clean Output
	mysql_close();

	if ((bool)$permanent) header('HTTP/1.1 301 Moved Permanently');
	header('Location: '.$url);

	die();
}


function parse_youtube_url($url, $return='', $width='', $height='', $rel=0){
	$urls = parse_url($url);

	//url is http://youtu.be/xxxx
	if($urls['host'] == 'youtu.be'){
		$id = ltrim($urls['path'], '/');
	}
	//url is http://www.youtube.com/embed/xxxx
	else if(strpos($urls['path'],'embed') == 1){
		$id = end(explode('/',$urls['path']));
	}
	 //url is xxxx only
	else if(strpos($url,'/')===false){
		$id = $url;
	}

	else{
		parse_str($urls['query']);

		if (empty($v) && !empty($feature)){
			$id = end(explode('v=',$urls['query']));
		} else {
			$id = $v;
		}
	}
	$id = substr($id, 0, 11);

	if (is_array($return) || $return == 'all') {
		$arr_all = array();
		$arr_all['code'] = $id;
		$arr_all['embed'] = '<iframe width="'.($width?$width:560).'" height="'.($height?$height:349).'" src="http://www.youtube.com/embed/'.$id.'?rel='.$rel.'" frameborder="0" allowfullscreen></iframe>';
		$arr_all['url'] = 'http://www.youtube.com/watch?v='.$id.'&rel='.$rel;
		$arr_all['url_embed'] = 'http://www.youtube.com/embed/'.$id.'?rel='.$rel;
		$arr_all['thumb'] = 'http://i1.ytimg.com/vi/'.$id.'/default.jpg';
		$arr_all['hqthumb'] = 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg';

		$arr_return = array();
		if (!empty($return) && is_array($return)) {
			foreach($return as $item) {
				if(isset($arr_all[$item])) $arr_return[$item] = $arr_all[$item];
			}
		}
		if (empty($arr_return)) {
			$arr_return = $arr_all;
		}

		return $arr_return;
	}
	//return embed iframe
	else if($return == 'embed'){
		return '<iframe width="'.($width?$width:560).'" height="'.($height?$height:349).'" src="http://www.youtube.com/embed/'.$id.'?rel='.$rel.'" frameborder="0" allowfullscreen></iframe>';
	}
	//return url embed iframe
	else if($return == 'url_embed'){
		return 'http://www.youtube.com/embed/'.$id.'?rel='.$rel;
	}
	//return normal thumb
	else if($return == 'url'){
		return 'http://www.youtube.com/watch?v='.$id.'&rel='.$rel;
	}
	//return normal thumb
	else if($return == 'thumb'){
		return 'http://i1.ytimg.com/vi/'.$id.'/default.jpg';
	}
	//return hqthumb
	else if($return == 'hqthumb'){
		return 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg';
	}
	// else return id
	else{
		return $id;
	}
}

function get_youtube_info($youtube_id) {
	$info = array();
	$entry = @simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/' . $youtube_id);

	if ($entry) {
		$media = $entry->children('http://search.yahoo.com/mrss/');

		$info['title'] = (string)$media->group->title;
		$info['description'] = (string)$media->group->description;
	}
	return $info;
}

?>