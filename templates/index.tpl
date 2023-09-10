{include file="header.tpl"}
<h3>Categories</h3>
<div class="w3-centered w3-card-4 w3-white w3-padding">
<ul id="CatUL">
{foreach $data as $row name=mainloop}
<li>
	{if ($row.children[0].catid>0) or ($mode eq 1)}
		<span class="caret{if in_array($row.catid, $id)} caret-down{/if}"></span>
	{/if}
	{if ($row.children[0].catid<1) and ($mode eq 1)}
		<a href="feature.php?catid={$row.catid}">
	{/if}
	{$row.cat}
	{if ($row.children[0].catid<1) and ($mode eq 1)}
		</a>
	{/if}
	{if ($row.children[0].catid>0) or ($mode eq 1)}
		<ul class="nested{if in_array($row.catid, $id)} active{/if}">
		{if $mode eq 1}
			<form method="get">&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="parent" value="{$row.catid}"><input type="hidden" name="mode" value="1"><input type="text" name="cat"><input type="submit" value="New"></form>
		{/if}
		{if $row.children[0].catid>0}
			{include file="child.tpl" data=$row.children mode=$mode id=$id}
		{/if}
		</ul>
	{/if}
</li>
{/foreach}{if $mode eq 1}<li><form method="get"><input type="hidden" name="parent" value="0"><input type="hidden" name="mode" value="1"><input type="text"  name="cat"><input type="submit" value="New"></form></li>{/if}

</ul>
</div>

<script src="list.js"></script>
{include file="footer.tpl"}
