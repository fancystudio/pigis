<?php
$lang['error_invalidurl'] = 'The blog article url specified is invalid.  Maybe it contains invalid characters, or duplicates the url of another article';
$lang['detail_page'] = 'Page de d&eacute;tail';
$lang['detail_template'] = 'Gabarit de d&eacute;tail';
$lang['warning_preview'] = 'Warning: This preview panel behaves much like a browser window allowing you to navigate away from the initially previewed page. However, if you do that, you may experience unexpected behaviour.  Navigating away from the initial page and returning will not give the expected results.<br/><strong>Note:</strong> The preview does not upload files you may have selected for upload.';
$lang['tab_preview'] = 'Pr&eacute;visualisation';
$lang['article'] = 'Article';
$lang['helpuglyurls'] = 'Applicable only to the browsecat action, this parameter will force the category browsing action to not generate pretty urls, therefor parameters used in the call to CGBlog can be passed through to the summary view';
$lang['helpnotcategory'] = 'Applicable to the default summary action, this parameter allows specifying a comma separated list of category names representing categories to NOT return in the results.  This parameter cannot be used with the category or categoryid parameters.';
$lang['info_default_showarchive'] = 'If enabled, only articles that have expired and would not normally show are displayed.  This option is ignored if showall is selected';
$lang['title_default_showarchive'] = 'Afficher les articles archiv&eacute;s';
$lang['title_default_showall'] = 'Afficher tous les articles';
$lang['info_default_showall'] = 'Si s&eacute;lectionn&eacute;, Tous les articles, peu importe leur statuts, ou leur date de d&eacute;but et fin, seront affich&eacute;s.';
$lang['title_default_pagelimit'] = 'Limite par page par d&eacute;faut';
$lang['info_default_pagelimit'] = 'La limite par page d&eacute;finie combien d&#039;articles apparaitront sur chaque pages. Ce doit &ecirc;tre une valeur enti&egrave;re comprise entre 1 et 50000';
$lang['info_default_sortorder'] = 'Le sens du tri n&#039;est pas pris en compte lorsque vous utilisez un tri al&eacute;atoire';
$lang['info_default_sortby'] = 'Select the default sorting for summary views.  When using random sorting it is possible that entries will appear on multiple pages.';
$lang['sortorder_desc'] = 'D&eacute;croissant';
$lang['sortorder_asc'] = 'Croissant';
$lang['sortby_starttime'] = 'Date de d&eacute;but d&#039;un article';
$lang['sortby_endtime'] = 'Date de fin d&#039;un article';
$lang['sortby_random'] = 'Tri al&eacute;atoire';
$lang['sortby_extra'] = 'Champs additionnel d&#039;un article';
$lang['sortby_summary'] = 'R&eacute;sum&eacute; de l&#039;article';
$lang['sortby_category'] = 'Cat&eacute;gorie d&#039;article';
$lang['sortby_title'] = 'Titre de l&#039;article';
$lang['sortby_date'] = 'Date de l&#039;article';
$lang['title_default_sortby'] = 'Tri par d&eacute;faut';
$lang['title_default_sortorder'] = 'Sens du tri par d&eacute;faut';
$lang['summary_options'] = 'Summary View Options';
$lang['prompt_friendlyname'] = 'Nom personnalis&eacute; du module';
$lang['url_template'] = 'Gabarit d&#039;URL';
$lang['error_urlused'] = 'L&#039;URL sp&eacute;cifi&eacute;e est d&eacute;j&agrave; utilis&eacute;e';
$lang['error_badurl'] = 'L&#039;URL sp&eacute;cifi&eacute;e est invalide';
$lang['info_fesubmit_wysiwyg'] = 'Cette option d&eacute;sactive l&#039;utilisation de l&#039;&eacute;diteur WYSIWYG sur le site public, en d&eacute;pit des autres param&egrave;tres.';
$lang['fesubmit_wysiwyg'] = 'Autoriser l&#039;utilisation de l&#039;&eacute;diteur WYSIWYG';
$lang['return_to_content'] = 'Retour';
$lang['size'] = 'Taille';
$lang['allowed_filetypes'] = 'Types de fichiers autoris&eacute;s';
$lang['enable_wysiwyg'] = 'Autoriser le WYSIWYG';
$lang['preview_size'] = 'Taille de l&#039;image de pr&eacute;visualisation (pixels)';
$lang['preview'] = 'G&eacute;n&eacute;rer une image de pr&eacute;visualisation';
$lang['thumbnail_size'] = 'Taille de la miniature d&#039;image (pixels)';
$lang['thumbnail'] = 'G&eacute;n&eacute;rer une miniature d&#039;image';
$lang['watermark'] = 'Tatouer l&#039;image t&eacute;l&eacute;charg&eacute;e vers le blog';
$lang['allowed_imagetypes'] = 'Types d&#039;images autoris&eacute;s';
$lang['image'] = 'Image ';
$lang['help_adminuser'] = 'Applicable uniquement &agrave; l&#039;action=<em>default</em> (vue sommaire &quot;summary&quot;), cette option permet le filtrage des r&eacute;sultats aux administrateurs sp&eacute;cifi&eacute;s. Exemple : <code>admin_user=&quot;bob,fred,george&quot;</code>';
$lang['help_fesubmitpage'] = 'Applicable uniquement &agrave; l&#039;action=<em>myarticles</em>, ce param&egrave;tre permet de sp&eacute;cifier une page pr&eacute;cise <em>(d&eacute;sign&eacute;e par ID ou alias) o&ugrave; placer le formulaire de soumission sur le site public.</li>';
$lang['help_userparam'] = 'Applicable uniquement &agrave; l&#039;action=<em>default</em> (summary - sommaire), ce param&egrave;tre permet de limiter les r&eacute;sultats aux auteurs FEU (<em>Non expir&eacute;s</em>) sp&eacute;cifi&eacute;s. Par exemple : <code>author=&quot;user1@domaine.com,user2@domaine.com&quot;</code>.';
$lang['help_inline'] = 'Applicable uniquement &agrave; l&#039;action=<em>myarticles</em>, ce param&egrave;tre sp&eacute;cifie que les liens de pagination doit &ecirc;tre cr&eacute;es en mode <em>inline</em>. Cela signifie que le contenu g&eacute;n&eacute;r&eacute; par le module va remplacer le tag original du module, et non le tag {content} sur la page de destination.';
$lang['fesubmit_updatestatus'] = 'Les utilisateurs du site public peuvent changer le statut d&#039;un article';
$lang['you_authored'] = 'Jusqu&#039;&agrave; pr&eacute;sent, le nombre d&#039;articles dont vous &ecirc;tes l&#039;auteur est de ';
$lang['my_articles'] = 'Mes articles';
$lang['id'] = 'ID';
$lang['modified'] = 'Modifi&eacute;';
$lang['fesubmit_managearticles'] = 'Autoriser les utilisateurs du site public &agrave; g&eacute;rer leurs propres articles de blog ?';
$lang['fesubmit_dfltexpiry'] = 'Par d&eacute;faut, les articles soumis par le site public utilisent la date d&#039;expiration';
$lang['fesubmit_usexpiry'] = 'Autoriser les utilisateurs du site soumettant un article &agrave; d&eacute;sactiver la date d&#039;expiration';
$lang['url'] = 'URL ';
$lang['helpshowdraft'] = 'Applicable uniquement &agrave; l&#039;affichage par d&eacute;faut des sommaires, ce param&egrave;tre consid&egrave;re uniquement les articles encore &agrave; l&#039;&eacute;tat de brouillon pour constituer la liste des sommaires. Ceci fonctionne uniquement si l&#039;utilisateur connect&eacute; est autoris&eacute; &agrave; voir les entr&eacute;es encore &agrave; l&#039;&eacute;tat de brouillon, comme sp&eacute;cifi&eacute; dans l&#039;onglet des options du panneau d&#039;administration du module CGBlog';
$lang['title_default_status'] = 'Statut par d&eacute;faut pour les nouveaux articles';
$lang['fesubmit_draftviewers'] = 'Le groupe FEU autoris&eacute; &agrave; lire les brouillons d&#039;articles';
$lang['title_default_summarypage'] = 'Page par d&eacute;faut du sommaire (si aucun pageId n&#039;est sp&eacute;cifi&eacute; dans l&#039;URL)';
$lang['title_default_detailpage'] = 'Page par d&eacute;faut des d&eacute;tails (si aucun pageId n&#039;est sp&eacute;cifi&eacute; dans l&#039;URL)';
$lang['helparchivetemplate'] = 'Applicable uniquement &agrave; l&#039;action <em>archive</em>, ce param&egrave;tre peut &ecirc;tre utilis&eacute; pour sp&eacute;cifier un gabarit particulier pour l&#039;affichage d&#039;archive.';
$lang['addedit_archive_template'] = 'Ajouter/Editer un gabarit d&#039;affichage d&#039;archives';
$lang['info_archive_templates'] = 'Gabarits disponibles pour l&#039;affichage d&#039;archives';
$lang['archivetemplate'] = 'Gabarits d&#039;affichage d&#039;archives';
$lang['title_sysdefault_archive_template'] = 'Gabarit par d&eacute;faut du syst&egrave;me pour l&#039;affichage d&#039;archives';
$lang['helpfelisttemplate'] = 'Applicable uniquement &agrave; l&#039;action=<em>myarticles</em>, ce param&egrave;tre permet l&#039;utilisation d&#039;un autre gabarit pour le rapport de liste d&#039;articles';
$lang['helpfesubmittemplate'] = 'Applicable uniquement &agrave; l&#039;action <em>fesubmit</em>, ce param&egrave;tre peut &ecirc;tre utilis&eacute; pour sp&eacute;cifier un gabarit particulier pour le formulaire de soumission.';
$lang['helpsummarypage'] = 'Applicable uniquement aux actions <em>browsecat et archive</em>, ce param&egrave;tre peut contenir un pageId ou un alias &agrave; utiliser pour l&#039;affichage d&#039;une liste de sommaires, qui r&eacute;sulte d&#039;un clique sur un lien d&#039;une cat&eacute;gorie';
$lang['help_month'] = 'Applicable uniquement &agrave; l&#039;action <em>default</em>, ce param&egrave;tre peut contenir un entier (num&eacute;ro de mois) pour lequel un listage complet sera effectu&eacute; et affich&eacute;. Ce param&egrave;tre fonctionne uniquement en conjonction avec le param&egrave;tre &quot;year&quot;.';
$lang['category_modified'] = 'Cat&eacute;gorie modifi&eacute;e avec succ&egrave;s';
$lang['new_category_name'] = 'Nom de la nouvelle cat&eacute;gorie';
$lang['old_category_name'] = 'Ancien nom de la cat&eacute;gorie';
$lang['edit_category'] = 'Editer la cat&eacute;gorie';
$lang['error_nocatname'] = 'Aucun nom de cat&eacute;gorie n&#039;a &eacute;t&eacute; fourni';
$lang['move_up'] = 'Monter';
$lang['move_down'] = 'Descendre';
$lang['postuninstall'] = 'Le module CGBlog a &eacute;t&eacute; d&eacute;sinstall&eacute;.  Vous pouvez maintenant effacer les fichiers associ&eacute;s &agrave; ce module en toute s&eacute;curit&eacute;.';
$lang['ipaddress'] = 'Adresse IP';
$lang['fesubmit_redirect'] = 'PageID ou alias o&ugrave; se fera la redirection apr&egrave;s qu&#039;un article ait &eacute;t&eacute; soumis via l&#039;action fesubmit&nbsp;';
$lang['templaterestored'] = 'Gabarit restaur&eacute;';
$lang['fesubmit_status'] = 'Le statut des articles soumis via les pages du site (frontend)&nbsp;';
$lang['fesubmit_email_users'] = 'Envoyer une notification (via email) &agrave; ces utilisateurs';
$lang['no'] = 'Non';
$lang['yes'] = 'Oui';
$lang['fesubmit_email_template'] = 'Gabarit de l&#039;email';
$lang['fesubmit_email_html'] = 'Envoyer un email au format HTML ?';
$lang['fesubmit_email_subject'] = 'Sujet du courriel';
$lang['general_options'] = 'Options g&eacute;n&eacute;rales du blog';
$lang['fesubmit_options'] = 'Options de soumission';
$lang['dflt_email_subject'] = 'Une nouvelle entr&eacute;e a &eacute;t&eacute; post&eacute;e dans le blog';
$lang['postdatetoolate'] = 'La date du post est trop tardive';
$lang['title_sysdefault_felist_template'] = 'Gabarit par d&eacute;faut pour le rapport de liste d&#039;articles';
$lang['title_sysdefault_fesubmit_template'] = 'Gabarit par d&eacute;faut du syst&egrave;me pour le formulaire de soumission';
$lang['addedit_felist_template'] = 'Ajouter/Editeur un gabarit de rapport de liste d&#039;articles';
$lang['addedit_fesubmit_template'] = 'Ajouter/Editer un gabarit de formulaire de soumission';
$lang['info_felist_templates'] = 'Gabarit de rapport de liste d&#039;articles disponibles';
$lang['info_fesubmit_templates'] = 'Gabarits de soumission disponibles pour les utilisateurs';
$lang['felisttemplate'] = 'Gabarits de rapport de liste d&#039;articles';
$lang['fesubmittemplate'] = 'Gabarits de soumission pour les utilisateurs';
$lang['help_year'] = 'Utilis&eacute; avec l&#039;action par d&eacute;faut (summary), ce param&egrave;tre peut contenir une ann&eacute;e pour laquelle un listage complet sera effectu&eacute; et affich&eacute;';
$lang['info_urlprefix'] = 'Ceci s&#039;applique uniquement si les &#039;pretty urls&#039; sont activ&eacute;s, soit via &#039;mod_rewrite&#039; ou &#039;internal pretty urls&#039;.';
$lang['url_prefix'] = 'Pr&eacute;fixe &agrave; utiliser pour tous les URL du module de blog';
$lang['friendlyname'] = 'Blog (CG)';
$lang['select_category'] = 'Vous devez s&eacute;lectionner au moins une cat&eacute;gorie';
$lang['set_default'] = 'D&eacute;finir par d&eacute;faut';
$lang['category_deleted'] = 'Cat&eacute;gorie effac&eacute;e';
$lang['error_dberror'] = 'Il y a eu une erreur dans la base de donn&eacute;es. Contactez votre administrateur.';
$lang['category_added'] = 'Cat&eacute;gorie ajout&eacute;e';
$lang['category_name_exists'] = 'Une cat&eacute;gorie portant ce nom existe d&eacute;j&agrave;';
$lang['error_insufficient_params'] = 'Les param&egrave;tres fournis pour l&#039;action sont insuffisants ou invalides';
$lang['add_category'] = 'Ajouter une cat&eacute;gorie';
$lang['addedit_summary_template'] = 'Aouter/Editer un gabarit d&#039;affichage de sommaire';
$lang['addedit_detail_template'] = 'Ajouter/Editer un gabarit d&#039;affichage d&eacute;taill&eacute;';
$lang['addedit_browsecat_template'] = 'Ajouter/Editer un gabarit d&#039;affichage de navigation de cat&eacute;gories';
$lang['info_summary_templates'] = 'Gabarits disponibles pour les sommaires';
$lang['info_detail_templates'] = 'Gabarits disponibles pour les d&eacute;tails';
$lang['info_browsecat_templates'] = 'Gabarits disponibles pour la navigation de cat&eacute;gories';
$lang['title_sysdefault_browsecat_template'] = 'Gabarit par d&eacute;faut du syst&egrave;me pour la navigation de cat&eacute;gories';
$lang['title_sysdefault_detail_template'] = 'Gabarit par d&eacute;faut du syst&egrave;me pour l&#039;affichage des d&eacute;tails';
$lang['title_sysdefault_summary_template'] = 'Gabarit par d&eacute;faut du syst&egrave;me pour l&#039;affichage du sommaire';
$lang['info_sysdefault_template'] = 'Ce gabarit sp&eacute;cifie le contenu qui est inclus lorsque l&#039;on cr&eacute;e un nouveau gabarit du type sp&eacute;cifi&eacute;. Modifier ce gabarit n&#039;a aucun effet imm&eacute;diat sur les affichages';
$lang['expired_searchable'] = 'Les articles expir&eacute;s peuvent appara&icirc;tre dans les r&eacute;sultats de recherche&nbsp;';
$lang['helpshowall'] = 'Voir tous les articles, quelle que soit la date de fin';
$lang['error_invaliddates'] = 'Une ou plusieurs dates entr&eacute;es sont invalides';
$lang['notify_n_draft_items_sub'] = '%d article(s)';
$lang['notify_n_draft_items'] = 'Vous avez %s non publi&eacute;(s)';
$lang['unlimited'] = 'Sans limite';
$lang['none'] = 'Aucun';
$lang['anonymous'] = 'Anonyme';
$lang['unknown'] = 'Inconnu';
$lang['allow_summary_wysiwyg'] = 'Autoriser l&#039;utilisation de l&#039;&eacute;diteur WYSIWYG dans le champ sommaire&nbsp;';
$lang['title_browsecat_template'] = 'Gabarit de cat&eacute;gories';
$lang['title_browsecat_sysdefault'] = 'Gabarit de cat&eacute;gories par d&eacute;faut';
$lang['browsecattemplate'] = 'Gabarit de cat&eacute;gories';
$lang['error_filesize'] = 'Un fichier upload&eacute; exc&egrave;de la taille maximum autoris&eacute;e';
$lang['post_date_desc'] = 'Date d&#039;article post&eacute; d&eacute;croissante';
$lang['post_date_asc'] = 'Date d&#039;article post&eacute; croissante';
$lang['expiry_date_desc'] = 'Date d&#039;expiration d&eacute;croissante';
$lang['expiry_date_asc'] = 'Date d&#039;expiration croissante';
$lang['title_desc'] = 'Titre d&eacute;croissant';
$lang['title_asc'] = 'Titre croissant';
$lang['error_invalidfiletype'] = 'Impossible de t&eacute;l&eacute;charger ce type de fichier';
$lang['error_upload'] = 'Il y a eu un probl&egrave;me lors du t&eacute;l&eacute;chargement d&#039;un fichier';
$lang['error_movefile'] = 'Impossible de cr&eacute;er ce fichier : %s';
$lang['error_mkdir'] = 'Impossible de cr&eacute;er ce r&eacute;pertoire : %s';
$lang['expiry_interval'] = 'Le nombre de jours (par d&eacute;faut) avant qu&#039;un article expire (si &quot;Utiliser la date d&#039;expiration&quot; est s&eacute;lectionn&eacute;e)&nbsp;';
$lang['removed'] = 'Supprim&eacute;';
$lang['delete_selected'] = 'Supprimer les articles s&eacute;lectionn&eacute;s';
$lang['areyousure_deletemultiple'] = '&Ecirc;tes-vous s&ucirc;r de vouloir supprimer tous ces articles&nbsp;?\nCette action est d&eacute;finitive&nbsp;!';
$lang['error_templatenamexists'] = 'Un gabarit de ce nom existe d&eacute;j&agrave;';
$lang['error_noarticlesselected'] = 'Aucun article s&eacute;lectionn&eacute;';
$lang['reassign_category'] = 'Changer la cat&eacute;gorie par&nbsp;';
$lang['select'] = 'S&eacute;lectionner';
$lang['approve'] = 'D&eacute;finir le statut &agrave; &#039;Publi&eacute;&#039;';
$lang['revert'] = 'D&eacute;finir le statut &agrave; &#039;Brouillon&#039;';
$lang['hide_summary_field'] = 'Cacher le champ sommaire lors de l&#039;ajout ou de la modification d&#039;articles&nbsp;';
$lang['textbox'] = 'Champ de texte';
$lang['checkbox'] = 'Case &agrave; cocher';
$lang['textarea'] = 'Zone de texte';
$lang['file'] = 'Fichier';
$lang['auto_create_thumbnails'] = 'Cr&eacute;ation automatique de fichiers &quot;vignettes&quot; pour les fichiers avec ces extensions';
$lang['fielddefupdated'] = 'La d&eacute;finition du champ a &eacute;t&eacute; mise &agrave; jour avec succ&egrave;s.';
$lang['editfielddef'] = '&Eacute;diter la d&eacute;finition du champ';
$lang['up'] = 'Haut';
$lang['down'] = 'Bas';
$lang['fielddefdeleted'] = 'La d&eacute;finition du champ a &eacute;t&eacute; supprim&eacute;e avec succ&egrave;s.';
$lang['nameexists'] = 'Un champ de ce nom existe d&eacute;j&agrave;';
$lang['notanumber'] = 'La longueur maximale n&#039;est PAS un nombre';
$lang['fielddef'] = 'D&eacute;finition du champ';
$lang['fielddefadded'] = 'La d&eacute;finition du champ a &eacute;t&eacute; ajout&eacute;e avec succ&egrave;s.';
$lang['public'] = 'Publique&nbsp;';
$lang['type'] = 'Type&nbsp;';
$lang['info_maxlength'] = 'Longueur maximale uniquement pour champ de texte.';
$lang['maxlength'] = 'Longueur maximale&nbsp;';
$lang['addfielddef'] = 'Ajouter une d&eacute;finition de champ';
$lang['customfields'] = 'D&eacute;finition des champs';
$lang['deprecated'] = 'Non support&eacute;';
$lang['extra'] = 'Extra ';
$lang['uploadscategory'] = 'Cat&eacute;gorie t&eacute;l&eacute;chargements';
$lang['title_available_templates'] = 'Gabarits disponibles';
$lang['resettodefault'] = 'Restaurer les param&egrave;tres par d&eacute;faut';
$lang['prompt_templatename'] = 'Nom du gabarit&nbsp;';
$lang['prompt_template'] = 'Source du gabarit&nbsp;';
$lang['template'] = 'Gabarit&nbsp;';
$lang['prompt_name'] = 'Nom';
$lang['prompt_default'] = 'D&eacute;faut';
$lang['prompt_newtemplate'] = 'Cr&eacute;er un nouveau gabarit';
$lang['help_pagelimit'] = 'Nombre maximal d&#039;articles affich&eacute;s (par page). Si ce param&egrave;tre n&#039;est pas d&eacute;fini, tous les articles sont affich&eacute;s. Si ce param&egrave;tre est d&eacute;fini, et que le nombre d&#039;articles est sup&eacute;rieur, les textes et les liens seront affich&eacute;s pour permettre le d&eacute;filement des r&eacute;sultats.';
$lang['prompt_page'] = 'Page ';
$lang['firstpage'] = '<<';
$lang['prevpage'] = '<';
$lang['nextpage'] = '>';
$lang['lastpage'] = '>>';
$lang['prompt_of'] = 'sur';
$lang['prompt_pagelimit'] = 'Nb d&#039;articles par page&nbsp;';
$lang['prompt_sorting'] = 'Tri&eacute; par&nbsp;';
$lang['title_filter'] = 'Filtres';
$lang['published'] = 'Publi&eacute;';
$lang['draft'] = '&Eacute;bauche';
$lang['expired'] = 'Expir&eacute;';
$lang['author'] = 'Auteur&nbsp;';
$lang['sysdefaults'] = 'Restaurer les param&egrave;tres par d&eacute;faut';
$lang['restoretodefaultsmsg'] = 'Cette op&eacute;ration restaurera les gabarits par d&eacute;faut. &Ecirc;tes-vous s&ucirc;r de vouloir continuer&nbsp;?';
$lang['addarticle'] = 'Ajouter un article';
$lang['articleadded'] = 'L&#039;article a &eacute;t&eacute; ajout&eacute; avec succ&egrave;s.';
$lang['articleaddeddraft'] = 'Votre article a &eacute;t&eacute; ajout&eacute;. Un administrateur va valider son contenu avant affichage sur le site.';
$lang['articleupdated'] = 'L&#039;article a &eacute;t&eacute; mis &agrave; jour avec succ&egrave;s.';
$lang['articledeleted'] = 'L&#039;article a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s.';
$lang['addcategory'] = 'Ajouter une cat&eacute;gorie';
$lang['addcgblogitem'] = 'Ajouter un article';
$lang['allcategories'] = 'Toutes les cat&eacute;gories';
$lang['allentries'] = 'Toutes les entr&eacute;es';
$lang['areyousure'] = '&Ecirc;tes-vous s&ucirc;r(e) de vouloir supprimer&nbsp;?';
$lang['articles'] = 'Articles ';
$lang['cancel'] = 'Annuler';
$lang['category'] = 'Cat&eacute;gorie&nbsp;';
$lang['categories'] = 'Cat&eacute;gories';
$lang['default_category'] = 'Cat&eacute;gorie par d&eacute;faut&nbsp;';
$lang['content'] = 'Contenu&nbsp;';
$lang['delete'] = 'Effacer';
$lang['description'] = 'Ajout, &eacute;dition et suppression des articles';
$lang['detailtemplate'] = 'Gabarit du d&eacute;tail article';
$lang['default_templates'] = 'Gabarits par d&eacute;faut';
$lang['detailtemplateupdated'] = 'Le gabarit de l&#039;affichage du d&eacute;tail de l&#039;article a &eacute;t&eacute; sauvegard&eacute; dans la base de donn&eacute;es.';
$lang['displaytemplate'] = 'Afficher le gabarit';
$lang['edit'] = '&Eacute;diter';
$lang['enddate'] = 'Date de fin&nbsp;';
$lang['endrequiresstart'] = 'Entrer une date de fin n&eacute;cessite qu&#039;une date de d&eacute;but soit &eacute;galement entr&eacute;e';
$lang['entries'] = '%s entr&eacute;es';
$lang['status'] = 'Statut';
$lang['expiry'] = 'Expiration';
$lang['filter'] = 'Filtre';
$lang['more'] = 'Plus';
$lang['category_label'] = 'Cat&eacute;gorie&nbsp;:';
$lang['author_label'] = 'Post&eacute; par&nbsp;:';
$lang['moretext'] = 'Texte suppl&eacute;mentaire';
$lang['name'] = 'Nom&nbsp;';
$lang['cgblog_return'] = 'Retour';
$lang['newcategory'] = 'Nouvelle cat&eacute;gorie';
$lang['needpermission'] = 'Vous devez avoir la permission &#039;%s&#039; pour ex&eacute;cuter cette action.';
$lang['nocategorygiven'] = 'Aucune cat&eacute;gorie sp&eacute;cifi&eacute;e';
$lang['startdatetoolate'] = 'la date de d&eacute;but est pass&eacute;e (apr&egrave;s la Date de fin ?)';
$lang['nocontentgiven'] = 'Aucun contenu sp&eacute;cifi&eacute;';
$lang['noitemsfound'] = '<strong>Aucun</strong> objet trouv&eacute; pour cette cat&eacute;gorie: %s';
$lang['nopostdategiven'] = 'Aucune date de post sp&eacute;cifi&eacute;e';
$lang['note'] = '<em>Note :</em> Les dates doivent &ecirc;tre entr&eacute;es dans ce format &#039;yyyy-mm-dd hh:mm:ss&#039;.';
$lang['notitlegiven'] = 'Aucun titre sp&eacute;cifi&eacute;';
$lang['nonamegiven'] = 'Aucun nom sp&eacute;cifi&eacute;';
$lang['numbertodisplay'] = 'Nombre &agrave; afficher (toutes les entr&eacute;es si laiss&eacute; vide)&nbsp;';
$lang['print'] = 'Imprimer';
$lang['postdate'] = 'Date &agrave; laquelle l&#039;article a &eacute;t&eacute; post&eacute;&nbsp;';
$lang['postinstall'] = 'Assurez-vous que les utilisateurs qui administreront les articles aient la permission &quot;Modify CGBlog&quot;.';
$lang['selectcategory'] = 'S&eacute;lection de cat&eacute;gorie';
$lang['showchildcategories'] = 'Afficher les sous-cat&eacute;gories&nbsp;';
$lang['sortascending'] = 'Tri ascendant&nbsp;';
$lang['startdate'] = 'Date de d&eacute;but&nbsp;';
$lang['startoffset'] = 'Commence l&#039;affichage au &eacute;ni&egrave;me article&nbsp;';
$lang['startrequiresend'] = 'Entrer une date de d&eacute;but n&eacute;cessite qu&#039;une date de fin soit &eacute;galement entr&eacute;e';
$lang['submit'] = 'Envoyer';
$lang['summary'] = 'Sommaire&nbsp;';
$lang['summarytemplate'] = 'Gabarit du sommaire article';
$lang['summarytemplateupdated'] = 'Le gabarit d&#039;affichage du sommaire d&#039;article a &eacute;t&eacute; mis &agrave; jour avec succ&egrave;s';
$lang['title'] = 'Titre&nbsp;';
$lang['options'] = 'Options ';
$lang['optionsupdated'] = 'Les options ont &eacute;t&eacute; mises &agrave; jour avec succ&egrave;s';
$lang['useexpiration'] = 'Utiliser la date d&#039;expiration&nbsp;';
$lang['eventdesc-CGBlogArticleAdded'] = 'Envoy&eacute; quand un article est ajout&eacute;';
$lang['eventhelp-CGBlogArticleAdded'] = '<p>Envoy&eacute; quand un article est ajout&eacute;</p>
<h4>Param&egrave;tres</h4>
<ul>
<li>&quot;cgblog_id&quot; - Id de l&#039;article</li>
<li>&quot;category_id&quot; - Id de la cat&eacute;gorie de cet article</li>
<li>&quot;title&quot; - Titre de l&#039;article</li>
<li>&quot;content&quot; - Contenu de l&#039;article</li>
<li>&quot;summary&quot; - Sommaire de l&#039;article</li>
<li>&quot;status&quot; - Statut de l&#039;article (&quot;draft&quot; or &quot;published&quot;)</li>
<li>&quot;start_time&quot; - Date de d&eacute;but de publication de l&#039;article</li>
<li>&quot;end_time&quot; - Date de fin de publication de l&#039;article</li>
<li>&quot;useexp&quot; - Si la date d&#039;expiration doit &ecirc;tre ignor&eacute;e ou pas</li>
</ul>
<p><strong>Note :</strong> Puisque cet &eacute;v&egrave;nement est envoy&eacute; depuis plusieurs endroits du module, tous les param&egrave;tres peuvent ne pas &ecirc;tre envoy&eacute;s avec l&#039;&eacute;v&egrave;nement. Des informations peuvent &ecirc;tre r&eacute;cup&eacute;r&eacute;es de la base de donn&eacute;es &agrave; l&#039;aide du param&egrave;tre &quot;cgblog_id&quot;</p>';
$lang['eventdesc-CGBlogArticleEdited'] = 'Envoy&eacute; quand un article est &eacute;dit&eacute;';
$lang['eventhelp-CGBlogArticleEdited'] = '<p>Envoy&eacute; quand un article est &eacute;dit&eacute;</p>
<h4>Param&egrave;tres</h4>
<ul>
<li>&quot;cgblog_id&quot; - Id de l&#039;article</li>
<li>&quot;category_id&quot; - Id de la cat&eacute;gorie de cet article</li>
<li>&quot;title&quot; - Titre de l&#039;article</li>
<li>&quot;content&quot; - Contenu de l&#039;article</li>
<li>&quot;summary&quot; - Sommaire de l&#039;article</li>
<li>&quot;status&quot; - Statut de l&#039;article (&quot;draft&quot; or &quot;published&quot;)</li>
<li>&quot;start_time&quot; - Date de d&eacute;but de publication de l&#039;article</li>
<li>&quot;end_time&quot; - Date de fin de publication de l&#039;article</li>
<li>&quot;useexp&quot; - Si la date d&#039;expiration doit &ecirc;tre ignor&eacute;e ou pas</li>
</ul>
';
$lang['eventdesc-CGBlogArticleDeleted'] = 'Envoy&eacute; quand un article est supprim&eacute;';
$lang['eventhelp-CGBlogArticleDeleted'] = '<p>Envoy&eacute; quand un article est supprim&eacute;</p>
<h4>Param&egrave;tres</h4>
<ul>
<li>&quot;cgblog_id&quot; - Id de l&#039;article</li>
</ul>
';
$lang['eventdesc-CGBlogCategoryAdded'] = 'Envoy&eacute; quand une cat&eacute;gorie est ajout&eacute;e';
$lang['eventhelp-CGBlogCategoryAdded'] = '<p>Envoy&eacute; quand une cat&eacute;gorie est ajout&eacute;e</p>
<h4>Param&egrave;tres</h4>
<ul>
<li>&quot;category_id&quot; - Id de la cat&eacute;gorie</li>
<li>&quot;name&quot; - Nom de la cat&eacute;gorie</li>
</ul>
';
$lang['eventdesc-CGBlogCategoryEdited'] = 'Envoy&eacute; quand une cat&eacute;gorie est &eacute;dit&eacute;e';
$lang['eventhelp-CGBlogCategoryEdited'] = '<p>Envoy&eacute; quand une cat&eacute;gorie est &eacute;dit&eacute;e</p>
<h4>Param&egrave;tres</h4>
<ul>
<li>&quot;category_id&quot; - Id de la cat&eacute;gorie</li>
<li>&quot;name&quot; - Nom de la cat&eacute;gorie</li>
<li>&quot;origname&quot; - Nom original de la cat&eacute;gorie</li>
</ul>
';
$lang['eventdesc-CGBlogCategoryDeleted'] = 'Envoy&eacute; quand une cat&eacute;gorie est supprim&eacute;e';
$lang['eventhelp-CGBlogCategoryDeleted'] = '<p>Envoy&eacute; quand une cat&eacute;gorie est supprim&eacute;e</p>
<h4>Param&egrave;tres</h4>
<ul>
<li>&quot;category_id&quot; - Id de la cat&eacute;gorie</li>
<li>&quot;name&quot; - Nom de la cat&eacute;gorie supprim&eacute;e</li>
</ul>
';
$lang['help_articleid'] = 'Ce param&egrave;tre est applicable uniquement &agrave; la vue de d&eacute;tail. Il permet de sp&eacute;cifier quel article sera affich&eacute; en mode d&eacute;taill&eacute;. Si la valeur utilis&eacute;e est -1, le syst&egrave;me affichera l&#039;article le plus r&eacute;cent, publi&eacute;, mais non expir&eacute;.';
$lang['helpnumber'] = 'Le nombre maximal d&#039;articles &agrave; afficher (par page) -- laisser ce param&egrave;tre vide affichera tous les articles. C&#039;est identique au param&egrave;tre &quot;pagelimit&quot;.';
$lang['helpstart'] = 'Commence au &eacute;ni&egrave;me article -- laisser ce param&egrave;tre vide commencera l&#039;affichage au premier article';
$lang['helpcategory'] = 'Utilis&eacute; pour les affichages de sommaire ou d&#039;archive pour afficher uniquement les articles de cette cat&eacute;gorie. Utiliser * apr&egrave;s le nom pour afficher les sous-cat&eacute;gories. Plusieurs cat&eacute;gories peuvent &ecirc;tre affich&eacute;es en les s&eacute;parant par une virgule. Laisser ce param&egrave;tre vide affichera toutes les cat&eacute;gories. Ce param&egrave;tre fonctionne &eacute;galement pour l&#039;action de soumission, cependant seulement un seul nom de cat&eacute;gorie est alors support&eacute;.';
$lang['helpsummarytemplate'] = 'Utilise la base de donn&eacute;e pour afficher le formulaire de soumission du sommaire des articles. Ce gabarit doit exister et, est visible dans l&#039;onglet &#039;Gabarit du sommaire article&#039; de Contenu/Articles, et n&#039;est pas n&eacute;cessaire par d&eacute;faut. Si ce param&egrave;tre n&#039;est pas sp&eacute;cifi&eacute; le gabarit par d&eacute;faut est utilis&eacute;.';
$lang['helpbrowsecattemplate'] = 'Utilise la base de donn&eacute;e pour afficher les gabarits de cat&eacute;gories. Ce gabarit doit exister et, est visible dans l&#039;onglet &#039;Gabarit de cat&eacute;gories&#039; de Contenu/Articles, et n&#039;est pas n&eacute;cessaire par d&eacute;faut. Si ce param&egrave;tre n&#039;est pas sp&eacute;cifi&eacute; le gabarit par d&eacute;faut est utilis&eacute;.';
$lang['helpdetailtemplate'] = 'Utilise la base de donn&eacute;e pour afficher le formulaire de soumission du d&eacute;tail des articles.  Ce gabarit doit exister et, est visible dans l&#039;onglet &#039;Gabarit du d&eacute;tail article&#039; de Contenu/Articles, et n&#039;est pas n&eacute;cessaire par d&eacute;faut. Si ce param&egrave;tre n&#039;est pas sp&eacute;cifi&eacute; le gabarit par d&eacute;faut est utilis&eacute;.';
$lang['helpsortby'] = 'Champ sur lequel trier les articles.  Les options sont : &quot;summary&quot;, &quot;cgblog_category&quot;, &quot;cgblog_title&quot;, &quot;cgblog_extra&quot;, &quot;end_time&quot;, &quot;start_time&quot;, &quot;random&quot;, &quot;cgblog_date&quot;, &quot;cgblog_data&quot;.  Par d&eacute;faut: &quot;cgblog_date&quot;.  Si &quot;random&quot; est sp&eacute;cifi&eacute;, le crit&egrave;re de tri est ignor&eacute;.';
$lang['helpsortasc'] = 'Trie les articles dans un ordre de date ascendant plut&ocirc;t que descendant. Par d&eacute;faut: descendant.';
$lang['helpdetailpage'] = 'Page dans laquelle afficher le d&eacute;tail des articles. Vous pouvez entrer soit un alias, soit un ID de page. Utile pour permettre d&#039;afficher le d&eacute;tail de l&#039;article dans un gabarit de page diff&eacute;rent de celui du sommaire.';
$lang['helpshowarchive'] = 'Afficher seulement les articles expir&eacute;s (si valeur non nulle)';
$lang['helpbrowsecat'] = 'Afficher une liste navigable de cat&eacute;gories';
$lang['helpaction'] = 'Outrepasse l&#039;action par d&eacute;faut. Les valeurs possibles sont :
<li>&quot;archive&quot; - pour afficher un rapport d&#039;archive des entr&eacute;es de votre blog</li>
<li>&quot;detail&quot; - pour afficher l&#039;article en mode d&eacute;taill&eacute;</li>
<li>&quot;default&quot; - pour afficher le sommaire de l&#039;article</li>
<li>&quot;fesubmit&quot; - pour afficher le gabarit du formulaire de soumission de nouveaux articles pour les utilisateurs</li>
<li>&quot;browsecat&quot; - pour afficher une liste de cat&eacute;gories</li>
<li>&quot;myarticles&quot; - pour afficher un rapport des articles soumis par l&#039;utilisateur actuellement identifi&eacute; (FEU).</li>
</ul>

';
?>
