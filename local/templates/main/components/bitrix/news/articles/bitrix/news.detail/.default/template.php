<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>

<div class="page__content">
    <div class="page__content__maxwidth">
        <div class="article">
            <div class="article__head">
                <div class="article__head__img"><img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ? $arResult["DETAIL_PICTURE"]["SRC"] : $arResult["PREVIEW_PICTURE"]["SRC"]  ?>" alt="<?= $arResult["NAME"] ?>" title="<?= $arResult["NAME"] ?> в LKDENTAL"/></div>
                    <div class="article__head__title">
                        <h1 class="h1"><?= $arResult["NAME"] ?></h1>
                    </div>
                    <div class="article__head__date"><i><svg>
                                <use xlink:href="<?= SITE_TEMPLATE_PATH?>/img/icons.svg#ic-calendar"></use>
                            </svg></i><span><?if($arResult["PROPERTIES"]["U_DATE_PUB"]["VALUE"]){echo($arResult["PROPERTIES"]["U_DATE_PUB"]["VALUE"]);}else{$dateCreate = CIBlockFormatProperties::DateFormat('d.m.Y', MakeTimeStamp($arResult["DATE_CREATE"], CSite::GetDateFormat()));
                        echo $dateCreate;}?></span>
                    </div>
            </div>
            <div class="article__content">
                <div class="block__text">
                    <?= html_entity_decode($arResult["DETAIL_TEXT"]) ?>
                </div>
            </div>
        </div>
    </div>
</div>





                



