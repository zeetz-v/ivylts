<?php
$this->layout("templates/base", [
    "webTitle" => "Usuários",
    "cardTitle" => "Projetos - Estimativas",
    "styles" => [],
    "js" => [],
]);
?>

<style>
    .container {
        max-width: 60%;
    }
</style>

<div class="d-flex justify-content-center">
    <img src="<?= path()->images("/empty.svg") ?>" alt="empty" style="height: 710px;">
</div>