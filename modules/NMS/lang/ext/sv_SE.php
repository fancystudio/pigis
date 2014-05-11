<?php
$lang['import_feu_badversion'] = 'Kunde inte hitta en kompatibel version av FrontEndUsers modulen';
$lang['html'] = 'Html';
$lang['prompt_text_only'] = 'Detta meddelande inneh&aring;ller endast text';
$lang['prompt_archivable'] = 'Kan detta meddelande visas i offentlig lista';
$lang['select_one'] = 'V&auml;lj en';
$lang['help_archivemsg_template'] = 'Ange en mall fr&aring;n listan med mallar f&ouml;r arkivmeddelanden att anv&auml;nda f&ouml;r att visa ett enskilt meddelande. Om detta argument inte anges i taggen kommer mallen f&ouml;r arkivmeddelanden som &auml;r angiven som &#039;standard&#039; att anv&auml;ndas.';
$lang['help_archivelist_template'] = 'Ange en mall f&ouml;r arkivlista att anv&auml;nda n&auml;r arkivlistan visas. Detta &auml;r bara anv&auml;ndbart n&auml;r handlingen (action) archivelist (arkivlista) &auml;r angiven. Om inget v&auml;rde anges kommer mallen som f&ouml;r tillf&auml;llet &auml;r markerad som &#039;standard&#039; att anv&auml;ndas.';
$lang['help_limit'] = 'Denna parameter anv&auml;nds i handlingen &#039;archivelist&#039; f&ouml;r att best&auml;mma det maximala antalet arkivmeddelanden som ska visas.';
$lang['help_sortorder'] = 'Denna parameter anv&auml;nds i handligen &#039;archivelist&#039; f&ouml;r att best&auml;mma sorteringsordningen f&ouml;r de visade meddelandena. M&ouml;jliga v&auml;rden &auml;r: ASC (stigande) och DESC (fallande).';
$lang['help_sortby'] = 'Denna parameter anv&auml;nds i handlingen &#039;archivelist&#039; f&ouml;r att kontrollera f&auml;ltet som anv&auml;nds f&ouml;r att sortera meddelandena. M&ouml;jliga v&auml;rden &auml;r msgid, id, subjectdate och entered.';
$lang['title_setdflt_archivemsgtmpl'] = 'Standardmall f&ouml;r Visa Meddelande';
$lang['info_setdflt_archivemsgtmpl'] = 'Med detta formul&auml;r anger du standardinneh&aring;llet i en mall f&ouml;r visa meddelande, som anv&auml;nds n&auml;r du skapar en ny mall i visa meddelande-sektionen i fliken &quot;Arkivmallar&quot;. Att &auml;ndra inneh&aring;llet i den h&auml;r textrutan p&aring;verkar inte vad som f&auml;r n&auml;rvarande visas p&aring; din webbsida.';
$lang['addedit_archivemsg_template'] = 'Mall f&ouml;r L&auml;gg till/&auml;ndra visa meddelande';
$lang['info_templatemessage_archivemsg'] = '';
$lang['modified'] = '&Auml;ndrad';
$lang['text_message'] = 'Textmeddelande';
$lang['html_message'] = 'HTML-meddelande';
$lang['message_id'] = 'Meddelande-ID';
$lang['archive_summary_templates'] = 'Arkivsammanfattningsmallar';
$lang['archive_detail_templates'] = 'Arkivdetaljmallar';
$lang['title_setdflt_archivelistmpl'] = 'Standardmall f&ouml;r arkivlista';
$lang['info_setdflt_archivelisttmpl'] = 'I det h&auml;r formul&auml;ret kan du ange det standardinneh&aring;llet f&ouml;r en arkivmall som anv&auml;nds n&auml;r du skapar en ny mall i fliken &#039;Arkivmallar&#039;. Att &auml;ndra inneh&aring;llet i den h&auml;r textrutan p&aring;verkar inte vad som f&ouml;r n&auml;rvarande visas p&aring; din webbsida.';
$lang['title_setdflt_messagetemplate'] = 'Standardmall f&ouml;r meddelande';
$lang['info_setdflt_messagetemplate'] = 'I det h&auml;r formul&auml;ret kan du ange &#039;skelettmallen&#039; f&ouml;r meddelanden, som anv&auml;nds n&auml;r du skapar en ny mall i fliken &quot;Meddelandemallar&quot;.';
$lang['addedit_archivelist_template'] = 'L&auml;gg till/ta bort mall f&ouml;r arkivlista';
$lang['info_templatemessage_archivelist_'] = '';
$lang['default_templates'] = 'Standardmallar';
$lang['archive_templates'] = 'Arkivmallar';
$lang['jobs_warning'] = '<h3>Varning:</h3>Felaktig anv&auml;ndning av den h&auml;r modulen kan orsaka avsev&auml;rda problem med din v&auml;rd, med dina kunder, eller t.om. med lagen. Den h&auml;r modulens utvecklare &aring;tar sig inga risker eller ansvar f&ouml;r hur den h&auml;r koden anv&auml;nds. <strong>Anv&auml;nd p&aring; egen risk</strong>';
$lang['warning'] = 'Varning';
$lang['send_admin_copy'] = 'Skicka kopia till administrat&ouml;ren';
$lang['message_charset'] = 'Teckenupps&auml;ttning f&ouml;r meddelanden';
$lang['bounce_limit'] = 'Gr&auml;ns f&ouml;r efters&auml;ndning';
$lang['info_bounce_limit'] = 'Antalet till&aring;tna efters&auml;ndningar innan en anv&auml;ndare avaktiveras (max 100)';
$lang['bounce_messagelimit'] = 'Gr&auml;ns f&ouml;r efters&auml;ndningsmeddelanden';
$lang['info_bounce_messagelimit'] = 'Antalet pop3-meddelanden som kan bearbetas samtidigt (max 1000).';
$lang['error_pop3_processing'] = 'Problem att bearbeta efters&auml;ndningar';
$lang['error_pop3_connect'] = 'Problem att ansluta till pop3-server';
$lang['error_invalidbounces'] = 'Efters&auml;ndningsantalet &auml;r ogiltigt (0 till 100)';
$lang['bounce_count'] = 'Antal efters&auml;ndningar';
$lang['nms_job_complete_subject'] = 'NMS-epostjobbet avslutat';
$lang['nms_job_complete_msg'] = 'NMS-epostjobbet &auml;r avslutat, det tog %s sekunder';
$lang['pop3_server'] = 'pop3-server';
$lang['pop3_username'] = 'pop3-anv&auml;ndarnamn';
$lang['pop3_password'] = 'pop3-l&ouml;senord';
$lang['admin_email'] = 'E-post till administrat&ouml;ren';
$lang['admin_name'] = 'Administrat&ouml;rens namn';
$lang['admin_replyto'] = 'SvaraTill-adress f&ouml;r administrat&ouml;ren';
$lang['process_bounces'] = 'Bearbeta efters&auml;ndningar';
$lang['error_notemplates'] = 'Kunde inte hitta n&aring;gra matchande mallar';
$lang['error_notemplatebyname'] = 'Kunde inte hitta n&aring;gon mall med namnet %s';
$lang['addedit_template'] = 'L&auml;gg till/redigera meddelandemall';
$lang['prompt_textmessage'] = 'Textmeddelande';
$lang['found'] = 'hittad';
$lang['template'] = 'Mall';
$lang['templates'] = 'Mallar';
$lang['add_template'] = 'L&auml;gg till mall';
$lang['message_templates'] = 'Meddelandemallar';
$lang['default_confirm_subject'] = 'V&auml;nligen bekr&auml;fta din registrering';
$lang['default_postsubscribe_text'] = 'Tack f&ouml;r din registrering.';
$lang['default_subscribe_subject'] = 'Registreringen bekr&auml;ftad.';
$lang['default_unsubscribe_subject'] = 'Meddelande vid avregistrering.';
$lang['cleantemptable'] = 'Rensa tempor&auml;r tabell';
$lang['error_problemwithmessage'] = 'Ospecificerat meddelandeproblem';
$lang['prompt_usersettings_page'] = '&Aring;terv&auml;ndningssida f&ouml;r formul&auml;ret Anv&auml;ndarinst&auml;llningarn';
$lang['info_usersettings_page'] = 'Sida att g&aring; till d&aring; en l&auml;nk i ett mail klickas f&ouml;r att redigera anv&auml;ndarinst&auml;llningar.<br/>En asterisk (*) indikerar f&ouml;rvald startsida i din webbplats.';
$lang['jobname'] = 'Utskicksjobb skapat';
$lang['msg_jobprocessing'] = 'F&ouml;nster f&ouml;r masshantering';
$lang['prompt_page'] = '&Aring;terv&auml;ndningssida';
$lang['error_insufficientparams'] = 'En eller fler n&ouml;dv&auml;ndiga parametrar saknas fr&aring;n f&ouml;rfr&aring;gan. Den h&auml;r h&auml;ndelsen kan inte forts&auml;tta';
$lang['prompt_from'] = 'Fr&aring;n';
$lang['prompt_replyto'] = 'Svara till (Reply To)';
$lang['prompt_subject'] = '&Auml;mne';
$lang['prompt_template'] = 'Mall';
$lang['prompt_selectstatus'] = 'V&auml;lj status';
$lang['prompt_message'] = 'Meddelande';
$lang['prompt_userfilter'] = 'Email-filter (regulj&auml;rt uttryck)';
$lang['prompt_listfilter'] = 'Filtrera listan p&aring; medlemsskap';
$lang['info_listfilter'] = '<strong>Notis:</strong> H&aring;ll nere CTRL-tangenten medan du klickar p&aring; rader du vill markera eller avmarkera.
';
$lang['message_help'] = '<h3>Message Authoring:</h3><p>When typing a message, the following <em>smarty</em> variables are available:<br/>
<em>{$username}</em> - The users name<br/>
<em>{$email}</em> - The users email address<br/>
<em>{$unsubscribe}</em> - A URL that can be used to display a page for unsubscribing<br/>
<em>{$preferences}</em> - A URL that can be used to display a user preferences page<br/>
<em>{$confirmurl}</em> - A URL that can be used to confirm subscriptions<br/>
<p>In addition, you can use any other smarty variable, function or modifier in your message template or content.  You can even embed the output from other CMS Made Simple modules (if the template styles are taken care of, you may need to use seperate templates than what you use for your page output).  See the {get_template_vars} and the {$object|print_r} modifier to further debug your messages.</p>
<p><strong>Note: </strong>Images added to content blocks via the wysiwyg image functionality will result in the output email containing absolute references to external images.  <em>The images will NOT be attached to the email.</em></p>
<p><strong>Tip: </strong>Be sure to use the {literal} and {/literal} tags around any \<style\> tags.</p>';
$lang['message_help2'] = '<h3>Notice:</h3>
<p>If you do not have a properly defined message template, then you will only be able to create text messages using the contents from the &#039;Text Message&#039; edit area.  If at least one content block, exists, the message is assumed to be in HTML format.  If the &#039;Text Message&#039; edit area remains empty, then the multipart portion of the email will not be sent.</p>';
$lang['applyfilter'] = 'Filter';
$lang['info_event_OnNewUser'] = 'Genereras n&auml;r en ny anv&auml;ndare prenumererar p&aring; en eller flera s&auml;ndlistor';
$lang['info_event_OnEditUser'] = 'Genereras n&auml;r informationen om en anv&auml;ndare &auml;ndras via admingr&auml;nssnittet eller via front end';
$lang['info_event_OnDeleteUser'] = 'Genereras n&auml;r en anv&auml;ndare tas bort';
$lang['info_event_OnNewList'] = 'Genereras n&auml;r en s&auml;ndlista &auml;ndras';
$lang['info_event_OnDeleteList'] = 'Genereras n&auml;r en s&auml;ndlista tas bort';
$lang['info_event_OnCreateMessage'] = 'Genereras n&auml;r ett meddelande skapas';
$lang['info_event_OnEditMessage'] = 'Genereras n&auml;r ett meddelande &auml;ndras';
$lang['info_event_OnDeleteMessage'] = 'Genereras n&auml;r ett meddelande tas bort';
$lang['info_event_OnCreateJob'] = 'Genereras n&auml;r ett utskicksjobb &auml;r skapat';
$lang['info_event_OnDeleteJob'] = 'Genereras n&auml;r ett utskicksjobb &auml;r borttaget';
$lang['info_event_OnStartJob'] = 'Genereras n&auml;r ett utskicksjobb p&aring;b&ouml;rjas';
$lang['info_event_OnFinishJob'] = 'Genereras n&auml;r ett utskicksjobb avslutas';
$lang['help_OnNewUser'] = '<p>An event generated when a new user subscribes to one or more mailing lists</p>
<h4>Parameters</h4>
<ul>
<li><em>email</em> - Users email address</li>
<li><em>username</em> - Username</li>
<li><em>lists</em> - Array of member lists</li>
</ul>
';
$lang['help_OnEditUser'] = '<p>An event generated when a user is modified either in the admin or via the front end</p>
<h4>Parameters</h4>
<ul>
<li><em>email</em> - Users email address</li>
<li><em>username</em> - Username</li>
<li><em>lists</em> - Array of member lists</li>
<li><em>id</em> - The user id</li>
</ul>
';
$lang['help_OnDeleteUser'] = '<p>An event generated when a user is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>id</em> - The user id</li>
</ul>
';
$lang['help_OnNewList'] = '<p>An event generated when a new mailing list is created</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The list name</li>
<li><em>description</em> - List description</li>
<li><em>public</em> - Public flag</li>
</ul>
';
$lang['help_OnEditList'] = '<p>An event generated when a mailing list is modified</p>
<h4>Parameters</h4>
<ul>
<li><em>name</em> - The list name</li>
<li><em>description</em> - List description</li>
<li><em>public</em> - Public flag</li>
<li><em>listid</em> - The list ID</li>
</ul>
';
$lang['help_OnDeleteList'] = '<p>An event generated when a mailing list is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>listid</em> - The list ID</li>
</ul>
';
$lang['help_OnCreateMessage'] = '<p>An event generated when a message is created</p>
<h4>Parameters</h4>
<ul>
<li><em>fromwho</em> - The Name of the person this message is from</li>
<li><em>reply_to</em> - The Email address for the reply to field</li>
<li><em>subject</em> - The subject of the message</li>
<li><em>message</em> - The body of the message <em>(may contain smarty tags)</em></li>
<li><em>entered</em> - The date the message was entered</li>
<li><em>uniqueid</em> - The unique id of this message</em>
</ul>
';
$lang['help_OnEditMessage'] = '<p>An event generated when a message is modified</p>
<h4>Parameters</h4>
<ul>
<li><em>fromwho</em> - The Name of the person this message is from</li>
<li><em>reply_to</em> - The Email address for the reply to field</li>
<li><em>subject</em> - The subject of the message</li>
<li><em>message</em> - The body of the message <em>(may contain smarty tags)</em></li>
<li><em>messageid</em> - The ID of this message</id>
</ul>
';
$lang['help_OnDeleteMessage'] = '<p>An event generated when a message is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>messageid</em> - The ID of the message that has been deleted</li>
</ul>
';
$lang['help_OnCreateJob'] = '<p>An event generated when a job is created</p>
<h4>Parameters</h4>
<ul>
<li><em>jobid</em> - The ID of this job</li>
<li><em>jobname</em> - The name of this job</li>
<li><em>lists</em> - An array of listids</li>
</ul>
';
$lang['help_OnDeleteJob'] = '<p>An event generated when a job is deleted</p>
<h4>Parameters</h4>
<ul>
<li><em>jobid</em> - The ID of this job</li>
</ul>
';
$lang['help_OnStartJob'] = '<p>An event generated when the processing of a job begins</p>
<h4>Parameters</h4>
<ul>
<li><em>jobid</em> - The ID of this job</li>
<li><em>jobname</em> - The name of this job</li>
</ul>
';
$lang['help_OnFinishJob'] = '<p>An event generated when the processing of a job finishes</p>
<h4>Parameters</h4>
<ul>
<li><em>jobid</em> - The ID of this job</li>
<li><em>jobname</em> - The name of this job</li>
</ul>
';
$lang['error_needreplyto'] = 'Du m&aring;ste skriva in en giltig epostadress f&ouml;r svar';
$lang['error_needfrom'] = 'Du m&aring;ste skriva in ett giltigt namn f&ouml;r meddelandets avs&auml;ndare';
$lang['error_needsubject'] = 'Du m&aring;ste skriva in n&aring;got i &auml;mnesraden';
$lang['error_needmessagetext'] = 'Du m&aring;ste skriva in n&aring;got i meddelandedelen';
$lang['error_formerror'] = 'Formul&auml;rsfel';
$lang['error_dberror'] = 'Databasfel';
$lang['error_nameexists'] = 'En post med det namnet finns redan';
$lang['error_itemnotfound'] = 'Den angivna posten kunde inte hittas';
$lang['error_invalidparam'] = 'Ogiltig parameter';
$lang['invalidparam'] = 'Ogiltig parameter i anropet av modulen NMS';
$lang['prompt_users_per_page'] = 'Antal anv&auml;ndare att visa p&aring; varje sida av anv&auml;ndarlistan';
$lang['disabled'] = 'Avaktiverad';
$lang['confirmed'] = 'Bekr&auml;ftad';
$lang['prompt_usersettings_text2'] = 'Text som visas efter att anv&auml;ndarinst&auml;llningsformul&auml;ret skickats';
$lang['prompt_usersettings_form2'] = 'Formul&auml;r som visas f&ouml;r anv&auml;ndare som vill &auml;ndra inst&auml;llningar';
$lang['prompt_usersettings_text'] = 'Text som visas efter att e-postmeddelande med anv&auml;ndarinst&auml;llningar skickats';
$lang['prompt_usersettings_email_body'] = 'Meddelandet i e-postmeddelandet med anv&auml;ndarinst&auml;llningar';
$lang['prompt_usersettings_subject'] = '&Auml;mne f&ouml;r e-postmeddelande med anv&auml;ndarinst&auml;llningar';
$lang['prompt_usersettings_form'] = 'Formul&auml;r d&auml;r anv&auml;ndare som vill &auml;ndra sina inst&auml;llningar skriver in e-postadress';
$lang['prompt_post_unsubscribe_text'] = 'Text som visas efter att avregistreringsprocessen &auml;r genomf&ouml;rd';
$lang['user_settings'] = 'Anv&auml;ndarinst&auml;llningar';
$lang['prompt_unsubscribe_prompt'] = 'Inmatningsmark&ouml;r d&auml;r anv&auml;ndaren fr&aring;gas efter sin e-postadress f&ouml;r att avregistrera sig';
$lang['prompt_unsubscribe_text'] = 'Text som visas efter att formul&auml;ret f&ouml;r att avregistrera har skickats';
$lang['prompt_unsubscribe_subject'] = '&Auml;mne f&ouml;r e-postmeddelandet som skickas n&auml;r n&aring;gon vill avregistrera sig';
$lang['prompt_unsubscribe_email_body'] = 'Meddelandet i e-postmeddelande som skickas n&auml;r n&aring;gon vill avregistrera sig';
$lang['prompt_unsubscribe_form'] = 'Mall f&ouml;r avregistreringsformul&auml;r';
$lang['error_accountdisabled'] = 'Tyv&auml;rr, men ditt konto har avaktiverats och handlingen &auml;r just nu inte m&ouml;jlig';
$lang['prompt_post_confirm_text'] = 'Meddelande som visas efter att anv&auml;ndare bekr&auml;ftat e-postmeddelande';
$lang['prompt_confirm_email_body'] = 'Meddelande f&ouml;r bekr&auml;ftelsemail';
$lang['prompt_confirm_subject'] = '&Auml;mne f&ouml;r bekr&auml;ftelsemail';
$lang['confirm_subscribe'] = 'Bekr&auml;fta registrering';
$lang['confirm_unsubscribe'] = 'Bekr&auml;fta avregistrering';
$lang['nolists'] = 'Inga listor finns att registrera sig f&ouml;r';
$lang['public'] = 'Offentlig';
$lang['yes'] = 'Ja';
$lang['no'] = 'Nej';
$lang['prompt_postsubscribetext'] = 'Meddelande som visas efter registrering';
$lang['subscription_confirmed'] = 'Registrering bekr&auml;ftad';
$lang['reset'] = '&Aring;terst&auml;ll';
$lang['suspend'] = 'Uteslut';
$lang['resume'] = '&Aring;teruppta';
$lang['action'] = 'H&auml;ndelse';
$lang['processing_records'] = 'Behandlar posterna %s till %s';
$lang['initializing_job'] = 'Initierar jobb';
$lang['processing_job'] = 'Behandlar jobb';
$lang['deletecompleted'] = 'Radera utf&ouml;rda jobb';
$lang['error_importerrorcount'] = 'Felr&auml;kning';
$lang['lines'] = 'Rader';
$lang['users_added'] = 'Anv&auml;ndare tillagda';
$lang['memberships'] = 'Medlemskap';
$lang['subscribe'] = 'Registrera';
$lang['resetdefaults'] = '&Aring;terst&auml;ll standardinst&auml;llningar';
$lang['confirm_adjustsettings'] = '&Auml;r du s&auml;ker p&aring; att du vill &auml;ndra de h&auml;r inst&auml;llningarna?';
$lang['confirm_resetdefaults'] = '&Auml;r du s&auml;ker p&aring; att du vill &aring;terst&auml;lla det h&auml;r formul&auml;ret till dess ursprungliga v&auml;rden?';
$lang['prompt_subscribetext'] = 'Registreringstext';
$lang['prompt_subscribesubject'] = '&Auml;mne f&ouml;r registrering';
$lang['prompt_subscribe_email_body'] = 'Meddelande f&ouml;r registreringsmail';
$lang['prompt_subscribe_form'] = 'Mall f&ouml;r registreringsformul&auml;ret';
$lang['subscribe_form'] = 'Registrera';
$lang['unsubscribe_form'] = 'Avregistrera';
$lang['error_insertinglist'] = 'Problem att skapa ny lista';
$lang['error_emailexists'] = 'Den e-postadressen finns redan i anv&auml;ndarlistan';
$lang['error_invalidusername'] = 'Otill&aring;tet anv&auml;ndarnamn';
$lang['error_invalidid'] = 'Otill&aring;tet unik-ID';
$lang['error_invalidemail'] = 'FEL - Ogiltig epostadress';
$lang['username'] = 'Anv&auml;ndarnamn';
$lang['name'] = 'Namn';
$lang['prompt_public'] = 'Detta &auml;r en offentlig e-postlista';
$lang['error_usernotfound'] = 'Kunde inte hitta anv&auml;ndare med det angivna unik-ID&#039;t';
$lang['prompt_ms_between_message_sleep'] = 'F&ouml;rdr&ouml;jning (i millisekunder) mellan varje meddelande som s&auml;nds';
$lang['prompt_between_batch_sleep'] = 'F&ouml;rdr&ouml;jning (i sekunder) mellan varje omg&aring;ng av mail som s&auml;nds';
$lang['prompt_messages_per_batch'] = 'Maximalt antal meddelanden som s&auml;nds i varje omg&aring;ng';
$lang['okclosewindow'] = 'Du kan nu st&auml;nga det h&auml;r f&ouml;nstret';
$lang['queuefinished'] = 'Meddelandena i k&ouml;n har s&auml;nts';
$lang['totaltime'] = 'Total tid f&ouml;r att s&auml;nda meddelanden:';
$lang['seconds'] = 'Sekunder';
$lang['totalmails'] = 'Totalt antal epostmeddelanden som s&auml;nts (inkl. till administrat&ouml;ren):';
$lang['page'] = 'Sida';
$lang['of'] = 'av';
$lang['info_csvformat'] = 'Den importerade filen m&aring;ste vara i formatet CSV (kommaseparerat), med en post per rad. Det f&ouml;rsta f&auml;ltet ska vara en epostadress, och det andra f&auml;ltet namn p&aring; en lista. Epostadresserna kan repeteras p&aring; flera rader';
$lang['prompt_lines'] = 'Rader importerade';
$lang['prompt_usersadded'] = 'Anv&auml;ndare tillagda';
$lang['prompt_membershipsadded'] = 'Prenumeranter tillagda';
$lang['prompt_errorcount'] = 'Antal fel';
$lang['importerror_cantgetuserid'] = 'Fel p&aring; rad %s, kunde inte l&auml;sa userid (anv&auml;ndar-ID) %s';
$lang['importerror_cantcreateuser'] = 'Fel p&aring; rad %s, kunde inte skapa anv&auml;ndare %s';
$lang['importerror_nosuchlist'] = 'Fel p&aring; rad %s, listan %s finns inte';
$lang['importerror_nofields'] = 'Fel p&aring; rad %s, inte tillr&auml;ckligt m&aring;nga f&auml;lt';
$lang['import_users'] = 'Importera anv&auml;ndare fr&aring;n CSV';
$lang['error_emptyfile'] = 'FEL - En tom fil laddades upp';
$lang['error_nofilesuploaded'] = 'FEL - inga filer laddades upp';
$lang['filename'] = 'Importera filnamn';
$lang['title_users_import'] = 'Importera anv&auml;ndare';
$lang['title_users_export'] = 'Exportera anv&auml;ndare fr&aring;n databasen';
$lang['nummessages'] = 'antal meddelanden';
$lang['created'] = 'Skapad';
$lang['started'] = 'Startad';
$lang['finished'] = 'Avslutad';
$lang['processjobs'] = 'S&auml;nd jobb';
$lang['status_error'] = 'FEL';
$lang['status_unstarted'] = 'Ej startad';
$lang['status_inprogress'] = 'under arbete';
$lang['status_paused'] = 'Pausad';
$lang['status_complete'] = 'Komplett';
$lang['status_unknown'] = 'Ok&auml;nd';
$lang['error_jobnameexists'] = 'FEL - Ett jobb med det namnet finns redan';
$lang['createjob'] = 'Skapa jobb';
$lang['prompt_email_user_on_admin_subscribe'] = 'Skicka email till anv&auml;ndare n&auml;r administrat&ouml;ren manuellt l&auml;gger till prenumeranter till en lista';
$lang['error_nomessagesselected'] = 'Inga meddelanden valda';
$lang['error_nolistsselected'] = 'Inga listor valda';
$lang['createjobmsg'] = 'V&auml;lj ett meddelande, och en eller flera listor att skicka meddelandet till';
$lang['error_nojobname'] = 'FEL - Inga jobbnamn specificerade';
$lang['error_nolists'] = 'FEL - Inga listor!';
$lang['error_nomessages'] = 'FEL - Inga meddelanden!';
$lang['jobs'] = 'Jobb';
$lang['status'] = 'Status';
$lang['jobsfoundtext'] = 'Jobb funna';
$lang['messagesfoundtext'] = 'Meddelanden funna';
$lang['entered'] = 'Angett';
$lang['subject'] = '&Auml;mne';
$lang['from'] = 'Fr&aring;n';
$lang['delete_user_confirm'] = '&Auml;r du s&auml;ker p&aring; att du vill ta bort den h&auml;r anv&auml;ndaren';
$lang['info_singlelist'] = 'Den h&auml;r anv&auml;ndaren l&auml;ggs till till den enda mailinglistan';
$lang['error_selectonelist'] = 'Du m&aring;ste v&auml;lja minst en lista';
$lang['error_invaliduniqueid'] = 'FEL - Ogiltigt unikt ID';
$lang['error_couldnotfindjobpart'] = 'FEL - Kan inte hitta ett best&auml;llt utskicksjobb i databasen. Det kan betyda att en annan anv&auml;ndare (du?) redigerar eller tar bort utskicksjobb medan ett utskick p&aring;g&aring;r.';
$lang['error_couldnotfindmessage'] = 'FEL - Kunde inte hitta ett best&auml;llt meddelande. Det kan betyda att en annan anv&auml;ndare (du?) redigerar eller tar bort ett meddelande medan ett utskick p&aring;g&aring;r.';
$lang['error_couldnotfindtemplate'] = 'FEL - Kunde inte hitta en best&auml;lld sidomall. Det kan betyda att mallen togs bort efter att meddelandet har skapats.';
$lang['error_temporarytableexists'] = 'FEL - Den tempor&auml;ra databastabeller som anv&auml;nds f&ouml;r utskick finns redan. Detta betyder antagligen att ett fel uppst&aring;tt vid ett tidigare utskick.';
$lang['error_buildingtemptable'] = 'FEL - Ett fel uppstod d&aring; den tempor&auml;ra tabellen skulle fyllas med information.';
$lang['error_otherprocessingerror'] = 'FEL - Ett uppstod vid hanteringen';
$lang['userid'] = 'Anv&auml;ndar-ID';
$lang['emailaddress'] = 'Epostadress';
$lang['usersfoundtext'] = 'Anv&auml;ndare funna';
$lang['title_user_createnew'] = 'L&auml;gg till anv&auml;ndare';
$lang['error_invalidlistname'] = 'FEL - Ogiltigt listnamn';
$lang['editlist_text'] = 'Redigera lista';
$lang['id'] = 'ID';
$lang['listsfoundtext'] = 'Listor funna';
$lang['users'] = 'Anv&auml;ndare';
$lang['preferences'] = 'Inst&auml;llningar';
$lang['messages'] = 'Meddelanden';
$lang['queue'] = 'K&ouml;';
$lang['submit'] = 'Skicka';
$lang['cancel'] = 'Avbryt';
$lang['description'] = 'Beskrivning';
$lang['createnewlist_text'] = 'Skapa lista';
$lang['lists'] = 'Listor';
$lang['friendlyname'] = 'NewsletterMadeSimple';
$lang['postinstall'] = 'Tack f&ouml;r att du installerade NMS. Gl&ouml;m inte att st&auml;lla in r&auml;ttigheten &quot;Use NMS&quot; f&ouml;r att anv&auml;nda den h&auml;r modulen!';
$lang['postuninstall'] = 'Newsletter Made Simple &auml;r avinstallerat.';
$lang['uninstalled'] = 'Modulen har avinstallerats.';
$lang['installed'] = 'Modul med versionsnummer %s &auml;r installerad.';
$lang['prefsupdated'] = 'Inst&auml;llningar f&ouml;r modulen Newsletter Made Simple uppdaterade.';
$lang['newslettercreated'] = 'Ett nytt nyhetsbrev har skapats.';
$lang['no_email_error'] = 'Du m&aring;ste fylla i en epostadress.';
$lang['subscribe_thankyou'] = 'Tack f&ouml;r din prenumeration. Ett bekr&auml;ftelsemail har skickats till din epostadress.';
$lang['enter_valid_email'] = 'Du m&aring;ste ange en giltig epostadress och v&auml;lja &aring;tminstone en lista.';
$lang['newslettercreatederror'] = 'Du m&aring;ste ange ett namn och en beskrivning.';
$lang['accessdenied'] = 'Tillst&aring;nd nekat. V&auml;nligen kontrollera dina r&auml;ttigheter.';
$lang['error'] = 'Fel!';
$lang['sent'] = 'Skickat';
$lang['inqueue'] = 'I k&ouml;';
$lang['send_next_batch'] = 'Skickar n&auml;sta omg&aring;ng av %s-meddelande, med b&ouml;rjan kl. %s';
$lang['messages_sent'] = '%s har skickats';
$lang['closewindow'] = 'St&auml;ng f&ouml;nster';
$lang['testmode'] = 'Du &auml;r i testl&auml;ge. Inga epostmeddelanden skickas.';
$lang['confirmdeletejob'] = '&Auml;r du s&auml;ker p&aring; att du vill ta bort det h&auml;r jobbet';
$lang['confirmsend'] = '&Auml;r du s&auml;ker p&aring; att du vill skicka alla meddelanden?';
$lang['confirmdelete'] = '&Auml;r du s&auml;ker p&aring; att du vill ta bort det h&auml;r meddelandet?';
$lang['confirmdeletelist'] = '&Auml;r du s&auml;ker p&aring; att du vill ta bort den h&auml;r listan?';
$lang['keepwindowopen'] = 'L&aring;t det h&auml;r f&ouml;nstret vara &ouml;ppet tills alla meddelanden har skickats.<br />';
$lang['profileupdated'] = 'Din profil har uppdaterats.';
$lang['upgraded'] = 'Modulen uppgraderad till version %s.';
$lang['title_mod_prefs'] = 'Konfiguration';
$lang['title_mod_messages'] = 'Meddelandek&ouml;';
$lang['title_mod_createnew'] = 'Skapa en lista';
$lang['title_mod_manage_user'] = 'Prenumeranter';
$lang['title_mod_compose_job'] = 'Skapa jobb';
$lang['title_mod_compose_message'] = 'Skriv meddelande';
$lang['title_mod_process_queue'] = 'Skicka k&ouml;';
$lang['title_mod_admin'] = 'Hantera listor';
$lang['user_delete_confirm'] = '&Auml;r du s&auml;ker p&aring; att du vill ta bort den h&auml;r anv&auml;ndaren?';
$lang['userdeleted'] = 'Anv&auml;ndare borttagen';
$lang['newsletterdeleted'] = 'Nyhetsbrev borttaget';
$lang['delete'] = 'Ta bort';
$lang['edit'] = 'Redigera';
$lang['previous'] = 'F&ouml;reg&aring;ende';
$lang['next'] = 'N&auml;sta';
$lang['unsubscribemessage'] = 'Du &auml;r nu avregistrerad. Tack.';
$lang['title_admin_panel'] = 'Newsletter Made Simple';
$lang['moddescription'] = 'Den h&auml;r modulen l&aring;ter dig skapa ett system f&ouml;r nyhetsbrev.';
$lang['welcome_text'] = '<p>V&auml;lkommen till administrationem f&auml;r Newsletter Made Simple (NMS). </p>';
$lang['changelog'] = '<ul>
<li>Todo:
<ul>
<li>Lists Tab - show disabled vs active lists</li>
<li>Lists - ability to Mark a list as inactive</li>
<li>Users - Ability to filter on confirmed or unconfirmed
<p>Admin should be able to check all unconfirmed users and either confirm them all, or send them another confirmation email message</p>
<li>Users - Ability to prefer text or html mail (much later)</li>
<li>Something to allow a user to re-get the confirmation email</li>
<li>Docs, docs, and more docs</li>
<li><b>The frontend</b></li>
<ul>
  <li>complete the two stage unsubscribe process</li>
  <li>complete the two stage change preferences process</li>
  <li>Add a preference as to wether or not users should get a confirmation email after subscribing and unsubscribing</p>
