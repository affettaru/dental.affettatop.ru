<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt = array();

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;
$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    array(
        "IS_SEF" => "Y",
        // каталог инфоблока на сайте
        "SEF_BASE_URL" => "/catalog/", 
        // ID раздела
        "SECTION_PAGE_URL" => "#SECTION_CODE#/", 
        // полный путь к элементу инфоблока
        "DETAIL_PAGE_URL" => "#SECTION_CODE#/#CODE#", 
        // ID типа инфоблока из которого выводим
        "IBLOCK_TYPE" => "company", 
        // ID инфоблока из которого выводим
        "IBLOCK_ID" => "4", 
        // уровень вложенности
        "DEPTH_LEVEL" => "2", 
        // включение кеша
        "CACHE_TYPE" => "A", 
        // время кеша
        "CACHE_TIME" => "36000000" 
    ),
    false
);
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);






?>
