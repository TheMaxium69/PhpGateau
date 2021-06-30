<?php

namespace Controllers;



class Garage extends Controller
{   

    protected $modelName = \Model\Garage::class;

    public function index(){






                    //on recupère tous les garages
                    $garages = $this->model->findAll();

                    //on fixe le titre de la page
                    $titreDeLaPage = "Garages";

                    //on affiche
                    \Rendering::render( "garages/garages" ,
                            compact('garages', 'titreDeLaPage')  
                        );

    }

    


    /**
     * 
     * afficher UN garage
     */
    public function show(){



                $garage_id = null;

                if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

                    $garage_id = $_GET['id'];
                }
                
                if(!$garage_id){
                    die("il faut absolument entrer un id dans l'url pour que le script fonctionne");
                }


               
                $garage = $this->model->find($garage_id);

                    
                $modelAnnonce = new \Model\Annonce();
                $annonces = $modelAnnonce->findAllByGarage($garage_id);
  
                $titreDeLaPage = $garage['name'];

                \Rendering::render('garages/garage',
                        compact('garage', 'annonces','titreDeLaPage')       
                );
    }

    /**
     * 
     * supprimer un garage
     */

    public function suppr(){

        
            if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
                $garage_id = $_GET['id']; 
                }
            if(!$garage_id){
        
                die("il faut entrer un id valide en paramtre dans l'url");
                        }
                
            // on veut verifier que cet garage existe bien dans la base de données
            $garage = $this->model->find($garage_id);
            
            
            //si le garage n'existe pas
            if(!$garage){
                die("ce garage est inexistant");
            }
            // alors , faire la requete de suppression
            
            $this->model->delete($garage_id);
            
            \Http::redirect('index.php');

        }

}