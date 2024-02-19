{include file="header.tpl"}

<div class='w3-card-4 w3-white w3-padding'>
<h2>{$list[0][0]['location']} - Bin {$list[0][0]['bin']}</h2>
{foreach $structure as $table name=tableloop}
<h3>{$table[0]['cat']}</h3>
<table class='w3-table-all'>
<tr>
	<th>Description</th>
	{foreach $table as $row}
		<th>{$row.feature}</th>
	{/foreach}
	<th>Qty</th>
</tr>
{foreach $list[$smarty.foreach.tableloop.index] as $row name=listloop}
<tr>
	<td><a href="item.php?catid={$row.catid}&itemid={$row.itemid}">*</a> {$row.description}</td>
	{foreach $table as $d_row}
		<td>{$il[$smarty.foreach.tableloop.index][$smarty.foreach.listloop.index][$d_row.featid]['spec']}</td>
	{/foreach}
	<td>{$row.qty}</td>
</tr>
{/foreach}
</table>
{/foreach}
</div>
<p></p>
<div class='w3-card-4 w3-white w3-padding'>
	<h4>Print via PDF <a href="binlabel.php?s=0&l={$list[0][0]['locid']}&b={$list[0][0]['bin']}" class="w3-button w3-blue w3-round">Small Bin Label</a> <a href="binlabel.php?s=1&l={$list[0][0]['locid']}&b={$list[0][0]['bin']}" class="w3-button w3-blue w3-round">Med Bin Label</a></h4>
</div>
<p></p>
<div class='w3-card-4 w3-white w3-padding'>
		<h4>Print via Plotter <a href="blabel.php?s=2&l={$list[0][0]['locid']}&b={$list[0][0]['bin']}" class="w3-button w3-blue w3-round">Plot Tiny Label</a> <a href="blabel.php?s=1&l={$list[0][0]['locid']}&b={$list[0][0]['bin']}" class="w3-button w3-blue w3-round">Plot Small Label</a> <a href="blabel.php?s=0&l={$list[0][0]['locid']}&b={$list[0][0]['bin']}" class="w3-button w3-blue w3-round">Plot Large Label</a></h4>
</div>
<p></p>
{include file="footer.tpl"}
