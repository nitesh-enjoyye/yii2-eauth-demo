<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\VarDumper;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
app\config\AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php echo Yii::$app->charset; ?>"/>
	<title><?php echo Html::encode($this->title); ?></title>
	<?php $this->head(); ?>
</head>
<body>
  <?php $this->beginBody(); ?>

  <a href="https://github.com/Nodge/yii2-eauth" target="_blank">
	<img style="position: absolute; top: 50px; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png" alt="Fork me on GitHub" />
  </a>

  <?php
	NavBar::begin(array(
		'brandLabel' => Yii::$app->name,
		'brandUrl' => Yii::$app->homeUrl,
		'options' => array(
			'class' => 'navbar-inverse navbar-fixed-top',
		),
	));
	echo Nav::widget(array(
		'options' => array('class' => 'navbar-nav pull-right'),
		'items' => array(
			array('label' => 'Home', 'url' => array('/site/index')),
			Yii::$app->user->isGuest ?
				array('label' => 'Login', 'url' => array('/site/login')) :
				array('label' => 'Logout (' . Yii::$app->user->identity->username .')' , 'url' => array('/site/logout')),
		),
	));
	NavBar::end();

	$identity = Yii::$app->getUser()->getIdentity();
	if (isset($identity->profile)) {
		echo '<div class="container">';
		echo '<strong>EAuth profile:</strong><br/>';
		VarDumper::dump($identity->profile, 10, true);
		echo '</div>';
  	}
  ?>

  <div class="container">
	<?php echo Breadcrumbs::widget(array(
		  'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : array(),
	)); ?>
	<?php echo $content; ?>
  </div>

  <footer class="footer">
	<div class="container">
	   <p class="pull-left">&copy; My Company <?php echo date('Y'); ?></p>
	    <p class="pull-right"><?php echo Yii::powered(); ?></p>
	</div>
  </footer>

  <?php
  	if (file_exists(__DIR__.'/_main_analytics.php')) {
		require '_main_analytics.php';
	}
  ?>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
