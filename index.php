<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Главная");
$APPLICATION->SetPageProperty("title", "Главная | LKDENTAL");
$APPLICATION->SetPageProperty("description", "Главная| LKDENTAL");
$APPLICATION->SetPageProperty("H1", "Главная");
?>
 
<section class="block__padd block__overflow block__padd__nofirst">
            <div class="container">
                <div class="welcome row">
                    <div class="col-12 col-lg-8 block__overflow">
                        <div class="welcome__slider swiper js--welcome">
                            <div class="swiper-wrapper"><!-- el-->
                           <?
                           
				$rs = CIBlockElement::GetList (
					Array(),
					Array("IBLOCK_ID" => 13),
					false,
					Array (), array("PROPERTY_U_BAN")
				);
				unset($elN);
                
				while($ar = $rs->GetNext()) {
					
					$elN[]=$ar;
				}?>
              
						<?  foreach ($elN as $DELIVERY){
							  unset($elD);
							$rsD = CIBlockElement::GetList (
								Array(),
								Array("IBLOCK_ID" => 14,"ID"=>$DELIVERY["PROPERTY_U_BAN_VALUE"]),
								false,
								Array (), array("NAME","PREVIEW_TEXT","PROPERTY_U_LINK","PROPERTY_U_LINK_TEXT","PROPERTY_U_F1_TEXT","PROPERTY_U_F1","PROPERTY_U_F2_TEXT","PROPERTY_U_F2","PREVIEW_PICTURE")
							);
							
							while($arD = $rsD->GetNext()) {
								
								$elD[]=$arD;
							}?>
                            
							<?  foreach ($elD as $DELIVERY2){?>
                                
                                <div class="welcome__slider__item swiper-slide">
                                    <div class="welcome__card">
                                        <div class="welcome__card__bg">
                                            <picture>
                                                <source media="(min-width: 992px)" srcset="<?=CFile::GetPath($DELIVERY2["PREVIEW_PICTURE"])?>" />
                                                <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($DELIVERY2["PREVIEW_PICTURE"])?>" /><img src="<?=CFile::GetPath($DELIVERY2["PREVIEW_PICTURE"])?>" alt="" />
                                            </picture>
                                        </div>
                                        <div class="welcome__card__content">
                                            <div class="welcome__card__body">
                                                <div class="welcome__card__title"><?=$DELIVERY2["NAME"]?></div>
                                                <div class="welcome__card__text"><?=$DELIVERY2["PREVIEW_TEXT"]?></div>
                                                <?if($DELIVERY2["PROPERTY_U_F1_VALUE"] || $DELIVERY2["PROPERTY_U_F2_VALUE"]){?>
                                                <div class="welcome__card__tags row">
                                                    <div class="col-auto">
                                                        <div class="welcome__card__tag">
                                                            <?if($DELIVERY2["PROPERTY_U_F1_VALUE"]){?>
                                                            <div class="welcome__card__tag__icon">
                                                                <img src="<?=CFile::GetPath($DELIVERY2["PROPERTY_U_F1_VALUE"])?>">
                                                            </div>
                                                            <div class="welcome__card__tag__body"><?=html_entity_decode($DELIVERY2["PROPERTY_U_F1_TEXT_VALUE"])?></div>
                                                            <?}?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                    <?if($DELIVERY2["PROPERTY_U_F2_VALUE"]){?>
                                                        <div class="welcome__card__tag">
                                                            <div class="welcome__card__tag__icon">
                                                            <img src="<?=CFile::GetPath($DELIVERY2["PROPERTY_U_F2_VALUE"])?>">
                                                            </div>
                                                            <div class="welcome__card__tag__body"><?=html_entity_decode($DELIVERY2["PROPERTY_U_F2_TEXT_VALUE"])?></div>
                                                            <?}?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?}?>
                                            </div>
                                            <div class="welcome__card__footer"><a class="mbtn mbtn__primary mbtn__middle" href="<?=$DELIVERY2["PROPERTY_U_LINK_VALUE"]?>"><?=$DELIVERY2["PROPERTY_U_LINK_TEXT_VALUE"]?></a></div>
                                        </div>
                                    </div>
                                </div>
                                <?}}?>
                            </div>
                            <div class="welcome__slider__nav">
                                <div class="welcome__slider__nav__btn prev js--welcome-prev"><span><svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2498_6343)">
                                                <path d="M2 7L8 13V9H15V5H8V1L2 7Z" fill="white" />
                                                <path d="M14.0002 7.99992H7.00016V10.5899L3.41016 6.99992L7.00016 3.41992V5.99992H14.0002V7.99992Z" fill="black" />
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_2498_6343" x="0.2" y="0.2" width="16.6" height="15.6" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="1" />
                                                    <feGaussianBlur stdDeviation="0.9" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.65 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2498_6343" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2498_6343" result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </span></div>
                                <div class="welcome__slider__nav__btn next js--welcome-next"><span><svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2498_6426)">
                                                <path d="M15 7L9 13V9H2V5H9V1L15 7Z" fill="white" />
                                                <path d="M2.99984 7.99992H9.99984V10.5899L13.5898 6.99992L9.99984 3.41992V5.99992H2.99984V7.99992Z" fill="black" />
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_2498_6426" x="0.2" y="0.2" width="16.6" height="15.6" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                                    <feOffset dy="1" />
                                                    <feGaussianBlur stdDeviation="0.9" />
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.65 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2498_6426" />
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2498_6426" result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </span></div>
                            </div>
                            <div class="welcome__slider__dotts js--welcome-pag"></div>
                        </div>
                    </div>
                    <?unset($el);
								$rs = CIBlockElement::GetList (
									Array(),
									Array("IBLOCK_ID" => 13),
									false,
									Array (), array("PROPERTY_U_BL1_TEXT","PROPERTY_U_BL1_IMG","PROPERTY_U_BL2_IMG","PROPERTY_U_BL2_LINK")
								);
								while($ar = $rs->GetNext()) {
									$el=$ar;
								}?>	
                            
                    <div class="col-12 col-lg-4">
                        <div class="welcome__imgside"><span class="welcome__imgside__title"><?=$el["PROPERTY_U_BL1_TEXT_VALUE"]?></span><span class="welcome__imgside__girl"><img src="<?=CFile::GetPath($el["PROPERTY_U_BL1_IMG_VALUE"])?>" alt="" /></span></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="block__padd block__overflow">
        <div class="container">
