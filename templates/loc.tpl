{include file="header.tpl"}
<h3>{$location[0].location}</h3>
<div class='w3-card-4 w3-white w3-padding'>
<table class='w3-table-all'>
<tr>
	<th>Bin</th>
	<th>Description</th>
</tr>
{foreach $items as $item}
<tr>
	<td><a href='binview.php?loc={$location[0].locid}&bin={$item.bin}'>{$item.bin}</a></td>
</tr>
{/foreach}
</table>
</div>
{include file="footer.tpl"}
