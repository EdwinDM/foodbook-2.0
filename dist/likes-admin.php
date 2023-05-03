<?php
    require 'db.php';

    if(isset($_GET)){
        
        $data = $database->select("tb_revision_recipes", "*", [
            "id_recipe" => $_GET["id_recipe"]
        ]);

        $likes = $data[0]["recipe_likes"];
        $likes++;

        $database->update("tb_revision_recipes",[
            "recipe_likes" => $likes
        ],[
            "id_recipe"=>$_GET["id_recipe"]
        ]);

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
    }
?>