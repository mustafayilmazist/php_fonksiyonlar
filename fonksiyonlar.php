<?php 

// $_POST var ise true yok ise false döndürür.
function pisset(){
	if ($_POST) {
		return true;
	}else{
		return false;
	}
}
// $_GET var ise true yok ise false döndürür.
function gisset(){
	if ($_GET) {
		return true;
	}else{
		return false;
	}
}
// $_POST[$value] var ise boşlukları temizleyip geri döndürür. 
// yok ise false döndürür
function post($value)
{
	if (isset($_POST[$value])) {
		return trim($_POST[$value]);
	}else{
		return false;
	}
}
// $_GET[$value] var ise boşlukları temizleyip geri döndürür. 
// yok ise false döndürür
function get($value)
{
	if (isset($_GET[$value])) {
		return trim($_GET[$value]);
	}else{
		return false;
	}
}
// header ile $value adresine doğrudan yönlendirme yapar
function git($value)
{
	header("location:$value");
	exit();
}
// header ile $value adresine verilen süre sonra yönlendirme yapar
function sureliGit($url,$sure=0)
{
	header("refresh:$sure;$url");
}
// print_r fonksiyonunu hiyararşik olarak çıktılar
function pr($arr)
{
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}