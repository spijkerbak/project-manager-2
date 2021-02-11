<?php
ini_set('display_errors', 1);

//User::needLevel(Level::ADMIN);
?>

<h2>Database</h2>
<p>Phpmyadmin wordt nu gestart.</p>

<form id="admin" target="database" method="post" action="<?= Secret::DB_ADMIN; ?>">
    <input type="hidden" name="pma_servername" value="<?= Secret::DB_HOST ?>" size="24">
    <input type="hidden" name="pma_username" value="<?= Secret::DB_USERNAME ?>" size="24">
    <input type="hidden" name="pma_password" value="<?= Secret::DB_PASSWORD ?>" size="24">
    <input type="hidden" name="server" value="1">    
    <input value="als het niet vanzelf gaat" type="submit">
</form>
<script>
    window.onload = function (e) {
        document.querySelector("#admin").submit();
    };
</script>