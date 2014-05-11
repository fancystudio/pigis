{if isset($message)}
  {if $error != ''}
    <p><font color="red">{$message}</font></p>
  {else}
    <p>{$message}</p>
  {/if}
{/if}

{if isset($jobs_warning)}
  <fieldset class="pageoverflow" style="color:black;padding:5px;background-color:white;border:2px dotted orange">
     {$jobs_warning}
  </fieldset>
{/if}

<p class="pageoverflow">{$itemcount}&nbsp;{$itemsfound}</p>

{if $itemcount > 0}
<table border="0" cellspacing="0" cellpadding="0" class="pagetable">
 <thead>
  <tr>	
  <th>{$idtext}</th>
  <th>{$nametext}</th>
  <th>{$createdtext}</th>
  <th>{$startedtext}</th>
  <th>{$finishedtext}</th>
  <th>{$emailstext}</th>
  <th>{$statustext}</th>
  <th>{$actiontext}</th>
  <th class="pageicon">&nbsp;</th>
  <th class="pageicon">&nbsp;</th>
  </tr>
 </thead>
 <tbody>
{foreach from=$items item=entry}
  {cycle values="row1,row2" assign='rowclass'}
  <tr class="{$rowclass}" onmouseover="this.className='{$rowclass}hover';" onmouseout="this.className='{$rowclass}';">
    <td>{$entry->id}</td>
    <td>{$entry->name}</td>
    <td>{$entry->created|cms_date_format}</td>
    <td>{$entry->started|cms_date_format}</td>
    <td>{$entry->finished|cms_date_format}</td>
    <td>{$entry->emails}</td>
    <td>{$entry->status}</td>
    <td>{$entry->actionlink|default:''}</td>
    <td>{$entry->editlink|default:''}</td>
    <td>{$entry->deletelink}</td>
  </tr>
{/foreach}
 </tbody>
</table>
{/if}
{$createlink}&nbsp;{$deletecompletedlink|default:''}&nbsp;{$cleantemplink|default:''}&nbsp;{$processlink|default:''}<br/>
