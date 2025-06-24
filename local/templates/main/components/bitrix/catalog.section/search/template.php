<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
$this->setFrameMode(true);

//echo "<pre>"; var_dump($arResult["NAV_RESULT"]->result->num_rows); echo "</pre>";
//echo "<pre>"; var_dump($arResult["NAV_RESULT"]->NavRecordCount); echo "</pre>";
//echo "<pre>"; var_dump($arResult); echo "</pre>";
//field_count
?>


<?php
if (!empty($arResult['ITEMS'])):?>

    <div class="pcatalog__title">
                    <div class="row">
                        <div class="col-12 block__overflow">
                            <h1 class="h1">По вашему запросу «<?= htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8'); ?>» было найдено <?= $arResult["SEARCH_COUNT"]  ?> единиц товара</h1>
                        </div>

                        <div class="col-12 d-xl-none"><a class="pcatalog__title__openfilter" href="#js--filter" data-fancybox-filter="data-fancybox-filter"><i><svg>
                                        <use xlink:href="img/icons.svg#ic-filter"></use>
                                    </svg></i><span>Фильтры</span></a></div>
                    </div>
    </div>
   
    <div class="pcatalog block__overflow">
                    <div class="pcatalog__side">
                        <div class="filter">
                            <div class="filter__body">
			 <?php
$APPLICATION->IncludeComponent(
   "bitrix:catalog.smart.filter",
   "",
   Array(
	   "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	   "CACHE_TIME" => $arParams["CACHE_TIME"],
	   "CACHE_TYPE" => $arParams["CACHE_TYPE"],
	   "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
	   "CURRENCY_ID" => $arParams['CURRENCY_ID'],
	   "FILTER_NAME" => $arParams["FILTER_NAME"],
	   "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
	   "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
	   "IBLOCK_ID" => 4,
	   "IBLOCK_TYPE" => "catalog",
	   "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
	   "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
	   "PRICE_CODE" => $arParams["~PRICE_CODE"],
	   "SAVE_IN_SESSION" => "N",
	   "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
	   "SECTION_DESCRIPTION" => "DESCRIPTION",
	   "SECTION_ID" => $arCurSection['ID'],
	   "SECTION_TITLE" => "NAME",
	   "SEF_MODE" => $arParams["SEF_MODE"],
	   "SEF_RULE" => "/search/filter/#SMART_FILTER_PATH#/apply/",
	   "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
	   "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
	   "XML_EXPORT" => "N"
   ),
$component,
Array(
   'HIDE_ICONS' => 'Y'
)
);

