<?php


namespace Controllers;



class Gateau extends Controller
{

    protected $modelName = \Model\Gateau::class;
    


    /**
     * afficher l'accueil du site
     *
     *
     */

    public function index()
    {


        //on recupère tous les garages
        $gateaux = $this->model->findAll($this->modelName);



        //on fixe le titre de la page
        $titreDeLaPage = "Gateaux";

        //on affiche
        \Rendering::render("gateaux/gateaux",
            compact('gateaux', 'titreDeLaPage')
        );

    }

    public function indexApi()
    {


        //on recupère tous les garages
        $gateaux = $this->model->findAll($this->modelName);

        header('Access-Control-Allow-Origin: *');

        //Json
        echo json_encode($gateaux);

    }

    public function suppr(){


        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $gateau_id = $_GET['id'];
        }
        if(!$gateau_id){

            die("il faut entrer un id valide en paramtre dans l'url");
        }

        // on veut verifier que cet garage existe bien dans la base de données
        $gateau = $this->model->find($gateau_id);


        //si le garage n'existe pas
        if(!$gateau){
            die("ce gateau est inexistant");
        }
        // alors , faire la requete de suppression

        $this->model->delete($gateau_id);

        \Http::redirect('index.php?controller=gateau&task=index');

    }

    public function showApi(){



        $gateau_id = null;

        if(!empty($_POST['id']) && ctype_digit($_POST['id'])){

            $gateau_id = $_POST['id'];
        }

        if(!$gateau_id){
            die("il faut absolument entrer un id dans l'url pour que le script fonctionne");
        }



        $gateau = $this->model->find($gateau_id);

        $modelRecipe = new \Model\Recipe();
        $classRecipe = \Model\Recipe::class;
        $recipes = $modelRecipe->findAllByGateau($gateau_id, $classRecipe);
        
        header("Access-Control-Allow-Origin: *");

        //Json
        echo json_encode(['gateau' => $gateau, 
                          'recipes' => $recipes]);
    }
    public function show(){



        $gateau_id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){

            $gateau_id = $_GET['id'];
        }

        if(!$gateau_id){
            die("il faut absolument entrer un id dans l'url pour que le script fonctionne");
        }



        $gateau = $this->model->find($gateau_id);

        $modelRecipe = new \Model\Recipe();
        $classRecipe = \Model\Recipe::class;
        $recipes = $modelRecipe->findAllByGateau($gateau_id, $classRecipe);
        $titreDeLaPage = $gateau->name;

        \Rendering::render('gateaux/gateau',
            compact('gateau', 'recipes','titreDeLaPage')
        );
    }

    public function create(){

        if(!empty($_POST['name']) ){
            $name = htmlspecialchars($_POST['name']);
        }

        if(!empty($_POST['gout']) ){
            $gout = htmlspecialchars($_POST['gout']);
        }


        if(!$name || !$gout ){
            die("formulaire mal rempli");
        }

        $modelUser = new \Model\User();
        $user = $modelUser->getUser();
        $this->model->insert($name, $gout, $user->id);


        \Http::redirect('index.php?controller=gateau&task=index');
    }

    public function add(){

        $gateauAdd = false;

        if(!empty($_POST['name']) && !empty($_POST['gout'])){
            $name = htmlspecialchars($_POST['name']);
            $gout = htmlspecialchars($_POST['gout']);
            $gateauAdd = true;
        }

        if ($gateauAdd == true) {
            
            $modelUser = new \Model\User();
            $user = $modelUser->getUser();
            $this->model->insert($name, $gout, $user->id);

            \Http::redirect("index.php");
        }else{

            $gateauEdit = false;

            if( !empty($_GET['id']) && ctype_digit($_GET['id'])   ){

                $gateau_id = $_GET['id'];
                $gateauEdit = true;

            }


            if(!$gateauEdit){
                $gateau = null;
                $titreDeLaPage = "nouveau gateau";
                \Rendering::render('gateaux/addgateau',
                    compact('gateau','titreDeLaPage'));
            }else{

                $gateau = $this->model->find($gateau_id);
                $gateauName = $gateau->name;


                $titreDeLaPage = "Editer $gateauName";
                \Rendering::render('gateaux/addgateau',
                    compact('gateau','titreDeLaPage'));

            }



        }

    }

    public function edit(){

        if(!empty($_POST['name']) && !empty($_POST['gout']) && !empty($_POST['id']) && ctype_digit($_POST['id'])){

            $gateau_id = $_POST['id'];
            $name = htmlspecialchars($_POST['name']);
            $gout = htmlspecialchars($_POST['gout']);


            $this->model->update($gateau_id, $name, $gout);


            \Http::redirect("index.php?controller=gateau&task=show&id=$gateau_id");


        }else{
            die('tu essayes de faire quoi la ?');
        }
    }

}