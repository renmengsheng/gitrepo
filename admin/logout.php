<?php
session_start();
unset($_SESSION['user']);
echo "<script>alert('You have loged out!');location.href='welcome.php'</script>";

