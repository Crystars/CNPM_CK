<?php
require_once ('config/config.php');
session_start();
session_destroy();
redirect("index.php");
?>
