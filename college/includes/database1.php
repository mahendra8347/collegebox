<?php
$connect=mysqli_connect('localhost','root','','complain');
 
if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}
 
?>