<?php
$lang['use_or'] = 'Выдать результаты, содержащие ЛЮБОЕ из слов';
$lang['param_detailpage'] = 'Используется только для выдачи результатов из модулей. Этот параметр позволяет указать другую страницу для выдачи найденого. Эта настройка полезна, если Вы хотите выдавать результаты на страницах с различными шаблонами. <em> (<strong> Примечание: </ strong> Модули могут перекрывать эту параметр.) </ em>';
$lang['prompt_resultpage'] = 'Страница для выдачи результатов отдельных модулей. <em> (<strong> Примечание: </ strong> Модули могут перекрывать эту параметр.) </ em>';
$lang['search_method'] = 'Совместимость с Pretty Urls c помощью метода POST, по умолчанию параметры передаются в GET, чтобы изменить используйте {search search_method="post"} ';
$lang['export_to_csv'] = 'Экспорт в CSV';
$lang['prompt_savephrases'] = 'Поисковый запрос это не отдельные слова';
$lang['word'] = 'Слово';
$lang['count'] = 'Количество';
$lang['confirm_clearstats'] = 'Вы действительно хотите навсегда удалить всю статистику?';
$lang['clear'] = 'Очистить';
$lang['statistics'] = 'Статистика';
$lang['param_action'] = 'Укажите режим работы для модуля. Допустимы значения \'по умолчанию\', и \'ключевые слова\'. Ключевые слова могут быть использованы для создания, разделенного запятыми списка слов, пригодных для использования в мета-теге keywords.';
$lang['param_count'] = 'Этот параметр используется для управления выводом списка ключевых слов, их количество будет ограничено указанным числом';
$lang['param_pageid'] = 'Этот параметр используется только для управления выводом ключевых слов и определяет для какого pageid (отличного от значения по умолчанию) возвращать результаты';
$lang['param_inline'] = 'Если установлено \'true\', то форма поиска заместит тег {search} в блоке контента. Используйте этот параметр, если ваш шаблон содержит несколько блоков контента, и вы не хотите чтобы вывод тега {search} замещал блок {content}. ';
$lang['param_passthru'] = 'Передает именованные параметры указанным модулям. Формат каждого параметра: 
"passtru_MODULENAME_PARAMNAME=\'value\'", например: "passthru_News_detailpage=\'newsdetails\'".';
$lang['param_modules'] = 'Ограничить результаты поиска информацией, проиндексированной в указанных модулях (разделитель - запятая)';
$lang['searchsubmit'] = 'Искать';
$lang['search'] = 'Поиск ';
$lang['param_submit'] = 'Текст, который надо поместить на кнопку отправки запроса';
$lang['param_searchtext'] = 'Текст, который надо поместить в окно ввода для поиска';
$lang['prompt_searchtext'] = 'Текст поиска по умолчанию';
$lang['param_resultpage'] = 'Страница, на которой модуль будет выводить результаты поиска. Это может быть либо алиас страницы, либо её идентификатор. Используется для того, чтобы можно было показывать результаты с другим шаблоном, нежели с использующимся на странице с поисковой формой.';
$lang['prompt_alpharesults'] = 'Сортировать результаты по-алфавиту';
$lang['description'] = 'Модуль для поиска по сайту и контенту, управляемому другими модулями.';
$lang['reindexallcontent'] = 'Переиндексировать все содержимое';
$lang['reindexcomplete'] = 'Переиндексация завершена!';
$lang['stopwords'] = 'Cлова, не включаемые в поисковые индексы';
$lang['default_stopwords'] = 'i, me, my, myself, we, our, ours, ourselves, you, your, yours, 
yourself, yourselves, he, him, his, himself, she, her, hers, 
herself, it, its, itself, they, them, their, theirs, themselves, 
what, which, who, whom, this, that, these, those, am, is, are, 
was, were, be, been, being, have, has, had, having, do, does, 
did, doing, a, an, the, and, but, if, or, because, as, until, 
while, of, at, by, for, with, about, against, between, into, 
through, during, before, after, above, below, to, from, up, down, 
in, out, on, off, over, under, again, further, then, once, here, 
there, when, where, why, how, all, any, both, each, few, more, 
most, other, some, such, no, nor, not, only, own, same, so, 
than, too, very';
$lang['prompt_resetstopwords'] = 'Загрузка из языка Стоп Слов по умолчанию';
$lang['input_resetstopwords'] = 'Загрузка';
$lang['searchresultsfor'] = 'Результаты поиска для запроса ';
$lang['noresultsfound'] = 'По данному запросу ничего не найдено!';
$lang['timetaken'] = 'Затраченное время';
$lang['usestemming'] = 'Использовать морфологический поиск (только для английского)';
$lang['searchtemplate'] = 'Шаблон поиска';
$lang['resulttemplate'] = 'Шаблон результата';
$lang['submit'] = 'Отправить';
$lang['sysdefaults'] = 'Восстановить умолчания';
$lang['searchtemplateupdated'] = 'Шаблон поиска обновлен';
$lang['resulttemplateupdated'] = 'Шаблон результата обновлен';
$lang['restoretodefaultsmsg'] = 'Эта операция восстановит исходные системные шаблоны (ваши изменения будут утеряны). Вы уверены, что хотите продолжить?';
$lang['options'] = 'Настройки';
$lang['eventdesc-SearchInitiated'] = 'Отправляется после того, как начат поиск.';
$lang['eventdesc-SearchCompleted'] = 'Отправляется после того, как поиск завершен.';
$lang['eventdesc-SearchItemAdded'] = 'Отправляется после того, как новый объект проиндексирован.';
$lang['eventdesc-SearchItemDeleted'] = 'Отправляется, когда объект удален из индекса.';
$lang['eventdesc-SearchAllItemsDeleted'] = 'Отправляется, когда все объекты удалены из индекса.';
$lang['eventhelp-SearchInitiated'] = '<p>Отправляется, когда поиск начат</p>
<h4>Параметры</h4>
<ol>
<li>Искомый текст</li>
</ol>
';
$lang['eventhelp-SearchCompleted'] = '<p>Отправляется, когда поиск завершен</p>
<h4>Параметры</h4>
<ol>
<li>Искомый текст</li>
<li>Массив результатов</li>
</ol>
';
$lang['eventhelp-SearchItemAdded'] = '<p>Отправляется, когда новый объект проиндексирован</p>
<h4>Параметры</h4>
<ol>
<li>Имя модуля</li>
<li>Идентификатор объекта</li>
<li>Дополнительное свойства</li>
<li>Контент, который надо проиндексировать и добавить.</li>
</ol>
';
$lang['eventhelp-SearchItemDeleted'] = '<p>Отправляется, когда объект был удален из индекса</p>
<h4>Параметры</h4>
<ol>
<li>Имя модуля</li>
<li>Идентификатор объекта</li>
<li>Дополнительные свойства</li>
</ol>
';
$lang['eventhelp-SearchAllItemsDeleted'] = '<p>Отправляется, когда все объекты были удалены из индекса</p>
<h4>параметры</h4>
<ul>
<li>Нет</li>
</ul>
';
$lang['help'] = '<h3>Как это работает?</h3>

