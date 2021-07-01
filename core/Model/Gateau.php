<?php

namespace Model;

class Gateau extends Model
{

    protected $table = "gateaux";

    public $id;
    public $name;
    public $gout;
    public $user_id;


    /**
     * @param string $name
     * @param string $gout
     *
     * ajout d'un gateau
     * methode qui ajoute un gateau en utilisant le post du formulaire du geteau qui a été rucpere dans le controleur
     */
    function insert(string $name, string $gout, int $user_id) : void
    {

        $maRequeteCreateGateau = $this->pdo->prepare("
        INSERT INTO `gateaux` (`name`, `gout`, `user_id`) VALUES (:name, :gout, :user_id)");

        $maRequeteCreateGateau->execute([
            'name' => $name,
            'gout' => $gout,
            'user_id' => $user_id
        ]);
    }
    /**
     * @param int $id
     * @param string $name
     * @param string $gout
     *
     * ajout d'un gateau
     * methode qui ajoute un gateau en utilisant le post du formulaire du geteau qui a été rucpere dans le controleur
     */
    function update(int $id, string $name, string $gout) : void
    {

        $maRequeteUpdateGateau = $this->pdo->prepare("UPDATE gateaux SET name=:name,gout=:gout WHERE id=:id");

        $maRequeteUpdateGateau->execute([
            'id' => $id,
            'name' => $name,
            'gout' => $gout,
        ]);
    }
}
