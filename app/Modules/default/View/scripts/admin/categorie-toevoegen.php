<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <table class="table">
                <caption>Categorie</caption>
                <thead>
                <tr>
                    <th>Categorie id</th>
                    <th>Naam</th>
                    <th></th>
                </tr>
                </thead
                <tbody>
                <?php
                if(!empty($aCategories))
                {
                    foreach($aCategories as $aCategory)
                    { ?>
                        <tr>
                            <th scope="row"><?php echo $aCategory['id'] ?></th>
                            <td><?php echo $aCategory['name'] ?></td>
                            <td><a href="/admin/categorie-verwijderen/<?php echo $aCategory['id'] ?>">Delete</a> </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo '<tr><td>Geen categorien</td></tr>';
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12 text-center">
            <?php if(isset($bError)) { ?>
                <div class="alert alert-danger" role="alert">
                    Categorie moet minimaal 2 letters bevatten!
                </div>
            <?php } ?>
            <?php if(isset($bSuccess)) { ?>
                <div class="alert alert-success" role="alert">
                    Categorie succesvol toegevoegd!
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Categorie toevoegen</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="/admin/categorie-toevoegen">
                        <div class="form-group">
                            <label for="naam">Naam categorie</label>
                            <input type="text" name="naam" class="form-control" placeholder="Naam categorie">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>