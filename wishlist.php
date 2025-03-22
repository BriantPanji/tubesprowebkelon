<?php include 'inc/head.php' ?>
<?php
session_start();
include 'inc/conn.php';

$url = getURL();

if (isset($_GET['produkid'])) {
    $produkid = $_GET['produkid'];
    $userid = $_SESSION['id'];
    $bookmark = cekWishlist($produkid, $userid);
    if (isset($_GET['tambah'])) {
        if (!$bookmark) {
            tambahWishlist($produkid, $userid);
            if (isset($_GET['r'])) {
                header("Location: " . rawurldecode($_GET['r']));
            } else {
                header("Location: wishlist.php");
            }
        }
    } else if (isset($_GET['hapus'])) {
        if ($bookmark) {
            hapusWishlist($produkid, $userid);
            if (isset($_GET['r'])) {
                header("Location: " . rawurldecode($_GET['r']));
            } else {
                header("Location: wishlist.php");
            }
        }
    }
}


?>
<?php include 'inc/nav.php' ?>


<section class="min-w-full w-full max-w-full min-h-2 h-fit text-light-secondary dark:text-dark-text bg-light-accent dark:bg-dark-tertiary rounded-md bg-opacity-35 dark:bg-opacity-35 flex flex-col mt-10 pb-5">
    <div class="atas text-2xl font-bold flex justify-between items-center px-5 py-3">
        <h1 class="border-b-[3px] border-light-secondary dark:border-dark-text leading-9">Wishlist Saya</h1>
        <button onclick="window.location.href='addproduk.php'" class="w-10 h-10 bg-light-text dark:bg-dark-text bg-opacity-90 dark:bg-opacity-90 font-[900] rounded-md text-light-bg dark:text-dark-bg text-3xl shadow-xs shadow-light-text dark:shadow-dark-tertiary hover:scale-105 hover:shadow-none transition-all"><i class="fa-sharp fa-solid fa-plus"></i></button>
    </div>
    <!-- Product card container -->
    <div class="bawah mt-10 sm:px-16 sm:gap-x-6 sm:gap-y-5 md:px-3 md:gap-5 lg:px-3 lg:gap-4 lg:*:w-[31%] xl:px-4 xl:gap-3 min-h-[30vh] xl:*:w-[22%] 2xl:*:w-[18%]  w-full flex flex-wrap gap-2 justify-evenly">
        <!-- -- Product Card -- -->

        <?php $semuaproduk = getAllWishlist($_SESSION['id']) ?>
        <?php if ($semuaproduk !== false) : ?>
            <?php foreach ($semuaproduk as $prd) : ?>
                <?php $produk = getProduk($prd['produkid']) ?>
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
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="min-w-full flex justify-center items-center">
                <h1 class="text-2xl font-bold text-light-accent dark:text-dark-accent">Tidak ada produk di wishlist</h1>
            </div>

        <?php endif; ?>

</section>



<?php include 'inc/foot.php' ?>