<p>Модуль поиска может искать по содержимому, управляемому "ядром", а также некоторыми зарегистрированными модулями. Вы набираете несколько слов, а он выдаёт соответствующие релевантные результаты.</p>

<h3>Как мне это использовать?</h3>

<p>Простейшим путем будет установка тега {search}. Это вставит вызов модуля в ваш шаблон или страницу, там где вам этого захочется и отобразит форму поискового запроса. Код вызова должен выглядеть так:  <code>{search}</code>.</p>

<h4>Как мне предотвратить индексирование некоторых частей контента?</h4>

<p>Поисковый модуль не будет искать на "неактивных" страницах. Тем не менее, в случае, если используется модуль CustomContent, или какая-либо другая Smarty-логика, с целью показать различный контент для различных групп пользователей, советуем предотвратить  индексирование всей страницы, даже если она активна. Чтобы это сделать, включите следующий тег в любом месте страницы <em><!-- pageAttribute: NotSearchable --></em>. Когда модуль поиска видит такой тег в коде страницы, он полностью исключает её из индекса.</p>

<p>Тег <em><!-- pageAttribute: NotSearchable --></em> также может быть помещен и в шаблон.  Если это сделать, то никакие из страниц, которые его используют не будут проидексированы. Чтобы  переиндексировать эти страницы, следует удалить этот тег.</p>';
$lang['utmz'] = '156861353.1342438660.1.1.utmccn=(referral)|utmcsr=forum.cmsmadesimple.org|utmcct=/viewtopic.php|utmcmd=referral';
$lang['utma'] = '156861353.927566274.1342438660.1342438660.1342440860.2';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>