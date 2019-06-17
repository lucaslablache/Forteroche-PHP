<?php $this->titre = "Forteroche - " . $billet['titre']; ?>
    <div class="container bg-bleu">
        <!-- Chapitre -->
        <article class="col-lg-12 py-4">
            <header class="col-lg-12 bg-light">
                <h1><?= $billet['titre'] ?></h1>
            </header>
            <p class="col-lg-12 bg-light">
                <?= $billet['contenu'] ?>
            </p>
        </article>

        <!-- Commentaires -->

        <ul class="list-unstyled">
            <?php foreach ($commentaires as $commentaire): ?>
            <li class="media py-4">
                <img class="mr-3 avatar" src="Contenu/avatar.jpg" alt="Generic placeholder image">
                <div class="media-body bg-light">
                    <h5 class="mt-0 mb-1"><?= $commentaire['auteur'] ?></h5>
                    <?= $commentaire['contenu'] ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <p>
            <!--
            dropdown + 2 champs + submit
            $post['id'] = $billet['id']
            bouton submit
            -->

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-8 control-label" for="pseudo">Votre pseudo</label>
                <div class="col-md-6">
                    <input id="pseudo" name="pseudo" type="text" placeholder="Pseudo" class="form-control input-md" required="">
                </div>
            </div>

            <!-- Text input a changer (text area)-->
            <div class="form-group">
                <label class="col-md-8 control-label" for="Message">Votre Message</label>
                <div class="col-md-12">
                    <textarea id="Message" name="Message" type="text" placeholder="Message" class="form-control input-md" required=""></textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-8 control-label" for="confirmation">Envoyer</label>
                <div class="col-md-8">
                    <button id="confirmation" name="confirmation" class="btn btn-success" action="commenter">Envoyer</button>
                    <input type="hidden" id="id" value="<?=$billet['id']?>">
                </div>
            </div>
        </p>
    </div>