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
                    Gebruiker succesvol gemaakt! Je kunt nu inloggen, <a href="/login">klik hier om in te loggen.</a>
                </div>
            <?php } ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Registreren</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="/registration">
                        <div class="form-group">
                            <label for="naam">Voornaam</label>
                            <input type="text" value="<?php echo $naam; ?>" class="form-control" name="naam" id="naam" placeholder="Voornaam">
                        </div>
                        <div class="form-group">
                            <label for="achternaam">Achternaam</label>
                            <input type="text" value="<?php echo $achternaam; ?>" class="form-control" name="achternaam" id="naam" placeholder="Achternaam">
                        </div>
                        <div class="form-group">
                            <label for="straat">Straat + huisnummer</label>
                            <input type="text" value="<?php echo $straat; ?>" class="form-control" name="straat" id="straat" placeholder="Straat">
                        </div>
                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" value="<?php echo $postcode; ?>" class="form-control" name="postcode" id="postcode" placeholder="Postcode">
                        </div>
                        <div class="form-group">
                            <label for="plaats">Plaats</label>
                            <input type="text" value="<?php echo $plaats; ?>" class="form-control" name="plaats" id="plaats" placeholder="Plaats">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="email">Email adres</label>
                            <input type="email" value="<?php echo $email; ?>" class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password1">Wachtwoord</label>
                            <input type="password" class="form-control" id="password1" name="password1" placeholder="Wachtwoord">
                        </div>
                        <div class="form-group">
                            <label for="password2">Herhaal wachtwoord</label>
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="Herhaal wachtwoord">
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Registreren</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>