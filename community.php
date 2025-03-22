<?php include 'inc/head.php' ?>
<?php include 'inc/conn.php' ?>
<?php
isLoggedIn();
?>

<?php include 'inc/nav.php' ?>

<section class="flex min-w-full max-w-full">
    <div class="min-w-full max-w-full flex flex-col gap-4">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-0">
            <h1 class="text-xl sm:text-2xl font-bold">Diskusi Komunitas</h1>
            <button class="w-full sm:w-auto bg-light-secondary dark:bg-dark-text text-light-bg dark:text-dark-bg px-3 sm:px-4 py-2 rounded-lg hover:bg-opacity-80 text-sm sm:text-base">
                <i class="fa-solid fa-plus mr-2"></i>Buat Thread Baru
            </button>
        </div>

        <div class="flex flex-col gap-3">
            <!-- Global Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-20 dark:bg-opacity-20 p-4 rounded-lg cursor-pointer relative mb-6 shadow-lg">
                <div class="absolute -top-2 -right-2 bg-light-secondary dark:bg-dark-text text-light-bg dark:text-dark-bg px-3 py-1 rounded-full text-xs font-bold">
                    <i class="fa-solid fa-globe mr-1"></i>Global
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10 border-2 border-light-secondary" alt="user avatar">
                        <div>
                            <h3 class="font-bold">Pengumuman: Update Fitur Komunitas Terbaru!</h3>
                            <p class="text-sm text-light-text dark:text-dark-text opacity-80">Oleh @admin • Dipin</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 sm:gap-4 text-xs sm:text-sm">
                        <div class="flex items-center gap-1">
                            <button class="hover:opacity-80"><i class="fa-solid fa-star"></i></button>
                            <span>234</span>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>156</span>
                        <span><i class="fa-solid fa-eye mr-1"></i>1.2k</span>
                    </div>
                </div>
            </div>

            <!-- Thread item - Popular -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer relative">
                <div class="absolute -top-2 -right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                    <i class="fa-solid fa-fire-flame-curved mr-1"></i>Populer
                </div>
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Review Sepatu Nike Air Max 2024</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @johndoe • 2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-1">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>125</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>24</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>12</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Tips Merawat Sepatu Kulit</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @shoelover • 5 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>89</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>18</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>32</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Rekomendasi Sepatu Lari Budget 500rb</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @runner123 • 1 hari yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>67</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>45</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>28</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Tips Merawat Sepatu Kulit</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @shoelover • 5 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>89</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>18</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>32</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Rekomendasi Sepatu Lari Budget 500rb</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @runner123 • 1 hari yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>67</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>45</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>28</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Tips Merawat Sepatu Kulit</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @shoelover • 5 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>89</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>18</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>32</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Rekomendasi Sepatu Lari Budget 500rb</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @runner123 • 1 hari yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>67</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>45</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>28</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Tips Merawat Sepatu Kulit</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @shoelover • 5 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>89</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>18</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>32</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Rekomendasi Sepatu Lari Budget 500rb</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @runner123 • 1 hari yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>67</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>45</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>28</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Tips Merawat Sepatu Kulit</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @shoelover • 5 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>89</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>18</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>32</span>
                    </div>
                </div>
            </div>

            <!-- Thread item -->
            <div class="bg-light-secondary dark:bg-dark-text bg-opacity-10 p-4 rounded-lg hover:bg-opacity-20 dark:bg-opacity-20 cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <img src="https://i.pinimg.com/enabled_lo_mid/1200x/28/67/04/2867040ed5ebd29f160cf5439309a435.jpg" class="rounded-full w-10 h-10" alt="user avatar">
                        <div>
                            <h3 class="font-semibold">Rekomendasi Sepatu Lari Budget 500rb</h3>
                            <p class="text-sm text-light-text dark:text-dark-tertiary text-opacity-65">Oleh @runner123 • 1 hari yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="flex items-center gap-2">
                            <button class="hover:text-green-500"><i class="fa-solid fa-arrow-up"></i></button>
                            <span>67</span>
                            <button class="hover:text-red-500"><i class="fa-solid fa-arrow-down"></i></button>
                        </div>
                        <span><i class="fa-regular fa-message mr-1"></i>45</span>
                        <span><i class="fa-regular fa-heart mr-1"></i>28</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<script>
    Swal.fire({
        title: 'Warning!',
        text: 'Halaman ini hanyalah sebuah contoh konsep, tidak ada apapun disini',
        icon: 'error',
        confirmButtonText: 'Oke'
    });
</script>
<?php include 'inc/foot.php' ?>