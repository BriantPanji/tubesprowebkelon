<?php include 'inc/head.php' ?>
<?php
session_start();
include 'inc/conn.php';
if (!isSignedIn()) {
    header("Location: signin.php");
    exit;
}

$url = getURL();


if (isset($_GET['produkid'])) {
    $produk = getProduk($_GET['produkid']);
    if (isset($_GET['r']))
        $redi = rawurldecode($_GET['r']);
    else
        $redi = "profile.php";

    if (!$produk) {
        echo "<script>
        Swal.fire({
            title: 'Produk tidak ditemukan!',
            text: 'Silahkan coba lagi',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index.php';
        });
        </script>";
        exit;
    }
    if ($produk['randomid'] !== $_SESSION['id']) {
        echo "<script>
        Swal.fire({
            title: 'Anda tidak memiliki akses!',
            text: 'Silahkan coba lagi',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index.php';
        });
        </script>";
        exit;
    }
    $id = $produk['produkid'];
    $hapusan = hapusProduk($id);
    if ($hapusan) {
        echo "<script>
        Swal.fire({
            title: 'Berhasil menghapus produk',
            text: 'Anda akan dialihkan ke halaman utama',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '$redi';
        });
        </script>";
        exit;
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal menghapus produk',
            text: 'Silahkan coba lagi',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '$redi';
        });
        </script>";
        exit;
    }
    


} else {
    echo "<script>
    Swal.fire({
        title: 'Produk tidak ditemukan!',
        text: 'Silahkan coba lagi',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'profile.php';
    });
    </script>";
    exit;
}

?>
<?php include 'inc/foot.php' ?>