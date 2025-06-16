<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
global $APPLICATION;
$curDir = $APPLICATION->GetCurDir();
?>
<? if (!empty($arResult)): ?>
    <!-- <?echo "<pre>Template arResult: "; print_r($arResult); echo "</pre>";?> -->
    <!-- <ul class="header__menu">
                            <li class="header__menu__item"><a class="header__menu__link" href="#"><span>О компании</span></a></li>
                            <li class="header__menu__item"><a class="header__menu__link" href="#"><span>Каталог</span><i><svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                        </svg></i></a>
                                <div class="header__menu__popup">
                                    <div class="header__menu__popup__body">
                                        <ul>
                                            <li><a href="#">Импланты MeDENT</a></li>
                                            <li><a href="#">Супраструктуры</a></li>
                                            <li><a href="#">Микрохирургические инструменты</a></li>
                                            <li><a href="#">Инструменты ORANDGE</a></li>
                                            <li><a href="#">Инструменты Пакистан</a></li>
                                            <li><a href="#">Шовный материал</a></li>
                                            <li><a href="#">Материалы 3m</a></li>
                                            <li><a href="#">Костнопластический материал и мембраны</a></li>
                                            <li><a href="#">Инструменты для костной пластики</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="header__menu__item"><a class="header__menu__link" href="#"><span>Доставка и оплата</span></a></li>
                            <li class="header__menu__item"><a class="header__menu__link" href="#"><span>Статьи</span></a></li>
                            <li class="header__menu__item"><a class="header__menu__link" href="#"><span>Контакты</span></a></li>
                        </ul> -->
   
<ul class="header__menu">

    <?php
    $previousLevel = 0;
    foreach ($arResult as $arItem): ?>

    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
        <?= str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? endif ?>

    <? if ($arItem["IS_PARENT"]): ?>

    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
    <!-- <li class="header__menu__item header__menu__chapter <?= $curDir == $arItem["LINK"] ? "header__menu__item__active" : "" ?>"> -->
    <li class="header__menu__item">
        <? if ($curDir == $arItem["LINK"]): ?>
            <a class="header__menu__link" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?>
       
                        <i><svg>
                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-arrow-down"></use>
                                    </svg></i>
                                    </a>                          
        <? else: ?>
            <a class="header__menu__link" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?>
            <i><svg>
                                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons.svg#ic-arrow-down"></use>
                                    </svg></i>
            </a>
        <? endif ?>
        <div class="header__menu__popup">
        <div class="header__menu__popup__body">
            <ul >
                <? else: ?>
                <li >
                    <? if ($curDir == $arItem["LINK"]): ?>
                        <span ><?= $arItem["TEXT"] ?></span>
                    <? else: ?>
                        <a ><?= $arItem["TEXT"] ?></a>
                    <? endif ?>
                    <div class="header__menu__popup">
                    <div class="header__menu__popup__body">
                        <ul>
                            <? endif ?>

                            <? else: ?>

                                <? if ($arItem["PERMISSION"] > "D"): ?>

                                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                                        <li class="header__menu__item">
                                            <? if ($curDir == $arItem["LINK"]): ?>
                                                <span  class="header__nav__link"><?= $arItem["TEXT"] ?></span>
                                            <? else: ?>
                                                <a  class="header__menu__link" href="<?= $arItem["LINK"] ?>"><span><?= $arItem["TEXT"] ?></span></a>
                                            <? endif ?>
                                        </li>
                                    <? else: ?>
                                        <li>
                                            <? if ($curDir == $arItem["LINK"]): ?>
                                                <a><?= $arItem["TEXT"] ?></a>
                                            <? else: ?>
                                                <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                                            <? endif ?>
                                        </li>
                                    <? endif ?>

                                <? endif ?>

                            <? endif ?>

                            <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

                            <? endforeach ?>

                            <? if ($previousLevel > 1): // close last item tags ?>
                                <?= str_repeat("</ul></div></div></li>", ($previousLevel - 1)); ?>
                            <? endif ?>
                        </ul>
    <? endif ?>