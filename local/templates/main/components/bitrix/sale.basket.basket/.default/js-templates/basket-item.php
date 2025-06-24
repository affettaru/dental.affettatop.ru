<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>
<script id="basket-item-template" type="text/html">
<div class="cart__card basket-items-list-item-container{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}}" id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
	<!-- <tr class="basket-items-list-item-container{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}}"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}"> -->
		<!--<div class="cart__list__card "> -->
			<?
			if ($useActionColumn)
						{
							?>
							 <!-- <div class="cart__card__check">
								<label class="form__check form__check__solo">
									<input type="checkbox" checked="checked" />
								<span></span>
								</label>
							  </div>-->
							 

							<div class="cart__card__check cart__list__card__delete basket-items-list-item-remove hidden-xs">
								<div>
									<span class="form__check form__check__solo basket-item-actions-remove " data-entity="basket-item-delete"></span>
									{{#SHOW_LOADING}}
									<!-- <button class="cart__list__card__delete" type="button"><svg>
                                                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#close"></use>
                                                </svg>
                                            </button> -->
										<div class="basket-items-list-item-overlay"></div>
									{{/SHOW_LOADING}}
								</div>
							</div>
							<?
						}
			?>

			{{#SHOW_RESTORE}}
			
				<div class="cart__list__card__img basket-items-list-item-notification" colspan="<?=$restoreColSpan?>">
					<div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed" id="basket-item-height-aligner-{{ID}}">
						{{#SHOW_LOADING}}
							<div class="basket-items-list-item-overlay"></div>
						{{/SHOW_LOADING}}
						<div class="basket-items-list-item-removed-container">
							<div>
								<?=Loc::getMessage('SBB_GOOD_CAP')?> <strong>{{NAME}}</strong> <?=Loc::getMessage('SBB_BASKET_ITEM_DELETED')?>.
							</div>
							<div class="basket-items-list-item-removed-block">
								<a class="cart__list__card__img" href="javascript:void(0)" data-entity="basket-item-restore-button">
									<?=Loc::getMessage('SBB_BASKET_ITEM_RESTORE')?>
								</a>
								<span class="basket-items-list-item-clear-btn" data-entity="basket-item-close-restore-button"></span>
							</div>
						</div>
					</div>
				</div>
			{{/SHOW_RESTORE}}
			{{^SHOW_RESTORE}}

			{{#DETAIL_PAGE_URL}}

			

			<div class="cart__card__forimg">
				<a href="{{DETAIL_PAGE_URL}}" class="cart__card__img">
			{{/DETAIL_PAGE_URL}}
			<img class="basket-item-image" alt="{{NAME}}"
								src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}"></a>

								</div>

			<!-- <div class=" basket-items-list-item-descriptions"> -->
				<div class="cart__list__card__des cart__list__card__desbasket-items-list-item-descriptions-inner" id="basket-item-height-aligner-{{ID}}">
				{{#COLUMN_LIST}}
				
					<div class="cart__list__card__article basket-item-property-custom basket-item-property-custom-text
						{{#HIDE_MOBILE}}hidden-xs{{/HIDE_MOBILE}}"
						data-entity="basket-item-property">
						<!-- <div class="basket-item-property-custom-name"> -->
							{{NAME}}:
						<!-- </div> -->
						<!-- <div class="basket-item-property-custom-value"
							data-column-property-code="{{CODE}}"
							data-entity="basket-item-property-column-value"> -->
							{{VALUE}}
						<!-- </div> -->
					</div>
					
				{{/COLUMN_LIST}}


				{{#DETAIL_PAGE_URL}}
								<a href="{{DETAIL_PAGE_URL}}" class="cart__list__card__title">
							{{/DETAIL_PAGE_URL}}
	
							{{NAME}}

							{{#DETAIL_PAGE_URL}}
								</a>
							{{/DETAIL_PAGE_URL}}
					
					
					{{#SHOW_LOADING}}
						<div class="basket-items-list-item-overlay"></div>
					{{/SHOW_LOADING}}
				</div>
			<!-- </div> -->
			<!--</div>-->
		<div class="cart__list__des">
			<?
			if ($usePriceInAdditionalColumn)
			{
				?>
				<div class="cart__list__prices ">
					<div class="cart__list__label">Цена</div>
					<div class="cart__list__prices__now basket-item-block-price">{{{PRICE_FORMATED}}}</div>
						<!-- <div class="basket-item-price-current">
							<span class="basket-item-price-current-text" id="basket-item-price-{{ID}}">
								{{{PRICE_FORMATED}}}
							</span>
						</div> -->
						<div class="cart__list__prices__old">
						{{{FULL_PRICE_FORMATED}}}
						</div>
						<!-- {{#SHOW_DISCOUNT_PRICE}}
							<div class="basket-item-price-old">
								<span class="basket-item-price-old-text">
									{{{FULL_PRICE_FORMATED}}}
								</span>
							</div>
						{{/SHOW_DISCOUNT_PRICE}} -->

						

						<!-- <div class="basket-item-price-title">
							<?=Loc::getMessage('SBB_BASKET_ITEM_PRICE_FOR')?> {{MEASURE_RATIO}} {{MEASURE_TEXT}}
						</div> -->
						{{#SHOW_LOADING}}
							<div class="basket-items-list-item-overlay"></div>
						{{/SHOW_LOADING}}
					</div>
				<!-- </div> -->
				<?
			}
			?>
			<div class="cart__list__counter basket-items-list-item-amount">
				<div class="cart__list__label">Кол-во</div>
				<!-- <div class="inputcount js--inputcount">
					<div class="inputcount__btn inputcount__btn__left js--inputcount-minus">
						<svg>
							<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-minus"></use>
						</svg>
					</div>
                    <div class="inputcount__btn inputcount__btn__right js--inputcount-plus">
						<svg>
                            <use xlink:href="img/icons.svg#ic-plus"></use>
                        </svg>
					</div>
					<input type="text" class="inputcount__input js--inputcount-input basket-item-amount-filed" value="{{QUANTITY}}"
							{{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
							data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
							id="basket-item-quantity-{{ID}}">
					 <input class="inputcount__input js--inputcount-input" type="number" value="1" min="0" /> 
				</div> -->

				<div class="inputcount js--inputcount basket-item-block-amount{{#NOT_AVAILABLE}} disabled{{/NOT_AVAILABLE}}"
					data-entity="basket-item-quantity-block">
					<div class="inputcount__btn inputcount__btn__left js--inputcount-minus">
						<span  data-entity="basket-item-quantity-minus">
							<svg>
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-minus"></use>
							</svg>
						</span>
					</div>
					
					<div class="basket-item-amount-filed-block">
						<input type="text" class="inputcount__input js--inputcount-input basket-item-amount-filed" value="{{QUANTITY}}"
							{{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
							data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
							id="basket-item-quantity-{{ID}}">
					</div>
					<div class="inputcount__btn inputcount__btn__right js--inputcount-plus">
						<span data-entity="basket-item-quantity-plus">
							<svg>
								<use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-plus"></use>
							</svg>
						</span>
					</div>
					
					<!-- <div class="basket-item-amount-field-description">
						<?
						if ($arParams['PRICE_DISPLAY_MODE'] === 'Y')
						{
							?>
							{{MEASURE_TEXT}}
							<?
						}
						else
						{
							?>
							{{#SHOW_PRICE_FOR}}
								{{MEASURE_RATIO}} {{MEASURE_TEXT}} =
								<span id="basket-item-price-{{ID}}">{{{PRICE_FORMATED}}}</span>
							{{/SHOW_PRICE_FOR}}
							{{^SHOW_PRICE_FOR}}
								{{MEASURE_TEXT}}
							{{/SHOW_PRICE_FOR}}
							<?
						}
						?>
					</div> -->
					{{#SHOW_LOADING}}
						<div class="basket-items-list-item-overlay"></div>
					{{/SHOW_LOADING}}
				</div>
			</div>
			<?
			if ($useSumColumn)
			{
				?>
				<div class="cart__list__pricesumm basket-items-list-item-price<?=(!isset($mobileColumns['SUM']) ? ' hidden-xs' : '')?>">
					<div class="cart__list__label">Сумма</div>
					<div class="cart__list__pricesumm__text">{{{SUM_PRICE_FORMATED}}}</div>
					<!-- <div class="basket-item-block-price">
						{{#SHOW_DISCOUNT_PRICE}}
							<div class="basket-item-price-old">
								<span class="basket-item-price-old-text" id="basket-item-sum-price-old-{{ID}}">
									{{{SUM_FULL_PRICE_FORMATED}}}
								</span>
							</div>
						{{/SHOW_DISCOUNT_PRICE}}

						<div class="basket-item-price-current">
							<span class="basket-item-price-current-text" id="basket-item-sum-price-{{ID}}">
								{{{SUM_PRICE_FORMATED}}}
							</span>
						</div>

						{{#SHOW_DISCOUNT_PRICE}}
							<div class="basket-item-price-difference">
								<?=Loc::getMessage('SBB_BASKET_ITEM_ECONOMY')?>
								<span id="basket-item-sum-price-difference-{{ID}}" style="white-space: nowrap;">
									{{{SUM_DISCOUNT_PRICE_FORMATED}}}
								</span>
							</div>
						{{/SHOW_DISCOUNT_PRICE}}
						{{#SHOW_LOADING}}
							<div class="basket-items-list-item-overlay"></div>
						{{/SHOW_LOADING}}
					</div> -->
				</div>
				<?
			}

		
			?>
			</div>
		{{/SHOW_RESTORE}}
	<!-- </tr> -->
		</div>
</script>