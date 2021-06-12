<html>
<body>
<?php
include("simple_html_dom.php");
// Create DOM from URL or file
$html = file_get_html('https://www.worldcoinindex.com/th/%E0%B9%80%E0%B8%AB%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%8D/dopple-finance');
/*
// Find all images
foreach($html->find('img') as $element)
       echo $element->src . '<br>';

// Find all links
foreach($html->find('a') as $element)
       echo $element->href . '<br>';
$ret = $html->find('a');*/
echo $html->find('body .col-md-6 .coinprice',0);

$html = file_get_html('https://www.bitkub.com/market/BNB');
/*
// Find all images
foreach($html->find('img') as $element)
       echo $element->src . '<br>';

// Find all links
foreach($html->find('a') as $element)
       echo $element->href . '<br>';
$ret = $html->find('a');*/
echo $html->find('head');
//var_dump($html->find('div'[0]))
?>

</body>
   </html>