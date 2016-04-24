<?php
/*
=============================================================================
BlockPro
=============================================================================
Автор:   ПафНутиЙ
URL:     http://pafnuty.name/
twitter: https://twitter.com/pafnuty_name
google+: http://gplus.to/pafnuty
email:   pafnuty10@gmail.com
=============================================================================
*/

if (!defined('DATALIFEENGINE') OR !defined('LOGGED_IN')) {
	die("Hacking attempt!");
}
if ($member_id['user_group'] != '1') {
	msg("error", $lang['index_denied'], $lang['index_denied']);
}

define('MODULE_DIR', ENGINE_DIR . '/modules/base/admin/blockpro/');

$moduleName    = 'blockpro';
$moduleVersion = '4.8.0';

$moderate              = $_REQUEST['moderate'];
$moderate_checked      = ($moderate) ? 'checked' : '';
$future                = $_REQUEST['future'];
$future_checked        = ($future) ? 'checked' : '';
$template              = $_REQUEST['template'];
$cachePrefix           = $_REQUEST['cachePrefix'];
$cacheSuffixOff        = $_REQUEST['cacheSuffixOff'];
$cacheNameAddon        = $_REQUEST['cacheNameAddon'];
$nocache               = $_REQUEST['nocache'];
$nocache_checked       = ($nocache) ? 'checked' : '';
$cacheLive             = $_REQUEST['cacheLive'];
$startFrom             = $_REQUEST['startFrom'];
$limit                 = $_REQUEST['limit'];
$fixed                 = $_REQUEST['fixed'];
$allowMain             = $_REQUEST['allowMain'];
$postId                = $_REQUEST['postId'];
$notPostId             = $_REQUEST['notPostId'];
$author                = $_REQUEST['author'];
$notAuthor             = $_REQUEST['notAuthor'];
$xfilter               = (is_array($_REQUEST['xfilter'])) ? implode(',', array_filter($_REQUEST['xfilter'])) : $_REQUEST['xfilter'];
$notXfilter            = (is_array($_REQUEST['notXfilter'])) ? implode(',', array_filter($_REQUEST['notXfilter'])) : $_REQUEST['notXfilter'];
$xfSearch              = $_REQUEST['xfSearch'];
$notXfSearch           = $_REQUEST['notXfSearch'];
$xfSearchLogic         = $_REQUEST['xfSearchLogic'];
$catId                 = (is_array($_REQUEST['catId'])) ? implode(',', array_filter($_REQUEST['catId'])) : $_REQUEST['catId'];
$subcats               = $_REQUEST['subcats'];
$subcats_checked       = ($subcats) ? 'checked' : '';
$notCatId              = (is_array($_REQUEST['notCatId'])) ? implode(',', array_filter($_REQUEST['notCatId'])) : $_REQUEST['notCatId'];
$notSubcats_checked    = ($notSubcats) ? 'checked' : '';
$notSubcats            = $_REQUEST['notSubcats'];
$tags                  = $_REQUEST['tags'];
$notTags               = $_REQUEST['notTags'];
$day                   = $_REQUEST['day'];
$dayCount              = $_REQUEST['dayCount'];
$sort                  = $_REQUEST['sort'];
$order                 = $_REQUEST['order'];
$avatar                = $_REQUEST['avatar'];
$avatar_checked        = ($avatar) ? 'checked' : '';
$showstat              = $_REQUEST['showstat'];
$showstat_checked      = ($showstat) ? 'checked' : '';
$related               = $_REQUEST['related'];
$showNav               = $_REQUEST['showNav'];
$showNav_checked       = ($showNav) ? 'checked' : '';
$pageNum               = $_REQUEST['pageNum'];
$navStyle              = $_REQUEST['navStyle'];
$cacheVars             = $_REQUEST['cacheVars'];
$xfSortType            = $_REQUEST['xfSortType'];
$symbols               = $_REQUEST['symbols'];
$notSymbols            = $_REQUEST['notSymbols'];
$saveRelated           = $_REQUEST['saveRelated'];
$fields                = $_REQUEST['fields'];
$navDefaultGet         = $_REQUEST['navDefaultGet'];
$navDefaultGet_checked = ($navDefaultGet) ? 'checked' : '';
$thisCatOnly           = $_REQUEST['thisCatOnly'];
$thisCatOnly_checked   = ($thisCatOnly) ? 'checked' : '';
$setFilter             = $_REQUEST['setFilter'];
$experiment            = $_REQUEST['experiment'];
$experiment_checked    = ($experiment) ? 'checked' : '';


