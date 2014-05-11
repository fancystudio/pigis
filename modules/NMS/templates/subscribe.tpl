{if $admin_nav neq ""}
	{$admin_nav}<br />
{/if}
<label>{$text}</label>
{$formstart}
	{$formhidden}
	{$email}<br />
	{if $multiple eq true}
		{foreach from=$listids item=curr_id}
		  {$curr_id}<br />
		{/foreach}
	{else}
		<div style="display: none; visible: hidden;">
		{foreach from=$listids item=curr_id}
		  {$curr_id}
		{/foreach}
		</div>
	{/if}
	{$submitbtn}
{$formend}
