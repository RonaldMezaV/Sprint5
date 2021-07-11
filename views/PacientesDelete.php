<?php

namespace PHPMaker2021\project1;

// Page object
$PacientesDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpacientesdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fpacientesdelete = currentForm = new ew.Form("fpacientesdelete", "delete");
    loadjs.done("fpacientesdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.pacientes) ew.vars.tables.pacientes = <?= JsonEncode(GetClientVar("tables", "pacientes")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpacientesdelete" id="fpacientesdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pacientes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id_paciente->Visible) { // id_paciente ?>
        <th class="<?= $Page->id_paciente->headerCellClass() ?>"><span id="elh_pacientes_id_paciente" class="pacientes_id_paciente"><?= $Page->id_paciente->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nombres->Visible) { // nombres ?>
        <th class="<?= $Page->nombres->headerCellClass() ?>"><span id="elh_pacientes_nombres" class="pacientes_nombres"><?= $Page->nombres->caption() ?></span></th>
<?php } ?>
<?php if ($Page->apellidos->Visible) { // apellidos ?>
        <th class="<?= $Page->apellidos->headerCellClass() ?>"><span id="elh_pacientes_apellidos" class="pacientes_apellidos"><?= $Page->apellidos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->edad->Visible) { // edad ?>
        <th class="<?= $Page->edad->headerCellClass() ?>"><span id="elh_pacientes_edad" class="pacientes_edad"><?= $Page->edad->caption() ?></span></th>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
        <th class="<?= $Page->telefono->headerCellClass() ?>"><span id="elh_pacientes_telefono" class="pacientes_telefono"><?= $Page->telefono->caption() ?></span></th>
<?php } ?>
<?php if ($Page->direccion->Visible) { // direccion ?>
        <th class="<?= $Page->direccion->headerCellClass() ?>"><span id="elh_pacientes_direccion" class="pacientes_direccion"><?= $Page->direccion->caption() ?></span></th>
<?php } ?>
<?php if ($Page->estado->Visible) { // estado ?>
        <th class="<?= $Page->estado->headerCellClass() ?>"><span id="elh_pacientes_estado" class="pacientes_estado"><?= $Page->estado->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id_paciente->Visible) { // id_paciente ?>
        <td <?= $Page->id_paciente->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_id_paciente" class="pacientes_id_paciente">
<span<?= $Page->id_paciente->viewAttributes() ?>>
<?= $Page->id_paciente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nombres->Visible) { // nombres ?>
        <td <?= $Page->nombres->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_nombres" class="pacientes_nombres">
<span<?= $Page->nombres->viewAttributes() ?>>
<?= $Page->nombres->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->apellidos->Visible) { // apellidos ?>
        <td <?= $Page->apellidos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_apellidos" class="pacientes_apellidos">
<span<?= $Page->apellidos->viewAttributes() ?>>
<?= $Page->apellidos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->edad->Visible) { // edad ?>
        <td <?= $Page->edad->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_edad" class="pacientes_edad">
<span<?= $Page->edad->viewAttributes() ?>>
<?= $Page->edad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
        <td <?= $Page->telefono->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_telefono" class="pacientes_telefono">
<span<?= $Page->telefono->viewAttributes() ?>>
<?= $Page->telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->direccion->Visible) { // direccion ?>
        <td <?= $Page->direccion->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_direccion" class="pacientes_direccion">
<span<?= $Page->direccion->viewAttributes() ?>>
<?= $Page->direccion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->estado->Visible) { // estado ?>
        <td <?= $Page->estado->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_estado" class="pacientes_estado">
<span<?= $Page->estado->viewAttributes() ?>>
<?= $Page->estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
