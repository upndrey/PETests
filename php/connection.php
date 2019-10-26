<?php
$connection = mysqli_connect('localhost', 'root', '', 'PETests');
mysqli_query($connection, 'CREATE TEMPORARY TABLE `table`');
?>