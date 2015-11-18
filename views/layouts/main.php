<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            if(Yii::$app->user->isGuest){
                $menu_items = [['label' => 'Login', 'url' => ['/user/security/login']]];
            }else{
                $menu_items = [['label' => 'Other action', 'items'=>[
                    ['label' => 'All Topics', 'url' => ['/topics/index']],
                    ['label' => 'All Countries', 'url' => ['/countries/index']],
                    ['label' => 'All Sessions', 'url' => ['/sessions/index']],
                    ['label' => 'Logs', 'url' => ['/audits/index']],
                    ['label' => 'My Account', 'url' => ['/user/settings/account']],
                    ]],
                ];
                if(Yii::$app->user->identity->getIsAdmin()){
                    $menu_items[] = ['label' => 'Users',
                    'url' => ['/user/admin']];
                }
                $menu_items[]= ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']];
            }
            NavBar::begin([
                'brandLabel' => 'UNA Database',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menu_items,
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <a href="mailto:binay.devkota@gmail.com">Binay Devkota</a> <?= date('Y') ?> | <a href="<?php echo Yii::$app->urlManager->createUrl('/site/about'); ?>">About</a> | <a href="<?php echo Yii::$app->urlManager->createUrl('/site/contact'); ?>">Contact us</a></p>
            <p class="pull-right">Made for FORUM-ASIA, by Binay Devkota. <?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
