<?php

namespace PHPMaker2021\project1;

// Page object
$PacientesList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fpacienteslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fpacienteslist = currentForm = new ew.Form("fpacienteslist", "list");
    fpacienteslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fpacienteslist");
});
var fpacienteslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fpacienteslistsrch = currentSearchForm = new ew.Form("fpacienteslistsrch");

    // Dynamic selection lists

    // Filters
    fpacienteslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpacienteslistsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fpacienteslistsrch" id="fpacienteslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpacienteslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pacientes">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pacientes">
<form name="fpacienteslist" id="fpacienteslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pacientes">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_pacientes" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pacienteslist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id_paciente->Visible) { // id_paciente ?>
        <th data-name="id_paciente" class="<?= $Page->id_paciente->headerCellClass() ?>"><div id="elh_pacientes_id_paciente" class="pacientes_id_paciente"><?= $Page->renderSort($Page->id_paciente) ?></div></th>
<?php } ?>
<?php if ($Page->nombres->Visible) { // nombres ?>
        <th data-name="nombres" class="<?= $Page->nombres->headerCellClass() ?>"><div id="elh_pacientes_nombres" class="pacientes_nombres"><?= $Page->renderSort($Page->nombres) ?></div></th>
<?php } ?>
<?php if ($Page->apellidos->Visible) { // apellidos ?>
        <th data-name="apellidos" class="<?= $Page->apellidos->headerCellClass() ?>"><div id="elh_pacientes_apellidos" class="pacientes_apellidos"><?= $Page->renderSort($Page->apellidos) ?></div></th>
<?php } ?>
<?php if ($Page->edad->Visible) { // edad ?>
        <th data-name="edad" class="<?= $Page->edad->headerCellClass() ?>"><div id="elh_pacientes_edad" class="pacientes_edad"><?= $Page->renderSort($Page->edad) ?></div></th>
<?php } ?>
<?php if ($Page->telefono->Visible) { // telefono ?>
        <th data-name="telefono" class="<?= $Page->telefono->headerCellClass() ?>"><div id="elh_pacientes_telefono" class="pacientes_telefono"><?= $Page->renderSort($Page->telefono) ?></div></th>
<?php } ?>
<?php if ($Page->direccion->Visible) { // direccion ?>
        <th data-name="direccion" class="<?= $Page->direccion->headerCellClass() ?>"><div id="elh_pacientes_direccion" class="pacientes_direccion"><?= $Page->renderSort($Page->direccion) ?></div></th>
<?php } ?>
<?php if ($Page->estado->Visible) { // estado ?>
        <th data-name="estado" class="<?= $Page->estado->headerCellClass() ?>"><div id="elh_pacientes_estado" class="pacientes_estado"><?= $Page->renderSort($Page->estado) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_pacientes", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id_paciente->Visible) { // id_paciente ?>
        <td data-name="id_paciente" <?= $Page->id_paciente->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_id_paciente">
<span<?= $Page->id_paciente->viewAttributes() ?>>
<?= $Page->id_paciente->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nombres->Visible) { // nombres ?>
        <td data-name="nombres" <?= $Page->nombres->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_nombres">
<span<?= $Page->nombres->viewAttributes() ?>>
<?= $Page->nombres->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->apellidos->Visible) { // apellidos ?>
        <td data-name="apellidos" <?= $Page->apellidos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_apellidos">
<span<?= $Page->apellidos->viewAttributes() ?>>
<?= $Page->apellidos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->edad->Visible) { // edad ?>
        <td data-name="edad" <?= $Page->edad->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_edad">
<span<?= $Page->edad->viewAttributes() ?>>
<?= $Page->edad->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->telefono->Visible) { // telefono ?>
        <td data-name="telefono" <?= $Page->telefono->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_telefono">
<span<?= $Page->telefono->viewAttributes() ?>>
<?= $Page->telefono->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->direccion->Visible) { // direccion ?>
        <td data-name="direccion" <?= $Page->direccion->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_direccion">
<span<?= $Page->direccion->viewAttributes() ?>>
<?= $Page->direccion->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->estado->Visible) { // estado ?>
        <td data-name="estado" <?= $Page->estado->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pacientes_estado">
<span<?= $Page->estado->viewAttributes() ?>>
<?= $Page->estado->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
<?php } ?>
