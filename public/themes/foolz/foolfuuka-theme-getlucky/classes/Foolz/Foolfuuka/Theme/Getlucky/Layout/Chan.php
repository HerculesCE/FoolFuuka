<?php

namespace Foolz\Foolfuuka\Theme\Getlucky\Layout;

class Chan extends \Foolz\Theme\View
{
	public function toString()
	{
		header('X-UA-Compatible: IE=edge,chrome=1');
		header('imagetoolbar: false');

		$this->getHeader();
		$this->getNav();
		$this->getContent();
		$this->getFooter();
	}

	/**
	 * The header of the page
	 */
	public function getHeader()
	{
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= htmlspecialchars($this->getBuilder()->getProps()->getTitle()) ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?= $this->getAssetManager()->getAssetLink('style.css') ?>" rel="stylesheet" media="screen">
	</head>
	<body>
<?php
	}

	/**
	 * The footer of the page
	 */
	public function getFooter()
	{
?>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="<?= $this->getAssetManager()->getAssetLink('bootstrap/js/bootstrap.min.js') ?>"></script>
	</body>
</html>
<?php
	}

	public function getNav()
	{
?>

			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container-fluid" style="0 20px">
						<a class="brand" href="#"><?= htmlspecialchars($this->getBuilder()->getProps()->getTitle()) ?></a>
						<ul class="nav">
							<li class="active"><a href="#">Home</a></li>
							<li><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
						</ul>
						<form class="navbar-search pull-right">
							<input type="text" class="search-query" placeholder="Global Search">
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="alert alert-error">
				We have some important news regarding the /v/ and /vg/ archive hosted on Foolz Archive. For more information, please read >>>/foolz/509388.
			</div>
		</div>
<?php
	}

	public function getContent()
	{
?>
		<div class="container-fluid">
			<ul class="nav nav-tabs" style="margin-bottom: -1px">
				<li class="active">
					<a href="#">/a/</a>
				</li>
				<li><a href="#">/b/</a></li>
				<li><a href="#">/c/</a></li>

				<li class="pull-right"><a href="#">/dev/</a></li>
				<li class="pull-right"><a href="#">/foolz/</a></li>
				<li class="pull-right">
					<a href="#">/kuku/</a>
				</li>
			</ul>

			<div class="container-fluid content-body">
				<div class="navbar" style="margin-top: 10px">
					<div class="navbar-inner">
						<a class="brand" href="#">/a/ - Animu and Mango</a>
						<ul class="nav">
							<li class="active"><a href="#">Index</a></li>
							<li><a href="#">Stats</a></li>
							<li><a href="#">Link</a></li>
						</ul>
						<form class="navbar-search pull-right">
							<input type="text" class="search-query" placeholder="Search on /a/">
						</form>
					</div>
				</div>

				<?= $this->getBuilder()->getPartial('body')->build(); ?>

			</div>
		</div>
<?php
	}
}