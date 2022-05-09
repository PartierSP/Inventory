{include file="header.tpl"}
<h3>Categories</h3>
<div class="w3-centered w3-card-4 w3-white">
<ul id="CatUL">
{foreach $data as $row name=mainloop}
<li>{if $row.children[0].catid>0}<span class="caret">{/if}{$row.cat}{if $row.children[0].catid>0}</span><ul class="nested">{include file="child.tpl" data=$row.children}</ul>{/if}</li>
{/foreach}
</ul>
</div>

<script src="list.js"></script>
{include file="footer.tpl"}
