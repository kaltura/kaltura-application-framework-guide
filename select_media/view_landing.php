<?php

require_once(dirname(__FILE__).'/../config.php');

$userId = "someLandingPageViewer";

$privs = 'actionslimit:-1,role:privateOnlyRole';

$entryId = $_GET['entryId'];

$ks = generateSession($userId,$privs);
$url = "";

// the page that should display a selected media would have to fetch it from whatever storage it was saved in
// we decided to store the URL for playback, so we find it in the DB and then render it as KAF iframe
$f = fopen(__DIR__.'/selection_db', 'r');
while(!feof($f)) {
	$line = fgets($f);
	$parts = explode('|', $line);
	if($parts[0] == $entryId) {
		$url = $parts[1];
		break;
	}
}

// once we found a URL - we generate a KAF KS for it, and we will place it in the iframe
$kafPlaybackUrl = $url.'/ks/'.$ks;


 include_once("../navbar.php");

?>

<!DOCTYPE HTML> 
<html> 
<head>
	<link rel="stylesheet" type="text/css" href="../style.css"> 
</head> 
<body>
<iframe src="<?php echo $kafPlaybackUrl ?>">

</body> 
</html> 