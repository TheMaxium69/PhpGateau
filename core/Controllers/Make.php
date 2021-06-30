<?php

namespace Controllers;

class Make extends Controller
{

    protected $modelName = \Model\Make::class;

    public function add(){

        if (!empty($_GET['idrecipe'])){
            $recipe_id = $_GET['idrecipe'];
            $this->model->insert($recipe_id, "recipe_id");
        } else if (!empty($_GET['idgateau'])){
            $gateau_id = $_GET['idgateau'];
            $this->model->insert($gateau_id, "gateau_id");
        } else {
            echo "tu fais quoi ?";
        }
        
        if($_GET['indexpage'] == 1){
            
        \Http::redirect('index.php?controller=gateau&task=index');
        } else {
        \Http::redirect('index.php?controller=gateau&task=show&id='.$_GET['idgateau']);
        }
    }

}