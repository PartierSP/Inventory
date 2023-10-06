{include file="header.tpl"}
<style>

.container {
	position: relative;
	width: 100%
}

.image {
	opacity: 1;
	display: block;
	width: 100%;
	height: auto;
	transition: .5s ease;
	backface-visibility: hidden;
}

.middle {
	transition: .5s ease;
	opacity: 0;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%)
}

.container:hover .image {
	opacity: 0.3;
}

.container:hover .middle {
	opacity: 1;
}
</style>
<div class="w3-container">
	<h3>Select the label to plot on:</h3>
	<table class="w3-table w3-center w3-card-4 w3-light-grey" style="width:690px">
		<tr>
			<td>
				<p></p>
			</td>
		</tr>
		{for $row=1 to (5*(1+$s))}
		<tr>
			{for $col=1 to (2*(1+$s))}
			<td>
				<div class="container">
					<a href="blabel.php?l={$l}&b={$b}&s={$s}&row={$row}&col={$col}" download="label.hpgl">
						<img src="label.png"{if $s eq 1} style="width:100%"{/if} class="image">
						<div class="w3-padding w3-round w3-blue middle">
							PRINT
						</div>
					</a>
				</div>
			</td>
			{/for}
		</tr>
		{/for}
		<tr>
			<td>
				<p></p>
			</td>
		</tr>
	</table>
</div>
<p></p>
{include file="footer.tpl"}
