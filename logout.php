<?php include 'inc/head.php' ?>
<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

if (isset($_COOKIE["id"]) || isset($_COOKIE["key"])) {
    setcookie("id", "", time() - 3600);
    setcookie("key", "", time() - 3600);
}

echo "<script>
Swal.fire({
    title: 'Berhasil Logout',
    text: 'Anda akan dialihkan ke halaman utama',
    icon: 'success',
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = 'index.php';
});
    </script>";

// header("Location: index.php");
exit;
?>
<?php include 'inc/foot.php' ?>