<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt = array();

if(CModule::IncludeModule("iblock")) {
	$res = CIBlockSection::GetList(
			  false, 
			  array(
				 "IBLOCK_ID"=> 4, // ID нужного инфоблока
				 "ACTIVE"=>"Y"
			  ),
			 false,
			 false, 
			 array( // Нужны только названиеи ссылка
				 "NAME",
				 "CODE"
			  ),
	);
	
	while($arFields = $res->Fetch()){
		$url="/catalog/".$arFields['CODE']."/";
			$aMenuLinksExt[] = Array(
				$arFields['NAME'],
				 $url,
				 Array(),
				 Array(),
				 ""
			  );
	 }
 }

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
