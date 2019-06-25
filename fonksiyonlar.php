<?php 

function post()
{
	if ($_POST) {
		return true;
	}else{
		return false;
	}
}
function get()
{
	if ($_GET) {
		return true;
	}else{
		return false;
	}
}
function p($deger){
	if (isset($_POST[$deger])) {
		return trim($_POST[$deger]);
	}
	return false;
}
function g($deger){
	if (isset($_GET[$deger])) {
		return trim($_GET[$deger]);
	}
	return false;
}
function redirect($url,$time=0){
	if ($time==0) {
		header("location:$url");
	}else{
		$time=(int)$time;
		header("refresh:$time;$url");
	}
}
function seoUrlOlustur($text){
	$tr=["Ç","Ş","Ğ","Ü","İ","Ö","ç","ş","ğ","ü","ı","ö","+","#"];
	$ing = ["C","S","G","U","I","O","c","s","g","u","i","o","",""];
	$text = strtolower(str_replace($tr, $ing, $text));
	$text = preg_replace("@[\.+]@", "", $text);
	$text = preg_replace("@[^A-Za-z0-9\-_\+]@", " ", $text);
	$text = trim(preg_replace('/\s+/', " ", $text));
	$text= str_replace(" ", "-", $text);
	return $text;
}
function pr($dizi){
	echo "<pre>";
	print_r($dizi);
	echo "</pre>";
}

function base_url($param=""){
	return BASEURL."".$param;
}

function cokluResimYuklemeVerisiOlustur($name,$i){
	$dizi["name"]=$_FILES[$name]["name"][$i];
	$dizi["type"]=$_FILES[$name]["type"][$i];
	$dizi["tmp_name"]=$_FILES[$name]["tmp_name"][$i];
	$dizi["error"]=$_FILES[$name]["error"][$i];
	$dizi["size"]=$_FILES[$name]["size"][$i];
	return $dizi;
}


/**
 * kapanmanan etiketleri yazıyı kırparak kapatan fonksiyon */
function make_excerpt ($rawHtml, $length = 500) {
	$content = substr($rawHtml, 0, $length)
	. '&hellip; <a href="/link-to-somewhere">More &gt;</a>';

	$encoding = mb_detect_encoding($content);

	$doc = new DOMDocument('', $encoding);

	@$doc->loadHTML('<html><head>'
		. '<meta http-equiv="content-type" content="text/html; charset='
		. $encoding . '"></head><body>' . trim($content) . '</body></html>');

	$nodes = $doc->getElementsByTagName('body')->item(0)->childNodes;
	$html = '';
	$len = $nodes->length;
	for ($i = 0; $i < $len; $i++) {
		$html .= $doc->saveHTML($nodes->item($i));
	}
	return $html;
}

/**
 * kapanmayan html etiketleri kapatan fonksiyon
 */
function etiketKapat($html) {
	preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
	$openedtags = $result[1];
	preg_match_all('#</([a-z]+)>#iU', $html, $result);
	$closedtags = $result[1];
	$len_opened = count($openedtags);
	if (count($closedtags) == $len_opened) {
		return $html;
	}
	$openedtags = array_reverse($openedtags);
	for ($i=0; $i < $len_opened; $i++) {
		if (!in_array($openedtags[$i], $closedtags)) {
			$html .= '</'.$openedtags[$i].'>';
		} else {
			unset($closedtags[array_search($openedtags[$i], $closedtags)]);
		}
	}
	return $html;
} 

