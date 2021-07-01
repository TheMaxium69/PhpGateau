<?php

namespace Controllers;

class Make extends Controller
{

    protected $modelName = \Model\Make::class;

    public function add(){
        
        $modelUser = new \Model\User();
        $user = $modelUser->getUser();

        if (!empty($_GET['idrecipe'])){
            $recipe_id = $_GET['idrecipe'];
            $this->model->insert($recipe_id, "recipe_id", $user->id);
        } else if (!empty($_GET['idgateau'])){
            $gateau_id = $_GET['idgateau'];
            $this->model->insert($gateau_id, "gateau_id", $user->id);
        } else {
            echo "tu fais quoi ?";
        }
        
        if($_GET['indexpage'] == 1){
            
        \Http::redirect('index.php?controller=gateau&task=index');
        } else {
        \Http::redirect('index.php?controller=gateau&task=show&id='.$_GET['idgateau']);
        }
    }

    public function supp(){
        
        $modelUser = new \Model\User();
        $user = $modelUser->getUser();

        if (!empty($_GET['idrecipe'])){
            $recipe_id = $_GET['idrecipe'];
            $make = $this->model->findByUserCol($recipe_id, "recipe_id", $user->id);
            $this->model->delete($make->id);
        } else if (!empty($_GET['idgateau'])){
            $gateau_id = $_GET['idgateau'];
            $make = $this->model->findByUserCol($gateau_id, "gateau_id", $user->id);
            $this->model->delete($make->id);
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