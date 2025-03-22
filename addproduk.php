<?php include 'inc/head.php' ?>
<?php
session_start();
include 'inc/conn.php';
if (!isSignedIn()) {
    header("Location: signin.php");
    exit;
}

if (isset($_POST['submit'])) {
    // var_dump($_POST);
    $produk = addProduk($_POST);
    if ($produk) {
        echo "<script>
        Swal.fire({
            title: 'Produk berhasil ditambahkan!',
            text: 'Produk anda akan segera ditinjau oleh admin',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = 'index.php';
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Produk gagal ditambahkan!',
            text: 'Silahkan coba lagi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
    }
}

?>
<?php include 'inc/nav.php' ?>


<section class="max-w-full min-w-full xs:px-10 sm:px-24 md:px-28 lg:px-36 xl:px-40 2xl:px-52">
    <form id="formprod" action="" method="post" class="max-w-full min-w-full min-h-3" enctype="multipart/form-data">
        <div class="max-w-full min-w-full min-h-2 flex flex-col px-3 py-4 bg-light-tertiary dark:bg-dark-tertiary bg-opacity-35 dark:bg-opacity-25 rounded-lg relative">
            <div class="atas">
                <button onclick="window.history.back()" class="font-bold absolute"><i class="text-2xl fa-solid fa-arrow-left"></i></button>
                <h1 class="text-lg lg:text-xl font-bold text-center ">Tambahkan Produk Anda!</h1>
            </div>
            <div class="min-w-full max-w-full min-h-2 mt-6 flex flex-col gap-5">
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="namaProd" class="text-lg font-semibold">Nama Produk: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                    <input required type="text" name="namaProd" id="namaProd" class="rounded-md min-h-8 h-9 px-4 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Nama produk anda...">
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="deskProd" class="text-lg font-semibold">Deskripsi Produk: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                    <textarea required name="deskProd" id="deskProd" class="rounded-md min-h-32 px-4 py-2 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Deskripsikan seluruh hal yang berhubungan dengan produk anda..."></textarea>
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="hargaProd" class="text-lg font-semibold">Harga Produk: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                    <input required type="number" name="hargaProd" id="hargaProd" class="rounded-md min-h-8 h-9 px-4 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Harga produk anda...">
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="stokProd" class="text-lg font-semibold">Stok Produk: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                    <input required type="number" name="stokProd" id="stokProd" class="rounded-md min-h-8 h-9 px-4 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Stok produk anda...">
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="diskonProd" class="text-lg font-semibold">Diskon Bawaan: </label>
                    <input required type="text" name="diskonProd" id="diskonProd" class="rounded-md min-h-8 h-9 px-4 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Diskon awal produk anda...">
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="varProd" class="text-lg font-semibold">Varian warna tersedia: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                    <span class="noteProd mb-2 text-yellow-700 dark:text-yellow-300 leading-none">* Masukkan semua jenis varian yang tersedia dari produk ini, seperti warna dan sebagainya!</span>
                    <span class="noteProd mb-2 text-yellow-700 dark:text-yellow-300 leading-none">Gunakan tanda koma (,) sebagai pemisah antar varian!</span>
                    <input required type="text" name="varProd" id="varProd" class="rounded-md min-h-8 h-9 px-4 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="Hitam, Putih, Merah...">
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="ukurProd" class="text-lg font-semibold">Ukuran tersedia: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                    <span class="noteProd mb-2 text-yellow-700 dark:text-yellow-300 leading-none">* Masukkan semua jenis ukuran yang tersedia dari produk ini, seperti warna dan sebagainya!</span>
                    <span class="noteProd mb-2 text-yellow-700 dark:text-yellow-300 leading-none">Gunakan tanda koma (,) sebagai pemisah antar ukuran!</span>
                    <input required type="text" name="ukurProd" id="ukurProd" class="rounded-md min-h-8 h-9 px-4 text-lg bg-light-bg dark:bg-dark-bg dark:bg-opacity-85" placeholder="S, M, XXL...">
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="opsitran" class="text-lg font-semibold">Opsi Transaksi: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                    <span class="noteProd mb-2 text-yellow-700 dark:text-yellow-300 leading-none">* Pilih semua Opsi Transaksi yang tersedia untuk produk ini!</span>
                    <div id="opsitran" class="flex min-w-full max-w-full min-h-3 gap-4 flex-row flex-wrap">
                        <span class="min-w-fit max-w-fit flex items-center gap-1 min-h-fit">
                            <input type="checkbox" name="opstr" id="opsi1" value="0" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 appearance-auto">
                            <label for="opsi1" class="text-lg font-semibold select-none">Temu Tengah</label>
                        </span>
                        <span class="min-w-fit max-w-fit flex items-center gap-1 min-h-fit">
                            <input type="checkbox" name="opstr" id="opsi2" value="1" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 appearance-auto">
                            <label for="opsi2" class="text-lg font-semibold select-none">Aplikasi</label>
                        </span>
                        <span class="min-w-fit max-w-fit flex items-center gap-1 min-h-fit">
                            <input type="checkbox" name="opstr" id="opsi3" value="2" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 appearance-auto">
                            <label for="opsi3" class="text-lg font-semibold select-none">Pengiriman</label>
                        </span>
                        <span class="min-w-fit max-w-fit flex items-center gap-1 min-h-fit">
                            <input type="checkbox" name="opstr" id="opsi4" value="3" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 appearance-auto">
                            <label for="opsi4" class="text-lg font-semibold select-none">Lainnya (wa)</label>
                        </span>
                        <input type="text" name="opsitrans" id="opsitrans" hidden>
                    </div>
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                    <label for="othr" class="text-lg font-semibold">Lainnya:</label>
                    <div class="flex min-w-full max-w-full min-h-3 gap-4 flex-row flex-wrap">
                        <span class="min-w-fit max-w-fit flex items-center gap-1 min-h-fit">
                            <input type="checkbox" name="flashsale" id="flashsale" value="true" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 appearance-auto">
                            <label for="flashsale" class="text-lg font-semibold select-none">Flash Sale</label>
                        </span>
                        <span class="min-w-fit max-w-fit flex items-center gap-1 min-h-fit">
                            <input type="checkbox" name="spectag" id="spectag" value="true" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 appearance-auto">
                            <label for="spectag" class="text-lg font-semibold select-none">Tanda Khusus?</label>
                        </span>
                    </div>
                </div>
                <div class="sect min-w-full max-w-full min-h-2 flex flex-col gap-0 *:m-0 *:*:m-0">
                    <label for="gambarProd" class="text-lg font-semibold">Gambar Produk: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                    <input type="file" name="gambarProd" id="gambarProd" class="text-base font-semibold file:h-9 file:border-none file:outline-none file:rounded-md file:hover:scale-95 file:bg-[#eaddca] bg-light-bg dark:bg-dark-bg dark:bg-opacity-85 px-1 py-1 rounded-t-md rounded-b-md" accept="image/*" onchange="previewImage(event)">
                    <div class="preview min-w-full max-w-full min-h-2 hidden">
                        <div class="gmbr object-cover object-center min-w-full max-w-full p-5 bg-light-bg dark:bg-dark-bg rounded-b-md">
                            <img id="preview" alt="" class=" max-w-full min-w-full rounded-md">
                        </div>
                    </div>
                </div>


                <script>
                    const formprod =document.getElementById('formprod')
                    const opsitran = document.getElementById('opsitran');
                    const opsitrans = document.getElementById('opsitrans');
                    const opsi = opsitran.querySelectorAll('input[name="opstr"]')
                    let opsiVal = [];
                    let dataf, datak;


                    opsi.forEach((ops, i) => {
                        ops.addEventListener('change', () => {
                            if (typeof FormData === undefined) return Swal.fire({
                                title: 'Browser Tidak Mendukung!',
                                text: 'Silahkan gunakan Chrome untuk menggunakan fitur ini',
                                icon: 'error',
                            })

                            dataf = new FormData(formprod)
                            opsiVal = []
                            opsi.forEach((ops, i) => {
                                if (ops.checked) {
                                    opsiVal.push(ops.value)
                                }
                            })
                            datak = opsiVal.join(',')
                            opsitrans.value = datak
                        })
                    })

                    function previewImage(event) {
                        const input = event.target;
                        const preview = document.getElementById('preview');
                        const reader = new FileReader();

                        reader.onload = function() {
                            preview.src = reader.result;
                            preview.parentElement.parentElement.classList.replace("hidden", "block")
                            input.classList.remove('rounded-b-md')
                        };

                        if (input.files && input.files[0]) {
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>
                <!-- <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                        <label for="ukurProd" class="text-lg font-semibold">Gambar Produk: <i class="wajibIsi text-red-700 dark:text-red-600">*</i></label>
                        <span class="noteProd mb-2 text-yellow-700 dark:text-yellow-300 leading-none">* Upload gambar <a href="https://postimages.org/" class="text-blue-700 underline">disini</a> atau klik tombol dibawah</span>
                        <span class="noteProd mb-2 text-yellow-700 dark:text-yellow-300 leading-none">Setelah gambar di-upload, copy DIRECT LINK-nya, lalu paste dikolom di bawah ini!</span>
                        <span class="noteProd mb-2 text-yellow-700 dark:text-yellow-300 leading-none"><a href="https://postimages.org/" class="text-blue-700 underline">Klik disini</a> untuk tutorial mengupload gambar</span>
                        <input required type="text" name="ukurProd" id="ukurProd" class="rounded-md min-h-8 h-9 px-4 text-lg bg-light-bg dark:bg-dark-bg" placeholder="https://i.postimg.cc/aBcdEFgHiJ/abcDefGHIjKlM.jpg">
                        <button type="button" class="bg-light-secondary bg-opacity-70 hover:bg-light-secondary text-light-bg rounded-md px-4 py-1 text-lg font-semibold mt-2 w-fit" onclick="window.open('https://postimages.org/', '', 'width=5000&height=5000')">Upload Disini</button>
                    </div> -->

                <!-- <div class="sect min-w-full max-w-full min-h-2 flex flex-col">
                        <label for="namaProd" class="text-lg font-semibold">Nama Produk: </label>
                        <input required type="text" name="Prod" id="Prod" class="rounded-md min-h-8 h-9 px-4 text-lg bg-light-bg dark:bg-dark-bg" placeholder="Nama produk anda...">
                    </div> -->
                <!-- <span class="noteProd text-yellow-700 dark:text-yellow-300"></span> -->
                <div class="flex min-w-full max-w-full min-h-1 items-center justify-center">
                    <button type="submit" name="submit" class="min-w-40 w-56 max-w-56 min-h-10 max-h-12 text-xl font-bold rounded-md bg-light-bg dark:bg-dark-bg text-light-secondary dark:text-dark-text shadow-xs hover:scale-95 hover:shadow-none">Tambahkan Produk</button>
                </div>
            </div>
        </div>
    </form>

</section>


<?php include 'inc/foot.php' ?>

<script>
    const listUkur = ['xxxs', 'xxs', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl']

    const stokProd = document.getElementById('stokProd');
    const varProd = document.getElementById('varProd');
    const ukurProd = document.getElementById('ukurProd');
    let stokVal = stokProd.value
    let varProdVal = varProd.value
    let ukurProdVal = ukurProd.value


    stokProd.addEventListener('change', () => {
        stokVal = stokProd.value
    })
    varProd.addEventListener('change', () => {
        varProdVal = varProd.value
        let koma = varProdVal.split(',')

        if (koma.length > stokVal) {
            Swal.fire({
                title: 'Varian lebih banyak dari stok!',
                text: 'Pastikan jumlah varian tidak lebih banyak dari stok produk',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }
    })
    ukurProd.addEventListener('change', () => {
        ukurProdVal = ukurProd.value

        

        if (!listUkur.includes(ukurProdVal.toLowerCase())) {
            console.log(ukurProdVal)
            Swal.fire({
                title: 'Ukuran tidak valid',
                text: 'Pastikan ukuran valid: ' + listUkur.join(', ').toUpperCase(),
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }

        let koma = ukurProdVal.split(',')

        if (koma.length > stokVal) {
            Swal.fire({
                title: 'Ukuran lebih banyak dari stok!',
                text: 'Pastikan jumlah ukuran tidak lebih banyak dari stok produk',
                icon: 'error',
                confirmButtonText: 'OK'
            })
        }
    })

    

</script>