<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка и оплата");
$APPLICATION->SetPageProperty("title", "Доставка и оплата | LKDENTAL");
$APPLICATION->SetPageProperty("description", "Доставка и оплата | LKDENTAL");
$APPLICATION->SetPageProperty("H1", "Доставка и оплата");
?>

<section class="block__padd block__padd__nofirst">
            <div class="container">
			<? 
	$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "main",
            array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
            ); ?>
                 <h1 class="h1"><?= $APPLICATION->ShowTitle('H1') ?></h1>
				<?
				$rs = CIBlockElement::GetList (
					Array(),
					Array("IBLOCK_ID" => 7, "ACTIVE"=>"Y"),
					false,
					Array (), array("PREVIEW_TEXT")
				);
				while($ar = $rs->GetNext()) {
					$el=$ar;
				}?>
                <div class="page__content">
                    <div class="page__content__maxwidth">
                        <div class="page__content__text">
                            <div class="block__text">
							
							<?=html_entity_decode($el["PREVIEW_TEXT"])?>
                              
                            </div>
                        </div>
                    </div>
                </div>
				
                <div class="page__content">
                    <div class="page__content__maxwidth">
                        <h2 class="h2">Способы доставки</h2>
                        <div class="faq"><!-- el-->
						<?
				
							  unset($elD);
							$rsD = CIBlockElement::GetList (
								Array(),
								Array("IBLOCK_ID" => 10,"SECTION_ID"=>25, "ACTIVE"=>"Y"),
								false,
								Array (), array("NAME","PREVIEW_TEXT","ID")
							);
							
							while($arD = $rsD->GetNext()) {
								
								$elD[]=$arD;
							}?>
							<?  foreach ($elD as $DELIVERY2){?>
                            <div class="faq__item">
                                <div class="faq__card js--faq-card">
                                    <div class="faq__card__title">
                                        <div class="faq__card__title__body"><span><?=$DELIVERY2["NAME"]?></span></div>
                                        <div class="faq__card__title__icon js--faq-link"><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-down"></use>
                                            </svg></div>
                                    </div>
                                    <div class="faq__card__slide js--faq-slide">
                                        <div class="faq__card__body">
                                            <div class="block__text">
											<?=html_entity_decode($DELIVERY2["PREVIEW_TEXT"])?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?}?>
						
                            
                        </div>
                    </div>
                </div>
                <div class="page__content">
                    <div class="page__content__maxwidth">
                        <h2 class="h2">Способы оплаты</h2>
                        <div class="faq">
						<?
				
							  unset($elD);
							$rsD = CIBlockElement::GetList (
								Array(),
								Array("IBLOCK_ID" => 10,"SECTION_ID"=>26, "ACTIVE"=>"Y"),
								false,
								Array (), array("NAME","PREVIEW_TEXT","ID")
							);
							
							while($arD = $rsD->GetNext()) {
								
								$elD[]=$arD;
							}?>
							<?  foreach ($elD as $DELIVERY2){?><!-- el-->
                            <div class="faq__item">
                                <div class="faq__card js--faq-card">
                                    <div class="faq__card__title">
                                        <div class="faq__card__title__body"><span><?=$DELIVERY2["NAME"]?></span></div>
                                        <div class="faq__card__title__icon js--faq-link"><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-down"></use>
                                            </svg></div>
                                    </div>
                                    <div class="faq__card__slide js--faq-slide">
                                        <div class="faq__card__body">
                                            <div class="block__text">
											<?=html_entity_decode($DELIVERY2["PREVIEW_TEXT"])?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?}?>
						
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>