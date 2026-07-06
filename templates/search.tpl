{include file="header.tpl"}

<h3>ID Look-up</h3>
<div class='w3-card-4 w3-white w3-padding'>
<form method="get">
	<p>
		<label>Inventory ID:</label>
		<input class="w3-input" type="text" name="search">
	</p>
	<p>
		<input class="w3-button w3-blue w3-round" type="submit" value="Search">
	</p>
</form>
</div>
{if $fault==1}
<div class="w3-panel w3-yellow w3-border w3-center">
	<h3>Warning</h3>
	<p>Invalid Inventory ID specified.  Please try again.</p>
</div>
{elseif $fault==2}
<div class="w3-panel w3-yellow w3-border w3-center">
	<h3>Warning</h3>
	<p>No inventory item found.  Please try a different Inventory ID number.</p>
</div>
{/if}

{include file="footer.tpl"}