$cfg = [
	'moderate' => !empty($moderate) ? $moderate : false, // Показывать только новости на модерации

	'template' => !empty($template) ? $template : 'blockpro/blockpro', // Название шаблона (без расширения)

	'cachePrefix' => !empty($cachePrefix) ? $cachePrefix : 'news', // Префикс кеша
	'cacheSuffixOff' => !empty($cacheSuffixOff) ? true : false, // Отключить суффикс кеша (будет создаваться один кеш-файл для всех пользователей). По умолчанию включен, т.е. для каждой группы пользователей будет создаваться свой кеш (на случай разного отображения контента разным юзерам).

	'cacheNameAddon' => '', // Назначаем дополнение к имени кеша, если имеются переменные со значениями this, они будут дописаны в имя кеша, иначе для разных мест будет создаваться один и тот же файл кеша

	'nocache' => !empty($nocache) ? $nocache : false, // Не использовать кеш
	'cacheLive' => (!empty($cacheLive) && !$mcache) ? $cacheLive : false, // Время жизни кеша в минутах

	'startFrom' => !empty($startFrom) ? $startFrom : '0', // C какой новости начать вывод
	'limit' => !empty($limit) ? $limit : '10', // Количество новостей в блоке
	'fixed' => !empty($fixed) ? $fixed : 'yes', // Обработка фиксированных новостей (yes/only/without показ всех/только фиксированных/только обычных новостей)
	'allowMain' => !empty($allowMain) ? $allowMain : 'yes', // Обработка новостей, опубликованных на главной (yes/only/without показ всех/только на главной/только не на главной)
	'postId' => !empty($postId) ? $postId : '', // ID новостей для вывода в блоке (через запятую, или черточку)
	'notPostId' => !empty($notPostId) ? $notPostId : '', // ID игнорируемых новостей (через запятую, или черточку)

	'author' => !empty($author) ? $author : '', // Логины авторов, для показа их новостей в блоке (через запятую)
	'notAuthor' => !empty($notAuthor) ? $notAuthor : '', // Логины игнорируемых авторов (через запятую)

	'xfilter' => !empty($xfilter) ? $xfilter : '', // Имена дополнительных полей для фильтрации новостей по ним (через запятую)
	'notXfilter' => !empty($notXfilter) ? $notXfilter : '', // Имена дополнительных полей для игнорирования показа новостей (через запятую)

	'xfSearch' => !empty($xfSearch) ? $xfSearch : false, // синтаксис передачи данных: &xfSearch=имя_поля|значение||имя_поля|значение
	'notXfSearch' => !empty($notXfSearch) ? $notXfSearch : false, // синтаксис передачи данных: &notXfSearch=имя_поля|значение||имя_поля|значение
	'xfSearchLogic' => !empty($xfSearchLogic) ? $xfSearchLogic : 'OR', // Принимает OR или AND (по умолчанию OR)

	'catId' => !empty($catId) ? $catId : '', // Категории для показа	(через запятую, или черточку)
	'subcats' => !empty($subcats) ? $subcats : false, // Выводить подкатегории указанных категорий (&subcats=y), работает и с диапазонами.
	'notCatId' => !empty($notCatId) ? $notCatId : '', // Игнорируемые категории (через запятую, или черточку)
	'notSubcats' => !empty($notSubcats) ? $notSubcats : false, // Игнорировать подкатегории игнорируемых категорий (&notSubcats=y), работает и с диапазонами.
	'thisCatOnly' => !empty($thisCatOnly) ? $thisCatOnly : false, // Показывать новости ТОЛЬКО из текущей категории (имеет смысл при выводе похожих новостей и использоваии мультикатегорий).

	'tags' => !empty($tags) ? $tags : '', // Теги из облака тегов для показа новостей, содержащих их (через запятую)
	'notTags' => !empty($notTags) ? $notTags : '', // Игнорируемые теги (через запятую)

	'day' => !empty($day) ? $day : false, // Временной период для отбора новостей
	'dayCount' => !empty($dayCount) ? $dayCount : false, // Интервал для отбора (т.е. к примеру выбираем новости за прошлую недею так: &day=14&dayCount=7 )
	'sort' => !empty($sort) ? $sort : 'top', // Сортировка (top, date, comms, rating, views, title, hit, random, randomLight, download, symbol, editdate или xf|xfieldname где xfieldname - имя дополнительного поля, field|p.name где p.name — кастомное поле)
	'xfSortType' => !empty($xfSortType) ? $xfSortType : 'int', // Тип сортировки по допполю (string, int) - для корректной сортировки по строке используем string, по умолчанию сортируется как число (для цен полезно).
	'order' => !empty($order) ? $order : 'new', // Направление сортировки (new, old, asis)

	'avatar' => !empty($avatar) ? $avatar : false, // Вывод аватарки пользователя (немного усложнит запрос).

	'showstat' => !empty($showstat) ? $showstat : false, // Показывать время и статистику по блоку

	'related' => !empty($related) ? $related : false, // Включить режим вывода похожих новостей (по умолчанию нет)
	'saveRelated' => !empty($saveRelated) ? $saveRelated : false, // Включить запись похожих новостей в БД
	'showNav' => !empty($showNav) ? $showNav : false, // Включить постраничную навигацию
	'navDefaultGet' => !empty($navDefaultGet) ? $navDefaultGet : false, // Слушать дефолтный get-параметр постраничной навигации
	'pageNum' => !empty($pageNum) ? $pageNum : '1', // Текущая страница при постраничной конфигурации
	'navStyle' => !empty($navStyle) ? $navStyle : 'classic', // Стиль навигации. Возможны следующие стили:
	/*
	classic:	<< Первая  < 1 [2] 3 >  Последняя >>
	digg:		<< Назад  1 2 ... 5 6 7 8 9 [10] 11 12 13 14 ... 25 26  Вперёд >>
	extended:	<< Назад | Страница 2 из 11 | Показаны новости 6-10 из 52 | Вперёд >>
	punbb:		1 ... 4 5 [6] 7 8 ... 15
	arrows:	    << Назад Вперёд >>
	 */
	/**
	 * @todo  реализовать функционал с options и notOptions
	 */
	'options' => !empty($options) ? $options : false, // Опции, публикации новости для показа (Публиковать на главной, Разрешить рейтинг статьи, Разрешить комментарии, Запретить индексацию страницы для поисковиков, Зафиксировать новость) main|rating|comments|noindex
	'notOptions' => !empty($notOptions) ? $notOptions : false, // Опции, публикации новости для исключения (Публиковать на главной, Разрешить рейтинг статьи, Разрешить комментарии, Запретить индексацию страницы для поисковиков, Зафиксировать новость) main|rating|comments|noindex

	'future' => !empty($future) ? $future : false, // Выводить только новости, дата публикации которых не наступила (Полезно для афиш) &future=y
	'cacheVars' => !empty($cacheVars) ? $cacheVars : false, // Значимые переменные в формировании кеша блока на случай разного вывода в зависимости от условий расположения модуля. Сюда можно передавать ключи, доступные через $_REQUEST или значения переменной $dle_module
	'symbols' => !empty($symbols) ? $symbols : false, // Символьные коды для фильтрации по символьному каталогу. Перечисляем через запятую.
	'notSymbols' => !empty($notSymbols) ? $notSymbols : false, // Символьные коды для исключающей фильтрации по символьному каталогу. Перечисляем через запятую или пишем this для текущего символьного кода
	'fields' => !empty($fields) ? $fields : false, // Дополнение к выборке полей из БД (p.field,e.field)
	'setFilter' => !empty($setFilter) ? $setFilter : '', // Собственная фильтрация полей БД
	'experiment' => !empty($experiment) ? $experiment : false, // Включить экспериментальные функции
];

