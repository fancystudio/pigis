{if isset($message) && $message != ''}
  {if $error != ''}
    <p><font color="red">{$message}</font></p>
  {else}
    <p>{$message}</p>
  {/if}
{/if}
{$title}
{$startform}
<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$info_csvformat}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$mod->Lang('lists')}</p>
	<p class="pageinput">{$input_lists}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$prompt_filename}</p>
	<p class="pageinput">{$input_filename}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$submit}</p>
</div>
{if isset($lines) }
<hr/>
<div class="pageoverflow">
	<p class="pagetext">{$prompt_lines}</p>
	<p class="pageinput">{$lines}</p>
</div>
{if $usersadded}
<div class="pageoverflow">
	<p class="pagetext">{$prompt_usersadded}</p>
	<p class="pageinput">{$usersadded}</p>
</div>
{/if}
{if $membershipsadded}
<div class="pageoverflow">
	<p class="pagetext">{$prompt_membershipsadded}</p>
	<p class="pageinput">{$membershipsadded}</p>
</div>
{/if}
{if $errorcount != ''}
<div class="pageoverflow">
	<p class="pagetext">{$prompt_errorcount}</p>
	<p class="pageinput">{$errorcount}</p>
{foreach from=$import_errors item=err}
        <p class="pageinput">{$err}</p>
{/foreach}
</div>
{/if}
{/if}
{$endform}
