# 5.1.4
- Исправлена работа постраничной навигации при `catId=this` (#144)
- Исправлена логика отбора похожих новостей после релиза 5.1.2 (#155)

# 5.1.3
- Обновлен шаблонизатор Fenom до актуальной версии.

# 5.1.2
- В параметр setFilter добавлена возможность использовать условие OR при формировании запроса. Примеры использования:
```
// Поиск новостей с видео
setFilter=p.full_story|SEARCH|dle_media_begin|OR|p.full_story|SEARCH|dle_video_begin

// Новости у которых более 100 просмотров и (более 20 комментариев или положительный рейтинг)
setFilter=e.news_read|+|100||p.comm_num|+|20|OR|e.rating|+|0
```
- Реализовано улучшенный поиск похожих новостей, как в стандартном функционале DLE 13.1.
- Исправлена ошибка отображения модуля, возникающая при переключении шаблонов сайта, если шаблоны модуля в разных шаблонах сайта имеют одинаковые имена.
- Исправлено некорректное отображение версии модуля в админке
- Исправлена ошибка с некорректной загрузкой website.lng, если файл отредактирован через управление плагинами.

# 5.1.1
- Исправлено некорректное тернартное выражение (#133)
- Исправлена ошибка Fatal error: Cannot redeclare dle_session() (previously declared in... (#130)

# 5.1.0
- Совместимость с DLE 13.x
- Исправлено: Fatal error: Cannot redeclare class microTimer
- Исправлено: Не корректно работает постраничная навигация при использовании catId=this
- Исправлено: Не работает notPostId для похожих новостей
- Мелкие и незначительные исправления

# 5.0.2
- Мелкие и незначительные изменения

# 5.0.1
- Перезд в новый репозиторий на dle-modules
- Добавлена MIT лицензия

# 5.0.0
- Открытие исходников модуля для бесплатного использования.

# 4.9.1
- Добавлена возможность указывать время жизни кеша в секундах. Для этого необходимо к параметру `cacheLive` добавить букву `s` на конце. Например: `cacheLive=35s` установит время жизни кеша 35 секунд.
- Исправлена ошибка с излишней фильтрацией данных при указании параметра `tags=this`.
- Исправлена ошибка выставления рейтинга на DLE11.3.
- Добавлена возможность вызывать методы модуля внутри шаблонов модуля. Пример работы приведён в шаблоне custom_functions.tpl
- Исправлена ошибка, при которой в режиме вывода афиши фиксированные новости выводились в конце списка.
- ИСправлена ошибка, возникающая при сочетании параметров `notCatId` и `catId`. Например при `?catId=this&notCatId=3` отображались новости со всех категорий, кроме id=3, хотя должны были только из просматриваемой.

# 4.9.0
- Добавлена совместимость модуля с php 7
- Изменены минимальные системные требования для модуля. Минимальная версия PHP: 5.6, минимальная версия ionCube Loader: 6.0
- Обновлён шаблонизатор Fenom до версии 2.11.
- Исправлен некорректный шаг в инструкции по установке модуля (ручная правка файла blockpro.key)
- Удалён файл blockpro_upgrade.php, предназначавшийся для обновления с очень старых версий модуля.
- Дополнены условия лицензионного соглашения (добавлено явное указание срока действия лицензионного ключа)

# 4.8.1
- Добавлен показ модального окна при повторном выставлении рейтинга новостям, выводимым через модуль.
- Добавлен модификатор `timeago` для показа даты в формате "time ago". Например код `{$el.date|timeago:6}` выведет результат: **2 года, 4 месяца, 1 неделю, 6 дней, 12 часов и 5 минут назад**. В качестве параметра модификатор принимает цифру от 0 до 6, указывающую точность вывода от года до минут. По умолчанию установлено значение 2.
- Исправлена MySQL ошибка при получении похожих новостей с очень длинным контентом.
- Исправлена MySQL ошибка при выводе похожих новостей к несуществующей новости.


# 4.8.0
- Исправлена ошибка некорректного отбора новостей, когда в новости несколько тегов и используется параметр `&tags=thisNewsTags`. (https://pafnuty.omnidesk.ru/staff/cases/record/522-577973/)
- Исправлена ошибка когда в допполе фильтруемое значение указано не первым, то фильтрация этого значения не происходит
- Добавлена возможность сортировки по собственным полям БД. `&sort=p.custom_field` — поле из таблицы dle_post или `&sort=e.custom_field` —  поле из таблицы dle_post_extras.
- К параметру `setFilter` добавлены алиасы для указания логического оператора. Это сделано для исправления случаев, когда обычные символы не срабатывают из-за настроек фильтрации на сервере. Пример `&setFilter=YEAR(p.date)|eq|2016` — выберет новости, опубликованные в 2016 году.
- В параметр `setFilter` можно передавать значение NOW() для фильтрации по текущему timestamp. Например `&setFilter=p.event_start|gte|NOW()` — выберет новости, у которых дата начала события (нестандартное поле) больше или равна текущему моменту времени.
- В параметр `setFilter` можно передавать значение, являющееся поисковой строкой. Например `&setFilter=p.title|SEARCH|Добро пожаловать` найдёт все новости, в заголовке которых содержится словосочетание "Добро пожаловать". `&setFilter=p.title|NOT_SEARCH|Добро пожаловать` — противоположное значение.
- В параметр `&fixed` добавлено новое значение. `&fixed=ignore` — вывод новостей сплошным списком, без учёта признака зафиксированных новостей. Такой порядок может понадобиться при сортировке новостей по кастомному полю.
- Исправлена ошибка, приводящая к некорректной сортировке новостей при ajax постраничной навигации на второй и последующих страницах, когда новости сортируются по значению допполя.
- Исправлена ошибка, появляющаяся при наличии вложений в новости и работе модуля через ajax (постраничная навигация и предпросмотр в админке).
- Добавлен новый параметр `&experiment=y`, включающий экспериментальные функции модуля. Этот параметр включает улучшенные, но не оттестированные до конца, функции модуля. 
- В DLE 11 при включнии экспериментальных функций улучшена фильтрация по значению дополнительных полей.
- Исправлена некорректная работа модуля, когда пользователю разрешено менять шаблон сайта (шаблоны модуля подключались из папки, указанной в конфиг DLE).
- Добавлен новый модификатор `emath_all` для воспроизведения в шаблоне php-функции `preg_match_all` https://gist.github.com/19f913ba0ff1d78e15fa98ccd7c339b8
- Улучшения стиля php-кода.

# 4.7.2
- Исправлено некорректное отображение картинок добавления и удаления из-закладок при выводе блока на главной странице.
- Исправлена ошибка с отображением даты в новостях при постраничной навигации и предпросмотре в админке.
- Исправлено формирование ссылки на аватар пользователя в вду 10.5 и 10.6, обновлённых со старых версий.
- Исправлена ситуация, когда при включении в настройках DLE вывода новостей на ненаступившую дату могли выводиться новости за сегодня, но время публикации которых ещё не наступило.
- Теперь отправить обращение в техподдержку можно прямо из админки модуля. При этом информация о версии и лицензии будет автоматически прикреплена к сообщению.

# 4.7.1
- **Минимально необходимая версия php теперь 5.4**.
- **Минимально необходимая версия ionCube теперь 5.0**.
- Теперь модуль не зависит от настройки `short_open_tag`.
- Настройки лицензии вынесены в админку модуля.
- [beta] **Добавлена интеграция с сервисом tinyPNG.** Теперь можно удобно изменять размер и сразу же оптимизировать картинки. Отличительной особенностью сервиса является "умное" создание миниатюр в режиме crop. Для использования сервиса необходимо [получить API key](https://tinypng.com/developers). Для обработки картинок через tinyPNG необходимо заменть модификатор `image` на `tinypng`. Например: `{$el.short_story|tinypng:$noimage:'small':'all':'250':'':'crop'}`. Модификатор имеет такой же синтаксис передачи параметров, но не воспринимает значение качества картинки и принимает только следующие параметры ресайза: **portrait, landscape, auto, crop**.
- [beta] **Добавлена интеграция с сервисом Kraken.io.** Для обработки картинок через Kraken необходимо заменть модификатор `image` на `kraren`. Например: `{$el.short_story|kraren:$noimage:'small':'all':'250':'':'crop'}`. Модификатор имеет такой же синтаксис передачи параметров, но не воспринимает значение качества картинки.
- [beta] Добавлен новый параметр строки подключения: `setFilter`. Теперь есть возможность задать собственные параметры фильтрации новостей. http://bp.pafnuty.name/documentation/#setFilter
- Добавлен новый тег `{$totalCount}`, выводящий общее количество новостей в выборке. Если постраничная навигация включена - тег выводит общее кол-во новостей co всех страниц.
- Исправлена ошибка логики построения запроса для отбора новостей в режиме вывода афишей.
- Исправлено некорректное построение ЧПУ при третем типе настроек в DLE.
- Исправлена недостаточная фильтрация при отборе новостей по тегам.
- Исправлено некорректное формирование ссылки на аватар пользователя в dle 10.6.
- Исправлена некоррекная выборка новостей при фильтрации по допполям с логикой OR.
- Исправлена ошибка генерации предпросмотра блока в админке и создания виджета при использовании Memcache.
- Исправлена mysql ошибка, при некоторых случаях выборки по автору новости.
- Обновлён шаблонизатор до актуальной версии.
- Мелкие исправления, улучшения и доработки класса resize.php.
- Улучшенеи модификатора declination, теперь отрицательные числа тоже корректно склоняются.
- Рефакторинг, оптимизация и улучшение php кода модуля.
- Исправлена ошибка с некорректной генерацией строки подключения при предпросмотре виджетов в админке.