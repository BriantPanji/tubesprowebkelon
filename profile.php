<?php include 'inc/head.php' ?>
<?php
session_start();
include 'inc/conn.php';
if (!isSignedIn()) {
    header("Location: signin.php");
    exit;
}

$url = getURL();

$user = getUserByRandomId($_SESSION['id']);
if (!$user) {
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal mengambil data',
        text: 'Silahkan coba lagi'
    }.then(() => {
        window.location.href = 'logout.php';
    })
        </script>";
    exit;
}

updateSession($user);
updateSemuaRating();

if (isset($_GET['changenowa'])) {
    $nowa = $_GET['nowa'];
    $nowa = mysqli_real_escape_string($conn, $nowa);
    $nowa = htmlspecialchars($nowa);
    $sid = $_SESSION['id'];
    $query = "UPDATE userdb SET nowa = '$nowa' WHERE randomid = '$sid'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("Location: profile.php");
        exit;
    } else {
        echo "Swal.fire({
            icon: 'error',
            title: 'Gagal mengubah nomor WhatsApp',
            text: 'Silahkan coba lagi'
        })";
    }
}

if (isset($_POST['ubahdata'])) {
    $ress = ubahData($_POST);
    if ($ress) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil mengubah data',
            text: 'Data Anda berhasil diubah'
        }).then(() => {
            window.location.href = 'profile.php';
        })
            </script>";
        exit;
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal mengubah data',
            text: 'Silahkan coba lagi'
        })
            </script>";
    }
}
?>
<?php include 'inc/nav.php' ?>

<section class="akun md:px-16 lg:px-24 2xl:px-36">
    <div class=" w-full min-w-full max-w-full min-h-2 h-fit bg-light-tertiary dark:bg-dark-tertiary bg-opacity-35 dark:bg-opacity-35 px-4 pt-3 pb-4 rounded-lg flex flex-col">
        <h1 class="w-fit h-fit text-2xl md:text-3xl font-bold mb-2">Akun Anda</h1>
        <div class="w-full h-fit flex items-center justify-between">
            <div class="w-full h-fit flex items-center gap-3">
                <div class="w-20 h-20 bg-light-secondary bg-opacity-70 dark:bg-opacity-70 rounded-full flex items-center justify-center">
                    <img class="w-[4.5rem] min-w-[4.5rem] max-w-[4.5rem] min-h-[4.5rem] max-h-[4.5rem] h-[4.5rem] rounded-full aspect-square" src="<?= $_SESSION['gambar'] ?>" alt="<?= $_SESSION['username'] ?>">
                </div>
                <div class="flex flex-col justify-between">
                    <h1 class="text-xl font-bold"><?= $_SESSION['username'] ?></h1>
                    <h2 class="text-sm leading-none mt-0.5"><?= $user['alamat'] ?></h2>
                    <label for="nowa text-lg font-normal mt-2">WhatsApp Anda: </label>
                    <form action="" class="flex gap-3 items-center">
                        <input type="tel" name="nowa" id="nowa" value="<?= $user['nowa'] ?>" class="rounded-md min-h-8 h-8 max-h-8 min-w-40 w-40 max-w-40 px-2 flex items-center bg-light-bg dark:bg-dark-bg dark:bg-opacity-80 shadow-xs">
                        <button type="submit" name="changenowa" class="bg-light-bg dark:bg-dark-bg text-red-700 border border-solid border-red-700 font-bold min-w-[4.5rem] w-[4.5rem] max-w-[4.5rem] h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95 flex items-center justify-center"><i class="text-xl fa-regular fa-pen-to-square"></i> Ganti</button>
                    </form>
                </div>
            </div>
            <a href="logout.php" class="w-10 h-10 min-h-10 max-h-10 min-w-10 max-w-10 aspect-square bg-light-secondary dark:bg-dark-text text-light-bg dark:text-dark-bg bg-opacity-70 dark:bg-opacity-70 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-right-to-bracket"></i>
            </a>
        </div>

    </div>
</section>

