<?php

namespace PHPMaker2021\project1;

// Page object
$PacientesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpacientesview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fpacientesview = currentForm = new ew.Form("fpacientesview", "view");
    loadjs.done("fpacientesview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.pacientes) ew.vars.tables.pacientes = <?= JsonEncode(GetClientVar("tables", "pacientes")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpacientesview" id="fpacientesview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pacientes">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_paciente->Visible) { // id_paciente ?>
    <tr id="r_id_paciente">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pacientes_id_paciente"><?= $Page->id_paciente->caption() ?></span></td>
        <td data-name="id_paciente" <?= $Page->id_paciente->cellAttributes() ?>>
<span id="el_pacientes_id_paciente">
<span<?= $Page->id_paciente->viewAttributes() ?>>
<?= $Page->id_paciente->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nombres->Visible) { // nombres ?>
    <tr id="r_nombres">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pacientes_nombres"><?= $Page->nombres->caption() ?></span></td>
        <td data-name="nombres" <?= $Page->nombres->cellAttributes() ?>>
<span id="el_pacientes_nombres">
<span<?= $Page->nombres->viewAttributes() ?>>
<?= $Page->nombres->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->apellidos->Visible) { // apellidos ?>
    <tr id="r_apellidos">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pacientes_apellidos"><?= $Page->apellidos->caption() ?></span></td>
        <td data-name="apellidos" <?= $Page->apellidos->cellAttributes() ?>>
<span id="el_pacientes_apellidos">
<span<?= $Page->apellidos->viewAttributes() ?>>
<?= $Page->apellidos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->edad->Visible) { // edad ?>
    <tr id="r_edad">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pacientes_edad"><?= $Page->edad->caption() ?></span></td>
        <td data-name="edad" <?= $Page->edad->cellAttributes() ?>>
<span id="el_pacientes_edad">
<span<?= $Page->edad->viewAttributes() ?>>
<?= $Page->edad->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
    <tr id="r_telefono">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pacientes_telefono"><?= $Page->telefono->caption() ?></span></td>
        <td data-name="telefono" <?= $Page->telefono->cellAttributes() ?>>
<span id="el_pacientes_telefono">
<span<?= $Page->telefono->viewAttributes() ?>>
<?= $Page->telefono->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->direccion->Visible) { // direccion ?>
    <tr id="r_direccion">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pacientes_direccion"><?= $Page->direccion->caption() ?></span></td>
        <td data-name="direccion" <?= $Page->direccion->cellAttributes() ?>>
<span id="el_pacientes_direccion">
<span<?= $Page->direccion->viewAttributes() ?>>
<?= $Page->direccion->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