/**
 * var array $bpConfig
 */
include ENGINE_DIR . '/data/blockpro.php';
// Лиц. ключ для передачи в обращение в техподдержку (для более эффективного оказания ТП).
$od_activation_key = $bpConfig['activation_key'];

// Объединяем массивы конфигов
$cfg = array_merge($cfg, $bpConfig);

if ($_REQUEST['setPreview']) {
	// Формируем имя кеш-файла с конфигом
	$pageCahceName = $cfg;
	// Удаляем номер страницы для того, что бы не создавался новый кеш для каждого блока постранички
	unset($pageCahceName['pageNum']);
	// Сокращаем немного имя файла :)
	$pageCahceName = 'bpa_' . crc32(implode('_', $pageCahceName));

	// Включаем кеширование DLE принудительно
	$cashe_tmp             = $config['allow_cache'];
	$config['allow_cache'] = '1';

	// Проверяем есть ли кеш с указанным именем
	$ajaxCache = base_dle_cache($pageCahceName);
	// Если кеша нет
	if (!$ajaxCache) {
		// Сериализуем конфиг для последующей записи в кеш
		$pageCacheText = serialize($cfg);
		// Создаём кеш
		base_create_cache($pageCahceName, $pageCacheText);
	}

	// Возвращаем значение кеша DLE обратно
	$config['allow_cache'] = $cashe_tmp;

}


