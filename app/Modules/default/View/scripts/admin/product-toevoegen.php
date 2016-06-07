<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <?php if(isset($bError)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $sErrorMessage; ?>
                </div>
            <?php } ?>
            <?php if(isset($bSuccess)) { ?>
                <div class="alert alert-success" role="alert">
                    Product succesvol toegevoegd!
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Product toevoegen</h3>
                </div>
                <div class="panel-body">
                    <form enctype="multipart/form-data" method="post" action="/admin/product-toevoegen">
                        <div class="form-group">
                            <label for="categorie">Categorie</label>
                            <select name="categorie" class="form-control">
                                <?php
                                foreach($aCategories as $aCategory)
                                {
                                    echo "<option value='".$aCategory['id']."'>".$aCategory['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="artikelnummer">Artikelnummer</label>
                            <input type="text" value="<?php echo $artikelnummer; ?>" class="form-control" name="artikelnummer" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="naam">Naam</label>
                            <input type="text" value="<?php echo $naam; ?>" class="form-control" name="naam" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="prijs">Prijs</label>
                            <input type="number" value="<?php echo $prijs; ?>" class="form-control" name="prijs" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="voorraad">Voorraad</label>
                            <input type="number" min="1" max="50" value="<?php echo $voorraad; ?>" class="form-control" name="voorraad" placeholder="">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="beschrijving">Beschrijving</label>
                            <textarea class="form-control" rows="15" name="beschrijving"><?php echo $beschrijving; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fileupload">
                                Upload foto
                            </label>
                            <input type="file" name="foto" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Toevoegen</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>