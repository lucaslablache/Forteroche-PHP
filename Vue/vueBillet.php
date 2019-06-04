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
                <img class="mr-3 avatar" src="../Contenu/avatar.jpg" alt="Generic placeholder image">
                <div class="media-body bg-light">
                    <h5 class="mt-0 mb-1"><?= $commentaire['auteur'] ?></h5>
                    <?= $commentaire['contenu'] ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>


<!-- Ajouter un formulaire pour commenter le post -->
