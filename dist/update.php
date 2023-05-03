<?php
    require 'db.php';

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        return $randomString;
    }

    $data = $database->select("tb_recipes", "*", [
        "id_recipe" => $_POST["id"]
    ]);

    if($_FILES["recipe_image"]["name"] == ""){
        $img = $data[0]["recipe_image"];
    } else {
        if(isset($_FILES["recipe_image"])){
            $error = array();
            $file_name = $_FILES["recipe_image"]["name"];
            $file_size = $_FILES["recipe_image"]["size"];
            $file_tmp = $_FILES["recipe_image"]["tmp_name"];
            $file_type = $_FILES["recipe_image"]["type"];
            $file_ext_arr = explode(".", $_FILES["recipe_image"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = array("jpeg","png", "jpg", "gif");

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type is not supported";
            }

            if(empty($errors)){
                $img = "recipe-upload-".generateRandomString().".".$file_ext;
                move_uploaded_file($file_tmp, "imgs/recipe/".$img);
            }
        }
    }

    $ingredients = "";
            foreach($_POST["ingredients"] as $key => $ingredient){
                if($key == array_key_last($_POST["ingredients"])){
                    $ingredients.= $ingredient;
                } else{
                    $ingredients.= $ingredient.",";
                }
            }

    if(isset($_POST['featured'])){
        $featured = 1;
    } else{
        $featured = 0;
    }

    $database->update("tb_recipes", [
        "recipe_name" => $_POST["recipe"],
        "id_recipe_category" => $_POST["category"],
        "id_recipe_level" => $_POST["level"],
        "id_recipe_occasion" => $_POST["occasion"],
        "recipe_cook_time" => $_POST["cook-time"],
        "recipe_prep_time" => $_POST["prep-time"],
        "recipe_time" => $_POST["total-time"],
        "recipe_description" => $_POST["description"],
        "recipe_yields" => $_POST["yields"],
        "recipe_is_featured" => $featured,
        "recipe_directions" => $_POST["directions"],
        "recipe_image" => $img,
        "recipe_ingredients" => $ingredients
    ],[
        "id_recipe"=>$_POST["id"]
    ]);

    header("location: admin.php");
?>