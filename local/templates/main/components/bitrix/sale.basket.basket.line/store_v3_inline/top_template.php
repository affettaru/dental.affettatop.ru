<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $cartId
 */

$compositeStub = ($arResult['COMPOSITE_STUB'] ?? 'N') === 'Y';
?>


<a class="header__tocard" href="<?= $arParams['PATH_TO_BASKET'] ?>" data-page-url="#system_mainpage">
	<span class="header__cart__icon">
		<svg>
			<use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-cart"></use>
		</svg>
			<?php
			if (!$compositeStub)
			{
				if (
					$arParams['SHOW_NUM_PRODUCTS'] === 'Y'
					&& ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] === 'Y')
				)
				{
					?><i class="header__cart__count "><?= $arResult['NUM_PRODUCTS'] ?></i><?php
				}
			}
		?>
	</span>

</a>