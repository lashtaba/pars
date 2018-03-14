<?php
ini_set('MAX_EXECUTION_TIME', 3600);
include 'simple_html_dom.php';
// Create DOM from URL
// $html = file_get_html('http://www.rusprofile.ru/codes/711230/37/');
$urls = [];
for ($i=2; $i <= 3; $i++) { 
	$strr = strval($i);
	$url = "http://www.rusprofile.ru/codes/131010/" . $strr;
	array_push($urls, $url);
	print_r($urls);
}
foreach ($urls as $key) {
	$code = get_html_code_url($key); // Скачиваю код страницы
	$html = str_get_html($code);
	foreach($html->find('div.u-frame') as $article) {
	    $item_href     = $article->find('a.u-name', 0)->href;
	    $item['href'] = "http://www.rusprofile.ru" . $item_href;
	    $articles[] = $item;
	    echo "<br>";
	    print_r($item);
	}
}
// foreach ($articles as $key) {
// 	$code = get_html_code_url($key["href"]); // Скачиваю код страницы
// 	$html = str_get_html($code);
// 	foreach($html->find('div.company-information') as $article) {
// 	    $item['value']     = $article->find('span.acc-value', 0)->plaintext;
// 	    if ($article->find('link[itemprop="url"]', 0)) {
// 	    	$item['href']     = $article->find('link[itemprop="url"]', 0)->href;
// 	    } else {
// 	    	$item['href'] = null;
// 	    }
// 	    $item['address_reg']     = $article->find('span[itemprop="addressRegion"]', 0)->plaintext;
// 	    $item['address_str']     = $article->find('span[itemprop="streetAddress"]', 0)->plaintext;
// 	    $item['money'] = null;
// 	}

// 	foreach($html->find('div[id="buhgrafics"]') as $article) {
// 	    if ($article->find('span.acc-value', 0)) {
// 	    	$item['money']     = $article->find('span.acc-value', 0)->plaintext;
// 	    } else {
// 	    	$item['money'] = null;
// 	    }

// 	}
// 	foreach($html->find('div.overh1') as $article) {
// 	    $item['name']     = $article->find('h1[itemprop="name"]', 0)->plaintext;
// 	}	
// 		print_r($item['name']);
// 	    print_r("; ");
// 	    print_r($item['address_reg']);
// 		print_r($item['address_str']);
// 	    print_r("; ");
// 	    print_r($item['value']);
// 	    print_r("; ");
// 	    print_r($item['href']);
// 		print_r($item['money']);
// 		echo "<br>";
// }
function get_html_code_url($url) {
    $curl = curl_init(); // Инициализирую CURL
    curl_setopt($curl, CURLOPT_HEADER, 0); // Отключаю в выводе header-ы
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //Возвратить данные а не показать в браузере
    curl_setopt($curl, CURLOPT_URL, $url); // Указываю URL
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $code = curl_exec($curl); // Получаю данные
    curl_close($curl); // Закрываю CURL сессию
    return $code;
}
?>