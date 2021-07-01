<?php $modelUser = new \Model\User(); ?>
<h2><?php echo $gateau->name; ?></h2>

<h3><?php echo $gateau->gout; ?></h3>

<?php 
$user = $modelUser->findByUser($gateau->user_id);
echo "Creer par " . $user->username;
?>
<p><strong>  il y a <?php $modelMakes = new \Model\Make();
        $makesGateauNb = $modelMakes->count($gateau->id, "gateau_id");
        echo $makesGateauNb;
        ?> qu'y on fait le gateau</strong></p>

<a href="index.php?controller=make&task=add&idgateau=<?php echo $gateau->id;?>" class="btn btn-warning">J'ai fait ce gâteau</a>
<?php $LoggedIn = $modelUser->isLoggedIn();
              $userLog = $modelUser->getUser();
if($LoggedIn && $gateau->id == $userLog->id){ ?>   
<a href="index.php?controller=gateau&task=add&id=<?php echo $gateau->id; ?>" class="btn btn-primary">Edit le gateaux</a>
<?php } ?>
<?php $LoggedIn = $modelUser->isLoggedIn();
            if($LoggedIn){ ?>            
<a href="index.php?controller=recipe&task=add&id=<?php echo $gateau->id; ?>" class="btn btn-success">ajoutez une recette</a>
<?php } ?><hr>
<a href="index.php?controller=gateau&task=index" class="btn btn-info">Retour aux gateaux</a>
    <?php echo "<hr>"; ?>


<?php  if(empty($recipes)) {
    echo "il n'y a pas encore de recette pour ce gateau";
}?>

<?php  foreach($recipes as $recipe){?>

<?php echo $recipe->name;
echo "<br>";
echo $recipe->desc;
echo "<br>";
$user = $modelUser->findByUser($recipe->user_id);
echo $user->username;
?>
    <p><strong>  il y a <?php $modelMakes = new \Model\Make();
            $makesRecipeNb = $modelMakes->count($recipe->id, "recipe_id");
            echo $makesRecipeNb;
            ?> qu'y on fait la recette</strong></p>

    <a href="index.php?controller=make&task=add&idrecipe=<?php echo $recipe->id;?>&idgateau=<?php echo $gateau->id;?>" class="btn btn-warning">J'ai fait cette recette</a>
    <?php $LoggedIn = $modelUser->isLoggedIn();
if($LoggedIn && $recipe->id == $userLog->id){ ?>   
    <a href="index.php?controller=recipe&task=supp&id=<?php echo $recipe->id;?>" class="btn btn-danger">Supprimer la recette</a>
    <a href="index.php?controller=recipe&task=add&id=<?php echo $gateau->id;?>&idrecipe=<?php echo $recipe->id;?>" class="btn btn-primary">edit la recette</a>
    <?php } ?>
    <hr>
<?php } ?>
