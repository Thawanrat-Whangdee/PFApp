<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FullcalendarAsset extends AssetBundle
{
	public $sourcePath = '@frontend/assets';
	public $css = ['fullcalendar.css','fullcalendar.print.css'];
	public $js = ['jquery-ui.custom.min.js','moment.min.js','fullcalendar.min.js','lang/all.js'];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
