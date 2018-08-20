<?php
require_once(dirname(__FILE__).'/../kaltura_config.php');

$embeddedUrl = $_POST['url'];
$thumbnailUrl = $_POST['thumbnailUrl'];
$title = $_POST['title'];
$playerWidth = $_POST['width'];
$playerHeight = $_POST['height'];
$entryId = $_POST['entry_id'];
$duration = $_POST['duration'];

$thumbWidth = 200;
$thumbHeight = 200;

// Check first if entry returned is an image, and if so, bypass frame selection

if ($duration.'' == '') {
	?>
<!DOCTYPE HTML> 
<html> 
<head>
<script>
	window.top.handleSelected('<?php echo $entryId;?>',0);
</script>
</head>
</html>
<?php 
} else {


	// Add leading zeros to asset's duration, towards keyframe calculations
	if (substr_count($duration, ":") < 2) {
		// Add hours filler
		$duration= "00:".$duration;
	}
	$parsed = date_parse($duration);
	$seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
	?>
	<!DOCTYPE HTML> 
	<html> 
	<head>
		<style>
			ul {
				list-style-type: none;
			}

			li img {
				float: left;
				margin: 5px;
				border: 1px solid #333;
				cursor: pointer;
			}

		</style>
		<script>
			//Change the modal's title on load 
			window.top.setModalTitle('Pick A Frame for Email Thumbnail');

		</script>
	</head>
	<body>
		<ul>
			<?php

				// Grab keyframes from the video, in fixed intervals
				$numThumbs = 12;

				$int = floor($seconds / $numThumbs);
				$start = 3; // start with 3rd second
				while ($start < $seconds) {
					$thumbUrl = "https://cdnapisec.kaltura.com/p/".KALTURA_PARTNER_ID."/thumbnail/entry_id/".$entryId."/width/".$thumbWidth."/height/".$thumbHeight."/nearest_aspect_ratio/1/vid_sec/".$start;
					echo "<li class='thumbPrev' id='thumb_".$start."'><img data-secs='".$start."' width='".$thumbWidth."' height='".$thumbHeight."' src='".$thumbUrl."'/>";
					$start+=$int;
				}
			?>
		</ul>
	</body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script>

	// Return selected keyframe
	$("img").on('click', function(event) {
	    event.preventDefault();
	    $vid_sec = $(this).attr('data-secs');
		window.top.handleSelected('<?php echo $entryId;?>',$vid_sec);
	});	
	</script>
	</head>
	</html>
<?php
}