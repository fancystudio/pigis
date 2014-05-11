{$formstart_utilisation}
<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_etat_mode_developpement')}:</p>
		<p class="pageinput">{if $status}{$mod->Lang('enable')}{else}{$mod->Lang('disable')}{/if}</p>
</div>
{if $status AND $timeoutleft != ""}
<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_fin_activite')}:</p>
		<p class="pageinput">{if $timeoutleft < 0}∞{else}{$timeoutleft}{/if} {if $timeoutleft > 1}{$mod->Lang('minutes')}{elseif $timeoutleft == 1}{$mod->Lang('minute')}{/if}</p>
</div>
{/if}
<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$utilisation_submit}{if isset($refresh_submit)}{$refresh_submit}{/if}</p>
</div>
{$formend_utilisation}