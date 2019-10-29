<?php $this->titre = "Forteroche - Inscription"; ?>
<form class="form-horizontal container bg-bleu">
    <fieldset class="col-md-8 offset-md-2">

        <!-- Form Name -->
        <h3>Inscription</h3>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-8 control-label" for="pseudo">Votre pseudo</label>
            <div class="col-md-8">
                <input id="pseudo" name="pseudo" type="text" placeholder="Pseudo" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-8 control-label" for="email">Votre email</label>
            <div class="col-md-8">
                <input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-8 control-label" for="passwordinput">Votre mot de passe</label>
            <div class="col-md-8">
                <input id="passwordinput" name="passwordinput" type="password" placeholder="mot de passe" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-8 control-label" for="passwordconfirm">Confirmez votre mot de passe</label>
            <div class="col-md-8">
                <input id="passwordconfirm" name="passwordconfirm" type="password" placeholder="" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-8 control-label" for="confirmation">Confirmez</label>
            <div class="col-md-8">
                <button id="confirmation" name="confirmation" class="btn btn-success">Envoyer</button>
            </div>
        </div>
    </fieldset>
</form>