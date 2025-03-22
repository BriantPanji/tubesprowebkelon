<?php include 'inc/head.php'; ?>
<?php
session_start();
include 'inc/conn.php';
isSignedIn();

$url = getURL();

?>

<?php
include 'inc/nav.php';
?>

<section class="w-full min-h-[15vh] h-max mb-10 mt-3">
    <!-- <h1 class=" ml-3 text-xl font-semibold">Jenis Sepatu:</h1> -->
    <div class=" px-5 flex flex-wrap gap-4 max-2xl:gap-3.5 justify-evenly md:justify-between md:px-0">
        <a href="cari.php?cari=sneaker" class="flex flex-col items-center justify-center w-14 min-h-14 h-14 lg:h-20 bg-opacity-90 lg:w-20 bg-light-primary  rounded-full shadow-md">
            <img src="img/icon_sneakers.png" alt="Shoes 1" class="min-w-7 w-7 min-h-7 h-7 lg:w-9 lg:h-9 object-cover -mt-[.35rem] mb-[.25rem]">
            <span class="text-[.455rem] lg:text-[.7rem] leading-none font-normal text-light-bg max-w-[80%] max-h-10 text-center">
                <h1 class="overflow-hidden static">Sneakers</h1>
            </span>
        </a>
        <a href="cari.php?cari=running+shoes" class="flex flex-col items-center justify-center w-14 min-h-14 h-14 lg:h-20 bg-opacity-90 lg:w-20 bg-light-primary  rounded-full shadow-md pl-[.2rem]">
            <img src="img/icon_runningshoe.png" alt="Shoes 1" class="min-w-7 w-7 min-h-7 h-7 lg:w-9 lg:h-9 object-cover -mt-[.35rem] mb-[.25rem]">
            <span class="text-[.455rem] lg:text-[.7rem] leading-none font-normal text-light-bg max-w-[80%] max-h-10 text-center flex">
                <h1 class="overflow-hidden static max-w-full text-center">Running Shoes</h1>
            </span>
        </a>
        <a href="cari.php?cari=slip+on" class="flex flex-col items-center justify-center w-14 min-h-14 h-14 lg:h-20 bg-opacity-90 lg:w-20 bg-light-primary  rounded-full shadow-md">
            <img src="img/icon_slipon.png" alt="Shoes 1" class="min-w-7 w-7 min-h-7 h-7 lg:w-9 lg:h-9 object-cover -mt-[.35rem] mb-[.25rem]">
            <span class="text-[.455rem] lg:text-[.7rem] leading-none font-normal text-light-bg max-w-[80%] max-h-10 text-center">
                <h1 class="overflow-hidden pb-[.1rem] static">Slip-On</h1>
            </span>
        </a>
        <a href="cari.php?cari=loafers" class="flex flex-col items-center justify-center w-14 min-h-14 h-14 lg:h-20 bg-opacity-90 lg:w-20 bg-light-primary  rounded-full shadow-md">
            <img src="img/icon_loafers.png" alt="Shoes 1" class="min-w-7 w-7 min-h-7 h-7 lg:w-9 lg:h-9 object-cover -mt-[.35rem] mb-[.25rem]">
            <span class="text-[.455rem] lg:text-[.7rem] leading-none font-normal text-light-bg max-w-[80%] max-h-10 text-center">
                <h1 class="overflow-hidden static">Loafers</h1>
            </span>
        </a>
        <a href="cari.php?cari=boots" class="flex flex-col items-center justify-center w-14 min-h-14 h-14 lg:h-20 bg-opacity-90 lg:w-20 bg-light-primary  rounded-full shadow-md">
            <img src="img/icon_boots.png" alt="Shoes 1" class="min-w-7 w-7 min-h-7 h-7 lg:w-9 lg:h-9 object-cover -mt-[.35rem] mb-[.25rem]">
            <span class="text-[.455rem] lg:text-[.7rem] leading-none font-normal text-light-bg max-w-[80%] max-h-10 text-center">
                <h1 class="overflow-hidden static">Boots</h1>
            </span>
        </a>
        <a href="cari.php?cari=stiletto" class="flex flex-col items-center justify-center w-14 min-h-14 h-14 lg:h-20 bg-opacity-90 lg:w-20 bg-light-primary  rounded-full shadow-md">
            <img src="img/icon_stiletto.png" alt="Shoes 1" class="min-w-7 w-7 min-h-7 h-7 lg:w-9 lg:h-9 object-cover -mt-[.35rem] mb-[.25rem]">
            <span class="text-[.455rem] lg:text-[.7rem] leading-none font-normal text-light-bg max-w-[80%] max-h-10 text-center">
                <h1 class="overflow-hidden static">Stiletto</h1>
            </span>
        </a>
        </a>
        <a href="cari.php?cari=wedges" class="flex flex-col items-center justify-center w-14 min-h-14 h-14 lg:h-20 bg-opacity-90 lg:w-20 bg-light-primary  rounded-full shadow-md">
            <img src="img/icon_wedges.png" alt="Shoes 1" class="min-w-7 w-7 min-h-7 h-7 lg:w-9 lg:h-9 object-cover -mt-[.35rem] mb-[.25rem]">
            <span class="text-[.455rem] lg:text-[.7rem] leading-none font-normal text-light-bg max-w-[80%] max-h-10 text-center">
                <h1 class="overflow-hidden static">Wedges</h1>
            </span>
        </a>
        </a>
        <a href="cari.php?cari=flat+shoes" class="flex flex-col items-center justify-center w-14 min-h-14 h-14 lg:h-20 bg-opacity-90 lg:w-20 bg-light-primary  rounded-full shadow-md">
            <img src="img/icon_flatshoes.png" alt="Shoes 1" class="min-w-7 w-7 min-h-7 h-7 lg:w-9 lg:h-9 object-cover -mt-[.35rem] mb-[.25rem]">
            <span class="text-[.455rem] lg:text-[.7rem] leading-none font-normal text-light-bg max-w-[80%] max-h-10 text-center">
                <h1 class="overflow-hidden static">Flat Shoes</h1>
            </span>
        </a>
        </a>

    </div>
