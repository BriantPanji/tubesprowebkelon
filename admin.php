<?php include 'inc/head.php' ?>
<?php
session_start();
include 'inc/conn.php';
isSignedIn();
if (!isAdmin()) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['addVoucer'])) {
    $jlhvcr = $_POST['jlhvcr'];
    $maksvcr = $_POST['maksvcr'];
    $tipevcr = $_POST['tipevcr'];
    $ispersen = $tipevcr === 'persen' ? '1' : '0';
    $kodevcr = 'vc';
    $kodevcr .= getRandom(6);
    $query = "INSERT INTO voucer (kode, value, maks, ispercent) VALUES ('$kodevcr', $jlhvcr, $maksvcr, '$ispersen')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Voucher berhasil ditambahkan',
            text: 'Kode voucher: $kodevcr',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'admin.php';
        })</script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Voucher gagal ditambahkan',
            showConfirmButton: false,
            timer: 1500
        })</script>";
    }
} else if (isset($_POST['hpsVoucer'])) {
    $kodevcr = $_POST['kodevcr'];
    $query = "DELETE FROM voucer WHERE kode = '$kodevcr'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Voucher berhasil dihapus',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'admin.php';
        })</script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Voucher gagal dihapus',
            showConfirmButton: false,
            timer: 1500
        })</script>";
    }
} else if (isset($_POST['hpsakun'])) {
    $username = $_POST['username'];
    $query = "DELETE FROM userdb WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Akun berhasil dihapus',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'admin.php';
        })</script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Akun gagal dihapus',
            showConfirmButton: false,
            timer: 1500
        })</script>";
    }
} else if (isset($_POST['hpsprod'])) {
    $prodid = $_POST['prodid'];
    $query = "DELETE FROM produk WHERE produkid = '$prodid'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Produk berhasil dihapus',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'admin.php';
        })</script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Produk gagal dihapus',
            showConfirmButton: false,
            timer: 1500
        })</script>";
    }
} else if (isset($_POST['suspendakun'])) {
    $username = $_POST['username'];
    $query = "UPDATE userdb SET isbanned = 1 WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Akun berhasil disuspend',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'admin.php';
        })</script>";
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Akun gagal disuspend',
            showConfirmButton: false,
            timer: 1500
        })</script>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_GET['demoteAkn'])) {
        $query = "UPDATE userdb SET isadmin = 0 WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Akun berhasil didemote',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'admin.php';
            })</script>";
        } else {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'Akun gagal didemote',
                showConfirmButton: false,
                timer: 1500
            })</script>";
        }
    } else if (isset($_GET['promoteAkn'])) {
        $query = "UPDATE userdb SET isadmin = 1 WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Akun berhasil dipromote',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'admin.php';
            })</script>";
        } else {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'Akun gagal dipromote',
                showConfirmButton: false,
                timer: 1500
            })</script>";
        }
    } else if (isset($_GET['suspendAkn'])) {
        $query = "UPDATE userdb SET isbanned = 1 WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Akun berhasil disuspend',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'admin.php';
            })</script>";
        } else {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'Akun gagal disuspend',
                showConfirmButton: false,
                timer: 1500
            })</script>";
        }
    } else if (isset($_GET['hapusAkn'])) {
        $query = "DELETE FROM userdb WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Akun berhasil dihapus',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'admin.php';
            })</script>";
        } else {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'Akun gagal dihapus',
                showConfirmButton: false,
                timer: 1500
            })</script>";
        }
    }
}

?>

<?php include 'inc/nav.php' ?>

<h1 class="text-3xl font-bold text-center">Dashboard Admin</h1>

