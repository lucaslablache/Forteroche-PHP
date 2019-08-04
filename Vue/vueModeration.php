<header class="col-lg-12 bg-light">
    <h1 class="titreBillet">MODERATION</h1>
</header>
<p class="col-lg-12 bg-light">
    <?php foreach ($billets as $billet):?>
    <article class="col-lg-12">
        <header class="col-lg-12 bg-light">
            <a href="<?= "index.php?action=billet&id=" . $billet['id'] ?>">
                <h1 class="titreBillet"><?= $billet['titre'] ?> </h1>
            </a>
        </header>
        <p class="col-lg-12 bg-light">
            <?= $billet['contenu'] ?>
        </p>
        <div class="container pt-3">
            <button type="button" class="btn btn-info ml-5" data-toggle="collapse" data-target="#moderer<?=$billet['id']?>">
                Commenter !
            </button>
            <ul class="list-unstyled collapse" id="moderer<?=$billet['id']?>">
                <?php foreach ($commentaires[$billet['id']] as $commentaire): ?>
                    <li class="media py-4">
                        <img class="mr-3 avatar" src="Contenu/avatar.jpg" alt="Generic placeholder image">
                        <div class="media-body bg-light">
                            <h5 class="mt-0 mb-1"><?= $commentaire['auteur'] ?></h5>
                            <?= $commentaire['contenu'] ?>
                        </div>
                        <div>
                            <?php
                            if ($commentaire['statut'] == 3)
                            {
                                ?>
                                <p>Commentaire supprimé</p>
                                <?php
                            }
                            elseif ($commentaire['statut'] == 2)
                            {
                                ?>
                                <p>Commentaire validé</p>
                                <?php
                            }
                            else
                            {
                                ?>
                                <form action="/forteroche/index.php?action=validerComm" method="post">
                                    <button class="btn btn-success" type="submit" name="id" value="<?= $commentaire['id'] ?>">Valider</button>
                                </form>
                                <form action="/forteroche/index.php?action=supprimerComm" method="post">
                                    <button class="btn btn-success" type="submit" name="id" value="<?= $commentaire['id'] ?>">Supprimer</button>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </article>
    <?php endforeach; ?>
</p>
