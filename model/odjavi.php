<?php
session_start();
session_destroy();


//header("location:".$_SERVER['DOCUMENT_ROOT']."/blogsajt/logreg.php");
header("location:logreg.php");

?>