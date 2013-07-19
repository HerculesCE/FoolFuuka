<?php
namespace Foolz\Foolfuuka\Theme\Foolfuukatwo\Layout;

use Foolz\Foolfuuka\Theme\Foolfuukatwo\View;

class Chan extends View {

    public function toString() {
    ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en" ><!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <meta name="generator" content="<?= \Foolz\Foolframe\Model\Config::get('foolz/foolfuuka', 'package', 'main.name')
        .' '.\Config::get('foolz/foolfuuka', 'package', 'main.version') ?>"/>
    <meta name="viewport" content="width=device-width" />
    <title><?= $this->getBuilder()->getProps()->getTitle(); ?></title>
    <link href="<?= $this->getUriForPath('/') ?>" rel="index" title=""<?= \Preferences::get('foolframe.gen.website_title') ?>"/>
    <link rel="stylesheet" href="<?= $this->getAssetManager()->getAssetLink('style.css') ?>" />
    <script src="<?= $this->getAssetManager()->getAssetLink('js/vendor/custom.modernizr.js') ?>"></script>
</head>
<body>

    <nav class="top-bar">
        <section class="top-bar-section">
            <ul class="left">
                <li class="has-dropdown"><a href="<?= $this->getBaseUrl() ?>"><?= ($this->getRadix()) ? '/'.$this->getRadix()->shortname.'/ - '.$this->getRadix()->name : \Preferences::get('foolframe.gen.website_title') ?></a>
                    <ul class="dropdown">
                        <li><a href="<?= $this->getUriForPath('/') ?>"><?= _i('Index') ?></a></li>
                        <?php if (\Auth::has_access('maccess.mod')) : ?>
                        <li><a href="<?= $this->getUriForPath('admin') ?>"><?= _i('Control Panel') ?></a></li>
                        <?php endif; ?>
                        <?php if (\Radix::getArchives()) : ?>
                        <li class="divider"></li>
                        <li><label><?= _i('Archives') ?></label></li>
                        <?php foreach (\Radix::getArchives() as $board) : ?>
                        <li><a href="<?= $board->getValue('href') ?>">/<?= $board->shortname ?>/ - <?= $board->name ?></a></li>
                        <?php endforeach; endif; ?>
                        <?php if (\Radix::getBoards()) : ?>
                        <li class="divider"></li>
                        <li><label><?= _i('Boards') ?></label></li>
                        <?php foreach (\Radix::getBoards() as $board) : ?>
                        <li><a href="<?= $board->getValue('href') ?>">/<?= $board->shortname ?>/ - <?= $board->name ?></a></li>
                        <?php endforeach; endif; ?>
                    </ul>
                </li>
                <?php if ($this->getRadix()) : ?>
                <li class="divider"></li>
                <li class="has-dropdown"><a href="<?= $this->getRadixUri() ?>"><?= _i('Index') ?></a>
                    <ul class="dropdown">
                        <li><a href="<?= $this->getRadixUri(['page_mode', 'by_post']) ?>"><?= _i('By latest post') ?></a></li>
                        <li><a href="<?= $this->getRadixUri(['page_mode', 'by_thread']) ?>"><?= _i('By latest thread') ?></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li><a href="<?= $this->getRadixUri('ghost') ?>"><?= _i('Ghost') ?></a></li>
                <li class="divider"></li>
                <li><a href="<?= $this->getRadixUri('gallery') ?>"><?= _i('Gallery') ?></a></li>
                <?php endif; ?>
            </ul>

            <ul class="right">
                <li class="has-form">
                    <form>
                        <div class="row collapse">
                            <div class="small-8 columns">
                                <input type="text">
                            </div>
                            <div class="small-4 columns">
                                <a href="#" class="button">Search</a>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </section>
    </nav>

    <div class="main">
        <?= $this->getBuilder()->getPartial('body')->build() ?>
    </div>

    <script>
        document.write('<script src=' +
        ('__proto__' in {} ? '<?= $this->getAssetManager()->getAssetLink('js/vendor/zepto.js') ?>'
            : '<?= $this->getAssetManager()->getAssetLink('js/vendor/jquery.js') ?>') +
        '><\/script>')
    </script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.alerts.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.clearing.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.cookie.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.dropdown.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.forms.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.interchange.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.joyride.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.magellan.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.orbit.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.placeholder.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.reveal.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.section.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.tooltips.js') ?>"></script>
    <script src="<?= $this->getAssetManager()->getAssetLink('js/foundation/foundation.topbar.js') ?>"></script>
    <script>
        $(document).foundation();
    </script>
</body>
</html>
    <?php
    }
}