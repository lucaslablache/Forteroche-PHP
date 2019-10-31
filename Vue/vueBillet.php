<?php
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$this->titre = "Forteroche - " . $billet['titre']; ?>
    <div class="container bg-bleu">
        <!-- Chapitre -->
        <h1 class="col-lg-12 bg-light">Billet simple pour l'alaska</h1>
        <article class="col-lg-12 py-4">
            <header class="col-lg-12 bg-light">
                <?= $billet['titre'] ?>
            </header>
            <div class="col-lg-12 bg-light">
                <?= $billet['contenu'] ?>
            </div>
        </article>

        <!-- Commentaires -->

        <ul class="list-unstyled">
            <?php foreach ($commentaires as $commentaire): ?>
            <li class="media py-4 row">
                <div class="mr-3 col-2 col-md-1 d-none d-sm-block px-0">
                    <img class="img-fluid"  src="assets/avatar.jpg" alt="Generic placeholder image">
                </div>
                <div class="media-body bg-light col-10 col-md-9">
                    <h5 class="mt-0 mb-1"><?= $commentaire['auteur'] ?></h5>
                    <?= $commentaire['contenu'] ?>
                </div>
                <div class="col-1 m-auto">
                    <?php
                    if ($commentaire['statut'] == 1)
                    {
                        ?>
                        <i class="fas fa-exclamation-triangle text-danger fa-2x"></i>
                        <?php
                    }
                    elseif ($commentaire['statut'] == 2)
                    {
                        ?>
                        <i class="fas fa-check text-success fa-2x"></i>
                        <?php
                    }
                    else
                    {
                        ?>
                        <form action="/forteroche/index.php?action=signaler" method="post">
                            <button class="btn btn-warning" type="submit" name="id" value="<?= $commentaire['id'] ?>"><span class="fas fa-exclamation"></span></button>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        <!-- poster un commentaire -->
        <div class="container py-2">
            <button type="button" class="btn btn-info ml-5" data-toggle="collapse" data-target="#commenter">Commenter !</button>
            <form action="/forteroche/index.php?action=commenter&id=<?=$billet['id']?>" method="post" class="collapse" id="commenter">

                <h3>Votre message</h3>
                <!-- Pseudo-->
                <div class="form-group">
                    <label class="col-md-8 control-label" for="auteur">Votre pseudo</label>
                    <div class="col-md-6">
                        <input id="auteur" name="auteur" type="text" placeholder="Pseudo" class="form-control input-md" required="">
                    </div>
                </div>

                <!-- Message-->
                <div class="form-group">
                    <label class="col-md-8 control-label" for="Message">Votre Message</label>
                    <div class="col-md-12">
                        <textarea id="Message" name="contenu" placeholder="Message" class="form-control input-md" required=""></textarea>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group mb-0 pb-2">
                    <div class="col-md-8">
                        <button id="confirmation" name="confirmation" class="btn btn-success" type="submit">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>