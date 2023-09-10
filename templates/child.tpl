{foreach $data as $row}
<li>
	{if ($row.children[0].catid>0) or ($mode eq 1)}
		<span class="caret{if in_array($row.catid, $id)} caret-down{/if}">
	{else}
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="class.php?id={$row.catid}">
	{/if}
	{if ($row.children[0].catid<1) and ($mode eq 1)}
		<a href="feature.php?catid={$row.catid}">
	{/if}
	{$row.cat}
	{if ($row.children[0].catid<1) and ($mode eq 1)}
		</a>
	{/if}
	{if ($row.children[0].catid>0) or ($mode eq 1)}
		</span><ul class="nested{if in_array($row.catid, $id)} active{/if}">
		{if $mode eq 1}
			<form method="get">&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="parent" value="{$row.catid}"><input type="hidden" name="mode" value="1"><input type="text" name="cat"><input type="submit" value="New"></form>
		{/if}
		{if $row.children[0].catid>0}
			{include file="child.tpl" data=$row.children mode=$mode}
		{/if}
		</ul>
	{else}
		</a>
	{/if}
</li>
{/foreach}
