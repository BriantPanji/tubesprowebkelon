<?php include 'inc/head.php'; ?>
<?php
session_start();
include 'inc/conn.php';

if (isSignedIn()) {
  header("Location: index.php");
  exit;
}

if (isset($_POST["submit"])) {
  $ress = signup($_POST);
  if ($ress > 0) {
    $uname = strtolower(stripslashes($_POST["username"]));
    $_SESSION['ukkey'] = getUserId($uname);
    $uname = password_hash($uname, PASSWORD_DEFAULT);

    header("Location: signin.php?daftSuc=$uname");
    exit;
  } else if ($ress === false) {
    echo "<script> console.log('Registrasi gagal'); </script>";
  } else {
    var_dump(mysqli_error($conn));
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Registrasi Gagal!',
        text: 'Silahkan coba lagi.',
      });
    </script>";
  }
}
?>
<?php include 'inc/nav.php'; ?>


<div class="flex items-center justify-center mt-8">
  <div class="bg-[#5c422a] p-6 rounded-lg shadow-md w-96">
    <h1 class="text-[2rem] font-bold text-center text-white mb-6 ">Sign Up</h1>
    <form action="" method="post">

      <label for="username" class="block text-white mb-2 font-medium">Username: <span class="text-red-500">*</span></label>
      <input
        id="username"
        type="text"
        name="username"
        required
        placeholder="Masukkan username anda..."
        class="w-full p-2 mb-4 dark:text-dark-bg border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-brown-600" />

      <label for="nowa" class="block text-white mb-2 font-medium">No. WhatsApp: <span class="text-red-500">*</span></label>
      <input
        id="nowa"
        type="tel"
        name="nowa"
        required
        placeholder="Masukkan nomor WhatsApp anda (6281234567890)..."
        class="w-full p-2 mb-4 dark:text-dark-bg border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-brown-600" />


      <label for="alamat" class="block text-white mb-2 font-medium">Alamat: <span class="text-red-500">*</span></label>
      <input
        id="alamat"
        type="text"
        name="alamat"
        placeholder="Masukkan alamat anda..."
        class="w-full p-2 mb-4 dark:text-dark-bg border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-brown-600" />

      <label for="password" class="block text-white mb-2 font-medium">Password: <span class="text-red-500">*</span></label>
      <input
        id="password"
        type="password"
        name="password"
        required
        placeholder="Masukkan password anda..."
        class="w-full p-2 mb-4 dark:text-dark-bg border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-brown-600" />


      <label
        for="confirm-password"
        class="block text-white mb-2 font-medium">Konfirmasi Password: <span class="text-red-500">*</span></label>
      <input
        id="confirm-password"
        type="password"
        name="connpass"
        required
        placeholder="Konfirmasi password anda..."
        class="w-full p-2 mb-4 dark:text-dark-bg border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-brown-600" />


      <p class="text-white text-sm mb-4">
        * Dengan mengklik tombol
        <span class="font-medium">submit</span> maka Anda sudah menyetujui
        <span class="text-red-500">S&K yang berlaku</span> dalam website
        ini.
      </p>


      <p class="text-white text-sm mb-4">
        * Sudah punya akun?
        <a href="#" class="text-blue-400 underline">klik disini</a> untuk
        masuk ke akun.
      </p>

      <button
        type="submit"
        name="submit"
        id="submit"
        hidden></button>

      <button
        onclick="doform()"
        type="button"
        class="w-full bg-white text-[#5c422a] font-medium py-2 rounded hover:bg-gray-200">
        Submit
      </button>
    </form>
  </div>
</div>

<?php include 'inc/foot.php'; ?>

<script>
  const form = document.querySelector('form');
  const submit = document.getElementById('submit');
  const pw = document.getElementById('password');
  const cpw = document.getElementById('confirm-password');
  const uname = document.getElementById('username');
  const nowa = document.getElementById('nowa');
  const alamat = document.getElementById('alamat');

  function doform() {
    if (uname.value === '' || nowa.value === '' || pw.value === '' || cpw.value === '') {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Semua kolom harus diisi!',
      });
    }
    if (pw.value.length < 8) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password minimal 8 karakter!',
      });
    }
    if (pw.value === uname.value) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password tidak boleh sama dengan username!',
      });
    }
    if (pw.value === nowa.value) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password tidak boleh sama dengan nomor WA!',
      });
    }
    if (uname.value.length < 5) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username minimal 5 karakter!',
      });
    }
    if (nowa.value.length < 11) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Nomor WA minimal 11 karakter!',
      });
    }
    if (nowa.value.length > 14) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Nomor WA maksimal 14 karakter!',
      });
    }
    if (uname.value.length > 20) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username maksimal 20 karakter!',
      });
    }
    if (pw.value.length > 20) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password maksimal 20 karakter!',
      });
    }
    if (alamat.value.length > 200) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Alamat maksimal 200 karakter!',
      });
    }
    const addresses = [
      "Jl. Nasi Goreng, Gg. Sambal, No. 5, Kec. Sate Ayam, Kel. Soto Betawi, Jakarta, DKI Jakarta, Indonesia, 10110.",
      "Jl. Bakso Urat, Gg. Kuah, No. 8, Kec. Mie Pangsit, Kel. Tahu Bulat, Bandung, Jawa Barat, Indonesia, 40212.",
      "Jl. Sate Kambing, Gg. Bumbu, No. 3, Kec. Gulai Ikan, Kel. Rendang, Surabaya, Jawa Timur, Indonesia, 60234.",
      "Jl. Soto Ayam, Gg. Koya, No. 7, Kec. Rawon, Kel. Pecel Lele, Yogyakarta, DI Yogyakarta, Indonesia, 55281.",
      "Jl. Nasi Gurih, Gg. Sambal, No. 4, Kec. Ayam Bakar, Kel. Ikan Bakar, Semarang, Jawa Tengah, Indonesia, 50123.",
      "Jl. Pempek, Gg. Cuko, No. 9, Kec. Tekwan, Kel. Model, Palembang, Sumatera Selatan, Indonesia, 30126.",
      "Jl. Lontong Balap, Gg. Tahu, No. 10, Kec. Rujak Cingur, Kel. Semanggi, Surabaya, Jawa Timur, Indonesia, 60256.",
      "Jl. Rendang, Gg. Dendeng, No. 13, Kec. Gulai, Kel. Sate Padang, Padang, Sumatera Barat, Indonesia, 25123.",
      "Jl. Arsik, Gg. Andaliman, No. 14, Kec. Lappet, Kel. Bika Ambon, Medan, Sumatera Utara, Indonesia, 20123.",
      "Jl. Mie Aceh, Gg. Kari, No. 16, Kec. Ayam Tangkap, Kel. Sate Matang, Banda Aceh, Aceh, Indonesia, 23123.",
      "Jl. Nasi Padang, Gg. Sate, No. 17, Kec. Rendang, Kel. Dendeng Balado, Padang, Sumatera Barat, Indonesia, 25124."
    ];
    function randomPP() {
      return addresses[Math.floor(Math.random() * addresses.length)]
    }
    if (alamat.value.length < 0) {
      if (alamat.value === '') {
        return Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Alamat tidak boleh kosong!',
        });
      }
    }
    if (isNaN(parseInt(nowa.value))) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Nomor WA harus berupa angka!',
      });
    }

    if (pw.value !== cpw.value) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Konfirmasi password tidak sesuai!',
      });
    }
    if (nowa.value.startsWith('08')) {
      nowa.value = '62' + nowa.value.slice(1);
    } else {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Nomor WA harus diawali dengan angka 0!',
      });
    }
    submit.click();
  }
</script>