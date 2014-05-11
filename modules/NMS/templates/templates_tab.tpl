<p class="pageoverflow">
  {$templatecount} {$templatetext} {$foundtext}
</p>

{if count($templatelist)}
  <table class="pagetable" border="0" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
      <th>{$idtext}</th>
      <th>{$nametext}</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    {foreach from=$templatelist item=entry}
    {cycle values="row1,row2" assign='rowclass'}
      <tr class="{$rowclass}" onmouseover="this.className='{$rowclass}hover';" onmouseout="this.className='{$rowclass}';">
	<td>{$entry->template_id}</td>
        <td>{$entry->name}</td>
        <td>{$entry->editlink}</td>
        <td>{$entry->deletelink}</td>
      </tr>
    {/foreach}
    </tbody>
  </table>
{/if}
<p class="pageoverflow">
{$addlink}
</p>