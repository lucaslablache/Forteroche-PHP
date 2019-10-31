<article class="col-lg-12 py-4">
    <header class="col-lg-12 bg-light">
        <h1 class="titreBillet">action 2 (editer billet)</h1>
    </header>
    <div class="col-lg-12 bg-light">
        <!-- formulaire pour un nouveau billet -->
        <form action="/forteroche/index.php?action=updateBillet" method="post" id="commenter">

            <h3> Vous éditez : <?= $billet['titre']?></h3>
            <!-- Text input titre -->
            <div class="form-group">
                <label class="col-md-8 control-label" for="titre">Nom du Chapitre</label>
                <div class="col-md-6">
                    <input id="myeditable-h2" name="titre" type="text" placeholder="" class="form-control input-md" required="" value="<?= $billet['titre'] ?>">
                </div>
            </div>

            <!-- Text input du contenu-->
            <div class="form-group">
                <label class="col-md-8 control-label" for="contenu">Contenu du Chapitre</label>
                <div class="col-md-12">
                    <textarea id="myeditable-div" name="contenu" type="text" placeholder="" class="form-control input-md" required="">
                        <?= $billet['contenu'] ?>
                    </textarea>
                </div>
            </div>

            <!-- récupération de l'id du billet modifié -->
            <input id="id" name="id" type="hidden" value="<?= $billet['id'] ?>">

            <!-- Button -->
            <div class="form-group">
                <div class="col-md-8">
                    <button id="confirmation" name="confirmation" class="btn btn-success" type="submit">Confirmer</button>
                </div>
            </div>
        </form>
    </div>
</article>