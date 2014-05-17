{* set a canonical variable that can be used in the head section if process_whole_template is false in the config.php *}
{if isset($entry->canonical)}
  {assign var='canonical' value=$entry->canonical}
{/if}

{if $entry->postdate}
	<div id="CGBlogPostDetailDate">
		{$entry->postdate|cms_date_format}
	</div>
{/if}
<h3 id="CGBlogPostDetailTitle">{$entry->title|escape}</h3>

<hr id="CGBlogPostDetailHorizRule" />

{if $entry->summary}
	<div id="CGBlogPostDetailSummary">
		<strong>
			{eval var=$entry->summary}
		</strong>
	</div>
{/if}


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
	<div id="CGBlogPostDetailAuthor">
		{$author_label} {$entry->author}
	</div>
{/if}

<div id="CGBlogPostDetailContent">
	{eval var=$entry->content}
</div>

{if $entry->extra}
	<div id="CGBlogPostDetailExtra">
		{$extra_label} {$entry->extra}
	</div>
{/if}

{* addressing extra fields.
   Extra fields are in the array $entry->fields.  which is a 'hash' that is indexed by the fields name.
   i.e: $entry->fields.myfield will return the field 'object'
   If the field name has spaces or other characters you may need to use special smarty quoting to address the individual field.
   i.e: {assign var='tmp' value='field name with spaces'}{$entry->fields.$tmp->value}
   Fields have their own aliases and can be addressed like:
     {$entry->alias->value}
   To see all of the available field aliases.. you can do a: <pre>{$entry->aliases|@print_r}</pre>
   Note: The syntax for addressing fields in the detail template is slightly different from addressing fields in the summary view
*}
{if isset($entry->fields)}
  {foreach from=$entry->fields item='field'}
     {* the field is an object.. available members are:
        alias id, name, type, max_length, create_date, modified_date, item_order, public, and value.
        i.e: {$field->name} will output the name: {$field->alias} will output the alias.
     *}
     <div class="CGBlogDetailField">
        {if $field->type == 'file'}
	  {* this template assumes that every file uploaded is an image of some sort, because CGBlog doesn't distinguish *}
          <img src="{$entry->file_location}/{$field->value}"/>
        {else}
          {$field->name}:&nbsp;{eval var=$field->value}
        {/if}
     </div>
  {/foreach}
{/if}

{* find the id of the prev viewable blog article (by post date) *}
{$article_id=$entry->id}
{cgblog_relative_article article=$article_id dir='prev' assign='prev_id'}
{if $prev_id}
<div class="prevblogarticle">
  <a href="{module_action_link module=CGBlog action=detail articleid=$prev_id urlonly=1}">Previous Article</a>
</div>
{/if}

{* find the id of the next viewable blog article (by post date) *}
{cgblog_relative_article article=$article_id dir='next' assign='next_id'}
{if $next_id}
<div class="nextblogarticle">
  <a href="{module_action_link module=CGBlog action=detail articleid=$next_id urlonly=1}">Next Article</a>
</div>
{/if}
