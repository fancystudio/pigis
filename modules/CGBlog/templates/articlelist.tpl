<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
  $('#selectall').click(function(){
    var v = $(this).attr('checked');
    if( v == 'checked' ) {
      $('.select').attr('checked','checked');
    } else {
      $('.select').removeAttr('checked');
    }
  });
  $('.select').click(function(){
    $('#selectall').removeAttr('checked');
  });
  $('#toggle_filter').click(function(){
    $('#filter_form').toggle();
  });
  {if isset($tablesorter)}
  if( typeof($.tablesorter) != 'undefined' ) $('#articlelist').tablesorter({ sortList:{$tablesorter} });
  {/if}
});
//]]>
</script>

{if isset($formstart) }
<fieldset id="filter_form" style="display: none;">
  <legend>{$mod->Lang('title_filter')}:</legend>
  {$formstart}

  <table>
    <tr>
      <td style="vertical-align: top;">
        <div class="pageoverflow">
          <p class="pagetext">{$mod->Lang('title')|cms_escape}:</p>
          <p class="pageinput">
            <input type="text" name="{$actionid}filter_title" value="{$filter.title}"/>
            <br/>{$mod->Lang('info_filter_title')}
          </p>
        </div>

        <div class="pageoverflow">
          <p class="pagetext">{$mod->Lang('author')}:</p>
          <p class="pageinput">
            <input type="text" name="{$actionid}filter_author" value="{$filter.author}"/>
            <br/>{$mod->Lang('info_filter_author')}
          </p>
        </div>

        {if isset($categorylist) && count($categorylist)}
        <div class="pageoverflow">
          <p class="pagetext">{$mod->lang('category')}:</p>
          <p class="pageinput">
            {$n=max(3,min(10,count($categorylist)))}
            <select name="{$actionid}categories[]" multiple="multiple" size="{$n}">
              {html_options options=$categorylist selected=$filter.categories}
            </select>
          </p>
        </div>
        {/if}
      </td>

      <td style="width: 3em;"></td>

      <td style="vertical-align: top;">
        <div class="pageoverflow">
          <p class="pagetext">{$mod->Lang('prompt_sorting')}:</p>
          <p class="pageinput">
            <select name="{$actionid}filter_sortby">
              {html_options options=$sortings selected=$filter.sortby}
            </select>
          </p>
        </div>
        <div class="pageoverflow">
          <p class="pagetext">{$mod->Lang('prompt_pagelimit')}:</p>
          <p class="pageinput">
            <select name="{$actionid}filter_pagelimit">
              {html_options options=$pagelimits selected=$filter.pagelimit}
            </select>
          </p>
        </div>
      </td>

      <td style="width: 3em;"></td>

      <td style="vertical-align: top;">
        <div class="pageoverflow">
          <p class="pageinput">
            <input type="submit" name="{$actionid}submitfilter" value="{$mod->Lang('submit')}"/>
            <input type="submit" name="{$actionid}resetfilter" value="{$mod->Lang('reset')}"/>
          </p>
        </div>
      </td>
    </tr>
  </table>
  {$formend}
</fieldset>
{/if}
<!-- 
<div class="pageoptions">
  <input type="checkbox" id="toggle_filter" value="0"><label for="toggle_filter">{$mod->Lang('toggle_filter')}</label>&nbsp;
  <a href="{$add_url}">{cgimage image='icons/system/newobject.gif' alt=$mod->Lang('addarticle')} {$mod->Lang('addarticle')}</a>
</div>
-->
{if $itemcount > 0}
{if $pagecount > 1}
  <p>
{if $pagenumber > 1}
{$firstpage}&nbsp;{$prevpage}&nbsp;
{/if}
{$pagenumber}&nbsp;{$oftext}&nbsp;{$pagecount}
{if $pagenumber < $pagecount}
&nbsp;{$nextpage}&nbsp;{$lastpage}
{/if}
</p>
{/if}

{$form2start}
<table id="articlelist" cellspacing="0" class="pagetable cms_sortable tablesorter">
	<thead>
		<tr>
			<th>{$titletext}</th>
			<th>{$authortext}</th>
			<!-- <th>{$mod->Lang('url')}</th> -->
			<th>{$postdatetext}</th>
                        <th>{$startdatetext}</th>
                        <th>{$enddatetext}</th>
			<th class="header { sorter: false }" style="padding-left: 0;">{$statustext}</th>
			{if isset($have_blaster)}<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>{/if}
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
			<!-- <th class="pageicon {literal}{sorter: false}{/literal}"><input type="checkbox" id="selectall" name="selectall"/></th> -->
		</tr>
	</thead>
	<tbody>
	{foreach from=$items item=entry}
		<tr class="{$entry->rowclass}">
			<td>
                        {if isset($entry->edit_url)}
                          <a href="{$entry->edit_url}" title="{$mod->Lang('edit')}">{$entry->title|cms_escape}</a>
                        {else}
                          {$entry->title|cms_escape}</td>
                        {/if}
			<td>{$entry->author}</td>
			<!-- <td>{$entry->url}</td> -->
			<td>{$entry->u_postdate|cms_date_format}</td>
                        <td>{if !empty($entry->u_enddate)}{$entry->u_startdate|cms_date_format}{/if}</td>
                        <td>{if $entry->expired == 1}
                              <div class="important">
                              {$entry->u_enddate|cms_date_format}
	                      </div>
                            {else}
                              {$entry->u_enddate|cms_date_format}
                            {/if}
                        </td>
			<td>{if isset($entry->approve_link)}
  			      {$entry->approve_link}
                            {else}
                              {cgimage image='icons/system/warning.gif' alt=$mod->Lang('title_needs_approval')}
                            {/if}
                        </td>
	                {if isset($have_blaster)}<td>
                          {if $entry->expired != 1 && $entry->o_status == 'published'}
                            {*cgsocblaster module='CGBlog' key=$entry->id*}{eval var=$blaster_tag}
                          {/if}
                        </td>{/if}
			<td>{$entry->editlink}</td>
			<td>{$entry->deletelink}</td>
			<!-- <td><input type="checkbox" name="{$actionid}sel[]" value="{$entry->id}" class="select"> -->
		</tr>
	{/foreach}
	</tbody>
</table>
{/if}
<!-- 
{if $itemcount > 0}
<div class="pageoptions">
  <div style="float: right; text-align: right;">{$mod->Lang('with_selected')}:<br/>
       <select name="{$actionid}mass_category">{html_options options=$categorylist}</select>
       <input type="submit" name="{$actionid}mass_addcategory" value="{$mod->Lang('addcategory')}"/><br/>
       {$submit_massdelete}</div>
  <div style="clear: both;"></div>
</div>
{/if}
-->
{$form2end}