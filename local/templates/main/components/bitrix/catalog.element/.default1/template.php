<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
// $this->addExternalCss('/bitrix/css/main/bootstrap.css');

$templateLibrary = array('popup', 'fx', 'ui.fonts.opensans');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => [
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	],
];
if ($haveOffers)
{
	$templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
	$templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DESCRIPTION_ID' => $mainId.'_description',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);







$res = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
if($ar_res = $res->GetNext())
	$sect_NAME = $ar_res['NAME'];

$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];
	// $name =$sect_NAME." ".$marka_NAME." ".$name;

if ($haveOffers)
{
	$actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y')
{
	$skuDescription = false;
	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '')
		{
			$skuDescription = true;
			break;
		}
	}
	$showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
else
{
	$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);
$productType = $arResult['PRODUCT']['TYPE'];

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');

if ($arResult['MODULES']['catalog'] && $arResult['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE)
{
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE')
	;
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE')
	;
}
else
{
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE')
	;
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE')
	;
}

$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>
<h1 class="h1"><?= $arResult["NAME"]?></h1>
<div class="product bx-catalog-element bx-<?=$arParams['TEMPLATE_THEME']?>" id="<?=$itemIds['ID']?>"
	itemscope itemtype="http://schema.org/Product">
	
	<!-- <div class="container-fluid"> -->
		<!-- <?php
		if ($arParams['DISPLAY_NAME'] === 'Y')
		{
			?>
			<div class="h1"><?=$name?></div>
			<?php
		}
		?> -->




                <!-- <div class="product">product body -->
                    <div class="product__body card">
                        <div class="product__pics">
                            <div class="product__images">
                                <div class="product__images__slider swiper js--primages">
                                    <div class="swiper-wrapper">
										<?$a=0;
										foreach ($arResult["PROPERTIES"]["U_MORE_FOTO"]["BIG"] as $img){$a++;?>
                                        	<div class="product__images__slider__item swiper-slide">
												<a class="product__images__link" href="<?=$img?>" data-fancybox="pr-gallery">
													<img src="<?=$img?>" alt="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["U_ARTICLE"]["VALUE"]?>  купить рис. <?=$a?>" title="<?=$arResult["NAME"]?> арт. <?=$arResult["PROPERTIES"]["U_ARTICLE"]["VALUE"]?>  рис. <?=$a?>" />
												</a>
											</div>
                                       	<?}?>
                                    </div>
                                </div>
                            </div>
                            <div class="product__thumbs">
                                <div class="product__thumbs__slider swiper js--primages-thumbs">
                                    <div class="swiper-wrapper">
										<?foreach ($arResult["PROPERTIES"]["U_MORE_FOTO"]["SMALL"] as $img){?>
											<div class="product__thumbs__slider__item swiper-slide js--primages-thumbs-link">
												<div class="product__thumbs__link"><img src="<?=$img?>" alt="" /></div>
											</div>
										<?}?>
                                    </div>
                                </div>
                                <div class="product__pics__controls">
                                    <div class="stslider__nav">
                                        <div class="stslider__nav__btn js--primages-prev"><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-prev"></use>
                                            </svg></div>
                                        <div class="stslider__nav__btn js--primages-next"><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-next"></use>
                                            </svg></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product__tabs">
                            <div class="product__tabs__nav js--tabs-nav">
                                <div class="product__tabs__nav__link js--tabs-link active" data-tab="tab__0">Описание</div>
                                <div class="product__tabs__nav__link js--tabs-link" data-tab="tab__1">Как купить</div>
                                <div class="product__tabs__nav__link js--tabs-link" data-tab="tab__2">Документы</div>
                            </div>
                            <div class="product__tabs__slide">
                                <div class="product__tabs__slide__item js--tabs-item active" id="tab__0">
                                    <div class="product__tabs__body">
                                        <div class="product__tabs__item">
                                            <div class="block__text">
											<?=$arResult["DETAIL_TEXT"]?>
                                                <!-- <p>Предназначены для проведения хирургических манипуляций в пародонтальной хирургии и имплантологии: для разрезания мягких тканей и шовного материала.</p> -->
                                            </div>
                                        </div>
                                        <div class="product__tabs__item">
                                            <h2 class="h2">Характеристики</h2>
											<?if(count($arResult["DISPLAY_PROPERTIES"])>0){?>
												<ul class="product__tabs__list">
													<?foreach ($arResult["DISPLAY_PROPERTIES"] as $prop):?>
														<li>
															<span class="product__tabs__list__label"><?=$prop["NAME"]?>:</span>
															<span class="product__tabs__list__text"><?=$prop["DISPLAY_VALUE"]?></span>
														</li>
													<?endforeach;?>
												</ul>
											<?}?>
                                              
                                        </div>
                                        <!-- <div class="product__tabs__item">
                                            <h2 class="h2">В наличии на складе</h2>
                                            <ul class="product__tabs__list">
                                                <li><span class="product__tabs__list__label">Склад:</span><span class="product__tabs__list__text">Название склада</span></li>
                                                <li><span class="product__tabs__list__label">График работы:</span><span class="product__tabs__list__text">Пн-Пт с 9:00 до 20:00, Сб-Вс с 11:00 до 18:00</span></li>
                                                <li><span class="product__tabs__list__label">Остаток:</span><span class="product__tabs__list__text">7</span></li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="product__tabs__slide__item js--tabs-item" id="tab__1">
                                    <div class="product__tabs__body">
                                        <div class="product__tabs__item">
                                            <div class="block__text">
                                                <p>Доставка производится ежедневно с понедельника по пятницу, с 10:00 до 19:00 по московскому времени. Желательное время и день доставки Вы можете согласовать с оператором, когда он свяжется с Вами после оформления заказа. Обычно доставка производится в течение суток с момента заказа.</p>
                                                <p>Если необходима доставка в иное время, направьте запрос менеджеру, и мы постараемся сделать всё возможное для выполнения Вашего запроса.</p>
                                                <p>Для того, чтобы узнать подробнее о доставке и оплате, нажмите на кнопку «Перейти».</p>
                                            </div>
                                            <!-- <div class="product__tabs__more"><a class="mbtn mbtn__primary mbtn__big" href="#">Перейти</a></div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="product__tabs__slide__item js--tabs-item" id="tab__2">
                                    <div class="product__tabs__body">
                                        <div class="product__tabs__item">
                                            <ul class="product__tabs__docs">
                                                <li><a class="mbtn mbtn__bordered mbtn__wicon mbtn__big" href="#" download="filename"><span class="mbtn__wicon__body"><span>Декларация продукта</span><i><svg>
                                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-download"></use>
                                                                </svg></i></span></a></li>
                                                <li><a class="mbtn mbtn__bordered mbtn__wicon mbtn__big" href="#" download="filename"><span class="mbtn__wicon__body"><span>Инструкция</span><i><svg>
                                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-download"></use>
                                                                </svg></i></span></a></li>
                                                <li><a class="mbtn mbtn__bordered mbtn__wicon mbtn__big" href="#" download="filename"><span class="mbtn__wicon__body"><span>Декларация продукта</span><i><svg>
                                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-download"></use>
                                                                </svg></i></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /product body--><!-- product side-->
                    <div class="product__side">
                        <div class="product__info js--productside">
                            <div class="product__wrap1">
                                <div class="row flex-nowrap">
                                    <div class="col">
                                        <div class="product__pricetag">
                                            <div class="product__pricetag__label">Цена покупки:</div>
                                            <div class="row">
											<?if($price["RATIO_BASE_PRICE"]>$price["RATIO_PRICE"]){?>
                                                <div class="col-auto">
                                                    <div class="product__pricetag__old"><?=$price["PRINT_RATIO_BASE_PRICE"]?></div>
                                                </div>
												<?}?>
                                                <div class="col-auto">
                                                    <div class="product__pricetag__current" id="<?=$itemIds['PRICE_ID']?>"><?echo($price['PRINT_RATIO_PRICE']);?></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-auto"><a class="product__brand" href="#"><img src="img/product/img-brand-0.png" alt="" /></a></div> -->
                                </div>
                            </div>
                            <div class="product__wrap1">
                                <ul class="product__destop">
                                    <li>Код: <?=$arResult["PROPERTIES"]["U_CODE"]["VALUE"]?></li>
                                    <li>Артикул: <?=$arResult["PROPERTIES"]["U_ARTICLE"]["VALUE"]?></li>
                                    <li>Производитель: <?=$arResult["PROPERTIES"]["U_BRAND"]["VALUE"]?></li>
                                    <li>Страна: <?=$arResult["PROPERTIES"]["U_CONTRY"]["VALUE"]?></li>
									
									<?if($arResult["PROPERTIES"]["U_AVALIABLE"]["VALUE"]=="под заказ"){?>
                                    <li>
                                        <div class="cart__card__storage"><i><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M21.5 16C21.78 16 22 16.22 22 16.5V17.5C22 19.16 20.66 20.5 19 20.5C19 18.85 17.65 17.5 16 17.5C14.35 17.5 13 18.85 13 20.5H11C11 18.85 9.65 17.5 8 17.5C6.35 17.5 5 18.85 5 20.5C3.34 20.5 2 19.16 2 17.5V15.5C2 14.95 2.45 14.5 3 14.5H12.5C13.88 14.5 15 13.38 15 12V6.5C15 5.95 15.45 5.5 16 5.5H16.84C17.56 5.5 18.22 5.89 18.58 6.51L19.22 7.63C19.31 7.79 19.19 8 19 8C17.62 8 16.5 9.12 16.5 10.5V13.5C16.5 14.88 17.62 16 19 16H21.5Z" fill="#7614DF" />
                                                    <path d="M8 22.5C9.10457 22.5 10 21.6046 10 20.5C10 19.3954 9.10457 18.5 8 18.5C6.89543 18.5 6 19.3954 6 20.5C6 21.6046 6.89543 22.5 8 22.5Z" fill="#7614DF" />
                                                    <path d="M16 22.5C17.1046 22.5 18 21.6046 18 20.5C18 19.3954 17.1046 18.5 16 18.5C14.8954 18.5 14 19.3954 14 20.5C14 21.6046 14.8954 22.5 16 22.5Z" fill="#7614DF" />
                                                    <path d="M22 13.03V14.5H19C18.45 14.5 18 14.05 18 13.5V10.5C18 9.95 18.45 9.5 19 9.5H20.29L21.74 12.04C21.91 12.34 22 12.68 22 13.03Z" fill="#7614DF" />
                                                    <path d="M13.08 2.5H5.69C3.65 2.5 2 4.15 2 6.19V12.58C2 13.13 2.45 13.58 3 13.58H12.15C13.17 13.58 14 12.75 14 11.73V3.42C14 2.91 13.59 2.5 13.08 2.5ZM9.38 8.41C9.38 8.67 9.24 8.92 9.02 9.05L7.77 9.8C7.64 9.88 7.51 9.91 7.38 9.91C7.13 9.91 6.88 9.78 6.74 9.55C6.52 9.19 6.64 8.73 6.99 8.52L7.88 7.99V6.91C7.88 6.5 8.22 6.16 8.63 6.16C9.04 6.16 9.38 6.5 9.38 6.91V8.41Z" fill="#7614DF" />
                                                </svg>
                                            </i><span>Товар под заказ</span></div>
                                    </li>
									<?}else{?>
                                    <li>
                                        <div class="cart__card__storage"><i><svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect y="0.5" width="24" height="24" rx="12" fill="#DF1477" />
                                                    <path d="M5 12.1818L10.2 17.5L19 8.5" stroke="#FCFCFC" stroke-width="2" stroke-linecap="round" />
                                                </svg>
                                            </i><span>Товар в наличии</span></div>
                                    </li>
									<?}?>
                                </ul>
                            </div>
                            <div class="product__tobuy">


						

                                <!-- <div class="card__footer row">
                                    <div class="col-12 col-md-6 col-lg-auto ">
                                        <div class="inputcount__wrap" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-content="На складе всего <?=$arResult["CATALOG_QUANTITY"]?> штук">
                                            <div class="inputcount inputcount__big js--inputcount">
                                                <div class="inputcount__btn  inputcount__btn__left  minus js--inputcount-minus" id="<?=$itemIds['QUANTITY_DOWN_ID']?>"><i><svg>
                                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-minus" ></use>
                                                        </svg></i></div>
                                                <div class="inputcount__btn plus inputcount__btn__right js--inputcount-plus"  id="<?=$itemIds['QUANTITY_UP_ID']?>"><i><svg>
                                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-plus"></use>
                                                        </svg></i></div>
														
														<input class="inputcount__input js--inputcount-input" id="<?=$itemIds['QUANTITY_ID']?>" type="number" min="0" max="<?=$arResult["CATALOG_QUANTITY"]?>" value="<?=$price['MIN_QUANTITY']?>">
														
                                            </div>
                                        </div>
                                    </div>
									<div id="<?=$itemIds['BASKET_ACTIONS_ID']?>" class="col-12 col-md-6 col-lg"><button id="<?=$itemIds['ADD_BASKET_LINK']?>" class="mbtn  mbtn__big mbtn__primary mbtn__middle d-block w-100" type="button">В корзину</button></div>
                                    
                                </div> -->
                            </div>
                            <!-- <div class="product__tobuy">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-auto">
                                        <div class="inputcount__wrap" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-content="На складе всего 7 штук">
                                            <div class="inputcount inputcount__big js--inputcount">
                                                <div class="inputcount__btn minus js--inputcount-minus"><i><svg>
                                                            <use xlink:href="img/icons.svg#ic-minus"></use>
                                                        </svg></i></div>
                                                <div class="inputcount__btn plus js--inputcount-plus"><i><svg>
                                                            <use xlink:href="img/icons.svg#ic-plus"></use>
                                                        </svg></i></div><input class="inputcount__input js--inputcount-input" type="number" name="#" min="0" max="5" value="3" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg"><button class="mbtn mbtn__primary mbtn__middle mbtn__active d-block w-100" type="button">В корзине</button></div>
                                </div>
                            </div> -->


							<div class="col-12 col-lg-6 col-xxl-7">
				<div class="card__des">
				
					<div class="card__article">Артикул: <?=$arResult["PROPERTIES"]["U_CODE"]["VALUE"]?></div>
					<div class="product-item-detail-slider-container"  id="<?=$itemIds['BIG_SLIDER_ID']?>">
					
					<div class="product-item-detail-slider-images-container" data-entity="images-container"></div>


					<div class="card__prices row align-items-center product-item-detail-info-container">
						<div class="col-auto" >
							<div class="card__prices__now product-item-detail-price-current" id="<?=$itemIds['PRICE_ID']?>"><?echo($price['PRINT_RATIO_PRICE']);?></div>
						</div>
						<?if($price["RATIO_BASE_PRICE"]>$price["RATIO_PRICE"]){?>
							<div class="col-auto">
								<div class="card__prices__old"><?=$price["PRINT_RATIO_BASE_PRICE"]?></div>
							</div>
						<?}?>
					</div>
					<div class="card__storage">На складе <?=$arResult["CATALOG_QUANTITY"]?> шт.</div>

					<div class="card__footer row">
						
						<div class="col-12 col-lg-5">
							<div class="inputcount js--inputcount">
								<div class="inputcount__btn inputcount__btn__left js--inputcount-minus" id="<?=$itemIds['QUANTITY_DOWN_ID']?>">
									<svg>
										<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-minus"></use>
									</svg>
								</div>
								<div class="inputcount__btn inputcount__btn__right js--inputcount-plus" id="<?=$itemIds['QUANTITY_UP_ID']?>">
									<svg>
										<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-plus"></use>
									</svg>
								</div>
								<input class="inputcount__input js--inputcount-input" id="<?=$itemIds['QUANTITY_ID']?>" type="number" value="<?=$price['MIN_QUANTITY']?>">
							</div>
						</div>
						<div id="<?=$itemIds['BASKET_ACTIONS_ID']?>" class="col-12 col-lg-7"><button id="<?=$itemIds['ADD_BASKET_LINK']?>" class="mbtn mbtn__big mbtn__primary d-block w-100" type="button">В корзину</button></div>
					</div>

				</div>


				
	
				<!-- </div> -->
			</div>	

			
		</div>


                        </div>
                    </div><!-- /product side-->
                </div>





	<meta itemprop="name" content="<?=$name?>" />
	<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />

		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="price" content="<?=$price['RATIO_PRICE']?>" />
			<meta itemprop="priceCurrency" content="<?=$price['CURRENCY']?>" />
			<link itemprop="availability" href="http://schema.org/<?=($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
		</span>
<!-- </div> -->
<?php
if (!$haveOffers)
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties)
	{
		?>
		<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
			<?php
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
			{
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo)
				{
					?>
					<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]" value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
					<?php
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties)
			{
				?>
				<table>
					<?php
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo)
					{
						?>
						<tr>
							<td><?=$arResult['PROPERTIES'][$propId]['NAME']?></td>
							<td>
								<?php
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								)
								{
									foreach ($propInfo['VALUES'] as $valueId => $value)
									{
										?>
										<label>
											<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]"
												value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? 'checked' : '')?>>
											<?=$value?>
										</label>
										<br>
										<?php
									}
								}
								else
								{
									?>
									<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]">
										<?php
										foreach ($propInfo['VALUES'] as $valueId => $value)
										{
											?>
											<option value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? 'selected' : '')?>>
												<?=$value?>
											</option>
											<?php
										}
										?>
									</select>
									<?php
								}
								?>
							</td>
						</tr>
						<?php
					}
					?>
				</table>
				<?php
			}
			?>
		</div>
		<?php
	}

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'VISUAL' => $itemIds,
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'PICT' => reset($arResult['MORE_PHOTO']),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
			'ITEM_PRICES' => $arResult['ITEM_PRICES'],
			'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
			'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
			'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
			'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
			'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
			'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
			'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		)
	);
	unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE'])
{
	$jsParams['COMPARE'] = array(
		'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
		'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
		'COMPARE_PATH' => $arParams['COMPARE_PATH']
	);
}

$jsParams["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"] =
	$arResult["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"]
;

?>
<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
		BTN_MESSAGE_DETAIL_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_DETAIL_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});

	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>
<?php
unset($actualItem, $itemIds, $jsParams);
