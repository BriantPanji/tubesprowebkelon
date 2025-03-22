<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tubesweb";

$arrayprofil = array(
    "https://i.pinimg.com/1200x/76/c3/3c/76c33c68e2f162707c34522509f790c5.jpg",
    "https://i.pinimg.com/1200x/67/1b/5f/671b5fe7966d42586ee10b404cbf0a51.jpg",
    "https://i.pinimg.com/1200x/55/c1/cb/55c1cb59ef48bc5275816213768f57ce.jpg",
    "https://i.pinimg.com/1200x/19/d9/24/19d92486ebdb16fd4812df6f618f240b.jpg",
    "https://i.pinimg.com/1200x/a5/70/f1/a570f1cc6c7fa144111c39f2aef8879a.jpg",
    "https://i.pinimg.com/1200x/c1/08/6c/c1086c4e4cdcdd93ab91d4cac9d8060f.jpg",
    "https://i.pinimg.com/1200x/99/f7/f2/99f7f2c33234a233954b4c2bdfb4434f.jpg",
    "https://i.pinimg.com/1200x/fa/48/6b/fa486b13a8134912410ceabe799fe515.jpg",
    "https://i.pinimg.com/1200x/f8/41/d2/f841d299b8062218e3789ac478d07153.jpg",
    "https://i.pinimg.com/1200x/c6/52/4b/c6524b9879b9494aef7671531040c4ce.jpg",
);



/*
* List of tables:
* - users: userdb
* - produk: produk
* - voucer: voucer
*/

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

function getURL()
{
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https://";
    else
        $url = "http://";
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    return $url;
}

function getRandom($len)
{
    $ran = random_bytes($len);
    return bin2hex($ran);
}

function strToBool($str)
{
    return $str === "0" ? false : true;
}
function boolToStr($bool)
{
    return $bool ? "1" : "0";
}
function formatHarga($amount, $dec = 2) {
    return "Rp " . number_format($amount, $dec, ',', '.');
};
function olahTelp($str) {
    // Remove any non-digit characters
    $str = preg_replace('/\D/', '', $str);

    // Check if the number starts with '62' and replace it with '+62'
    if (substr($str, 0, 2) === '62') {
        $str = '+62' . substr($str, 2);
    }
    // Format the number to the desired pattern
    $formatted = substr($str, 0, 3) . ' ' . substr($str, 3, 3) . '-' . substr($str, 6, 4) . '-' . substr($str, 10);

    return $formatted;
}
function olahOpsiTransaksi($str) {
    //1: aplikasi, 0: temu tengah, 2:pengiriman, 3: lainnya
    $str = explode(",", $str);
    $str = array_map(function($val) {
        switch ($val) {
            case '0':
                return 'text-teal-700 fa-solid fa-people-arrows|Temu Tengah';
            case '1':
                    return 'text-green-700 fa-solid fa-user-tie|Aplikasi';
            case '2':
                return 'text-yellow-700 fa-solid fa-truck|Pengiriman';
            case '3':
                return 'text-pink-700 fa-solid fa-comments|Lainnya';
            default:
                return 'Tidak diketahui';
        }
    }, $str);
    return $str;
}

function isUserExist($username)
{
    global $conn;
    $sql = "SELECT * FROM userdb WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return true;
    } else {
        return false;
    }
}
function getUserId($username)
{
    global $conn;
    $sql = "SELECT id FROM userdb WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return $row['id'];
    } else {
        return false;
    }
}
function getIdUser($id)
{
    global $conn;
    $sql = "SELECT username FROM userdb WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return $row['username'];
    } else {
        return false;
    }
}
function getUserByRandomId($randomid)
{
    global $conn;
    $sql = "SELECT * FROM userdb WHERE randomid='$randomid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return $row;
    } else {
        return false;
    }
}
function getAllUser() {
    global $conn;
    $sql = "SELECT * FROM userdb ORDER BY isadmin DESC, isbanned ASC";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if ($rows) {
        return $rows;
    } else {
        return false;
    }
}

