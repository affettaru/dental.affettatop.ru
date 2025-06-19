<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */


 $id = $this->GetEditAreaId($item['ID']);

//  if($item["PREVIEW_PICTURE"]["SRC"] ){
// 	$file = CFile::ResizeImageGet($item["PREVIEW_PICTURE"], array("width" => $wdth, "height" => $hght));
	
//  }else{
//  $file = CFile::ResizeImageGet($item["DETAIL_PICTURE"], array("width" => $wdth, "height" => $hght));}

?>


                                <!-- <div class="gcard">
                                    <div class="gcard__markers"><span class="sale">Скидка 23%</span><span class="preorder">Под заказ</span>
								</div>
								<a class="gcard__img" href="#">
										<img src="img/catalog/img-catalog-0.jpg" alt="" /></a>
										<a class="gcard__title" href="#">Набор для клинического отбеливания ZOOM</a>
                                    <div class="gcard__price"><span class="current">27 000 ₽</span><span class="old">35 000 ₽</span></div>
                                    <div class="gcard__footer js--card-wrap">
                                        <div class="gcard__footer__countwrap">
                                            <div>
                                                <div class="inputcount__wrap" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-content="На складе всего 7 штук">
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
                                        <div class="gcard__footer__btnwrap"><button class="mbtn mbtn__primary mbtn__small d-block w-100 js--card-btn mbtn__active">В корзину</button></div>
                                    </div>
                                </div>
                            </div> -->
