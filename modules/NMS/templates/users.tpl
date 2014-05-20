<script type="text/javascript">
{literal}
$(document).ready(function(){
  $('#showfilter').click(function(){
    $('#filter').toggle();
  });
  $('#users_selectall').click(function(){
    var tmp = this.checked;
    $('input.user_selected').prop('checked',tmp);
  });
});
//]]>
{/literal}
</script>

{if isset($message)}
  {if $error != ''}
    <p><font color="red">{$message}</font></p>
  {else}
    <p>{$message}</p>
  {/if}
{/if}
{if !isset($noform) || $noform == ''}
<fieldset id="filter"{if !$is_filtered} style="display: none;{/if}">
<legend>{$mod->Lang('filter')}:</legend>
{$startform}
<table class="pagetable" cellspacing="0">
<tr>
  <td>
    <div class="pageoverflow">
      <p class="pagetext">{$prompt_userfilter}</p>
      <p class="pageinput">{$userfilter}</p>
    </div>
  </td>
  <td>
    <div class="pageoverflow">
      <p class="pagetext">{$prompt_usernamefilter}</p>
      <p class="pageinput">{$usernamefilter}</p>
    </div>
  </td>
</tr>
  <td>
    <div class="pageoverflow">
      <p class="pagetext">{$prompt_listfilter}</p>
      <p class="pageinput">{$listfilter}<br/>{$info_listfilter}</p>
    </div>
  </td>
  <td>
    <div class="pageoverflow">
      <p class="pagetext">{$prompt_users_per_page}</p>
      <p class="pageinput">{$users_per_page}</p>
   </div>
  </td>
</tr>
<tr>
  <td>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->Lang('show_only_errors')}</p>
      <p class="pageinput">
        {cge_yesno_options prefix=$actionid name='filter_errorusers' selected=$filter_errorusers}<br/>{$filter_errorusers}
      </p>
    </div>
  </td>
  <td>
    <div class="pageoverflow">
      <p class="pagetext">&nbsp;</p>
      <p class="pageinput">{$filter}</p>
    </div>
  </td>
</tr>
</table>
{$endform}
</fieldset>

<div class="pageoptions"><p class="pageoptions">
 <!-- <input type="checkbox" id="showfilter"{if $is_filtered}checked="checked"{/if} value="1"/>{$mod->Lang('show_filter')}&nbsp; -->
{$itemcount}&nbsp;{$itemsfound}&nbsp;{$oftext}&nbsp;{$totalitems}</p></div>
{if isset($pagecount) && $pagecount != ''}
<div class="pageoverflow">
<div class="pageshowrows">{$firstpage}&nbsp;{$prevpage}&nbsp;{$pagetext}&nbsp;{$curpage}&nbsp;{$oftext}&nbsp;{$pagecount}&nbsp;{$nextpage}&nbsp;{$lastpage}</div>
</div>
{/if}
{if $itemcount > 0}
{$formstart2}
<table border="0" cellspacing="0" cellpadding="0" class="pagetable">
 <thead>
  <tr>	
  <th>{$usertext}</th>
  <th>{$emailtext}</th>
  <th>{$nametext}</th>
  <th>{$confirmedtext}</th>
  <th>{$liststext}</th>
  <th>{$disabledtext}</th>
  <th>{$mod->Lang('errors')}</th>
  <th class="pageicon">&nbsp;</th>
  <th class="pageicon">&nbsp;</th>
  <!--<th class="pageicon"><input type="checkbox" id="users_selectall" name="users_selectall" value="1" {*onclick="toggle_nms_users_selectall();*}"/></th>-->
  </tr>
 </thead>
 <tbody>
{foreach from=$items item=entry}
  <tr class="{$entry->rowclass}">
    <td>{$entry->user}</td>
    <td>{$entry->email}</td>
    <td>{$entry->name}</td>
    <td>{$entry->confirmed}</td>
    <td>{$entry->lists}</td>
    <td>{$entry->disabled}</td>
    <td>{$entry->errors}</td>
    <td>{$entry->editlink}</td>
    <td>{$entry->deletelink}</td>
   <!-- <td><input type="checkbox" class="user_selected" name="{$actionid}user_selected[]" value="{$entry->user}"/></td> -->
  </tr>
{/foreach}
 </tbody>
</table>
{/if}
<div class="pageoptions" style="height: 3em;">
  <div style="float: left; width: 40%;">
    {$createlink}&nbsp; <!--{$importlink}&nbsp;{$feuimportlink|default:''}&nbsp;{$exportlink}&nbsp;{$bounceslink} -->
  </div>
  <!--<div style="float: right; text-align: right; width: 40%; margin-top: 1em;">
    {$mod->Lang('with_selected')}:&nbsp;&nbsp;{$bulk_actions}
    <input type="submit" name="{$actionid}bulk_submit" value="{$mod->Lang('submit')}" onclick="confirm('{$mod->Lang('confirm_bulkactions')}');"/>
  </div> -->
</div>
{$formend2}
{/if}