<article class="flex flex-col min-w-full !max-w-full !min-h-2 h-fit lg:flex-row gap-5 justify-center items-center *:lg:!min-w-[50%] *:lg:!max-w-[50%]">


    <section class="formVoucer min-w-full max-w-full min-h-2 mt-5">
        <form action="" method="post" class="min-w-full max-w-full min-h-2">
            <div class="min-w-full max-w-full min-h-2 bg-light-tertiary bg-opacity-35 rounded-lg px-2 py-2 relative">
                <h2 class="mb-3 text-lg font-bold bg-light-primary bg-opacity-75 w-fit px-5 py-2 text-light-bg rounded-md">Tambah Voucher</h2>
                <button onclick="expandform(this)" type="button" class="absolute right-3 top-2 text-xl font-extrabold bg-light-secondary leading-none px-2 py-1 rounded-md text-light-bg bg-opacity-85 hover:bg-opacity-95 hover:scale-95"><i class="fa-solid fa-plus"></i></button>
                <div class="overflow-clip min-w-full max-w-full min-h-3 flex flex-col gap-4 max-h-8">
                    <div class="form-group min-w-full max-w-full min-h-2 flex flex-col gap-0.5">
                        <label for="jlhvcr" class="text-xl font-bold">Jumlah diskon: <i class="wajibisi text-red-700">*</i></label>
                        <input required type="number" name="jlhvcr" id="jlhvcr" class="bg-light-bg rounded-md min-h-9 px-3 text-lg" placeholder="Jumlah diskon...">
                    </div>
                    <div class="form-group min-w-full max-w-full min-h-2 flex flex-col gap-0.5">
                        <label for="maksvcr" class="text-xl font-bold">Potongan maksimum (Rp): <i class="wajibisi text-red-700">*</i></label>
                        <span class="formnote leading-none mb-0.5 text-sm text-yellow-700">* Isi dengan angka 0 jika tidak ada maksimal</span>
                        <input required type="number" name="maksvcr" id="maksvcr" class="bg-light-bg rounded-md min-h-9 px-3 text-lg" placeholder="Potongan maksimum...">
                    </div>
                    <div class="form-group min-w-full max-w-full min-h-2 flex flex-col gap-0.5">
                        <label for="tipevcr" class="text-xl font-bold">Satuan voucer: <i class="wajibisi text-red-700">*</i></label>
                        <select required name="tipevcr" id="tipevcr" class="bg-light-bg rounded-md min-h-9 px-3 text-lg disabled:text-opacity-60">
                            <option value="false" class="text-base font-semibold text-opacity-40" disabled selected>Pilih disini...</option>
                            <option value="persen" class="text-base font-semibold">Persen (%)</option>
                            <option value="nominal" class="text-base font-semibold">Nominal (Rp)</option>
                        </select>
                    </div>
                    <div class="min-w-full max-w-full min-h-2">
                        <button type="submit" name="addVoucer" class="font-bold text-lg bg-light-secondary bg-opacity-85 text-light-bg px-4 py-2.5 rounded-lg flex items-center hover:scale-95"><span class="flex items-center justify-center gap-1 w-full h-full leading-none"><i class="fa-solid fa-ticket-perforated"></i> Tambahkan voucer</span></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <section class="formVoucer min-w-full max-w-full xl:!w-[40%] xl:!min-w-[40%] xl:!max-w-[40%] min-h-2 mt-5">
        <form action="" method="post" class="min-w-full max-w-full min-h-2">
            <div class="min-w-full max-w-full min-h-2 bg-light-tertiary bg-opacity-35 rounded-lg px-2 py-2 relative">
                <h2 class="mb-3 text-lg font-bold bg-light-primary bg-opacity-75 w-fit px-5 py-2 text-light-bg rounded-md">Hapus Voucher</h2>
                <button onclick="expandform(this)" type="button" class="absolute right-3 top-2 text-xl font-extrabold bg-light-secondary leading-none px-2 py-1 rounded-md text-light-bg bg-opacity-85 hover:bg-opacity-95 hover:scale-95"><i class="fa-solid fa-plus"></i></button>
                <div class="overflow-clip min-w-full max-w-full min-h-3 flex flex-col gap-4 max-h-8">
                    <div class="form-group min-w-full max-w-full min-h-2 flex flex-col gap-0.5">
                        <label for="kodevcr" class="text-xl font-bold">Kode voucer: <i class="wajibisi text-red-700">*</i></label>
                        <input required type="text" name="kodevcr" id="kodevcr" class="bg-light-bg rounded-md min-h-9 px-3 text-lg" placeholder="Kode Voucer Disini (vc27afde)...">
                    </div>
                    <div class="min-w-full max-w-full min-h-2">
                        <button type="submit" name="hpsVoucer" class="font-bold text-lg bg-light-secondary bg-opacity-85 text-light-bg px-4 py-2.5 rounded-lg flex items-center hover:scale-95"><span class="flex items-center justify-center gap-1 w-full h-full leading-none"><i class="fa-solid fa-trash"></i> Hapus voucer</span></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</article>
