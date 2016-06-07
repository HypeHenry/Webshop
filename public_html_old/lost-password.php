<?php include_once("header.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Wachtwoord vergeten</h3>
                </div>
                <div class="panel-body">
                    <p>
                        Om je wachtwoord te resetten hebben we je email adres nodig, we zullen je een email sturen met daarin een nieuw wachtwoord.
                        <hr>
                    </p>
                    <form>
                        <div class="form-group">
                            <label for="email">Email adres</label>
                            <input type="email" class="form-control text-center" id="email" placeholder="Email">
                        </div>
                        <button type="submit" class="btn btn-success">Reset</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>