function base_dle_cache($prefix, $cache_id = false, $member_prefix = false) {
	global $config, $is_logged, $member_id, $mcache;

	if (!$config['allow_cache']) {
		return false;
	}

	$config['clear_cache'] = (intval($config['clear_cache']) > 1) ? intval($config['clear_cache']) : 0;

	if ($is_logged) {
		$end_file = $member_id['user_group'];
	} else {
		$end_file = "0";
	}

	if (!$cache_id) {

		$key = $prefix;

	} else {

		$cache_id = md5($cache_id);

		if ($member_prefix) {
			$key = $prefix . "_" . $cache_id . "_" . $end_file;
		} else {
			$key = $prefix . "_" . $cache_id;
		}

	}

	if ($mcache) {

		return memcache_get($mcache, md5(DBNAME . PREFIX . md5(SECURE_AUTH_KEY) . $key));

	} else {

		$buffer = @file_get_contents(ENGINE_DIR . "/cache/" . $key . ".tmp");

		if ($buffer !== false AND $config['clear_cache']) {

			$file_date = @filemtime(ENGINE_DIR . "/cache/" . $key . ".tmp");
			$file_date = time() - $file_date;

			if ($file_date > ($config['clear_cache'] * 60)) {
				$buffer = false;
				@unlink(ENGINE_DIR . "/cache/" . $key . ".tmp");
			}

			return $buffer;

		} else {
			return $buffer;
		}

	}
}

