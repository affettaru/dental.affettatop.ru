<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();



use Bitrix\Main\Type\Collection;
use Bitrix\Currency\CurrencyTable;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_10_SECTION",$arResult['SECTION']['ID'],"UF_FAIL");
if($arUF["UF_FAIL"]["VALUE"] != ""){
    $file= CFile::GetByID($arUF["UF_FAIL"]["VALUE"]);
	$arResult["SECTIONS"]['UF_FAIL'] =((array)$file)["arResult"][0]["SRC"];

}

$component = $this->getComponent();
if ($arResult["DETAIL_PICTURE"]) {
    $resize = CFIle::ResizeImageGet(
        $arResult["DETAIL_PICTURE"],
        array("width" => 1200, "height" => 1200),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["DETAIL_PICTURE"]["BIG"]["SRC"] = $resize["src"];

    $resize = CFIle::ResizeImageGet(
        $arResult["DETAIL_PICTURE"],
        array("width" => 100, "height" => 100),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] = $resize["src"];
} else {
    $resize = CFIle::ResizeImageGet(
        $arResult["PREVIEW_PICTURE"],
        array("width" => 700, "height" => 700),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["DETAIL_PICTURE"]["BIG"]["SRC"] = $resize["src"];
    $resize = CFIle::ResizeImageGet(
        $arResult["PREVIEW_PICTURE"],
        array("width" => 500, "height" => 500),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["DETAIL_PICTURE"]["SMALL"]["SRC"] = $resize["src"];
}


foreach ($arResult["PROPERTIES"]["U_MORE_FOTO"]["VALUE"] as $key => $image) {
    $resize = CFIle::ResizeImageGet(
        $image,
        array("width" => 700, "height" => 700),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["PROPERTIES"]["U_MORE_FOTO"]["BIG"][$key] = $resize["src"];

    $resize = CFIle::ResizeImageGet(
        $image,
        array("width" => 100, "height" => 100),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        false
    );
    $arResult["PROPERTIES"]["U_MORE_FOTO"]["SMALL"][$key] = $resize["src"];
}