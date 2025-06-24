<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} ?>
<!DOCTYPE html>
<html lang=ru>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<?php
	global $APPLICATION;

	use Bitrix\Main\Page\Asset;
    $asset = \Bitrix\Main\Page\Asset::getInstance();
    CJSCore::Init(array("jquery"));
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/bootstrap-reboot.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/bootstrap-grid.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/fancybox.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/simplebar.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/assets/css/swiper-bundle.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/font.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.css?v=1745009488815");

    // $asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/fancybox.umd.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/swiper-bundle.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/inputmask.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/custom-select.min.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/intlTelInputWithUtils.min.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/app.js');
	
	Asset::getInstance()->addString('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">');
	Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">');

	// Asset::getInstance()->addString(
	// 	'<link rel="shortcut icon" href="' . SITE_TEMPLATE_PATH .'/img/favicon/favicon.ico" type="image/x-icon">'
	// );
    Asset::getInstance()->addString(
		'<link rel="android-chrome-icon" href="' . SITE_TEMPLATE_PATH .'/img/favicon/android-chrome-512x512.png" sizes="512x512">'
	);
    Asset::getInstance()->addString(
		'<link rel="android-chrome-icon" href="' . SITE_TEMPLATE_PATH .'/img/favicon/android-chrome-192x192.png" sizes="192x192">'
	);
    Asset::getInstance()->addString(
		'<link rel="apple-touch-icon" href="' . SITE_TEMPLATE_PATH .'/img/favicon/apple-touch-icon.png" sizes="180x180">'
	);
    Asset::getInstance()->addString(
		'<link rel="icon" href="' . SITE_TEMPLATE_PATH .'/img/favicon/favicon-32x32.png" type="image/png" sizes="32x32">'
	);
    Asset::getInstance()->addString(
		'<link rel="icon" href="' . SITE_TEMPLATE_PATH .'img/favicon/favicon-16x16.png" type="image/png" sizes="16x16">'
	);
	if ($_GET["PAGEN_1"] || $_GET["PAGEN_2"] || $_GET["PAGEN_3"]) {
		Asset::getInstance()->addString('<link rel="canonical" href="' . $APPLICATION->GetCurPage() . '"/>');
	}
	

    $APPLICATION->ShowMeta("robots");
    $APPLICATION->ShowCSS();
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    $APPLICATION->ShowMeta("description");


	?>
   <title><?=$APPLICATION->ShowTitle()?></title>
   <?if ($APPLICATION->GetCurPage(false) === '/'): ?>
        <meta property="og:title" content='dental.ru интернет-магазин'>
        <meta property="og:type" content='website'>
        <meta property="og:url" content='https:/dental.ru/'>
        <meta property="og:image" content="<?=SITE_TEMPLATE_PATH?>/img/favicon/android-chrome-512x512.png">
    <?endif;?>
    <?php  html_entity_decode($GLOBALS["CONTACTS"]["beforeHead"]) ?>
</head>


