<?php

require_once(dirname(__FILE__).'/../config.php');

define('BSE_RETURN_URL', DOMAIN.'%2Fselect_media%2Fhandle_selected_media.php'); 

$userId = 'user';

$player_id = 'player_id'; 

$privileges = 'actionslimit:-1,role:privateOnlyRole,returnUrl:'.BSE_RETURN_URL; 
 
$ks = generateSession($userId,$privileges);

$bseURL = BSE_URL.$ks;

?>

<!DOCTYPE HTML> 
<html> 
<head>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="../style.css"> 
  <title>Picker: Landing Page Video</title>
</head> 
<body>

<?php
  include_once("../navbar.php");
?>

<div class="editor container">
  <div class="jumbotron">
    <h2 class="display-4">Pick a Landing Page Video</h2>
    <p class="lead"><B>Usecase</B>: Allow users to interactively pick a video into a placeholder in a landing page template. Template needs only to save the video's id, then load the player when rendering the page </p>
    <hr class="my-4">
    <p class="lead row">
      <a class="btn btn-primary btn-lg video-selector" href="#" role="button" data-toggle="modal" data-target="#myModal">Pick Video</a>
    </p>
    <p class="lead row">
      <!-- This is an example of responsive embed -->
    <div style="width: 60%;display: inline-block;position: relative;"> 
      <!--  inner pusher div defines aspect ratio: in this case 16:9 ~ 56.25% -->
      <div id="dummy" style="margin-top: 56.25%;"></div>
      <!--  the player embed target, set to take up available absolute space   -->
      <div class="mediaPlayer" id="<?php echo $player_id;?>" style="position:absolute;top:0;left:0;left: 0;right: 0;bottom:0;border:solid thin black;">
      </div>
    </div>        
    </p>
  </div>
</div>

  <!-- Modal for Media Selector -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

<script src="<?php echo KALTURA_SERVICE_URL;?>/p/<?php echo KALTURA_PARTNER_ID;?>/sp/<?php echo KALTURA_PARTNER_ID;?>00/embedIframeJs/uiconf_id/<?php echo KALTURA_UICONF_ID;?>/partner_id/<?php echo KALTURA_PARTNER_ID;?>"></script>

<script>

function handleSelected(entryId) {
	$('#myModal').modal('hide');
$('#<?php echo $player_id; ?>').html('go to <a href="view_landing.php?entryId='+entryId+'">landing page</a>');
}


	$('#myModal').on('hidden.bs.modal', function (e) {
		url = '<?php echo $bseURL;?>';
		$('#BSEContainer').prop('src', url)
	})

</script>
</body> 
</html> 