<div class="catalog__card gcard">
	<div class="gcard__markers"><?if($price['PERCENT']){?><span class="sale">Скидка <?=$price['PERCENT']?>%</span><?}?><span class="preorder">Под заказ</span></div>

	<? if ($itemHasDetailUrl): ?>
		
	<a class="gcard__img" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>"
			data-entity="image-wrapper">
			<img src="<?=$item["PREVIEW_PICTURE"]["SRC"] ? $item["PREVIEW_PICTURE"]["SRC"] : $item['DETAIL_PICTURE']['SRC'];?>" alt="<?= $item["NAME"] ?>" />
			
	<? else: ?>
	<!-- <span class="product-item-image-wrapper" data-entity="image-wrapper"> -->
	<? endif; ?>
		<span class="product-item-image-slider-slide-container slide"style="display:none; " id="<?=$itemIds['PICT_SLIDER']?>">
			<?/*=($showSlider ? '' : 'style="display: none;"')?>
			data-slider-interval="<?=$arParams['SLIDER_INTERVAL']?>" data-slider-wrap="true">
			<?
			if ($showSlider)
			{
				foreach ($morePhoto as $key => $photo)
				{
					?>
					<span class="product-item-image-slide item <?=($key == 0 ? 'active' : '')?>"
						style="background-image: url('<?=$photo['SRC']?>');">
					</span>
					<?
				}
			}
			*/?>
		</span>
		<!-- <span class="product-item-image-original" id="<?=$itemIds['PICT']?>"
			style="background-image: url('<?=$item['PREVIEW_PICTURE']['SRC']?>'); <?=($showSlider ? 'display: none;' : '')?>">
		</span> -->
		<?
		if ($item['SECOND_PICT'])
		{
			$bgImage = !empty($item['PREVIEW_PICTURE_SECOND']) ? $item['PREVIEW_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC'];
			?>
			<span class="product-item-image-alternative" id="<?=$itemIds['SECOND_PICT']?>"
				style="display:none; ">
			</span>
			<?
		}

		if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
		{
			?>
			<!-- <div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DSC_PERC']?>"
				<?=($price['PERCENT'] > 0 ? '' : 'style="display: none;"')?>>
				<span><?=-$price['PERCENT']?>%</span>
			</div> -->
			<?
		}

		if ($item['LABEL'])
		{
			?>
			<div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>">
				<?
				if (!empty($item['LABEL_ARRAY_VALUE']))
				{
					foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
					{
						?>
						<!-- <div<?=(!isset($item['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
							<span title="<?=$value?>"><?=$value?></span>
						</div> -->
						<?
					}
				}
				?>
			</div>
			<?
		}
		?>
		<div class="product-item-image-slider-control-container" id="<?=$itemIds['PICT_SLIDER']?>_indicator"
			<?=($showSlider ? '' : 'style="display: none;"')?>>
			<?
			if ($showSlider)
			{
				foreach ($morePhoto as $key => $photo)
				{
					?>
					<!-- <div class="product-item-image-slider-control<?=($key == 0 ? ' active' : '')?>" data-go-to="<?=$key?>"></div> -->
					<?
				}
			}
			?>
		</div>
		<?
		if ($arParams['SLIDER_PROGRESS'] === 'Y')
		{
			?>
			<!-- <div class="product-item-image-slider-progress-bar-container">
				<div class="product-item-image-slider-progress-bar" id="<?=$itemIds['PICT_SLIDER']?>_progress_bar" style="width: 0;"></div>
			</div> -->
			<?
		}
		?>
	<? if ($itemHasDetailUrl): ?>
	</a>
	<? else: ?>
	</span>
	<? endif; ?>
	<!-- <div class="product-item-title">
		<? if ($itemHasDetailUrl): ?>
		<a href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$productTitle?>">
		<? endif; ?>
		<?=$productTitle?>
		<? if ($itemHasDetailUrl): ?>
		</a>
		<? endif; ?>
	</div> -->

<?

// use Bitrix\Main\Loader; 
// Loader::includeModule("highloadblock"); 
// use Bitrix\Highloadblock as HL;  
// // подключаем модуль highloadblock

// $hlblock = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_proizvoditeli')))->fetch();
// $entity = HL\HighloadBlockTable::compileEntity($hlblock);

// $entityDataClass = $entity->getDataClass(); 
// $result = $entityDataClass::getList(array("filter" => Array("UF_XML_ID"=>$item["PROPERTIES"]["U_MARKA"]["VALUE"])));

// if($arRow = $result->Fetch())
// 	{
// 		$marka_NAME= $arRow["UF_NAME"];
// 	}

// $hlblock = HL\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => 'b_hlbd_proizvoditelid')))->fetch();
// $entity = HL\HighloadBlockTable::compileEntity($hlblock);

// // echo "<pre>Template arResult: "; print_r($item["PROPERTIES"]); echo "</pre>";
// $entityDataClass = $entity->getDataClass(); 
// $result = $entityDataClass::getList(array("filter" => Array("UF_XML_ID"=>$item["PROPERTIES"]["U_MARKA_D"]["VALUE"])));

// if($arRow = $result->Fetch())
// 	{
// 		$marka_NAME= $arRow["UF_NAME"];
// 	}
	

?>
	<!-- <a class="gcard__title" href="#">Набор для клинического отбеливания ZOOM</a>
	<div class="gcard__price"><span class="current">27 000 ₽</span><span class="old">35 000 ₽</span></div> -->

	<a class="gcard__title" href="<?= $item["DETAIL_PAGE_URL"] ?>"><?= $item["NAME"] ?></a>
			<div class="catalog__card__line row align-items-md-center gcard__price">
				<!-- <div class="col-12 col-md-auto"> -->
					<!-- <div class="catalog__card__price"><?=$item["ITEM_PRICES"][0]["PRINT_PRICE"]?></div>
				</div> -->
				<span class="current"><?=$item["ITEM_PRICES"][0]["PRINT_PRICE"]?></span>
				<?if($item["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]!=$item["ITEM_PRICES"][0]["PRINT_PRICE"] && !empty($item['ID'])){ ?>
					<!-- <div class="col-12 col-md-auto">
						<div class="catalog__card__oldprice"><?=$item["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]?></div>
					</div> -->
					<span class="old"><?=$item["ITEM_PRICES"][0]["PRINT_BASE_PRICE"]?></span>
				<?}?>
			</div>
			<!-- <div class="catalog__card__footer d-none d-md-block">
				<div class="row"> -->
					
					

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
							<span class="product-item-price-old" id="<?=$itemIds['PRICE_OLD']?>"
								<?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '')?>>
								<?=$price['PRINT_RATIO_BASE_PRICE']?>
							</span>&nbsp;
							<?
						}
						?>
						<span class="product-item-price-current" style="display:none" id="<?=$itemIds['PRICE']?>">
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
                                                <div class="inputcount__wrap" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-placement="bottom" data-bs-custom-class="custom-popover" data-bs-content="На складе всего <?=$item["PRODUCT"]["QUANTITY"];?> штук">
                                                    <div class="inputcount js--inputcount">
                                                        <div class="inputcount__btn minus js--inputcount-minus" id="<?=$itemIds['QUANTITY_DOWN']?>"><i><svg>
                                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-minus"></use>
                                                                </svg></i>
															</div>
                                                        <div class="inputcount__btn plus js--inputcount-plus"  id="<?=$itemIds['QUANTITY_UP']?>"><i><svg>
                                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-plus"></use>
                                                                </svg></i>
															</div>
															<input class="inputcount__input js--inputcount-input " id="<?=$itemIds['QUANTITY']?>" type="number"  min="1" max="<?=$item["PRODUCT"]["QUANTITY"];?>" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
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
												<div class="inputcount__btn minus  inputcount__btn__left js--inputcount-minus" id="<?=$itemIds['QUANTITY_DOWN']?>"><i>
													<svg>
														<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-minus"></use>
													</svg></i>
												</div>
												<div class="inputcount__btn plus inputcount__btn__right js--inputcount-plus" id="<?=$itemIds['QUANTITY_UP']?>"><i>
													<svg>
														<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-plus"></use>
													</svg></i>
												</div>
												<input class="inputcount__input js--inputcount-input " id="<?=$itemIds['QUANTITY']?>" type="number"  min="1" max="5" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
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
										<span class="product-item-amount-field-btn-minus no-select" id="<?=$itemIds['QUANTITY_DOWN']?>"></span>
										<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY']?>" type="number"
											name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>"
											value="<?=$measureRatio?>">
										<span class="product-item-amount-field-btn-plus no-select" id="<?=$itemIds['QUANTITY_UP']?>"></span>
										<span class="product-item-amount-description-container">
											<span id="<?=$itemIds['QUANTITY_MEASURE']?>"><?=$actualItem['ITEM_MEASURE']['TITLE']?></span>
											<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
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
								<div class="col-6 product-item-button-container gcard__footer__btnwrap" id="<?=$itemIds['BASKET_ACTIONS']?>">
									<a class="mbtn__grey2 mbtn__small btn mbtn mbtn__primary d-block w-100 js--card-btn  mbtn__active" id="<?=$itemIds['BUY_LINK']?>"
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
												'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
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
										id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow">
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
												'PRODUCT_ID' => $item['ID'],
												'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
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
										id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow"
										<?=($actualItem['CAN_BUY'] ? 'style="display: none;"' : '')?>>
										<?=$arParams['MESS_NOT_AVAILABLE']?>
									</a>
									<div id="<?=$itemIds['BASKET_ACTIONS']?>" <?=($actualItem['CAN_BUY'] ? '' : 'style="display: none;"')?>>
										<a class="btn btn-default <?=$buttonSizeClass?>" id="<?=$itemIds['BUY_LINK']?>"
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
									<a class="btn btn-default <?=$buttonSizeClass?>" href="<?=$item['DETAIL_PAGE_URL']?>">
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
						if (!empty($item['DISPLAY_PROPERTIES']))
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="props-block">
								<dl class="product-item-properties">
									<?
									foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty)
									{
										?>
										<dt<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
											<?=$displayProperty['NAME']?>
										</dt>
										<dd<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
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

						if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !empty($item['PRODUCT_PROPERTIES']))
						{
							?>
							<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
								<?
								if (!empty($item['PRODUCT_PROPERTIES_FILL']))
								{
									foreach ($item['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo)
									{
										?>
										<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propID?>]"
											value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
										<?
										unset($item['PRODUCT_PROPERTIES'][$propID]);
									}
								}

								if (!empty($item['PRODUCT_PROPERTIES']))
								{
									?>
									<table>
										<?
										foreach ($item['PRODUCT_PROPERTIES'] as $propID => $propInfo)
										{
											?>
											<tr>
												<td><?=$item['PROPERTIES'][$propID]['NAME']?></td>
												<td>
													<?
													if (
														$item['PROPERTIES'][$propID]['PROPERTY_TYPE'] === 'L'
														&& $item['PROPERTIES'][$propID]['LIST_TYPE'] === 'C'
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
						$showProductProps = !empty($item['DISPLAY_PROPERTIES']);
						$showOfferProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];

						if ($showProductProps || $showOfferProps)
						{
							?>
							<div class="product-item-info-container product-item-hidden" data-entity="props-block">
								<dl class="product-item-properties">
									<?
									if ($showProductProps)
									{
										foreach ($item['DISPLAY_PROPERTIES'] as $code => $displayProperty)
										{
											?>
											<dt<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
												<?=$displayProperty['NAME']?>
											</dt>
											<dd<?=(!isset($item['PROPERTY_CODE_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
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
										<span id="<?=$itemIds['DISPLAY_PROP_DIV']?>" style="display: none;"></span>
										<?
									}
									?>
								</dl>
							</div>
							<?
						}
					}

					break;

				
			}
		}
	}

	if (
		$arParams['DISPLAY_COMPARE']
		&& (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
	)
	{
		?>
		<!-- <div class="product-item-compare-container">
			<div class="product-item-compare">
				<div class="checkbox">
					<label id="<?=$itemIds['COMPARE_LINK']?>">
						<input type="checkbox" data-entity="compare-checkbox">
						<span data-entity="compare-title"><?=$arParams['MESS_BTN_COMPARE']?></span>
					</label>
				</div>
			</div>
		</div> -->
		<?
	}
	?>
	<!-- </div>
	</div> -->
	
</div>
