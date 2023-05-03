<?php 

require 'db.php';

$database->delete("tb_revision_recipes", [
    "id_recipe"=>$_POST["id"]
]);

header("location: admin.php#recetas-subidas");
?>