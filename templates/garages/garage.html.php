
        <h2><?php echo $garage['name']; ?></h2>

        <h3><?php echo $garage['address']; ?></h3>

        <h4><?php echo $garage['description']; ?></h4>

<a href="index.php" class="btn btn-primary">Retour aux garages</a>

                <form action="index.php?controller=annonce&task=save" method="post">
                
                        <input type="hidden" name="garageId" value="<?php echo $garage['id'] ?>" >
                        <div class="form-group">
                                <textarea name="name" cols="30" rows="1"></textarea>
                        </div>
                        <div class="form-group">
                        
                        <textarea name="price" cols="30" rows="1"></textarea>

                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">Poster l'annonce</button>
                        </div>
                
                </form>



                <?php  if(empty($annonces)) {
                 echo "il n'y a pas encore d'annonces pour ce garage";       
                }?>

        <?php  foreach($annonces as $annonce){?>
        
                <?php echo $annonce['name']; 
                echo "<br>";
                echo $annonce['price'];
                echo "<br>";
?>
                <a href="index.php?controller=annonce&task=suppr&id=<?php echo $annonce['id'] ?>" class="btn btn-danger">supprimer</a>



            <?php    echo "<hr>";


                ?>
     
        <?php }  ?>