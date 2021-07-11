<?php

namespace PHPMaker2021\project1;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for pacientes
 */
class Pacientes extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id_paciente;
    public $nombres;
    public $apellidos;
    public $edad;
    public $telefono;
    public $direccion;
    public $estado;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pacientes';
        $this->TableName = 'pacientes';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`pacientes`";
        $this->Dbid = 'DB';
        $this->ExportAll = false;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id_paciente
        $this->id_paciente = new DbField('pacientes', 'pacientes', 'x_id_paciente', 'id_paciente', '`id_paciente`', '`id_paciente`', 3, 11, -1, false, '`id_paciente`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id_paciente->IsAutoIncrement = true; // Autoincrement field
        $this->id_paciente->IsPrimaryKey = true; // Primary key field
        $this->id_paciente->Sortable = true; // Allow sort
        $this->id_paciente->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_paciente->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_paciente->Param, "CustomMsg");
        $this->Fields['id_paciente'] = &$this->id_paciente;

        // nombres
        $this->nombres = new DbField('pacientes', 'pacientes', 'x_nombres', 'nombres', '`nombres`', '`nombres`', 200, 50, -1, false, '`nombres`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nombres->Sortable = true; // Allow sort
        $this->nombres->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nombres->Param, "CustomMsg");
        $this->Fields['nombres'] = &$this->nombres;

        // apellidos
        $this->apellidos = new DbField('pacientes', 'pacientes', 'x_apellidos', 'apellidos', '`apellidos`', '`apellidos`', 200, 50, -1, false, '`apellidos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->apellidos->Sortable = true; // Allow sort
        $this->apellidos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->apellidos->Param, "CustomMsg");
        $this->Fields['apellidos'] = &$this->apellidos;

        // edad
        $this->edad = new DbField('pacientes', 'pacientes', 'x_edad', 'edad', '`edad`', '`edad`', 3, 3, -1, false, '`edad`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->edad->Sortable = true; // Allow sort
        $this->edad->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->edad->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->edad->Param, "CustomMsg");
        $this->Fields['edad'] = &$this->edad;

        // telefono
        $this->telefono = new DbField('pacientes', 'pacientes', 'x_telefono', 'telefono', '`telefono`', '`telefono`', 200, 15, -1, false, '`telefono`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->telefono->Sortable = true; // Allow sort
        $this->telefono->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->telefono->Param, "CustomMsg");
        $this->Fields['telefono'] = &$this->telefono;

        // direccion
        $this->direccion = new DbField('pacientes', 'pacientes', 'x_direccion', 'direccion', '`direccion`', '`direccion`', 200, 100, -1, false, '`direccion`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->direccion->Sortable = true; // Allow sort
        $this->direccion->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->direccion->Param, "CustomMsg");
        $this->Fields['direccion'] = &$this->direccion;

        // estado
        $this->estado = new DbField('pacientes', 'pacientes', 'x_estado', 'estado', '`estado`', '`estado`', 200, 50, -1, false, '`estado`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->estado->Nullable = false; // NOT NULL field
        $this->estado->Required = true; // Required field
        $this->estado->Sortable = true; // Allow sort
        $this->estado->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->estado->Param, "CustomMsg");
        $this->Fields['estado'] = &$this->estado;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`pacientes`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->id_paciente->setDbValue($conn->lastInsertId());
            $rs['id_paciente'] = $this->id_paciente->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id_paciente', $rs)) {
                AddFilter($where, QuotedName('id_paciente', $this->Dbid) . '=' . QuotedValue($rs['id_paciente'], $this->id_paciente->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id_paciente->DbValue = $row['id_paciente'];
        $this->nombres->DbValue = $row['nombres'];
        $this->apellidos->DbValue = $row['apellidos'];
        $this->edad->DbValue = $row['edad'];
        $this->telefono->DbValue = $row['telefono'];
        $this->direccion->DbValue = $row['direccion'];
        $this->estado->DbValue = $row['estado'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id_paciente` = @id_paciente@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id_paciente->CurrentValue : $this->id_paciente->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id_paciente->CurrentValue = $keys[0];
            } else {
                $this->id_paciente->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id_paciente', $row) ? $row['id_paciente'] : null;
        } else {
            $val = $this->id_paciente->OldValue !== null ? $this->id_paciente->OldValue : $this->id_paciente->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id_paciente@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("PacientesList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "PacientesView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PacientesEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PacientesAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "PacientesView";
            case Config("API_ADD_ACTION"):
                return "PacientesAdd";
            case Config("API_EDIT_ACTION"):
                return "PacientesEdit";
            case Config("API_DELETE_ACTION"):
                return "PacientesDelete";
            case Config("API_LIST_ACTION"):
                return "PacientesList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PacientesList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PacientesView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PacientesView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PacientesAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PacientesAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PacientesEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("PacientesAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("PacientesDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id_paciente:" . JsonEncode($this->id_paciente->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id_paciente->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id_paciente->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id_paciente") ?? Route("id_paciente")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id_paciente->CurrentValue = $key;
            } else {
                $this->id_paciente->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->id_paciente->setDbValue($row['id_paciente']);
        $this->nombres->setDbValue($row['nombres']);
        $this->apellidos->setDbValue($row['apellidos']);
        $this->edad->setDbValue($row['edad']);
        $this->telefono->setDbValue($row['telefono']);
        $this->direccion->setDbValue($row['direccion']);
        $this->estado->setDbValue($row['estado']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id_paciente

        // nombres

        // apellidos

        // edad

        // telefono

        // direccion

        // estado

        // id_paciente
        $this->id_paciente->ViewValue = $this->id_paciente->CurrentValue;
        $this->id_paciente->ViewCustomAttributes = "";

        // nombres
        $this->nombres->ViewValue = $this->nombres->CurrentValue;
        $this->nombres->ViewCustomAttributes = "";

        // apellidos
        $this->apellidos->ViewValue = $this->apellidos->CurrentValue;
        $this->apellidos->ViewCustomAttributes = "";

        // edad
        $this->edad->ViewValue = $this->edad->CurrentValue;
        $this->edad->ViewValue = FormatNumber($this->edad->ViewValue, 0, -2, -2, -2);
        $this->edad->ViewCustomAttributes = "";

        // telefono
        $this->telefono->ViewValue = $this->telefono->CurrentValue;
        $this->telefono->ViewCustomAttributes = "";

        // direccion
        $this->direccion->ViewValue = $this->direccion->CurrentValue;
        $this->direccion->ViewCustomAttributes = "";

        // estado
        $this->estado->ViewValue = $this->estado->CurrentValue;
        $this->estado->ViewCustomAttributes = "";

        // id_paciente
        $this->id_paciente->LinkCustomAttributes = "";
        $this->id_paciente->HrefValue = "";
        $this->id_paciente->TooltipValue = "";

        // nombres
        $this->nombres->LinkCustomAttributes = "";
        $this->nombres->HrefValue = "";
        $this->nombres->TooltipValue = "";

        // apellidos
        $this->apellidos->LinkCustomAttributes = "";
        $this->apellidos->HrefValue = "";
        $this->apellidos->TooltipValue = "";

        // edad
        $this->edad->LinkCustomAttributes = "";
        $this->edad->HrefValue = "";
        $this->edad->TooltipValue = "";

        // telefono
        $this->telefono->LinkCustomAttributes = "";
        $this->telefono->HrefValue = "";
        $this->telefono->TooltipValue = "";

        // direccion
        $this->direccion->LinkCustomAttributes = "";
        $this->direccion->HrefValue = "";
        $this->direccion->TooltipValue = "";

        // estado
        $this->estado->LinkCustomAttributes = "";
        $this->estado->HrefValue = "";
        $this->estado->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id_paciente
        $this->id_paciente->EditAttrs["class"] = "form-control";
        $this->id_paciente->EditCustomAttributes = "";
        $this->id_paciente->EditValue = $this->id_paciente->CurrentValue;
        $this->id_paciente->ViewCustomAttributes = "";

        // nombres
        $this->nombres->EditAttrs["class"] = "form-control";
        $this->nombres->EditCustomAttributes = "";
        if (!$this->nombres->Raw) {
            $this->nombres->CurrentValue = HtmlDecode($this->nombres->CurrentValue);
        }
        $this->nombres->EditValue = $this->nombres->CurrentValue;
        $this->nombres->PlaceHolder = RemoveHtml($this->nombres->caption());

        // apellidos
        $this->apellidos->EditAttrs["class"] = "form-control";
        $this->apellidos->EditCustomAttributes = "";
        if (!$this->apellidos->Raw) {
            $this->apellidos->CurrentValue = HtmlDecode($this->apellidos->CurrentValue);
        }
        $this->apellidos->EditValue = $this->apellidos->CurrentValue;
        $this->apellidos->PlaceHolder = RemoveHtml($this->apellidos->caption());

        // edad
        $this->edad->EditAttrs["class"] = "form-control";
        $this->edad->EditCustomAttributes = "";
        $this->edad->EditValue = $this->edad->CurrentValue;
        $this->edad->PlaceHolder = RemoveHtml($this->edad->caption());

        // telefono
        $this->telefono->EditAttrs["class"] = "form-control";
        $this->telefono->EditCustomAttributes = "";
        if (!$this->telefono->Raw) {
            $this->telefono->CurrentValue = HtmlDecode($this->telefono->CurrentValue);
        }
        $this->telefono->EditValue = $this->telefono->CurrentValue;
        $this->telefono->PlaceHolder = RemoveHtml($this->telefono->caption());

        // direccion
        $this->direccion->EditAttrs["class"] = "form-control";
        $this->direccion->EditCustomAttributes = "";
        if (!$this->direccion->Raw) {
            $this->direccion->CurrentValue = HtmlDecode($this->direccion->CurrentValue);
        }
        $this->direccion->EditValue = $this->direccion->CurrentValue;
        $this->direccion->PlaceHolder = RemoveHtml($this->direccion->caption());

        // estado
        $this->estado->EditAttrs["class"] = "form-control";
        $this->estado->EditCustomAttributes = "";
        if (!$this->estado->Raw) {
            $this->estado->CurrentValue = HtmlDecode($this->estado->CurrentValue);
        }
        $this->estado->EditValue = $this->estado->CurrentValue;
        $this->estado->PlaceHolder = RemoveHtml($this->estado->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id_paciente);
                    $doc->exportCaption($this->nombres);
                    $doc->exportCaption($this->apellidos);
                    $doc->exportCaption($this->edad);
                    $doc->exportCaption($this->telefono);
                    $doc->exportCaption($this->direccion);
                    $doc->exportCaption($this->estado);
                } else {
                    $doc->exportCaption($this->id_paciente);
                    $doc->exportCaption($this->nombres);
                    $doc->exportCaption($this->apellidos);
                    $doc->exportCaption($this->edad);
                    $doc->exportCaption($this->telefono);
                    $doc->exportCaption($this->direccion);
                    $doc->exportCaption($this->estado);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id_paciente);
                        $doc->exportField($this->nombres);
                        $doc->exportField($this->apellidos);
                        $doc->exportField($this->edad);
                        $doc->exportField($this->telefono);
                        $doc->exportField($this->direccion);
                        $doc->exportField($this->estado);
                    } else {
                        $doc->exportField($this->id_paciente);
                        $doc->exportField($this->nombres);
                        $doc->exportField($this->apellidos);
                        $doc->exportField($this->edad);
                        $doc->exportField($this->telefono);
                        $doc->exportField($this->direccion);
                        $doc->exportField($this->estado);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
