<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

$this->setFrameMode(true);
// $this->addExternalCss("/bitrix/css/main/bootstrap.css");

if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');


                // $APPLICATION->IncludeComponent(
                //     "bitrix:catalog.section.list",
                //     "tree",
                //     array(
                //         "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                //         "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                //         "CACHE_TYPE" => "N",
                //         "CACHE_TIME" => $arParams["CACHE_TIME"],
                //         "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                //         "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                //         "TOP_DEPTH" => 4,
                //         "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                //         "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                //         "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                //         "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                //         "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                //         "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",

                //     ),
                //     $component,
                //     array("HIDE_ICONS" => "Y")
                // );
                
if ($isFilter)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (Loader::includeModule("iblock"))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
		$arCurSection = array();
	$arResult["VARIABLES"]["SECTION_ID"]=$arCurSection["ID"];
	
}

?>
<section class="block__padd block__padd__nofirst">
<div class="container">
<? 
	$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "main",
            array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
            ); ?>

<div class="pcatalog__title">
                    <div class="row">
                        <div class="col-12 block__overflow">
                            <h1 class="h1"><?= $APPLICATION->GetPageProperty('h1')?></h1>
                        </div>
                        <div class="col-12 d-xl-none"><a class="pcatalog__title__openfilter" href="#js--filter" data-fancybox-filter="data-fancybox-filter"><i><svg>
                                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-filter"></use>
                                    </svg></i><span>Фильтры</span></a></div>
                    </div>
                </div>

<div class="pcatalog block__overflow">
<?
if ($isVerticalFilter)
{
	include($_SERVER["DOCUMENT_ROOT"] . "/" . $this->GetFolder() . "/section_vertical.php");
}
else
{
	include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/section_horizontal.php");
}
$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"], $arResult["VARIABLES"]["SECTION_ID"]);
$seoProps = $ipropValues->getValues();

$APPLICATION->SetTitle($seoProps['SECTION_PAGE_TITLE']);
// // Устанавливаем мета-тег title
$APPLICATION->SetPageProperty('title', $seoProps['SECTION_META_TITLE']);
$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID", "NAME"));
$APPLICATION->SetPageProperty('h1', $arCurSection["NAME"]);
// // Устанавливаем мета-тег description
$APPLICATION->SetPageProperty('description', $seoProps['SECTION_META_DESCRIPTION']);?>

</div>
</div>
</section>
<?

