<div class="container">
    <div class="row">
        <?php
        if(!empty($aProducts))
        {
            foreach($aProducts as $aProductFromDB)
            {
                ?>
                <div class="col-md-3 col-xs-12 text-center">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $aProductFromDB['name']; ?></h3>
                        </div>
                        <div class="panel-body">
                            <img src="/Includes/Images/tv.jpg" class="img-responsive"/>

                            <?php echo $aProductFromDB['description']; ?>
                            <br><br>

                            <a href="/product/view/<?php echo $aProductFromDB['id']; ?>" class="btn btn-default">ga naar televisies</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>