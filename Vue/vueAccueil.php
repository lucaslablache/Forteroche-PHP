<?php 
$this->titre = "Blog Forteroche";// titre a modifier
?>
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
        <div class="row">
            <p class="col-lg-2 offset-lg-7 col-sm-5 offset-sm-1 notes"><?= $billet['date'] ?></p>
            <p class="col-lg-2 offset-lg-1 col-sm-5 notes"> <?= $billet['nb_comm'] ?> commentaires</p> <!-- récupérer le nombre de comms -->
    </div>
    </article>
<?php endforeach; ?>