</ul>
<li>Styling the progress page</li>
</ul>
</li>
<li>Version 2.0 - December, 2007
    <p><strong>Note:</strong> This is a Significant set of enhancements to NMS that required breaking backwards compatibility, this version will NOT upgrade from previous versions of NMS.  You should export all data, save it to text files, etc.... and re-import the data later.</p>
    <ul>
      <li>Complete templating support</li>
      <li>Complete support for multipart messages (text and html)</li>
      <li>Complete support for embedded images and attachments</li>
      <li>Bounce Processing via pop3</li>
      <li>Significant rewrite of the frontend (archive and showtemplate actions)</li>
    </ul>
    <p>Thanks to _SjG_ for finding the simple templating issue that caused problems with empty email content on php4 hosts.</p>
</li>
<li>Version 1.0.2 - August, 2007</li>
<p>Allow importing users from FEU <em>(originally done by skypanther, re-implemented by calguy100).</em></p>
<p>Numerous bug fixes</p>
<li>Version 1.0.1 - December, 2006</li>
<p>Fixes to import users, and to a ternery expression when creating a message. I also fixed some stupid problems with process_queue resulting from me doing this too quickly.</p>
<li>Version 1.0 - December, 2006</li>
<p>This <b>is</b> essentially a complete rewrite of the old NMS module.  Everything has been cleaned up and attemtpts have been made to bring it up to proper standards, and lots of new features added. here is a list of the major improvements:</p>
<ul>
<li>Cleanup of the lang strings, etc.</li>
<li>Param-ize the queries for security</li>
<li>Added the concept of Jobs, so that messages can be re-used</li>
<li>Added the concept of username (optional)</li>
<li>Added smarty processing on templates</li>
<li>Added bulk import</li>
<li>Added the concept of a &#039;private list&#039;</p>
<li>Devided the admin panel into tabs</li>
<li>Show progress nicely when processing large jobs</li>
<li>Uses CMSMailer module</li>
<li>Events that can be trapped to add additional behaviour</li>
</ul>
<p><strong>Note</strong>, upgrade from the previous version <em>(Including previous betas)</em>is not possible.  A complete uninstall of the old version is required before installing this version of NMS.</p>
</li>
<li>Version .74 27 November 2005. Alpha 3 Release. Fixed bug with confirmation message returnid, image urls, windows php, and a few other small issues.</li>
<li>Version .73 23 November 2005. Alpha 2 Release. Fixed bug with adding messages.</li>
<li>Version .71 22 November 2005. Alpha 1 Release.</li>
<li>Version .5. 17 September 2005. Internal Release.</li>
</ul>';
$lang['helpselect'] = 'Specificera en kommaseparerad lista &ouml;ver s&auml;ndlistor f&ouml;r visning.<em>(Endast giltig i prenumerationsl&auml;ge)</em>';
$lang['helpaction'] = 'Ett s&auml;tt att ange hur modulen ska fungera. Alternativen &auml;r:
<ul>
<li>archivelist - visa ett meddelandearkiv</li>
<li>showmessage - visa ett specifikt meddelande</li>
</ul>
';
$lang['helpmode'] = 'Ange s&auml;ttet p&aring; vilket modulen ska anv&auml;ndas/visas (g&auml;ller enbart n&auml;r handling inte &auml;r angiven eller satt till &#039;default&#039;. Alternativ &auml;r:
<ul>
<li>subscribe (standard) - visa registreringsformul&auml;ret</li>
<li>unsubscribe - visa avregistreringsformul&auml;ret</li>
<li>usersettings - visa formul&auml;ret f&ouml;r anv&auml;ndarinst&auml;llningar</li>
</ul>
';
$lang['help'] = '<h3>Newsletter Made Simple (NMS) </h3>
<h3><strong>What does it do?  </strong></h3>
<p>Enables you to have a e-mail newsletter system inside CMS Made Simple.</p>
<p>Features:
<ul>
  <li>Allows for public (users can subscribe and unsubscribe at will) and private (admins maintained) lists</li>
  <li>Allows for email confirmation of subscription and unsubscribe activities</li>
  <li>Allows for disabling certain users</li>
  <li>Import and export of users</li>
  <li>Completely template driven</li>
  <li>Allows displaying archived messages in the frontend</li>
  <li>Complete template driven messaging system</li>
  <li>Messages can be stored and re-used</li>
  <li>Allows for embedding images into emails</li>
  <li>Allows attaching files to emails</li>
  <li>Handles bounces</li>
  <li>Supports pretty urls</li>
  <li>Lots more</li>
