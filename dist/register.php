<?php
    require 'db.php';

    $levels = $database->select("tb_recipe_levels","*");
    $categories = $database->select("tb_recipe_category","*");
    $occasions = $database->select("tb_recipe_occasions","*");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="./imgs/favicon.ico"/>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- BS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        onerror="this.onerror=null;this.href='./css/vendors/bootstrap.min.css';">
    <!-- Normalize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./css/main.css">

</head>

<body>

    <header class="header-base">

        <!-- mobile bar menu -->

        <div class="position-absolute  top-0 start-0 pt-3 pb-3 ps-3 mobile-bar  ">
            <div class="row ">
                <div class="col d-flex justify-content-start ps-4">
                    <img class="mobile-icon" src="./imgs/bars.svg" alt="menu bar">
                </div>

                <div class="col d-flex justify-content-center">
                    <img class="mobile-logo " src="./imgs/Logo.png" alt="menu bar">
                </div>
            </div>
        </div>

        <!-- mobile bar menu -->


        <!-- nav menu -->
        <nav id="navbar-main" class="mobile-offcanvas navbar  navbar-expand-lg topnav">
            <div class="offcanvas-header">
                <button id="btn-close" class="btn btn-light float-end me-3">X</button>
            </div>
            <div class="container container-nav center gap-3 ">
                <a class="navbar-brand d-flex align-items-center me-5" href="#">
                    <img src="./imgs/Logo.png" class="header-logo" alt="Logo">
                </a>
                <div class=" container container-nav" id="navbarSupportedContent">
                    <ul class="navbar-nav gap-5  ">
                        <li class="nav-item  position-relative dropdown"><a class="nav-link b title-md0"
                                aria-current="page" href="#">Principal</a></li>
                        <li class="dropdown nav-item ">
                            <a class="nav-link title-md0" data-bs-toggle="dropdown" aria-expanded="false"
                                href="#">Categoría </a>
                            <a href=" "></a>
                            <ul class="dropdown-menu text-center">
                                <?php 
                        foreach ($categories as $category){
                            echo "<li><a class='dropdown-item' href='index.php?category=".$category['id_recipe_category']."&name=".$category['recipe_category']."#recetas'>".$category['recipe_category']."</a></li>";
                        }
                    ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class=" nav-link  title-md0 " data-bs-toggle="dropdown" aria-expanded="false"
                                href="#">Dificultad</a>
                            <ul class="dropdown-menu text-center">
                                <?php
                        foreach ($levels as $level){
                            echo "<li><a class='dropdown-item' href='index.php?level=".$level['id_recipe_level']."&name=".$level['recipe_level']."#recetas'>".$level['recipe_level']."</a></li>";
                        }
                    ?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class=" nav-link  title-md0  " data-bs-toggle="dropdown" aria-expanded="false"
                                href="#">Ocasiones</a>
                            <ul class="dropdown-menu text-center">
                                <?php 
                        foreach ($occasions as $occasion){
                            echo "<li><a class='dropdown-item' href='index.php?occasion=".$occasion['id_recipe_occasion']."&name=".$occasion['recipe_occasion']."#recetas'>".$occasion['recipe_occasion']."</a></li>";
                        }
                    ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <form class="d-flex align-items-center search-form" action="search.php" method="get" role="search">
                    <input class="search-input" type="search" name="keyword" placeholder="¿Qué quieres cocinar hoy?"
                        aria-label="Search">
                    <button class="search-button" type="submit"></button>
                </form>
            </div>
        </nav>

        <!-- nav menu -->

    </header>

    <form class="bg-base d-flex" action="add-admin.php" method="post" enctype="multipart/form-data">
        <div class="container-base d-flex justify-content-center align-items-center">
            <div class="register-data">
                <h2 class="text-center title-mdxl3 text-black mtl mv-title mt-mv2">Registrar Admin</h2>
                <div class="d-flex justify-content-center mt-4">
                    <input type="text" class="text-input text-center d-flex" placeholder="Nombre de Usuario"
                        name="user" />
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <input type="password" class="text-input text-center d-flex" placeholder="Contraseña" name="pass" />
                </div>
                <div class="d-flex justify-content-center mt-m mobile-version mt-mv1">
                    <input class="btn-base btn-green-admin" type="submit" value="Registrar">
                </div>
                <h3 class="forms-link text-center mt-5 forms-link-mv mt-mv3">¿Ya existe el usuario?</h3>
                <div class="d-flex justify-content-center mt-1 mobile-version forms-link-mv">
                    <a class="forms-link forms-link-hl" href="login.html">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </form>

    <footer class=" downnav  ">
        <section class="container d-flex mobile-footer  gap-5 ">
            <div class="col-md  ">
                <a class="navbar-brand d-flex just mt-3 footer-img " href="#">
                    <img src="./imgs/Logo.png" class="footer-image " alt="Logo" class="">
                </a>
            </div>
            <div class="col-md mt-3 footer-img  ">
                <div class="row   site ">
                    <div class="col ">
                        <ul class=" mobile-footer">
                            <li class="mb-3 footer-item">
                                <h2 class="footer-link title-md1 container-nav" href="#">CONTACTO</h2>
                            </li>
                            <li class="mb-3 footer-item"><a class="footer-link " href="#">+506 2447
                                    5635</a></li>
                            <li class="mb-3 footer-item"><a class="footer-link  " href="#">foodbook@example.co.cr</a>
                            </li>
                            <li class="mb-3 footer-item"><a class="footer-link  " href="#">San Jose,
                                    Costa Rica. Av 11</a></li>
                        </ul>
                    </div>
                    <div class="col ">
                        <ul class="mobile-footer p-0">
                            <li class="mb-3 footer-item">
                                <h2 class="footer-link title-md1 container-nav" href="#">MAPA DEL SITIO</h2>
                            </li>
                            <li class="mb-3 footer-item"><a class="footer-link " href="#">CATEGORIA</a>
                            </li>
                            <li class="mb-3 footer-item"><a class="footer-link  " href="#">DIFICULTAD</a>
                            </li>
                            <li class="mb-3 footer-item"><a class="footer-link  " href="#">OCASIONES</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="container ">
            <p class=" border-line mt-3 text-center pe-3"> </p>
        </section>
        <section class="container container-creditos creditos ">
            <div class="col-md d-flex   justify-content-center">
                <p class=" footer-text  mt-4 ">2022 Foodbok. Todos los derechos reservados.
                </p>
            </div>
            <div class="col-md d-flex align-items-center  justify-content-center ">
                <ul class="d-flex p-0 mt-4 gap-3">
                    <li class="d-inline-block"><a href="#"> <img class="footer-media" src="./imgs/tw.png"
                                alt="twitter"></a></li>
                    <li class="d-inline-block"><a href="#"><img class="footer-media" src="./imgs/fb.png"
                                alt="twitter"></a></li>
                    <li class="d-inline-block"><a href="#"> <img class="footer-media" src="./imgs/ig.png"
                                alt="twitter"></a></li>
                </ul>
            </div>
            <div class="col-md d-flex align-items-center  justify-content-center pr">
                <ul class="d-flex p-0 mt-4 gap-5">
                    <li class="footer-text d-inline-block ">
                        <p class=" "></p> Terminos de uso.</p>
                    </li>
                    <li class="footer-text d-inline-block">
                        <p class="  "></p> Politicas de privacidad.</p>
                    </li>
                </ul>
            </div>
        </section>
    </footer>
    </section>





    <script src="../js/admin-options.js"></script>
    <script src="../js/upload-input.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('.mobile-icon').addEventListener('click', function(event) {
            console.log('click');
            document.getElementById('navbar-main').classList.add('show-nav');
        });

        document.querySelector('#btn-close').addEventListener('click', function(event) {
            document.getElementById('navbar-main').classList.remove('show-nav');
        });
    });
    </script>
</body>

</html>