<?php

namespace PHPMaker2021\project1;

// Page object
$UsuariosView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fusuariosview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fusuariosview = currentForm = new ew.Form("fusuariosview", "view");
    loadjs.done("fusuariosview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.usuarios) ew.vars.tables.usuarios = <?= JsonEncode(GetClientVar("tables", "usuarios")) ?>;
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
<form name="fusuariosview" id="fusuariosview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id_usuario->Visible) { // id_usuario ?>
    <tr id="r_id_usuario">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_id_usuario"><?= $Page->id_usuario->caption() ?></span></td>
        <td data-name="id_usuario" <?= $Page->id_usuario->cellAttributes() ?>>
<span id="el_usuarios_id_usuario">
<span<?= $Page->id_usuario->viewAttributes() ?>>
<?= $Page->id_usuario->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->usuario->Visible) { // usuario ?>
    <tr id="r_usuario">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_usuario"><?= $Page->usuario->caption() ?></span></td>
        <td data-name="usuario" <?= $Page->usuario->cellAttributes() ?>>
<span id="el_usuarios_usuario">
<span<?= $Page->usuario->viewAttributes() ?>>
<?= $Page->usuario->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->clave->Visible) { // clave ?>
    <tr id="r_clave">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_usuarios_clave"><?= $Page->clave->caption() ?></span></td>
        <td data-name="clave" <?= $Page->clave->cellAttributes() ?>>
<span id="el_usuarios_clave">
<span<?= $Page->clave->viewAttributes() ?>>
<?= $Page->clave->getViewValue() ?></span>
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
