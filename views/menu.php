<?php

namespace PHPMaker2021\project1;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi_pacientes", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "PacientesList", -1, "", IsLoggedIn() || AllowListMenu('{C3546E04-6F69-442A-ACDE-3679B8769A86}pacientes'), false, false, "fas fa-procedures", "", false);
echo $sideMenu->toScript();
