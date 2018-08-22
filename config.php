<?php

require_once('KalturaPHP5/KalturaClient.php');

define('KALTURA_PARTNER_ID', 0000000); 

define('KALTURA_INSTANCE_URL', 'http://'.KALTURA_PARTNER_ID.'.kaf.kaltura.com');

define('KALTURA_ADMIN_SECRET', 'XXXXXXXXXXXXXXXXXXXXXXX'); 

define('KALTURA_UICONF_ID', '00000000');  

define('KALTURA_SERVICE_URL', 'http://www.kaltura.com/');

// must be encoded to prevent breaking the entire string when the KS is being parsed
define('DOMAIN', 'http%3A%2F%2Flocalhost%2Fkaf');

define('BSE_URL', KALTURA_INSTANCE_URL."/browseandembed/index/browseandembed/ks/");

function generateSession($userId, $privileges = '', $expiry = 86400)
{
  $config = new KalturaConfiguration(PARTNER_ID);
  $client = new KalturaClient($config);

  $ks = $client->generateSessionV2(
    KALTURA_ADMIN_SECRET,
    $userId,
    KalturaSessionType::ADMIN,
    KALTURA_PARTNER_ID,
    $expiry, 
    $privileges);

  return $ks;
}

