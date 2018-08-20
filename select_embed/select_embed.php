<?php

require_once(dirname(__FILE__).'/../config.php');

define('BSE_RETURN_URL', DOMAIN.'%2Fselect_embed%2Fhandle_selected_embed.php'); 

$userId = 'Avital.tzubeli@kaltura.com';       

$privileges = 'actionslimit:-1,role:privateOnlyRole,returnUrl:'.BSE_RETURN_URL;  

$ks = generateSession($userId,$privs);

$bseURL = BSE_URL.$ks;

// Set this to the dimensions that fit your page template
$embedWidth = '560';         
$embedHeight = '395';  

?>

<!DOCTYPE HTML> 
<html> 
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 
	<link rel="stylesheet" type="text/css" href="../style.css"> 

	<title>Picker: Grabbable Embed</title>

</head> 
<body>

<?php
	include_once("../navbar.php");
?>

<!-- *** RENDER YOUR "EDITOR" UI HERE *** -->

<div class="editor container">

	<div class="jumbotron">
	  <h2 class="display-4">Grab Video Embed For Self-Hosted Pages</h2>
	  <p class="lead"><B>Usecase</B>: Allow users to interactively grab embed codes of a specific media asset, towards embedding in their self-hosted landing pages</p>
	  <hr class="my-4">
	  <p class="lead row">
	    <a class="btn btn-primary btn-lg video-selector" href="#" role="button" data-toggle="modal" data-target="#myModal">Grab Embed</a>
	  </p>
	  <p class="lead row">
			<textarea class="embedPreview" id="embedCode" style="width: 100%; height: 100%"></textarea> 
	  </p>
	  <p class="lead row">
			<button class="btn btn-secondary btn-sm copy" data-clipboard-target="#embedCode" >Copy to clipboard</button>
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
<script src="../js/KalturaEmbedCodeGenerator.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>

<script>

	new ClipboardJS('.copy');

	function setModalTitle(txt) {
		$('#myModalLabel').text(txt);
	}

	// handler called by the BSE's return URL
	function handleSelected(entryId, embedData) {
		$('#myModal').modal('hide');

		var gen = new kEmbedCodeGenerator({
			partnerId: <?php echo KALTURA_PARTNER_ID;?>,
			uiConfId: <?php echo KALTURA_UICONF_ID;?>,
			embedType: 'iframe',
			entryId: entryId,
			height: embedData.playerHeight,
			width: embedData.playerWidth,
			entryMeta: {name: embedData.title, 
						description: embedData.description, 
						duration: embedData.duration, 
						uploadDate: embedData.createdAt, 
						thumbnailUrl: embedData.thumbnailUrl, 
						tags: embedData.tags},
			includeSeoMetadata: true,
			includeKalturaLinks: false 

		});

		document.getElementById("embedCode").innerHTML = gen.getCode();

	}

	// Reset modal to default content once hidden
	$('#myModal').on('hidden.bs.modal', function (e) {

		url = '<?php echo $bseURL;?>';
		$('#BSEContainer').prop('src', url)
		setModalTitle("Select Media");
	});

</script>
</body> 
</html> 