{if isset($message) }
  {if isset($error) }
    <p><font color="red">{$message}</font></p>
  {else}
    <p>{$message}</p>
  {/if}
{/if}
<h3>{$title}</h3>
{$startform}{$hidden|default:''}
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_messages}</p>
    <p class="pageinput">{$messagelist}<br/>{$infotxt}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_lists}</p>
    <p class="pageinput">{$listlist}<br/>{$infotxt}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_name}:</p>
    <p class="pageinput">{$jobname}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">&nbsp;</p>
    <p class="pageinput">{$submit}&nbsp;{$cancel}</p>
  </div>
{$endform}
