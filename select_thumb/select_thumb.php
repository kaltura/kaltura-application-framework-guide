<?php

require_once(dirname(__FILE__).'/../config.php');

define('BSE_RETURN_URL', DOMAIN.'%2Fselect_thumb%2Fhandle_selected_thumb.php');

$userId = 'user';

$privileges = 'actionslimit:-1,role:privateOnlyRole,returnUrl:'.BSE_RETURN_URL; 

$ks = generateSession($userId,$privileges);

$bseURL = KALTURA_INSTANCE_URL."/browseandembed/index/browseandembed/ks/".$ks;

 // Set this to the dimensions that fit your page template
$thumbWidth = '640';        
$thumbHeight = '360';  

?>

<!DOCTYPE HTML> 
<html> 
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css"> 

	<title>Media Element Picker - Video Thumbnail (for Emails)</title>

</head> 
<body>

<?php
  include_once("../navbar.php");
?>

<div class="editor container">

	<div class="jumbotron">
	  <h2 class="display-4">Pick Video Frame for Email Thumbnail</h2>
	  <p class="lead"><B>Usecase</B>: Allow users to interactively pick a video frame off a video they plan to promote via an email blast, to serve as the thumbnail in the email (the email will send to a landing page with the video) </p>
	  <hr class="my-4">
	  <p class="lead row">
	    <a class="btn btn-primary btn-lg video-selector" href="#" role="button" data-toggle="modal" data-target="#myModal">Pick Video Frame</a>
	  </p>
	  <p class="lead row">
	  	<a href="http://videos.kaltura.com" target="_blank">
		  	<div class="video-thumbnail">
				<img class="thumbPreview" id="thumbImage" style="width:100%; height:100%;" onload="showPlayIcon();"></img>
				<div class="overlay">
		          <i id="playbtn" class="fa fa-play-circle"></i>
	        	</div>			
			</div>
		</a>
	  </p>
	</div>
</div>


	<!-- Modal for Media Selector -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Select Media</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
		<iframe id="BSEContainer" src="<?php echo $bseURL;?>">
			
		</iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

	function setModalTitle(txt) {
		$('#myModalLabel').text(txt);
	}

	function handleSelected(entryId, vidSec) {
		$('#myModal').modal('hide');

		thumbUrl = "https://cdnapisec.kaltura.com/p/<?php echo KALTURA_PARTNER_ID;?>/thumbnail/entry_id/"+entryId+"/width/<?php echo $thumbWidth;?>/height/<?php echo $thumbHeight;?>/nearest_aspect_ratio/1/vid_sec/"+vidSec;

		$('#thumbImage').prop('src', thumbUrl);


	}

	function showPlayIcon() { /* Only show play icon once selected thumbnail finished loading */
		$('#playbtn').css({ 'opacity' : 0.8 });

	}

	$('#myModal').on('hidden.bs.modal', function (e) {

		url = '<?php echo $bseURL;?>';
		$('#BSEContainer').prop('src', url)
		setModalTitle("Select Media");
	})

</script>
</body> 
</html> 