<?php include 'inc/head.php' ?>
<?php
session_start();
include 'inc/conn.php';
isSignedIn();


$url = getURL();

$order = 'ASC';
$sortedby = 'nama';
$cari = '';
$query = '';
if (isset($_GET['cari'])) {
    $cari = urldecode($_GET['cari']);
    if (isset($_GET['order']))
        $order = $_GET['order'];

    if (isset($_GET['sortby'])) {

        if ($_GET['sortby'] == 'harga') {
            $sortedby = 'harga';
            $query = "SELECT * FROM produk WHERE nama LIKE '%$cari%'
        OR deskripsi LIKE '%$cari%'
        OR produkid LIKE '%$cari%'
        OR gambar LIKE '%$cari%'
        ORDER BY harga " . $order;


        } elseif ($_GET['sortby'] == 'rating') {
            $sortedby = 'rating';
            $query = "SELECT * FROM produk WHERE nama LIKE '%$cari%'
        OR deskripsi LIKE '%$cari%'
        OR produkid LIKE '%$cari%'
        OR gambar LIKE '%$cari%'
        ORDER BY rating " . $order;


        } else {
            $query = "SELECT * FROM produk WHERE nama LIKE '%$cari%'
        OR deskripsi LIKE '%$cari%'
        OR produkid LIKE '%$cari%'
        OR gambar LIKE '%$cari%'
        ORDER BY nama " . $order;


        }
    } else {
        $query = "SELECT * FROM produk WHERE nama LIKE '%$cari%'
        OR deskripsi LIKE '%$cari%'
        OR produkid LIKE '%$cari%'
        OR gambar LIKE '%$cari%'
        ORDER BY nama " . $order;
    }

    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
} else {
    $sortedby = 'random';
    $query = "SELECT * FROM produk";
    $query .= " ORDER BY RAND()";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}

?>
<?php include 'inc/nav.php' ?>
<?php $isasc = $order === "ASC" ? true : false ?>
<section class="sortby min-w-full max-w-full min-h-2 absolute top-[4.5rem] left-0 flex justify-center">
    <div class="w-fit min-h-3 flex justify-center items-center bg-light-tertiary dark:bg-dark-tertiary bg-opacity-75 dark:bg-opacity-75 text-light-bg dark:text-dark-bg rounded-b-md px-5 py-2 gap-4">
        <a href="cari.php?cari=<?= $cari ?>&sortby=harga&order=<?= !$isasc ? 'ASC' : 'DESC' ?>" class="flex gap-2 items-center justify-center bg-light-secondary dark:bg-dark-text  min-w-16 w-24 max-w-24 min-h-8 rounded-md hover:scale-95"><span class="leading-none font-semibold">Harga</span><i class="fa-regular <?= $sortedby === 'harga' ? ($isasc ? 'fa-arrow-up-long' : 'fa-arrow-down-long') : 'fa-arrow-up-arrow-down' ?>"></i></a>
        <a href="cari.php?cari=<?= $cari ?>&sortby=nama&order=<?= !$isasc ? 'ASC' : 'DESC' ?>" class="flex gap-2 items-center justify-center bg-light-secondary dark:bg-dark-text  min-w-16 w-24 max-w-24 min-h-8 rounded-md hover:scale-95"><span class="leading-none font-semibold">Nama</span><i class="fa-regular <?= $sortedby === 'nama' ? ($isasc ? 'fa-arrow-up-long' : 'fa-arrow-down-long') : 'fa-arrow-up-arrow-down' ?>"></i></a>
        <a href="cari.php?cari=<?= $cari ?>&sortby=rating&order=<?= !$isasc ? 'ASC' : 'DESC' ?>" class="flex gap-2 items-center justify-center bg-light-secondary dark:bg-dark-text  min-w-16 w-24 max-w-24 min-h-8 rounded-md hover:scale-95"><span class="leading-none font-semibold">Rating</span><i class="fa-regular <?= $sortedby === 'rating' ? ($isasc ? 'fa-arrow-up-long' : 'fa-arrow-down-long') : 'fa-arrow-up-arrow-down' ?>"></i></a>
    </div>
</section>

<section id="prodlist" class="mt-20 xs:px-8 sm:px-10 sm:gap-5 md:px-14 md:gap-5 lg:px-16 xl:px-20 lg:*:w-[31%] min-h-[30vh] xl:*:w-[22%] 2xl:*:w-[18%] 2xl:px-20 w-full flex flex-wrap gap-2 justify-evenly">

    <?php if ($count > 0): ?>
        <?php foreach ($products as $produk): ?>
            <?php $totRate = round(totalRating($produk['produkid'])) ?>
            <div class="bg-light-text dark:bg-dark-text bg-opacity-35 dark:bg-opacity-35 h-64 md:h-80 md:text-2xl p-2 w-[47%] rounded-md relative">
                <a href="produk.php?produkid=<?= $produk['produkid'] ?>" class="bg-opacity-35 dark:bg-opacity-35 h-full w-full rounded-md">
                    <div class=" w-full h-full">
                        <div class=" max-h-[65%] h-[65%] w-full object-cover object-center ">
                            <img class="object-cover object-center aspect-square rounded-md max-h-full min-w-full" src="img/produk/<?= $produk['gambar'] ?>" alt="<?= $produk['nama'] ?>">
                        </div>
                        <div class="w-full relative my-2 h-[32%] ">
                            <div class=" w-full absolute px-[.3rem] top-0 *:leading-none flex">
                                <div class="leading-none flex flex-col justify-start items-start max-w-[90%]">
                                    <h1 class="max-w-full text-light-accent dark:text-dark-accent font-bold md:text-lg leading-none truncate"><?= $produk['nama'] ?></h1>
                                    <span class="text-sm font-medium leading-none"><?= formatHarga($produk['harga']) ?></span>
                                </div>
                            </div>
                            <div class="absolute bottom-0 w-full">
                                <span class="text-base text-yellow-600">
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
                    <?php
                    if (isset($_SESSION['id'])) {
                        $bookmark = cekWishlist($produk['produkid'], $_SESSION['id']);
                        $link = "wishlist.php?produkid=" . $produk['produkid'] . "&" . ($bookmark ? "hapus" : "tambah") . "&r=" . rawurlencode($url);
                    } else {
                        $bookmark = false;
                        $link = "signin.php";
                    }
                    ?>
                    <a href="<?= $link ?>" class="absolute right-3 top-0 text-[1.7rem] font-thin"><i class="<?php echo $bookmark ? "fa-solid" : "fa-regular" ?> fa-bookmark"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="min-w-full h-full flex justify-center items-center">
            <h1 class="text-2xl font-bold text-light-accent dark:text-dark-accent w-max">Produk tidak ditemukan</h1>
        </div>
    <?php endif; ?>
</section>

<script>
    // const sleep = (delay) => new Promise((resolve) => setTimeout(resolve, delay))
    let carouselContainer = document.getElementById('carouselContainer');
    let carousel = document.getElementById('carousel');
    let leftCarButton = carouselContainer.querySelector("#btnScrLeft")
    let rightCarButton = carouselContainer.querySelector("#btnScrRight")
    document.addEventListener('DOMContentLoaded', async function() {


        const slideWidth = carousel.querySelector('div').clientWidth + 16; // Adjust for gap

        leftCarButton.addEventListener('click', () => {
            carousel.scrollBy({
                left: -slideWidth,
                behavior: 'smooth'
            });
        });

        rightCarButton.addEventListener('click', () => {
            carousel.scrollBy({
                left: slideWidth,
                behavior: 'smooth'
            });
        });
    });
</script>
<?php include 'inc/foot.php' ?>