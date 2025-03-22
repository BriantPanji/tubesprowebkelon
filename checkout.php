<?php include 'inc/head.php' ?>
<?php
session_start();
include 'inc/conn.php';

if (!isSignedIn()) {
    header("Location: signin.php");
    exit;
}

if (isset($_GET['produkid'])) {
    $produk = getProduk($_GET['produkid']);
    $jlhpsn = $_GET['jumlah'];
    $pesan = $_GET['pesan'];
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
    }
    $penjual = getUserByRandomId($produk['randomid']);
    $pembeli = getUserByRandomId($_SESSION["id"]);
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
<section class="w-full h-full xs:px-16 sm:px-28 md:px-44 lg:px-14 xl:px-20 2xl:px-36">
    <div class=" min-w-full max-w-full w-full min-h-20 h-full bg-light-tertiary dark:bg-dark-tertiary bg-opacity-25 dark:bg-opacity-25 rounded-lg px-2 lg:px-5 py-1 pb-5">
        <div class="atas min-w-full w-full min-h-3 py-2 flex items-center gap-4">
            <button onclick="window.history.back()" class="font-bold "><i class="text-3xl fa-solid fa-arrow-left"></i></button>
            <h1 class="font-bold text-2xl bg-light-bg dark:bg-dark-bg bg-opacity-65 dark:bg-opacity-65 px-5 py-1.5 flex items-center rounded-lg hover:scale-95 transition-all">Checkout</h1>
        </div>
        <div class="max-w-full min-w-full w-full h-fit min-h-2 flex flex-col">
            <div class="min-w-full max-w-full w-full flex flex-col lg:flex-row lg:gap-8 transition-all">
                <div class="gambar lg:max-w-[30%]">
                    <img class="w-full max-w-full min-w-full aspect-square object-cover rounded-lg" src="img/produk/<?= $produk["gambar"] ?>" alt="<?= $produk["nama"] ?>">
                </div>
                <div class="detail px-1 pb-5 min-w-[70%] max-w-[70%]">
                    <div class="harga max-w-full flex mt-2">
                        <h1 id="harganya" class="text-2xl font-bold text-light-secondary dark:text-dark-text">Rp 0</h1>
                        <h6 id="aslinya" class="place-content-end ml-1 text-sm text-light-text dark:text-dark-text opacity-80 line-through">Rp 0</h6>
                        <span class="place-content-center text-base ml-2 bg-red-600 bg-opacity-20 dark:bg-opacity-20 text-red-800 dark:text-red-600 px-1.5 rounded-md font-medium hover:scale-105"><?= $produk["diskon"] ?>%</span>
                    </div>
                    <div class="info max-w-full min-h-2 h-fit flex mt-2 gap-1.5 relative">
                        <div class="max-w-full min-h-2 h-fit flex flex-col">
                            <h1 class="text-lg max-w-full font-medium text-justify leading-[1.25]"><?= $produk["nama"] ?></h1>
                        </div>
                    </div>
                    <div class="desc w-full min-h-5 flex flex-col mt-5 transition-all">
                        <div class="dropDesc w-full max-h-10 transition-all overflow-hidden relative lg:pr-5">
                            <h1 class=" text-lg font-bold leading-none">Deskripsi Produk:</h1>
                            <p class="text-justify mt-1 text-base"><?= nl2br($produk["deskripsi"]) ?></p>
                        </div>
                        <div class="min-w-full flex items-center justify-center">
                            <button class="text-sm font-medium mt-2 bg-light-bg dark:bg-dark-bg bg-opacity-50 dark:bg-opacity-50 px-4 py-1 rounded-xl">Lihat Selengkapnya</button>
                        </div>
                    </div>
                    <script>
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
                    </script>

                </div>
            </div>
            <div class="w-full min-w-full max-w-full">

                <div class="penjual w-full min-h-5 flex mt-5 gap-2 items-center">
                    <div class="w-[20%] xl:w-[15%] 2xl:w-[15%] 2xl:h-[15%]  h-full flex items-center justify-center">
                        <img class="w-16 h-16 lg:h-28 lg:w-28 rounded-full aspect-square object-center" src="<?= $penjual['gambar'] ?>" alt="Gambar Penjual">
                    </div>
                    <div class="w-[80%] xl:w-[85%] 2xl:w-[90%] h-full flex flex-col justify-center">
                        <h1 class="text-lg font-bold min-w-full max-w-full truncate"><?= ucwords($penjual['username']) ?></h1>
                        <div class="min-w-full max-w-full w-fit flex items-center max-h-10 overflow-hidden  no-scrollbar">
                            <h6 class="text-sm min-w-full w-fit overflow-x-auto overflow-y-hidden text-nowrap no-scrollbar"><i class=" text-emerald-700 fa-solid fa-location-dot text-base"></i> <?= $penjual['alamat'] != '' ? ucwords($penjual['alamat']) : 'Error' ?></h6>
                        </div>
                        <span class="text-sm font-medium leading-none"><a href="https://wa.me/<?= $penjual["nowa"] ?>"><i class="text-green-600 text-lg fa-brands fa-whatsapp"></i> <?= olahTelp($penjual['nowa']); ?></a></span>
                    </div>
                </div>
                <div class="varian min-w-full max-w-full min-h-4 mt-5 flex flex-col">
                    <h1 class="text-xl font-bold mb-1">Varian Tersedia:</h1>
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
                    <h1 class=" text-md font-bold mt-4 hover:scale-105 bg-light-bg dark:bg-dark-bg bg-opacity-60 dark:bg-opacity-60 min-w-44 max-w-56 h-9 flex items-center justify-center gap-2 rounded-lg"><i class="text-amber-600 fa-solid fa-shoe-prints"></i> Ukuran: <i class="font-medium italic"><?= ucwords($produk['ukuran']) ?></i></h1>
                    <h1 class="text-md font-bold mt-2 hover:scale-105 bg-light-bg dark:bg-dark-bg bg-opacity-60 dark:bg-opacity-60 min-w-40 max-w-40 h-9 flex items-center justify-center gap-2 rounded-lg"><i class="text-green-700 fa-solid fa-boxes-stacked"></i> Stok: <i class="font-medium italic"><?= $produk['stok'] > 999 ? "999+" : $produk['stok'] ?></i></h1>
                </div>

                <div class="aksi min-w-full max-w-full min-h-2 mt-10 bg-light-bg dark:bg-dark-bg bg-opacity-20 dark:bg-opacity-20 px-4 py-3 rounded-lg">
                    <h1 class="text-xl font-bold mb-5">Pembelian:</h1>
                    <form action="checkouts.php" method="get" class="flex flex-col gap-3">
                        <div class="min-w-full max-w-full flex flex-col gap-5">
                            <div class="alamat min-w-full max-w-full flex flex-col">
                                <h1 class="text-lg font-bold">Alamat Pengiriman:</h1>
                                <div class="px-4 py-2 rounded-md bg-light-bg dark:bg-dark-bg bg-opacity-40 dark:bg-opacity-40">
                                    <h1 class="nmpenerima font-bold"><i class="fa-solid fa-user text-cyan-700"></i> Penerima: <span class="font-medium text-opacity-85"><?= $pembeli["username"] ?></span></h1>
                                    <h1 class="nmtelp font-bold"><i class="fa-brands fa-whatsapp text-emerald-700"></i> Telepon: <span class="font-medium text-opacity-85"><?= olahTelp($pembeli['nowa']); ?></span></h1>
                                    <div class="max-w-full min-w-full min-h-3">
                                        <h1 class="nmtelp font-bold"><i class="fa-solid fa-location-dot text-yellow-700"></i> Alamat:
                                            <span class="font-medium text-opacity-85 text-justify">
                                                <?= $pembeli['alamat'] != '' ? ucwords($pembeli['alamat']) : 'Error' ?>
                                            </span>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="gratong min-w-full max-w-full">
                                        <h1 class="text-lg font-bold">Gratis Ongkir: <span class="font-medium text-red-600">Tidak tersedia</span></h1>
                                        
                                    </div> -->
                            <div class="voucer min-w-full max-w-full flex flex-col">
                                <h1 class="text-lg font-bold">Voucer: </h1>
                                <span class="vcInfo max-w-full max-h-fit min-w-full text-xs leading-none pl-1 text-yellow-700 dark:text-yellow-300 mb-2  ">* Klik 2x atau arahkan cursor ke voucer untuk melihat potongan maksimum dari masing-masing voucer</span>
                                <div id="voucer" class="min-w-full max-w-full min-h-2 flex">
                                    <div class="flex flex-wrap gap-4 items-center *:transition-all *:cursor-pointer *:*:cursor-pointer *:*:select-none">
                                        <span class=" flex items-center justify-center text-lg font-bold w-fit h-fit p-0 rounded-md hover:scale-95">
                                            <label for="voucer0"><i class="fa-solid text-4xl fa-square-xmark text-red-700 dark:text-red-8 leading-none"></i></label>
                                            <input type="radio" name="voucer" id="voucer0" value="none" hidden>
                                        </span>

                                        <?php
                                        $voucers = getVoucers();

                                        for ($i = 0; $i < count($voucers); $i++) {
                                            $voucer = $voucers[$i];
                                            $maks = $voucer['maks'];
                                            $value = $voucer['value'];
                                            $ispercent = strToBool($voucer['ispercent']) ? "percent" : "money";
                                            $val = strToBool($voucer['ispercent']) ? $voucer['value'] . "%" : "Rp 0";
                                            $klas = strToBool($voucer['ispercent']) ? "" : "labelvcr";
                                            $kode = $voucer['kode'];
                                            $ii = $i + 1;
                                            echo "<span class=\"bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-auto min-w-28 max-w-52 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95\">
                                            <label class=\"$klas mx-2.5\" data-value=\"$value\" for=\"voucer$ii\">$val Off</label>
                                            <input type=\"radio\" data-vcr-maks=\"$maks\" data-vcr-type=\"$ispercent\" data-vcr-value=\"$value\" name=\"voucer\" id=\"voucer$ii\" value=\"$kode\" hidden>
                                            </span>";
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="pembayaran">
                                <h1 class="text-lg font-bold">Metode Pembayaran:</h1>
                                <div id="pembayaran" class="min-w-full max-w-full min-h-2  flex">
                                    <div class="flex flex-wrap gap-4 *:transition-all *:cursor-pointer *:*:cursor-pointer *:*:select-none">
                                        <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-20 min-w-20 max-w-40 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                            <label for="pembayaran1">Dana</label>
                                            <input type="radio" name="pembayaran" id="pembayaran1" value="dana" hidden>
                                        </span>
                                        <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-20 min-w-20 max-w-40 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                            <label for="pembayaran2">Gopay</label>
                                            <input type="radio" name="pembayaran" id="pembayaran2" value="gopay" hidden>
                                        </span>
                                        <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-32 min-w-20 max-w-40 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                            <label for="pembayaran3">ShopeePay</label>
                                            <input type="radio" name="pembayaran" id="pembayaran3" value="shopee" hidden>
                                        </span>
                                        <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-20 min-w-20 max-w-40 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                            <label for="pembayaran4">OVO</label>
                                            <input type="radio" name="pembayaran" id="pembayaran4" value="ovo" hidden>
                                        </span>
                                        <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-20 min-w-20 max-w-40 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                            <label for="pembayaran5">BCA</label>
                                            <input type="radio" name="pembayaran" id="pembayaran5" value="bca" hidden>
                                        </span>
                                        <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-28 min-w-20 max-w-40 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                            <label for="pembayaran6">Indomaret</label>
                                            <input type="radio" name="pembayaran" id="pembayaran6" value="indomaret" hidden>
                                        </span>
                                        <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-20 min-w-20 max-w-40 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                            <label for="pembayaran7">COD</label>
                                            <input type="radio" name="pembayaran" id="pembayaran7" value="cod" hidden>
                                        </span>
                                        <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-52 min-w-20 max-w-52 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                            <label for="pembayaran8">Alfamart / Alfamidi</label>
                                            <input type="radio" name="pembayaran" id="pembayaran8" value="alfa" hidden>
                                        </span>
                                        <!-- <span class="bg-light-bg dark:bg-dark-bg flex items-center justify-center text-lg font-bold w-20 min-w-20 max-w-40 h-8 min-h-8 max-h-8 rounded-md shadow-xs hover:shadow-none hover:scale-95">
                                                    <label for="pembayaran"></label>
                                                    <input type="radio" name="pembayaran" id="pembayaran" value="" hidden>
                                                </span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="min-w-full max-w-full min-h-2 flex flex-col">
                            <div class="flex items-center gap-4">
                                <label for="jumlah" class="text-lg font-bold">Jumlah:</label>
                                <input type="number" name="jumlah" id="jumlah" class="bg-light-bg dark:bg-dark-bg bg-opacity-65 dark:bg-opacity-65 text-lg font-medium w-16 h-9 rounded-lg px-2 py-1" min="1" max="<?= $produk['stok'] ?>" value="<?= $jlhpsn ?>">
                            </div>
                            <div class="flex flex-col">
                                <label for="pesan" class="text-lg font-bold">Pesan:</label>
                                <textarea name="pesan" id="pesan" class="no-scrollbar bg-light-bg dark:bg-dark-bg bg-opacity-70 dark:bg-opacity-70 max-w-full min-w-full min-h-10 rounded-md px-3 py-2 text-lg font-medium placeholder:font-normal placeholder:text-light-secondary placeholder:dark:text-dark-text dark:text-dark-text placeholder:text-opacity-50 placeholder:dark:text-opacity-50" placeholder="Tulis semua pesan kamu disini! (Ukuran, Varian, dsb)"><?= $pesan ?></textarea>
                            </div>
                            <div id="ttlHarga" class="min-w-full max-w-full min-h-2 flex">
                                <h1 class="text-lg font-bold text-red-700 dark:text-red-600">Total Harga:</h1>
                                <h1 class="text-lg font-semibold ml-2 max-w-full"><?= formatHarga($produk['harga']) ?></h1>
                            </div>
                            <button type="submit" name="submit" hidden id="btnSubmit"></button>
                            <div class="mt-3 tmbl w-full min-w-full max-w-full flex flex-col lg:flex-row lg:gap-5 gap-3">
                                <button type="button" onclick="checkout(this)" id="btnSub" class=" text-md font-medium w-52 min-w-52 max-w-52 h-10 max-h-10 min-h-10 flex items-center justify-center leading-none rounded-md bg-light-secondary text-light-bg shadow-xs shadow-slate-300 hover:shadow-none hover:scale-95"><span class="flex gap-1.5 items-center justify-between"><i class="!p-0 text-light-bg text-2xl fa-solid fa-user-tie"></i> Beli sekarang</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'inc/foot.php' ?>

<script>
    const paymentCon = document.getElementById("pembayaran");
    const payments = document.querySelectorAll('input[name="pembayaran"]');
    const labelpays = paymentCon.querySelectorAll('div > span > label');

    labelpays.forEach((label, i) => {
        label.parentElement.addEventListener('click', () => {
            if (!payments[i].checked) {
                payments[i].checked = true;
                labelpays.forEach((lbl, j) => {
                    if (i === j) {
                        lbl.parentElement.classList.replace('bg-light-bg', 'bg-light-secondary');
                        lbl.parentElement.classList.replace('dark:bg-dark-bg', 'dark:bg-dark-text');
                        lbl.parentElement.classList.add('text-light-bg', 'bg-opacity-85', 'dark:text-dark-bg', 'dark:bg-opacity-85');
                    } else {
                        lbl.parentElement.classList.replace('bg-light-secondary', 'bg-light-bg');
                        lbl.parentElement.classList.replace('dark:bg-dark-text', 'dark:bg-dark-bg');
                        lbl.parentElement.classList.remove('text-light-bg', 'bg-opacity-85', 'dark:text-dark-bg', 'dark:bg-opacity-85');
                    }
                })
            }
        })
    })
    let formatHarga = (new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    })).format;

    const voucerCon = document.getElementById("voucer");
    const voucers = document.querySelectorAll('input[name="voucer"]');
    const labelvr = voucerCon.querySelectorAll('div > span > label');
    let vcr, typeVoucer, valueVoucer, maksVoucer;

    voucers.forEach((vc, i) => {
        let maks = parseInt(vc.getAttribute("data-vcr-maks"))

        let hargg = maks == 0 ? "Tidak ada" : (formatHarga(maks)).replace(/ /g, '')
        if (isNaN(maks)) {
            labelvr[i].parentElement.setAttribute("title", "Tombol Clear Voucer")
            return
        }
        labelvr[i].parentElement.addEventListener('dblclick', () => {
            Swal.fire({
                title: "Potongan Maksimum",
                text: "Potongan maksimum dari voucer ini adalah sebesar: " + hargg,
                icon: 'info',
                confirmButtonText: "Oke"
            })
        })
        labelvr[i].parentElement.setAttribute("title", "Maksimum: " + hargg)
    })

    labelvr.forEach((label, i) => {
        label.parentElement.addEventListener('click', () => {
            if (!voucers[i].checked) {
                voucers[i].checked = true;
                labelvr.forEach((lbl, j) => {
                    if (i === j) {
                        if (voucers[i].value === 'none') {
                            vcr = typeVoucer = valueVoucer = undefined;
                            gantiHarga()
                            return
                        }
                        vcr = voucers[i]
                        typeVoucer = vcr.getAttribute("data-vcr-type");
                        valueVoucer = vcr.getAttribute("data-vcr-value");
                        maksVoucer = parseInt(vcr.getAttribute("data-vcr-maks"));
                        gantiHarga()
                        lbl.parentElement.classList.replace('bg-light-bg', 'bg-light-secondary');
                        lbl.parentElement.classList.replace('dark:bg-dark-bg', 'dark:bg-dark-text');
                        lbl.parentElement.classList.add('text-light-bg', 'bg-opacity-85', 'dark:text-dark-bg', 'dark:bg-opacity-85');
                    } else {
                        lbl.parentElement.classList.replace('bg-light-secondary', 'bg-light-bg');
                        lbl.parentElement.classList.replace('dark:bg-dark-text', 'dark:bg-dark-bg');
                        lbl.parentElement.classList.remove('text-light-bg', 'bg-opacity-85', 'dark:text-dark-bg', 'dark:bg-opacity-85');
                    }
                })
            }
            /*  else {
                                    labelvr[i].parentElement.classList.replace('bg-light-secondary', 'bg-light-bg');
                                    labelvr[i].parentElement.classList.remove('text-light-bg', 'bg-opacity-85', 'dark:text-dark-bg', 'dark:bg-opacity-85');
                                    labelvr[i].parentElement.classList.replace('dark:bg-dark-text', 'dark:bg-dark-bg');
                                    return
                                } */
        })
    })

    const totalHarga = document.getElementById("ttlHarga");
    const jumlah = document.getElementById("jumlah");
    const harga = document.querySelector(".harga h1");
    let hrg = <?= $produk['harga']; ?>;




    let ttlHarga;



    jumlah.addEventListener('input', gantiHarga)

    function gantiHarga() {
        hrg = <?= $produk['harga']; ?>;
        console.log(hrg)
        ttlHarga = ((parseInt(jumlah.value) || 0) * hrg)
        if (vcr?.value !== 'none') {
            if (typeVoucer === 'percent') {
                let hrgKurang = (ttlHarga * (parseInt(valueVoucer) / 100));
                if (maksVoucer != 0 && (hrgKurang > maksVoucer)) hrgKurang = maksVoucer
                console.log(hrgKurang)
                ttlHarga -= hrgKurang;
            } else if (typeVoucer === 'money') {
                ttlHarga -= parseInt(valueVoucer)
            }
        }
        totalHarga.children[1].innerText = formatHarga(ttlHarga);
    }

    const harganye = document.getElementById('harganya');
    const aslinya = document.getElementById('aslinya');
    const labelrph = document.querySelectorAll('.labelvcr');

    window.addEventListener('load', () => {
        harganye.innerText = formatHarga(persenHarga(<?= $produk['harga'] ?>, <?= $produk["diskon"] ?>).hasil);
        aslinya.innerText = formatHarga(<?= $produk['harga'] + 1000 ?>);

        labelrph.forEach((lbl, i) => {
            let teks = formatHarga(parseInt(lbl.getAttribute('data-value')))
            teks = teks.replace(",00", "");
            lbl.innerText = teks + " Off";
        })
    });

    async function checkout(ele) {
        const pesan = document.getElementById("pesan");
        const btn = document.getElementById("btnSubmit");
        const btnSub = document.getElementById("btnSub");
        let state = false;
        payments.forEach((pay) => {
            if (pay.checked) {
                state = true;
                return;
            }
        })

        if (!state) {
            console.log(event)
            // event.preventDefault();
            return Swal.fire('Pilih metode pembayaran', "Kamu harus memilih metode pembayaran", 'error')
        }
        if (jumlah.value > <?= $produk['stok'] ?>) {
            return Swal.fire('Jumlah melebihi stok', "Jumlah pesanan tidak boleh melebihi stok yang tersedia", 'error')
        }
        if (pesan.value.length < 1) {
            return Swal.fire({
                title: "Pesan kosong",
                icon: "question",
                text: "Apakah anda yakin ingin melanjutkan pemesanan dengan pesan kosong?",
                showDenyButton: true,
                confirmButtonText: "Ya",
                denyButtonText: "Batalkan",
            }).then(val => {
                if (!val.isConfirmed) return;
                btn.click()
            })
        }
        Swal.fire({
            title: "Pesan",
            icon: "question",
            text: "Apakah anda yakin ingin melanjutkan pemesanan?",
            showDenyButton: true,
            confirmButtonText: "Ya",
            denyButtonText: "Batalkan",
        }).then(val => {
            if (!val.isConfirmed) return;
            btn.click()
        })
    }
</script>