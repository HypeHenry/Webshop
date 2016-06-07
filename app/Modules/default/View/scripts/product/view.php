<div class="container">
    <div class="row">
        <?php if(isset($bToegevoegd)) { ?>
            <div class="alert alert-success" role="alert">
                Het product is toegevoegd aan het winkelmandje!
            </div>
        <?php } ?>
        <div class="col-md-5 col-xs-12 text-center">
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="/Includes/Images/tv.jpg" class="img-responsive"/>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-xs-12">
            <h1><?php echo $aProduct['name']; ?></h1>
            <p>
                <?php echo $aProduct['description']; ?>
            </p>
            <form method="post" action="/winkelmandje/product-toevoegen">
                <input type="hidden" name="product_id" value="<?php echo $aProduct['id']; ?>"/>
                <div class="form-group">
                    <label for="aantal">Aantal:</label>
                    <select name="aantal" id="aantal"  class="form-control">
                        <?php
                        for($i=1; $i < 6; $i++)
                        {
                            echo "<option value='".$i."'>".$i."</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">toevoegen aan winkelmandje</button>
            </form>
            <div class="price">
               € <?php echo $aProduct['price']; ?>
            </div>
        </div>
    </div>
</div>