<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Gebuikersgegevens</h3>
                </div>
                <div class="panel-body">
                    <b>Voornaam:</b> <?php echo $aUser['firstname']; ?><br>
                    <b>Achternaam:</b> <?php echo $aUser['lastname']; ?><br>
                    <b>Plaats:</b> <?php echo $aUser['city']; ?><br>
                    <b>Postcode:</b> <?php echo $aUser['zip']; ?><br>
                    <b>Straat:</b> <?php echo $aUser['street']; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table">
                <caption>Factures</caption>
                <thead>
                <tr>
                    <th>Factuurid</th>
                    <th>Naam</th>
                </tr>
                </thead
                <tbody>
                <?php
                if(!empty($aInvoices))
                {
                    foreach($aInvoices as $invoice)
                    { ?>
                        <tr>
                            <th scope="row"><?php echo $invoice['id'] ?></th>
                            <td><?php echo $invoice['name'] ?></td>
                        </tr>
                    <?php
                    }
                }
                else
                {
                    echo '<tr><td>Geen factures</td></tr>';
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>