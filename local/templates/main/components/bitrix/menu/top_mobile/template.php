<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
global $APPLICATION;
$curDir = $APPLICATION->GetCurDir()
?>

<? if (!empty($arResult)): ?>

<ul class="mobilemenu__nav">

    <?php
    $previousLevel = 0;
    foreach ($arResult as $arItem): ?>

    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
        <?= str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? endif ?>

    <? if ($arItem["IS_PARENT"]): ?>

    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
 
        <li class="mobilemenu__nav__item">
        <? if ($curDir == $arItem["LINK"]): ?>
            <a class="mobilemenu__nav__link"><?= $arItem["TEXT"] ?>
           </span> 
                        </a>
        <? else: ?>
           
            <div class="mobilemenu__nav__link js--mobilemenu-linkslide">
            <?= $arItem["TEXT"] ?></span>
            <i class="js--mobilemenu-linkslide"><svg>
                                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arror-right"></use>
                                    </svg></i>
        </div>
        <? endif ?>

        <div class="mobilemenu__nav__sub">
            <div class="container">
            <a class="mobilemenu__nav__sub__head js--mobilemenu-close" href="#"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arror-left"></use>
                                            </svg></i><span><?= $arItem["TEXT"] ?></span></a>
                                            <div class="mobilemenu__nav__sub__body">
            <!-- <div class="mobilemenu__popup__title"><?= $arItem["TEXT"] ?></div> -->
                <ul class="">
            <!-- <ul class="header__nav__submenu"> -->
                <? else: ?>
                <li class="">
                    <? if ($curDir == $arItem["LINK"]): ?>
                        <a  class=""><?= $arItem["TEXT"] ?></a>
                    <? else: ?>
                        <a  class=""><?= $arItem["TEXT"] ?></a>
                    <? endif ?>
                    <div class="mobilemenu__nav__sub">
                        <div class="container">
                        <a class="mobilemenu__nav__sub__head js--mobilemenu-close" href="#"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arror-left"></use>
                                            </svg></i><span><?= $arItem["TEXT"] ?></span></a>
                        <!-- <div class="mobilemenu__popup__title js--mobilemenu-link-close"><?= $arItem["TEXT"] ?></div> -->
                        <div class="mobilemenu__nav__sub__body">
                            <ul class="">
                <? endif ?>

    <? else: ?>

                                <? if ($arItem["PERMISSION"] > "D"): ?>

                                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                                        <li class="mobilemenu__nav__item">
                                            <? if ($curDir == $arItem["LINK"]): ?>
                                                <div  class="mobilemenu__nav__link"><?= $arItem["TEXT"] ?></div>
                                            <? else: ?>
                                                
                                                <a  class="mobilemenu__nav__link" href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?>
                                            </a>
                                           
                                                    
                                            <? endif ?>
                                        </li>
                                    <? else: ?>

                                        <li class="mobilemenu__sub__item">
                                            <? if ($curDir == $arItem["LINK"]): ?>
                                                <a class="mobilemenu__sub__link"><?= $arItem["TEXT"] ?></a>
                                            <? else: ?>
                                                <a href="<?= $arItem["LINK"] ?>" class="mobilemenu__sub__link"><?= $arItem["TEXT"] ?></a>
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
                       
