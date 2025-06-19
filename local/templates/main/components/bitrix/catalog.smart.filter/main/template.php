<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);


?>

<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="filter">

    <?
    //not prices
    $empty = true;
    foreach ($arResult["ITEMS"] as $key => $arItem):
        if (!empty($arItem["VALUES"])):
            $empty = false;
            ?>
            <?php if ($arItem["CODE"] == "PRICE_SALE"):
            ?>


            <div class="filter__item open filter__cell">
                <span class="bx-filter-container-modef"></span>
                <div class="filter__title open"><?= $arItem["NAME"] ?></div>
                <div class="filter__container" style="display: block;">
                    <div class="filter__range ">
                        <div class="filter__range-item">
                            <input type="text"
                                   id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                   name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                   value="<?= $arItem["VALUES"]["MIN"]["HTML_VALUE"] ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ?>"
                                   onkeyup="smartFilter.keyup(this)"
                            >
                        </div>
                        <div class="filter__range-item">
                            <input type="text"
                                   id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                   name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                   value="<?= $arItem["VALUES"]["MAX"]["HTML_VALUE"] ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"] ?>"
                                   onkeyup="smartFilter.keyup(this)"
                            >
                        </div>
                    </div>

                </div>
            </div>

        <?php else: ?>
           
            <div class="filter__item open filter__cell">
                <div class="filter__title open filter__cell-title"><?= $arItem["NAME"] ?></div>

                <div class="filter__container" style="display: block;">
                    <div class="filter__group-check open mCustomScrollbar ">
                        <?php $c = 0 ?>
                        <?php foreach ($arItem["VALUES"] as $val => $ar):
                            ?>
                            <?php $c++ ?>
                            <div class="filter__check">
                                <input
                                        type="checkbox"
                                        name="<?= $ar["CONTROL_NAME"] ?>"
                                        id="<?= $ar["CONTROL_ID"] ?>"
                                        value="<?= $ar["HTML_VALUE"] ?>"
                                        onclick="smartFilter.click(this)"
                                    <?= $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                >
                                <label for="<?= $ar["CONTROL_ID"] ?>"><?= $ar["VALUE"] ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($c > 5): ?>
                        <div class="filter__all open">
                            <span class="show">Показать еще</span>
                            <span class="hide">Скрыть</span>
                        </div>
                    <?php endif; ?>

                </div>
                <span class="bx-filter-container-modef"></span>
            </div>
        <?php endif; ?>

        <?
        endif;
    endforeach;
    ?>

    <?php if (!$empty): ?>
        <div class="filter__btn">
            <a class="btn btn-gray" id="del_filter"
               name="del_filter">Сбросить</a>
           <a class="btn btn-prim" id="set_filter"
              name="set_filter">Показать</a>
            <div class="bx-filter-container-modef">
                <div id="modef" class="filter__total" <? if (!isset($arResult["ELEMENT_COUNT"]))
                    echo 'style="display:none"'; ?> style="display: inline-block;">
                    <a href="<? echo $arResult["FILTER_URL"] ?>" class="filter__total-quantity">

                        <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . (int)($arResult["ELEMENT_COUNT"] ?? 0) . '</span>')); ?>
                    </a>
                    <span class="arrow" style="display: none"></span>
                    <div class="filter__total-close"><img src="<?= SITE_TEMPLATE_PATH ?>/assets/img/svg/cl.svg" alt="">
                    </div>
                </div>
            </div>
        </div>


    <?php endif; ?>
</form>
<?php
if(!$arResult["JS_FILTER_PARAMS"]["SEF_SET_FILTER_URL"]) $arResult["JS_FILTER_PARAMS"]["SEF_DEL_FILTER_URL"] = addGet("del_filter", "y");

\CJSCore::Init();
// без этого почему-то не видит пространство BX (только без авторизации)
?>

<script>
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
