<?php
    require 'db.php';

    session_start();
        if(isset($_SESSION["isLoggedIn"])){    
        $categories = $database->select("tb_recipe_category", "*");
        $levels = $database->select("tb_recipe_levels", "*");
        $occasions = $database->select("tb_recipe_occasions", "*");
        $featured = "nada";

        if(isset($_GET)){
            $data = $database->select("tb_recipes", "*", [
                "id_recipe" => $_GET["id"]
            ]);
        }
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
    <title>Editar</title>

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

    <section id="nav-options" class="nav-options-admin">
        <div class="container-base-admin">
            <form class="subir-items" action="update.php" method="post" enctype="multipart/form-data">
                <div class="d-flex justify-content-between align-items-end title-subidos-container">
                    <h2 class="title-options subir-title edit-title ms-4">Editar receta</h2>
                </div>
                <div class="add-recipes-container">
                    <div class="row h-75 d-flex justify-content-center data-form">
                        <div class="col d-flex justify-content-center mv-col">
                            <div class="file-upload">
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" id="recipe_image" type="file" name="recipe_image"
                                        onchange="readURL(this)">
                                    <div class="drag-text d-flex justify-content-center align-items-center">
                                        <img class="file-upload-image"
                                            src="./imgs/recipe/<?php echo $data[0]["recipe_image"];?>">
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
                                <input class="input-data-recipe input-m" type="text" name="recipe" placeholder="Nombre"
                                    value="<?php echo $data[0]["recipe_name"];?>" />
                                <input class="input-data-recipe input-xl" type="text" name="description"
                                    placeholder="Descripción" value="<?php echo $data[0]["recipe_description"];?>" />
                                <div>
                                    <div id='ingredients'>
                                        <?php
                                            $ingredients = [];
                                            $ingredients = explode(",", $data[0]["recipe_ingredients"]);
                                            foreach ($ingredients as $ingredient) {
                                                echo "<div>";
                                                    echo "<input type='text' name='ingredients[]' class='input-data-recipe input-ingredients' value='$ingredient'>";
                                                    echo "<button class='remove-ingredient delete-ingredient'>X</button>";
                                                echo "</div>";
                                            }
                                        ?>
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
                                    btn.setAttribute('class', 'delete-ingredient');
                                    btn.innerText = "X";
                                    btn.type = "button";
                                    btn.addEventListener("click", function() {
                                        document.querySelector('#' + id).remove();
                                    });
                                    document.querySelector('#' + id).appendChild(btn);
                                });

                                let registered_ingredients = document.querySelectorAll('.remove-ingredient');
                                for (let i = 0; i < registered_ingredients.length; i++) {
                                    registered_ingredients[i].addEventListener("click", function(event) {
                                        event.preventDefault();
                                        this.parentNode.remove();
                                    });
                                }
                                </script>
                            </div>
                        </div>


                        <div class="col-5 d-flex justify-content-center mv-col e-mt">
                            <div class="data-col-2 w-100">
                                <div class="d-flex justify-content-center">
                                    <input class="input-data-recipe input-l me-3" name="cook-time" type="text"
                                        placeholder="Tiempo de cocción"
                                        value="<?php echo $data[0]["recipe_cook_time"];?>" />
                                    <input class="input-data-recipe input-l ms-3" name="yields" type="text"
                                        placeholder="Porciones" value="<?php echo $data[0]["recipe_yields"];?>" />
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input class="input-data-recipe input-l me-3" name="prep-time" type="text"
                                        placeholder="Tiempo de preparación"
                                        value="<?php echo $data[0]["recipe_prep_time"];?>" />
                                    <input class="input-data-recipe input-l ms-3" name="total-time" type="text"
                                        placeholder="Tiempo total" value="<?php echo $data[0]["recipe_time"];?>" />
                                </div>
                                <div class="d-flex justify-content-center">

                                    <select class="input-data-recipe input-s me-3" name="category" id="">
                                        <option selected disabled>Choose Category</option>
                                        <?php
                                            $len = count($categories);
                                            for($i=0; $i<$len; $i++){
                                                if($data[0]["id_recipe_category"] === $categories[$i] ['id_recipe_category']){
                                                    echo '<option value="'.$categories[$i]
                                                    ['id_recipe_category'].'"selected>'.$categories[$i]
                                                    ['recipe_category'].'</option>';
                                                    } else{
                                                        echo '<option value="'.$categories[$i]
                                                        ['id_recipe_category'].'">'.$categories[$i]
                                                        ['recipe_category'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>

                                    <select class="input-data-recipe input-s" name="level" id="">
                                        <option selected disabled>Choose Level</option>
                                        <?php
                                            $len = count($levels);
                                            for($i=0; $i<$len; $i++){
                                                if($data[0]["id_recipe_level"] === $levels[$i] ['id_recipe_level']){
                                                    echo '<option value="'.$levels[$i]
                                                    ['id_recipe_level'].'"selected>'.$levels[$i]
                                                    ['recipe_level'].'</option>';
                                                    } else{
                                                        echo '<option value="'.$levels[$i]
                                                        ['id_recipe_level'].'">'.$levels[$i]
                                                        ['recipe_level'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>

                                    <select class="input-data-recipe input-s ms-3" name="occasion" id="">
                                        <option selected disabled>Choose Occasion</option>
                                        <?php
                                            $len = count($occasions);
                                            for($i=0; $i<$len; $i++){
                                                if($data[0]["id_recipe_occasion"] === $occasions[$i] ['id_recipe_occasion']){
                                                    echo '<option value="'.$occasions[$i]
                                                    ['id_recipe_occasion'].'"selected>'.$occasions[$i]
                                                    ['recipe_occasion'].'</option>';
                                                    } else{
                                                        echo '<option value="'.$occasions[$i]
                                                        ['id_recipe_occasion'].'">'.$occasions[$i]
                                                        ['recipe_occasion'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input class="input-data-recipe input-2xl" name="directions" type="text"
                                        placeholder="Instrucciones de preparación"
                                        value="<?php echo $data[0]["recipe_directions"];?>" />
                                </div>
                                <input type="hidden" name="id" value="<?php echo $data[0]["id_recipe"];?>">
                                <div class="form-check form-check-inline featured-div">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <h1 class="featured-title pe-2">Destacada</h1>
                                        <input
                                            <?php if($data[0]["recipe_is_featured"] == 1){echo "checked";}else{echo " ";} ?>
                                            class="form-check-input featured" type="checkbox" name="featured">
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