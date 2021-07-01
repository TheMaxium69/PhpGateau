<?php

namespace Model;

use PDO;

class Recipe extends Model
{

    protected $table = "recipe";

    public $id;
    public $name;
    public $desc;
    public $gateau_id;
    public $user_id;

    /**
     * trouve toutes les annonces liées à un garage
     * par ce meme garage
     *
     * @param integer $gateau_id
     * @return array|bool
     *
     */

    function findAllByGateau(int $gateau_id, string $className)
    {


        $resultat =  $this->pdo->prepare('SELECT * FROM recipe WHERE gateau_id = :gateau_id');
        $resultat->execute(["gateau_id"=> $gateau_id]);

        $recipe = $resultat->fetchAll( PDO::FETCH_CLASS, $className);

        return $recipe;
    }


    /**
     * ajoute une recipe
     *
    */

    function insert(string $name, string $desc, int $gateau_id, int $user_id)
    {

        $maRequeteInsertRecipe = $this->pdo->prepare("INSERT INTO `recipe`(`name`, `desc`, `gateau_id`, `user_id`) VALUES (:name, :desc, :gateau_id, :user_id)");


        $maRequeteInsertRecipe->execute([
            'name' => $name,
            'desc' => $desc,
            'gateau_id' => $gateau_id,
            'user_id' => $user_id
        ]);

    }
    /**
     * update une recipe
     *
     */

    function update(int $id, string $name, string $desc, int $idgateau) : void
    {

        $maRequeteUpdateRecipe = $this->pdo->prepare("UPDATE `recipe` SET `name`=:name,`desc`=:desc,`gateau_id`=:idgateau WHERE `id`=:id");

        $maRequeteUpdateRecipe->execute([
            'id' => $id,
            'name' => $name,
            'desc' => $desc,
            'idgateau' => $idgateau
        ]);
    }

    /**
     * calculer le nombre de recipe d'un gateauu
     *
     * @param int $idgateau
     * @return mixed
     */

    function count(int $idgateau)
    {
        $maRequeteCountRecipe =  $this->pdo->prepare("SELECT COUNT(*) FROM `recipe` WHERE `gateau_id`=:gateau_id");
        $maRequeteCountRecipe->execute(["gateau_id"=> $idgateau]);

        $recipenb = $maRequeteCountRecipe->fetchColumn();
        return $recipenb;

    }
}
