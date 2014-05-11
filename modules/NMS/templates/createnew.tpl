<p>{$title}</p>
{if $message!=''}
  <p class='pagemessage'>
  {if $error!=''}
   <font color="red">
  {/if}
  <strong>{$message}</strong>
  {if $error!=''}
   </font>
  {/if}
  </p>
{/if}
{$startform}
{$hidden}{$listid}
<div class="pageoverflow">
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_name}</p>
    <p class="pageinput">{$name}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_description}</p>
    <p class="pageinput">{$description}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_public}</p>
    <p class="pageinput">{$public}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">&nbsp;</p>
    <p class="pageinput">{$submit}{$cancel}</p>
  </div>
</div>
{$endform}
