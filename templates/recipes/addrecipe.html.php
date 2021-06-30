<?php if (!$recipe_id) {?>
    <form action="index.php?controller=recipe&task=add&id=<?php echo $gateau_id;?>" method="post">
        <div>
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name">
        </div>
        <div>
            <label>Desc</label>
            <input type="text" class="form-control" name="desc" placeholder="desc">
        </div>
        <input type="submit" class="btn btn-success" value="Creer un recette">
    </form>

<?php }else{ ?>

    <form action="index.php?controller=recipe&task=edit&idrecipe=<?php echo $recipe->id;?>" method="post">
        <input type="hidden" class="form-control" name="idgateau" value="<?php echo $gateau_id;?>">
        <input type="hidden" class="form-control" name="idrecipe" value="<?php echo $recipe->id;?>">

        <div>
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $recipe->name;?>" placeholder="Name">
        </div>
        <div>
            <label>Desc</label>
            <input type="text" class="form-control" name="desc" value="<?php echo $recipe->desc;?>" placeholder="desc">
        </div>
        <input type="submit" class="btn btn-success" value="Edit un recette">
    </form>




<?php }?>

