<?php $modelUser = new \Model\User();
$LoggedIn = $modelUser->isLoggedIn();
if($LoggedIn){ 
$user = $modelUser->getUser();?>   
<a href="index.php?controller=gateau&task=add" class="btn btn-success">Créer un gateau avec une page</a>
<a href="index.php?controller=gateau&task=index#create" class="btn btn-info">Créer un gateau rapidement</a>
<?php } ?>
<hr>
<?php foreach($gateaux as $gateau){?>
    <div class="">
        <p><u><strong>  <?php echo $gateau->name; ?>  </strong></u></p>
        <p><strong>  <?php echo $gateau->gout; ?>  </strong></p>
        <p><?php 
$userGateau = $modelUser->findByUser($gateau->user_id);
echo "Creer par " . $userGateau->username;
?></p>
        <p>  il y a <?php $modelRecipe = new \Model\Recipe();
                                  $recipenb = $modelRecipe->count($gateau->id);
                                  echo $recipenb;
                                  ?> de recette</p>

        <p>  il y a <?php $modelMakes = new \Model\Make();
                $makesGateauNb = $modelMakes->count($gateau->id, "gateau_id");
                echo $makesGateauNb; 
                ?> qu'y on fait le gateau</p>
        <?php $LoggedIn = $modelUser->isLoggedIn();
            if($LoggedIn){
         $asMake = $modelMakes->findByUserCol($gateau->id, "gateau_id", $user->id);
        if($asMake){ ?>
            <a href="index.php?controller=make&task=supp&idgateau=<?php echo $gateau->id;?>&indexpage=1" class="btn btn-outline-dark"><img src="https://cdn.discordapp.com/attachments/446049284694081546/860078245482987560/outline_check_box_white_24dp.png" width="25px"></a>
        <?php }else{ ?>
            <a href="index.php?controller=make&task=add&idgateau=<?php echo $gateau->id;?>&indexpage=1" class="btn btn-outline-dark"><img src="https://cdn.discordapp.com/attachments/446049284694081546/860078246383845376/outline_check_box_outline_blank_white_24dp.png" width="25px"></a>
        <?php } }?>
        <a href="index.php?controller=gateau&task=show&id=<?php echo $gateau->id; ?>" class="btn btn-primary">Voir ce gateau</a>
        <?php $LoggedIn = $modelUser->isLoggedIn();
if($LoggedIn){
    if($gateau->user_id == $user->id){ ?>   
        <a href="index.php?controller=gateau&task=suppr&id=<?php echo $gateau->id; ?>" class="btn btn-danger">Supprimer ce gateau</a>
        <?php } } ?>
    </div>
    <hr>
    
<?php } 
 $LoggedIn = $modelUser->isLoggedIn();
            if($LoggedIn){ ?>   
<section id="create"></section>
<form action="index.php?controller=gateau&task=create" method="post">
    <div>
        <label>Name</label>
        <input type="text" class="form" name="name" placeholder="Name">
    </div>
    <div>
        <label>Gout</label>
        <input type="text" class="form" name="gout" placeholder="Gout">
    </div>
    <input type="submit" class="btn btn-success" value="Creer un gateau">
</form>
<hr>
<?php } ?>