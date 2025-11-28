<?php
$this->layout("templates/base", [
    "webTitle" => "Usuários - Editar",
    "cardTitle" => "Controle de usuários - Editando usuário",
    "styles" => [],
    "js" => [],
]);
?>

<form method="POST" action="<?= route('users.update', ['uuid' => $u->uuid]); ?>" id="form-edit">

    <!-- hidden infos -->
     <input type="hidden" value="<?= $u->uuid ?>" name="uuid">

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id" class="form-label fw-bold">Id <span class="text-danger"></span></label>
            <input type="text" class="form-control form-control-sm text-center" id="id" placeholder="<?= $u->id ?>">
        </div>
        <div class="col-md-4">
            <label for="name" class="form-label fw-bold">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm text-center <?= isWrong('name') ? 'is-invalid' : '' ?>" id="name"
                name="name" value="<?= old('name') ?? $u->name ?>">
            <small class="text-muted"><?= isWrongText('name') ?></small>
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label fw-bold">E-mail <span class="text-danger">*</span></label>
            <input type="email" class="form-control form-control-sm text-center <?= isWrong('email') ? 'is-invalid' : '' ?>"
                id="email" name="email" value="<?= old('email') ?? $u->email ?>" required>
            <small class="text-muted"><?= isWrongText('email') ?></small>
        </div>
    </div>


    <div class="buttonsDiv">
        <button type="submit" class="btn btn-company" onclick="loading('show', true);">Atualizar <i
                class="ph ph-floppy-disk"></i></button>
        <a class="btn btn-secondary" href="<?= route('users.list') ?>">Cancelar</a>
    </div>
</form>