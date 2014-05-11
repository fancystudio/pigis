{$archive_heading}
<table cellpadding="4" width="100%">
<tr class="nmsarchive_header">
	<th>{$archive_tbl_msgID}</th>
	<th>{$archive_tbl_date}</th>
	<th style="display:none;">{$archive_tbl_subject}</th>
	<th>{$archive_tbl_fullurl}</th>
	<th style="display:none;">{$archive_tbl_href}</th>
</tr>
{section name=mysec loop=$archived_messages}
{strip}
<tr class="{cycle values="oddrow,evenrow"}">
	<td>{$archived_messages[mysec].msgID}</td>
	<td>{$archived_messages[mysec].date|cms_date_format}</td>
	<td style="display:none;">{$archived_messages[mysec].subject}</td>
	<td>{$archived_messages[mysec].fullurl}</td>
	<td style="display:none;">{$archived_messages[mysec].href}</td>
</tr>
{/strip}
{/section}
</table>
