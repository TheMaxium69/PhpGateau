<?php

namespace Model;


class Annonce extends Model
{

protected $table = "annonces";

        /**
         * trouve toutes les annonces liées à un garage
         * par ce meme garage
         * 
         * @param integer $garage_id
         * @return array|bool
         * 
         */

        function findAllByGarage(int $garage_id)
        {

        

          $resultat =  $this->pdo->prepare('SELECT * FROM annonces WHERE garage_id = :garage_id');
          $resultat->execute(["garage_id"=> $garage_id]);
          
          $annonces = $resultat->fetchAll();
          return $annonces;
        }


        /**
         * ajoute une annonce
         * 
         * @param string $name
         * @param int $price
         * @param int $garage_id
         * @return void
         */

        function insert(string $name, int $price, int $garage_id) : void
        {
        
          $maRequeteSaveAnnonce = $this->pdo->prepare("INSERT INTO annonces (name, price, garage_id) 
          VALUES (:name, :price, :garage_id)");

            $maRequeteSaveAnnonce->execute([
            'name' => $name,
            'price' => $price,
            'garage_id' => $garage_id

            ]);
        }

}