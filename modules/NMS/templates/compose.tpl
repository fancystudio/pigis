{$startform}
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_subject}:</p>
    <p class="pageinput">{$subject}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_text_only}:</p>
    <p class="pageinput">{$text_only}</p>
  </div>
  {if isset($templatelist)}
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_template}:</p>
    <p class="pageinput">{$templatelist}</p>
  </div>
  {/if}
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_page}:</p>
    <p class="pageinput">{$pagelist}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_archivable}:</p>
    <p class="pageinput">{$archivable}</p>
  </div>
   {if isset($selectstatus)}
   <div class="pageoverflow">
  	 <p class="pagetext">{$prompt_selectstatus}:</p>
  	 <p class="pageinput">{$selectstatus}</p>
   </div>
   {/if}
   <div class="pageoverflow">
	{$message_help2}
   </div>
   <div class="pageoverflow">
	{$message_help}
   </div>
   {foreach from=$contentblocks item='block'}
     {if isset($block->hidden)}
        {$block->control}
     {else}
     <div class="pageoverflow">
	<p class="pagetext">{$block->prompt}</p>
	<p class="pageinput">{$block->control}</p>
     </div>
     {/if}
   {/foreach}
   <div class="pageoverflow">
	<p class="pagetext">{$prompt_textmessage}</p>
	<p class="pageinput">{$textmessage}</p>
   </div>
   <div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$submit}{$cancel}</p>
   </div>
{if isset($hidden)}{$hidden}{/if}{$endform}
