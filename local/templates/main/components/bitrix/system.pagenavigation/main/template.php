<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if (!$arResult["NavShowAlways"])
{
	if (0 == $arResult["NavRecordCount"] || (1 == $arResult["NavPageCount"] && false == $arResult["NavShowAll"]))
		return;
}
if ('' != $arResult["NavTitle"])
	$arResult["NavTitle"] .= ' ';

$strSelectPath = $arResult['sUrlPathParams'].($arResult["bSavePage"] ? '&PAGEN_'.$arResult["NavNum"].'='.(true !== $arResult["bDescPageNumbering"] ? 1 : '').'&' : '').'SHOWALL_'.$arResult["NavNum"].'=0&SIZEN_'.$arResult["NavNum"].'=';

?>
<div class="bx_pagination_bottom">
	<!-- <div class="bx_pagination_section_two">
		<div class="bx_pg_section bx_pg_show_col">
			<span class="bx_wsnw"><?
			if ($arParams['USE_PAGE_SIZE'] == 'Y' && !$arResult["NavShowAll"])
			{
			?>
				<span class="bx_pg_text"><? echo GetMessage('nav_size_descr'); ?></span>
				<div class="bx_pagination_select_container">
					<select onchange="if (-1 < this.selectedIndex) {location.href='<? echo $strSelectPath; ?>'+this[selectedIndex].value};"><?
					foreach ($arResult['TPL_DATA']['PAGE_SIZES'] as &$intOneSize)
					{
						?><option value="<? echo $intOneSize; ?>"<? echo ($arResult['NavPageSize'] == $intOneSize ? ' selected="selected"' : ''); ?>><? echo $intOneSize; ?></option>
						<?
					}
					unset($intOneSize);
					?>
					</select>
				</div><?
			}
			?>
				<? echo $arResult["NavTitle"]; ?><?=$arResult["NavFirstRecordShow"]; ?> - <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?>
			</span>
		</div>
	</div> -->

    <!-- <div class="pagination">
                    <div class="pagination__item"><button class="pagination__btn" disabled="disabled"><svg>
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrowleft-big"></use>
                            </svg></button></div>
                    <div class="pagination__item">
                        <ul>
                            <li><a class="pagination__link pagination__link__active" href="#">1</a></li>
                            <li><a class="pagination__link" href="#">2</a></li>
                            <li><a class="pagination__link" href="#">3</a></li>
                            <li class="pagination__hidemobile"><a class="pagination__link" href="#">4</a></li>
                            <li class="pagination__hidemobile"><a class="pagination__link" href="#">5</a></li>
                            <li><span>...</span></li>
                            <li><a class="pagination__link" href="#">10</a></li>
                        </ul>
                    </div>
                    <div class="pagination__item"><button class="pagination__btn"><svg>
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrowright-big"></use>
                            </svg></button></div>
                </div> -->

				<!-- <div class="block__more">
                    <div class="pagination">
                        <div class="pagination__item"><button class="pagination__btn prev" type="button"><i><svg>
                                        <use xlink:href="img/icons.svg#ic-prev"></use>
                                    </svg></i><span>Предыдущая</span></button></div>
                        <div class="pagination__item">
                            <ul>
                                <li><a class="pagination__link active" href="#"><span>1</span></a></li>
                                <li><a class="pagination__link" href="#"><span>2</span></a></li>
                                <li><a class="pagination__link" href="#"><span>3</span></a></li>
                                <li><span>...</span></li>
                                <li><a class="pagination__link" href="#"><span>10</span></a></li>
                            </ul>
                        </div>
                        <div class="pagination__item"><button class="pagination__btn next" type="button"><span>Следующая</span><i><svg>
                                        <use xlink:href="img/icons.svg#ic-next"></use>
                                    </svg></i></button></div>
                    </div>
                </div> -->

	<div class="bx_pagination_section_one">
		<div class="bx_pg_section pg_pagination_num block__more">
			<div class="pagination"><?
