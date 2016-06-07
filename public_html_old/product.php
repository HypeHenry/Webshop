<?php include_once("header.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-5 col-xs-12 text-center">
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="Includes/Images/tv.jpg" class="img-responsive"/>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-xs-12">
            <h1>Samsung tv</h1>
            <p>
                omschrijving
            </p>
            <form method="post" action="">
                <input type="hidden" name="product_id" value=""/>
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
                € 1990,-
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>
