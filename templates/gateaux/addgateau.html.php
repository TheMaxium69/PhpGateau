<?php if (!$gateau) {?>
<form action="index.php?controller=gateau&task=create" method="post">
    <div>
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Name">
    </div>
    <div>
        <label>Gout</label>
        <input type="text" class="form-control" name="gout" placeholder="Gout">
    </div>
    <input type="submit" class="btn btn-success" value="Creer un gateau">
</form>

<?php }else{ ?>

    <form action="index.php?controller=gateau&task=edit" method="post">
        <input type="hidden" name="id" value="<?php echo $gateau->id?>">
        <div>
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $gateau->name?>" placeholder="Name">
        </div>
        <div>
            <label>Gout</label>
            <input type="text" class="form-control" name="gout" value="<?php echo $gateau->gout?>" placeholder="Gout">
        </div>
        <input type="submit" class="btn btn-success" value="Edit un gateau">
    </form>



<?php }?>

