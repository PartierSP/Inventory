{include file="header.tpl"}

<h3>Class</h3>
<table class='w3-table'>
<tr>
{foreach $data as $row}
	<td class='w3-border'><b>{$row.feature}</b><br>
	{foreach $specs[$row.featid] as $s_row}
		<br>{$s_row.spec}
	{/foreach}
	</td>
{/foreach}
</tr>
</table>
<table class='w3-table'>
<tr>
	<th>Description</th>
	{foreach $data as $row}
		<th>{$row.feature}</th>
	{/foreach}
</tr>
{foreach $itemlist as $row}
<tr>
	<td>{$row.description}</td>
</tr>
{/foreach}
</table>

{include file="footer.tpl"}
