{if $msg}
    <div class="alert alert-{$msgBoxType|default:'danger'} alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul>
            {foreach $msg as $m}
            <li>{$m};</li>
            {/foreach}
        </ul>
    </div>
{/if}