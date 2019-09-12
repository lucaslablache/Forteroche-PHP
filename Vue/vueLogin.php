<?php ?>

<form action="/forteroche/index.php?action=try_login" method="post">
    <div class="form-group px-2">
        <input class="form-control" type="text" name="pseudo" placeholder="pseudo">
    </div>
    <div class="form-group px-2">
        <input class="form-control" type="password" name="password" placeholder="password">
    </div>
    <button type="submit" class="btn btn-primary mb-2 ml-2">Se connecter</button>
</form>