<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты ");
$APPLICATION->SetTitle("Контакты");
$APPLICATION->SetPageProperty("title", "Контакты |  LKDENTAL");
$APPLICATION->SetPageProperty("description", "Контакты | LKDENTAL");
$APPLICATION->SetPageProperty("H1", "Контакты");
  
?>
<section class="block__padd block__padd__nofirst">
            <div class="container">
                <div class="crumbs__offset"></div>
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
                <div class="contacts row">
                    <div class="col-12 col-lg-4">
                        <div class="contacts__info">
                            <h2 class="h2">Краснодар</h2>
                            <ul class="contacts__list">
                                <li>
                                    <div class="contacts__card"><span class="contacts__card__icon"><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-address"></use>
                                            </svg></span><span class="contacts__card__body"><?=$GLOBALS["SETTINGS"]["ADRESS"]?></span></div>
                                </li>
                                <li><a class="contacts__card" href="tel:<?=$GLOBALS["SETTINGS"]["PHONE"]?>"><span class="contacts__card__icon"><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-phone"></use>
                                            </svg></span><span class="contacts__card__body"><?=$GLOBALS["SETTINGS"]["PHONE"]?></span></a></li>
                                <li>
                                    <div class="contacts__card"><span class="contacts__card__icon"><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-clock"></use>
                                            </svg></span><span class="contacts__card__body"><?=$GLOBALS["SETTINGS"]["SCHEDULE"]?></span></div>
                                </li>
                            </ul>
                        </div>
                    </div>
             
                    <div class="col-12 col-lg-8 block__overflow">
                        <div class="contacts__map">
                            <div class="contacts__map__body" id="js--map"  data-koord="<?=$GLOBALS["SETTINGS"]["COORDINATES"]?>" data-adress="<?=$GLOBALS["SETTINGS"]["ADRESS_COORD"]?>" data-name="<?=$GLOBALS["SETTINGS"]["NAME_COORD"]?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
	    // global $APPLICATION;
	
	    // use Bitrix\Main\Page\Asset;
        //   Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/v3/?apikey=c0dd80e9-68b9-441a-8aa7-2=ru_RU" type="text/javascript"></script>');
        // Asset::getInstance()->addString('<script src="https://api-maps.yandex.ru/2.1/?apikey=c0dd80e9-68b9-441a-8aa7-2aab17cedef9&amp;lang=ru_RU"></script>');?>
        

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>