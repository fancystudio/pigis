<!-- Start CGBlog Display Template -->
{if isset($error)}{cgerror}{$error}{/cgerror}{/if}

{if $pagecount > 1}
  <p>
    {if $pagenumber > 1}
      <a href="{$firsturl}">{$mod->Lang('firstpage')}</a>&nbsp;
      <a href="{$prevurl}">{$mod->Lang('prevpage')}</a>&nbsp;
    {/if}
    {$mod->Lang('prompt_page')	}&nbsp;{$pagenumber}&nbsp;{$oftext}&nbsp;{$pagecount}
    {if $pagenumber < $pagecount}
      &nbsp;<a href="{$nexturl}">{$mod->Lang('nextpage')}</a>
      &nbsp;<a href="{$lasturl}">{$mod->Lang('lastpage')}</a>
    {/if}
  </p>
{/if}

{foreach from=$items item=entry}
<div class="CGBlogSummary">

{if $entry->postdate}
	<div class="CGBlogSummaryPostdate">
		{$entry->postdate|cms_date_format}
	</div>
{/if}

<div class="CGBlogSummaryLink">
<a href="{$entry->detail_url}" title="{$entry->title|escape:htmlall}">{$entry->title|escape}</a>
</div>

{if $entry->categories}
<div class="CGBlogSummaryCategory">
{strip}{$category_label}
 {foreach from=$entry->categories item='category'}
   {$category.name}&nbsp;
 {/foreach}
{/strip}
</div>
{/if}

{if $entry->author}
	<div class="CGBlogSummaryAuthor">
		{$author_label} {$entry->author}
	</div>
{/if}

{if $entry->summary}
	<div class="CGBlogSummarySummary">
		{eval var=$entry->summary}
	</div>

{else if $entry->content}

	<div class="CGBlogSummaryContent">
		{eval var=$entry->content}
	</div>
{/if}

{if isset($entry->extra)}
    <div class="CGBlogSummaryExtra">
        {eval var=$entry->extra}
	{* {cms_module module='Uploads' mode='simpleurl' upload_id=$entry->extravalue} *}
    </div>
{/if}
{if isset($entry->fields)}
  {foreach from=$entry->fields item='field'}
     <div class="CGBlogSummaryField">
        {if $field->type == 'file'}
          <img src="{$entry->file_location}/{$field->value}"/>
        {else}
          {$field->name}:&nbsp;{eval var=$field->value}
        {/if}
     </div>
  {/foreach}
{/if}

</div>
{/foreach}
<!-- End CGBlog Display Template -->