</ul>
</p>
<h3>READ THIS FIRST</h3>
<p>This is an EXPERT tool, designed for use by bulk emailing experts.  It is not designed for use by people that don&#039;t have intimate knowledge of the advantages and pitfalls of sending HTML emails.  If you don&#039;t have the required knowledge you should seriously consider NOT using this package.</p>
<p>This module can be used for sending bulk emails.  This can be a problematic and error prone process, and you should do considerable research before using this module.  Things you should research include:
<ul>
  <li>How to Send bulk emails so that they won&#039;t be interpreted as spam</li>
  <li>Repeatedly sending spam, or sending spam to a large amount of email addresses could get your domain blacklisted, and possibly all of the domains hosted by your ISP. <strong>Use extreme caution.</strong></li>
  <li>How to send HTML emails so that your clients will be able to read them</li>
  <li>Your hosts policy and limitations about email sending</li>
  <li>How to research removing your ISP from various blacklists as a result of implied spamming</li>
  <li>If sending bulk email using an address list you acquired or purchased from others there may be legal rammifications for sending unsolicited email.</li>
</ul>
<p>This module can and will require significant additional resources on your host.  The minimum CMS Made Simple requirements <strong>are probably not sufficient</strong>.  You should be prepared to debug issues, and contact your host to increase limits such as memory limit and timeouts before using this module.  This module is best used on a host where you have complete control of the php settings.</p>
<p>The developers and supporters of this package assume no risk or responsibility for its improper use. <strong>Use At Your Own Risk.</strong></p>
<h3>How do I use it?</h3>
<ol>
<li>Install the module (which you have probably done by this point).</li>
<li>Grant appropriate permissions to the groups that will manage your lists. these include:
	<ul>
	<li>Manage NMS Lists &amp;mdash; Add, remove mailing lists</li>	
	<li>Manage NMS Users &amp;mdash; Add, remove users in the database</li>
	<li>Manage NMS Messages &amp;mdash; Add, edit, remove messages but not send them</li> 	
	<li>Manage NMS Jobs &amp;mdash; Send messages and perform other &#039;job&#039; functions</li>	
	</ul>