<article class="mt-9 border-t border-solid border-light-secondary flex flex-col min-w-full !max-w-full !min-h-2 h-fit lg:flex-row gap-5 justify-center items-center *:lg:!min-w-[50%] *:lg:!max-w-[50%]">
    <section class="formAkun min-w-full max-w-full min-h-2 mt-5">
        <form action="" method="post" class="min-w-full max-w-full min-h-2">
            <div class="min-w-full max-w-full min-h-2 bg-light-tertiary bg-opacity-35 rounded-lg px-2 py-2 relative">
                <h2 class="mb-3 text-lg font-bold bg-light-primary bg-opacity-75 w-fit px-5 py-2 text-light-bg rounded-md">Hapus akun</h2>
                <button onclick="expandform(this)" type="button" class="absolute right-3 top-2 text-xl font-extrabold bg-light-secondary leading-none px-2 py-1 rounded-md text-light-bg bg-opacity-85 hover:bg-opacity-95 hover:scale-95"><i class="fa-solid fa-plus"></i></button>
                <div class="overflow-clip min-w-full max-w-full min-h-3 flex flex-col gap-4 max-h-8">
                    <div class="form-group min-w-full max-w-full min-h-2 flex flex-col gap-0.5">
                        <label for="username" class="text-xl font-bold">Username: <i class="wajibisi text-red-700">*</i></label>
                        <input required type="text" name="username" id="username" class="bg-light-bg rounded-md min-h-9 px-3 text-lg" placeholder="Username disini...">
                    </div>
                    <div class="min-w-full max-w-full min-h-2">
                        <button type="submit" name="hpsakun" class="font-bold text-lg bg-light-secondary bg-opacity-85 text-light-bg px-4 py-2.5 rounded-lg flex items-center hover:scale-95"><span class="flex items-center justify-center gap-1 w-full h-full leading-none"><i class="fa-solid fa-trash"></i> Hapus akun</span></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <section class="formAkun min-w-full max-w-full min-h-2 mt-5">
        <form action="" method="post" class="min-w-full max-w-full min-h-2">
            <div class="min-w-full max-w-full min-h-2 bg-light-tertiary bg-opacity-35 rounded-lg px-2 py-2 relative">
                <h2 class="mb-3 text-lg font-bold bg-light-primary bg-opacity-75 w-fit px-5 py-2 text-light-bg rounded-md">Suspend akun</h2>
                <button onclick="expandform(this)" type="button" class="absolute right-3 top-2 text-xl font-extrabold bg-light-secondary leading-none px-2 py-1 rounded-md text-light-bg bg-opacity-85 hover:bg-opacity-95 hover:scale-95"><i class="fa-solid fa-plus"></i></button>
                <div class="overflow-clip min-w-full max-w-full min-h-3 flex flex-col gap-4 max-h-8">
                    <div class="form-group min-w-full max-w-full min-h-2 flex flex-col gap-0.5">
                        <label for="username" class="text-xl font-bold">Username: <i class="wajibisi text-red-700">*</i></label>
                        <input required type="text" name="username" id="username" class="bg-light-bg rounded-md min-h-9 px-3 text-lg" placeholder="Username disini...">
                    </div>
                    <div class="min-w-full max-w-full min-h-2">
                        <button type="submit" name="suspendakun" class="font-bold text-lg bg-light-secondary bg-opacity-85 text-light-bg px-4 py-2.5 rounded-lg flex items-center hover:scale-95"><span class="flex items-center justify-center gap-1 w-full h-full leading-none"><i class="fa-solid fa-ban"></i> Suspend akun</span></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</article>

