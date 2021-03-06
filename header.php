<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
$wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
CUtil::InitJSCore();
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>/favicon.ico" />
	<?//$APPLICATION->ShowHead();
	echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	$APPLICATION->ShowCSS(true, true);
	?>
	<link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" />
	<?
	$APPLICATION->ShowHeadStrings();
	CJSCore::Init(array("jquery"));
	$APPLICATION->ShowHeadScripts();
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");
	?>
	<title><?$APPLICATION->ShowTitle()?></title>
</head>
<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<?$APPLICATION->IncludeComponent("bitrix:eshop.banner", "", array());?>
<div class="wrap" id="bx_eshop_wrap">
	<div class="header_wrap">
		<div class="header_wrap_container">
			<div class="header_top_section">
				<div class="header_top_section_container_one">
					<div class="bx_cart_login_top">
						<table>
							<tr>
								<td>
								<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "", array(
										"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
										"PATH_TO_PERSONAL" => SITE_DIR."personal/",
										"SHOW_PERSONAL_LINK" => "N",
										"SHOW_NUM_PRODUCTS" => "Y",
										"SHOW_TOTAL_PRICE" => "Y",
										"SHOW_PRODUCTS" => "N",
										"POSITION_FIXED" =>"N"
									),
									false,
									array()
								);?>
								</td>
								<td>
								<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "eshop_adapt", array(
										"REGISTER_URL" => SITE_DIR."login/",
										"PROFILE_URL" => SITE_DIR."personal/",
										"SHOW_ERRORS" => "N"
									),
									false,
									array()
								);?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="header_top_section_container_two">
					<?$APPLICATION->IncludeComponent('bitrix:menu', "top_menu", array(
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "Y",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"MAX_LEVEL" => "1",
							"USE_EXT" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						)
					);?>
				</div>
				<div class="clb"></div>
			</div> <!-- //header_top_section -->

			<div class="header_inner" itemscope itemtype = "http://schema.org/LocalBusiness">
				<div class="head_main>">
					<div class="logo"></div>
					<h1 class="site_title">
						<a <?if ($curPage != SITE_DIR."index.php"):?>class="site_title"<?endif?> href="<?=SITE_DIR?>" itemprop = "name">Сделано в Красноярском крае</a>
					</h1>
					<div class="description_title">Вся продукция Красноярского края в одном месте</div>
				</div>

			<!--
				<div class="header_inner_container_one">
					<div class="header_inner_include_aria"><span style="color: #1b5c79;">
							<strong style="display: inline-block;padding-top: 7px;"><a style="text-decoration: none;color:#1b5c79;" href="<?=SITE_DIR?>about/contacts/" itemprop = "telephone"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></a></strong><br />
							<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/schedule.php"), false);?></span>
					</div>
				</div>
			-->
			
				<div class="header_inner_container_two">
					<?$APPLICATION->IncludeComponent("bitrix:search.title", "visual", array(
							"NUM_CATEGORIES" => "1",
							"TOP_COUNT" => "5",
							"CHECK_DATES" => "N",
							"SHOW_OTHERS" => "N",
							"PAGE" => SITE_DIR."catalog/",
							"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
							"CATEGORY_0" => array(
								0 => "iblock_catalog",
							),
							"CATEGORY_0_iblock_catalog" => array(
								0 => "all",
							),
							"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
							"SHOW_INPUT" => "Y",
							"INPUT_ID" => "title-search-input",
							"CONTAINER_ID" => "search",
							"PRICE_CODE" => array(
								0 => "BASE",
							),
							"SHOW_PREVIEW" => "Y",
							"PREVIEW_WIDTH" => "75",
							"PREVIEW_HEIGHT" => "75",
							"CONVERT_CURRENCY" => "Y"
						),
						false
					);?>
				</div>

				<div class="clb"></div>

				<div class="header_inner_bottom_line_container">
					<div class="header_inner_bottom_line">
						
						
						<?if ($wizTemplateId == "eshop_adapt_horizontal"):?>
						<?$APPLICATION->IncludeComponent("bitrix:menu", "catalog_horizontal", array(
	"ROOT_MENU_TYPE" => "left",
	"MENU_THEME" => "site",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "3",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
						<?endif?>
						
					</div>
					
				</div><!-- //header_inner_bottom_line_container -->			

			</div>  <!-- //header_inner -->
			<?if ($APPLICATION->GetCurPage(true) == SITE_DIR."index.php"):?>
				<div class="slider">
					<?$APPLICATION->IncludeComponent("bisexpert:owlslider", ".default", array(
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"MAIN_TYPE" => "iblock",
	"COUNT" => "8",
	"IBLOCK_TYPE" => "references",
	"IBLOCK_ID" => "10",
	"LINK_URL_PROPERTY_ID" => "50",
	"TEXT_PROPERTY_ID" => "49",
	"SECTION_ID" => "0",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SORT_FIELD_1" => "timestamp_x",
	"SORT_DIR_1" => "asc",
	"SORT_FIELD_2" => "",
	"SORT_DIR_2" => "asc",
	"WIDTH_RESIZE" => "",
	"HEIGHT_RESIZE" => "",
	"IS_PROPORTIONAL" => "Y",
	"ENABLE_OWL_CSS_AND_JS" => "Y",
	"ENABLE_JQUERY" => "N",
	"RESPONSIVE" => "Y",
	"COMPOSITE" => "Y",
	"AUTO_PLAY" => "Y",
	"AUTO_PLAY_SPEED" => "5000",
	"SCROLL_COUNT" => "1",
	"SPECIAL_CODE" => "unic",
	"AUTO_HEIGHT" => "Y",
	"RANDOM_TRANSITION" => "N",
	"TRANSITION_TYPE_FOR_ONE_ITEM" => "softScale-next",
	"SLIDE_SPEED" => "200",
	"PAGINATION_SPEED" => "800",
	"REWIND_SPEED" => "1000",
	"STOP_ON_HOVER" => "Y",
	"IMAGE_CENTER" => "Y",
	"RANDOM" => "N",
	"SHOW_DESCRIPTION_BLOCK" => "Y",
	"NAVIGATION" => "Y",
	"NAVIGATION_TYPE" => "text",
	"PAGINATION" => "N",
	"PAGINATION_NUMBERS" => "N",
	"DRAG_BEFORE_ANIM_FINISH" => "Y",
	"MOUSE_DRAG" => "Y",
	"TOUCH_DRAG" => "Y",
	"ITEMS_SCALE_UP" => "Y",
	"DISABLE_LINK_DEV" => "N",
	"NAVIGATION_TEXT_BACK" => "назад",
	"NAVIGATION_TEXT_NEXT" => "вперед"
	),
	false
);?>
				<?endif?>
			</div>
		</div> <!-- //header_wrap_container -->
	</div> <!-- //header_wrap -->

	<div class="workarea_wrap">
		<div class="worakarea_wrap_container workarea <?if ($wizTemplateId == "eshop_adapt_vertical"):?>grid1x3<?else:?>grid<?endif?>">
			<div id="navigation">
				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
						"START_FROM" => "0",
						"PATH" => "",
						"SITE_ID" => "-"
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);?>
			</div>
			<div class="bx_content_section">
				<?if ($curPage != SITE_DIR."index.php"):?>
				<h1><?=$APPLICATION->ShowTitle(false);?></h1>
				<?endif?>
		
		
		