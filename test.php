<?php
include("Taskforce.inc.php");

#Add your Taskforce username and password
$username = "";
$password = "";


$object = new Taskforce($username, $password);
$user = $object->createList("Test from API");
if ($user != false) {
var_dump($user);
} else {
die("Error.");
}
?>