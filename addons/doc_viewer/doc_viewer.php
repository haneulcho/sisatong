<?
// File Output
	$uploaded_filename = $_GET['uploaded_filename'];
	$filename = $_GET['filename'];
	$file_size = $_GET['file_size'];
	$fp = fopen($uploaded_filename, 'rb');
	
	header("Cache-Control: "); 
	header("Pragma: "); 
	header("Content-Type: application/octet-stream"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 

	header("Content-Length: " .(string)($file_size)); 
	header('Content-Disposition: attachment; filename="'.$filename.'"'); 
	header("Content-Transfer-Encoding: binary\n"); 

	// if file size is lager than 10MB, use fread function (#18675748)
	if (filesize($uploaded_filename) > 1024 * 1024) {
		while(!feof($fp)) echo fread($fp, 1024);
		fclose($fp);
	} else {
		fpassthru($fp); 
	}
?>