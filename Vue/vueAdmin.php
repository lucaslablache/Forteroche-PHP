<?php ?>
<article class="col-lg-12">
    <header class="col-lg-12 bg-light">
        <h1 class="titreBillet">action 1 (ajouter billet)</h1>
    </header>
    <p class="col-lg-12 bg-light">
        <!-- formulaire pour un nouveau billet -->
    <form action="/forteroche/index.php?action=addBillet" method="post" id="commenter">

        <h3>Votre Nouveau chapitre</h3>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-8 control-label" for="titre">Titre</label>
            <div class="col-md-6">
                <input id="titre" name="titre" type="text" placeholder="Titre" class="form-control input-md" required="">
            </div>
        </div>

        <!-- Text input a changer (text area)-->
        <div class="form-group">
            <label class="col-md-8 control-label" for="contenu">Contenu</label>
            <div class="col-md-12">
                <textarea id="Contenu" name="contenu" type="text" placeholder="Votre chapitre" class="form-control input-md" required=""></textarea>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <div class="col-md-8">
                <button id="confirmation" name="confirmation" class="btn btn-success" type="submit">Envoyer</button>
            </div>
        </div>
    </form>
        details (formulaire pour entrer les données)
    </p>

    <header class="col-lg-12 bg-light">
        <h1 class="titreBillet">action 2 (modifier billet)</h1>
    </header>
    <p class="col-lg-12 bg-light">
        details (formulaire pour entrer les données + menu déroulant pour selectionner le billet)
    <form action="/forteroche/index.php?action=editBillet" method="post">
        <select name="id" id="id">
            <?php foreach ($billets as $billet): ?>
            <option value="<?= $billet['id']?>"><?= $billet['titre'] ?>
            <?php endforeach; ?>
        </select>
        <button id="confirmation" name="confirmation" class="btn btn-success" type="submit">Selectionner</button>
    </form>
    </p>

    <header class="col-lg-12 bg-light">
        <h1 class="titreBillet">action 3 (déconnection)</h1>
    </header>
    <p class="col-lg-12 bg-light">
        simple bouton qui nous deconnecte
    <form action="/forteroche/index.php?action=disconnect">
        <button class="btn btn-success" type="submit">Déconnection</button>
    </form>
    <a href="/forteroche/index.php?action=disconnect">Déco</a>
    </p>
</article>
