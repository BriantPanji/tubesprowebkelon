<?php 

$darkMode = '';
$newMode = '?dark=';
if (isset($_COOKIE['dark'])) {
    if ($_COOKIE['dark'] === 'true') {
        $darkMode = 'dark';
        $newMode = '';
    }
}

?>

<!-- Navbar -->
<nav class=" no-scrollbar min-w-full max-w-full min-h-max max-h-max sm:min-h-fit sm:max-h-fit h px-8 pb-1 pt-3 sm:!py-2 lg:!py-1 flex items-center flex-col bg-light-primary">

    <!-- Tambahan navbar untuk mobile dan beberapa tablet mini -->
    <section class=" sm:hidden relative w-full flex items-center justify-center">
        <h1 class="font-['Bungee_Shade'] text-xl font-bold w-fit text-light-bg bg-light-secondary pt-1 pb-[.3rem] px-2 rounded-[4px] leading-none"><a href="index.php">SellPatu</a></h1>
        <span id="sideBtnMbl" class=" absolute right-0 text-light-bg bg-light-secondary  bg-opacity-80 hover:bg-light-secondary  w-8 h-8 flex items-center justify-center rounded-[3px] text-[1.35rem] sm:text-3xl"><i onmouseover="(this.classList.replace('fa-regular', 'fa-solid'))" onmouseout="this.classList.replace('fa-solid', 'fa-regular')" class="transition-all fa-regular fa-list"></i></span>
        <a href="<?= isset($_SESSION['username']) ? "profile.php" : "signin.php"; ?>" class=" bg-light-secondary bg-opacity-80 hover:bg-light-secondary text-light-bg w-8 h-8 rounded-md  flex items-center justify-center drop-shadow-2xl absolute left-0 text-[1.35rem] sm:text-3xl"><i onmouseout="(this.classList.replace('fa-regular', 'fa-solid'))" onmouseover="this.classList.replace('fa-solid', 'fa-regular')" class="transition-all fa-solid fa-user"></i></a>
    </section>
    
    <section class="min-w-full max-w-full my-2 flex items-center">
        <h1 class="font-['Bungee_Shade'] text-3xl hidden xl:block mr-[3rem] text-light-bg bg-light-secondary pt-2 pb-[.6rem] px-4 rounded-lg leading-none"><a href="index.php">SellPatu</a></h1>

        <section class="w-full h-full flex items-center justify-between">

            <!-- Fitur pencarian -->
            <form action="cari.php" method="get" class="h-full bg-light-secondary bg-opacity-40 hover:bg-light-secondary max-sm:min-w-full py-1 px-[2px] sm:px-1 md:px-1.5 rounded-3xl w-full max-w-full sm:w-[70%] sm:max-w-[70%] md:min-w-[50%] md:max-w-[50%]  sm:min-w-[40%] flex items-center relative">
                <input type="text" name="cari" id="cari" class="bg-[#e1e1e1] sm:min-h-[55%] min-w-full max-w-full rounded-3xl px-8 py-[.2rem] text-md sm:text-xl outline-light-accent border-solid sm:border-[1px] border-light-accent placeholder:truncate" placeholder="Cari di SellPatu...">
                <button type="submit" class="absolute left-4 text-light-text dark:text-dark-text"><i class="fa-regular fa-magnifying-glass"></i></button>
                <button type="reset" class="absolute right-4 text-light-text dark:text-dark-text"><i class="fa-sharp fa-regular fa-circle-xmark"></i></button>

            </form>

            <div class="sm:flex max-w-[100%] w-[30%] min-w-[30%] md:max-w-[45%] md:w-[42.5%] lg:max-w-[35%] h-full items-center justify-around hidden *:leading-none">
                <a href="<?= isset($_SESSION['username']) ? "wishlist.php" : "signin.php"; ?>" id="tombol" class="text-2xl flex items-center justify-center bg-light-secondary bg-opacity-70 hover:bg-light-secondary sm:text-[1.75rem] font-bold text-light-bg w-11 h-11 rounded-md leading-none"><i onmouseover="(this.classList.replace('fa-regular', 'fa-solid'))" onmouseout="this.classList.replace('fa-solid', 'fa-regular')" class="fa-sharp fa-regular fa-cart-shopping"></i></a>
                <?php
                if (isset($_SESSION['username'])) {
                    $adminpage = $_SESSION['isadmin'] === true ? "admin.php" : "profile.php";
                    echo '<a href="' . $adminpage . '" title="' . $_SESSION["username"] .'" class="text-2xl flex items-center justify-center bg-light-secondary bg-opacity-70 hover:bg-light-secondary sm:text-[1.75rem] font-bold text-light-bg w-11 h-11 rounded-md leading-none"><i onmouseover="(this.classList.replace(\'fa-regular\', \'fa-solid\'))" onmouseout="this.classList.replace(\'fa-solid\', \'fa-regular\')" class="fa-sharp fa-regular fa-user"></i></a>';
                } else {
                    echo "
                    <a href=\"signin.php\" class=\"text-lg flex items-center justify-center sm:text-xl font-semibold xl:font-bold text-light-bg bg-light-secondary bg-opacity-70 rounded-md hover:bg-light-bg dark:bg-dark-bg hover:text-light-secondary transition-all px-4 py-2 sm:!py-[.6rem] !leading-[1]\">Masuk</a>
                    <a href=\"signup.php\" class=\"hidden md:flex lg:flex items-center justify-center text-lg sm:text-xl font-semibold xl:font-bold rounded-md bg-light-secondary bg-opacity-70 text-light-bg hover:bg-light-bg dark:bg-dark-bg hover:text-light-secondary transition-all px-4 py-1 sm:!py-[.6rem] !leading-none\">Daftar</a>
                    ";
                }
                ?>
                <span id="sideBtn" class="text-2xl z-50 cursor-pointer sm:text-[1.75rem] bg-opacity-70 text-light-bg bg-light-secondary hover:bg-light-bg dark:bg-dark-bg hover:text-light-secondary flex items-center justify-center w-10 h-10 rounded-sm leading-none p-0"><i onmouseover="(this.classList.replace('fa-regular', 'fa-solid'))" onmouseout="this.classList.replace('fa-solid', 'fa-regular')" class="transition-all fa-regular fa-list"></i></span>
            </div>

        </section>
    </section>