?>
</div>
                        </div>
                    </div>


                    <!-- <div class="pcatalog__content">
                        <div class="pcatalog__list row">
                            <div class="pcatalog__list__item col-12 col-sm-6 col-lg-4"> -->

                            <div class="pcatalog__content">
                    <div class="pcatalog__list row">
                    <?php foreach ($arResult["ITEMS"] as $arItem){?>
                        <div class="pcatalog__list__item col-12 col-sm-6 col-lg-4">
                        <div class="catalog__card gcard">
                        <div class="gcard__markers"><?if($price['PERCENT']){?><span class="sale">Скидка <?=$price['PERCENT']?>%</span><?}?><span class="preorder">Под заказ</span></div>
                    
                        <a class="gcard__img" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>"
                                data-entity="image-wrapper">
                                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : $arItem['DETAIL_PICTURE']['SRC'];?>" alt="<?= $arItem["NAME"] ?>" />
                                <a class="gcard__title" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
                                <div class="catalog__card__line row align-items-md-center gcard__price">
                                    <!-- <div class="col-12 col-md-auto"> -->
                                        <!-- <div class="catalog__card__price"><?=$arItem["ITEM_PRICES"][0]["PRINT_PRICE"]?></div>
                                    </div> -->
                                    <span class="current"><?=$arItem["ITEM_PRICES"][0]["PRINT_PRICE"]?></span>
                                    <?if($arItem["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]!=$arItem["ITEM_PRICES"][0]["PRINT_PRICE"] && !empty($arItem['ID'])){ ?>
                                        <!-- <div class="col-12 col-md-auto">
                                            <div class="catalog__card__oldprice"><?=$arItem["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]?></div>
                                        </div> -->
                                        <span class="old"><?=$arItem["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]?></span>
                                    <?}?>
                                </div>
                                <?
	if (!empty($arParams['PRODUCT_BLOCKS_ORDER']))
	{
		foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName)
		{
			switch ($blockName)
			{
				case 'price': ?>
					<div class="product-item-info-container product-item-price-container" style="display:none" data-entity="price-block">
						<?
						if ($arParams['SHOW_OLD_PRICE'] === 'Y')
						{
							?>
							<span class="product-item-price-old" id="<?=$arItemIds['PRICE_OLD']?>"
								<?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '')?>>
								<?=$price['PRINT_RATIO_BASE_PRICE']?>
							</span>&nbsp;
							<?
						}
						?>
						<span class="product-item-price-current" style="display:none" id="<?=$arItemIds['PRICE']?>">
							<?
							if (!empty($price))
							{
								if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
								{
									echo Loc::getMessage(
										'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
										array(
											'#PRICE#' => $price['PRINT_RATIO_PRICE'],
											'#VALUE#' => $measureRatio,
											'#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
										)
									);
								}
								else
								{
									echo $price['PRINT_RATIO_PRICE'];
								}
							}
							?>
						</span>
					</div>
					<?
					break;

				

				case 'quantity':
					if (!$haveOffers)
					{
						
							?>
							
							<div class="gcard__footer js--card-wrap">
                                        <div class="gcard__footer__countwrap">
                                            <div>
                                                <div class="inputcount__wrap" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-content="На складе всего <?=$arItem["PRODUCT"]["QUANTITY"];?> штук">
                                                    <div class="inputcount js--inputcount">
                                                        <div class="inputcount__btn minus js--inputcount-minus" id="<?=$arItemIds['QUANTITY_DOWN']?>"><i><svg>
                                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-minus"></use>
                                                                </svg></i>
															</div>
                                                        <div class="inputcount__btn plus js--inputcount-plus"  id="<?=$arItemIds['QUANTITY_UP']?>"><i><svg>
                                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-plus"></use>
                                                                </svg></i>
															</div>
															<input class="inputcount__input js--inputcount-input " id="<?=$arItemIds['QUANTITY']?>" type="number"  min="1" max="<?=$arItem["PRODUCT"]["QUANTITY"];?>" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
																value="<?=$measureRatio?>">
															<!-- <input class="inputcount__input js--inputcount-input" type="number" name="#" min="1" max="5" value="1" /> -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        


							<!-- <div class="gcard__footer js--card-wrap">
								<div class="gcard__footer__countwrap">
									<div>
										<div class="inputcount__wrap" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-content="На складе всего 7 штук">
											<div class="inputcount js--inputcount">
												<div class="inputcount__btn minus  inputcount__btn__left js--inputcount-minus" id="<?=$arItemIds['QUANTITY_DOWN']?>"><i>
													<svg>
														<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-minus"></use>
													</svg></i>
												</div>
												<div class="inputcount__btn plus inputcount__btn__right js--inputcount-plus" id="<?=$arItemIds['QUANTITY_UP']?>"><i>
													<svg>
														<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-plus"></use>
													</svg></i>
												</div>
												<input class="inputcount__input js--inputcount-input " id="<?=$arItemIds['QUANTITY']?>" type="number"  min="1" max="5" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
																value="<?=$measureRatio?>">
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<?
						
					}
					else
					{
						// if ($arParams['USE_PRODUCT_QUANTITY'])
						// {
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="quantity-block">
								<div class="product-item-amount">
									<div class="product-item-amount-field-container">
										<span class="product-item-amount-field-btn-minus no-select" id="<?=$arItemIds['QUANTITY_DOWN']?>"></span>
										<input class="product-item-amount-field" id="<?=$arItemIds['QUANTITY']?>" type="number"
											name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
											value="<?=$measureRatio?>">
										<span class="product-item-amount-field-btn-plus no-select" id="<?=$arItemIds['QUANTITY_UP']?>"></span>
										<span class="product-item-amount-description-container">
											<span id="<?=$arItemIds['QUANTITY_MEASURE']?>"><?=$actualItem['ITEM_MEASURE']['TITLE']?></span>
											<span id="<?=$arItemIds['PRICE_TOTAL']?>"></span>
										</span>
									</div>
								</div>
							</div>
							<?
						// }
					}

					break;

				case 'buttons':
					?>
					<!-- <div class="product-item-info-container product-item-hidden" data-entity="buttons-block"> -->
					
						<?
						
						if (!$haveOffers)
						{
							if ($actualItem['CAN_BUY'])
							{
								?>
								<!-- <div class="col-6"><button class="mbtn mbtn__grey2 mbtn__small" type="button">В корзину</button></div> -->
								<!-- <div class="gcard__footer__btnwrap">
									<button class="mbtn mbtn__primary mbtn__small d-block w-100 js--card-btn mbtn__active">В корзину</button></div>
								</div> -->
								<div class="col-6 product-item-button-container gcard__footer__btnwrap" id="<?=$arItemIds['BASKET_ACTIONS']?>">
									<a class="mbtn__grey2 mbtn__small btn mbtn mbtn__primary d-block w-100 js--card-btn" id="<?=$arItemIds['BUY_LINK']?>"
										href="javascript:void(0)" rel="nofollow">
										<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
									</a>
								</div>
								
								</div>
								<?
							}
							else
							{
								?>
								<div class="product-item-button-container">
									<?
									if ($showSubscribe)
									{
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.product.subscribe',
											'',
											array(
												'PRODUCT_ID' => $actualItem['ID'],
												'BUTTON_ID' => $arItemIds['SUBSCRIBE_LINK'],
												'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
												'DEFAULT_DISPLAY' => true,
												'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
									}
									?>
									<a class="btn btn-link <?=$buttonSizeClass?>"
										id="<?=$arItemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow">
										<?=$arParams['MESS_NOT_AVAILABLE']?>
									</a>
								</div>
								<?
							}
						}
						else
						{
							if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
							{
								?>
								<div class="product-item-button-container">
									<?
									if ($showSubscribe)
									{
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.product.subscribe',
											'',
											array(
												'PRODUCT_ID' => $arItem['ID'],
												'BUTTON_ID' => $arItemIds['SUBSCRIBE_LINK'],
												'BUTTON_CLASS' => 'btn btn-default '.$buttonSizeClass,
												'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
												'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
									}
									?>
									<a class="btn btn-link <?=$buttonSizeClass?>"
										id="<?=$arItemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow"
										<?=($actualItem['CAN_BUY'] ? 'style="display: none;"' : '')?>>
										<?=$arParams['MESS_NOT_AVAILABLE']?>
									</a>
									<div id="<?=$arItemIds['BASKET_ACTIONS']?>" <?=($actualItem['CAN_BUY'] ? '' : 'style="display: none;"')?>>
										<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$arItemIds['BUY_LINK']?>"
											href="javascript:void(0)" rel="nofollow">
											<?=($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET'])?>
										</a>
									</div>
								</div>
								<?
							}
							else
							{
								?>
								<div class="product-item-button-container">
									<a class="btn btn-default <?=$buttonSizeClass?>" href="<?=$arItem['DETAIL_PAGE_URL']?>">
										<?=$arParams['MESS_BTN_DETAIL']?>
									</a>
								</div>
								<?
							}
						}
						?>
					<!-- </div> -->
					<?
					break;

				case 'props':
					if (!$haveOffers)
					{
						if (!empty($arItem['DISPLAY_PROPERTIES']))
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="props-block">
								<dl class="product-item-properties">
									<?
									foreach ($arItem['DISPLAY_PROPERTIES'] as $code => $displayProperty)
									{
										?>
										<dt<?=(!isset($arItem['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
											<?=$displayProperty['NAME']?>
										</dt>
										<dd<?=(!isset($arItem['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
											<?=(is_array($displayProperty['DISPLAY_VALUE'])
												? implode(' / ', $displayProperty['DISPLAY_VALUE'])
												: $displayProperty['DISPLAY_VALUE'])?>
										</dd>
										<?
									}
									?>
								</dl>
							</div>
							<?
						}

						if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($arItem['PRODUCT_PROPERTIES']))
						{
							?>
							<div id="<?=$arItemIds['BASKET_PROP_DIV']?>" style="display: none;">
								<?
								if (!empty($arItem['PRODUCT_PROPERTIES_FILL']))
								{
									foreach ($arItem['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
									{
										?>
										<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
											value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
										<?
										unset($arItem['PRODUCT_PROPERTIES'][$propID]);
									}
								}

								if (!empty($arItem['PRODUCT_PROPERTIES']))
								{
									?>
									<table>
										<?
										foreach ($arItem['PRODUCT_PROPERTIES'] as $propID => $propInfo)
										{
											?>
											<tr>
												<td><?=$arItem['PROPERTIES'][$propID]['NAME']?></td>
												<td>
													<?
													if (
														$arItem['PROPERTIES'][$propID]['PROPERTY_TYPE'] === 'L'
														&& $arItem['PROPERTIES'][$propID]['LIST_TYPE'] === 'C'
													)
													{
														foreach ($propInfo['VALUES'] as $valueID => $value)
														{
															?>
															<label>
																<? $checked = $valueID === $propInfo['SELECTED'] ? 'checked' : ''; ?>
																<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
																	value="<?=$valueID?>" <?=$checked?>>
																<?=$value?>
															</label>
															<br />
															<?
														}
													}
													else
													{
														?>
														<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]">
															<?
															foreach ($propInfo['VALUES'] as $valueID => $value)
															{
																$selected = $valueID === $propInfo['SELECTED'] ? 'selected' : '';
																?>
																<option value="<?=$valueID?>" <?=$selected?>>
																	<?=$value?>
																</option>
																<?
															}
															?>
														</select>
														<?
													}
													?>
												</td>
											</tr>
											<?
										}
										?>
									</table>
									<?
								}
								?>
							</div>
							<?
						}
					}
					else
					{
						$showProductProps = !empty($arItem['DISPLAY_PROPERTIES']);
						$showOfferProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $arItem['OFFERS_PROPS_DISPLAY'];

						if ($showProductProps || $showOfferProps)
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="props-block">
								<dl class="product-item-properties">
									<?
									if ($showProductProps)
									{
										foreach ($arItem['DISPLAY_PROPERTIES'] as $code => $displayProperty)
										{
											?>
											<dt<?=(!isset($arItem['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
												<?=$displayProperty['NAME']?>
											</dt>
											<dd<?=(!isset($arItem['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
												<?=(is_array($displayProperty['DISPLAY_VALUE'])
													? implode(' / ', $displayProperty['DISPLAY_VALUE'])
													: $displayProperty['DISPLAY_VALUE'])?>
											</dd>
											<?
										}
									}

									if ($showOfferProps)
									{
										?>
										<span id="<?=$arItemIds['DISPLAY_PROP_DIV']?>" style="display: none;"></span>
										<?
									}
									?>
								</dl>
							</div>
							<?
						}
					}
                }}}?>
                </div> </div>  <?} ?>
		
		</div></div>
<!-- 
    <div class="catalog-page__content">
        <div class="catalog-page__row"> -->
            <?php $c = 1; ?>
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <!-- <div class="catalog-page__cell">
                    <div class="catalog-page__item">
                        <div class="catalog-page__item-img">
                            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ? $arItem["PREVIEW_PICTURE"]["SRC"] : SITE_TEMPLATE_PATH . "/placeholder.png" ?>"
                                 alt="<?= $arItem["NAME"] ?><?= $c ? "- рис " . $c : "" ?>" title="<?= $arItem["NAME"] ?> в интернет-магазине Атланта <?= $c ? "- рис " . $c : "" ?>">
                        </div>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
                           class="catalog-page__item-title"><?= $arItem["NAME"] ?></a>
                        <?php if ($arItem["DISPLAY_PROPERTIES"] && !empty($arItem["DISPLAY_PROPERTIES"])): ?>
                            <div class="catalog-page__item-list">
                                <?php foreach ($arItem["DISPLAY_PROPERTIES"] as $prop): ?>
                                    <div class="catalog-page__item-list-it">
                                        <span><?= $prop["NAME"] ?></span>
                                        <span><?= $prop["VALUE"] ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="catalog-page__item-al">
                            <?php if ($arItem["PRICE_RENT"] && $arItem["PROPERTIES"]["ALLOW_RENT"]["VALUE"]): ?>
                                <div class="catalog-page__item-al-in">
                                    <span>Цена в сутки с НДС</span>
                                    <span><?= $arItem["PRICE_RENT"] ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($arItem["PRICE_SALE"] && $arItem["PROPERTIES"]["ALLOW_SALE"]["VALUE"]): ?>
                                <div class="catalog-page__item-al-in">
                                    <span>Цена покупки</span>
                                    <span><?= $arItem["PRICE_SALE"] ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="catalog-page__item-btn">
                            <?php if ($arItem["PRICE_RENT"] && $arItem["PROPERTIES"]["ALLOW_RENT"]["VALUE"]): ?>
                                <a href="javascript:void(0)" data-remodal-target="cl2" class="btn btn-prim">Аренда в 1
                                    клик</a>
                            <?php endif; ?>
                            <?php if ($arItem["PRICE_SALE"] && $arItem["PROPERTIES"]["ALLOW_SALE"]["VALUE"]): ?>
                                <a href="javascript:void(0)" data-remodal-target="cl1" class="btn btn-prim">Получить
                                    КП</a>
                            <?php endif; ?>
                            <?php
                            if (!$arItem["PRICE_SALE"] || !$arItem["PROPERTIES"]["ALLOW_SALE"]["VALUE"] && !$arItem["PRICE_RENT"] || !$arItem["PROPERTIES"]["ALLOW_RENT"]["VALUE"]): ?>
                                <a href="javascript:void(0)" onclick="location.replace('<?= $arItem["DETAIL_PAGE_URL"] ?>')" class="btn btn-bord">Подробнее</a>
                            <?php endif; ?>


                        </div>
                    </div>
                </div> -->
            <?php $c++; ?>
            <?php endforeach; ?>
        <!-- </div> -->
        <?= $arResult["NAV_STRING"] ?>
    <!-- </div> -->
<?php else: ?>
    <h1 class="h1">По вашему запросу «<?= htmlspecialchars($_GET["q"], ENT_QUOTES, 'UTF-8'); ?>» не было найдено товаров</h1>
                <div class="pagesearch__noresult">
                    <div class="pagesearch__noresult__content">
                        <div class="block__text">
                            <p><strong>Попробуйте изменить формулировку, воспользуйтесь <a href="/catalog/">каталогом</a>, или <a href="#js--modal-feedback" data-fancybox-html="data-fancybox-html">свяжитесь с нами</a></strong></p>
                        </div>
                    </div>
                    <div class="pagesearch__noresult__more"><a class="mbtn mbtn__primary mbtn__big" href="/">На главную</a></div>
                </div>

    
    </div>
<?php
endif; ?>