<?php

namespace PHPMaker2021\project1;

// Page object
$UsuariosEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fusuariosedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fusuariosedit = currentForm = new ew.Form("fusuariosedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "usuarios")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.usuarios)
        ew.vars.tables.usuarios = currentTable;
    fusuariosedit.addFields([
        ["id_usuario", [fields.id_usuario.visible && fields.id_usuario.required ? ew.Validators.required(fields.id_usuario.caption) : null], fields.id_usuario.isInvalid],
        ["usuario", [fields.usuario.visible && fields.usuario.required ? ew.Validators.required(fields.usuario.caption) : null], fields.usuario.isInvalid],
        ["clave", [fields.clave.visible && fields.clave.required ? ew.Validators.required(fields.clave.caption) : null], fields.clave.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fusuariosedit,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fusuariosedit.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fusuariosedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fusuariosedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fusuariosedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fusuariosedit" id="fusuariosedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id_usuario->Visible) { // id_usuario ?>
    <div id="r_id_usuario" class="form-group row">
        <label id="elh_usuarios_id_usuario" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_usuario->caption() ?><?= $Page->id_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_usuario->cellAttributes() ?>>
<span id="el_usuarios_id_usuario">
<span<?= $Page->id_usuario->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id_usuario->getDisplayValue($Page->id_usuario->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="usuarios" data-field="x_id_usuario" data-hidden="1" name="x_id_usuario" id="x_id_usuario" value="<?= HtmlEncode($Page->id_usuario->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->usuario->Visible) { // usuario ?>
    <div id="r_usuario" class="form-group row">
        <label id="elh_usuarios_usuario" for="x_usuario" class="<?= $Page->LeftColumnClass ?>"><?= $Page->usuario->caption() ?><?= $Page->usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->usuario->cellAttributes() ?>>
<span id="el_usuarios_usuario">
<input type="<?= $Page->usuario->getInputTextType() ?>" data-table="usuarios" data-field="x_usuario" name="x_usuario" id="x_usuario" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->usuario->getPlaceHolder()) ?>" value="<?= $Page->usuario->EditValue ?>"<?= $Page->usuario->editAttributes() ?> aria-describedby="x_usuario_help">
<?= $Page->usuario->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->usuario->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->clave->Visible) { // clave ?>
    <div id="r_clave" class="form-group row">
        <label id="elh_usuarios_clave" for="x_clave" class="<?= $Page->LeftColumnClass ?>"><?= $Page->clave->caption() ?><?= $Page->clave->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->clave->cellAttributes() ?>>
<span id="el_usuarios_clave">
<input type="<?= $Page->clave->getInputTextType() ?>" data-table="usuarios" data-field="x_clave" name="x_clave" id="x_clave" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->clave->getPlaceHolder()) ?>" value="<?= $Page->clave->EditValue ?>"<?= $Page->clave->editAttributes() ?> aria-describedby="x_clave_help">
<?= $Page->clave->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->clave->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("usuarios");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
