{$formstart_parametres}

<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_repertoire_exportation')}:</p>
		<p class="pageinput">
			{$root_path}/tmp/{if isset($parametres_submit)}<input type="text" id="{$actionid}cache_path" name="{$actionid}cache_path" value="{$cache_path}" size="50" maxlength="255"/>{else}{$cache_path}{/if}
		</p>
</div>

<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_chmod')}:</p>
		<p class="pageinput">{if isset($parametres_submit)}<input type="text" id="{$actionid}chmod" name="{$actionid}chmod" value="{$chmod}" size="5" maxlength="5"/>{else}{$chmod}{/if}</p>
</div>

<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_template_extension')}:</p>
		<p class="pageinput">{if isset($parametres_submit)}<input type="text" id="{$actionid}template_extension" name="{$actionid}template_extension" value="{$template_extension}" size="4" maxlength="4"/>{else}{$template_extension}{/if}</p>
</div>

<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_stylesheet_extension')}:</p>
		<p class="pageinput">{if isset($parametres_submit)}<input type="text" id="{$actionid}stylesheet_extension" name="{$actionid}stylesheet_extension" value="{$stylesheet_extension}" size="4" maxlength="4"/>{else}{$stylesheet_extension}{/if}</p>
</div>

<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_udt_extension')}:</p>
		<p class="pageinput">{if isset($parametres_submit)}<input type="text" id="{$actionid}udt_extension" name="{$actionid}udt_extension" value="{$udt_extension}" size="4" maxlength="4"/>{else}{$udt_extension}{/if}</p>
</div>

<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_timeout')}:</p>
		<p class="pageinput">{if isset($parametres_submit)}<input type="text" id="{$actionid}timeout" name="{$actionid}timeout" value="{$timeout}" size="3" maxlength="3"/> {$mod->Lang('no_timeout')}{else}{if $timeout == 0}∞{else}{$timeout}{/if}{/if}</p>
</div>

<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{if isset($parametres_submit)}{$parametres_submit}{else}{$mod->Lang('nosave_params')}{/if}</p>
</div>

{$formend_parametres}