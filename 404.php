<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
const HIDE_SIDEBAR = true;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/** @global CMain $APPLICATION */?>
<section class="page__404">
	<div class="container">
		<div class="page__404__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/img-page404.png" alt="" /></div>
		<div class="page__404__body">
			<div class="page__404__title">
				<h1 class="h1">Страница не найдена</h1>
			</div>
			<div class="page__404__text">Мы разберемся с этим, а пока предлагаем вам вернуться на главную</div>
			<div class="page__404__more"><a class="mbtn mbtn__primary mbtn__big" href="/">На главную</a></div>
		</div>
	</div>
</section>


<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
