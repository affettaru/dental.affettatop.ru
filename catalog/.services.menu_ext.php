<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$obCache = new CPHPCache;
if ($obCache->InitCache(86400, "test")) {
    $vars = $obCache->GetVars();
    $services = $vars['services'];

} elseif ($obCache->StartDataCache()) {
    if (!CModule::IncludeModule("iblock")) return;
    // Получение свойств инфоблока
    $iblockId = 4;
    $dbRes = \Bitrix\Iblock\ElementTable::getList([
        'select'  => ['ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', "NAME", "CODE",  'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'],
        'filter'  => ["=IBLOCK_ID" => $iblockId],
        'order' => ['SORT' => 'ASC', "ID" => "ASC"],
        'limit' => 10,
        "cache" => ["ttl" => 3600],
    ]);
    $services = [];
    while ($serviceItem = $dbRes->Fetch()) {
        $serviceItem['DETAIL_PAGE_URL'] = CIBlock::ReplaceDetailUrl($serviceItem['DETAIL_PAGE_URL'], $serviceItem, false, 'E');
        $services[] = $serviceItem;
    }

    // Запись в кеш
    $obCache->EndDataCache(array(
        'services' => $services,
    ));
}

$aMenuLinksExt = [];
foreach ($services as $service){
    $aMenuLinksExt[] = [
        $service["NAME"],
        $service["DETAIL_PAGE_URL"],
        [],
        [],
        ""
    ];
}
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
