<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("О компании");
$APPLICATION->SetPageProperty("title", "О компании | LKDENTAL");
$APPLICATION->SetPageProperty("description", "О компании| LKDENTAL");
$APPLICATION->SetPageProperty("H1", "О компании");
?>

<section class="block__padd block__padd__nofirst">
            <div class="container">
			<?php
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
                <div class="aboutwelcome">
				<?
				$rs = CIBlockElement::GetList (
					Array(),
					Array("IBLOCK_ID" => 11),
					false,
					Array (), array("PROPERTY_U_BL1_HEAD", "PROPERTY_U_BL1_TEXT", "PROPERTY_U_BL1_IMG", "PROPERTY_U_BL1_LINK")
				);
				while($ar = $rs->GetNext()) {
					$el=$ar;
				}?>
				
                    <div class="aboutwelcome__bg">
                        <picture>
                            <source media="(min-width: 992px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL1_IMG_VALUE"])?>" />
                            <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL1_IMG_VALUE"])?>" /><img src="<?=CFile::GetPath($el["PROPERTY_U_BL1_IMG_VALUE"])?>" alt="" />
                        </picture>
                    </div>
                    <div class="aboutwelcome__content">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="aboutwelcome__body">
                                    <div class="block__text">
                                        <h2><?=$el["PROPERTY_U_BL1_HEAD_VALUE"]?></h2>
										
                                        <?=html_entity_decode($el["PROPERTY_U_BL1_TEXT_VALUE"]["TEXT"])?>
                                    </div>
                                </div>
                                <div class="aboutwelcome__more"><a class="mbtn mbtn__primary mbtn__middle" href=" <?=$el["PROPERTY_U_BL1_LINK_VALUE"]?>">Посмотреть каталог</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="aboutstatistics">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10">
                            <div class="row justify-content-between">
								<?unset($el);
								$rs = CIBlockElement::GetList (
									Array(),
									Array("IBLOCK_ID" => 11),
									false,
									Array (), array("PROPERTY_U_BL2")
								);
								while($ar = $rs->GetNext()) {
									$el[]=$ar;
								}?>	
								<?  foreach ($el as $DELIVERY){?>
                                <div class="aboutstatistics__item col-6 col-md-auto">
                                    <div class="aboutstatistics__card">
									<?=html_entity_decode($DELIVERY["PROPERTY_U_BL2_VALUE"]["TEXT"])?>
										
                                    </div>
                                </div>
								<?}?>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="aboutlist"><!-- el-->
				<?unset($el);
								$rs = CIBlockElement::GetList (
									Array(),
									Array("IBLOCK_ID" => 11),
									false,
									Array (), array("PROPERTY_U_BL3_HEAD","PROPERTY_U_BL4_HEAD","PROPERTY_U_BL5_HEAD","PROPERTY_U_BL6_HEAD","PROPERTY_U_BL3_TEXT","PROPERTY_U_BL4_TEXT","PROPERTY_U_BL5_TEXT","PROPERTY_U_BL6_TEXT","PROPERTY_U_BL3_IMG","PROPERTY_U_BL4_IMG","PROPERTY_U_BL5_IMG","PROPERTY_U_BL6_IMG")
								);
								while($ar = $rs->GetNext()) {
									$el=$ar;
								}?>	
                    <div class="aboutlist__item">
                        <div class="aboutlist__card row">
                            <div class="col-12 col-lg-8 order-1">
                                <div class="aboutlist__card__content">
                                    <div class="block__text">
                                        <h2><?=$el["PROPERTY_U_BL3_HEAD_VALUE"]?></h2>
										<?=html_entity_decode($el["PROPERTY_U_BL3_TEXT_VALUE"]["TEXT"])?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 order-2">
                                <div class="aboutlist__card__img">
                                    <picture>
                                        <source media="(min-width: 992px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL3_IMG_VALUE"])?>" />
                                        <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL3_IMG_VALUE"])?>" /><img src="<?=CFile::GetPath($el["PROPERTY_U_BL3_IMG_VALUE"])?>" alt="" />
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div><!-- /el-->
                </div>
                <div class="aboutfavlist"><!-- el-->
                    <div class="aboutfavlist__item">
                        <div class="aboutfavlist__card row">
                            <div class="col-12 col-lg-4 align-self-center order-1 order-lg-1">
                                <div class="aboutfavlist__card__content">
                                    <div class="block__text">
                                        <h2><?=$el["PROPERTY_U_BL4_HEAD_VALUE"]?></h2>
										<?=html_entity_decode($el["PROPERTY_U_BL4_TEXT_VALUE"]["TEXT"])?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 order-2 order-lg-2">
                                <div class="aboutfavlist__card__img">
                                    <picture>
                                        <source media="(min-width: 992px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL4_IMG_VALUE"])?>" />
                                        <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL4_IMG_VALUE"])?>" /><img src="<?=CFile::GetPath($el["PROPERTY_U_BL4_IMG_VALUE"])?>" alt="" />
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div><!-- /el--><!-- el-->
                    <div class="aboutfavlist__item">
                        <div class="aboutfavlist__card row">
                            <div class="col-12 col-lg-4 align-self-center order-1 order-lg-2">
                                <div class="aboutfavlist__card__content">
                                    <div class="block__text">
                                        <h2><?=$el["PROPERTY_U_BL5_HEAD_VALUE"]?></h2>
										<?=html_entity_decode($el["PROPERTY_U_BL5_TEXT_VALUE"]["TEXT"])?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 order-2 order-lg-1">
                                <div class="aboutfavlist__card__img">
                                    <picture>
                                        <source media="(min-width: 992px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL5_IMG_VALUE"])?>" />
                                        <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL5_IMG_VALUE"])?>" /><img src="<?=CFile::GetPath($el["PROPERTY_U_BL5_IMG_VALUE"])?>" alt="" />
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div><!-- /el--><!-- el-->
                    <div class="aboutfavlist__item">
                        <div class="aboutfavlist__card row">
                            <div class="col-12 col-lg-4 align-self-center order-1 order-lg-1">
                                <div class="aboutfavlist__card__content">
                                    <div class="block__text">
                                        <h2><?=$el["PROPERTY_U_BL6_HEAD_VALUE"]?></h2>
										<?=html_entity_decode($el["PROPERTY_U_BL6_TEXT_VALUE"]["TEXT"])?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8 order-2 order-lg-2">
                                <div class="aboutfavlist__card__img">
                                    <picture>
                                        <source media="(min-width: 992px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL6_IMG_VALUE"])?>" />
                                        <source media="(max-width: 991px)" srcset="<?=CFile::GetPath($el["PROPERTY_U_BL6_IMG_VALUE"])?>" /><img src="<?=CFile::GetPath($el["PROPERTY_U_BL6_IMG_VALUE"])?>" alt="" />
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div><!-- /el-->
                </div>
            </div>
        </section><!-- /page--><!-- reviews-->
        <section class="block__padd block__overflow">
            <div class="container">
                <h2 class="h2">Что о нас говорят клиенты</h2>
                <div class="stslider__offset js--reviewsslider-offset"></div>
                <div class="reviews">
                    <div class="stslider js--reviewsslider-wrap">
                        <div class="stslider__body">
                            <div class="stslider__slider swiper js--reviewsslider">
                                <div class="swiper-wrapper"><!-- el-->
								<?
				$rs = CIBlockElement::GetList (
					Array(),
					Array("IBLOCK_ID" => 11),
					false,
					Array (), array("PROPERTY_U_BL7")
				);
				unset($elN);
				while($ar = $rs->GetNext()) {
					
					$elN[]=$ar;
				}?>
						<?  foreach ($elN as $DELIVERY){
							  unset($elD);
							$rsD = CIBlockElement::GetList (
								Array(),
								Array("IBLOCK_ID" => 12,"ID"=>$DELIVERY["PROPERTY_U_BL7_VALUE"]),
								false,
								Array (), array("NAME","PREVIEW_TEXT","PROPERTY_U_ORGANIZ","PROPERTY_U_DATE")
							);
							
							while($arD = $rsD->GetNext()) {
								
								$elD[]=$arD;
							}?>
							<?  foreach ($elD as $DELIVERY2){?>
                                    <div class="stslider__slider__item w-card-review swiper-slide">
                                        <div class="reviews__card js--review-card">
                                            <div class="reviews__card__head row">
                                                <div class="col"><span class="reviews__card__name"><?=$DELIVERY2["NAME"]?></span><span class="reviews__card__firma"></span><span class="reviews__card__firma"><?=$DELIVERY2["PROPERTY_U_ORGANIZ_VALUE"]?> </span></div>
                                                <div class="col-auto"><span class="reviews__card__date"><?=$DELIVERY2["PROPERTY_U_DATE_VALUE"]?></span></div>
                                            </div>
                                            <div class="reviews__card__des">
                                                <div class="block__text"><?=html_entity_decode($DELIVERY2["PREVIEW_TEXT"])?></div>
                                            </div>
                                            <div class="reviews__card__footer"><a class="reviews__card__more js--review-more" href="#"><span>Подробнее</span><i><svg>
                                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-down"></use>
                                                        </svg></i></a></div>
                                        </div>
                                    </div>
									<?}}?>
									
                                </div>
                            </div>
                        </div>
                        <div class="stslider__nav">
                            <div class="stslider__nav__btn js--reviewsslider-prev"><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-prev"></use>
                                </svg></div>
                            <div class="stslider__nav__btn js--reviewsslider-next"><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-next"></use>
                                </svg></div>
                        </div>
                        <div class="stslider__pag js--reviewsslider-pag"><span class="stslider__pag__bullet active"></span><span class="stslider__pag__bullet"></span><span class="stslider__pag__bullet"></span></div>
                    </div>
                </div>
            </div>
        </section><!-- /reviews--><!-- certificates-->
        <section class="block__padd block__overflow">
            <div class="container">
                <h2 class="h2">Сертификаты</h2>
                <div class="stslider__offset js--certslider-offset"></div>
                <div class="certificates">
                    <div class="stslider js--certslider-wrap">
                        <div class="stslider__body">
                            <div class="stslider__slider swiper js--certslider">
                                <div class="swiper-wrapper"><!-- el-->
								<?unset($el);
								$rs = CIBlockElement::GetList (
									Array(),
									Array("IBLOCK_ID" => 11),
									false,
									Array (), array("PROPERTY_U_BL8_FILES")
								);
								while($ar = $rs->GetNext()) {
									$el[]=$ar;
								}?>	
								<?  foreach ($el as $DELIVERY){?>
                                    <div class="stslider__slider__item w-card-cert swiper-slide"><a class="certificates__card" href="<?=CFile::GetPath($DELIVERY["PROPERTY_U_BL8_FILES_VALUE"])?>" data-fancybox="cert"><span><img src="<?=CFile::GetPath($DELIVERY["PROPERTY_U_BL8_FILES_VALUE"])?>" alt="" /></span></a></div>
									<?}?>
                                </div>
                            </div>
                        </div>
                        <div class="stslider__nav">
                            <div class="stslider__nav__btn js--certslider-prev"><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-prev"></use>
                                </svg></div>
                            <div class="stslider__nav__btn js--certslider-next"><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-next"></use>
                                </svg></div>
                        </div>
                        <div class="stslider__pag js--certslider-pag"><span class="stslider__pag__bullet active"></span><span class="stslider__pag__bullet"></span><span class="stslider__pag__bullet"></span></div>
                    </div>
                </div>
            </div>
        </section>
		<section class="block__padd block__overflow">
            <div class="container">

                <h2 class="h2">Ответы на часто задаваемые вопросы</h2>
                <div class="faq"><!-- el-->
                   
						<?
				$rs = CIBlockElement::GetList (
					Array(),
					Array("IBLOCK_ID" => 11),
					false,
					Array (), array("PROPERTY_U_BL9_FAQ")
				);
				unset($elN);
				while($ar = $rs->GetNext()) {
					
					$elN[]=$ar;
				}?>
						<?  foreach ($elN as $DELIVERY){
							  unset($elD);
							$rsD = CIBlockElement::GetList (
								Array(),
								Array("IBLOCK_ID" => 10,"ID"=>$DELIVERY["PROPERTY_U_BL9_FAQ_VALUE"]),
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
							<?}?>
                        
                </div>
            </div>
        </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>