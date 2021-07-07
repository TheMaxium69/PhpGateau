<?php

namespace Controllers;


class User extends Controller
{

    protected $modelName = \Model\User::class;


    public function login(){
        $reponse = null;

        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $usernameLogin = $_POST['username'];
            $passwordLogin = $_POST['password'];
                $resultLogin = $this->model->login($usernameLogin, $passwordLogin);
                if($resultLogin){
                    \Http::redirect('index.php?controller=gateau&task=index&info=login');
                }else{
                    $reponse = "Erreur de connexion";
                }
        }    
            $titreDeLaPage = "Connection";
            \Rendering::render('users/login', compact('reponse', 'titreDeLaPage'));
    }

    public function loginApi(){
        $reponse = null;

        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $usernameLogin = $_POST['username'];
            $passwordLogin = $_POST['password'];
            $resultLogin = $this->model->login($usernameLogin, $passwordLogin);
            if($resultLogin){
                $modelUser = new \Model\User();
                $user = $modelUser->getUser();

                header("Access-Control-Allow-Origin: *");
                echo json_encode($user);
            }else{
                $reponse = "Erreur de connexion";
                echo json_encode($reponse);
            }
        }else{
            $reponse = "inutile de ce connecter sans username et mdp";
            echo json_encode($reponse);
        }
    }

    public function loggout(){
        $this->model->loggout();
    
        \Http::redirect('index.php?controller=gateau&task=index');
    }


    public function index(){
            $LoggedIn = $this->model->isLoggedIn();
            if($LoggedIn){
                $titreDeLaPage = "Profil";
                \Rendering::render('users/profil', compact('titreDeLaPage'));
            }else{
                \Http::redirect('index.php?controller=gateau&task=index');
            }

    }

    public function signup(){
        $LoggedIn = $this->model->isLoggedIn();
        if($LoggedIn){
            \Http::redirect('index.php?controller=gateau&task=index');
        }else{
            $reponse = null;

            if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])){

                $user = new \Model\User();

                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);


                $user->username = $_POST['username'];
                $user->email = $_POST['email'];
                $this->model->set($user, $password);

                $isUser = $this->model->findByUsername($user->username);

                if(!$isUser){
                    if($_POST['password'] == $_POST['passwordConfirm']){
                        $this->model->signup($user);
                        \Http::redirect('index.php?controller=gateau&task=index&info=signup');
                    }else{
                        $reponse = "Votre mots de passe n'est pas le même";
                    }
                }else{
                    $reponse ="Votre Username est déjà utiliser";
                }
            }
            
            $titreDeLaPage = "Inscription";
            \Rendering::render('users/signup', compact('reponse', 'titreDeLaPage'));
        }

    }

}