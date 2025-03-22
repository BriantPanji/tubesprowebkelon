<?php include 'inc/head.php'; ?>
<?php
session_start();

include 'inc/conn.php';

if (isSignedIn()) {
  header("Location: index.php");
  exit;
}

if (isset($_GET['daftSuc'])) {
  if (isset($_SESSION['ukkey'])) {
    $uname = getIdUser($_SESSION['ukkey']);
    $istrue = password_verify($uname, $_GET['daftSuc']);


    unset($_SESSION['ukkey']);
    if ($istrue) {
      echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Registrasi Berhasil!',
          text: 'Silahkan lanjutkan dengan login ke akun tadi',
        }).then(() => {
          window.location.href = 'signin.php'
        })
      </script>";
    }
  }
}

/* SIGN IN */
if (isset($_POST["submit"])) {
  $ress = signin($_POST);
  if ($ress) {
    header("Location: index.php");
    exit;
  } else if ($ress === 0) {
    echo "<script>console.log('Login Gagal! Username atau Password salah.');</script>";
 } else {
    echo "<script>
        Swal.fire({
          icon: 'error',
          title: 'Login Gagal!',
          text: 'Silahkan coba lagi.',
        });
      </script>";
  }
}


?>

<?php include 'inc/nav.php'; ?>
<p class=" md:px-10 "></p>
<!-- Bagian untuk isi halaman -->
<section class="min-w-full max-w-full min-h-3 flex item-center px-4 sm:px-8 md:px-10 lg:px-14 xl:px-32 2xl:px-[25%]">
  <div class="min-w-full max-w-full min-h-4 bg-light-primary text-light-bg rounded-lg flex flex-col py-5">
    <h1 class="text-3xl font-extrabold min-w-full max-w-full text-center">SIGN IN</h1>
    <div class="min-w-full max-w-full min-h-3">
      <form id="formlogin" action="" method="post" class="min-w-full max-w-full min-h-2 flex flex-col px-3 gap-4">
        <div class="subdiv flex flex-col gap-1">
          <label for="username" class=" font-bold text-lg">Username: </label>
          <input required autocomplete="off" type="text" name="username" id="username" class=" rounded-md bg-light-bg text-light-text px-3 min-h-10 max-h-12 text-lg" placeholder="Username...">
        </div>
        <div class="subdiv flex flex-col gap-1">
          <label for="password" class=" font-bold text-lg">Password: </label>
          <input required type="password" name="password" id="password" class=" rounded-md bg-light-bg text-light-text px-3 min-h-10 max-h-12 text-lg" placeholder="Password...">
        </div>
        <div class="subdiv flex gap-1">
          <input type="checkbox" name="remember" id="remember" class=" min-w-5 !bg-light-bg outline-none border-none">
          <label for="remember" class=" font-semibold text-lg"> Ingat saya</label>
        </div>
        <div class="subdiv flex gap-1">
          <span class="text-sm">* Belum punya akun? <a href="signup.php" class=" text-blue-400 underline">Klik disini</a> untuk membuat akun</span>
        </div>
        <div class="subdiv flex gap-1 justify-center item-center">
          <button type="submit" name="submit" hidden></button>
          <button onclick="doform()" type="button" class="bg-light-bg px-4 py-2 text-light-secondary font-bold rounded-lg shadow-xs hover:scale-95 hover:shadow-none">Submit</button>
        </div>

        <!-- <label for=""></label>
      <input type="text" name="" id=""> -->
      </form>
    </div>
  </div>
</section>

<?php include 'inc/foot.php'; ?>

<script>
  const formlogin = document.getElementById('formlogin');
  const username = document.getElementById('username');
  const password = document.getElementById('password');
  const btnSub = formlogin.querySelector('button[type="submit"]');

  function doform() {
    if (username.value > 20) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Username tidak boleh lebih dari 20 karakter',
      });
    }
    if (password.value > 20) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password tidak boleh lebih dari 20 karakter',
      });
    }
    if (password.value < 8) {
      return Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password minimal 8 karakter',
      });
    }


    btnSub.click();
  }
</script>