<article class="mt-9 border-t border-solid border-light-secondary flex flex-col min-w-full !max-w-full !min-h-2 h-fit lg:flex-row gap-5 justify-center items-center *:lg:!min-w-[50%] *:lg:!max-w-[50%]">

    <section class="formAkun min-w-full max-w-full min-h-2 mt-5">
        <form action="" method="post" class="min-w-full max-w-full min-h-2">
            <div class="min-w-full max-w-full min-h-2 bg-light-tertiary bg-opacity-35 rounded-lg px-2 py-2 relative">
                <h2 class="mb-3 text-lg font-bold bg-light-primary bg-opacity-75 w-fit px-5 py-2 text-light-bg rounded-md">Hapus Produk</h2>
                <button onclick="expandform(this)" type="button" class="absolute right-3 top-2 text-xl font-extrabold bg-light-secondary leading-none px-2 py-1 rounded-md text-light-bg bg-opacity-85 hover:bg-opacity-95 hover:scale-95"><i class="fa-solid fa-plus"></i></button>
                <div class="overflow-clip min-w-full max-w-full min-h-3 flex flex-col gap-4 max-h-8">
                    <div class="form-group min-w-full max-w-full min-h-2 flex flex-col gap-0.5">
                        <label for="prodid" class="text-xl font-bold">Id Produk: <i class="wajibisi text-red-700">*</i></label>
                        <input required type="text" name="prodid" id="prodid" class="bg-light-bg rounded-md min-h-9 px-3 text-lg" placeholder="Id Produk disini...">
                    </div>
                    <div class="min-w-full max-w-full min-h-2">
                        <button type="submit" name="hpsprod" class="font-bold text-lg bg-light-secondary bg-opacity-85 text-light-bg px-4 py-2.5 rounded-lg flex items-center hover:scale-95"><span class="flex items-center justify-center gap-1 w-full h-full leading-none"><i class="fa-solid fa-trash"></i> Happus produk</span></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</article>

<section class="lisuser min-w-full max-w-full min-h-3 mt-5 pt-5 border-t border-solid border-light-secondary">

    <div class="relative min-w-full max-w-full overflow-x-auto shadow-md rounded-lg">
        <table class="w-full min-w-full max-w-full text-sm text-left rtl:text-right bg-light-text bg-opacity-35">
            <thead class="text-xs md:text-base uppercase bg-light-text bg-opacity-30 text-light-bg ">
                <tr>
                    <th scope="col" class="px-3 py-2.5">
                        id
                    </th>
                    <th scope="col" class="px-3 py-2.5">
                        Username
                    </th>
                    <th scope="col" class="px-3 py-2.5">
                        Role
                    </th>
                    <th scope="col" class="px-3 py-2.5">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="text-xs md:text-base">
                <?php 
                $semuauser = getAllUser();
                $i = 0;
                ?>
                <?php foreach ($semuauser as $user): ?>
                <?php $useradmin = strToBool($user['isadmin']) ?>
                <tr class="odd:bg-light-text odd:bg-opacity-70 odd:text-light-bg even:bg-opacity-65 border-b border-light-bg">
                    <td class="px-3 py-2.5 pb-3">
                        <?= $user['id'] ?>
                    </td>
                    <th scope="row" class="px-3 py-2.5 pb-3 font-semibold whitespace-nowrap dark:text-white">
                        <?= $user['username'] ?>
                    </th>
                    <?php $klasrole = $useradmin ? 'odd:text-blue-600 even:text-blue-800' : 'odd:text-emerald-600 even:text-emerald-800' ?>
                    <td class="px-3 py-2.5 pb-3 font-medium <?= $klasrole ?>">
                        <?= $useradmin ? "Admin" : "User" ?>
                    </td>
                    <td class="px-3 py-2.5 pb-3 text-[1.2rem] flex flex-row items-center gap-1">
                        <?php if ($useradmin) { ?>
                        <a href="admin.php?id=<?= $user['id'] ?>&demoteAkn=" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline"><i class="fa-sharp fa-regular fa-circle-down"></i></a>
                        <?php } else { ?>
                        <a href="admin.php?id=<?= $user['id'] ?>&promoteAkn=" class="font-medium text-green-600 dark:text-green-500 hover:underline"><i class="fa-sharp fa-regular fa-circle-up"></i></a>
                        <?php } ?>
                        <a href="admin.php?id=<?= $user['id'] ?>&suspendAkn=" class="font-medium text-fuchsia-500 dark:text-fuchsia-500 hover:underline"><i class="fa-solid fa-ban"></i></a>
                        <a href="admin.php?id=<?= $user['id'] ?>&hapusAkn=" class="font-medium text-red-700 dark:text-red-500 hover:underline"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
                <?php $i++ ?>
                <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>
</section>
<?php include 'inc/foot.php' ?>
<script>
    let ele;

    function expandform(el) {
        ele = el;
        let form = el.parentElement.querySelector('.min-h-3');
        form.classList.toggle('max-h-8');
        form.classList.toggle('overflow-clip');
        if (el.children[0].classList.contains('fa-plus')) {
            el.children[0].classList.replace('fa-plus', 'fa-minus');
        } else {
            el.children[0].classList.replace('fa-minus', 'fa-plus');
        }
    }
</script>