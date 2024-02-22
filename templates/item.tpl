{include file="header.tpl"}

<h3>{foreach $crumbs|@array_reverse:true as $row name=crumbs}<a href="{if $smarty.foreach.crumbs.last}class{else}index{/if}.php?id={$row.catid}">{$row.cat}</a>{if $smarty.foreach.crumbs.last}{else} - {/if}{/foreach}</h3>
<div class='w3-card-4 w3-white w3-padding'>
<form method="get"><input type="hidden" name="catid" value="{$catid}"><input type="hidden" name="n" value="1">
<table class='w3-table-all'>
<tr>
{foreach $data as $row}
	<th>{$row.feature}</th>
{/foreach}
</tr>
<tr>
{foreach $data as $row}
	<td><select class="w3-select" name="feat{$row.featid}" id="feat{$row.featid}">
			<option value=""{if $row.selected eq 0} selected{/if}>---</option>
	{foreach $specs[$row.featid] as $s_row}
		<option value="{$s_row.specid}"{if $row.selected eq $s_row.specid} selected{/if}>{$s_row.spec}</option>
	{/foreach}
	</select>
	<input type="text" name="nsp{$row.featid}" class="w3-input">
	</td>
{/foreach}
</tr>
</table>
<table class='w3-table-all'>
<tr>
	<th>Discription</th><th>Qty</th><th>Location</th><th>Bin #</th>
</tr>
<tr>
	<td><input type="text" name="description" class="w3-input" value="{$item.description}"></td>
	<td><input type="number" name="qty" class="w3-input" value="{$item.qty}"></td>
	<td><select class="w3-select" name="location">
		<option value="" {if $item.location eq 0} selected{/if}>---</option>
	{foreach $locations as $s_row}
		<option value="{$s_row.locid}"{if $s_row.selected eq $s_row.locid} selected{/if}>{$s_row.location}</option>
	{/foreach}
	</select>
	<input type="text" name="newlocation" class="w3-input">
	</td>
	<td><input type="number" name="bin" class="w3-input" value="{$item.bin}"></td>
</tr>
</table>
<div class="w3-row w3-padding">
	<div class="w3-half w3-container">
		{if $itemid>0}<input type="hidden" name="itemid" value="{$itemid}">{else}
		<input type="hidden" name="n" value="1">{/if}
		<button type="submit" class="w3-button w3-blue w3-round">{if $itemid>0}Update{else}Add New{/if} Item</button>
		{if $itemid>0}<a href="binview.php?loc={$item.location}&bin={$item.bin}" class="w3-button w3-blue w3-round">View Bin</a>{/if}
	</div>
	<div class="w3-half w3-container w3-center">
		<div class="w3-green w3-button w3-round">Inventory ID: {$catid}-{$itemid}</div>
	</div>
</div>
</form>
</div>
{include file="footer.tpl"}
