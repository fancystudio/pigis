<?php
$lang['friendlyname'] = 'SimpleSmarty (CG)&nbsp;';
$lang['help'] = '<h3>Que fait ce module ?</h3>
<p>Ce module fournit quelques fonctionnalit&eacute;s Simple Smarty &agrave; utiliser dans des applications ou pour personnaliser le comportement de vos pages de votre CMS Made Simple.</p>
<h3>Comment l&#039;utiliser ?</h3>
<p>Quand ce module est install&eacute;, un nouveau objet Smarty nomm&eacute; cgsimple est automatiquement disponible dans vos gabarits de page, blocs de contenus globaux et divers gabarits de modules. Ce objet Smarty a de nombreuses fonctions que vous pouvez appeler &agrave; tout moment.</p>
<h4>Fonctions disponibles :</h4>
<ul>
<li><strong>module_installed</strong>($modulename,[$assign])
    <p>Teste si un module particulier est install&eacute;.</p>
    <p>Arguments :
       <ul>
         <li>$modulename - Le nom du module &agrave; v&eacute;rifier</li>
         <li>[$assign]   - (optionnel) Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
      </ul>  
    <br/></p>
    <p>Exemple:<br/>
    <pre>{if $cgsimple->module_installed(&#039;FrontEndUsers&#039;)}Found FEU{/if}</pre>
    </p>
</li>

<li><strong>module_version</strong>($modulename,[$assign])
    <p>Renvoie le num&eacute;ro de version d&#039;un module install&eacute; sp&eacute;cifique.</p>
    <p>Arguments :
       <ul>
         <li>$modulename - Le nom du module &agrave; v&eacute;rifier</li>
         <li>[$assign]   - (optionnel) Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
      </ul>  
    <br/></p>
    <p>Exemple:<br/>
    <pre>{$cgsimple->module_version(&#039;FrontEndUsers&#039;,&#039;feu_version&#039;)}We have Version {$feu_version} of FrontEndUsers</pre>
    </p>
</li>

<li><strong>get_parent_alias</strong>([$alias],[$assign])
    <p>Renvoie l&#039;alias des pages parents sp&eacute;cifi&eacute;es. Renvoie un r&eacute;sultat vide s&#039;il n&#039;y a pas de parent.</p>
    <p>Arguments :
       <ul>
       <li>[$alias] - (optionnel) L&#039;alias de page pour lequel trouver le parent. Si aucune valeur sp&eacute;cifi&eacute;e, la page en cours est utilis&eacute;e.</li>
       <li>[$assign]   - (optionnel) Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
       </ul>  
    <br/></p>
    <p>Exemple :<br/>
    <pre>L&#039;alias de la page parent est {$cgsimple->get_parent_alias()}</pre>
    </p>
</li>

<li><strong>get_root_alias</strong>([$alias],[$assign])
    <p>Renvoie l&#039;alias de pages racine (root) parent sp&eacute;cifi&eacute;es. Renvoie un r&eacute;sultat vide s&#039;il n&#039;y a pas de parent racine (root).</p>
    <p>Arguments:
       <ul>
       <li>[$alias] - (optionnel) L&#039;alias de page pour lequel trouver le parent racine (root). Si aucune valeur sp&eacute;cifi&eacute;e, la page en cours est utilis&eacute;e.</li>
       <li>[$assign]   - (optionnel)  Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
       </ul>  
    <br/></p>
    <p>Exemple :<br/>
    <pre>L&#039;alias de la page racine est {$cgsimple->get_root_alias()}</pre>
    </p>
</li>

<li><strong>get_page_title</strong>([$alias],[$assign])
    <p>Renvoie le titre de la page sp&eacute;cifi&eacute;e.</p>
    <p>Arguments :
       <ul>
       <li>[$alias] - (optionnel) L&#039;alias de page pour lequel trouver le titre. Si aucune valeur sp&eacute;cifi&eacute;e, la page en cours est utilis&eacute;e.</li>
       <li>[$assign]   - (optionnel)  Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
       </ul>  
    <br/></p>
    <p>Exemple :<br/>
    <pre>Le titre de cette page est {$cgsimple->get_page_title()}</pre>
    </p>
</li>

<li><strong>get_page_menutext</strong>([$alias],[$assign])
    <p>Renvoie le texte du menu de la page sp&eacute;cifi&eacute;e.</p>
    <p>Arguments :
       <ul>
       <li>[$alias] -(optionnel) L&#039;alias de page pour lequel trouver le titre. Si aucune valeur sp&eacute;cifi&eacute;e, la page en cours est utilis&eacute;e.</li>
       <li>[$assign]   - (optionnel)  Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
       </ul>  
    <br/></p>
    <p>Exemple :<br/>
    <pre>Le texte du menu de la page actuelle est {$cgsimple->get_page_title()}</pre>
    </p>
</li>

<li><strong>has_children</strong>([$alias],[$assign])
    <p>Teste si la page sp&eacute;cifi&eacute;e a des enfants.</p>
    <p>Arguments:
       <ul>
       <li>[$alias] - (optionnel) L&#039;alias de page &agrave; tester. Si aucune valeur sp&eacute;cifi&eacute;e, la page en cours est utilis&eacute;e.</li>
       <li>[$assign] - (optionnel)  Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
       </ul>  
    <br/></p>
    <p>Exemple :<br/>
    <pre>{$cgsimple->has_children(&#039;&#039;,$has_children)}{if $has_children}La page actuelle a des pages enfants{else}La page actuelle n&#039;a pas de page enfant{/if}</pre>
    </p>
</li>

<li><strong>get_children</strong>([$alias],[$showinactive],[$assign])
   <p>Renvoie un tableau contenant des informations sur les pages enfants (s&#039;il y en a)</p>
    <p>Arguments :
       <ul>
       <li>[$alias] - (optionnel) L&#039;alias de page &agrave; tester. Si aucune valeur sp&eacute;cifi&eacute;e, la page en cours est utilis&eacute;e.</li>
       <li>[$showinactive] - (optionnel) Si les pages inactives doivent &ecirc;tre inclues dans le r&eacute;sultat (false par d&eacute;faut).</li>
       <li>[$assign] - (optionnel)  Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
       </ul>  
    <br/></p>
    <p>Champs :
       <ul>
       <li>alias - L&#039;alias de page de l&#039;enfant</li>
       <li>id -  L&#039;id de page de l&#039;enfant</li>
       <li>title - Le titre de page de l&#039;enfant</li>
       <li>menutext - le texte du menu de l&#039;enfant</li>
       </ul>
    <br/></p>
    <p>Exemple :<br/>
    <pre>
{$cgsimple->get_children(&#039;&#039;,&#039;&#039;,$children)}
{if count($children)}
   {foreach from=$children item=&#039;child&#039;}
      {if $child.show_in_menu}
        Child:  id = {$child.id} alias = {$child.alias}<br/>
      {/if}
   {/foreach}
{/if}
    </pre>
    </p>
</li>

    <li><strong>get_page_content</strong>($alias,[$block],[$assign])
    <p>Renvoie le texte d&#039;un bloc de contenu sp&eacute;cifique d&#039;une autre page.</p>
    <p>Arguments :
       <ul>
       <li>$alias - L&#039;alias de la page d&#039;o&ugrave; extraire le contenu.</li>
       <li>[$block] - (optionnel) Le nom du bloc de contenu dans la page sp&eacute;cifi&eacute;e. Si cette variable n&#039;est pas pr&eacute;cis&eacute;e, &#039;content_en&#039; est attribu&eacute;.</li>
       <li>[$assign] - (optionnel)  Le nom d&#039;une variable &agrave; laquelle assigner le r&eacute;sultat.</li>
       </ul>  
    <br/></p>
    <p>Exemple :<br/>
    <pre>Le titre de la page en cours est {$cgsimple->get_page_title()}</pre>
    </p>
  </li>
  <li><strong>get_sibling</strong>($direction[,$assign][,$alias])
    <p>Renvoie l&#039;alias du pr&eacute;c&eacute;dent ou suivant parent (de m&ecirc;me niveau) &agrave; la page sp&eacute;cifi&eacute;e. ou non.</p>
    <p>Arguments :
       <ul>
       <li>$direction - La direction vers laquelle regarder. Les valeurs possibles sont prev,previous,-1,next,1</li>
       <li>[$assign] - (optionnel) Le nom de la variable &agrave; laquelle assigner les r&eacute;sultats.</li>
       <li>[$alias] - (optionnel) L&#039;alias de page pour lequel trouver un parent de m&ecirc;me niveau.  Si non sp&eacute;cifi&eacute;, la page en cours est utilis&eacute;e.</li>
    <br/></p>
       <p>Exemple :<br/>
       <pre>Lien au pr&eacute;c&eacute;dent parent de m&ecirc;me niveau : {$cgsimple-&amp;gt;get_sibling(&amp;quot;prev&amp;quot,&amp;quot;prev_sibling&amp;quot;)}{if !empty($prev_sibling)}{cms_selflink page=&amp;quot;$prev_sibling&amp;quot; text=&amp;quot;Previous&amp;quot;}{/if}</pre><br/>
   </li>
</ul>
<h4>Autres fonctions Smarty</h4>
<ul>
    <li><strong>{module_action_link}</strong>
    <p>Un plugin Smarty qui peut cr&eacute;er un lien &agrave; une action de module.</p>
    <p>Arguments :
       <ul>
       <li>module - Le module avec lequel le lien est cr&eacute;&eacute;</li>
       <li>action (default) - L&#039;action &agrave; appeler au sein du module</li>
       <li>text - Le texte &agrave; mettre dans le lien</li>
       <li>page - Pr&eacute;cise la page de destination</li>
       <li>urlonly - au lieu de g&eacute;n&eacute;rer un lien, g&eacute;n&egrave;re simplement l&#039;url</li>
       <li>confmessage - Un message de confirmation pour afficher quand le lien est cliqu&eacute;.</li>
       <li>image - Une image &agrave; utiliser dans le lien</li>
       <li>imageonly - Si une image est sp&eacute;cifi&eacute;e, cr&eacute;e un lien consistant uniquement en l&#039;image. Le texte sera utilis&eacute; pour l&#039;attribut titre</li>
       </ul>
    <br/></p>
    <p>Tout autre argument pour le plugin Smarty sera ajout&eacute; &agrave; l&#039;URL g&eacute;n&eacute;r&eacute;e.</p>   <p>Exemple :
<pre>{module_action_link module=&#039;News&#039; action=&#039;fesubmit&#039; text=&#039;Submit a New News Article&#039;}</pre></p></li>

<li><strong>{session_put}</strong>
    <p>Un plugin Smarty qui peut enregistrer des donn&eacute;es dans la session de l&#039;utilisateur. Ces donn&eacute;es sont alors accessibles via l&#039;array $smarty.session dans les pages post&eacute;rieures.</p>
    <p>Arguments :
       <ul>
       <li>var - Le nom de la variable &agrave; cr&eacute;er dans la session.</li>
       <li>value - La valeur d&eacute;sir&eacute;e de la variable.</li>
       </ul>
    <br/></p>
    <p>Exemple :
    <pre>{session_put var=&#039;test&#039; value=&#039;blah&#039;}</pre><br/></p></li>

    <li><strong>{session_erase}</strong>
    <p>Un plugin Smarty qui peut effacer des donn&eacute;es dans la session de l&#039;utilisateur.</p>
    <p>Arguments :
       <ul>
       <li>var - Le nom de la variable &agrave; effacer dans la session.</li>
       </ul>
    <br/></p>
    <p>Exemple :
    <pre>{session_erase var=&#039;test&#039;}</pre><br/></p></li>

    <li><strong>{cgrepeat}</strong>
    <p>Un autre plugin Smarty qui permet de r&eacute;p&eacute;ter du texte</p>
    <p>Arguments :</p>
      <ul>
        <li>text - Le texte &agrave; r&eacute;p&eacute;ter</li>
        <li>count - Le nombre de r&eacute;p&eacute;tition</li>
        <li>assign - Assigne la sortie &agrave; la variable Smarty sp&eacute;cifi&eacute;e</li>
      </ul>
    <br/>
    <p>Exemple : <pre>{cgrepeat text=&#039;this&#039; count=&#039;5&#039;}</pre></p>
    </li>
</ul>
<h3>Copyright et Licence</h3>
<p>Copyright &copy; 2008, Robert Campbel <a href="mailto:calguy1000@cmsmadesimple.org"><calguy1000@cmsmadesimple.org></a>. Tous droits r&eacute;serv&eacute;s.</p>
<p>This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.</p>
<p>However, as a special exception to the GPL, this software is distributed
as an addon module to CMS Made Simple.  You may not use this software
in any Non GPL version of CMS Made simple, or in any version of CMS
Made simple that does not indicate clearly and obviously in its admin 
section that the site was built with CMS Made simple.</p>
<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>';
$lang['moddescription'] = 'Outils Calguys Simple Smarty';
$lang['postinstall'] = 'SimpleSmarty (CG) est maintenant install&eacute;';
$lang['postuninstall'] = 'SimpleSmarty (CG) a &eacute;t&eacute; d&eacute;sinstall&eacute;';
$lang['qca'] = 'P0-483686814-1251229608352';
$lang['utma'] = '57867837.1772960952774974200.1251229608.1315083144.1315177962.175';
?>