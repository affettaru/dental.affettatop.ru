<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    ;
} 
/**
 * @var $APPLICATION
 * @var global $config
 */

?>
<?if($APPLICATION->GetCurDir() != "/policy/"){
    if (!defined('ERROR_404')){?>
<section class="block__padd">
    <div class="container">
        <div class="invite row">
            <div class="col-12 col-lg-8">
                <div class="invite__body">
                    <h2 class="h1">Остались вопросы? Будем рады помочь!</h2>
                        <? $APPLICATION->IncludeComponent(
                            "form:feedback",
                            "bottom_order",
                            array(
                                "IBLOCK_ID" => 5,
                                "IBLOCK_TYPE" => "Forms",
                                "MAIL_EVENT" => array(
                                    0 => "CALL",
                                ),
                                "TOKEN" => "bottom_order",
                            ),
                            false
                        ); ?>
                </div>
            </div>
            <div class="col-12 col-lg-4 d-none d-lg-block">
                <div class="invite__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/img-invite.jpg" alt="" /></div>
            </div>
        </div>
    </div>
</section><!-- /invite-->
<?}}?>
    </main><!-- footer-->
    <footer class="footer">
        <div class="footer__center">
            <div class="container">
                <div class="footer__center__row row justify-content-between">
                    <div class="col-12 col-lg-auto">
                        <div class="footer__logo"><a href="/"><img src="<?=SITE_TEMPLATE_PATH?>/img/footer-logo.png" alt="" /></a></div>
                        <div class="footer__socio d-none d-lg-block">
                            <div class="footer__title">Мы в соц. сетях</div>
                            <ul class="footer__socio__list">
                                <li><a class="footer__socio__card" href="https://t.me/<?=$GLOBALS["SETTINGS"]["telegram_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-tg"></use>
                                            </svg></i><span>Telegram</span></a></li>
                                <li><a class="footer__socio__card" href="<?=$GLOBALS["SETTINGS"]["vk_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-vk"></use>
                                            </svg></i><span>Vkontakte</span></a></li>
                                <li><a class="footer__socio__card" href="<?=$GLOBALS["SETTINGS"]["dzen_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-dzen"></use>
                                            </svg></i><span>Dzen</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                  
                        <div class="footer__menu row">
                            <div class="col-12 col-lg-auto">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu", 
                                "bottom", 
                                array(
                                    "ALLOW_MULTI_SELECT" => "Y",
                                    "CHILD_MENU_TYPE" => "bottom",
                                    "DELAY" => "Y",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "bottom",
                                    "USE_EXT" => "Y",
                                    "COMPONENT_TEMPLATE" => "bottom",
                                    "MENU_CACHE_GET_VARS" => array(
                                    )
                                ),
                                false
                            ); ?>

                            </div>
                            <div class="col-12 col-lg">
                                
                                <? $APPLICATION->IncludeComponent(
                                "bitrix:menu", 
                                "bottom", 
                                array(
                                    "ALLOW_MULTI_SELECT" => "Y",
                                    "CHILD_MENU_TYPE" => "subtop",
                                    "DELAY" => "Y",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "bottom2",
                                    "USE_EXT" => "Y",
                                    "COMPONENT_TEMPLATE" => "bottom",
                                    "MENU_CACHE_GET_VARS" => array(
                                    )
                                ),
                                false
                                 ); ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-auto d-lg-none">
                        <div class="footer__socio">
                            <div class="footer__title">Мы в соц. сетях</div>
                            <ul class="footer__socio__list">
                                <li><a class="footer__socio__card" href="https://t.me/<?=$GLOBALS["SETTINGS"]["telegram_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-tg"></use>
                                            </svg></i><span>Telegram</span></a></li>
                                <li><a class="footer__socio__card" href="<?=$GLOBALS["SETTINGS"]["vk_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-vk"></use>
                                            </svg></i><span>Vkontakte</span></a></li>
                                <li><a class="footer__socio__card" href="<?=$GLOBALS["SETTINGS"]["dzen_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-dzen"></use>
                                            </svg></i><span>Dzen</span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-auto">
                        <div class="footer__socio">
                            <div class="footer__title">Свяжитесь с нами</div>
                            <ul class="footer__socio__list">
                                <li><a class="footer__socio__card" href="tel:<?=$GLOBALS["SETTINGS"]["PHONE"]?>"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-phone"></use>
                                            </svg></i><span><?=$GLOBALS["SETTINGS"]["PHONE"]?></span></a></li>
                                <li><a class="footer__socio__card" href="whatsapp://send?phone=<?=$GLOBALS["SETTINGS"]["whatsapp_LINK"]?>" target="_blank" rel="noopener noreferrer"><i><svg>
                                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-wa"></use>
                                            </svg></i><span>WhatsApp</span></a></li>
                                <li><a class="footer__socio__card" href="mailto:<?=$GLOBALS["SETTINGS"]["MAIL"]?>"><span><?=$GLOBALS["SETTINGS"]["MAIL"]?></span></a></li>
                                <li><?=$GLOBALS["SETTINGS"]["SCHEDULE"]?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-auto d-none d-lg-block"><a class="footer__btnup" href="#"><i><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-up"></use>
                                </svg></i><span>Наверх</span></a></div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="footer__info row justify-content-between align-items-center">
                    <div class="col-12 col-lg-auto">© LKDENTAL, 2025</div>
                    <div class="col-12 col-lg-auto"><a href="/policy/">Политика конфиденциальности</a></div>
                    <div class="col-12 col-lg-auto">Сделано в&nbsp;<a href="https://affetta.ru/" target="_blank" rel="noopener noreferrer">AFFETTA</a></div>
                </div>
            </div>
        </div>
    </footer><!-- end footer--><!-- Modals--><!-- Связаться с нами-->
    <div class="modal" id="js--modal-feedback">
        <div class="modal__content">
            <h2 class="h2">Связаться с нами</h2>
            <? $APPLICATION->IncludeComponent(
                "form:feedback",
                "recall",
                array(
                    "IBLOCK_ID" => 6,
                    "IBLOCK_TYPE" => "Forms",
                    "MAIL_EVENT" => array(
                        0 => "CALL",
                    ),
                    "TOKEN" => "recall",
                ),
                false
            ); ?>
        </div>
    </div><!-- Спасибо-->
    <div class="modal modal__small" id="js--modal-thanks">
        <div class="modal__content">
            <div class="modal__info">
                <h2 class="h2">Спасибо за обращение</h2>
                <div class="block__text">
                    <p><strong>Наши специалисты свяжутся с&nbsp;вами в&nbsp;ближайшее время. Спасибо!</strong></p>
                </div>
            </div>
        </div>
    </div><!-- Что-то пошло не так-->
    <div class="modal modal__small" id="js--modal-error">
        <div class="modal__content">
            <div class="modal__info">
                <h2 class="h2">Что-то пошло не так</h2>
                <div class="block__text">
                    <p><strong>Ошибка при отправке. <br />Повторите попытку позже.</strong></p>
                </div>
            </div>
        </div>
    </div><!-- Фильтр-->
    <div class="filter filter__mobile" id="js--filter">
        <div class="filter__body">
            <div class="filter__head d-xl-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="h2">Фильтры</h2>
                    </div>
                    <div class="col-auto">
                        <div class="filter__head__close js--filter-close"><svg>
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#close"></use>
                            </svg></div>
                    </div>
                </div>
            </div>
            <form class="form" action="#">
                <div class="filter__scroll__mobile" data-simplebar="data-simplebar" data-simplebar-auto-hide="false"><!-- el-->
                    <div class="filter__item">
                        <div class="filter__title js--filter-title active"><span>Цена</span><i><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                </svg></i></div>
                        <div class="filter__slide js--filter-slide">
                            <div class="filter__row row">
                                <div class="col-6"><input class="form__input form__input__mini" type="text" placeholder="От" /></div>
                                <div class="col-6"><input class="form__input form__input__mini" type="text" placeholder="До" /></div>
                            </div>
                        </div>
                    </div><!-- el--><!-- el-->
                    <div class="filter__item">
                        <div class="filter__title js--filter-title active"><span>Наличие</span><i><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                </svg></i></div>
                        <div class="filter__slide js--filter-slide">
                            <ul class="filter__list">
                                <li><label class="form__radio"><input type="checkbox" checked="checked" /><span>В наличии</span></label></li>
                                <li><label class="form__radio"><input type="checkbox" /><span>Под заказ</span></label></li>
                            </ul>
                        </div>
                    </div><!-- el--><!-- el-->
                    <div class="filter__item">
                        <div class="filter__title js--filter-title"><span>Производитель</span><i><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                </svg></i></div>
                        <div class="filter__slide js--filter-slide">
                            <div class="filter__block__content js--filter-content">
                                <div class="filter__block__scroll" data-simplebar="data-simplebar" data-simplebar-auto-hide="false">
                                    <ul class="filter__list">
                                        <li><label class="form__check form__check__big"><input type="checkbox" checked="checked" /><span>3M</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Arkona</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>BJM</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Bisco</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Colgate</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>3M</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Arkona</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>BJM</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Bisco</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Colgate</span></label></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter__showmore js--filter-more"><a class="filter__showmore__link js--filter-btnmore" href="#"><span class="default">Показать все</span><span class="active">Скрыть</span></a></div>
                        </div>
                    </div><!-- el--><!-- el-->
                    <div class="filter__item">
                        <div class="filter__title js--filter-title"><span>Страна</span><i><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                </svg></i></div>
                        <div class="filter__slide js--filter-slide">
                            <div class="filter__block__content js--filter-content">
                                <div class="filter__block__scroll" data-simplebar="data-simplebar" data-simplebar-auto-hide="false">
                                    <ul class="filter__list">
                                        <li><label class="form__check form__check__big"><input type="checkbox" checked="checked" /><span>Австрия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Бразилия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Великорбирания</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Германия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Израиль</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Испания</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Италия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Канада</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Китай</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Россия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>США</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Франция</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Чехия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Швейцария</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Швеция</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Япония</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" checked="checked" /><span>Австрия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Бразилия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Великорбирания</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Германия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Израиль</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Испания</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Италия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Канада</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Китай</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Россия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>США</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Франция</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Чехия</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Швейцария</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Швеция</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Япония</span></label></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter__showmore js--filter-more"><a class="filter__showmore__link js--filter-btnmore" href="#"><span class="default">Показать все</span><span class="active">Скрыть</span></a></div>
                        </div>
                    </div><!-- el--><!-- el-->
                    <div class="filter__item">
                        <div class="filter__title js--filter-title"><span>Линейка продукции</span><i><svg>
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/img/icons.svg#ic-arrow-down"></use>
                                </svg></i></div>
                        <div class="filter__slide js--filter-slide">
                            <div class="filter__block__content js--filter-content">
                                <div class="filter__block__scroll" data-simplebar="data-simplebar" data-simplebar-auto-hide="false">
                                    <ul class="filter__list">
                                        <li><label class="form__check form__check__big"><input type="checkbox" checked="checked" /><span>Cention N</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Ceram-X DUO</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Ceram-X MONO</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Charisma CLASSIC</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Charisma Flow</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" checked="checked" /><span>Cention N</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Ceram-X DUO</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Ceram-X MONO</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Charisma CLASSIC</span></label></li>
                                        <li><label class="form__check form__check__big"><input type="checkbox" /><span>Charisma Flow</span></label></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="filter__showmore js--filter-more"><a class="filter__showmore__link js--filter-btnmore" href="#"><span class="default">Показать все</span><span class="active">Скрыть</span></a></div>
                        </div>
                    </div><!-- el-->
                </div>
                <div class="filter__footer">
                    <div class="filter__row row">
                        <div class="col-12"><button class="mbtn mbtn__middle mbtn__grey d-block w-100" type="button">Сбросить</button></div>
                        <div class="col-12"><button class="mbtn mbtn__middle mbtn__primary d-block w-100" type="button">Показать</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php  html_entity_decode($GLOBALS["CONTACTS"]["beforeBody"]) ?>
    </body>
    <?
use Bitrix\Main\Page\Asset;
$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/fancybox.umd.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/bootstrap.bundle.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/swiper-bundle.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/inputmask.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/simplebar.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/assets/js/intlTelInputWithUtils.min.js');
$asset->addJs(SITE_TEMPLATE_PATH . '/js/app.js?v=1745009488815');
   
   ?>


</html>




