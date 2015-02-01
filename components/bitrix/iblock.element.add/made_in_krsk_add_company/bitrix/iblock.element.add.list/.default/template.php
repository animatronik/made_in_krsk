<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//echo "<pre>"; print_r($arParams); echo "</pre>";
//echo "<pre>"; print_r($arResult); echo "</pre>";
$colspan = 2;
if ($arResult["CAN_EDIT"] == "Y") $colspan++;
if ($arResult["CAN_DELETE"] == "Y") $colspan++;
?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?=ShowNote($arResult["MESSAGE"])?>
<?endif?>

<h2><?=GetMessage("IBLOCK_ADD_LIST_TITLE")?></h2>

<?if($arResult["NO_USER"] == "N"):?>
	<?if (count($arResult["ELEMENTS"]) > 0):?>
		<?foreach ($arResult["ELEMENTS"] as $arElement):?>
			<div class="firm-edit">
				<?if ($arResult["CAN_EDIT"] == "Y"):?>
					<?if ($arElement["CAN_EDIT"] == "Y"):?>
						<a href="<?=$arParams["EDIT_URL"]?>?edit=Y&amp;CODE=<?=$arElement["ID"]?>"><?=GetMessage("IBLOCK_ADD_LIST_EDIT")?></a>
						<?else:?>&nbsp;
					<?endif?>
				<?endif?>
				<?if ($arResult["CAN_DELETE"] == "Y"):?>
					<?if ($arElement["CAN_DELETE"] == "Y"):?>
						<a href="?delete=Y&amp;CODE=<?=$arElement["ID"]?>&amp;<?=bitrix_sessid_get()?>" onClick="return confirm('<?echo CUtil::JSEscape(str_replace("#ELEMENT_NAME#", $arElement["NAME"], GetMessage("IBLOCK_ADD_LIST_DELETE_CONFIRM")))?>')"><?=GetMessage("IBLOCK_ADD_LIST_DELETE")?></a>
						<?else:?>&nbsp;
					<?endif?>
				<?endif?>
			</div>

			<div class="firm-head">
				<h3><?=$arElement["NAME"]?></h3>
				<span class="firm-logo">
					<?if ($arElement["PREVIEW_PICTURE"]):?>
						<img src="<?=CFile::GetPath($arElement["PREVIEW_PICTURE"])?>" width="200">
					<?endif?>
				</span>
			</div>

			<div class="firm-info">
				<?=$arElement["PREVIEW_TEXT"];?>
			</div>
		<?endforeach?>
	<?else:?>		
		<?=GetMessage("IBLOCK_ADD_LIST_EMPTY")?>		
	<?endif?>
<?endif?>
<div class="add-element">
<?if ($arParams["MAX_USER_ENTRIES"] > 0 && $arResult["ELEMENTS_COUNT"] < $arParams["MAX_USER_ENTRIES"]):?><a class="bt_blue big" href="<?=$arParams["EDIT_URL"]?>?edit=Y"><?=GetMessage("IBLOCK_ADD_LINK_TITLE")?></a><?else:?><?=GetMessage("IBLOCK_LIST_CANT_ADD_MORE")?><?endif?>
</div>