<?= $APPLICATION->ShowPanel() ?>
<body>



    <header class="header js--header">
        <div class="header__top d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center justify-content-between flex-nowrap">
                    <div class="col-auto">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "subtop",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                        )
                    ); ?>
                    </div>
                    <div class="col-auto">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <ul class="header__info">
                                    <li><a class="header__info__card" href="https://t.me/<?=$GLOBALS["SETTINGS"]["telegram_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-tg"></use>
                                                </svg></i><span>Telegram</span></a></li>
                                    <li><a class="header__info__card" href="whatsapp://send?phone=<?=$GLOBALS["SETTINGS"]["whatsapp_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-wa"></use>
                                                </svg></i><span>WhatsApp</span></a></li>
                                </ul>
                            </div>
                            <div class="col-auto"><a class="mbtn mbtn__primary mbtn__middle" data-fancybox-html="data-fancybox-html" href="#js--modal-feedback">Связаться с нами</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__bottom">
            <div class="container">
                <div class="header__boxgrey">
                    <div class="header__boxgrey__row row align-items-center">
                        <div class="col-auto"><a class="header__logo" href="/"><img src="<?=SITE_TEMPLATE_PATH?>/img/header-logo.png" alt="" /></a></div>
                        <div class="col d-none d-lg-block">
                            <div class="header__search">
                            <form action="/search/">
                        <input class="header__search__input" type="text" placeholder="Поиск" name="q" autocomplete="off">
                        <!-- <button type="submit" class="btn btn-prim">Найти</button> -->
                    </form>
                                <!-- <form action="#"><input class="header__search__input" type="text" placeholder="Поиск" /></form> -->
                            </div>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <div class="header__contacts"><a class="header__contacts__card" href="tel:<?=$GLOBALS["SETTINGS"]["PHONE"]?>"><span><?=$GLOBALS["SETTINGS"]["PHONE"]?></span><i><svg>
                                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                        </svg></i></a>
                                <div class="header__contacts__popup">
                                    <ul>
                                        <li><a href="mailto:<?=$GLOBALS["SETTINGS"]["MAIL"]?>"><?=$GLOBALS["SETTINGS"]["MAIL"]?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"store_v3_inline", 
	array(
		"HIDE_ON_BASKET_PAGES" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "Y",
		"POSITION_HORIZONTAL" => "right",
		"POSITION_VERTICAL" => "top",
		"SHOW_AUTHOR" => "N",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRODUCTS" => "N",
		"SHOW_REGISTRATION" => "N",
		"SHOW_TOTAL_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => "store_v3_inline"
	),
	false
);?>
                        <!-- <div class="col-auto d-none d-lg-block"><a class="header__tocard" href="#"><span><svg>
                                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-cart"></use>
                                    </svg></span><i>50</i></a></div> -->
                        <div class="col-auto d-lg-none ms-auto">
                            <div class="header__btnmenu js--mobilemenu-btn"><span class="line__0"></span><span class="line__1"></span><span class="line__2"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- header end--><!-- mobile menu-->
    <div class="mobilemenu js--mobilemenu">
        <div class="mobilemenu__body">
            <div class="container">
                <div class="mobilemenu__line">
                    <div class="mobilemenu__search">
                        <form action="#"><input class="mobilemenu__search__input" type="text" placeholder="Поиск" /></form>
                    </div>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top_mobile",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "subtop",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "2",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top",
                            "USE_EXT" => "Y",
                        )
                    ); ?> 
                </div>
            </div>
        </div>
        <div class="mobilemenu__footer">
            <div class="container">
                <div class="mobilemenu__line">
                    <ul class="mobilemenu__contacts">
                        <li><a class="mobilemenu__contacts__phone" href="tel:<?=$GLOBALS["SETTINGS"]["PHONE"]?>"><?=$GLOBALS["SETTINGS"]["PHONE"]?></a></li>
                        <li><a class="mobilemenu__contacts__mail" href="mailto:<?=$GLOBALS["SETTINGS"]["MAIL"]?>"><?=$GLOBALS["SETTINGS"]["MAIL"]?></a></li>
                        <li><a class="mobilemenu__contacts__socio" href="https://t.me/<?=$GLOBALS["SETTINGS"]["telegram_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-tg"></use>
                                    </svg></i><span>Telegram</span></a></li>
                        <li><a class="mobilemenu__contacts__socio" href="whatsapp://send?phone=<?=$GLOBALS["SETTINGS"]["whatsapp_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                        <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-wa"></use>
                                    </svg></i><span>WhatsApp</span></a></li>
                    </ul>
                </div>
                <div class="mobilemenu__line"><a class="mbtn mbtn__primary mbtn__middle d-block w-100" href="#">Связаться с нами</a></div>
            </div>
        </div>
    </div><!-- mobile menu-->
    <main class="main <?if( $APPLICATION->GetCurDir() != "/"){?> main__inside<?}?>"><!-- welcome-->

    <?php if($APPLICATION->GetCurDir() != "/"
    // && !defined('ERROR_404')
    // && !CSite::InDir('/news/')
    // && !CSite::InDir('/about/articles/')
    // && !CSite::InDir('/about/vacancies/')
    // && !CSite::InDir('/catalog/')
    // && !CSite::InDir('/search/')
): ?>

    <!-- <section class="bread">
        <div class="container">
            <div class="bread__inner">
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
                <h1><?= $APPLICATION->ShowTitle() ?></h1>
            </div>
        </div>
    </section> -->
<?php endif ?>




