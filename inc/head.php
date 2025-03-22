<!DOCTYPE html>
<html lang="id">

<head>
    <title>Sellpatu.com</title>
    <!-- Menulis tailwind harus didalam class -->
    <!-- Kalau gk hapal classnya bisa liat di: https://tailwindcss.com/docs/ atau instal ext vscode:https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss -->
    <!-- Menulis tampilan website menggunakan tailwindcss, yang diutamakan adalah tampilan untuk mobile, gunakan extension chrome untuk melihat tampilan mobile di chrome: https://chromewebstore.google.com/detail/responsive-viewer/inmopeiepgfljkpkidclfgbgbmfcennb -->
    <!-- Kalau ada elemen yang mau diubah tergantung ukuran layar, beberapa class tailwind css harus ditulis ulang juga sesuai kebutuhan, dengan mengawali dengan prefix => sm,md,lg,xl,2xl sesuai kebutuhan -->


    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" href="favicon.ico" />

    <!-- Untuk Icon dalam website -->
    <link rel="stylesheet" href="fontawesome/css/all.css" />
    <link rel="stylesheet" href="fontawesome/css/sharp-duotone-solid.css" />
    <link rel="stylesheet" href="fontawesome/css/sharp-thin.css" />
    <link rel="stylesheet" href="fontawesome/css/sharp-solid.css" />
    <link rel="stylesheet" href="fontawesome/css/sharp-regular.css" />
    <link rel="stylesheet" href="fontawesome/css/sharp-light.css" />
    <link rel="stylesheet" href="style.css?t=<?= time() ?>" />

    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

</head>


<!-- Class dark di body menandakan kalau website sedang dalam keadaan darkmode, jika tidak ada class dark di body maka website sedang dalam keadaan lightmode -->
<!-- Untuk membedakan mana warna untuk darkmode dan lightmode, darkmode ditulis dengan => warna, contoh untuk background => bg-light-bg dark:bg-dark-bg -->

<body class=" *:no-scrollbar no-scrollbar bg-light-bg dark:bg-dark-bg text-light-text dark:text-dark-text max-w-full min-w-full min-h-screen overflow-x-hidden">