</nav>

<aside id="sidebar" class="sidebarWrapper select-none !transition-all *:!transition-all no-scrollbar fixed top-0 overflow-hidden min-h-screen max-h-screen h-screen w-full min-w-full max-w-full z-50 sidebarOff">
    <div class="blurred transition-all fixed w-full min-w-full max-w-full h-full min-h-full max-h-full backdrop-blur-2xl blur-xl bg-gray-700 opacity-25 z-40"></div>
    <section class="sidebar transition-all w-[80%] xs:w-[65%] sm:max-w-[55%] md:max-w-[50%] lg:max-w-[35%] xl:max-w-[25%] 2xl:max-w-[20%] h-full bg-light-primary text-light-bg flex flex-col py-5 z-50 relative ">
        <div class="w-full flex items-center justify-center border-b-2 border-light-bg pb-4">
            <h1 class="font-['Bungee_Shade'] text-2xl font-bold w-[55%] h-10 text-light-bg bg-light-secondary flex items-center justify-center rounded-md leading-none"><a href="">SellPatu</a></h1>
        </div>
        <div class="w-full min-h-full pr-3 py-1 mt-5">
            <ol class="w-[85%] h-full flex flex-col gap-1 font-medium select-none *:select-none">
                <?php
                $pageNow = basename($_SERVER['PHP_SELF']);
                $profPage = isset($_SESSION['username']) ? "profile.php" : "signin.php";
                if (isset($_SESSION['username'])) 
                    $arrAdmin = array( "Logout" => "fa-left-from-bracket|logout.php" );

                    $namemode = ucwords($darkMode === '' ? 'Dark' : 'Light');
                $arrPage = array(
                    "$namemode"."mode" => "fa-bolt|darkmode.php$newMode",
                    "Home" => "fa-house|index.php",
                    "Profile" => "fa-user|$profPage",
                    "Community" => "fa-users|community.php",
                    "Wishlist" => "fa-bookmark|wishlist.php",
                    "Tambah Produk" => "fa-plus|addproduk.php",
                );
                if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] === true) {
                    $arrPage["Dashboard"] = "fa-user-tie|admin.php";
                }
                if (isset($_SESSION['username']))
                    $arrPage = array_merge($arrAdmin, $arrPage);
                $arrlen = count($arrPage);
                
                $ctpage = 1;
                foreach ($arrPage as $key => $value) {
                    $val = explode("|", $value);
                    $isBtnOn = $pageNow === $val[1] ? "sidebarBtnOn" : "";
                    // $isLast = $ctpage === $arrlen ? "sidebarBtnOn" : "";
                    echo "<a href=\"$val[1]\" class=\" transition-all text-lg w-full h-12 min-w-full max-w-full min-h-1 bg-light-secondary flex items-center pl-5 rounded-r-lg relative border-light-bg hover:scale-105 $isBtnOn\">
                    <li class=\"flex relative w-full items-center\"><i class=\"fa-solid $val[0]\"></i> <b class=\"absolute right-0 w-[80%]\">$key</b></li>
                    </a>";
                    $ctpage += $isBtnOn === "" ? 1 : 0;
                }

                ?>
            </ol>
        </div>
    </section>
</aside>

<!-- Bagian untuk isi halaman -->
<main class=" <?= $darkMode ?> no-scrollbar min-w-full max-w-full min-h-screen text-light-text dark:text-dark-text bg-light-bg dark:bg-dark-bg p-3 md:px-20 md:py-4 lg:px-44 lg:py-5 flex flex-col">