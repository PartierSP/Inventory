{include file="header.tpl"}

<h3>{foreach $crumbs|@array_reverse:true as $row name=crumbs}{if $smarty.foreach.crumbs.last}{$row.cat}{else}<a href="index.php?id={$row.catid}">{$row.cat}</a>{/if}{if $smarty.foreach.crumbs.last}{else} - {/if}{/foreach}</h3>
<div class='w3-card-4 w3-white w3-padding'>
<form method="get"><input type="hidden" name="id" value="{$id}">
<table class='w3-table-all'>
<tr>
{foreach $data as $row}
	<td><b>{$row.feature}</b><br>
	{foreach $specs[$row.featid] as $s_row}
		<br><input type="checkbox" id="cb{$s_row.specid}" name="cb{$s_row.specid}" value="1"{if $cbv[$s_row.specid] > 0} checked{/if}><lable for="cb{$s_row.specid}">{$s_row.spec}</lable>
	{/foreach}
	</td>
{/foreach}
</tr>
</table>
<p><button type="submit" class="w3-button w3-blue">Update List</button></p>
</form>
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
{foreach $list as $row name=listloop}
<tr>
	<td><a href="item.php?catid={$row.catid}&itemid={$row.itemid}">*</a> {$row.description}</td>
	{foreach $data as $d_row}
		<td>{$itemlist[$smarty.foreach.listloop.index][$d_row.featid]['spec']}</td>
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
<p>
<a href="item.php?catid={$id}&n=-1" class="w3-button w3-blue w3-round">Add New Item</a>
</p>
</div>
{include file="footer.tpl"}
