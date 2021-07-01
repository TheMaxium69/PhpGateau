<?php

namespace Model;


class Make extends Model
{

    protected $table = "makes";

    public $id;
    public $recipe_id;
    public $gateau_id;
    public $user_id;


    function insert(int $col_id, string $col_name, int $user_id)
    {

        if ($col_name == "gateau_id") {

            $maRequeteInsertMakesGateau = $this->pdo->prepare("INSERT INTO `makes`(`gateau_id`, `user_id`) VALUES (:col_id, :user_id)");

            $maRequeteInsertMakesGateau->execute([
                'col_id' => $col_id,
                'user_id' => $user_id
            ]);
        } else if ($col_name == "recipe_id") {

                $maRequeteInsertMakesRecipe = $this->pdo->prepare("INSERT INTO `makes`(`recipe_id`, `user_id`) VALUES (:col_id, :user_id)");

                $maRequeteInsertMakesRecipe->execute([
                    'col_id' => $col_id,
                    'user_id' => $user_id
                ]);
        }
    }

    function count(int $col_id, string $col_name)
    {
        if ($col_name == "gateau_id"){

            $maRequeteCountGateauMakes =  $this->pdo->prepare("SELECT * FROM `makes` WHERE `gateau_id`=:col_id");
            $maRequeteCountGateauMakes->execute(["col_id"=> $col_id]);
            $makesGateauNb = $maRequeteCountGateauMakes->rowCount();
            return $makesGateauNb;

        } else if ($col_name == "recipe_id"){

            $maRequeteCountRecipeMakes =  $this->pdo->prepare("SELECT * FROM `makes` WHERE `recipe_id`=:col_id");
            $maRequeteCountRecipeMakes->execute(["col_id"=> $col_id]);
            $makesRecipeNb = $maRequeteCountRecipeMakes->rowCount();
            return $makesRecipeNb;
        }

    }

    function findByUserCol(int $col_id, string $col_name, int $user_id)
    {

        if ($col_name == "gateau_id") {

            $SqlMake = $this->pdo->prepare("SELECT * FROM `makes` WHERE `gateau_id`=:col_id && `user_id`=:user_id");

            $SqlMake->execute([
                'col_id' => $col_id,
                'user_id' => $user_id
            ]);

            $make = $SqlMake->fetchObject();

            
        } else if ($col_name == "recipe_id") {

                $SqlMake = $this->pdo->prepare("SELECT * FROM `makes` WHERE `recipe_id`=:col_id && `user_id`=:user_id");

                $SqlMake->execute([
                    'col_id' => $col_id,
                    'user_id' => $user_id
                ]);

                $make = $SqlMake->fetchObject();
        }
        return $make;
    }
}
