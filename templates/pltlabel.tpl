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
<h3>Instructions:</h3>
<div class="w3-card-4 w3-white w3-padding">
	<p>After selecting which label to print, open a terminal navigate to your Downloads directory.  Then run the following commands to send the label to the plotter.  The first line is only required once per session.</p>
	<div class="w3-code w3-black">stty -F /dev/ttyUSB0 9600 -crtscts ixon ixoff</div>
	<div class="w3-code w3-black">cat label.hpgl > /dev/ttyUSB0 & rm label.hpgl</div>
</div>
<p></p>
{include file="footer.tpl"}
