<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Loader;

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;

if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateFolder.'/themes/'.$templateData['TEMPLATE_THEME'].'/style.css');
	$APPLICATION->SetAdditionalCSS('/bitrix/css/main/themes/'.$templateData['TEMPLATE_THEME'].'/style.css', true);
}

if (!empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;

	if (!empty($templateData['CURRENCIES']))
	{
		$loadCurrency = Loader::includeModule('currency');
	}

	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency)
	{
		?>
		<script>
			BX.Currency.setCurrencies(<?=$templateData['CURRENCIES']?>);
		</script>
		<?php
	}
}

if (isset($templateData['JS_OBJ']))
{
	?>
	<script>
		BX.ready(BX.defer(function(){
			if (!!window.<?=$templateData['JS_OBJ']?>)
			{
				window.<?=$templateData['JS_OBJ']?>.allowViewedCount(true);
			}
		}));
	</script>
	<?php
	// check compared state
	if ($arParams['DISPLAY_COMPARE'])
	{
		$compared = false;
		$comparedIds = array();
		$item = $templateData['ITEM'];

		if (!empty($_SESSION[$arParams['COMPARE_NAME']][$item['IBLOCK_ID']]))
		{
			if (!empty($item['JS_OFFERS']) && is_array($item['JS_OFFERS']))
			{
				foreach ($item['JS_OFFERS'] as $key => $offer)
				{
					if (array_key_exists($offer['ID'], $_SESSION[$arParams['COMPARE_NAME']][$item['IBLOCK_ID']]['ITEMS']))
					{
						if ($key == $item['OFFERS_SELECTED'])
						{
							$compared = true;
						}

						$comparedIds[] = $offer['ID'];
					}
				}
			}
			elseif (array_key_exists($item['ID'], $_SESSION[$arParams['COMPARE_NAME']][$item['IBLOCK_ID']]['ITEMS']))
			{
				$compared = true;
			}
		}

		if ($templateData['JS_OBJ'])
		{
			?>
			<script>
				BX.ready(BX.defer(function(){
					if (!!window.<?=$templateData['JS_OBJ']?>)
					{
						window.<?=$templateData['JS_OBJ']?>.setCompared('<?=$compared?>');

						<?php
						if (!empty($comparedIds)):
						?>
						window.<?=$templateData['JS_OBJ']?>.setCompareInfo(<?=CUtil::PhpToJSObject($comparedIds, false, true)?>);
						<?php
						endif;
						?>
					}
				}));
			</script>
			<?php
		}
	}

	// select target offer
	$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
	$offerNum = false;
	$offerId = (int)$this->request->get('OFFER_ID');
	$offerCode = $this->request->get('OFFER_CODE');

	if ($offerId > 0 && !empty($templateData['OFFER_IDS']) && is_array($templateData['OFFER_IDS']))
	{
		$offerNum = array_search($offerId, $templateData['OFFER_IDS']);
	}
	elseif (!empty($offerCode) && !empty($templateData['OFFER_CODES']) && is_array($templateData['OFFER_CODES']))
	{
		$offerNum = array_search($offerCode, $templateData['OFFER_CODES']);
	}

	if (!empty($offerNum))
	{
		?>
		<script>
			BX.ready(function(){
				if (!!window.<?=$templateData['JS_OBJ']?>)
				{
					window.<?=$templateData['JS_OBJ']?>.setOffer(<?=$offerNum?>);
				}
			});
		</script>
		<?php
	}
}

			$GLOBALS['arrFilter'] = array("!ID"=>$arParams["ELEMENT_ID"]);
            $APPLICATION->IncludeComponent(
	            "bitrix:catalog.section",
	            "main",
	            array(
		            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
		            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
		            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
		            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
		            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		            "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		            "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		            "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		            "BASKET_URL" => $arParams["BASKET_URL"],
		            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		            "FILTER_NAME" => "arrFilter",
		            "CACHE_TYPE" => "N", // breadcrumb 
		            "CACHE_TIME" => $arParams["CACHE_TIME"],
		            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
		            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		            "SET_TITLE" => $arParams["SET_TITLE"],
		            "MESSAGE_404" => $arParams["MESSAGE_404"],
		            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
		            "SHOW_404" => $arParams["SHOW_404"],
		            "FILE_404" => $arParams["FILE_404"],
		            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		            "PAGE_ELEMENT_COUNT" => 4,
		            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		            "PRICE_CODE" => $arParams["PRICE_CODE"],
		            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		            
		            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
		            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
		            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
		            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
		            
		            
		            // "SECTION_ID" => $arResult["SECTION"]["ID"],
					// "SECTION_ID" => array_pop($ar_new_groups2),
		            // "SECTION_CODE" => $arParams["SECTION_CODE"],
		            "ADD_SECTIONS_CHAIN" => "N",
                    "TITLE" => "Похожие товары",
		            "DISPLAY_BOTTOM_PAGER" => "N"
	            ),
            );
