<?php

$embedData = array ( // Pass back metadata towards schema.org videoObject SEO metadata - https://developers.google.com/search/docs/data-types/video
	'embeddedUrl' => $_POST['url'],
	'thumbnailUrl' => $_POST['thumbnailUrl'],
	'title' => htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8'),
	'description' => htmlspecialchars($_POST['fullDescription'], ENT_QUOTES, 'UTF-8'),
	'tags' => $_POST['tags'],
	'duration' => $_POST['duration'],
	'createdAt' => date("c",$_POST['createdAt']), // Format to an acceptable schema.org format
	'playerWidth' => $_POST['width'],
	'playerHeight' => $_POST['height'],
);

$entryId = $_POST['entry_id'];

?>
<!DOCTYPE HTML> 
<html> 
<head>
<script>
	window.top.handleSelected('<?php echo $entryId;?>',JSON.parse('<?php echo json_encode($embedData); ?>'));
</script>
</head>
</html>
