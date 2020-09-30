<?php

if (isset($_GET['filename'])) {
   if (unlink(htmlentities( $_GET['filename']))) {
     echo "success";
   }
}
?>