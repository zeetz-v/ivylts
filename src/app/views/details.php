<?php
$this->layout("templates/base", [
    "webTitle" => "Check-in",
    "cardTitle" => "Check-in",
    "styles" => [],
    "js" => [],
]);
?>


<div class="row mb-3">
    <div class="col-12">
        <a href="<?= route("read") ?>" class="btn btn-company"><i class="ph ph-arrow-left"></i> Check-in</a>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card mb-3" style="background-color: #ABE7B2;">
            <div class="card-body text-center">
                <h5 class="card-title text-center fw-bold">PRESENTES</h5>
                <small>Total de pessoas</small>
                <h4 class="text-center"><?= $details["presentes"]["total"] ?></h4>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card mb-3" style="background-color: #FFA08A">
            <div class="card-body text-center">
                <h5 class="card-title text-center fw-bold">AUSENTES</h5>
                <small>Total de pessoas ausentes por funcionário</small>
                <h4 class="text-center"><?= $details["ausentes"]["total"] ?></h4>
            </div>
        </div>
    </div>


    <div class="col-12 col-md-6">
        <div class="card mb-3" style="min-height: 450px; max-height: 450px; overflow-y: scroll;">
            <div class="card-body text-center">
                <?php foreach ($details["presentes"]["list"] as $person_idx => $person) { ?>
                    <p><?= $person ?></p>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="card mb-3" style="min-height: 450px; max-height: 450px; overflow-y: scroll;">
            <div class="card-body text-center">
                <?php foreach ($details["ausentes"]["list"] as $person_idx => $person) { ?>
                    <p><?= $person ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>