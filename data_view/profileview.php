<?php

// Singel DATA View 


$sql = "SELECT * FROM slider WHERE id='1'";
$row = mysqli_fetch_assoc($conn->query($sql) );
echo $row['id'];

