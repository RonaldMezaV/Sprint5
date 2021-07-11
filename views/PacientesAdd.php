<?php

namespace PHPMaker2021\project1;

// Page object
$PacientesAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fpacientesadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fpacientesadd = currentForm = new ew.Form("fpacientesadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "pacientes")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.pacientes)
        ew.vars.tables.pacientes = currentTable;
    fpacientesadd.addFields([
        ["nombres", [fields.nombres.visible && fields.nombres.required ? ew.Validators.required(fields.nombres.caption) : null], fields.nombres.isInvalid],
        ["apellidos", [fields.apellidos.visible && fields.apellidos.required ? ew.Validators.required(fields.apellidos.caption) : null], fields.apellidos.isInvalid],
        ["edad", [fields.edad.visible && fields.edad.required ? ew.Validators.required(fields.edad.caption) : null, ew.Validators.integer], fields.edad.isInvalid],
        ["telefono", [fields.telefono.visible && fields.telefono.required ? ew.Validators.required(fields.telefono.caption) : null], fields.telefono.isInvalid],
        ["direccion", [fields.direccion.visible && fields.direccion.required ? ew.Validators.required(fields.direccion.caption) : null], fields.direccion.isInvalid],
        ["estado", [fields.estado.visible && fields.estado.required ? ew.Validators.required(fields.estado.caption) : null], fields.estado.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fpacientesadd,
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
    fpacientesadd.validate = function () {
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
    fpacientesadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpacientesadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fpacientesadd");
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
<form name="fpacientesadd" id="fpacientesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pacientes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nombres->Visible) { // nombres ?>
    <div id="r_nombres" class="form-group row">
        <label id="elh_pacientes_nombres" for="x_nombres" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nombres->caption() ?><?= $Page->nombres->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nombres->cellAttributes() ?>>
<span id="el_pacientes_nombres">
<input type="<?= $Page->nombres->getInputTextType() ?>" data-table="pacientes" data-field="x_nombres" name="x_nombres" id="x_nombres" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nombres->getPlaceHolder()) ?>" value="<?= $Page->nombres->EditValue ?>"<?= $Page->nombres->editAttributes() ?> aria-describedby="x_nombres_help">
<?= $Page->nombres->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nombres->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->apellidos->Visible) { // apellidos ?>
    <div id="r_apellidos" class="form-group row">
        <label id="elh_pacientes_apellidos" for="x_apellidos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->apellidos->caption() ?><?= $Page->apellidos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->apellidos->cellAttributes() ?>>
<span id="el_pacientes_apellidos">
<input type="<?= $Page->apellidos->getInputTextType() ?>" data-table="pacientes" data-field="x_apellidos" name="x_apellidos" id="x_apellidos" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->apellidos->getPlaceHolder()) ?>" value="<?= $Page->apellidos->EditValue ?>"<?= $Page->apellidos->editAttributes() ?> aria-describedby="x_apellidos_help">
<?= $Page->apellidos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->apellidos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->edad->Visible) { // edad ?>
    <div id="r_edad" class="form-group row">
        <label id="elh_pacientes_edad" for="x_edad" class="<?= $Page->LeftColumnClass ?>"><?= $Page->edad->caption() ?><?= $Page->edad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->edad->cellAttributes() ?>>
<span id="el_pacientes_edad">
<input type="<?= $Page->edad->getInputTextType() ?>" data-table="pacientes" data-field="x_edad" name="x_edad" id="x_edad" size="30" placeholder="<?= HtmlEncode($Page->edad->getPlaceHolder()) ?>" value="<?= $Page->edad->EditValue ?>"<?= $Page->edad->editAttributes() ?> aria-describedby="x_edad_help">
<?= $Page->edad->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->edad->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
    <div id="r_telefono" class="form-group row">
        <label id="elh_pacientes_telefono" for="x_telefono" class="<?= $Page->LeftColumnClass ?>"><?= $Page->telefono->caption() ?><?= $Page->telefono->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->telefono->cellAttributes() ?>>
<span id="el_pacientes_telefono">
<input type="<?= $Page->telefono->getInputTextType() ?>" data-table="pacientes" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->telefono->getPlaceHolder()) ?>" value="<?= $Page->telefono->EditValue ?>"<?= $Page->telefono->editAttributes() ?> aria-describedby="x_telefono_help">
<?= $Page->telefono->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->telefono->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->direccion->Visible) { // direccion ?>
    <div id="r_direccion" class="form-group row">
        <label id="elh_pacientes_direccion" for="x_direccion" class="<?= $Page->LeftColumnClass ?>"><?= $Page->direccion->caption() ?><?= $Page->direccion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->direccion->cellAttributes() ?>>
<span id="el_pacientes_direccion">
<input type="<?= $Page->direccion->getInputTextType() ?>" data-table="pacientes" data-field="x_direccion" name="x_direccion" id="x_direccion" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->direccion->getPlaceHolder()) ?>" value="<?= $Page->direccion->EditValue ?>"<?= $Page->direccion->editAttributes() ?> aria-describedby="x_direccion_help">
<?= $Page->direccion->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->direccion->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->estado->Visible) { // estado ?>
    <div id="r_estado" class="form-group row">
        <label id="elh_pacientes_estado" for="x_estado" class="<?= $Page->LeftColumnClass ?>"><?= $Page->estado->caption() ?><?= $Page->estado->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->estado->cellAttributes() ?>>
<span id="el_pacientes_estado">
<input type="<?= $Page->estado->getInputTextType() ?>" data-table="pacientes" data-field="x_estado" name="x_estado" id="x_estado" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->estado->getPlaceHolder()) ?>" value="<?= $Page->estado->EditValue ?>"<?= $Page->estado->editAttributes() ?> aria-describedby="x_estado_help">
<?= $Page->estado->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->estado->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("pacientes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
