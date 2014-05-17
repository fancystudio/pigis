<?php
$lang['helpuglyurls'] = 'Applicable only to the browsecat action, this parameter will force the category browsing action to not generate pretty urls, therefor parameters used in the call to CGBlog can be passed through to the summary view';
$lang['helpnotcategory'] = 'Applicable to the default summary action, this parameter allows specifying a comma separated list of category names representing categories to NOT return in the results.  This parameter cannot be used with the category or categoryid parameters.';
$lang['info_default_showarchive'] = 'If enabled, only articles that have expired and would not normally show are displayed.  This option is ignored if showall is selected';
$lang['title_default_showarchive'] = 'Zeige archivierte Artikel';
$lang['title_default_showall'] = 'Zeige alle Artikel';
$lang['info_default_showall'] = 'If selected, all articles, regardless of status, or start and end date, will be displayed';
$lang['title_default_pagelimit'] = 'Voreingestelltes Seitenlimit';
$lang['info_default_pagelimit'] = 'The page limit specifies how many articles will appear on each page.  Must be an integer value between 1 and 50000.';
$lang['info_default_sortorder'] = 'Sort order is not relevant when using random sorting';
$lang['info_default_sortby'] = 'Select the default sorting for summary views.  When using random sorting it is possible that entries will appear on multiple pages.';
$lang['sortorder_desc'] = 'Absteigend';
$lang['sortorder_asc'] = 'Aufsteigend';
$lang['sortby_starttime'] = 'Artikel Startdatum';
$lang['sortby_endtime'] = 'Artikel Enddatum';
$lang['sortby_random'] = 'Zuf&auml;llige Sortierung';
$lang['sortby_extra'] = 'Artikel Extrafeld';
$lang['sortby_summary'] = 'Artikel Zusammenfassung';
$lang['sortby_category'] = 'Artikel Kategorie';
$lang['sortby_title'] = 'Artikel Titel';
$lang['sortby_date'] = 'Artikel Datum';
$lang['title_default_sortby'] = 'Voreingestellte Sortierung';
$lang['title_default_sortorder'] = 'Voreingestellte Sortierreihenfolge';
$lang['summary_options'] = 'Optionen f&uuml;r Zusammenfassungsansicht';
$lang['prompt_friendlyname'] = 'Anzeigename f&uuml;r dieses Modul';
$lang['url_template'] = 'URL-Template';
$lang['error_urlused'] = 'Die angegebene URL wird bereits verwendet';
$lang['error_badurl'] = 'Die angegebene URL ist ung&uuml;ltig';
$lang['info_fesubmit_wysiwyg'] = 'This option disables use of the wysiwyg in all areas of the frontend submission form, regardless of other settings';
$lang['fesubmit_wysiwyg'] = 'Verwendung des WYSIWYG-Editors erlauben';
$lang['return_to_content'] = 'Zur&uuml;ck';
$lang['size'] = 'Gr&ouml;&szlig;e';
$lang['allowed_filetypes'] = 'Erlaubte Dateitypen';
$lang['enable_wysiwyg'] = 'WYSIWYG Aktivieren';
$lang['preview_size'] = 'Vorschaubild gr&ouml;&szlig;e (pixels)';
$lang['preview'] = 'Vorschaubild generieren';
$lang['thumbnail_size'] = 'Thumbnail Bild gr&ouml;&szlig;e (pixels)';
$lang['thumbnail'] = 'Thumbnail Bild';
$lang['watermark'] = 'Wasserzeichen auf  hochgeladene Bilder setzen';
$lang['allowed_imagetypes'] = 'Erlaubte Bild-Typen';
$lang['image'] = 'Bild';
$lang['help_adminuser'] = 'Applicable only to the default (summary) view, this module allowss filtering the output to only those admin user names specified.  i.e: <code>admin_user=&quot;bob,fred,george&quot;</code>';
$lang['help_fesubmitpage'] = 'Applicable only to the myarticles action, this parameter allows specifying a different page <em>(by id or alias)</em> for the frontend submit form.</li>';
$lang['help_userparam'] = 'Applicable only to the <em>(default)</em> summary action, this parameter allows filtering the output to only those <em>(non expired)</em> FEU author names specified.  i.e <code>author=&quot;user1@somewhere.com,user2@somewhere.com&quot;</code>.';
$lang['help_inline'] = 'Applicable only to the myarticles action, this parameter specifies that the pagination links should be created in an inline manner.  i.e:  the resulting output from the link will replace the original tag, not the {content} tag on the destination page';
$lang['fesubmit_updatestatus'] = 'Frontend Benutzer d&uuml;rfen Artikel-Status &auml;ndern';
$lang['you_authored'] = 'Die Anzahl der Artikel, die Sie bis heute ver&ouml;ffentlicht haben, ist';
$lang['my_articles'] = 'Meine Artikel';
$lang['id'] = 'ID';
$lang['modified'] = 'Ge&auml;ndert';
$lang['fesubmit_managearticles'] = 'Frontend-Benutzern die Verwaltung der eigenen Blog-Artikel erlauben?';
$lang['fesubmit_dfltexpiry'] = 'F&uuml;r Frontend eingereichte Artikel, Verfallsdatum als Standard setzen';
$lang['fesubmit_usexpiry'] = 'Benutzer, die Artikel &uuml;ber Frontend schreiben, d&uuml;rfen Artikel Verfallsdatum deaktivieren';
$lang['url'] = 'URL ';
$lang['helpshowdraft'] = 'Kann nur in der voreingestellten Zusammenfassungsansicht verwendet werden, mit diesem Parameter werden nur Artikel im Status &quot;Entwurf&quot; angezeigt. Dies funktioniert nur dann, wenn der angemeldete FrontendUsers-Benutzer &uuml;ber die Registerkarte &quot;Optionen&quot; des CGBlog-Moduls autorisiert wurde, die Entw&uuml;rfe zu sehen.';
$lang['title_default_status'] = 'Voreingestellter Status f&uuml;r neue Artikel';
$lang['fesubmit_draftviewers'] = 'FEU-Gruppe, die Artikel mit dem Status Entwurf sehen darf';
$lang['title_default_summarypage'] = 'Voreingestellte Zusammenfassungseite (falls keine Seiten-ID in der URL vorgegeben wurde)';
$lang['title_default_detailpage'] = 'Voreingestellte Detailseite (falls keine Seiten-ID in der URL vorgegeben wurde)';
$lang['helparchivetemplate'] = 'Funktioniert nur, wenn der Parameter action <em>archive</em> ist. Mit diesem Parameter kann ein alternatives Archiv-Anzeige-Template festgelegt werden.';
$lang['addedit_archive_template'] = 'Ein Archiv-Template hinzuf&uuml;gen/bearbeiten';
$lang['info_archive_templates'] = 'Verf&uuml;gbare Archiv-Templates';
$lang['archivetemplate'] = 'Archiv-Templates';
$lang['title_sysdefault_archive_template'] = 'Voreingestelltes Archiv-Template';
$lang['helpfelisttemplate'] = 'Applicable only to the <em>myarticles</em> action, this parameter can be used to specify an alternate Article List Report template';
$lang['helpfesubmittemplate'] = 'Funktioniert nur, wenn der Parameter action <em>fesubmit</em> ist. Mit diesem Parameter kann ein alternatives Formular-Template festgelegt werden.';
$lang['helpsummarypage'] = 'Funktioniert nur, wenn der Parameter action <em>browsecat</em> und <em>archive</em> ist. Dieser Parameter kann eine Seiten-ID oder einen Seiten-Alias f&uuml;r die Anzeige der Zusammenfassung enthalten, die nach dem Klick auf einen Kategorien-Link angezeigt wird';
$lang['help_month'] = 'Funktioniert nur, wenn der Parameter action <em>default</em> ist. Dieser Parameter kann einen Monat (integer) enthalten, f&uuml;r den alle Eintr&auml;ge angezeigt werden sollen. Dieser Parameter funktioniert nur in Verbindung mit dem Parameter &quot;year&quot;.';
$lang['category_modified'] = 'Die Kategorie wurde erfolgreich bearbeitet.';
$lang['new_category_name'] = 'Neuer Name der Kategorie';
$lang['old_category_name'] = 'Alter Name der Kategorie';
$lang['edit_category'] = 'Kategorie bearbeiten';
$lang['error_nocatname'] = 'Es wurde kein Name f&uuml;r die Kategorie angegeben';
$lang['move_up'] = 'Nach oben verschieben';
$lang['move_down'] = 'Nach unten verschieben';
$lang['postuninstall'] = 'Das CGBlog-Modul wurde deinstalliert. Sie sollten nun aus Sicherheitsgr&uuml;nden auch die mit diesem Modul verbundenen Dateien l&ouml;schen.';
$lang['ipaddress'] = 'IP-Adresse';
$lang['fesubmit_redirect'] = 'Die Seiten-ID oder der Seiten-Alias der Seite, auf die der Einsender eines Blog-Eintrags &uuml;ber die fesubmit-Aktion weitergeleitet werden soll';
$lang['templaterestored'] = 'Template wiederhergestellt';
$lang['fesubmit_status'] = 'Der Status f&uuml;r Blog-Eintr&auml;ge, die &uuml;ber die Webseite (Frontend) erstellt wurden';
$lang['fesubmit_email_users'] = 'Eine Benachrichtigung via Email an diese Benutzer senden';
$lang['no'] = 'Nein';
$lang['yes'] = 'Ja';
$lang['fesubmit_email_template'] = 'Email-Template';
$lang['fesubmit_email_html'] = 'Als HTML-Email versenden?';
$lang['fesubmit_email_subject'] = 'Betreff der Email';
$lang['general_options'] = 'Allgemeine Blog-Einstellungen';
$lang['fesubmit_options'] = 'Frontend-Blog-Optionen';
$lang['dflt_email_subject'] = 'Es wurde ein neuer Blog-Eintrag erstellt.';
$lang['postdatetoolate'] = 'Das eingegebene Datum ist zu lang';
$lang['title_sysdefault_felist_template'] = 'Voreingestelltes Frontend-Artikel-Listen-Berichts Template';
$lang['title_sysdefault_fesubmit_template'] = 'Voreingestelltes Frontend-Formular-Template';
$lang['addedit_felist_template'] = 'Ein Frontend-Artikel-Listen-Berichts Template hinzuf&uuml;gen/bearbeiten';
$lang['addedit_fesubmit_template'] = 'Ein Frontend-Formular-Template hinzuf&uuml;gen/bearbeiten';
$lang['info_felist_templates'] = 'Verf&uuml;gbare Frontend-Artikel-Listen-Berichts Templates';
$lang['info_fesubmit_templates'] = 'Verf&uuml;gbare Frontend-Formular-Templates';
$lang['felisttemplate'] = 'Frontend-Artikel-Listen-Berichts Templates';
$lang['fesubmittemplate'] = 'Frontend-Formular-Templates';
$lang['help_year'] = 'In Verbindung mit der voreingestellten Aktion (Zusammenfassungs-Ansicht) kann dieser Parameter ein Jahr enthalten, f&uuml;r welches alle Blog-Eintr&auml;ge angezeigt werden sollen.';
$lang['info_urlprefix'] = 'Dies funktioniert nur dann, wenn die PrettyURLs via mod_rewrite oder interne PrettyURLs aktiviert werden. Au&szlig;erdem kann dieser Wert nicht verwendet werden, wenn f&uuml;r den Blog-Eintrag eine bestimmte URL festgelegt wurde.';
$lang['url_prefix'] = 'Pr&auml;fix, mit dem alle URLs des CGBlog-Moduls gekennzeichnet werden sollen';
$lang['friendlyname'] = 'Calguys Blog-Modul';
$lang['select_category'] = 'Sie m&uuml;ssen mindestens eine Kategorie angeben';
$lang['set_default'] = 'Als Voreinstellung festlegen';
$lang['category_deleted'] = 'Kategorie gel&ouml;scht';
$lang['error_dberror'] = 'Es ist ein Fehler mit der Datenbank aufgetreten. Bitte kontaktieren Sie Ihren Administrator.';
$lang['category_added'] = 'Kategorie hinzugef&uuml;gt';
$lang['category_name_exists'] = 'Eine Kategorie mit diesem Namen existiert bereits';
$lang['error_insufficient_params'] = 'F&uuml;r diese Aktion wurden nicht ausreichende oder ung&uuml;ltige Parameter angegeben';
$lang['add_category'] = 'Kategorie hinzuf&uuml;gen';
$lang['addedit_summary_template'] = 'Zusammenfassungs-Template hinzuf&uuml;gen/bearbeiten';
$lang['addedit_detail_template'] = 'Detail-Template hinzuf&uuml;gen/bearbeiten';
$lang['addedit_browsecat_template'] = 'Kategorien-Template hinzuf&uuml;gen/bearbeiten';
$lang['info_summary_templates'] = 'Verf&uuml;gbare Zusammenfassungs-Templates';
$lang['info_detail_templates'] = 'Verf&uuml;gbare Detail-Templates';
$lang['info_browsecat_templates'] = 'Verf&uuml;gbare Kategorien-Template';
$lang['title_sysdefault_browsecat_template'] = 'Voreingestelltes Kategorien-Template';
$lang['title_sysdefault_detail_template'] = 'Voreingestelltes Detail-Template';
$lang['title_sysdefault_summary_template'] = 'Voreingestelltes Zusammenfassungs-Template';
$lang['info_sysdefault_template'] = 'Dieses Template legt den Inhalt fest, der automatisch eingef&uuml;gt wird, wenn ein neues Template eines bestimmten Typs erstellt wird. Alle hier vorgenommenen &Auml;nderungen haben KEINEN direkten Einfluss auf die Ausgaben auf Ihrer Webseite.';
$lang['expired_searchable'] = 'Blog-Eintr&auml;ge, deren Verfallsdatum &uuml;berschritten ist, d&uuml;rfen in den Suchergebnissen erscheinen';
$lang['helpshowall'] = 'Alle Blog-Eintr&auml;ge anzeigen (unabh&auml;ngig von deren Verfallsdatum)';
$lang['error_invaliddates'] = 'Ein oder mehrere der eingegebenen Daten sind ung&uuml;ltig';
$lang['notify_n_draft_items_sub'] = '%d CGBlog-Eintr&auml;ge';
$lang['notify_n_draft_items'] = '%d CGBlog-Eintr&auml;ge wurde(n) noch nicht ver&ouml;ffentlicht.';
$lang['unlimited'] = 'Unbegrenzt';
$lang['none'] = 'Keine';
$lang['anonymous'] = 'Anonym';
$lang['unknown'] = 'Unbekannt';
$lang['allow_summary_wysiwyg'] = 'Den WYSIWYG-Editor f&uuml;r das Zusammenfassungsfeld verwenden';
$lang['title_browsecat_template'] = 'Template-Editor f&uuml;r die Kategorien-Anzeige';
$lang['title_browsecat_sysdefault'] = 'Voreingestelltes Template f&uuml;r die Kategorien-Anzeige';
$lang['browsecattemplate'] = 'Template f&uuml;r die Kategorien-Anzeige';
$lang['error_filesize'] = 'Die hochgeladene Datei &uuml;berschreitet die maximal erlaubte Gr&ouml;&szlig;e';
$lang['post_date_desc'] = 'Nach Erstellungsdatum absteigend';
$lang['post_date_asc'] = 'Nach Erstellungsdatum aufsteigend';
$lang['expiry_date_desc'] = 'Nach Verfallsdatum absteigend';
$lang['expiry_date_asc'] = 'Nach Verfallsdatum aufsteigend';
$lang['title_desc'] = 'Nach Titel absteigend';
$lang['title_asc'] = 'Nach Titel aufsteigend';
$lang['error_invalidfiletype'] = 'Dieser Dateityp darf nicht hochgeladen werden';
$lang['error_upload'] = 'Beim Hochladen der Datei ist ein Problem aufgetreten';
$lang['error_movefile'] = 'Konnte die Datei %s nicht erstellen';
$lang['error_mkdir'] = 'Konnte das Verzeichnis %s nicht erstellen';
$lang['expiry_interval'] = 'Voreingestellte Anzahl der Tage, nach denen ein Eintrag verf&auml;llt (falls ein Verfallsdatum verwendet wird)';
$lang['removed'] = 'Entfernt';
$lang['delete_selected'] = 'Ausgew&auml;hlte Eintr&auml;ge l&ouml;schen';
$lang['areyousure_deletemultiple'] = 'Wollen Sie wirklich alle ausgew&auml;hlten Blog-Eintr&auml;ge l&ouml;schen?\nDies kann NICHT r&uuml;ckg&auml;ngig gemacht werden!';
$lang['error_templatenamexists'] = 'Es existiert bereits ein Template mit diesem Namen!';
$lang['error_noarticlesselected'] = 'Es wurden keine Blog-Eintrag ausgew&auml;hlt';
$lang['reassign_category'] = 'Kategorie &auml;ndern auf';
$lang['select'] = 'Ausw&auml;hlen';
$lang['approve'] = 'Status auf &bdquo;ver&ouml;ffentlicht&ldquo; setzen';
$lang['revert'] = 'Status auf &bdquo;Entwurf&ldquo; setzen';
$lang['hide_summary_field'] = 'Das Zusammenfassungsfeld verbergen, wenn ein Eintrag hinzugef&uuml;gt oder bearbeitet wird';
$lang['textbox'] = 'Einzeiliges Textfeld';
$lang['checkbox'] = 'Kontrollk&auml;stchen';
$lang['textarea'] = 'Mehrzeiliger Textbereich';
$lang['file'] = 'Datei';
$lang['auto_create_thumbnails'] = 'F&uuml;r Dateien mit dieser Namenserweiterung automatisch ein Vorschaubild erstellen';
$lang['fielddefupdated'] = 'Feld-Definition aktualisiert';
$lang['editfielddef'] = 'Feld-Definition bearbeiten';
$lang['up'] = 'Nach oben';
$lang['down'] = 'Nach unten';
$lang['fielddefdeleted'] = 'Feld-Definition gel&ouml;scht';
$lang['nameexists'] = 'Ein Feld mit diesem Namen existiert bereits';
$lang['notanumber'] = 'Die maximale L&auml;nge ist keine Zahl';
$lang['fielddef'] = 'Feld-Definition';
$lang['fielddefadded'] = 'Die Feld-Definition wurde erfolgreich hinzugef&uuml;gt';
$lang['public'] = '&Ouml;ffentlich';
$lang['type'] = 'Typ';
$lang['info_maxlength'] = 'Die maximale L&auml;nge hat nur Auswirkungen auf einzeilige Textfelder.';
$lang['maxlength'] = 'Maximale L&auml;nge';
$lang['addfielddef'] = 'Feld-Definition hinzuf&uuml;gen';
$lang['customfields'] = 'Feld-Definitionen';
$lang['deprecated'] = 'Nicht unterst&uuml;tzt';
$lang['extra'] = 'Extrafeld';
$lang['uploadscategory'] = 'Kategorie im Uploads-Modul';
$lang['title_available_templates'] = 'Verf&uuml;gbare Templates';
$lang['resettodefault'] = 'Auf die programmseitigen Voreinstellungen zur&uuml;cksetzen';
$lang['prompt_templatename'] = 'Template-Name';
$lang['prompt_template'] = 'Template-Quelle';
$lang['template'] = 'Template ';
$lang['prompt_name'] = 'Name ';
$lang['prompt_default'] = 'Standard';
$lang['prompt_newtemplate'] = 'Ein neues Template erstellen';
$lang['help_pagelimit'] = 'Maximale Anzahl der anzuzeigenden Eintr&auml;ge (pro Seite). Ohne diesen Parameter werden alle Eintr&auml;ge angezeigt. Wenn dieser Parameter gesetzt wurde und mehr Eintr&auml;ge vorhanden sind, als pro Seite angezeigt werden sollen, werden Links eingeblendet, um vorw&auml;rts oder r&uuml;ckw&auml;rts zu den n&auml;chsten Seiten bl&auml;ttern zu k&ouml;nnen.';
$lang['prompt_page'] = 'Seite';
$lang['firstpage'] = '&laquo;';
$lang['prevpage'] = '&lsaquo;';
$lang['nextpage'] = '&rsaquo;';
$lang['lastpage'] = '&raquo;';
$lang['prompt_of'] = 'von';
$lang['prompt_pagelimit'] = 'Eintr&auml;ge  pro Seite';
$lang['prompt_sorting'] = 'Sortieren nach';
$lang['title_filter'] = 'Anzeige filtern';
$lang['published'] = 'Ver&ouml;ffentlicht';
$lang['draft'] = 'Entwurf';
$lang['expired'] = 'Abgelaufen';
$lang['author'] = 'Autor';
$lang['sysdefaults'] = 'Auf die programmseitigen Voreinstellungen zur&uuml;cksetzen';
$lang['restoretodefaultsmsg'] = 'Diese Funktion setzt die Templates auf die programmseitigen Voreinstellung zur&uuml;ck. Wollen Sie das wirklich?';
$lang['addarticle'] = 'Blog-Eintrag hinzuf&uuml;gen';
$lang['articleadded'] = 'Der Eintrag wurde hinzugef&uuml;gt.';
$lang['articleaddeddraft'] = 'The entry was successfully added.  An administrator will review your entry for content and if approved will publish the article.';
$lang['articleupdated'] = 'Der Eintrag wurde aktualisiert.';
$lang['articledeleted'] = 'Der Eintrag wurde gel&ouml;scht.';
$lang['addcategory'] = 'Kategorie hinzuf&uuml;gen';
$lang['addcgblogitem'] = 'Blog-Eintrag hinzuf&uuml;gen';
$lang['allcategories'] = 'Alle Kategorien';
$lang['allentries'] = 'Alle Eintr&auml;ge';
$lang['areyousure'] = 'Wollen Sie dies wirklich l&ouml;schen?';
$lang['articles'] = 'Eintr&auml;ge';
$lang['cancel'] = 'Abbrechen';
$lang['category'] = 'Kategorie';
$lang['categories'] = 'Kategorien';
$lang['default_category'] = 'Standard-Kategorie';
$lang['content'] = 'Inhalt';
$lang['delete'] = 'L&ouml;schen';
$lang['description'] = 'Hinzuf&uuml;gen, Bearbeiten und L&ouml;schen von Blog-Eintr&auml;gen';
$lang['detailtemplate'] = 'Detail-Templates';
$lang['default_templates'] = 'Voreingestellte Templates';
$lang['detailtemplateupdated'] = 'Das aktualisierte Detail-Template wurde in der Datenbank gespeichert.';
$lang['displaytemplate'] = 'Template anzeigen';
$lang['edit'] = 'Bearbeiten';
$lang['enddate'] = 'Verfallsdatum';
$lang['endrequiresstart'] = 'Wenn Sie ein Verfallsdatum angeben, m&uuml;ssen Sie auch ein Startdatum festgelegen.';
$lang['entries'] = '%s Eintr&auml;ge';
$lang['status'] = 'Status ';
$lang['expiry'] = 'Ablauf';
$lang['filter'] = 'Blog-Eintr&auml;ge filtern';
$lang['more'] = 'Weiterlesen &hellip;';
$lang['category_label'] = 'Kategorie:';
$lang['author_label'] = 'Erstellt von:';
$lang['moretext'] = 'Text f&uuml;r den Link &bdquo;Weiterlesen &hellip;&ldquo;';
$lang['name'] = 'Name ';
$lang['cgblog_return'] = 'Zur&uuml;ck';
$lang['newcategory'] = 'Neue Kategorie';
$lang['needpermission'] = 'Sie ben&ouml;tigen die Berechtigung &bdquo;%s&ldquo;, um diese Funktion nutzen zu k&ouml;nnen.';
$lang['nocategorygiven'] = 'Keine Kategorie vorhanden';
$lang['startdatetoolate'] = 'FEHLER: Das Startdatum muss VOR dem Verfallsdatum liegen';
$lang['nocontentgiven'] = 'Kein Inhalt vorhanden';
$lang['noitemsfound'] = '<strong>Keine</strong> Eintr&auml;ge gefunden in der Kategorie: %s';
$lang['nopostdategiven'] = 'FEHLER: Es wurde kein Erstellungsdatum eingegeben';
$lang['note'] = '<em>Hinweis:</em> Datum/Zeit muss im Format &bdquo;JJJJ-MM-TT hh:mm:ss&ldquo; angegeben werden.';
$lang['notitlegiven'] = 'FEHLER: Es wurde kein Titel eingegeben';
$lang['nonamegiven'] = 'FEHLER: Es wurde kein Name eingegeben';
$lang['numbertodisplay'] = 'Anzuzeigende Anzahl (ohne Eintrag werden alle Datens&auml;tze angezeigt)';
$lang['print'] = 'Drucken';
$lang['postdate'] = 'Erstellt am';
$lang['postinstall'] = 'Stellen Sie sicher, dass die Benutzer, die die CGBlog verwalten, die Berechtigung &bdquo;Modify CGBlog&ldquo; haben.';
$lang['selectcategory'] = 'Kategorie ausw&auml;hlen';
$lang['showchildcategories'] = 'Unterkategorien anzeigen';
$lang['sortascending'] = 'Aufsteigend sortieren';
$lang['startdate'] = 'Anfangsdatum';
$lang['startoffset'] = 'Beginnt mit der Anzeige ab dem <span style=&quot;font-style: italic;&quot;>n</span>-ten Eintrag';
$lang['startrequiresend'] = 'Die Eingabe eines Startdatums erfordert auch die Eingabe eines Verfallsdatums.';
$lang['submit'] = 'Speichern';
$lang['summary'] = 'Zusammenfassung';
$lang['summarytemplate'] = 'Zusammenfassungs-Template';
$lang['summarytemplateupdated'] = 'Das CGBlog-Zusammenfassungs-Template wurde aktualisiert.';
$lang['title'] = 'Titel';
$lang['options'] = 'Optionen';
$lang['optionsupdated'] = 'Die Einstellungen wurden gespeichert.';
$lang['useexpiration'] = 'Verfallsdatum verwenden';
$lang['eventdesc-CGBlogArticleAdded'] = 'Ausf&uuml;hren, wenn ein Eintrag hinzugef&uuml;gt wurde.';
$lang['eventhelp-CGBlogArticleAdded'] = '<p>Ausf&uuml;hren, wenn ein Eintrag hinzugef&uuml;gt wurde.</p>
<h4>Parameter</h4>
<table>
<tr>
<th scope=&quot;row&quot;>cgblog_id</th>
<td>ID des CGBlog-Eintrags</td>
</tr>
<tr>
<th scope=&quot;row&quot;>category_id</th>
<td>ID der Kategorie f&uuml;r diesen Eintrag</td>
</tr>
<tr>
<th scope=&quot;row&quot;>title</th>
<td>Titel des Eintrags</td>
</tr>
<tr>
<th scope=&quot;row&quot;>content</th>
<td>Inhalt des Eintrags</td>
</tr>
<tr>
<th scope=&quot;row&quot;>summary</th>
<td>Zusammenfassung des Eintrags</td>
</tr>
<tr>
<th scope=&quot;row&quot;>status</th>
<td>Status des Eintrags (&bdquo;Entwurf/draft&ldquo; oder &bdquo;Ver&ouml;ffentlicht/publish&ldquo;)</td>
</tr>
<tr>
<th scope=&quot;row&quot;>start_time</th>
<td>Datum, ab dem der Eintrag angezeigt werden soll</td>
</tr>
<tr>
<th scope=&quot;row&quot;>end_time</th>
<td>Datum, ab dem der Eintrag nicht mehr angezeigt werden soll</td>
</tr>
<tr>
<th scope=&quot;row&quot;>useexp</th>
<td>das Verfallsdatum soll ignoriert werden oder auch nicht</td>
</tr>
</table>
<p><strong>Hinweis:</strong> Da dieses Ereignis von verschiedenen Stellen ausgel&ouml;st wird, werden nicht alle Parameter an das Ereignis &uuml;bergeben.  Die Daten k&ouml;nnen &uuml;ber den Parameter cgblog_id aus der Datenbank abgefragt werden.</p';
$lang['eventdesc-CGBlogArticleEdited'] = 'Ausf&uuml;hren, wenn ein Eintrag bearbeitet wurde.';
$lang['eventhelp-CGBlogArticleEdited'] = '<p>Ausf&uuml;hren, wenn ein Eintrag bearbeitet wurde.</p>
<h4>Parameter</h4>
<table>
<tr>
<th scope=&quot;row&quot;>cgblog_id</th>
<td>ID des CGBlog-Artikels</td>
</tr>
<tr>
<th scope=&quot;row&quot;>category_id</th>
<td>ID der Kategorie f&uuml;r diesen Eintrag</td>
</tr>
<tr>
<th scope=&quot;row&quot;>title</th>
<td>Titel des Eintrags</td>
</tr>
<tr>
<th scope=&quot;row&quot;>content</th>
<td>Inhalt des Eintrags</td>
</tr>
<tr>
<th scope=&quot;row&quot;>summary</th>
<td>Zusammenfassung des Eintrags</td>
</tr>
<tr>
<th scope=&quot;row&quot;>status</th>
<td>Status des Eintrags (&bdquo;Entwurf/draft&ldquo; oder &bdquo;Ver&ouml;ffentlicht/publish&ldquo;)</td>
</tr>
<tr>
<th scope=&quot;row&quot;>start_time</th>
<td>Datum, ab dem der Eintrag angezeigt werden soll</td>
</tr>
<tr>
<th scope=&quot;row&quot;>end_time</th>
<td>Datum, ab dem der Eintrag nicht mehr angezeigt werden soll</td>
</tr>
<tr>
<th scope=&quot;row&quot;>useexp</th>
<td>das Verfallsdatum soll ignoriert werden oder auch nicht</td>
</tr>
</table>';
$lang['eventdesc-CGBlogArticleDeleted'] = 'Ausf&uuml;hren, wenn ein Eintrag gel&ouml;scht wurde.';
$lang['eventhelp-CGBlogArticleDeleted'] = '<p>Ausf&uuml;hren, wenn ein Eintrag gel&ouml;scht wird.</p>
<h4>Parameter</h4>
<table>
<tr>
<th scope=&quot;row&quot;>cgblog_id</th>
<td>ID des CGBlog-Artikels</td>
</tr>
</table>';
$lang['eventdesc-CGBlogCategoryAdded'] = 'Ausf&uuml;hren, wenn eine Kategorie hinzugef&uuml;gt wurde.';
$lang['eventhelp-CGBlogCategoryAdded'] = '<p>Ausf&uuml;hren, wenn eine Kategorie hinzugef&uuml;gt wurde.</p>
<h4>Parameter</h4>
<table>
<tr>
<th scope=&quot;row&quot;>category_id</th>
<td>ID der CGBlog-Kategorie</td>
</tr>
<tr>
<th scope=&quot;row&quot;>name</th>
<td>Name der CGBlog-Kategorie</td>
</tr>
</table>';
$lang['eventdesc-CGBlogCategoryEdited'] = 'Ausf&uuml;hren, wenn eine Kategorie bearbeitet wurde.';
$lang['eventhelp-CGBlogCategoryEdited'] = '<p>Ausf&uuml;hren, wenn eine Kategorie bearbeitet wurde.</p>
<h4>Parameter</h4>
<table>
<tr>
<th scope=&quot;row&quot;>category_id</th>
<td>ID der CGBlog-Kategorie</td>
</tr>
<tr>
<th scope=&quot;row&quot;>name</th>
<td>Name der CGBlog-Kategorie</td>
</tr>
<tr>
<th scope=&quot;row&quot;>origname</th>
<td>urspr&uuml;nglicher Name der Nachrichtenkategorie</td>
</tr>
</table>';
$lang['eventdesc-CGBlogCategoryDeleted'] = 'Ausf&uuml;hren, wenn eine Kategorie gel&ouml;scht wurde.';
$lang['eventhelp-CGBlogCategoryDeleted'] = '<p>Ausf&uuml;hren, wenn eine Kategorie gel&ouml;scht wurde.</p>
<h4>Parameter</h4>
<table>
<tr>
<th scope=&quot;row&quot;>category_id</th>
<td>ID der gel&ouml;schten Kategorie</td>
</tr>
<tr>
<th scope=&quot;row&quot;>name</th>
<td>Name der gel&ouml;schten Kategorie</td>
</tr>
</table>';
$lang['help_articleid'] = 'Dieser Parameter funktioniert nur in der Detailansicht. Mit ihm kann vorgegeben werden, welcher Blog-Eintrag im Detail-Modus angezeigt werden soll. Wird an dieser Stelle der Wert -1 verwendet, wird der neueste ver&ouml;ffentliche, nicht abgelaufene Blog-Eintrag angezeigt.';
$lang['helpnumber'] = 'Anzahl der maximal anzuzeigenden Eintr&auml;ge (pro Seite) &ndash; ohne Parameter werden alle Eintr&auml;ge angezeigt.';
$lang['helpstart'] = 'Beginnt die Anzeige mit dem n-ten Eintrag &ndash; wird das Feld leer gelassen, wird mit dem ersten Eintrag begonnen.';
$lang['helpcategory'] = 'Mit diesem Parameter k&ouml;nnen Sie festlegen, aus welcher Kategorie die Eintr&auml;ge angezeigt werden. <strong>Um auch die Unterkategorien anzuzeigen, geben Sie nach dem Kategorienamen ein * ein.</strong> &Uuml;ber eine durch Kommata getrennte Liste k&ouml;nnen auch mehrere Kategorien angezeigt werden. Ohne diesen Parameter werden alle Kategorien angezeigt. Dieser Parameter funktioniert auch mit der Aktion &bdquo;fesubmit&ldquo;, obwohl dort nur eine Kategorie unterst&uuml;tzt wird.';
$lang['helpsummarytemplate'] = 'Verwendet ein separates Template f&uuml;r die Anzeige der Blog-Zusammenfassungen. Dieses Template muss vorhanden sein und in der Administration des CGBlog-Moduls in der Registerkarte &bdquo;Zusammenfassungs-Template&ldquo; angezeigt werden. Ohne Parameter wird das als Standard gekennzeichnete Template verwendet.';
$lang['helpbrowsecattemplate'] = 'Verwendet ein Template f&uuml;r die Anzeige der Kategorien. Dieses Template muss vorhanden sein und  in der Administration des CGBlog-Moduls in der Registerkarte &bdquo;Kategorien-Template&ldquo; angezeigt werden. Sie muss jedoch nicht als Standard gekennzeichnet sein. Ohne Parameter wird das als Standard gekennzeichnete Template f&uuml;r die Anzeige verwendet.';
$lang['helpdetailtemplate'] = 'Verwendet eine separates Template f&uuml;r die Detail-Anzeige des Eintrags. Dieses Template muss vorhanden sein und in der Administration des CGBlog-Moduls in der Registerkarte &bdquo;Detail-Template&ldquo; angezeigt werden. Ohne Parameter wird das als Standard gekennzeichnete Template verwendet.';
$lang['helpsortby'] = 'Felder, nach denen die Eintr&auml;ge sortiert werden. M&ouml;gliche Optionen sind: &bdquo;cgblog_date&ldquo;, &bdquo;summary&ldquo;, &bdquo;cgblog_data&ldquo;, &bdquo;cgblog_category&ldquo;, &bdquo;cgblog_title&ldquo;, &bdquo;cgblog_extra&ldquo;, &bdquo;end_time&ldquo;, &bdquo;start_time&ldquo;, &bdquo;random&ldquo;. Standard ist &bdquo;cgblog_date&ldquo;. Ist die gew&auml;hlte Option &bdquo;random&ldquo;, wird der Parameter &bdquo;sortasc&ldquo; ignoriert.';
$lang['helpsortasc'] = 'Sortiert Eintr&auml;ge in aufsteigender Folge anstatt in absteigender (nach Datum).';
$lang['helpdetailpage'] = 'Seite, auf der die Blog-Details angezeigt werden. Das kann entweder ein Seiten-Alias oder eine Seiten-ID sein. Damit k&ouml;nnen die Blog-Details in einem anderen Template als die Blog-Zusammenfassung angezeigt werden.';
$lang['helpshowarchive'] = 'Mit diesem Parameter werden nur die CGBlog-Eintr&auml;ge angezeigt, deren Verfallsdatum &uuml;berschritten ist.';
$lang['helpbrowsecat'] = 'Mit diesem Parameter wird eine Liste der Kategorien angezeigt (browsecat=&#039;1&#039;). Kann NICHT zusammen mit dem Parameter &bdquo;category&ldquo; verwendet werden.';
$lang['helpaction'] = '&Uuml;berschreibt die vorgegebene Aktion. M&ouml;gliche Werte sind:
<ul>
<li>&quot;archive&quot; - ein Archiv von Blogeintr&auml;gen anzeigen</li>
<li>&quot;detail&quot; - einen bestimmten Blogeintrag im Detail-Modus anzeigen</li>
<li>&quot;default&quot; - die Zusammenfassungansicht anzeigen</li>
<li>&quot;browsecat&quot; - eine Kategorienliste anzeigen.</li>
<li>&quot;fesubmit&quot; - auf der Webseite ein Formular zum &Uuml;bermitteln neuer Blog-Eintr&auml;ge anzeigen.</li>
</ul>';
?>
