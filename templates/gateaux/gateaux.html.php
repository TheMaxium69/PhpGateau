<?php $modelUser = new \Model\User(); 
$LoggedIn = $modelUser->isLoggedIn();
if($LoggedIn){ ?>   
<a href="index.php?controller=gateau&task=add" class="btn btn-success">Créer un gateau avec une page</a>
<a href="index.php?controller=gateau&task=index#create" class="btn btn-info">Créer un gateau rapidement</a>
<?php } ?>
<hr>
<?php foreach($gateaux as $gateau){?>
    <div class="">
        <p><u><strong>  <?php echo $gateau->name; ?>  </strong></u></p>
        <p><strong>  <?php echo $gateau->gout; ?>  </strong></p>
        <p><?php 
$user = $modelUser->findByUser($gateau->user_id);
echo "Creer par " . $user->username;
?></p>
        <p>  il y a <?php $modelRecipe = new \Model\Recipe();
                                  $recipenb = $modelRecipe->count($gateau->id);
                                  echo $recipenb;
                                  ?> de recette</p>

        <p>  il y a <?php $modelMakes = new \Model\Make();
                $makesGateauNb = $modelMakes->count($gateau->id, "gateau_id");
                echo $makesGateauNb; 
                ?> qu'y on fait le gateau</p>
        <a href="index.php?controller=make&task=add&idgateau=<?php echo $gateau->id;?>&indexpage=1" class="btn btn-warning">J'ai fait ce gâteau</a>
        <a href="index.php?controller=gateau&task=show&id=<?php echo $gateau->id; ?>" class="btn btn-primary">Voir ce gateau</a>
        <?php $LoggedIn = $modelUser->isLoggedIn();
if($LoggedIn){
    $userLog = $modelUser->getUser();
    if($gateau->id == $userLog->id){ ?>   
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