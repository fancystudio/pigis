<h4>{$title}</h4>
{if !isset($flag_username_is_email)}
<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$import_feu_info}</p>
</div>
{/if}
{$startform}
<div class="pageoverflow">
	<p class="pagetext">{$prompt_groupname}:</p>
	<p class="pageinput">{$input_groupname}</p>
</div>

<div class="pageoverflow">
	<p class="pagetext">{$prompt_copyusername}:</p>
	<p class="pageinput">{$input_copyusername}&nbsp;{$info_copyusername}</p>
</div>

<div class="pageoverflow">
	<p class="pagetext">{$prompt_list}</p>
	<p class="pageinput">{$input_list}</p>
</div>

<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$submit}&nbsp;{$cancel}</p>
</div>

{$endform}