function isNowaExist($nowa)
{
    global $conn;
    $sql = "SELECT * FROM userdb WHERE nowa='$nowa'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return true;
    } else {
        return false;
    }
}

function isRIdExist($rid)
{
    global $conn;
    $sql = "SELECT * FROM userdb WHERE randomid='$rid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return true;
    } else {
        return false;
    }
}



function signup($data)
{
    global $conn;
    global $arrayprofil;
    $username = strtolower(stripslashes($data["username"]));
    $nowa = $data["nowa"];
    if (substr($nowa, 0, 1) === '0') {
        $nowa = '62' . substr($nowa, 1);
    }
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $conpassword = mysqli_real_escape_string($conn, $data["connpass"]);
    $isbanned = 0;
    $isadmin = 0;
    $randomid = getRandom(5);
    $alamat = $data["alamat"];
    $gambar = $arrayprofil[array_rand($arrayprofil)];

    while (isRIdExist($randomid)) {
        $randomid = getRandom(5);
    }

    if (isUserExist($username)) {
        echo "<script>
        Swal.fire({
            title: 'Username sudah terdaftar!',
            text: 'Silahkan gunakan username lain',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    if (isNowaExist($nowa)) {
        echo "<script>
        Swal.fire({
            title: 'Nomor WA sudah terdaftar!',
            text: 'Silahkan gunakan nomor WA lain',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    if ($password !== $conpassword) {
        echo "<script>
        Swal.fire({
            title: 'Password tidak sama!',
            text: 'Silahkan cek kembali password anda',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }



    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO userdb (username, nowa, password, isbanned, isadmin, randomid, gambar, alamat) VALUES ('$username', '$nowa', '$password', '$isbanned', '$isadmin', '$randomid', '$gambar', '$alamat')";

    mysqli_query($conn, $sql);


    return mysqli_affected_rows($conn);
}

function signin($data) {
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = $data["password"];
    $remember = isset($data["remember"]) ? true : false;

    $sql = "SELECT * FROM userdb WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        if (password_verify($password, $row["password"])) {
            if ($remember) {
                setcookie("id", $row["randomid"], time() + 60 * 60 * 24 * 30);
                setcookie("key", hash("sha256", $row["username"]), time() + 60 * 60 * 24 * 30); 
            }
            $_SESSION["id"] = $row["randomid"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["isadmin"] = strToBool($row["isadmin"]);
            $_SESSION["isbanned"] = strToBool($row["isbanned"]);
            $_SESSION["gambar"] = $row["gambar"];
            return true;
        } else {
            echo "<script>
            Swal.fire({
                title: 'Login Gagal!',
                text: 'Silahkan cek kembali username / password anda',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
            return 0;
        }
    }
    return false;
}

function isSignedIn() {
    global $conn;
    if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
        $id = $_COOKIE["id"];
        $key = $_COOKIE["key"];

        $sql = "SELECT * FROM userdb WHERE randomid='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        if (!$row) {
            return false;
        }


        if ($key === hash("sha256", $row["username"])) {
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $row["username"];
            $_SESSION["isadmin"] = strToBool($row["isadmin"]);
            $_SESSION["isbanned"] = strToBool($row["isbanned"]);
            $_SESSION["gambar"] = $row["gambar"];

            if (isBanned()) {
                echo "<script>
                Swal.fire({
                    title: 'Anda telah dibanned!',
                    text: 'Silahkan hubungi admin untuk informasi lebih lanjut',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    alert('Anda akan logout otomatis!');
                    window.location.href = 'logout.php';
                });
                </script>";
                die();
            }

            return true;
        }
    } else {
        return isLoggedIn();
    }
}
function isLoggedIn(){
    if (isset($_SESSION["username"])) {
        if (isBanned()) {
            echo "<script>
            Swal.fire({
                title: 'Anda telah dibanned!',
                text: 'Silahkan hubungi admin untuk informasi lebih lanjut',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => {
                alert('Anda akan logout otomatis!');
                window.location.href = 'logout.php';
            });
            </script>";
            die();
        }
        return true;
    } else {
        return false;
    }
}
function isAdmin() {
    if ($_SESSION["isadmin"]) {
        return true;
    } else {
        return false;
    }
}

function isBanned() {
    if ($_SESSION["isbanned"]) {
        return true;
    } else {
        return false;
    }
}

function ubahData($data) {
    global $conn;
    $randomid = $_SESSION["id"];
    $sql = "UPDATE userdb SET ";
    if (strlen($data["username"]) > 0) {
        $username = strtolower(stripslashes($data["username"]));
        if (isUserExist($username)) {
            echo "<script>
            Swal.fire({
                title: 'Username sudah terdaftar!',
                text: 'Silahkan gunakan username lain',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
            return false;
        }
        $sql .= "username='$username'" . (strlen($data["password"]) > 0 || strlen($data["alamat"]) > 0 ? ", " : " ");
    }

    if (strlen($data["password"]) > 0) {
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        $sql .= "password='$password'" . (strlen($data["alamat"]) > 0 ? ", " : " ");
    }

    if (strlen($data["alamat"]) > 0) {
        $alamat = $data["alamat"];
        $sql .= "alamat='$alamat'";
    }

    if (substr($sql, -4) === "SET ") {
        echo "<script>
        Swal.fire({
            title: 'Tidak ada data yang diubah!',
            text: 'Silahkan cek kembali data yang ingin diubah',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    $sql .= "WHERE randomid='$randomid'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn)) {
        return true;
    } else {
        return false;
    }
}

function updateSession($user) {
    $_SESSION["username"] = $user["username"];
    $_SESSION["isadmin"] = strToBool($user["isadmin"]);
    $_SESSION["isbanned"] = strToBool($user["isbanned"]);
    $_SESSION["gambar"] = $user["gambar"];
}

function uploadGambar($name) {
    $namaFile = $_FILES[$name]["name"];
    $ukuranFile = $_FILES[$name]["size"];
    $error = $_FILES[$name]["error"];
    $tmpName = $_FILES[$name]["tmp_name"];

    if ($error === 4) {
        echo "<script>
        Swal.fire({
            title: 'Pilih gambar terlebih dahulu!',
            text: 'Pastikan gambar yang anda pilih sesuai dengan ketentuan',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    $ekstensiGambarValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $awalNamaFile = strtolower($ekstensiGambar[0]);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
        Swal.fire({
            title: 'File yang anda pilih bukan gambar!',
            text: 'Pastikan gambar yang anda pilih sesuai dengan ketentuan',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo "<script>
        Swal.fire({
            title: 'Ukuran gambar terlalu besar!',
            text: 'Pastikan ukuran gambar yang anda pilih tidak melebihi 1MB',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= $awalNamaFile;
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, "img/produk/" . $namaFileBaru);

    return $namaFileBaru;
}

function addProduk($data)
{
    global $conn;
    $namaProd = htmlspecialchars($data["namaProd"]);
    $deskProd = htmlspecialchars($data["deskProd"]);
    $hargaProd = htmlspecialchars($data["hargaProd"]);
    $stokProd = htmlspecialchars($data["stokProd"]);
    $diskonProd = htmlspecialchars($data["diskonProd"]);
    $varProd = htmlspecialchars($data["varProd"]);
    $ukurProd = htmlspecialchars($data["ukurProd"]);
    $specialtag = isset($data["specialtag"]) ? 1 : 0;
    $flashsale = isset($data["flashsale"]) ? 1 : 0;
    $gambarProd = htmlspecialchars(uploadGambar("gambarProd"));
    $idprod = getRandom(3);
    $opsiTransaksi = htmlspecialchars($data["opsitrans"]);
    
    $randomid = $_SESSION["id"];
    $idprod .= "z" . $randomid;
    if (!$gambarProd) {
        return false;
    }

    $sql = "INSERT INTO produk (randomid, nama, deskripsi, harga, stok, diskon, warna, ukuran, gambar, produkid, opsitransaksi, flashsale, specialtag) VALUES ('$randomid', '$namaProd', '$deskProd', '$hargaProd', '$stokProd', '$diskonProd', '$varProd', '$ukurProd', '$gambarProd', '$idprod', '$opsiTransaksi', '$flashsale', '$specialtag')";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function getProduk($id)
{
    global $conn;
    $sql = "SELECT * FROM produk WHERE produkid='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return $row;
    } else {
        return false;
    }
}
function getAllProduk()
{
    global $conn;
    $sql = "SELECT * FROM produk";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if ($rows) {
        return $rows;
    } else {
        return false;
    }
}
function getAllProdukByRandomId($randomid)
{
    global $conn;
    $sql = "SELECT * FROM produk WHERE randomid='$randomid'";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if ($rows) {
        return $rows;
    } else {
        return false;
    }
}
function editProduk($produkid, $data) {
    global $conn;

    $produk = getProduk($produkid);
    $namaProd = htmlspecialchars($data["namaProd"]) ?: $produk["nama"];
    $deskProd = htmlspecialchars($data["deskProd"]) ?: $produk["deskripsi"];
    $hargaProd = htmlspecialchars($data["hargaProd"]) ?: $produk["harga"];
    $stokProd = htmlspecialchars($data["stokProd"]) ?: $produk["stok"];
    $diskonProd = htmlspecialchars($data["diskonProd"]) ?: $produk["diskon"];
    $varProd = htmlspecialchars($data["varProd"]) ?: $produk["warna"];
    $ukurProd = htmlspecialchars($data["ukurProd"]) ?: $produk["ukuran"];
    $specialtag = isset($data["specialtag"]) ? 1 : $produk["specialtag"];
    $flashsale = isset($data["flashsale"]) ? 1 : $produk["flashsale"];
    $gambarProd = uploadGambar("gambarProd") ?: $produk["gambar"];
    $opsiTransaksi = htmlspecialchars($data["opsitrans"]) ?: $produk["opsitransaksi"];

    if ($gambarProd) {
        $sql = "UPDATE produk SET nama='$namaProd', deskripsi='$deskProd', harga='$hargaProd', stok='$stokProd', diskon='$diskonProd', warna='$varProd', ukuran='$ukurProd', gambar='$gambarProd', opsitransaksi='$opsiTransaksi', specialtag='$specialtag', flashsale='$flashsale' WHERE produkid='$produkid'";
    } else {
        $sql = "UPDATE produk SET nama='$namaProd', deskripsi='$deskProd', harga='$hargaProd', stok='$stokProd', diskon='$diskonProd', warna='$varProd', ukuran='$ukurProd', opsitransaksi='$opsiTransaksi', specialtag='$specialtag', flashsale='$flashsale' WHERE produkid='$produkid'";
    }

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}
function hapusProduk($produkid)
{
    global $conn;
    $sql = "DELETE FROM produk WHERE produkid='$produkid'";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        echo "<script>
        Swal.fire({
            title: 'Gagal menghapus produk!',
            text: 'Silahkan coba lagi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    $sql = "DELETE FROM rating WHERE produkid='$produkid'";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        echo "<script>
        Swal.fire({
            title: 'Gagal menghapus rating produk!',
            text: 'Silahkan coba lagi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    $sql = "DELETE FROM wishlist WHERE produkid='$produkid'";
    $res = mysqli_query($conn, $sql);

    if (!$res) {
        echo "<script>
        Swal.fire({
            title: 'Gagal menghapus wishlist produk!',
            text: 'Silahkan coba lagi',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    return mysqli_affected_rows($conn);
}

function rateProduk($data)
{
    global $conn;
    $produkid = $data["produkid"];
    $rating = $data["rating"];
    $randomid = $_SESSION["id"];
    if (isRated($produkid, $randomid)) {
        echo "<script>
        Swal.fire({
            title: 'Anda sudah memberikan rating!',
            text: 'Silahkan cek kembali rating yang anda berikan',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        </script>";
        return false;
    }

    $sql = "INSERT INTO rating (produkid, randomid, rating) VALUES ('$produkid', '$randomid', '$rating')";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function isRated($produkid, $randomid) {
    global $conn;
    $sql = "SELECT * FROM rating WHERE produkid='$produkid' AND randomid='$randomid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return $row["rating"];
    } else {
        return false;
    }
}
function getRating($randomid) {
    global $conn;
    $sql = "SELECT * FROM rating WHERE randomid='$randomid'";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if ($rows) {
        return $rows;
    } else {
        return false;
    }
}

function totalRating($produkid) {
    global $conn;
    $sql = "SELECT * FROM rating WHERE produkid='$produkid'";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row["rating"];
    }
    if ($rows) {
        return array_sum($rows) / count($rows);
    } else {
        return false;
    }
}
function totalRate($produkid) {
    global $conn;
    $sql = "SELECT * FROM rating WHERE produkid='$produkid'";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row["rating"];
    }
    if ($rows) {
        return array(
            "total" => array_sum($rows) / count($rows),
            "count" => count($rows)
        );
    } else {
        return array(
            "total" => 0,
            "count" => 0
        );
    }
}

function updateJlhRating($produkid) {
    global $conn;
    $sql = "SELECT * FROM rating WHERE produkid='$produkid'";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row["rating"];
    }
    if ($rows) {
        $sql = "UPDATE produk SET jlhRating='" . count($rows) . "' WHERE produkid='$produkid'";
        mysqli_query($conn, $sql);
        return mysqli_affected_rows($conn);
    } else {
        return 0;
    }
}

function updateRating($produkid) {
    global $conn;
    $sql = "SELECT * FROM rating WHERE produkid='$produkid'";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row["rating"];
    }
    if ($rows) {
        updateJlhRating($produkid);
        $total = array_sum($rows) / count($rows);
        $sql = "UPDATE produk SET rating='$total' WHERE produkid='$produkid'";
        mysqli_query($conn, $sql);
        return mysqli_affected_rows($conn);
    } else {
        return false;
    }
}

function updateSemuaRating() {
    global $conn;
    $sql = "SELECT * FROM produk";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        updateRating($row["produkid"]);
    }
}

function getVoucers() {
    global $conn;
    $sql = "SELECT * FROM voucer";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if ($rows) {
        return $rows;
    } else {
        return false;
    }
}

function getFlashsale($max = 20) {
    global $conn;
    $sql = "SELECT * FROM produk WHERE flashsale=1 LIMIT $max";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if ($rows) {
        return $rows;
    } else {
        return false;
    }
}

function hitungDiskon($harga, $diskon) {
    return $harga - ($harga * $diskon / 100);
}

function cekWishlist($produkid, $randomid) {
    global $conn;
    $sql = "SELECT * FROM wishlist WHERE produkid='$produkid' AND randomid='$randomid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        return true;
    } else {
        return false;
    }
}
function tambahWishlist($produkid, $randomid) {
    global $conn;
    $sql = "INSERT INTO wishlist (produkid, randomid) VALUES ('$produkid', '$randomid')";
    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
}
function hapusWishlist($produkid, $randomid) {
    global $conn;
    $sql = "DELETE FROM wishlist WHERE produkid='$produkid' AND randomid='$randomid'";
    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
}

function getAllWishlist($randomid) {
    global $conn;
    $sql = "SELECT * FROM wishlist WHERE randomid='$randomid'";
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if ($rows) {
        return $rows;
    } else {
        return false;
    }
}