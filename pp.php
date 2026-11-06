	<?php






$username = "shakawat@fnd";
$radius_server = "172.16.1.2";
$radius_secret = "password";
$radius_port = "3799";

// Build the radclient command
$command = "echo 'User-Name=$username' | radclient -x $radius_server:$radius_port disconnect $radius_secret";

// Execute the command
$output = shell_exec($command);

// Output the result
echo "<pre>$output</pre>";
?>