<section id="ubahData" class=" mt-10 w-full min-h-5 flex flex-col">
    <div class=" px-3 py-2 rounded-md min-w-full max-w-full min-h-2 bg-light-tertiary dark:bg-dark-tertiary bg-opacity-35 dark:bg-opacity-35 leading-none ">
        <form action="" method="post" class="min-w-full max-w-full min-h-2 flex flex-col">
            <h1 class="text-xl lg:text-2xl font-bold">Ubah Data Anda:</h1>
            <h6 class="text-sm text-yellow-600 dark:text-yellow-400">* Kosongkan jika tidak ingin mengubah salah 1 data</h6>
            <div class="min-w-full max-w-full min-h-2 flex flex-col gap-3">
                <div class="min-w-full max-w-full min-h-2 flex flex-col gap-0">
                    <label for="username" class="text-lg font-bold">Username:</label>
                    <input type="text" name="username" id="username" class="rounded-md min-h-8 h-9 px-3 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Username baru... (<?= $_SESSION['username'] ?>)">
                </div>
                <div class="min-w-full max-w-full min-h-2 flex flex-col gap-0">
                    <label for="password" class="text-lg font-bold">Password:</label>
                    <input type="password" name="password" id="password" class="rounded-md min-h-8 h-9 px-3 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Password baru...">
                </div>
                <div class="min-w-full max-w-full min-h-2 flex flex-col gap-0">
                    <label for="alamat" class="text-lg font-bold">Alamat:</label>
                    <input type="text" name="alamat" id="alamat" class="rounded-md min-h-8 h-9 px-3 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Alamat baru... (<?= $user['alamat'] ?>)">
                </div>
            </div>
            <div class="min-w-full max-w-full min-h-2 mt-5 flex flex-col gap-3">
                <button type="submit" name="ubahdata" class="min-w-40 w-56 max-w-56 min-h-10 max-h-12 text-lg lg:text-xl font-bold rounded-md bg-light-bg dark:bg-dark-bg text-light-secondary dark:text-dark-text shadow-xs hover:scale-95 hover:shadow-none">Ubah Data</button>
            </div>
        </form>
    </div>
</section>

