<?php $modelUser = new \Model\User();
$LoggedIn = $modelUser->isLoggedIn();
if($LoggedIn){
$user = $modelUser->getUser();
}?>
<h2><?php echo $gateau->name; ?></h2>

<h3><?php echo $gateau->gout; ?></h3>

<?php 
$userGateau = $modelUser->findByUser($gateau->user_id);
echo "Creer par " . $userGateau->username;
?>
<p><strong>  il y a <?php $modelMakes = new \Model\Make();
        $makesGateauNb = $modelMakes->count($gateau->id, "gateau_id");
        echo $makesGateauNb;
        ?> qu'y on fait le gateau</strong></p>
        <?php $LoggedIn = $modelUser->isLoggedIn();
            if($LoggedIn){
         $asMake = $modelMakes->findByUserCol($gateau->id, "gateau_id", $user->id);
        if($asMake){ ?>
            <a href="index.php?controller=make&task=supp&idgateau=<?php echo $gateau->id;?>" class="btn btn-outline-dark"><img src="https://cdn.discordapp.com/attachments/446049284694081546/860078245482987560/outline_check_box_white_24dp.png" width="25px"></a>
        <?php }else{ ?>
            <a href="index.php?controller=make&task=add&idgateau=<?php echo $gateau->id;?>" class="btn btn-outline-dark"><img src="https://cdn.discordapp.com/attachments/446049284694081546/860078246383845376/outline_check_box_outline_blank_white_24dp.png" width="25px"></a>
        <?php } }?>
<?php $LoggedIn = $modelUser->isLoggedIn();
if($LoggedIn){
    if($gateau->user_id == $user->id){ ?>   
<a href="index.php?controller=gateau&task=add&id=<?php echo $gateau->id; ?>" class="btn btn-primary">Edit le gateaux</a>
<?php }} ?>
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
$userRecipe = $modelUser->findByUser($recipe->user_id);
echo $userRecipe->username;
?>
    <p><strong>  il y a <?php $modelMakes = new \Model\Make();
            $makesRecipeNb = $modelMakes->count($recipe->id, "recipe_id");
            echo $makesRecipeNb;
            ?> qu'y on fait la recette</strong></p>
    <?php $LoggedIn = $modelUser->isLoggedIn();
            if($LoggedIn){
         $asMakeRecipe = $modelMakes->findByUserCol($recipe->id, "recipe_id", $user->id);
        if($asMakeRecipe){ ?>
            <a href="index.php?controller=make&task=supp&idrecipe=<?php echo $recipe->id;?>&idgateau=<?php echo $gateau->id;?>" class="btn btn-outline-dark"><img src="https://cdn.discordapp.com/attachments/446049284694081546/860078245482987560/outline_check_box_white_24dp.png" width="25px"></a>
        <?php }else{ ?>
            <a href="index.php?controller=make&task=add&idrecipe=<?php echo $recipe->id;?>&idgateau=<?php echo $gateau->id;?>" class="btn btn-outline-dark"><img src="https://cdn.discordapp.com/attachments/446049284694081546/860078246383845376/outline_check_box_outline_blank_white_24dp.png" width="25px"></a>
        <?php } }?>
    <?php $LoggedIn = $modelUser->isLoggedIn();
if($LoggedIn && $recipe->user_id == $user->id){ ?>   
    <a href="index.php?controller=recipe&task=supp&id=<?php echo $recipe->id;?>" class="btn btn-danger">Supprimer la recette</a>
    <a href="index.php?controller=recipe&task=add&id=<?php echo $gateau->id;?>&idrecipe=<?php echo $recipe->id;?>" class="btn btn-primary">edit la recette</a>
    <?php } ?>
    <hr>
<?php } ?>
