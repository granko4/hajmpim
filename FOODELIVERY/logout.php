<?php
  session_start();

  session_destroy();

  header("location:loginform.php");//kur e perfundojm logout te kthen te faqja per login
?>