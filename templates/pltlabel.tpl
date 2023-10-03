{include file="header.tpl"}
<div class="w3-container">
	<h3>Select the label to plot on:</h3>
	<table class="w3-table w3-center w3-card-4 w3-light-grey" style="width:690px">
		{for $row=1 to 5}
		<tr>
			{for $col=1 to 2}
			<td>
				<a href="blabel.php?l={$l}&b={$b}&s={$s}&row={$row}&col={$col}" download="label.hpgl"><img src="label.png">
			</td>
			{/for}
		</tr>
		{/for}
	</table>
</div>
{include file="footer.tpl"}