</li>
<li>Create a list</li>
<li>(Optional) Add the {cms_module module=&#039;NMS&#039;} to a page to enable web site visitors to sign up for your list.</li>
<li>(Optional) Add users to your list manually with the Users tab in the admin system</li>
<li>Create a message to be sent as part of a job</li>
<li>Create a job. You will select a message to send and a list to send it to.</li>
<li>Process the job and your message will be sent</li>
</ol>

<h3>Basic Syntax</h3>
<p>{NMS}  </p>

<h3>Further options</h3>

<h4>Display unsubscribe form:</h4>
<p>{NMS mode=&#039;unsubscribe&#039;}</p>

<h4>Display the user settings page:</h4>
<p>{NMS mode=&#039;usersettings&#039;}</p>

<h4>Display an archive of past newsletters</h4>
<p>{NMS action=&#039;archivelist&#039;}</p>
<ul>
<lh>Optional parameters for the archive:</lh>
<li>show=&#039;#&#039; where <code>#</code> is the number of past newsletters to show. If omitted, all are shown</li>
<li>sortby=&#039;date&#039; &amp;mdash; <code>date</code> (default), <code>id</code> (message ID), or <code>subject</code></li>
<li>sortorder=&#039;DESC&#039; &amp;mdash; either <code>DESC</code> (descending order, default) or <code>ASC</code> (ascending order)</li>
<li>dateformat=&#039;%Y-%m-%d&#039; &amp;mdash; sets the date output format following the PHP strftime() syntax</li>
</ul>		

<h4>Import users from the Front End Users database</h4>
<p>Note: You must have a property defined in FEU that stores the users&#039; email address. It can be named whatever you want.</p>
<ol>
<li>Choose Extensions &amp;gt; Newsletter Made Simple</li>
<li>Activate the Users tab</li>
<li>At the bottom, click Import Users from FrontEndUsers</li>
<li>Select the FEU field that contains the users&#039; email addresses</li>
<li>Specify whether to copy the FEU user name to the NMS user name field. This is what would be output in your message if you included the {<span>$</span>username} placeholder.</li>
<li>Select the list to import to.</li>
<li>Click Submit.</li>
</ol>
<p>You will receive a report of the users processed, those already in your NMS database, those already on the list, and those that were added and subscribed. Users are not duplicated so there should be no harm in running an import periodically.</p>

<h3>Message variables</h3>
<p>These are covered elsewhere, but added here for completeness. If you add these to your message, they will be replaced at sending time with the appropriate true values.</p>

<ul>
<li>{<span>$</span>username}  &amp;mdash;  The user&#039;s name</li>
<li>{<span>$</span>email}  &amp;mdash;  The user&#039;s email address</li>
<li>{<span>$</span>unsubscribe}  &amp;mdash;  A URL that can be used to display a page for unsubscribing</li>
<li>{<span>$</span>preferences}  &amp;mdash;  A URL that can be used to display a user preferences page</li>
<li>{<span>$</span>confirmurl}  &amp;mdash;  A URL that can be used to confirm subscriptions</li>
</ul>
<h3>Bounce Processing</h3>
<p>The built in bounce processing capabilities allow reading a pop3 mailbox and searching the mails in that inbox for matching messages.  If the user can be properly detected, the &#039;bounce count&#039; for that user will be incremented.  Once the &#039;bounce limit&#039; is reached, the user will be disabled.</p>
<p><strong>Note:</strong> Your hosts email server configuration may be such that you don&#039;t receive bounce notifications in your pop3 mail box.  You may have to work with your hosting provider to ensure that this functionality works for you.</p>
<p>It is strongly recommended that you configure your sending email address to be the same as your pop3 email account, and that you use this account only for bounce processing.</p>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report  please visit <a href=&#039;http://dev.cmsmadesimple.org/projects/newsletter/&#039; target=&#039;_blank&#039;>http://dev.cmsmadesimple.org/projects/newsletter/</a>.</li>
<li>Additional discussion of this module may also be found in the <a href=&#039;http://forum.cmsmadesimple.org&#039; target=&#039;_blank&#039;>CMS Made Simple Forums</a>.</li>
<li>The author, Robert Campbell, can often be found in the <a href=&#039;irc://irc.freenode.net/#cms&#039;>CMS IRC Channel</a> (username: calguy1000).</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p>Copyright &amp;copy, 2007, Robert Campbell <a href=&#039;mailto:calguy1000@hotmail.com&#039;>calguy1000@hotmail.com</a>.  All Rigts Are Reserved.</p>
<p>Credits to the original author of the module:, Paul Lemke <a href=&#039;mailto:lemkepf@gmx.net&#039;>&amp;lt;lemkepf@gmx.net&amp;gt;</a></p>
<p>This module has been released under the <a href=&#039;http://www.gnu.org/licenses/licenses.html#GPL&#039;>GNU Public License</a>. You must agree to this license before using the module.</p>';
$lang['import_feu_title'] = 'Importera anv&auml;ndare fr&aring;n FrontEndUsers';
$lang['import_feu_info'] = 'V&auml;lj den grupp i FEU group som du vill importera till NMS. <em>(Bara grupper med f&auml;lt f&ouml;r epostadresser visas h&auml;r)</em>';
$lang['import_feu_noproperties'] = 'Du har inte definierat n&aring;gra egenskaper i modulen Front End Users. Du m&aring;ste definiera minst en egenskap f&ouml;r att spara anv&auml;ndarens e-postadress.';
$lang['import_feu_prompt_groupname'] = 'Grupp i FrontEndUsers';
$lang['import_feu_prompt_copyusername'] = 'Kopiera namn fr&aring;n FEU-anv&auml;ndare till NMS?';
$lang['import_feu_info_copyusername'] = '<em>Om Nej &auml;r vald kommer anv&auml;ndarnamnet bli tomt.</em>';
$lang['import_feu_selectlists'] = 'Importera anv&auml;ndae till (list name)';
$lang['import_feu_feunotinstalled'] = 'Modulen Front End Users &auml;r inte installerad eller saknas definitionstabell f&ouml;r egenskaper. Kan inte importea anv&auml;ndare fr&aring;n FEU.';
$lang['processedAddressesTitle'] = 'Hanterade adresser';
$lang['inDatabaseTitle'] = 'Finns redan i NMS';
$lang['onListAlreadyTitle'] = 'Prenumererar redan';
$lang['addressSubscribedTitle'] = 'Prenumererar';
$lang['listidInfo'] = 'Importerar till listID: ';
$lang['processedAddressesCountInfo'] = 'Hanterade adresser: ';
$lang['archive_heading'] = '<h1>Meddelandearkiv</h1>';
$lang['archivedmessage'] = '<h1>Arkiverat meddelande</h1>';
$lang['archive_tbl_msgID'] = 'MeddelandeID';
$lang['archive_tbl_subject'] = '&Auml;mne';
$lang['archive_tbl_fullurl'] = 'Meddelandel&auml;nk';
$lang['archive_tbl_href'] = 'L&auml;nkm&aring;l';
$lang['archive_tbl_date'] = 'Datum';
$lang['utma'] = '156861353.1202846489.1249038202.1250703031.1250715386.50';
$lang['utmz'] = '156861353.1250623903.45.7.utmccn=(referral)|utmcsr=forum.cmsmadesimple.org|utmcct=/index.php|utmcmd=referral';
$lang['qca'] = '4a72d21a-ee785-21917-f08f8';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.1.10.1250715386';
?>