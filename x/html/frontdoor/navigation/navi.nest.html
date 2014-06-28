{assign var=children value=0}
{foreach $navi as $nav => $l} 
    {if $l.parent == $link.id} 
       {assign var=children value=$link.id}
    {/if}
{/foreach}  

{if $linktothe == ''}
    {assign var=linktothe value="{$link.title}"}
{else}
    {assign var=linktothe value="{$linktothe}/{$link.title}"}

{/if}

<li class="span2 dropdown{if $sub && $children gt 0}-rightsubmenu{/if}"><a class="dropdown-toggle" {if !$sub} data-toggle="dropdown"{/if} href="{if !$sub}/{else}/{$linktothe}{/if}"> {$link.title}  {if !$sub && $children gt 0}   <b class="caret"></b>{/if}</a>
{assign var=children value=0}
    {foreach $navi as $nav => $l} 
        {if $l.parent == $link.id} 
           {assign var=children value=$link.id}
        {/if}
    {/foreach} 
    {if $children gt 0}  
        <ul class="dropdown-menu">
            

            {foreach $navi as $nav => $l} 
                {if $l.parent == $link.id} 
                   {include file="frontdoor/navigation/navi.nest.html" linktothe=$linktothe link=$l sub=true}
                {/if}
            {/foreach}
        </ul> 
    {/if}
</li> 
