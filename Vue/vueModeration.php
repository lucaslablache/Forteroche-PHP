<div class="container">
    <header class="col-lg-12 bg-light">
        <h1 class="titreBillet">MODERATION</h1>
    </header>
    <div class="col-lg-12">
        <?php foreach ($billets as $billet):?>
        <article class="col-lg-12">
            <header class="col-lg-12 bg-light">
                <div class="titreBillet"><?= $billet['titre'] ?> </div>
            </header>
            <div class="col-lg-12 bg-light">
                <?= $billet['contenu'] ?>
            </div>
            <div class="container py-3">
                <button type="button" class="btn btn-info ml-5" data-toggle="collapse" data-target="#moderer<?=$billet['id']?>">
                    Modérer les commentaires !
                </button>
                <ul class="list-unstyled collapse" id="moderer<?=$billet['id']?>">
                    <?php foreach ($commentaires[$billet['id']] as $commentaire): ?>
                        <li class="media py-4">
                            <img class="mr-3 avatar" src="Contenu/avatar.jpg" alt="Generic placeholder image">
                            <div class="media-body
                            <?php
                            if ($commentaire['statut'] == 1):
                                echo "bg-warning";
                            else:
                                echo "bg-light";
                            endif;
                            ?>
                            <?php if ($commentaire['statut'] == 3)
                                {
                                    echo 'supprime';
                                }
                                ?>">
                                <h5 class="mt-0 mb-1"><?= $commentaire['auteur'] ?></h5>
                                <p><?= $commentaire['contenu'] ?></p>
                            </div>
                            <div>
                                <?php
                                if ($commentaire['statut'] == 3)
                                {
                                    ?>
                                    <i class="fas fa-times text-danger fa-2x"></i>
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
                                    <form action="/forteroche/index.php?action=validerComm" method="post" class="">
                                        <button class="btn btn-success" type="submit" name="id" value="<?= $commentaire['id'] ?>"><i class="fas fa-check fa-2x"></i></button>
                                    </form>
                                    <form action="/forteroche/index.php?action=supprimerComm" method="post" class="">
                                        <button class="btn btn-danger" type="submit" name="id" value="<?= $commentaire['id'] ?>"><i class="fas fa-times fa-2x"></i></button>
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
    </div>
</div>