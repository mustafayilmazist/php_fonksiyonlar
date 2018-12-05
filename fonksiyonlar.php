<?php 

/**
* [turkceKarakterTemizle türkçe karakterleri ingilizceye dönüştür boşlukları ise - ye dönüştür]
* @param  [type] $param [string]
* @return [type]        [string]
*/
function turkceKarakterTemizle($param){

	$tr = array("ç","Ç","ğ","Ğ","İ","ı","ü","Ü","ö","Ö","ş","Ş");
	$ing = array("c","C","g","G","I","i","u","U","o","O","s","S");
	return str_replace($tr, $ing, $param);

}

/**
* [uniqidUret zaman damgası, rastgele sayı ve benzersiz bir unigiid üretir.]
* @return [type] [benzersiz kimlik]
*/
function uniqidUret(){
	$zaman = time();
	$rastgeleSayi = rand(1,10000);
	$unigiId = uniqid(); 
	$kimlik = $unigiId;
	$kimlik = $zaman."".$rastgeleSayi."".$unigiId;
	return $kimlik;
}

/**
 * [yeniAdOlustur -> dosya adında büyük A-Z küçük a-z ve rakam dışında bulunan tüm karakterleri temizleyip boşlukları - yapar. ve dosyanın adına benzersiz bir ıd değeri atar.]
 * @param  [type] $text [metodun aldığı parametre]
 * @return [type]       [$yeni temizlenmiş olan değer]
 */
function seoUrlOlustur($text)
{
	$tr = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
	$ing = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', '', '');
	$text = strtolower(str_replace($tr, $ing, $text));
	$text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
	$text = trim(preg_replace('/\s+/', ' ', $text));
	$text = str_replace(' ', '-', $text);
	return $text;
}
function pisset(){
	if ( $_POST ) {
		return true;
	}else{
		return false;
	}
}
function gisset(){
	if ( $_GET ) {
		return true;
	}else{
		return false;
	}
}
function post($value){
	if (isset($_POST[$value])) {
		return (trim($_POST[$value]));
	}else{
		return false;
	}
}

function get($value){
	if (isset($_GET[$value])) {
		return (trim($_GET[$value]));
	}else{
		return false;
	}
}

function git($value){
	header("location:$value");
	exit();
}

function sureliGit($url,$sure=1){
	header("refresh:$sure;$url");
}

function pr($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
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

