<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">


    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        if (Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'overview') {
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar navbar-expand-md navbar-light bg-light fixed-top',
                ],
        ]);
                $menuItems = [];

            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Home', 'url' => ['/site/index']];
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                // $menuItems[] = ['label' => 'Expenses', 'url' => ['/expenses/index']];
                // $menuItems[] = ['label' => 'Incomes', 'url' => ['/incomes/index']];
                // $menuItems[] = ['label' => 'Savings', 'url' => ['/savings/index']];
                // $menuItems[] = ['label' => 'Limit', 'url' => ['/limit/index']];
                $menuItems[] = ['label' => 'Income Type', 'url' => ['/typeincome/index']];
                $menuItems[] = ['label' => 'Expense Type', 'url' => ['/typesexpense/index']];
                // $menuItems[] = ['label' => 'Pocket', 'url' => ['/pocket/index']]; 
                $menuItems[] = ['label' => 'Edit Profile', 'url' => ['site/update-user']]; 
                // $menuItems[] = ['label' => 'carry', 'url' => ['/carry/index']];
                $menuItems[] = ['label' => 'Logout (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'btn btn-link logout']];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav ml-auto'],
                'items' => $menuItems,
            ]);

            NavBar::end();
        }
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>
    <?php if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);} ?>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
