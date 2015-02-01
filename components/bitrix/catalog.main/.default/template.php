<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="catalog-main">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<li>
	<div>
		<?if($arItem["LIST_PAGE_URL"]):?>
			<a style="vertical-align:middle;" href="<?=$arItem["LIST_PAGE_URL"]?>">
			<div><?=$arItem["NAME"]?></div>
			<?if(is_array($arItem["PICTURE"])):?>
				<img style="vertical-align:middle;" border="0" src="<?=$arItem["PICTURE"]["SRC"]?>" width="150px" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
			<?endif?>
			</a>
		<?else:?>
			<span style="vertical-align:middle;"><?=$arItem["NAME"]?></span>
		<?endif?>
	</div>	
	</li>
<?endforeach?>
</ul>
