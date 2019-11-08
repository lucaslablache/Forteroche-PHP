<?php ?>
<article class="col-lg-12">
    <!-- Ajouter un billet -->
    <div class="pb-4">
        <header class="col-lg-12 bg-light">
            <h1 class="titreBillet">Créez votre nouveau chapitre</h1>
        </header>
        <div class="col-lg-12 bg-light">
            <!-- formulaire pour un nouveau billet -->
            <form action="/forteroche/index.php?action=addBillet" method="post" id="ajouter un billet">

                <h3>Votre Nouveau chapitre</h3>

                <div class="form-group">
                    <label class="col-md-8 control-label" for="titre">Titre</label>
                    <div class="col-md-6">
                        <input id="myeditable-h2" name="titre" type="text" placeholder="Titre" class="form-control input-md">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-8 control-label" for="contenu">Contenu</label>
                    <div class="col-md-12">
                        <textarea id="myeditable-div" name="contenu" type="text" placeholder="Votre chapitre" class="form-control input-md"></textarea>
                    </div>
                </div>

                <!-- Selection de l'action -->
                <h4>Postez votre travail ou conservez le en brouillon</h4>
                <select name="statut" id="statut" class="mb-3 col-sm-12">
                    <option value="1">Brouillon
                    <option value="0">Poster
                </select>

                <!-- Confirmation -->
                <div class="form-group">
                    <div class="col-md-2 offset-md-5">
                        <button id="confirmation" name="confirmation" class="btn btn-success col-sm-12" type="submit">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modifier un billet -->
    <div class="pb-4">
        <header class="col-lg-12 bg-light">
            <h1 class="titreBillet">Modifier un billet existant</h1>
        </header>
        <div class="col-lg-12 bg-light">
            <p>
                Sélectionnez le billet a modifier
            </p>
            <form action="/forteroche/index.php?action=editBillet" method="post">
                <select name="id" id="id" class="mb-3 col-sm-12">
                    <?php foreach ($billetsExculdingDeleted as $billetExculdingDeleted): ?>
                    <option value="<?= $billetExculdingDeleted['id']?>"><?= $billetExculdingDeleted['titre'] ?>
                    <?php endforeach; ?>
                </select>
                <button id="confirmation" name="confirmation" class="btn btn-primary col-sm-12 col-md-2 offset-md-5" type="submit">Selectionner</button>
            </form>
        </div>
    </div>

    <!-- Suppression de billets -->
    <div class="pb-4">
        <header class="col-lg-12 bg-light">
            <h1 class="titreBillet">Mettre à la corbeille un billet existant</h1>
        </header>
        <div class="col-lg-12 bg-light">
            <p>
                Sélectionnez le chapitre a mettre à la corbeille
            </p>
            <form action="/forteroche/index.php?action=deleteBillet" method="post">
                <select name="id" id="id" class="mb-3 col-sm-12">
                    <?php foreach ($billetsExculdingDeleted as $billetExculdingDeleted): ?>
                    <option value="<?= $billetExculdingDeleted['id']?>"><?= $billetExculdingDeleted['titre'] ?>
                        <?php endforeach; ?>
                </select>
                <button id="confirmation" name="confirmation" class="btn btn-danger col-sm-12 col-md-2 offset-md-5" type="submit">Supprimer</button>
            </form>
        </div>
    </div>

    <!-- Restauration de billets -->
    <div class="pb-4">
        <header class="col-lg-12 bg-light">
            <h1 class="titreBillet">Restaurer un billet de la Corbeille</h1>
        </header>
        <div class="col-lg-12 bg-light">
            <p>
                Sélectionnez le chapitre à restaurer
            </p>
            <form action="/forteroche/index.php?action=restaurerBillet" method="post">
                <select name="id" id="id" class="mb-3 col-sm-12">
                    <?php foreach ($billetsDeleted as $billetDeleted): ?>
                    <option value="<?= $billetDeleted['id']?>"><?= $billetDeleted['titre'] ?>
                        <?php endforeach; ?>
                </select>
                <button id="confirmation" name="confirmation" class="btn btn-info col-sm-12 col-md-2 offset-md-5" type="submit">Restaurer</button>
            </form>
        </div>
    </div>

    <!-- Modération des commentaires -->
    <div class="pb-4">
        <header class="col-lg-12 bg-light">
            <h1 class="titreBillet">Modérer les commentaires</h1>
        </header>
        <div class="col-lg-12 bg-light">
            <p class="my-2 col-sm-12">
                Redirection vers une page de modération des commentaires
            </p>

            <a href="/forteroche/index.php?action=moderation" class="btn btn-primary col-sm-12 col-md-2 offset-md-5" role="button">MODERATION</a>
        </div>
    </div>

    <!-- Déconnection -->
    <div class="pb-4">
        <header class="col-lg-12 bg-light">
            <h1 class="titreBillet">Déconnection</h1>
        </header>
        <div class="col-lg-12 bg-light">
            <p class="my-2 col-sm-12">
                Vous avez finit votre travail déconnectez vous !
            </p>
            <a href="/forteroche/index.php?action=disconnect" class="btn btn-danger col-sm-12 col-md-2 offset-md-5" role="button">Déconnection</a>
        </div>
    </div>
</article>
