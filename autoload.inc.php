<?php
function __autoload ($className)
{
	require_once "./Class/" . $className . ".class.php";
}
?>
