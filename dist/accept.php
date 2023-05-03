<?php 

require 'db.php';

$database->insert("tb_recipes", [
    "recipe_name"=>$_POST["name"],
    "recipe_time"=>$_POST["total-time"],
    "recipe_cook_time"=>$_POST["cook-time"],
    "recipe_prep_time"=>$_POST["prep-time"],
    "recipe_image"=>$_POST["image"],
    "recipe_likes"=>$_POST["likes"],
    "id_recipe_category"=>$_POST["category"],
    "id_recipe_level"=>$_POST["level"],
    "recipe_directions"=>$_POST["directions"],
    "recipe_description"=>$_POST["description"],
    "recipe_yields"=>$_POST["yields"],
    "recipe_is_featured"=>$_POST["featured"],
    "id_recipe_occasion"=>$_POST["occasion"],
    "recipe_ingredients"=>$_POST["ingredients"]
]);

$database->delete("tb_revision_recipes", [
    "id_recipe"=>$_POST["id"]
]);

header("location: admin.php");
?>