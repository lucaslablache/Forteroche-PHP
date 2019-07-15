<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$this->titre = "Forteroche - " . $billet['titre']; ?>
    <div class="container bg-bleu py-4>
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
                <?php
                if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['connecte']) && $_SESSION['connecte'] == 'admin')
                {
                    ?>
                    <p>vous etes co</p>
                    <?php
                }
                ?>

            </li>
            <?php endforeach; ?>
        </ul>
        <div class="container pt-3">
        <button type="button" class="btn btn-info ml-5" data-toggle="collapse" data-target="#commenter">Commenter !</button>
        <form action="/forteroche/index.php?action=commenter&id=<?=$billet['id']?>" method="post" class="collapse" id="commenter">

            <h3>Votre message</h3>


            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-8 control-label" for="pseudo">Votre pseudo</label>
                <div class="col-md-6">
                    <input id="auteur" name="auteur" type="text" placeholder="Pseudo" class="form-control input-md" required="">
                </div>
            </div>

            <!-- Text input a changer (text area)-->
            <div class="form-group">
                <label class="col-md-8 control-label" for="Message">Votre Message</label>
                <div class="col-md-12">
                    <textarea id="Message" name="contenu" type="text" placeholder="Message" class="form-control input-md" required=""></textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <div class="col-md-8">
                    <button id="confirmation" name="confirmation" class="btn btn-success" type="submit">Envoyer</button>
                </div>
            </div>
        </form>
        </div>
    </div>