function base_create_cache($prefix, $cache_text, $cache_id = false, $member_prefix = false) {
	global $config, $is_logged, $member_id, $mcache;

	if (!$config['allow_cache']) {
		return false;
	}

	if ($is_logged) {
		$end_file = $member_id['user_group'];
	} else {
		$end_file = "0";
	}

	if (!$cache_id) {
		$key = $prefix;
	} else {
		$cache_id = md5($cache_id);

		if ($member_prefix) {
			$key = $prefix . "_" . $cache_id . "_" . $end_file;
		} else {
			$key = $prefix . "_" . $cache_id;
		}

	}

	if ($mcache) {

		$config['clear_cache'] = (intval($config['clear_cache']) > 1) ? intval($config['clear_cache']) : 0;

		if ($config['clear_cache']) {
			$set_time = $config['clear_cache'] * 60;
		} else {
			$set_time = 86400;
		}

		memcache_set($mcache, md5(DBNAME . PREFIX . md5(SECURE_AUTH_KEY) . $key), $cache_text, MEMCACHE_COMPRESSED, $set_time);

	} else {

		file_put_contents(ENGINE_DIR . "/cache/" . $key . ".tmp", $cache_text, LOCK_EX);

		@chmod(ENGINE_DIR . "/cache/" . $key . ".tmp", 0666);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php echo $config['charset'] ?>">
	<title>BlockPro</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="engine/modules/base/admin/blockpro/css/main.css?v=<?php echo $moduleVersion ?>">
	<script>
		var dle_root = '<?php echo $config['http_home_url']?>';
		var dle_skin = '<?php echo $config['skin']?>';
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/autosize.js/1.18.1/jquery.autosize.min.js"></script>

	<script src="engine/modules/base/admin/blockpro/js/jquery.form.min.js?v=<?php echo $moduleVersion ?>"></script>
	<script src="engine/modules/base/admin/blockpro/js/jquery.ladda.min.js?v=<?php echo $moduleVersion ?>"></script>
	<script
		src="engine/modules/base/admin/blockpro/js/jquery.easyResponsiveTabs.min.js?v=<?php echo $moduleVersion ?>"></script>
	<script
		src="engine/modules/base/admin/blockpro/js/jquery.magnificpopup.min.js?v=<?php echo $moduleVersion ?>"></script>
	<script src="engine/modules/base/admin/blockpro/js/jquery.chosen.min.js?v=<?php echo $moduleVersion ?>"></script>
	<script src="engine/modules/base/admin/blockpro/js/main.js?v=<?php echo $moduleVersion ?>"></script>
</head>
<body>
<div class="container container-blue">
	<header class="content">
		<div class="col col-mb-12 col-6">
			<a href="<?php echo $PHP_SELF ?>?mod=main"
			   class="btn btn-small btn-white"><?php echo $lang['skin_main'] ?></a>
			<a class="btn btn-small btn-white" href="<?php echo $PHP_SELF ?>?mod=options&amp;action=options"
			   title="Список всех разделов">Список всех разделов</a>
			<a href="<?php echo $config['http_home_url'] ?>" target="_blank"
			   class="btn btn-small btn-white"><?php echo $lang['skin_view'] ?></a>
		</div>
		<div class="col col-mb-12 col-6 ta-right">
			<?php echo $member_id['name'] . ' <small class="hide-phone">(' . $user_group[$member_id['user_group']]['group_name'] . ')</small> ' ?>
			<a href="<?php echo $PHP_SELF ?>?action=logout"
			   class="btn btn-small btn-red"><?php echo $lang['skin_logout'] ?></a>
		</div>
	</header>
</div>
<div class="container">
	<div class="content">
		<div class="col col-mb-12 col-12">
			<h1 class="ta-center mb10">BlockPro
				<small class="text-muted fz20">(<?php echo $moduleVersion ?>)</small>
				<span class="btn btn-small btn-red mfp-open-ajax"
				      data-mfp-src="engine/ajax/base/check_updates.php?name=<?php echo $moduleName ?>&currentVersion=<?php echo $moduleVersion ?>">Проверить обновления</span>
			</h1>
			<div class="ta-center">Статус лицензии: <span id="licenseStatus"></span></div>
			<hr>
		</div> <!-- .col col-mb-12 col-12 -->
	</div> <!-- .content -->
	<div id="tab">
		<div class="content">
			<div class="col col-mb-12">
				<ul class="resp-tabs-list">
					<li>Параметры</li>
					<li>Результат</li>
					<li>Виджеты</li>
					<li>Хелперы</li>
					<li>Настройки</li>
					<li>Документация и техподдержка</li>
				</ul>

				<div class="resp-tabs-container">
					<div>
						<?php include(MODULE_DIR . 'generator.php'); ?>
					</div>
					<div>
						<div class="content">
							<div class="col col-mb-12">
								<?php if ($_REQUEST['setPreview']): ?>
									<?php
									$moduleUrl = 'include file="engine/modules/base/blockpro.php';
									$paramsUrl = [];

									// Удаляем значения по умолчанию за ненадобностью.
									unset($cfg['activation_key'], $cfg['kraken_secret'], $cfg['tinypng_key'], $cfg['kraken_key']);

									if ($cfg['template'] == 'blockpro/blockpro') {
										unset($cfg['template']);
									}
									if ($cfg['cachePrefix'] == 'news') {
										unset($cfg['cachePrefix']);
									}
									if ($cfg['limit'] == 10) {
										unset($cfg['limit']);
									}
									if ($cfg['fixed'] == 'yes') {
										unset($cfg['fixed']);
									}
									if ($cfg['allowMain'] == 'yes') {
										unset($cfg['allowMain']);
									}
									if ($cfg['xfSearchLogic'] == 'on') {
										unset($cfg['xfSearchLogic']);
									}
									if ($cfg['xfSearchLogic'] == 'OR') {
										unset($cfg['xfSearchLogic']);
									}
									if ($cfg['sort'] == 'top') {
										unset($cfg['sort']);
									}
									if ($cfg['order'] == 'new') {
										unset($cfg['order']);
									}
									if ($cfg['pageNum'] == 1) {
										unset($cfg['pageNum']);
									}
									if ($cfg['navStyle'] == 'classic') {
										unset($cfg['navStyle']);
									}
									if ($cfg['xfSortType'] == 'int') {
										unset($cfg['xfSortType']);
									}

									$filteredCfg = array_filter($cfg);
									if (count($filteredCfg) > 0) {
										$moduleUrl .= '?';
									}
									foreach (array_filter($cfg) as $key => $value) {
										$paramsUrl[] = $key . '=' . $value;
									}
									$moduleUrl .= implode('&amp;', $paramsUrl);
									?>
									<h2>Ваша строка подключения: <span class="btn btn-green btn-small btn-external-save"
									                                   data-mfp-src="engine/ajax/base/save_block_pro.php?blockId=<?php echo $pageCahceName ?>">Создать виджет</span>
									</h2>
									<textarea rows="1" class="input input-block-level code">{<?php echo $moduleUrl ?>"}</textarea>
									<h2>Предпросмотр блока:</h2>
									<hr>
									<div class="content">
										<script>
											jQuery(document).ready(function ($) {
												var blockId = '<?php echo $pageCahceName?>',
													pageNum = '<?php echo $cfg['pageNum']?>',
													$block = $('#preview_tab');
												$block.addClass('base-loader loading');
												$.ajax({
														url: dle_root + 'engine/ajax/blockpro.php',
														dataType: 'html',
														data: {
															pageNum: pageNum,
															blockId: blockId
														},
													})
													.done(function (data) {
														$block.html(data);
													})
													.fail(function () {
														console.error("error");
													})
													.always(function () {
														$block.removeClass('base-loader loading');
													});
											});
										</script>
									</div>
								<?php else: ?>
									<div class="alert">
										Нужно для начала задать параметры строки подключения на предыдущей вкладке
									</div>
								<?php endif ?>
								<div id="preview_tab">
								</div>
							</div>
						</div>
					</div>
					<div>
						<?php include(MODULE_DIR . 'vidgets.php'); ?>
					</div>
					<div>
						<h2>Картинки</h2>

						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Сервис для обработки картинок <br>
								<small>
									Для корректной работы сервисов необходима их <a href="?mod=blockpro#tab5">настройка</a>
								</small>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input class="radio" type="radio" name="service" value="image" id="service_local" checked data-setimage >
								<label for="service_local"><span></span>Встроенный механизм</label>
								<br>
								<input class="radio" type="radio" name="service" value="tinypng" id="service_tinypng" data-setimage >
								<label for="service_tinypng"><span></span>TinyPNG</label>
								<br>
								<input class="radio" type="radio" name="service" value="kraken" id="service_kraken" data-setimage >
								<label for="service_kraken"><span></span>Kraken.io</label>
							</div>
						</div>

						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Название переменной для картинки-заглушки
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input type="text" class="input" name="img_defImage" data-id="img_defImage"
								       data-defimage data-setimage value="$noimage" placeholder="например $noimage">
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Путь к картинке-заглушке <br>
								<small>Относительно текущего шаблона сайта <b>{$theme}</b></small>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input type="text" class="input" name="img_noimage" data-id="img_noimage" data-defimage
								       value="/images/noimage.png" placeholder="например /images/noimage.png">
							</div>
						</div>
						<hr>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Тип выводимой картинки
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<select name="img_type" class="styler" data-setimage data-img-type>
									<option value="small">Уменьшенная копия</option>
									<option value="original">Оригинальная картинка</option>
									<option value="intext">Как есть</option>
								</select>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Номер картинки в контенте
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input type="text" class="input" name="img_number" value="1"
								       placeholder="например 3 или all" data-setimage data-img-count>

								<div class="alert alert-info">
									Можно прописать "<b>all</b>" для вывода массива со всеми картинками выбраного поля.
								</div>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Размер картики <br>
								<small>по умолчанию не определён, выводится картинка без ресайза</small>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input type="text" class="input" name="img_size" value=""
								       placeholder="например 100 или 100x150" data-setimage>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Качество картинки <br>
								<small>по умолчанию не определено, картинка будет выведена в исходном качестве</small>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input type="text" class="input" name="img_quality" value="" placeholder="0-100"
								       data-setimage>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Тип ресайза
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<select id="img_resize_type" name="img_resize_type" class="styler" data-setimage>
									<option value="">вписать в рамки (авто)</option>
									<option value="exact">точный размер (возможны деформации пропорций)</option>
									<option value="landscape">уменьшение по ширине</option>
									<option value="portrait">уменьшение по высоте</option>
									<option value="crop">crop (уменьшение и обрезка лишнего)</option>
								</select> <br>
								<input class="checkbox" type="checkbox" value="true" name="img_grab" id="img_grab"
								       checked data-setimage> <label for="img_grab"><span></span> Грабить сторонние
									картинки к себе</label> <br>
								<input class="checkbox" type="checkbox" value="true" name="img_get_small"
								       id="img_get_small" data-setimage> <label for="img_get_small"><span></span>
									Обрабатывать уменьшенную копию, если есть</label> <br>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Подпапка для картинок <br>
								<small>иногда бывает нужно</small>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input type="text" class="input" name="img_subfolder" value=""
								       placeholder="например subfolder" data-setimage>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Код для картинки-заглушки
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
										<textarea id="img_code" class="input code">{*Определение картинки-заглушки*}
{var $noimage}
	{$theme}/images/noimage.png
{/var}</textarea>
							</div>
						</div>

						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Код для вставки в шаблон (внутрь цикла) <br>
								<span class="text-red">Не забывайте сменить short_story на нужное поле</span>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<textarea id="img_code2" class="input code">{$el.short_story|image:$noimage:'small':'1':'':'':'':true:false:''}</textarea>
							</div>
						</div>
						<hr>
						<h2>Текст</h2>

						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Максимальное кол-во символов <br>
								<small>по умолчанию не определено, текст будет просто очищаться от html-тегов</small>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input type="text" class="input" name="txt_limit" value="" placeholder="например 150"
								       data-settext data-text-limit>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Символы на окончании текста <br>
								<small>по умолчанию <b class="text-red">&amp;hellip;</b></small>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<input type="text" class="input" name="txt_etc" value=""
								       placeholder="например &amp;hellip;" data-settext data-text-etc> <br>
								<input class="checkbox" type="checkbox" value="true" name="txt_wordcut" id="txt_wordcut"
								       data-settext data-text-checkbox> <label for="txt_wordcut"><span></span> Жесткое
									ограничение символов</label>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Код для вставки в шаблон (внутрь цикла) <br>
								<span class="text-red">Не забывайте сменить short_story на нужное поле</span>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<textarea id="txt_code" rows="1" class="input code">{$el.short_story|limit:'150'}</textarea>
							</div>
						</div>
						<hr>


						<h2>Категории</h2>

						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Выводимая информация из категории
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<select id="cat_info" name="cat_info" class="styler" data-setcatinfo>
									<option value="">Весь массив с информацией</option>
									<option value="name">Название категории</option>
									<option value="link">Ссылка на категорию</option>
									<option value="url">URL категории</option>
									<option value="icon">Иконка категории</option>
									<option value="icon_noimage">Иконка категории (с заглушкой)</option>
								</select>
							</div>
						</div>
						<div class="content">
							<div class="col col-mb-12 col-5 col-dt-4 form-label">
								Код для вставки в шаблон (внутрь цикла) <br>
							</div>
							<div class="col col-mb-12 col-7 col-dt-8 form-control">
								<textarea id="cat_code" rows="1" class="input code">{$el.category|catinfo}</textarea>
							</div>
						</div>


					</div>
					<div>
						<?php include(MODULE_DIR . 'config.php'); ?>
					</div>
					<div>
						<div class="content">
							<div class="col col-mb-12 col-2 form-label">
								&nbsp;
							</div>
							<div class="col col-mb-12 col-10 form-control">
								<h2 class="m0">Документация к модулю</h2>
							</div>
							<div class="col col-mb-12 mb10">
								Документация к модулю всегда доступна на официальном сайте, в разделе <a
									href="http://blockpro.ru/documentation/" target="_blank">документация</a>.
							</div>
						</div>
						<hr>
						<div class="content">
							<div class="col col-mb-12 col-2 form-label">
								&nbsp;
							</div>
							<div class="col col-mb-12 col-10 form-control">
								<h2 class="m0">Условия получения техподдержки по модулю</h2>
							</div>
							<div class="col col-mb-12 mb10">
								<div class="alert">
									<p>
										Начиная с версии 4.6.0 техническая поддержка клиентов осуществляется только через
										систему обращений. Это удобнее и гораздо эффективнее, чем email-переписка или
										переписка в различных месседжерах.
									</p>
									<p>
										При создании обращения из админки модуля него автоматически передаётся лицензионный ключ, версия модуля и адрес сайта, это улучшает эффективность оказания техподдержки и нам не придётся тратить время на выяснение технических деталей и активности лицензии.
									</p>
								</div>
								<p>
									Для получения техподдержки или решения иных вопросов, связанных с модулем воспользуйтесь кнопкой создания обращения ниже или в нижнем правом углу страницы. 
								</p>
									<span class="btn omni-email-widget">Создать обращение</span>

								<p>Если вопрос связан с выводм новостей — не забывайте указать строку подключения и
									прикреплять файл шаблона модуля, если он отличается от стандартного.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- #tab -->
</div> <!-- .container -->

<div class="container">
	<div class="content">
		<div class="col col-mb-12">
			<hr class="mt0">
			Контакты для связи и техподдержки:<br>
			<a href="https://pafnuty.omnidesk.ru/" target="_blank" title="Сайт поддержки">pafnuty.omnidesk.ru</a> —
			техподдержка <br>
			<a href="http://bp.pafnuty.name/" target="_blank" title="Официальный сайт модуля">bp.pafnuty.name</a> —
			документация <br>
		</div>
	</div>
</div>
<?php 
		
?>
<!-- Start of Omnidesk Widget script -->
<script>
	!function(e,o){window.omni=o;o.g_config={widget_id:"16-u6z46pw1"}; o.email_widget=o.email_widget||{};var w=o.email_widget;w.readyQueue=[];o.config=function(e){ this.g_config.user=e};w.ready=function(e){this.readyQueue.push(e)};var r=e.getElementsByTagName("script")[0];c=e.createElement("script");c.type="text/javascript",c.async=!0;c.src="https://omnidesk.ru/bundles/acmesite/js/cwidget.js";r.parentNode.insertBefore(c,r)}(document,window.omni||{});
	
	omni.config({
		diplay_button: true
	});

	omni.email_widget.ready(function () {
		omni.email_widget.identify = {
			<?php if(isset($member_id['fullname']) && $member_id['fullname'] !== ''): ?>
			user_full_name: '<?php echo $member_id['fullname']; ?>',
			<?php endif; ?>
			user_email: '<?php echo $member_id['email']; ?>',
			'Версия': '<?php echo $moduleVersion ?>', 
			<?php if (isset($od_activation_key) && $od_activation_key != ''): ?>
			'Ключ': '<?php echo $od_activation_key ?>', 
			<?php endif; ?>
			'Адрес сайта': '<?php echo $config['http_home_url']; ?>'
		};
	});

</script>
<!-- End of Omnidesk Widget script -->

</body>
</html>
