<?php include 'inc/head.php' ?>
<?php include 'inc/nav.php' ?>

<script>
    Swal.fire({
        title: "Belum Tersedia",
        icon: 'warning',
        text: 'Fitur ini belum dapat digunakan, fitur ini masih berupa konsep saja!'
    }).then(() => {
        Swal.fire({
            text: 'Anda akan dikembalikan ke halaman Home',
            icon: 'warning',
            confirmButtonText: 'Oke'
        }).then(() => window.location.href = 'index.php')
    })
</script>

<?php include 'inc/foot.php' ?>