</section>

<!-- Carousel iklan/promosi -->
<section id="carouselContainer" class="min-w-fit w-fit max-w-full min-h-[30vh] max-h-[60vh] flex justify-center items-center rounded-lg">
    <div class=" relative w-fit min-w-fit max-w-full max-h-[inherit] flex justify-center items-center overflow-hidden p-2 rounded-lg">
        <div id="carousel" class=" *:snap-always  min-w-fit w-fit min-h-full max-h-[inherit] flex no-scrollbar overflow-y-hidden overflow-x-auto snap-x snap-mandatory *:block *:mx-0 px-2 gap-2 xl:gap-x-[calc(.5rem_+_2px)] mx-0 rounded-lg *:*:rounded-lg relative">

            <div class=" object-cover object-center w-fit min-w-fit max-h-[inherit] snap-center">
                <img class="object-cover object-center max-w-full max-h-[inherit]" src="img/banner2.jpg" alt="">
            </div>
            <div class=" object-cover object-center w-fit min-w-fit max-h-[inherit] snap-center">
                <img class="object-cover object-center max-w-full max-h-[inherit]" src="img/banner1.jpg" alt="">
            </div>
            <div class=" object-cover object-center w-fit min-w-fit max-h-[inherit] snap-center">
                <img class="object-cover object-center max-w-full max-h-[inherit]" src="img/banner3.jpg" alt="">
            </div>
            <div class=" object-cover object-center w-fit min-w-fit max-h-[inherit] snap-center">
                <img class="object-cover object-center max-w-full max-h-[inherit]" src="img/banner4.jpg" alt="">
            </div>
            <div class=" object-cover object-center w-fit min-w-fit max-h-[inherit] snap-center">
                <img class="object-cover object-center max-w-full max-h-[inherit]" src="img/banner5.jpg" alt="">
            </div>

        </div>
        <div class="">
            <button id="btnScrLeft" class="absolute mx-0 my-auto -mt-5 top-auto z-30 left-5 text-xl w-7 h-7 md:text-3xl md:w-9 md:h-9 text-light-bg bg-light-text dark:bg-dark-text leading-none rounded-full flex items-center justify-center font-bold">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button id="btnScrRight" class="absolute mx-0 my-auto -mt-5 top-auto z-30 right-5 text-xl w-7 h-7 md:text-3xl md:w-9 md:h-9 text-light-bg bg-light-text dark:bg-dark-text leading-none rounded-full flex items-center justify-center font-bold">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>


    </div>