if ($arResult["NavShowAll"])
{
?>
				<span class="bx_pg_text"><? echo GetMessage('nav_all_descr'); ?></span>
				<ul>
					<li><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>SHOWALL_<?=$arResult["NavNum"]?>=0&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>"><? echo GetMessage('nav_show_pages'); ?></a></li>
				</ul>
<?
}
else
{
?>
				<span class="bx_pg_text"><? echo GetMessage('nav_pages'); ?></span>
				<ul>
<?
	if (true === $arResult["bDescPageNumbering"])
	{
		?><li><?
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="Предыдущая"> 
			<div class="pagination__item"><button class="pagination__btn prev" ><i><svg>
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-prev"></use>
        </svg></i><span>Предыдущая</span></button></div></a><?
		}

		else
		{
			?><div class="pagination__item"><button class="pagination__btn prev" ><svg>
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-prev"></use>
        </svg></button></div><?
		}
		?></li><?
		$NavRecordGroup = $arResult["NavPageCount"];
		while ($NavRecordGroup >= 1)
		{
			$NavRecordGroupPrint = $arResult["NavPageCount"] - $NavRecordGroup + 1;
			$strTitle = GetMessage(
				'nav_page_num_title',
				array('#NUM#' => $NavRecordGroupPrint)
			);
			if ($NavRecordGroup == $arResult["NavPageNomer"])
			{
				?><li class="pagination__link active" title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroupPrint; ?></li><?
			}
			elseif ($NavRecordGroup == $arResult["NavPageCount"] && $arResult["bSavePage"] == false)
			{
				?><li><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a></li><?
			}
			else
			{
				?><li><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a></li><?
			}
			if (1 == ($arResult["NavPageCount"] - $NavRecordGroup) && 2 < ($arResult["NavPageCount"] - $arResult["nStartPage"]))
			{
				$middlePage = floor(($arResult["nStartPage"] + $NavRecordGroup)/2);
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $NavRecordGroupPrint)
				);
				?><li><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
				$NavRecordGroup = $arResult["nStartPage"];
			}
			elseif ($NavRecordGroup == $arResult["nEndPage"] && 3 < $arResult["nEndPage"])
			{
				$middlePage = ceil(($arResult["nEndPage"] + 2)/2);
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $NavRecordGroupPrint)
				);
				?><li><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
				$NavRecordGroup = 2;
			}
			else
			{
				$NavRecordGroup--;
			}
		}
		?><li><?
		if ($arResult["NavPageNomer"] > 1)
		{
			?><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_next_title'); ?>">
            <div class="pagination__item"><button class="pagination__btn" ><svg>
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-next"></use>
                            </svg></button></div>
            </a><?
		}
		else
		{
			?> <div class="pagination__item"><button class="pagination__btn" ><svg>
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-next"></use>
        </svg></button></div><?
		}
		?></li><?
	}
	else
	{
?>





					<li><?
		if (1 < $arResult["NavPageNomer"])
		{
			?><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_prev_title'); ?>"> <div class="pagination__item"><button class="pagination__btn prev" ><i><svg>
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-prev"></use>
        </svg></i><span>Предыдущая</span></button></div></a><?
		}
		else
		{
			?><div class="pagination__item"><button class="pagination__btn prev" disabled="disabled"><i><svg>
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-prev"></use>
        </svg></i><span>Предыдущая</span></button></div><?
		}
		?></li><?
		$NavRecordGroup = 1;
		while($NavRecordGroup <= $arResult["NavPageCount"])
		{
			$strTitle = GetMessage(
				'nav_page_num_title',
				array('#NUM#' => $NavRecordGroup)
			);
			if ($NavRecordGroup == $arResult["NavPageNomer"])
			{
				?>
                <li><a class="pagination__link active" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li>
                <?
			}
			elseif ($NavRecordGroup == 1 && $arResult["bSavePage"] == false)
			{
				?><li><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li><?
			}
			else
			{
				?><li><a class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li><?
			}
			if ($NavRecordGroup == 2 && $arResult["nStartPage"] > 3 && $arResult["nStartPage"] - $NavRecordGroup > 1)
			{
				$middlePage = ceil(($arResult["nStartPage"] + $NavRecordGroup)/2);
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $middlePage)
				);
				?><li><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
				$NavRecordGroup = $arResult["nStartPage"];
			}
			elseif ($NavRecordGroup == $arResult["nEndPage"] && $arResult["nEndPage"] < ($arResult["NavPageCount"] - 2))
			{
				$middlePage = floor(($arResult["NavPageCount"] + $arResult["nEndPage"] - 1)/2);
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $middlePage)
				);
				?><li><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
				$NavRecordGroup = $arResult["NavPageCount"]-1;
			}
			else
			{
				$NavRecordGroup++;
			}
		}
			?>
					<li><?
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?><div class="pagination__item"><a  href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="Следующая"><button class="pagination__btn next"><span>Следующая</span><i><svg>
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-next"></use>
        </svg></i></button></a></div><?
		}
		else
		{
			?><div class="pagination__item"><button class="pagination__btn next" disabled="disabled" type="button"><span>Следующая</span><i><svg>
            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-next"></use>
        </svg></i></button></div>
		<?
		}
		?></li><?
		if ($arResult["bShowAll"])
		{
			?><li><a  class="pagination__link" href="<?=$arResult['sUrlPathParams']; ?>SHOWALL_<?=$arResult["NavNum"]?>=1&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageSize"]?>"><? echo GetMessage('nav_all'); ?></a></li><?
		}
	}
?>
				</ul><?
}
?>
			</div>
		</div>
	</div>
</div>