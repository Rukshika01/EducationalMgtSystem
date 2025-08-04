<?php
session_start();
?>
<?php
$_SESSION["pidx"]=="";
session_unset('pidx');
header('Location:index.html');
?>