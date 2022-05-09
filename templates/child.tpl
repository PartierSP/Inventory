{foreach $data as $row}
<li>{if $row.children[0].catid>0}<span class="caret">{else}&nbsp;&nbsp;&nbsp;&nbsp;<a href="class.php?id={$row.catid}">{/if}{$row.cat}{if $row.children[0].catid>0}</span><ul class="nested">{include file="child.tpl" data=$row.children}</ul>{else}</a>{/if}</li>
{/foreach}
