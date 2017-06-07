<?PHP

  $to="stephen@cisdirect.com";
  $subject="New acocunt info for '$s[16]'";
  $body="\r\nYour account has been set up and your user name and password are $s[97]/$s[98]";
  $headers="From: stephen@cisdirect.com\n";
  mail($to,$subject,$body,$headers);

?>
