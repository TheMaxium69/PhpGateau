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
<a href="index.php?controller=gateau&task=add" class="btn btn-success">Créer un gateau avec une page</a>
<hr>
<?php foreach($gateaux as $gateau){?>
    <div class="">
        <p><strong>  <?php echo $gateau->name; ?>  </strong></p>
        <p><strong>  <?php echo $gateau->gout; ?>  </strong></p>
        <p><strong>  il y a <?php $modelRecipe = new \Model\Recipe();
                                  $recipenb = $modelRecipe->count($gateau->id);
                                  echo $recipenb;
                                  ?> de recette</strong></p>

        <p><strong>  il y a <?php $modelMakes = new \Model\Make();
                $makesGateauNb = $modelMakes->count($gateau->id, "gateau_id");
                echo $makesGateauNb; 
                ?> qu'y on fait le gateau</strong></p>
        <a href="index.php?controller=make&task=add&idgateau=<?php echo $gateau->id;?>&indexpage=1" class="btn btn-warning">J'ai fait ce gâteau</a>
        <a href="index.php?controller=gateau&task=show&id=<?php echo $gateau->id; ?>" class="btn btn-primary">Voir ce gateau</a>
        <a href="index.php?controller=gateau&task=suppr&id=<?php echo $gateau->id; ?>" class="btn btn-danger">Supprimer ce gateau</a>
    </div>
    <hr>
<?php } ?>

