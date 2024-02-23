<h1>Créer une nouvelle partie</h1>
<form action="controller.php">
    <div class="top-row">
        <div class="form-group">
            <label for="players"><abbr title="Nombre de choix nécessaires pour que la partie se termine">Nombre de joueurs*</abbr></label>
            <input type="number" class="form-control" id="players" name="players" required="required">
        </div>
        <div id="end" class="form-group">
            <label for="choices"><abbr title="Plage de choix possibles pour les joueurs">Nombre de choix*</abbr></label>
            <input type="number" class="form-control" id="choices" name="choices" required="required">
        </div>
    </div>
    <button type="submit" name="action" value="createGame">Créer</button>
</form>