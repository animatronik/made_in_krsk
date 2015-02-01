<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="bx_registration_page">
	<div class="bx-auth">
<?
ShowMessage($arParams["~AUTH_RESULT"]);

if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK")
{
?>
	<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?
}
else
{
?>
	<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
		<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
	<?endif?>

	<noindex>
		<form id="formElem" method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">

			<?if (strlen($arResult["BACKURL"]) > 0):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif?>
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="REGISTRATION" />
			
			<fieldset class="step">
				<legend>Основная информация</legend>

				<p>
				<strong><span class="starrequired">*</span><?=GetMessage("AUTH_LOGIN_MIN")?></strong>
				<input type="text" name="USER_LOGIN" maxlength="20" value="<?=$arResult["USER_LOGIN"]?>" class="input_text_style" data-validation="length alphanumeric" data-validation-length="3-20" data-validation-error-msg="<?=GetMessage("AUTH_ERR_LOGIN")?>"/>
				</p>
				
				<p>
				<strong><span class="starrequired">*</span><?=GetMessage("AUTH_EMAIL")?></strong>
				<input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="input_text_style" data-validation="email" data-validation-error-msg="<?=GetMessage("AUTH_ERR_EMAIL")?>" />
				</p>
				
				<p>
				<strong><span class="starrequired">*</span><?=GetMessage("AUTH_PASSWORD_REQ")?></strong>
				<input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="input_text_style" id="pass_confirmation" data-validation="length" data-validation-length="min6" data-validation-error-msg="<?=GetMessage("AUTH_ERR_PASS")?>" />
				</p>

				<p>
				<strong><span class="starrequired">*</span><?=GetMessage("AUTH_CONFIRM")?></strong>
				<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="input_text_style" id="pass" data-validation="confirmation" data-validation-error-msg="<?=GetMessage("AUTH_ERR_PASS_CONFIRM")?>" />
				</p>
				
			</fieldset>
			
			<fieldset class="step">
				<legend>Личная информация</legend>
				
				<p>
				<strong><?=GetMessage("AUTH_NAME")?></strong>
				<input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="input_text_style" data-validation="custom required" data-validation-regexp="^[а-яА-ЯёЁa-zA-Z]+$" data-validation-error-msg="<?=GetMessage("AUTH_ERR_NAME")?>" />
				</p>
				
				<p>
				<strong><?=GetMessage("AUTH_LAST_NAME")?></strong>
				<input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="input_text_style" data-validation="custom required" data-validation-regexp="^[а-яА-ЯёЁa-zA-Z]+$" data-validation-error-msg="<?=GetMessage("AUTH_ERR_LAST_NAME")?>" />
				</p>
				
				<p>
				<strong><span class="starrequired">*</span><?=GetMessage("AUTH_PHONE")?></strong>
				<input type="text" name="UF_PHONE_NUMBER" value="" size="20" class="fields string input_text_style" data-validation="custom" data-validation-regexp="\S" data-validation-error-msg="<?=GetMessage("AUTH_ERR_PHONE")?>">
				</p>

				<p>
				<strong><span class="starrequired">*</span><?=GetMessage("AUTH_INN")?></strong>
				<input type="text" name="UF_INN" value="" size="12" maxlength="12" class="fields string input_text_style" data-validation="inn" data-validation-error-msg="<?=GetMessage("AUTH_ERR_INN")?>">
				</p>
				
				<p>
				<strong><span class="starrequired">*</span><?=GetMessage("AUTH_TYPE_OF_USER")?></strong>
							<input type="hidden" name="UF_TYPE_OF_USER" value="">
							<select class="bx-user-field-enum input_text_style" name="UF_TYPE_OF_USER">
								<option value="2" selected="">Юридическое лицо</option>
								<option value="3">ИП</option>
								<option value="1">Физическое лицо</option>
							</select>
				</p>
				
				<p>
				<? $arUserField = $arResult["USER_PROPERTIES"]["DATA"]["UF_FIRM"] ?>
				<strong><span class="required">*</span><?=$arUserField["EDIT_FORM_LABEL"]?>:</strong>
					<?$APPLICATION->IncludeComponent(
								"bitrix:system.field.edit",
								$arUserField["USER_TYPE"]["USER_TYPE_ID"],
								array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?>
				</p>
				
				
				<div>
					<!--
				<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
					<?=strLen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?>
					<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
					<?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif;?>
						<?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
							<?$APPLICATION->IncludeComponent(
								"bitrix:system.field.edit",
								$arUserField["USER_TYPE"]["USER_TYPE_ID"],
								array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?>
					<?endforeach;?>
				<?endif;?> -->
				</div>
				
			</fieldset>
			
			<!-- /User properties -->

			
			<!-- CAPTCHA -->
				<?if ($arResult["USE_CAPTCHA"] == "Y"):?>
					<strong><b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b></strong><br />

					<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br />

					<strong><span class="starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:</strong><br />
					<input type="text" name="captcha_word" maxlength="50" value="" class="input_text_style" /><br />
				<?endif?>
			<!-- /CAPTCHA -->
				
                <p class="submit">			
                	<a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a>
					<input id="submitBt" type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" class="bt_blue big shadow" />
				</p>

		</form>
		
	</noindex>
<?
}
?>
	</div>
</div>

<script src="../bitrix/templates/made_in_krsk/js/jquery.form-validator.min.js"></script>
<script src="../bitrix/templates/made_in_krsk/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
	document.bform.USER_LOGIN.focus();
	
	$('input[name=UF_PHONE_NUMBER]').mask("+7 (999) 999-9999");

	$.formUtils.addValidator({
	  name : 'inn',
	  validatorFunction : function(value, $el, config, language, $form)
		{
		    if ( value.match(/\D/) ) return false;
		    
		    var inn = value.match(/(\d)/g);
		    
		    if ( inn.length == 10 )
		    {
		        return inn[9] == String(((
		            2*inn[0] + 4*inn[1] + 10*inn[2] + 
		            3*inn[3] + 5*inn[4] +  9*inn[5] + 
		            4*inn[6] + 6*inn[7] +  8*inn[8]
		        ) % 11) % 10);
		    }
		    else if ( inn.length == 12 )
		    {
		        return inn[10] == String(((
		             7*inn[0] + 2*inn[1] + 4*inn[2] +
		            10*inn[3] + 3*inn[4] + 5*inn[5] +
		             9*inn[6] + 4*inn[7] + 6*inn[8] +
		             8*inn[9]
		        ) % 11) % 10) && inn[11] == String(((
		            3*inn[0] +  7*inn[1] + 2*inn[2] +
		            4*inn[3] + 10*inn[4] + 3*inn[5] +
		            5*inn[6] +  9*inn[7] + 4*inn[8] +
		            6*inn[9] +  8*inn[10]
		        ) % 11) % 10);
		    }
		    
		    return false;
		},
	  errorMessage : 'Please enter a valid VAT number',
	  errorMessageKey: 'badInnNumber'
	});

	$.validate(
		{
			modules: 'security',
			form: '#formElem',
		    onError : function() 
			{
		    	alert('Validation failed');
		    },
		    onSuccess : function()
		    {
		    	alert('The form is valid!');
		    	return false; // Will stop the submission of the form
		    }	
		    
		});

	
</script>