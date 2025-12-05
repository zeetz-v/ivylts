<?php
$this->layout("templates/base", [
    "webTitle" => "Check-in",
    "cardTitle" => "Check-in",
    "styles" => [],
    "js" => [],
]);
?>

<style>
    .container {
        max-width: 800px !important;
    }

    .dep {
        border: 1px solid #EDEDED;
        border-radius: 8px;
        background: #F6F6F6;
    }

    .dep:hover {
        background: #011c74ff;
        cursor: pointer;
        color: #FFF;
    }



    .dep-selected {
        border: 1px solid #5ead72ff;
        border-radius: 8px;
        background: #F1F3E0;
    }

    .dep-selected:hover {
        background: #f5f8dbff;
        cursor: pointer;
        color: darkslategray;
    }
</style>

<div class="row mb-3">
    <div class="col-12 p-0">
        <a href="<?= route("details") ?>" class="btn btn-company">Detalhes 🔎</a>
    </div>
</div>

<form method="GET" action="<?= route("read") ?>" id="form-create">
    <div class="row mb-3">
        <div class="col-md-12 p-0">
            <label for="key" class="form-label fw-bold">Matrícula <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm text-center" id="key" name="key"
                value="<?= $collaborator["matricula"] ?? '' ?>" required autofocus>
        </div>
    </div>
</form>


<form action="<?= route("checkin") ?>" method="post">
    <input type="hidden" name="collaborator" id="collaborator" value="<?= $collaborator["matricula"] ?>">
    <div class="row gy-3">
        <?php
        if ($checkin)
            $presentes = explode(';', $checkin->presentes); ?>
        <?php if (isset($deps) && $deps) { ?>
            <?php foreach ($deps as $dep_idx => $dep) { ?>
                <div class="col-12 py-3 dep <?= $checkin && in_array($dep["nomdep"], $presentes) ? "dep-selected" : "" ?>"
                    data-idx="<?= $dep_idx ?>" onclick="selectDep(this)">
                    <p class="m-0 text-center"><?= $dep["nomdep"] ?></p>
                    <select name="deps[<?= $dep["nomdep"] ?>]" id="dep-<?= $dep_idx ?>" class="d-none">
                        <option value="não">não</option>
                        <option value="sim" <?= $checkin && in_array($dep["nomdep"], $presentes) ? "selected" : "" ?>>sim</option>
                    </select>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <div class="row mt-3">
        <div class="col-12 p-0">
            <button class="btn btn-company w-100 py-3" <?= empty($_GET["key"]) ? 'disabled' : ''; ?>>Check-in <i
                    class="ph ph-paper-plane-tilt"></i></button>
        </div>
    </div>
</form>


<script>
    function selectDep(elm) {
        let idx = elm.dataset.idx;
        let selectElement = document.getElementById("dep-" + idx);
        let selectElementValue = selectElement.value;
        if (selectElementValue === 'não') {
            if (!elm.classList.contains("dep-selected"))
                elm.classList.add("dep-selected");
            selectElement.value = "sim";
        }
        else {
            if (elm.classList.contains("dep-selected"))
                elm.classList.remove("dep-selected");
            selectElement.value = "não";
        }
    }
</script>