<section id="preview" class=" mt-10 w-full min-h-5 flex flex-col">
    <div class="w-full">
        <h1 class="text-2xl lg:text-[2rem] font-extrabold bg-light-tertiary dark:bg-dark-tertiary bg-opacity-35 dark:bg-opacity-35 leading-none px-3 pb-3 pt-2.5 rounded-md w-fit ">Preview Anda</h1>
    </div>
    <div class="w-full h-fit flex flex-col xl:!flex-row lg:justify-between lg:gap-5 sm:px-7 md:px-14 lg:px-20 xl:px-5 ">
        <div class="flex w-full xl:max-w-[50%] 2xl:max-w-[40%] mt-10 justify-center items-center px-7 xs:px-0">
            <div id="keuangan" class="max-w-full w-full min-w-[10%] min-h-12 px-5 py-3 rounded-md bg-light-tertiary dark:bg-dark-tertiary bg-opacity-35 dark:bg-opacity-35 flex flex-col">
                <div class="w-full">
                    <h1 class="leading-none text-2xl font-bold w-fit h-fit">Keuangan [rupiah]</h1>
                </div>
                <div class="flex flex-col xs:flex-row items-center w-full h-full gap-3 mt-2">
                    <div class="flex w-full xs:min-h-20 bg-light-tertiary dark:bg-dark-tertiary bg-opacity-30 dark:bg-opacity-30 rounded-md py-1">
                        <div class="">
                            <img class="max-w-20 xs:max-w-[4.2rem]" src="img/icon_increase.svg" alt="">
                        </div>
                        <div class="flex flex-col w-full min-h-full items-start relative">
                            <h1 class="text-[1.6rem] xs:text-2xl lg:text-[1.35rem] font-bold leading-none text-[#1E851E] absolute top-2">Pemasukan</h1>
                            <h2 class="font-bold text-xl leading-none absolute bottom-3"><?= formatHarga($user['pemasukan'], 0) ?></h2>
                        </div>
                    </div>
                    <div class="flex w-full xs:min-h-20 bg-light-tertiary dark:bg-dark-tertiary bg-opacity-30 dark:bg-opacity-30 rounded-md py-1">
                        <div class="">
                            <img class="max-w-20 xs:max-w-[4.2rem]" src="img/icon_decrease.svg" alt="">
                        </div>
                        <div class="flex flex-col w-full min-h-full items-start relative">
                            <h1 class="text-[1.6rem] xs:text-2xl lg:text-[1.35rem] font-bold leading-none text-[#D54217] absolute top-2">Pengeluaran</h1>
                            <h2 class="font-bold text-xl leading-none absolute bottom-3"><?= formatHarga($user['pengeluaran'], 0) ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex w-full xl:max-w-[50%] 2xl:max-w-[40%] mt-10 justify-center items-center px-7 xs:px-0">
            <div id="produk" class="max-w-full w-full min-w-[10%] min-h-12 px-5 py-3 rounded-md bg-light-tertiary dark:bg-dark-tertiary bg-opacity-35 dark:bg-opacity-35 flex flex-col">
                <div class="w-full">
                    <h1 class="leading-none text-2xl font-bold w-fit h-fit">Produk [item]</h1>
                </div>
                <div class="flex flex-col xs:flex-row items-center w-full h-full gap-3 mt-2">
                    <div class="flex w-full xs:min-h-20 bg-light-tertiary dark:bg-dark-tertiary bg-opacity-30 dark:bg-opacity-30 rounded-md py-1">
                        <div class="">
                            <img class="max-w-20 xs:max-w-[4.2rem]" src="img/icon_increase.svg" alt="">
                        </div>
                        <div class="flex flex-col w-full min-h-full items-start relative">
                            <h1 class="text-[1.6rem] xs:text-2xl xl:text-[1.35rem] font-bold leading-none text-[#1E851E] absolute top-2">Penjualan</h1>
                            <h2 class="font-bold text-xl leading-none absolute bottom-3"><?= $user['penjualan'] ?></h2>
                        </div>
                    </div>
                    <div class="flex w-full xs:min-h-20 bg-light-tertiary dark:bg-dark-tertiary bg-opacity-30 dark:bg-opacity-30 rounded-md py-1">
                        <div class="">
                            <img class="max-w-20 xs:max-w-[4.2rem]" src="img/icon_decrease.svg" alt="">
                        </div>
                        <div class="flex flex-col w-full min-h-full items-start relative">
                            <h1 class="text-[1.6rem] xs:text-2xl xl:text-[1.35rem] font-bold leading-none text-[#D54217] absolute top-2">Pembelian</h1>
                            <h2 class="font-bold text-xl leading-none absolute bottom-3"><?= $user['pembelian'] ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="min-w-full w-full max-w-full min-h-2 h-fit text-light-secondary dark:text-dark-text bg-light-accent dark:bg-dark-tertiary rounded-md bg-opacity-35 dark:bg-opacity-35 flex flex-col mt-10 pb-5">
    <div class="atas text-2xl font-bold flex justify-between items-center px-5 py-3">
        <h1 class="border-b-[3px] border-light-secondary dark:border-dark-text leading-9">Produk Saya</h1>
        <button onclick="window.location.href='addproduk.php'" class="w-10 h-10 bg-light-text dark:bg-dark-text bg-opacity-90 dark:bg-opacity-90 font-[900] rounded-md text-light-bg dark:text-dark-bg text-3xl shadow-xs shadow-light-text dark:shadow-dark-tertiary hover:scale-105 hover:shadow-none transition-all"><i class="fa-sharp fa-solid fa-plus"></i></button>
    </div>
    <!-- Product card container -->
    <div class="bawah mt-10 sm:px-16 sm:gap-x-6 sm:gap-y-5 md:px-3 md:gap-5 lg:px-3 lg:gap-4 lg:*:w-[31%] xl:px-4 xl:gap-3 min-h-[30vh] xl:*:w-[22%] 2xl:*:w-[18%]  w-full flex flex-wrap gap-2 justify-evenly">
        <!-- -- Product Card -- -->

        <?php $semuaproduk = getAllProdukByRandomId($_SESSION['id']) ?>
        <?php if ($semuaproduk !== false) : ?>
            <?php foreach ($semuaproduk as $produk) : ?>
                <?php $totRate = round(totalRating($produk['produkid'])) ?>

                <div class="bg-light-text dark:bg-dark-text bg-opacity-35 dark:bg-opacity-35 h-64 md:h-80 md:text-2xl p-2 w-[47%] rounded-md relative">
                    <a href="produk.php?produkid=<?= $produk['produkid'] ?>" class="bg-opacity-35 dark:bg-opacity-35 h-full w-full rounded-md">
                        <div class=" w-full h-full">
                            <div class=" max-h-[65%] h-[65%] w-full object-cover object-center ">
                                <img class="object-cover object-center aspect-square rounded-md max-h-full min-w-full" src="img/produk/<?= $produk['gambar'] ?>" alt="<?= $produk['nama'] ?>">
                            </div>
                            <div class="w-full relative my-2 h-[32%] ">
                                <div class=" w-full absolute top-0 *:leading-none flex">
                                    <div class="w-full h-fit flex flex-col max-w-[89%]">
                                        <h1 class="text-light-accent dark:text-dark-text font-bold md:text-lg leading-none truncate max-w-full"><?= $produk['nama'] ?></h1>
                                        <span class="text-sm leading-none"><?= formatHarga($produk['harga']) ?></span>
                                    </div>
                                </div>
                                <div class="absolute bottom-0 w-full">
                                    <span class="text-base text-yellow-500 dark:text-yellow-600">
                                        <?php for ($i = 0; $i < $totRate; $i++) : ?>
                                            <i class="fa-sharp fa-solid fa-star-sharp"></i>
                                        <?php endfor ?>
                                        <?php for ($i = 0; $i < 5 - $totRate; $i++) : ?>
                                            <i class="fa-sharp fa-regular fa-star-sharp"></i>
                                        <?php endfor ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="w-10 min-w-10 max-w-16 max-h-[50%] h-[32%] absolute bottom-0 right-0 z-10 text-light-text dark:text-dark-text">
                        <?php $bookmark = cekWishlist($produk['produkid'], $_SESSION['id']) ?>
                        <a href="wishlist.php?produkid=<?= $produk['produkid'] ?>&<?= $bookmark ? 'hapus' : 'tambah' ?>=&r=<?= rawurlencode($url) ?>" class="absolute right-3 top-0 text-[1.7rem] font-thin"><i class="<?php echo $bookmark ? "fa-solid" : "fa-regular" ?> fa-bookmark"></i></a>
                        <button class="btnProdUtil absolute right-3 bottom-1 text-[1.7rem]"><i class="fa-regular fa-ellipsis"></i></button>
                        <div class="prodUtil absolute -bottom-1 right-12 text-[1.6rem] w-[5.1rem] h-11 hidden items-center rounded-md justify-evenly leading-none text-light-bg bg-light-text dark:bg-dark-text bg-opacity-90 dark:bg-opacity-80 *:bg-opacity-90 dark:*:dark:bg-opacity-80">
                            <span class="absolute border-y-[18px] border-solid border-y-transparent border-l-[15px] border-l-light-text -right-2 z-[-99]"></span>
                            <button onclick="window.location.href='hapusproduk.php?produkid=<?= $produk['produkid'] ?>&r=<?= rawurlencode($url) ?>'" class="text-red-600 hover:scale-105 bg-light-bg dark:bg-dark-bg p-1 rounded-lg"><i class="fa-solid fa-trash"></i></button>
                            <button onclick="window.location.href='editproduk.php?produkid=<?= $produk['produkid'] ?>&r=<?= rawurlencode($url) ?>'" class="text-yellow-500 hover:scale-105 bg-light-bg dark:bg-dark-bg p-1 rounded-lg"><i class="fa-regular fa-pen-to-square"></i></button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="w-full h-64 flex items-center justify-center">
                <h1 class="text-2xl font-bold">Tidak ada produk</h1>
            </div>
        <?php endif; ?>

</section>

<?php include 'inc/foot.php' ?>
<script>
    function toggleClass(element, classList) {
        if (Array.isArray(element)) {
            element.forEach((i) => {
                classList.forEach((j) => {
                    i.classList.toggle(j);
                });
            });
        } else {
            classList.forEach((i) => {
                element.classList.toggle(i);
            });
        }
    }
    const btnProdUtil = document.querySelectorAll('.btnProdUtil');

    btnProdUtil.forEach((btn) => {
        btn.addEventListener('click', () => {
            const prodUtil = btn.parentElement.querySelector('.prodUtil');
            if (prodUtil.classList.contains('hidden')) {
                toggleClass(prodUtil, ['hidden', 'flex']);
            } else {
                toggleClass(prodUtil, ['flex', 'hidden']);
            }
        });
    });
</script>