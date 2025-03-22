<?php include 'inc/head.php' ?>
<?php 
session_start();

if (isset($_GET['dark'])) {
    // echo "<script>alert('hi')</script>";
    setcookie("dark", 'true', time() + 60*60*24*30);
} else {
    setcookie("dark", 'false', 60*60*24*30);
}

header('Location: index.php');
exit;
?>
<?php include 'inc/nav.php' ?>
