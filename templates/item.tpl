{include file="header.tpl"}

<h3>{foreach $crumbs|@array_reverse:true as $row name=crumbs}{$row.cat}{if $smarty.foreach.crumbs.last}{else} - {/if}{/foreach}</h3>
<div class='w3-card-4 w3-white w3-padding'>
<table class='w3-table-all'>
<tr>
{foreach $data as $row}
	<th>{$row.feature}</th>
{/foreach}
</tr>
<tr>
{foreach $data as $row}
	<td><select class="w3-select" name="{$row.feature}">
		<option value="" selected>---</option>
	{foreach $specs[$row.featid] as $s_row}
		<option value="{$s_row.specid}">{$s_row.spec}</option>
	{/foreach}
	</select>
	<input type="text" name="new{$row.feature}" class="w3-input">
	</td>
{/foreach}
</tr>
</table>
<table class='w3-table-all'>
<tr>
	<th>Discription</th><th>Qty</th><th>Location</th><th>Bin</th>
</tr>
<tr>
	<td><input type="text" name="discription" class="w3-input"></td>
	<td><input type="number" name="qty" class="w3-input"></td>
	<td><input type="text" name="location" class="w3-input"></td>
	<td><input type="text" name="bin" class="w3-input"></td>
</tr>
</table>
<p>
<button type="submit" class="w3-button w3-blue w3-round">Add New Item</button>
</p>
</div>
{include file="footer.tpl"}
