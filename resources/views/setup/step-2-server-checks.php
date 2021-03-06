<?php use Fisharebest\Webtrees\Html; ?>
<?php use Fisharebest\Webtrees\I18N; ?>

<form method="POST" autocomplete="off">
	<input name="route" type="hidden" value="setup">
	<input name="lang" type="hidden" value="<?= Html::escape($lang) ?>">
	<input name="dbhost" type="hidden" value="<?= Html::escape($dbhost) ?>">
	<input name="dbport" type="hidden" value="<?= Html::escape($dbport) ?>">
	<input name="dbuser" type="hidden" value="<?= Html::escape($dbuser) ?>">
	<input name="dbpass" type="hidden" value="<?= Html::escape($dbpass) ?>">
	<input name="dbname" type="hidden" value="<?= Html::escape($dbname) ?>">
	<input name="tblpfx" type="hidden" value="<?= Html::escape($tblpfx) ?>">
	<input name="wtname" type="hidden" value="<?= Html::escape($wtname) ?>">
	<input name="wtuser" type="hidden" value="<?= Html::escape($wtuser) ?>">
	<input name="wtpass" type="hidden" value="<?= Html::escape($wtpass) ?>">
	<input name="wtemail" type="hidden" value="<?= Html::escape($wtemail) ?>">

	<h2><?= I18N::translate('Checking server configuration') ?></h2>

	<?php foreach ($errors as $error): ?>
		<p class="alert alert-danger"><?= $error ?></p>
	<?php endforeach ?>

	<?php foreach ($warnings as $warning): ?>
		<p class="alert alert-warning"><?= $warning ?></p>
	<?php endforeach ?>

	<?php if (empty($errors) && empty($warnings)): ?>
		<p>
			<?= I18N::translate('The server configuration is OK.') ?>
		</p>
	<?php endif ?>

	<h2><?= I18N::translate('Checking server capacity') ?></h2>

	<p>
		<?= I18N::translate('The memory and CPU time requirements depend on the number of individuals in your family tree.') ?>
	</p>
	<p>
		<?= I18N::translate('The following list shows typical requirements.') ?>
	</p>
	<p>
		<?= I18N::translate('Small systems (500 individuals): 16–32 MB, 10–20 seconds') ?>
		<br>
		<?= I18N::translate('Medium systems (5,000 individuals): 32–64 MB, 20–40 seconds') ?>
		<br>
		<?= I18N::translate('Large systems (50,000 individuals): 64–128 MB, 40–80 seconds') ?>
	</p>

	<p class="alert alert-<?= $memory_limit < 32 || $cpu_limit > 0 && $cpu_limit < 20 ? 'danger' : 'success' ?>">
		<?= I18N::translate('This server’s memory limit is %s MB and its CPU time limit is %s seconds.', I18N::number($memory_limit), I18N::number($cpu_limit)) ?>
	</p>

	<p>
		<?= I18N::translate('If you try to exceed these limits, you may experience server time-outs and blank pages.') ?>
	</p>

	<p>
		<?= I18N::translate('If your server’s security policy permits it, you will be able to request increased memory or CPU time using the webtrees administration page. Otherwise, you will need to contact your server’s administrator.') ?>
	</p>

	<hr>

	<button class="btn btn-primary" name="step" type="submit" value="3">
		<?= I18N::translate('next') ?>
	</button>

	<button class="btn btn-link" name="step" type="submit" value="1">
		<?= I18N::translate('previous') ?>
	</button>
</form>
