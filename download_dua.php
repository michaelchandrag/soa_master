<?php

$file = "SS SOA.docx";

if (file_exists($file)) {
	header('Pragma: public');
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($file).'"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Content-Length: ' . filesize($file));
	readfile($file);
	exit;
}