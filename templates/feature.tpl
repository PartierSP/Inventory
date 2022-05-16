{include file="header.tpl"}

<h3>{foreach $crumbs|@array_reverse:true as $row name=crumbs}{$row.cat}{if $smarty.foreach.crumbs.last}{else} - {/if}{/foreach}</h3>
<div class='w3-card-4 w3-white w3-padding'>
<table class='w3-table-all'>
<tr>
	<th>Feature List</th>
</tr>
{foreach $features as $row}
	<tr>
		<td>{$row.feature}</td>
	</tr>
{/foreach}
<tr>
	<td><form method="get"><input type="hidden" name="catid" value="{$catid}"><input type="text" name="feature"><input type="submit" value="New"></form></td>
</tr>
</table>
</div>

{include file="footer.tpl"}
