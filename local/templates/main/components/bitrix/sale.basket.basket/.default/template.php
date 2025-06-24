<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load(["ui.fonts.ruble", "ui.fonts.opensans"]);

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	// if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	// {
	// 	$arParams['TEMPLATE_THEME'] = 'blue';
	// }
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
	$arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

	CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',
		'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'] ?? '',
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'] ?? '',
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'] ?? '',

		'DETAIL_URL' => $arParams['GIFTS_DETAIL_URL'] ?? null,
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'] ?? '',
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'] ?? '',
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'] ?? '',
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'] ?? '',
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'] ?? '',
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'] ?? '',
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'] ?? '',
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'] ?? '',
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'] ?? '',

		'PRODUCT_ROW_VARIANTS' => '',
		'PAGE_ELEMENT_COUNT' => 0,
		'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
			SaleProductsGiftBasketComponent::predictRowVariants(
				$arParams['GIFTS_PAGE_ELEMENT_COUNT'],
				$arParams['GIFTS_PAGE_ELEMENT_COUNT']
			)
		),
		'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

		'ADD_TO_BASKET_ACTION' => 'BUY',
		'PRODUCT_DISPLAY_MODE' => 'Y',
		'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
		'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
		'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

		'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
		'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
		'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
	);
}

\CJSCore::Init(array('fx', 'popup', 'ajax'));
Main\UI\Extension::load(['ui.mustache']);

// $this->addExternalCss('/bitrix/css/main/bootstrap.css');
// $this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');

/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

?>


 
<?
$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';


// echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";
if (empty($arResult['ERROR_MESSAGE']))
{
	
	if (empty($arResult["ITEMS"]["AnDelCanBuy"]))
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}else
{
?>
<!-- <div class="cart">
		<div class="cart__title cart__basket1">
			<div class="cart__title__icon active"><svg>
					<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-cart"></use>
				</svg></div>
			<div class="cart__title__text d-none d-lg-block">Ваша корзина</div>
			<div class="cart__title__line"></div>
			<div class="cart__title__icon"><svg>
					<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-cart-check"></use>
				</svg></div>
			<div class="cart__title__text d-none d-lg-block">Заявка отправлена</div>
		</div>		

		<div class="cart__body row	">
		
		<div class="col-12 col-lg-8"> -->

		<div class="cart row">
                    <div class="col-12 col-lg-8">
                        <div class="cart__body"><!-- cart controls-->
                            <div class="cart__controls">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-12 col-md"><label class="form__check"><input type="checkbox" checked="checked" /><span>Выбрать все</span></label></div>
                                    <div class="col-12 col-md-auto"><button class="form__clear">Удалить выбранные</button></div>
                                </div>
                            </div>


<?



	if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'TOP')
	{
		?>
		
		<div data-entity="parent-container">
			<div class="catalog-block-header"
					data-entity="header"
					data-showed="false"
					style="display: none; opacity: 0;">
				<?=$arParams['GIFTS_BLOCK_TITLE']?>
			</div>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:sale.products.gift.basket',
				'.default',
				$giftParameters,
				$component
			);
			?>
		</div>
		<?
	}

	if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED'])
	{
		?>
		<div id="basket-item-message">
			<?=Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET']))?>
		</div>
		<?
	}
	?>
	
	<div id="basket-root" class="bx-basket bx-<?=$arParams['TEMPLATE_THEME']?> bx-step-opacity" style="opacity: 0;">
	



		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-warning alert-dismissable" id="basket-warning" style="display: none;">
					<span class="close" data-entity="basket-items-warning-notification-close">&times;</span>
					<div data-entity="basket-general-warnings"></div>
					<div data-entity="basket-item-warnings">
						<?=Loc::getMessage('SBB_BASKET_ITEM_WARNING')?>
					</div>
				</div>
			</div>
		</div>


		<div class="cart__table__item">
                                    <div class="cart__card">
                                        <div class="cart__card__check"><label class="form__check form__check__solo"><input type="checkbox" checked="checked" /><span></span></label></div>
                                        <div class="cart__card__forimg"><a class="cart__card__img" href="#"><img src="img/catalog/img-catalog-12.jpg" alt="" /></a></div>
                                        <div class="cart__card__body">
                                            <div class="cart__card__content">
                                                <div class="cart__card__article">Артикул: 18954887</div>
                                                <div class="cart__card__category">Инструменты</div><a class="cart__card__title" href="#">Иглодержатель Castroviejo прямой, 140 мм/180 мм</a>
                                                <div class="cart__card__storage"><i><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M21.5 16C21.78 16 22 16.22 22 16.5V17.5C22 19.16 20.66 20.5 19 20.5C19 18.85 17.65 17.5 16 17.5C14.35 17.5 13 18.85 13 20.5H11C11 18.85 9.65 17.5 8 17.5C6.35 17.5 5 18.85 5 20.5C3.34 20.5 2 19.16 2 17.5V15.5C2 14.95 2.45 14.5 3 14.5H12.5C13.88 14.5 15 13.38 15 12V6.5C15 5.95 15.45 5.5 16 5.5H16.84C17.56 5.5 18.22 5.89 18.58 6.51L19.22 7.63C19.31 7.79 19.19 8 19 8C17.62 8 16.5 9.12 16.5 10.5V13.5C16.5 14.88 17.62 16 19 16H21.5Z" fill="#7614DF" />
                                                            <path d="M8 22.5C9.10457 22.5 10 21.6046 10 20.5C10 19.3954 9.10457 18.5 8 18.5C6.89543 18.5 6 19.3954 6 20.5C6 21.6046 6.89543 22.5 8 22.5Z" fill="#7614DF" />
                                                            <path d="M16 22.5C17.1046 22.5 18 21.6046 18 20.5C18 19.3954 17.1046 18.5 16 18.5C14.8954 18.5 14 19.3954 14 20.5C14 21.6046 14.8954 22.5 16 22.5Z" fill="#7614DF" />
                                                            <path d="M22 13.03V14.5H19C18.45 14.5 18 14.05 18 13.5V10.5C18 9.95 18.45 9.5 19 9.5H20.29L21.74 12.04C21.91 12.34 22 12.68 22 13.03Z" fill="#7614DF" />
                                                            <path d="M13.08 2.5H5.69C3.65 2.5 2 4.15 2 6.19V12.58C2 13.13 2.45 13.58 3 13.58H12.15C13.17 13.58 14 12.75 14 11.73V3.42C14 2.91 13.59 2.5 13.08 2.5ZM9.38 8.41C9.38 8.67 9.24 8.92 9.02 9.05L7.77 9.8C7.64 9.88 7.51 9.91 7.38 9.91C7.13 9.91 6.88 9.78 6.74 9.55C6.52 9.19 6.64 8.73 6.99 8.52L7.88 7.99V6.91C7.88 6.5 8.22 6.16 8.63 6.16C9.04 6.16 9.38 6.5 9.38 6.91V8.41Z" fill="#7614DF" />
                                                        </svg>
                                                    </i><span>Товар под заказ</span></div>
                                            </div>
                                            <div class="cart__card__footer">
                                                <div class="row flex-nowrap align-items-center">
                                                    <div class="cart__card__footer__price col d-xl-none">
                                                        <div class="cart__card__cost">
                                                            <div class="cart__card__price">1 600 300 ₽</div>
                                                            <div class="cart__card__oldprice">3 000 000 ₽</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="inputcount js--inputcount">
                                                            <div class="inputcount__btn minus js--inputcount-minus"><i><svg>
                                                                        <use xlink:href="img/icons.svg#ic-minus"></use>
                                                                    </svg></i></div>
                                                            <div class="inputcount__btn plus js--inputcount-plus"><i><svg>
                                                                        <use xlink:href="img/icons.svg#ic-plus"></use>
                                                                    </svg></i></div><input class="inputcount__input js--inputcount-input" type="number" name="#" min="1" max="5" value="1" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cart__card__aside d-none d-xl-block">
                                            <div class="cart__card__cost">
                                                <div class="cart__card__price">1 600 300 ₽</div>
                                                <div class="cart__card__oldprice">3 000 000 ₽</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
          
								
							<div class="cart__table__item" id="basket-item-table"></div>
						
	
		<?
		if (
			$arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
			&& in_array('bottom', $arParams['TOTAL_BLOCK_DISPLAY'])
		)
		{
			?>
			<div class="col-12 col-lg-4 row">
				<div class="col-xs-12" data-entity="basket-total-block"></div>
			</div>
			<?
		}
		?>
		
	</div>
	<!-- /el-->

	<?
		if (
			$arParams['BASKET_WITH_ORDER_INTEGRATION'] !== 'Y'
			&& in_array('top', $arParams['TOTAL_BLOCK_DISPLAY'])
		)
		{
			?>
			<div class="col-12 col-lg-4  row">
				<div class="col-xs-12" data-entity="basket-total-block"></div>
			</div>
			<?
		}
		?>

	<!-- </div>
	</div> -->
	<?
	if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency'))
	{
		CJSCore::Init('currency');

		?>
		<script>
			BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)?>);
		</script>
		<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.BasketComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult, false, false, true)?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			template: '<?=CUtil::JSEscape($signedTemplate)?>',
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
			siteTemplateId: '<?=CUtil::JSEscape($component->getSiteTemplateId())?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>'
		});
	</script>
	<?
	if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'BOTTOM')
	{
		?>
		<div data-entity="parent-container">
			<div class="catalog-block-header"
					data-entity="header"
					data-showed="false"
					style="display: none; opacity: 0;">
				<?=$arParams['GIFTS_BLOCK_TITLE']?>
			</div>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:sale.products.gift.basket',
				'.default',
				$giftParameters,
				$component
			);
			?>
		</div>
		</div>
		<?
	}

	?>	
	<?$APPLICATION->IncludeComponent(
	"opensource:order", 
	".default", 
	array(
		"DEFAULT_DELIVERY_ID" => "3",
		"DEFAULT_PAY_SYSTEM_ID" => "2",
		"DEFAULT_PERSON_TYPE_ID" => "1",
		"PATH_TO_BASKET" => "/personal/cart/",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
	</div>
	</div>

	<div class="col-12 col-lg-4">
                                <div class="cart__blocksumm cart__basket1">
								<?$APPLICATION->IncludeComponent(
									"bitrix:sale.basket.basket.line", 
									"cart", 
									array(
										"HIDE_ON_BASKET_PAGES" => "N",
										"PATH_TO_AUTHORIZE" => "",
										"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
										"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
										"PATH_TO_PERSONAL" => SITE_DIR."personal/",
										"PATH_TO_PROFILE" => SITE_DIR."personal/",
										"PATH_TO_REGISTER" => SITE_DIR."login/",
										"POSITION_FIXED" => "Y",
										"POSITION_HORIZONTAL" => "right",
										"POSITION_VERTICAL" => "top",
										"SHOW_AUTHOR" => "N",
										"SHOW_EMPTY_VALUES" => "Y",
										"SHOW_NUM_PRODUCTS" => "Y",
										"SHOW_PERSONAL_LINK" => "N",
										"SHOW_PRODUCTS" => "N",
										"SHOW_REGISTRATION" => "N",
										"SHOW_TOTAL_PRICE" => "Y",
										"COMPONENT_TEMPLATE" => "cart"
									),
									false
								);?>
                                    
                                    <div class="cart__blocksumm__footer"> <button class="mbtn mbtn__big mbtn__primary d-block w-100"  onclick="$('#submit').click();">Оформить заказ</button></div>
                                </div>
								
                            </div>

	</div>
	</div>
</div>
	
	
	
	<?
}}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}
?>
