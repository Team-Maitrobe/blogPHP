<!-- choisirPseudo.php -->
<label for="pseudo">Choisissez un pseudo :</label>
<input type="text" id="pseudo" name="pseudo" maxlength="30" required value="<?= htmlspecialchars($pseudo ?? '') ?>" />
