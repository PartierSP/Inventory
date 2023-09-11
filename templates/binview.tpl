{include file="header.tpl"}

<div class='w3-card-4 w3-white w3-padding'>
{foreach $structure as $table name=tableloop}
<h3>{$table[0]['cat']}</h3>
<table class='w3-table-all'>
<tr>
	<th>Description</th>
	{foreach $table as $row}
		<th>{$row.feature}</th>
	{/foreach}
	<th>Qty</th>
	<th>Location</th>
	<th>Bin</th>
</tr>
{foreach $list[$smarty.foreach.tableloop.index] as $row name=listloop}
<tr>
	<td><a href="item.php?catid={$row.catid}&itemid={$row.itemid}">*</a> {$row.description}</td>
	{foreach $table as $d_row}
		<td>{$il[$smarty.foreach.tableloop.index][$smarty.foreach.listloop.index][$d_row.featid]['spec']}</td>
	{/foreach}
	<td>{$row.qty}</td>
	<td>{$row.location}</td>
	<td>{$row.bin}</td>
</tr>
{/foreach}
</table>
{/foreach}
</div>

<div class='w3-card-4 w3-white w3-padding'>
	<a href="binlabel.php?loc={$item.location}&bin={$item.bin}" class="w3-button w3-blue w3-round">Print Bin Label</a>
</div>

{include file="footer.tpl"}
