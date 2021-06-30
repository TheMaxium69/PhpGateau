<?php

namespace Controllers;


class Recipe extends Controller
{

    protected $modelName = \Model\Recipe::class;



    /**
     *
     * supprimer une annonce
     */
    public function supp(){


        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $recipe_id = $_GET['id'];
        }
        if(!$recipe_id){
            die("il faut entrer un id valide en paramtre dans l'url");
        }



        $recipe = $this->model->find($recipe_id);



        if(!$recipe){
            die("cette recette est inexistante");
        }


        $this->model->delete($recipe_id);

        \Http::redirect('index.php?controller=gateau&task=index');
    }


    public function add(){

        $recipeAdd = false;

            if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
                $gateau_id = $_GET['id'];


                if(!empty($_POST['name']) && !empty($_POST['desc'])){
                    $name = htmlspecialchars($_POST['name']);
                    $desc = htmlspecialchars($_POST['desc']);
                    $recipeAdd = true;
                }

                if ($recipeAdd == true) {

                    $this->model->insert($name, $desc, $gateau_id);

                    \Http::redirect("index.php");
                }else {

                    $recipeEdit = false;


                    if (!empty($_GET['idrecipe']) && ctype_digit($_GET['idrecipe'])){
                        $recipe_id = $_GET['idrecipe'];
                        $recipeEdit = true;
                    }

                    if (!$recipeEdit) {
                        $recipe_id = null;
                        $titreDeLaPage = "nouveau recette";
                        \Rendering::render('recipes/addrecipe',
                            compact('gateau_id', 'recipe_id', 'titreDeLaPage'));
                    } else {

                            $recipe = $this->model->find($recipe_id);
                        $recipeName = $recipe->name;


                        $titreDeLaPage = "Editer $recipeName";
                        \Rendering::render('recipes/addrecipe',
                            compact('gateau_id',  'recipe', 'recipe_id', 'titreDeLaPage'));

                    }


            }
        }

    }

    public function edit(){

        if(!empty($_POST['name']) && !empty($_POST['desc']) && !empty($_POST['idrecipe']) && ctype_digit($_POST['idrecipe']) && !empty($_POST['idgateau']) && ctype_digit($_POST['idgateau'])){

            $name = htmlspecialchars($_POST['name']);
            $desc = htmlspecialchars($_POST['desc']);
            $idrecipe = htmlspecialchars($_POST['idrecipe']);
            $idgateau = htmlspecialchars($_POST['idgateau']);


            $this->model->update($idrecipe, $name, $desc, $idgateau);


            \Http::redirect("index.php?controller=gateau&task=show&id=$idgateau");


        }else{
            die('tu essayes de faire quoi la ?');
        }
    }

}