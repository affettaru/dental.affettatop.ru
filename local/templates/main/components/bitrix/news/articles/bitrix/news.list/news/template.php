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
// $emptyImage = SITE_TEMPLATE_PATH . "/img/blog/img-blog-6.jpg";
?>
 <div class="bloglist row">
    <?php foreach($arResult["ITEMS"] as $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $id = $this->GetEditAreaId($arItem['ID']);
        if($arItem['PREVIEW_PICTURE']){
            $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>700, 'height'=>'700'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); 
        }else{
            $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width'=>700, 'height'=>'700'), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true); }
        ?>

        <div class="bloglist__item col-12 col-md-6 col-xl-4">
            <div class="bloglist__card"><a class="bloglist__card__link" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"></a>
                <div class="bloglist__card__img"><img src="<?=$file["src"]?>" alt="<?= $arItem["NAME"] ?>" title="<?= $arItem["NAME"] ?> в LKDENTAL"/></div>
                <div class="bloglist__card__date"><?if($arItem["PROPERTIES"]["U_DATE_PUB"]["VALUE"]){echo($arItem["PROPERTIES"]["U_DATE_PUB"]["VALUE"]);}else{$dateCreate = CIBlockFormatProperties::DateFormat('d.m.Y', MakeTimeStamp($arItem["DATE_CREATE"], CSite::GetDateFormat()));
                        echo $dateCreate;}?></div>
                <div class="bloglist__card__title"><?= $arItem["NAME"] ?></div>
                <div class="bloglist__card__text"><?= $arItem["PREVIEW_TEXT"] ? $arItem["PREVIEW_TEXT"] : $arItem["DETAIL_TEXT"] ?></div>
            </div>
        </div>
    <?endforeach;?>              
    <!-- </div> -->
<?= $arResult["NAV_STRING"] ?>
</div>
           