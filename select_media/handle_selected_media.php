<?php

$embeddedUrl = $_POST['url']; 
$thumbnailUrl = $_POST['thumbnailUrl'];
$title = $_POST['title'];
$playerWidth = $_POST['width'];
$playerHeight = $_POST['height'];
$entryId = $_POST['entry_id'];


// this handler should store wherever relevant the needed information - we chose to store the URL to use it for playback later on
// replace this DB with your own storage of the landing page / article / content 
$f = fopen(__DIR__.'/selection_db', 'a');
$str = $entryId."|".$embeddedUrl.PHP_EOL;
fwrite($f, $str);
fclose($f);

?>
<!DOCTYPE HTML> 
<html> 
<head>
<script>
	window.top.handleSelected('<?php echo $entryId;?>');
</script>
</head>
</html>
