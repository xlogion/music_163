<?php
function xlogion_autoload ($ClassName) {
	$in_path=str_replace('inc','',INC_DIR)."class/".$ClassName.".php";
	$in_path=str_replace('\\',DIRECTORY_SEPARATOR,$in_path);
	include($in_path);
}
spl_autoload_register("xlogion_autoload");