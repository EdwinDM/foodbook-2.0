<?php
    require 'db.php';

    $levels = $database->select("tb_recipe_levels","*");
    $categories = $database->select("tb_recipe_category","*");
    $occasions = $database->select("tb_recipe_occasions","*");
    
    $featured_recipes = $database->select("tb_recipes","*",[
        "recipe_is_featured" => 1
    ]);

    $recipe = $database->select("tb_recipes",[
        "[><]tb_recipe_category"=>["id_recipe_category" => "id_recipe_category"],
        "[><]tb_recipe_levels"=>["id_recipe_level" => "id_recipe_level"],
        "[><]tb_recipe_occasions"=>["id_recipe_occasion" => "id_recipe_occasion"],
    ],[
        "tb_recipes.id_recipe",
        "tb_recipes.id_recipe_category",
        "tb_recipes.recipe_name", 
        "tb_recipes.recipe_time", 
        "tb_recipes.recipe_cook_time", 
        "tb_recipes.recipe_prep_time", 
        "tb_recipes.recipe_yields", 
        "tb_recipes.recipe_image", 
        "tb_recipes.recipe_description", 
        "tb_recipes.recipe_likes", 
        "tb_recipes.recipe_ingredients", 
        "tb_recipes.recipe_directions", 
        "tb_recipe_category.recipe_category",
        "tb_recipes.id_recipe_level", 
        "tb_recipes.id_recipe_occasion", 
        "tb_recipe_occasions.recipe_occasion", 
        "tb_recipe_levels.recipe_level" 
    ],[
        "tb_recipes.id_recipe" => $_GET["id_recipe"]
    ]);

    //related recipes
    $related_recipes = $database->select("tb_recipes",[
        "[><]tb_recipe_category"=>["id_recipe_category" => "id_recipe_category"],
        "[><]tb_recipe_levels"=>["id_recipe_level" => "id_recipe_level"],
    ],[
        "tb_recipes.id_recipe",
        "tb_recipes.recipe_name", 
        "tb_recipes.recipe_time", 
        "tb_recipes.recipe_cook_time", 
        "tb_recipes.recipe_prep_time", 
        "tb_recipes.recipe_yields", 
        "tb_recipes.recipe_image", 
        "tb_recipes.recipe_description", 
        "tb_recipes.recipe_likes", 
        "tb_recipes.recipe_ingredients", 
        "tb_recipes.recipe_directions", 
        "tb_recipe_category.recipe_category",
        "tb_recipes.id_recipe_level",  
        "tb_recipe_levels.recipe_level"
    ],[ 
        "tb_recipes.id_recipe_category" => $recipe[0]["id_recipe_category"],
        'LIMIT' => 5
    ]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalles</title>
    <link rel="icon" href="./imgs/favicon.ico"/>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- Jquery -->
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- BS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        onerror="this.onerror=null;this.href='./css/vendors/bootstrap.min.css';" />
    <!-- Normalize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="./css/main.css" />
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <section class="details-bg-dark-base">
        <nav class="details-container-base d-flex justify-content-center align-items-center details-container-base">
            <div class="border-details w-100 d-flex justify-content-center align-items-center">
                <div class="row row-mv h-100 justify-content-center details-border">

                    <div class="data-container col-5 d-flex justify-content-center align-items-center">
                        <div class="details-card">
                            <h2 class="title-mdxl1"><?php echo $recipe[0]["recipe_name"];?></h2>
                            <div class="details-card-bg mt-4">
                                <?php echo "<img class='details-image' src='./imgs/recipe/".$recipe[0]['recipe_image']."'>"; ?>
                                <div class="details-data">
                                    <div class="details-info">
                                        <div class="details-text d-flex align-items-center h-100">
                                            <h3 class="details-time me-3"><?php echo $recipe[0]["recipe_cook_time"];?>
                                                cocción</h3>
                                            <h3 class="w-space-line">|</h3>
                                            <h3 class="details-time mx-3"><?php echo $recipe[0]["recipe_prep_time"];?>
                                                preparación</h3>
                                            <h3 class="w-space-line">|</h3>
                                            <h3 class="details-time ms-3"><?php echo $recipe[0]["recipe_time"];?> total
                                            </h3>
                                        </div>
                                        <div class="card-likes mt-3">
                                            <a type="button"
                                                href="likes.php?id_recipe=<?php echo $recipe[0]["id_recipe"]; ?>"><i
                                                    class="fa-solid fa-heart hearth-xl like"></i></a>
                                            <h2 class="like-count-xl mt-4"><?php echo $recipe[0]["recipe_likes"];?></h2>
                                        </div>
                                    </div>
                                    <div class="details-labels">
                                        <a class="lbl category-base" href="#"><?php echo $recipe[0]["recipe_category"];?></a>
                                        <a class='lbl category-base' href='#'><?php echo $recipe[0]["recipe_occasion"];?></a>
                                        <a class='lbl category-base' href='#'><?php echo $recipe[0]["recipe_yields"];?>
                                            Porciones</a>
                                        <a class="lbl <?php echo strtolower($recipe[0]["recipe_level"]);?>"
                                            href="#"><?php echo $recipe[0]["recipe_level"];?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center align-items-center mt-4 details-data-container">
                        <div class="container-details h-100 d-flex justify-content-center align-items-center">
                            <div class="div-100">
                                <div class="d-flex">
                                    <div class="description-text-container preparation w-100 h-50">
                                        <h2 class="title-md1">Descripción</h2>
                                        <p class="details-text"><?php echo $recipe[0]["recipe_description"];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md d-flex justify-content-center align-items-center mt-4 details-data-container">
                        <div class="container-details w-100 h-100 d-flex justify-content-center align-items-start">
                            <div>
                                <div class="d-flex w-100 h-50">
                                    <div class="text-container description w-100">
                                        <h2 class="title-md1">Preparación</h2>
                                        <p class="details-text preparation-text">
                                            <?php echo $recipe[0]["recipe_directions"];?></p>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md d-flex justify-content-center align-items-center mt-4 details-data-container">
                        <div class="container-details w-100 h-100 d-flex justify-content-center align-items-start">
                            <div>
                                <div class="d-flex w-100 h-50">
                                    <div class="text-container ingredients">
                                        <h2 class="title-md1">Ingredientes</h2>
                                        <p class="details-text">
                                        <ul>
                                            <?php 
                                                    $ingredients = [];
                                                    $ingredients = explode(",", $recipe[0]["recipe_ingredients"]);
                                                
                                                    foreach ($ingredients as $key => $ingredient){
                                                        if($key != array_key_last($ingredients)){
                                                            echo "<li>".$ingredient."</li>";
                                                        }
                                                    }

                                                ?>
                                        </ul>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <section class="nav-ten2 container-nav">
        <div class="container-ld d-flex justify-content-center align-items-center">
            <div class="w-100">
                <div class="d-flex justify-content-between align-items-end title-subidos-container">
                    <h2 class="title-options ms-4">Recetas relacionadas</h2>
                </div>
                <div class="row row-1">
                    <?php
                            foreach ($related_recipes as $recipe){
                                echo "<div class='col recipe-card-1'>
                                    <a href='details.php?id_recipe=".$recipe["id_recipe"]."'>
                                        <div class='card-bg'>
                                            <img class='card-image' src='./imgs/recipe/".$recipe["recipe_image"]."'alt='".$recipe["recipe_name"]."'/>
                                            <div class='card-data'>
                                                <div class='card-info'>
                                                    <div class='card-text'>
                                                        <h2 class='card-title'>".$recipe["recipe_name"]."</h2>
                                                        <h3 class='card-time'>".$recipe["recipe_time"]."</h3>
                                                    </div>
                                                    <div class='card-likes'><i class='fa-solid fa-heart hearth'></i>
                                                        <h2 class='like-count'>".$recipe["recipe_likes"]."</h2>
                                                    </div>
                                                </div>
                                                <div class='card-labels'>
                                                    <a class='lbl category-base' href='#'>".$recipe["recipe_category"]."</a>
                                                    <a class='lbl ".strtolower($recipe["recipe_level"])."' href='#'>".$recipe["recipe_level"]."</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>";
                            }
                        ?>
                </div>
            </div>
        </div>
    </section>
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