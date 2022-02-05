<?php
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    switch ($page) {
        case '';
        case 'home';
            file_exists('pages/home.php') ? include 'pages/home.php' : include "pages/404.php";
            break;
        case 'lokasiread':
            file_exists('pages/admin/lokasiread.php') ? include
                'pages/admin/lokasiread.php' : include "pages/404.php";
            break;
        case 'lokasicreate':
            file_exists('pages/admin/lokasicreate.php') ? include
                'pages/admin/lokasicreate.php' : include "pages/404.php";
            break;
        case 'lokasiupdate':
            file_exists('pages/admin/lokasiupdate.php') ? include
                'pages/admin/lokasiupdate.php' : include "pages/404.php";
            break;
        case 'lokasidelete':
            file_exists('pages/admin/lokasidelete.php') ? include
                'pages/admin/lokasidelete.php' : include "pages/404.php";
            break;
        default:
            include "pages/404.php";
    }
} else {
    include "pages/home.php";
}
