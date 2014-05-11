<h3>{$text}</h3>
{if isset($error)}
<font color="red">
{/if}
{if isset($message)}
<strong>{$message}</strong>
{/if}
{if isset($error)}
</font>
{/if}
<div class="pageoverflow">
{$formstart}{$formhidden|default:''}
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_email}:</p>
    <p class="pageinput">{$email}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_username}:</p>
    <p class="pageinput">{$username}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_disabled}:</p>
    <p class="pageinput">{$disabled}</p>
  </div>
{if isset($prompt_bounces)}
  <div class="pageoverflow">
    <p class="pagetext">{$prompt_bounces}:</p>
    <p class="pageinput">{$bounces}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('error_count')}:</p>
    <p class="pageinput">
       <input type="text" name="{$actionid}error_count" value="{$userinfo.error_count|default:0}" size="3"/>
    </p>
  </div>
{/if}
  {foreach from=$listids item=curr_id}
    <div class="pageoverflow">
      <p class="pagetext">&nbsp;</p>
      <p class="pageinput">{$curr_id}</p>
    </div>
  {/foreach}
  <div class="pageoverflow">
    <p class="pagetext">&nbsp;</p>
    <p class="pageinput">{$submit}{$cancel}</p>
  </div>
{$formend}
</div>
