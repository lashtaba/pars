<?php
include 'simple_html_dom.php';
// Create DOM from URL
// $html = file_get_html('http://www.rusprofile.ru/codes/711230/37/');
$urls = [];
for ($i=1; $i < 29; $i++) { 
	$strr = strval($i);
	$url = "http://www.rusprofile.ru/codes/711230/" . $strr . "/";
	array_push($urls, $url);
}

	$code = get_html_code_url("http://www.rusprofile.ru/codes/711230"); // Скачиваю код страницы
	$html = str_get_html($code);
	foreach($html->find('div.u-frame') as $article) {
	    $item['address']     = $article->find('div.u-address', 0)->plaintext;
	    $item['name']     = $article->find('span.und', 0)->plaintext;
	    $item_href     = $article->find('a.u-name', 0)->href;
	    $item_href = "http://www.rusprofile.ru" . $item_href;
	    $item['href'] = $item_href;
	    $articles[] = $item;
	    print_r($item['name']);
	    print_r("; ");
	    print_r($item['address']);
	    print_r("; ");
	    print_r($item['href']);
	    print_r("<br>");
	}

// print_r(var_dump($articles));


function get_html_code_url($url) {
    $curl = curl_init(); // Инициализирую CURL
    curl_setopt($curl, CURLOPT_HEADER, 0); // Отключаю в выводе header-ы
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //Возвратить данные а не показать в браузере
    curl_setopt($curl, CURLOPT_URL, $url); // Указываю URL
    $code = curl_exec($curl); // Получаю данные
    curl_close($curl); // Закрываю CURL сессию
    return $code;
}
?>