<?
// $GLOBALS['arrFilter'] = array("!ID"=>$arParams["ELEMENT_ID"]);
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"COUNT_ELEMENTS" => "20",
		"TOP_DEPTH" => "2",
		"CACHE_TYPE" => "A",
		"SHOW_ALL_WO_SECTION" => "Y",
		"CACHE_TIME" => "10000",
		"COMPONENT_TEMPLATE" => "news",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"ELEMENT_SORT_FIELD" => "created_date",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"PAGE_ELEMENT_COUNT" => "10",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE_MOBILE" => array(
		),
		"OFFERS_LIMIT" => "10",
		"BACKGROUND_IMAGE" => "-",
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"SHOW_SLIDER" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => array(
		),
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"DETAIL_URL" => "/product/#ELEMENT_CODE#/",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"DISPLAY_COMPARE" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Скидки",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"LAZY_LOAD" => "N",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"LOAD_ON_SCROLL" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"SEF_RULE" => "",
		"SECTION_CODE_PATH" => "",
        "TITLE" => "Скидки",
	),
	false
);?>
</div>
</section>
        <section class="block__padd">
            <div class="container">
                <div class="mainbanner"><a class="mainbanner__link" href="<?=$el["PROPERTY_U_BL2_LINK_VALUE"]?>"></a>
                    <picture>
                        <source media="(min-width: 992px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL2_IMG_VALUE"])?>" />
                        <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL2_IMG_VALUE"])?>" /><img src="<?=CFile::GetPath($el["PROPERTY_U_BL2_IMG_VALUE"])?>" alt="" />
                    </picture>
                </div>
            </div>
        </section><!-- /banner--><!-- catalog popuplar-->
        <section class="block__padd block__overflow">
        <div class="container">
<?
// $GLOBALS['arrFilter'] = array("!ID"=>$arParams["ELEMENT_ID"]);
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"COUNT_ELEMENTS" => "20",
		"TOP_DEPTH" => "2",
		"CACHE_TYPE" => "A",
		"SHOW_ALL_WO_SECTION" => "Y",
		"CACHE_TIME" => "10000",
		"COMPONENT_TEMPLATE" => "main",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"ELEMENT_SORT_FIELD" => "shows",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"PAGE_ELEMENT_COUNT" => "10",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE_MOBILE" => "",
		"OFFERS_LIMIT" => "10",
		"BACKGROUND_IMAGE" => "-",
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"SHOW_SLIDER" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => array(
		),
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"DETAIL_URL" => "/product/#ELEMENT_CODE#/",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"DISPLAY_COMPARE" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Скидки",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"LAZY_LOAD" => "N",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"LOAD_ON_SCROLL" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"SEF_RULE" => "",
		"SECTION_CODE_PATH" => "",
		"TITLE" => "Популярное"
	),
	false
);?>
</div>
</section>
<section class="block__padd block__overflow">
        <div class="container">
<?
// $GLOBALS['arrFilter'] = array("!ID"=>$arParams["ELEMENT_ID"]);
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"main", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"COUNT_ELEMENTS" => "20",
		"TOP_DEPTH" => "2",
		"CACHE_TYPE" => "A",
		"SHOW_ALL_WO_SECTION" => "Y",
		"CACHE_TIME" => "10000",
		"COMPONENT_TEMPLATE" => "news",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"ELEMENT_SORT_FIELD" => "created_date",
		"ELEMENT_SORT_ORDER" => "desc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"PAGE_ELEMENT_COUNT" => "10",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE_MOBILE" => array(
		),
		"OFFERS_LIMIT" => "10",
		"BACKGROUND_IMAGE" => "-",
		"TEMPLATE_THEME" => "blue",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"SHOW_SLIDER" => "Y",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => array(
		),
		"PRODUCT_SUBSCRIPTION" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"DETAIL_URL" => "/product/#ELEMENT_CODE#/",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"DISPLAY_COMPARE" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Скидки",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"LAZY_LOAD" => "N",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"LOAD_ON_SCROLL" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"SEF_RULE" => "",
		"SECTION_CODE_PATH" => "",
        "TITLE" => "Новинки",
	),
	false
);?>
</div>
</section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>