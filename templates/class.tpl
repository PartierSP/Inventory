{include file="header.tpl"}

<h3>Class</h3>
<div class='w3-card-4 w3-white w3-padding'>
<table class='w3-table-all'>
<tr>
{foreach $data as $row}
	<td><b>{$row.feature}</b><br>
	{foreach $specs[$row.featid] as $s_row}
		<br>{$s_row.spec}
	{/foreach}
	</td>
{/foreach}
</tr>
</table>
<p>{$ilcount} items found.</p>
<table class='w3-table-all'>
<tr>
	<th>Description</th>
	{foreach $data as $row}
		<th>{$row.feature}</th>
	{/foreach}
	<th>Qty</th>
	<th>Location</th>
	<th>Bin</th>
</tr>
{foreach $itemlist as $row}
<tr>
	<td>{$row.description}</td>
	{foreach $data as $d_row}
		<td></td>
	{/foreach}
	<td>{$row.qty}</td>
	<td>{$row.location}</td>
	<td>{$row.bin}</td>
</tr>
{foreachelse}
<tr>
	<td>--- No Items Found ---</td>
	{foreach $data as $d_row}
		<td></td>
	{/foreach}
	<td></td>
	<td></td>
	<td></td>
</tr>
{/foreach}
</table>
</div>
{include file="footer.tpl"}
