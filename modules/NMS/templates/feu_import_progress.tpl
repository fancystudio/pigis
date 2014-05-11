{$title}
<p>{$listidInfo}{$listid}</p>
<p>{$processedAddressesCountInfo}{$processedAddressesCount}</p>

<table width="100%">
<tr>
	<th width="25%">{$processedAddressesTitle}</th>
	<th width="25%">{$inDatabaseTitle}</th>
	<th width="25%">{$onListAlreadyTitle}</th>
	<th width="25%">{$addressSubscribedTitle}</th>
</tr>
<tr>
	<td valign="top">{foreach from=$processedAddresses item=pAddr}{$pAddr}<br />{/foreach}</td>
	<td valign="top">{foreach from=$inDatabase item=inDB}{$inDB}<br />{/foreach}</td>
	<td valign="top">{foreach from=$onListAlready item=ola}{$ola}<br />{/foreach}</td>
	<td valign="top">{foreach from=$addressSubscribed item=addrSub}{$addrSub}<br />{/foreach}</td>
</tr>
</table>
