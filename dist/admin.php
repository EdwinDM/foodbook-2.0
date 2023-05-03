<?php
    require 'db.php';

    session_start();
    if(isset($_SESSION["isLoggedIn"])){
        $levels = $database->select("tb_recipe_levels","*");
        $categories = $database->select("tb_recipe_category","*");
        $occasions = $database->select("tb_recipe_occasions","*");

    //---------------------------------- All Recipes ----------------------------------\\ 

        $revision = $database->select("tb_revision_recipes",[
            "[>]tb_recipe_category"=>["id_recipe_category" => "id_recipe_category"],
            "[>]tb_recipe_levels"=>["id_recipe_level" => "id_recipe_level"],
            "[>]tb_recipe_occasions"=>["id_recipe_occasion" => "id_recipe_occasion"],
        ],[
            "tb_revision_recipes.id_recipe",
            "tb_revision_recipes.recipe_name",
            "tb_revision_recipes.recipe_time",
            "tb_revision_recipes.recipe_cook_time",
            "tb_revision_recipes.recipe_image",
            "tb_revision_recipes.recipe_likes",
            "tb_revision_recipes.id_recipe_category",

            "tb_recipe_category.recipe_category",

            "tb_revision_recipes.id_recipe_level",

            "tb_recipe_levels.recipe_level",

            "tb_revision_recipes.recipe_directions",
            "tb_revision_recipes.recipe_description",
            "tb_revision_recipes.recipe_yields",
            "tb_revision_recipes.recipe_is_featured",
            "tb_revision_recipes.recipe_prep_time",
            "tb_revision_recipes.id_recipe_occasion",
            "tb_recipe_occasions.recipe_occasion",
            "tb_revision_recipes.recipe_ingredients"
        ],[
            "ORDER" => [
                "id_recipe" => "ASC"
            ]
        ]);

    //---------------------------------- The Most New ----------------------------------\\ 

        $uploaded = $database->select("tb_recipes",[
            "[>]tb_recipe_category"=>["id_recipe_category" => "id_recipe_category"],
            "[>]tb_recipe_levels"=>["id_recipe_level" => "id_recipe_level"],
            "[><]tb_recipe_occasions"=>["id_recipe_occasion" => "id_recipe_occasion"],
        ],[
            "tb_recipes.id_recipe",
            "tb_recipes.id_recipe_category",
            "tb_recipes.recipe_name", 
            "tb_recipes.recipe_time", 
            "tb_recipes.recipe_cook_time", 
            "tb_recipes.recipe_prep_time", 
            "tb_recipes.recipe_yields",
            "tb_recipes.recipe_is_featured", 
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
            "ORDER" => [
                "id_recipe" => "DESC"
            ],
        ]);
    }else{
        header("Location: login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrador</title>
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
                <div class="col">
                    <div class="container container-nav  ">
                        <div class="dropdown">
                            <i class=""></i>
                            <i class="fa-regular fa-circle-user profile-index hidden-form user-icon" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"></i>
                            <ul class="dropdown-menu text-center p-4">
                                <li><a class="title-sm2 profile-text"><?php echo $_SESSION["user"]?></a></li>
                                <li><a class="dropdown-item pt-3" href="logout.php">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- nav menu -->

    </header>

    <!-- Perfil administrador -->

    <section class="bg-dark-base">
        <nav class="container-base">
            <div class="info-base">
                <div>
                    <div class="d-flex justify-content-center align-items-center">
                        <h1 class="title-xlg user m-0 mb-3"><?php echo $_SESSION["user"]?></h1>
                        <h5 class="admin ms-3 mt-4">(Administrador)</h5>
                    </div>
                    <div class="d-flex justify-content-center align-text-center uploads">
                        <h3 class="upload-text-admin"><?php echo count($revision);?> Recetas en revisión</h3>
                        <i class="fa-solid fa-arrow-up-from-bracket upload-icon ms-4"></i>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <!-- Perfil de Administrador -->

    <!-- Opciones de Administrador -->

    <section id="nav-options" class="nav-options-admin">
        <div id="recetas-subidas" class="container-base-admin">
            <div class="d-flex justify-content-center">
                <ul class="admin-options d-flex justify-content-between align-items-center ps-0 pt-5 mb-4">
                    <li class="options subidos-option list-unstyled">SUBIDOS</li>
                    <h3 class="space-line">|</h3>
                    <li class="options subir-option list-unstyled">SUBIR RECETAS</li>
                    <h3 class="space-line">|</h3>
                    <li class="options revision-option list-unstyled">EN REVISIÓN</li>
                </ul>
            </div>



            <!-- Opciones de Administrador -->

            <!-- Opcion de Subidos -->
            <div id="subidos" class="subidos-items mt-4 d-flex justify-content-center">
                <div class="container-ld">
                    <div>
                        <div class="d-flex justify-content-between align-items-end title-subidos-container">
                            <h2 class="title-options  ms-4">Recetas subidas</h2>
                        </div>
                        <div class="row row-1">
                            <?php
                                foreach ($uploaded as $recipe){                                    
                                    echo "<div class='col recipe-card-1'>
                                                    <a href='details-admin.php?id_recipe=".$recipe["id_recipe"]."'>
                                                        <div class='card-bg'>";
                                                        if($recipe["recipe_is_featured"] == 1){echo "<h1 class='featured-recipe'>Destacada</h1>";}else{echo "";}
                                                        echo "<img class='card-image' src='./imgs/recipe/".$recipe["recipe_image"]."'alt='".$recipe["recipe_name"]."'/>
                                                            <div class='card-data'>
                                                                <div class='card-info'>
                                                                    <div class='card-text'>
                                                                        <h2 class='card-title'>".$recipe["recipe_name"]."</h2>
                                                                        <h3 class='card-time'>".$recipe["recipe_time"]."</h3>
                                                                    </div>
                                                                    <div class='card-likes'>
                                                                        <a href='edit.php?id=".$recipe["id_recipe"]."'><i class='fa-solid fa-pen-to-square card-options edit'></i></a>
                                                                        <form action='delete.php' method='post'> 
                                                                            <input class='delete' type='submit' value=''>
                                                                            <input type='hidden' name='id' value='".$recipe["id_recipe"]."'>
                                                                        </form>                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class='card-labels'>
                                                                    <a class='lbl lunch'>".$recipe["recipe_category"]."</a>
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
            </div>
            <!-- Opcion de Subidos -->

            <!-- Opcion de Subir Recetas -->

            <form id="subir" class="subir-items hiden-element" action="response.php" method="post"
                enctype="multipart/form-data">
                <div class="d-flex justify-content-between align-items-end title-subidos-container">
                    <h2 class="title-options subir-title ms-4">Subir receta</h2>
                </div>
                <div class="add-recipes-container">
                    <div class="row h-75 d-flex justify-content-center data-form">
                        <div class="col d-flex justify-content-center mv-col">
                            <div class="file-upload">
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" id="recipe_image" type="file" name="recipe_image"
                                        onchange="readURL(this)">
                                    <div class="drag-text d-flex justify-content-center align-items-center">
                                        <h3 class="px-3">Arrastra o selecciona una imagen</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <i class="fa-solid fa-xmark edit-recipe remove-image"
                                            onclick="removeUpload()"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col d-flex justify-content-center col-n2 mv-col">
                            <div class="data-col-2 d-block">
                                <input class="input-data-recipe input-m" type="text" name="recipe"
                                    placeholder="Nombre" />
                                <input class="input-data-recipe input-xl" type="text" name="description"
                                    placeholder="Descripción" />
                                <div>
                                    <div id="ingredients">
                                    </div>
                                    <button class="btn-base btn-green-admin" type="button" id="add-ingredient">Add
                                        ingredient</button>
                                </div>

                                <script>
                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        let reader = new FileReader();

                                        reader.onload = function(e) {
                                            let preview = document.getElementById('preview').setAttribute('src', e
                                                .target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                document.querySelector('#add-ingredient').addEventListener('click', function() {
                                    event.preventDefault();
                                    let ingredient = document.createElement("div");
                                    let id = "ingredient-" + Date.now();
                                    ingredient.id = id;
                                    document.querySelector('#ingredients').appendChild(ingredient);

                                    let input = document.createElement("input");
                                    input.type = "text";
                                    input.setAttribute('name', 'ingredients[]');
                                    input.classList.add('input-data-recipe', 'input-ingredients');
                                    input.placeholder = "Write the Ingredient";
                                    document.querySelector('#' + id).appendChild(input);

                                    let btn = document.createElement("button");
                                    btn.innerText = "X";
                                    btn.classList.add('delete-ingredient');
                                    btn.addEventListener("click", function() {
                                        document.querySelector('#' + id).remove();
                                    });
                                    document.querySelector('#' + id).appendChild(btn);

                                });
                                </script>
                            </div>
                        </div>


                        <div class="col-5 d-flex justify-content-center mv-col e-mt">
                            <div class="data-col-2 w-100">
                                <div class="d-flex justify-content-center">
                                    <input class="input-data-recipe input-l me-3" name="cook-time" type="text"
                                        placeholder="Tiempo de cocción" />
                                    <input class="input-data-recipe input-l ms-3" name="yields" type="text"
                                        placeholder="Porciones" />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input class="input-data-recipe input-l me-3" name="prep-time" type="text"
                                        placeholder="Tiempo de preparación" />
                                    <input class="input-data-recipe input-l ms-3" name="total-time" type="text"
                                        placeholder="Tiempo total" />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <select class="input-data-recipe input-s me-3" name="category" id="">
                                        <option selected disabled>Elige la Categoría</option>
                                        <?php
                                            $len = count($categories);
                                            for($i=0; $i<$len; $i++){
                                                echo '<option value="'.$categories[$i]
                                                    ['id_recipe_category'].'">'.$categories[$i]
                                                    ['recipe_category'].'</option>';
                                            }
                                        ?>
                                    </select>

                                    <select class="input-data-recipe input-s" name="level" id="">
                                        <option selected disabled>Elige el Nivel</option>
                                        <?php
                                            $len = count($levels);
                                            for($i=0; $i<$len; $i++){
                                                echo '<option value="'.$levels[$i]
                                                    ['id_recipe_level'].'">'.$levels[$i]
                                                    ['recipe_level'].'</option>';
                                            }
                                        ?>
                                    </select>

                                    <select class="input-data-recipe input-s ms-3" name="occasion" id="">
                                        <option selected disabled>Elige la Ocación</option>
                                        <?php
                                            $len = count($occasions);
                                            for($i=0; $i<$len; $i++){
                                                echo '<option value="'.$occasions[$i]
                                                    ['id_recipe_occasion'].'">'.$occasions[$i]
                                                    ['recipe_occasion'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input class="input-data-recipe input-2xl" name="directions" type="text"
                                        placeholder="Instrucciones de preparación" />
                                </div>
                                <div class="form-check form-check-inline featured-div">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <h1 class="featured-title pe-2">Destacada</h1>
                                        <input class="form-check-input featured" type="checkbox" name="featured">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input class="btn-base btn-green-admin justify-content-center" type="submit"
                                            value="SUBMIT">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Opcion de Subir Recetas -->

            <!-- Opcion de Revisión -->

            <div id="en-revision" class="revision-items mt-4 d-flex justify-content-center hiden-element">
                <div class="container-ld">
                    <div>
                        <div class=" d-flex justify-content-between align-items-end title-subidos-container">
                            <h2 class="title-options  ms-4">Recetas en revisión</h2>
                        </div>
                        <div class="row row-1">
                            <?php
                                foreach ($revision as $recipe){
                                    echo "<div class='col recipe-card-1'>
                                            <a href='details-admin.php?id_recipe=".$recipe["id_recipe"]."'>
                                                <div class='card-bg'>";
                                                    if($recipe["recipe_is_featured"] == 1){echo "<h1 class='featured-recipe'>Destacada</h1>";}else{echo "";}
                                                    echo "<img class='card-image' src='./imgs/recipe/".$recipe["recipe_image"]."'alt='".$recipe["recipe_name"]."'/>
                                                    <div class='card-data'>
                                                        <div class='card-info'>
                                                            <div class='card-text'>
                                                                <h2 class='card-title'>".$recipe["recipe_name"]."</h2>
                                                                <h3 class='card-time'>".$recipe["recipe_time"]."</h3>
                                                            </div>
                                                            <div class='card-likes'>
                                                                <i class='fa-solid fa-heart hearth'></i>
                                                                <h2 class='like-count'>".$recipe["recipe_likes"]."</h2>
                                                            </div>
                                                        </div>
                                                        <div class='card-labels'>
                                                            <a class='lbl lunch' href='#'>".$recipe["recipe_category"]."</a>
                                                            <a class='lbl ".strtolower($recipe["recipe_level"])."' href='#'>".$recipe["recipe_level"]."</a>
                                                        </div>
                                                    </div>
                                                    <div class='revision-options d-flex justify-content-center align align-items-center'>
                                                        <form action='accept.php' method='post'> 
                                                            <input class='accept' type='submit' value=''>
                                                            <input type='hidden' name='id' value='".$recipe["id_recipe"]."'>
                                                            <input type='hidden' name='image' value='".$recipe["recipe_image"]."'>
                                                            <input type='hidden' name='name' value='".$recipe["recipe_name"]."'>
                                                            <input type='hidden' name='likes' value='".$recipe["recipe_likes"]."'>
                                                            <input type='hidden' name='category' value='".$recipe["id_recipe_category"]."'>
                                                            <input type='hidden' name='cook-time' value=".$recipe["recipe_cook_time"].">
                                                            <input type='hidden' name='prep-time' value='".$recipe["recipe_prep_time"]."'>
                                                            <input type='hidden' name='total-time' value='".$recipe["recipe_time"]."'>
                                                            <input type='hidden' name='level' value='".$recipe["id_recipe_level"]."'>
                                                            <input type='hidden' name='directions' value='".$recipe["recipe_directions"]."'>
                                                            <input type='hidden' name='description' value='".$recipe["recipe_description"]."'>
                                                            <input type='hidden' name='yields' value='".$recipe["recipe_yields"]."'>
                                                            <input type='hidden' name='featured' value='".$recipe["recipe_is_featured"]."'>
                                                            <input type='hidden' name='occasion' value='".$recipe["id_recipe_occasion"]."'>
                                                            <input type='hidden' name='ingredients' value='".$recipe["recipe_ingredients"]."'>
                                                        </form>
                                                        <form action='decline.php' method='post'> 
                                                            <input class='decline' type='submit' value=''>
                                                            <input type='hidden' name='id' value='".$recipe["id_recipe"]."'>
                                                        </form>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Opcion de Revisión -->
        </div>



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
                                <li class="mb-3 footer-item"><a class="footer-link  "
                                        href="#">foodbook@example.co.cr</a>
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





    <script src="./js/admin-options.js"></script>
    <script src="./js/upload-input.js"></script>


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