</section>

<section id="flashsale" class="mt-20 no-scrollbar px-10 py-10 bg-light-primary bg-opacity-95 text-light-bg min-h-36 max-h-40 md:min-h-[30vh] max-w-full overflow-y-hidden overflow-x-auto rounded-md flex items-center">
    <div class="leading-none min-w-[25vw] max-w-[25vw] md:min-w-[20%] md:max-w-[20%] xl:min-w-[15%] xl:max-w-[15%] min-h-full h-full flex justify-center items-center">
        <span class="font-bold  leading-none text-xl bg-dark-secondary px-5 pt-2 pb-[.75rem] rounded-lg text-center">Flash Sale</span>
    </div>
    <div class=" py-20 lg:py-10 px-5 mx-5 no-scrollbar min-w-full min-h-full  object-cover flex">
        <div class=" py-10 lg:py-0 pr-5 min-h-full max-h-full min-w-96 ">
            <div class=" *:min-w-64 object-cover object-center max-h-full h-full min-w-[60vw] w-fit py-10 lg:py-0 flex gap-5">

                <?php $products = getFlashsale(25); ?>
                <?php if ($products !== false) : ?>
                    <?php foreach ($products as $product) : ?>
                        <a href="produk.php?produkid=<?= $product['produkid'] ?>" class="object-cover !min-w-64 min-h-full object-center bg-light-secondary rounded-md p-2 flex gap-3">
                            <img class=" object-center h-full w-24 min-w-24 max-w-24 min-h-full max-h-full rounded-lg aspect-square" src="img/produk/<?= $product['gambar'] ?>" alt="<?= $product['nama'] ?>">
                            <div class="relative min-w-[calc(100%-6.6rem)] max-w-[calc(100%-6.6rem)] ">
                                <h1 class="font-semibold text-lg leading-none max-h-fit truncate"><?= ucwords($product['nama']) ?></h1>
                                <?php if ($product['diskon'] > 0) : ?>
                                    <h2 class="text-red-500">Diskon <?= $product['diskon'] ?>%</h2>
                                <?php endif; ?>
                                <div class="absolute bottom-2 min-w-full max-w-full flex flex-col">
                                    <span class="text-[.7rem] line-through leading-none font-normal "><?= formatHarga($product['harga']) ?></span>
                                    <h3 class="text-lg font-bold leading-none min-w-full max-w-full"><?= formatHarga(hitungDiskon($product['harga'], $product['diskon']), 0) ?></h3>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h1 class="text-2xl font-bold text-dark-accent">Tidak ada produk flash sale</h1>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>

<section id="prodlist" class="mt-10 sm:px-6 sm:gap-5 md:px-3 md:gap-5 lg:px-0 lg:*:w-[31%] xl:px-0 min-h-[30vh] xl:*:w-[22%] 2xl:*:w-[18%]  w-full flex flex-wrap gap-2 justify-evenly">

    <?php $semuaproduk = getAllProduk() ?>
    <?php if ($semuaproduk !== false): ?>
        <?php foreach ($semuaproduk as $produk): ?>
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
        <?php endforeach ?>
    <?php else : ?>
        <div class="w-full h-64 flex items-center justify-center">
            <h1 class="text-2xl font-bold">Tidak ada produk</h1>
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

<?php
include 'inc/foot.php';
?>