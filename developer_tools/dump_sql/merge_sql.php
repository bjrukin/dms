<?php
$dir    = '.';
$files = scandir($dir);
$c = '';
foreach($files as $file) {
	if ($file != '.' && $file != '..' && $file != 'merge_sql.php' && $file != 'all.sql') {
		$c .= file_get_contents($file) . "\n\n" ;
	}
}

$h = fopen('all.sql', 'w');
fwrite($h, $c);
fclose($h);