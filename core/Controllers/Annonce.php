<?php

namespace Controllers;


class Annonce extends Controller
{

    protected $modelName = \Model\Annonce::class;



    /**
     * 
     * supprimer une annonce
     */
    public function suppr(){
        
      
        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
                $annonce_id = $_GET['id'];
        }
        if(!$annonce_id){
            die("il faut entrer un id valide en paramtre dans l'url");
        }
        
    
        
        $annonce = $this->model->find($annonce_id);
        
        
        
        if(!$annonce){
            die("cette annonce est inexistante");
        }
        
        
        $this->model->delete($annonce_id);
        
        \Http::redirect('index.php?controller=garage&task=show&id='.$annonce['garage_id']);
    }


    /**
     * enregistrer une annonce
     * 
     * 
     */
    public function save(){

        
        $garage_id = null;
        $name = null;
        $price = null;
        
        if(!empty($_POST['garageId']) && ctype_digit($_POST['garageId']) ){
            $garage_id = $_POST['garageId'];
        }
        
        if(!empty($_POST['name']) ){
            $name = htmlspecialchars($_POST['name']);
        }
        
        if(!empty($_POST['price']) ){
            $price = htmlspecialchars($_POST['price']);
        }
        
        if( !$garage_id || !$name || !$price ){
            die("formulaire mal rempli");
        }
        
        $modelGarage = new \Model\Garage();
        
          $garage = $modelGarage->find($garage_id);
        
          if(!$garage){
        
            die("garage inexistant");
          }
        
    
        
        $this->model->insert($name,$price,$garage_id);
        
        \Http::redirect('index.php?controller=garage&task=show&id='.$garage_id);
        

    }



}