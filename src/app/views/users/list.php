<?php
$this->layout("templates/base", [
    "webTitle" => "Usuários",
    "cardTitle" => "Controle de usuários",
    "styles" => [
        'https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css'
    ],
    "js" => [
    ],
]);
?>

<style>
    .dt-search {
        input {
            text-align: center;
            margin-bottom: 12px;
        }
    }
</style>


<form method="POST" action="<?= route('users.store'); ?>" id="form-create">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id" class="form-label fw-bold">Id <span class="text-danger"></span></label>
            <input type="text" class="form-control form-control-sm" id="id" placeholder="Gerado automaticamente">
        </div>
        <div class="col-md-4">
            <label for="name" class="form-label fw-bold">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm <?= isWrong('name') ? 'is-invalid' : '' ?>" id="name"
                name="name" value="<?= old('name') ?>" required>
            <small class="text-muted"><?= isWrongText('name') ?></small>
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label fw-bold">E-mail <span class="text-danger">*</span></label>
            <input type="email" class="form-control form-control-sm <?= isWrong('email') ? 'is-invalid' : '' ?>"
                id="email" name="email" value="<?= old('email') ?>" required>
            <small class="text-muted"><?= isWrongText('email') ?></small>
        </div>
    </div>


    <div class="buttonsDiv">
        <button type="submit" class="btn btn-company" onclick="loading('show', true);">Salvar <i
                class="ph ph-floppy-disk"></i></button>
        <a class="btn btn-secondary" id="cancelForm">Cancelar</a>
    </div>
</form>
<hr>

<table id="list">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Nome</th>
            <th class="text-center">E-mail</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php if (isset($users) && count($users) > 0) { ?>
            <?php foreach ($users as $user_key => $u) { ?>
                <tr>
                    <td class="text-center <?= $u->deleted_at ? 'text-decoration-line-through' : '' ?>">
                        <?= $u->id ?>
                    </td>
                    <td class="text-center <?= $u->deleted_at ? 'text-decoration-line-through' : '' ?>">
                        <?= $u->name ?>
                    </td>
                    <td class="text-center <?= $u->deleted_at ? 'text-decoration-line-through' : '' ?>"><?= $u->email ?></td>
                    <td>
                        <button class="btn btn-sm btn-danger" popovertarget="confirm-dialog-user-delete"
                            data-dc-title="Exclusão de usuário"
                            data-dc-description="Essa ação é irreversível. Os posts e demais informações relacionadas ao usuário sumirão. Tem certeza que deseja continuar?"
                            data-dc-href="<?= route("users.delete", ["uuid" => $u->uuid]) ?>"><i
                                class="ph ph-trash"></i></button>
                        <a class="btn btn-sm btn-primary" href="<?= route('users.edit', ['uuid' => $u->uuid]) ?>"
                            onclick="loading('show', true);"><i class="ph ph-pencil"></i></a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>

</table>


<dialog id="confirm-dialog-user-delete" popover>
    <h3 id="dialog-custom-title"></h3>
    <p id="dialog-custom-description"></p>
    <a class="btn btn-sm btn-danger" id="dialog-custom-href">Delete</a>
    <button class="btn btn-sm btn-secondary" popovertarget="confirm-dialog-user-delete"
        popovertargetaction="hide">Cancel</button>
</dialog>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('[popovertarget="confirm-dialog-user-delete"]');
        const deleteDialog = document.getElementById('confirm-dialog-user-delete');

        if (!deleteDialog || deleteButtons.length === 0)
            return;

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                const triggerButton = this;
                const dialogTitle = deleteDialog.querySelector('#dialog-custom-title');
                const dialogDescription = deleteDialog.querySelector('#dialog-custom-description');
                const dialogHref = deleteDialog.querySelector('#dialog-custom-href');

                if (!dialogTitle
                    || !dialogDescription
                    || !dialogHref
                )
                    return;

                dialogTitle.innerHTML = triggerButton.dataset.dcTitle;
                dialogDescription.innerHTML = triggerButton.dataset.dcDescription;
                dialogHref.href = triggerButton.dataset.dcHref;

            });
        });
    });
</script>