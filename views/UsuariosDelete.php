<?php

namespace PHPMaker2021\project1;

// Page object
$UsuariosDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fusuariosdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fusuariosdelete = currentForm = new ew.Form("fusuariosdelete", "delete");
    loadjs.done("fusuariosdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.usuarios) ew.vars.tables.usuarios = <?= JsonEncode(GetClientVar("tables", "usuarios")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fusuariosdelete" id="fusuariosdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="usuarios">
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
<?php if ($Page->id_usuario->Visible) { // id_usuario ?>
        <th class="<?= $Page->id_usuario->headerCellClass() ?>"><span id="elh_usuarios_id_usuario" class="usuarios_id_usuario"><?= $Page->id_usuario->caption() ?></span></th>
<?php } ?>
<?php if ($Page->usuario->Visible) { // usuario ?>
        <th class="<?= $Page->usuario->headerCellClass() ?>"><span id="elh_usuarios_usuario" class="usuarios_usuario"><?= $Page->usuario->caption() ?></span></th>
<?php } ?>
<?php if ($Page->clave->Visible) { // clave ?>
        <th class="<?= $Page->clave->headerCellClass() ?>"><span id="elh_usuarios_clave" class="usuarios_clave"><?= $Page->clave->caption() ?></span></th>
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
<?php if ($Page->id_usuario->Visible) { // id_usuario ?>
        <td <?= $Page->id_usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_id_usuario" class="usuarios_id_usuario">
<span<?= $Page->id_usuario->viewAttributes() ?>>
<?= $Page->id_usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->usuario->Visible) { // usuario ?>
        <td <?= $Page->usuario->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_usuario" class="usuarios_usuario">
<span<?= $Page->usuario->viewAttributes() ?>>
<?= $Page->usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->clave->Visible) { // clave ?>
        <td <?= $Page->clave->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_usuarios_clave" class="usuarios_clave">
<span<?= $Page->clave->viewAttributes() ?>>
<?= $Page->clave->getViewValue() ?></span>
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
