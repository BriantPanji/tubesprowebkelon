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
    $ratingg = totalRate($_GET['produkid']);
    updateSemuaRating();
    // var_dump($produk);
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
    $penjual = getUserByRandomId($produk['randomid']);

    if (isset($_GET['rateProduk'])) {
        updateRating($_GET['produkid']);
        $rate = rateProduk($_GET);
        if ($rate) {
            echo "<script>
            Swal.fire({
                title: 'Berhasil memberikan rating!',
                text: 'Terima kasih atas rating Anda',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'produk.php?produkid=" . $_GET['produkid'] . "';
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Gagal memberikan rating!',
                text: 'Silahkan coba lagi',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'produk.php?produkid=" . $_GET['produkid'] . "';
            });
            </script>";
        }
    }
} else {
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
}

?>
<?php include 'inc/nav.php' ?>
<script>
    let pesanWhatsapp = 'https://api.whatsapp.com/send?phone=<?= $penjual['nowa'] ?>&text=Beli bang';
</script>
<section class="w-full h-full xs:px-16 sm:px-28 md:px-44 lg:px-14 xl:px-20 2xl:px-36">
    <div class=" min-w-full max-w-full w-full min-h-20 h-full bg-light-tertiary dark:bg-dark-tertiary bg-opacity-25 dark:bg-opacity-25 rounded-lg px-2 lg:px-5 py-1 pb-5">
        <div class="atas min-w-full w-full min-h-3 py-2">
            <button onclick="window.history.back()" class="font-bold "><i class="text-3xl fa-solid fa-arrow-left"></i></button>
        </div>
        <div class="max-w-full min-w-full w-full h-fit min-h-2 flex flex-col">
            <div class="min-w-full max-w-full w-full flex flex-col lg:flex-row lg:gap-8 ">
                <div class="gambar lg:max-w-[30%]">
                    <img class="w-full max-w-full lg:max-w-full min-w-full aspect-square object-cover rounded-lg" src="img/produk/<?= $produk['gambar'] ?>" alt="<?= $produk["produkid"] ?>">
                </div>
                <div class="detail px-1 pb-5 lg:min-w-[70%] lg:max-w-[70%]">
                    <div class="harga max-w-[70%] flex mt-2">
                        <h1 id="harganya" class="text-2xl font-bold text-light-secondary dark:text-dark-text">Rp 0</h1>
                        <h6 id="aslinya" class="place-content-end ml-1 text-sm text-light-text dark:text-dark-text opacity-80 line-through">Rp 0</h6>
                        <span class="place-content-center text-base ml-2 bg-red-600 bg-opacity-20 dark:bg-opacity-20 text-red-800 dark:text-red-600 px-1.5 rounded-md font-medium hover:scale-105"><?= $produk['diskon'] ?>%</span>
                    </div>
                    <div class="info min-w-full max-w-full min-h-2 h-fit flex mt-2 gap-1.5 relative">
                        <div class="max-w-full min-h-2 h-fit flex flex-col">
                            <h1 class="text-lg max-w-[82%] font-medium text-justify leading-[1.25]"><?= $produk["nama"] ?></h1>
                            <div class="moreInfo w-full min-w-full max-w-full min-h-2 mt-1.5 overflow-hidden">
                                <div class="min-w-full min-h-2 max-h-11 h-11 no-scrollbar flex items-center gap-4 overflow-x-auto overflow-y-hidden *:cursor-default">
                                    <span class="text-base min-w-[4.5rem] max-w-[4.5rem] max-h-5 min-h-2 h-5 flex items-center ">Terjual: <?= $produk["jlhterjual"] ?></span>
                                    <span id="rating" class="text-xl bg-light-bg dark:bg-dark-bg bg-opacity-30 hover:bg-opacity-30 dark:bg-opacity-30 hover:dark:bg-opacity-30 hover:scale-95 min-w-24 max-w-24 w-24 min-h-fit h-10 max-h-10 flex items-center justify-center rounded-lg">
                                        <i class="text-yellow-400 text-2xl fa-sharp fa-solid fa-star-sharp"></i>
                                        <h1 class="font-bold text-lg ml-2"><?= $ratingg['total'] ?></h1>
                                        <h6 class="font-normal text-base ml-1">(<?= $ratingg['count'] ?>)</h6>
                                    </span>
                                    <?php if (strToBool($produk['flashsale'])) : ?>
                                        <span id="rating" class="text-xl bg-light-bg dark:bg-dark-bg bg-opacity-30 hover:bg-opacity-30 dark:bg-opacity-30 hover:dark:bg-opacity-30 hover:scale-95 min-w-[8.5rem] max-w-36 min-h-fit h-10 max-h-10 flex items-center justify-center rounded-lg">
                                            <i class="text-emerald-600 text-2xl fa-solid fa-badge-percent"></i>
                                            <h1 class="font-bold text-base ml-2">Flash Sale</h1>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (strToBool($produk['specialtag'])) : ?>
                                        <span id="rating" class="text-xl bg-light-bg dark:bg-dark-bg bg-opacity-30 hover:bg-opacity-30 dark:bg-opacity-30 hover:dark:bg-opacity-30 hover:scale-95 min-w-[9.5rem] max-w-[9.5rem] min-h-fit h-10 max-h-10 flex items-center justify-center rounded-lg">
                                            <i class="text-cyan-700 text-2xl fa-solid fa-tags"></i>
                                            <h1 class="font-bold text-base ml-2">Tanda Khusus</h1>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-[18%] max-w-[18%] h-fit flex flex-row justify-center absolute -top-4 -right-1">
                            <?php $bookmark = cekWishlist($produk['produkid'], $_SESSION['id']) ?>
                            <a href="wishlist.php?produkid=<?= $produk['produkid'] ?>&<?= $bookmark ? 'hapus' : 'tambah' ?>=&r=<?= rawurlencode($url) ?>" class="text-4xl font-thin text-red-700"><i class="<?= $bookmark ? "fa-solid" : "fa-regular" ?> fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="desc w-full min-h-5 flex flex-col mt-5 transition-all">
                        <div class="dropDesc w-full max-h-10 transition-all overflow-hidden relative">
                            <h1 class=" text-xl font-bold leading-none">Deskripsi Produk:</h1>
                            <p class="text-justify mt-1 text-base"><?= nl2br($produk["deskripsi"]) ?></p>
                        </div>
                        <div class="min-w-full flex items-center justify-center">
                            <button class="text-sm font-medium mt-2 bg-light-bg dark:bg-dark-bg bg-opacity-50 dark:bg-opacity-50 px-4 py-1 rounded-xl">Lihat Selengkapnya</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full min-w-full max-w-full">

                <div class="penjual w-full min-h-5 flex mt-5 gap-2 items-center">
                    <div class="w-[20%] xl:w-[15%] 2xl:w-[15%] 2xl:h-[15%] h-full flex items-center justify-center">
                        <img class="w-16 h-16 lg:!h-28 lg:!w-28 rounded-full aspect-square object-center" src="<?= $penjual['gambar'] ?>" alt="Gambar Penjual">
                    </div>
                    <div class="w-[80%] xl:w-[85%] 2xl:w-[90%] h-full flex flex-col justify-center">
                        <h1 class="text-lg font-bold min-w-full max-w-full truncate"><?= ucwords($penjual['username']) ?></h1>
                        <div class="min-w-full max-w-full w-fit flex items-center max-h-10 overflow-hidden  no-scrollbar">
                            <h6 class="text-sm min-w-full w-fit overflow-x-auto overflow-y-hidden text-nowrap no-scrollbar"><i class=" text-emerald-700 fa-solid fa-location-dot text-base"></i> <?= $penjual['alamat'] != '' ? ucwords($penjual['alamat']) : 'Error' ?></h6>
                        </div>
                        <span class="text-sm font-medium leading-none"><a href="https://wa.me/<?= $penjual["nowa"] ?>"><i class="text-green-600 text-lg fa-brands fa-whatsapp"></i> <?= olahTelp($penjual['nowa']); ?></a></span>
                    </div>
                </div>
                <div class="opsiTransaksi min-h-3 min-w-full max-w-full mt-5">
                    <h1 class="text-xl font-bold mb-1">Opsi Transaksi:</h1>
                    <ul class="pl-3 w-full text-lg font-medium list-disc *:cursor-default">
                        <?php
                        $opsi = olahOpsiTransaksi($produk['opsitransaksi']);
                        if ($opsi[0] !== "Tidak diketahui") {
                            foreach ($opsi as $key => $val) {
                                $val = explode('|', $val);
                                echo "<li class='flex w-full max-w-full items-center gap-2'><i class='w-6 fa-solid $val[0]'></i> <span>$val[1]</span></li>";
                            }
                        } else {
                            echo "<li class='flex w-full max-w-full items-center gap-2'><i class='w-6 fa-solid fa-info-circle'></i> <span>Informasi transaksi tidak tersedia</span></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="varian min-w-full max-w-full min-h-4 mt-5 flex flex-col">
                    <h1 class="text-xl font-bold mb-1">Varian:</h1>
                    <div class="max-w-full min-w-full min-h-3 no-scrollbar text-md font-medium">
                        <div class="min-w-full min-h-4 no-scrollbar overflow-x-auto overflow-y-hidden flex gap-4">
                            <?php
                            $varian = explode(',', $produk['warna']);
                            foreach ($varian as $key => $val) {
                                echo "<span class='bg-light-bg dark:bg-dark-bg hover:scale-105 bg-opacity-50 dark:bg-opacity-50 text-light-secondary dark:text-dark-text min-w-20 w-20 max-w-20 min-h-2 h-9 max-h-9 truncate flex items-center justify-center rounded-lg'>" . ucwords($val) . "</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <h1 class=" text-md font-bold mt-4 hover:scale-105 bg-light-bg dark:bg-dark-bg bg-opacity-60 dark:bg-opacity-60 min-w-44 max-w-56 h-9 flex items-center justify-center gap-2 rounded-lg"><i class="text-amber-600 fa-solid fa-shoe-prints"></i> Ukuran: <i class="font-medium italic"><?= strtoupper($produk['ukuran']) ?></i></h1>
                    <h1 class="text-md font-bold mt-2 hover:scale-105 bg-light-bg dark:bg-dark-bg bg-opacity-60 dark:bg-opacity-60 min-w-40 max-w-40 h-9 flex items-center justify-center gap-2 rounded-lg"><i class="text-green-700 fa-solid fa-boxes-stacked"></i> Stok: <i class="font-medium italic"><?= $produk['stok'] > 999 ? "999+" : $produk['stok'] ?></i></h1>
                </div>
                <div class="rating mt-5 min-w-full max-w-full">
                    <h1 class="text-xl font-bold">Rating:</h1>
                    <form action="" method="get" class="w-full max-w-full min-w-full flex flex-col items-center gap-3">
                        <?php
                        $rating = isRated($_GET['produkid'], $_SESSION['id']);
                        $rate = $_SESSION['id'] === $produk['randomid'] ? true : false;
                        ?>
                        <?php if ($rate !== false): ?>
                            <h1 class='text-lg font-medium'>Anda tidak dapat memberikan rating untuk produk Anda sendiri</h1>
                        <?php elseif ($rating !== false): ?>
                            <h1 class='text-lg font-medium'>Anda sudah memberikan rating sebesar <?= $rating ?> Bintang</h1>
                        <?php else: ?>

                            <div id="ratingan" class="flex max-w-full min-w-full justify-center">
                                <input type="radio" name="rating" id="rating1" class="hidden" value="1">
                                <label for="rating1" class="labelRating text-4xl text-yellow-500"><i class="fa-light fa-star-sharp"></i></label>
                                <input type="radio" name="rating" id="rating2" class="hidden" value="2">
                                <label for="rating2" class="labelRating text-4xl text-yellow-500"><i class="fa-light fa-star-sharp"></i></label>
                                <input type="radio" name="rating" id="rating3" class="hidden" value="3">
                                <label for="rating3" class="labelRating text-4xl text-yellow-500"><i class="fa-light fa-star-sharp"></i></label>
                                <input type="radio" name="rating" id="rating4" class="hidden" value="4">
                                <label for="rating4" class="labelRating text-4xl text-yellow-500"><i class="fa-light fa-star-sharp"></i></label>
                                <input type="radio" name="rating" id="rating5" class="hidden" value="5">
                                <label for="rating5" class="labelRating text-4xl text-yellow-500"><i class="fa-light fa-star-sharp"></i></label>
                                <input type="text" name="produkid" id="produkid" value="<?= $_GET['produkid'] ?>" hidden>
                            </div>
                            <button type="submit" name="rateProduk" class="text-base font-medium bg-light-bg dark:bg-dark-bg w-20 min-w-20 max-w-20 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">Submit</button>
                        <?php endif ?>
                    </form>
                </div>
                <script>
                    let rating = document.getElementById('ratingan');
                    let radios = rating.querySelectorAll('input[type="radio"]');
                    let labels = rating.querySelectorAll('.labelRating');

                    radios.forEach((radio, i) => {
                        radio.addEventListener('click', () => {
                            labels.forEach((labels, j) => {
                                if (j <= i) {
                                    if (radio.checked) {
                                        labels.children[0].classList.replace('fa-light', 'fa-solid');
                                    } else {
                                        labels.children[0].classList.replace('fa-solid', 'fa-light');
                                    }
                                } else {
                                    labels.children[0].classList.replace('fa-solid', 'fa-light');
                                }
                            });
                        });
                    });
                </script>
                <div class="aksi min-w-full max-w-full min-h-2 mt-10 bg-light-bg dark:bg-dark-bg bg-opacity-20 dark:bg-opacity-20 px-4 py-3 rounded-lg">
                    <h1 class="text-xl font-bold mb-5">Pembelian:</h1>
                    <form action="checkout.php" method="get">
                        <div class="min-w-full max-w-full min-h-2 flex flex-col">
                            <div class="flex items-center gap-4">
                                <label for="jumlah" class="text-lg font-bold">Jumlah:</label>
                                <input type="number" name="jumlah" id="jumlah" class="bg-light-bg dark:bg-dark-bg bg-opacity-50 dark:bg-opacity-50 text-lg font-bold w-16 h-9 rounded-lg px-2 py-1" min="1" max="10" value="1">
                            </div>
                            <div class="flex flex-col">
                                <label for="pesan" class="text-lg font-bold">Pesan:</label>
                                <textarea onchange="pesanWhatsapp = `https://api.whatsapp.com/send?phone=628&text=${this.value}`" name="pesan" id="pesan" class="no-scrollbar bg-light-bg dark:bg-dark-bg bg-opacity-70 dark:bg-opacity-70 max-w-full min-w-full min-h-10 rounded-md px-3 py-2 text-lg font-medium placeholder:font-normal placeholder:text-light-secondary placeholder:dark:text-dark-accent dark:text-dark-accent placeholder:text-opacity-50 placeholder:dark:text-opacity-50" placeholder="Tulis semua pesan kamu disini! (Ukuran, Varian, dsb)"></textarea>
                            </div>
                            <div class="mt-3 tmbl w-full min-w-full max-w-full flex flex-col lg:flex-row lg:gap-5 gap-3">
                                <div class=" text-md font-medium w-52 min-w-52 max-w-52 h-10 max-h-10 min-h-10 flex items-center justify-center leading-none rounded-md bg-light-bg dark:bg-dark-bg shadow-xs hover:shadow-none hover:scale-95"><button id="toWa" class="flex gap-1.5 items-center justify-between" onclick="window.open(pesanWhatsapp, '_blank')"><i class="!p-0 text-emerald-700 text-2xl fa-brands fa-whatsapp"></i> Beli di WhatsApp</button></div>
                                <div class=" text-md font-medium w-52 min-w-52 max-w-52 h-10 max-h-10 min-h-10 flex items-center justify-center leading-none rounded-md bg-light-secondary dark:bg-dark-text text-light-bg dark:text-dark-bg shadow-xs shadow-slate-300 hover:shadow-none hover:scale-95"><button class="flex gap-1.5 items-center justify-between" type="submit" name="submit"><i class="!p-0 text-light-bg dark:text-dark-bg text-2xl fa-solid fa-user-tie"></i> Beli di SellPatu</button></div>
                                <div class=" text-md font-medium w-52 min-w-52 max-w-52 h-10 max-h-10 min-h-10 flex items-center justify-center leading-none rounded-md bg-light-bg dark:bg-dark-bg text-light-secondary dark:text-dark-accent shadow-xs hover:shadow-none hover:scale-95"><button class="flex gap-1.5 items-center justify-between" type="submit" name="cart"><i class="!p-0 text-red-700 text-2xl fa-solid fa-cart-circle-plus"></i> Tambah ke Keranjang</button></div>
                            </div>
                            <input type="text" name="produkid" id="produkid" hidden value="<?= $produk['produkid'] ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'inc/foot.php' ?>

<script>
    let formatHarga = (new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    })).format;
    const dropDesc = document.querySelector('.dropDesc');
    const btnDesc = document.querySelector('.desc button');
    btnDesc.addEventListener('click', () => {
        if (dropDesc.classList.contains('max-h-10')) {
            btnDesc.innerText = 'Tutup Deskripsi';
        } else {
            btnDesc.innerText = 'Lihat Selengkapnya';
        }
        dropDesc.classList.toggle('max-h-10');
    });

    const harganye = document.getElementById('harganya');
    const aslinya = document.getElementById('aslinya');

    window.addEventListener('load', () => {
        harganye.innerText = formatHarga(persenHarga(<?= $produk['harga'] ?>, <?= $produk["diskon"] ?>).hasil);
        aslinya.innerText = formatHarga(<?= $produk['harga'] + 1000 ?>);
    });
</script>