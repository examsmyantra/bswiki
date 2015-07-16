<?php

/**
 * Skin file for BS Wiki
 *
 * @file
 * ingroup Skins
 * @author Mayank Tiwari, Rishav Chhajer, ExamsMyantra (https://www.examsmyantra.com)
 * @license Released under Open Source MIT for more on license read License.md under root directory
 */
//error_reporting( E_ALL );
class SkinBSWiki extends SkinTemplate {

    public $skinname = 'bswiki';
    public $stylename = 'BSWiki';
    public $template = 'BSWikiTemplate';
    public $useHeadElement = true;

    public function initPage(OutputPage $out) {
	global $wgStylePath;
	parent::initPage($out);
	$out->addHeadItem('metaview', '<meta name="viewport" content="width=device-width, initial-scale=1.0">'
	);

	$out->addModules('skins.bswiki.js');
    }

    function setupSkinUserCss(OutputPage $out) {
	parent::setupSkinUserCss($out);
	$out->addModuleStyles(array('mediawiki.skinning.interface', 'skins.bswiki.style'));
    }

    public function execute() {
	$this->html('headelement');
    }

}

/**
 * Base Template class for BS Wiki
 *
 * @ingroup Skins
 */
class BSWikiTemplate extends BaseTemplate {

    /**
     * Outputs the entire contents of the page
     */
    public function execute() {
	global $wgBSWfblink, $wgBSWgooglelink, $wgBSWtwitterlink, $wgBSWyoutubelink, $wgBSWemaillink;
	$this->html('headelement');
	?>
	<nav id="myNavbar" class="navbar navbar-default navbar-fixed-top" role="nevigation">
	    <div class="container-fluid">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarCollapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href']); ?>" <?php echo Xml::expandAttributes(Linker::tooltipAndAccessKeyAttribs('p-logo')) ?> >
			<img class="img-responsive" src="<?php $this->text('logopath'); ?>" alt="<?php $this->text('sitename'); ?>" />
		    </a>
		</div>
		<div class="collapse navbar-collapse" id="navbarCollapse">
		    <ul class="nav navbar-nav">
			<?php
			$count = 0;
			$actionMenuStart = <<<AMS
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span><span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
AMS;
			$actionMenuEnd = <<<AME
						</ul>
					</li>
AME;
			$actionMenuBody = "";
			foreach ($this->data['content_navigation'] as $category => $tabs) {
			    foreach ($tabs as $key => $tab) {
				if ($count > 4) {
				    $actionMenuBody.= $this->makeListItem($key, $tab);
				} else {
				    echo $this->makeListItem($key, $tab);
				}
				++$count;
			    }
			}
			echo $actionMenuStart . $actionMenuBody . $actionMenuEnd;
			?>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
			<?php if (isset($wgBSWfblink) && trim($wgBSWfblink) != "") { ?>
	    		<li><a href="<?php echo $wgBSWfblink; ?>" target="_blank" class="socicon facebook" title="like on facebook">b</a></li>
			<?php } ?>
			<?php if (isset($wgBSWtwitterlink) && trim($wgBSWtwitterlink) != "") { ?>
	    		<li><a href="<?php echo $wgBSWfblink; ?>" target="_blank" class="socicon twitter" title="Follow on twitter">a</a></li>
			<?php } ?>	
			<?php if (isset($wgBSWyoutubelink) && trim($wgBSWyoutubelink) != "") { ?>
	    		<li><a href="<?php echo $wgBSWfblink; ?>" target="_blank" class="socicon youtube" title="subscribe on youtube">r</a></li>
			<?php } ?>
			<?php if (isset($wgBSWgooglelink) && trim($wgBSWgooglelink) != "") { ?>
	    		<li><a href="<?php echo $wgBSWgooglelink; ?>" target="_blank" class="socicon google" title="follow on google plus">c</a></li>
			<?php } ?>
			<?php if (isset($wgBSWemaillink) && trim($wgBSWemaillink) != "") { ?>
	    		<li><a href="mailto:<?php echo $wgBSWemaillink; ?>" class="socicon email" title="Email us">@</a></li>
			<?php } ?>
			<li class="dropdown">
			    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><span class="caret"></span></a>
			    <ul class="dropdown-menu" role="menu">
				<?php
				foreach ($this->getPersonalTools() as $key => $item) {
				    echo $this->makeListItem($key, $item);
				}
				?>
			    </ul>
			</li>
		    </ul>
		</div>
	    </div>
	</nav>
	<div class="container">
	    <?php
	    if ($this->data['newtalk']) {
		?>
	        <div class="row">
	    	<div class="col-sm-12">
	    	    <div class="bg-info usermessage"><?php $this->html('newtalk'); ?></div>					
	    	</div>
	        </div>
		<?php
	    }
	    ?>
	    <?php
	    if ($this->data['sitenotice']) {
		?>
	        <div class="row">
	    	<div class="col-sm-12">
	    	    <div class="" id="siteNotice"><?php $this->html('sitenotice'); ?></div>					
	    	</div>
	        </div>
		<?php
	    }
	    ?>

	    <div class="row">

		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3" id="sidebar">
		    <div id="search-div">
			<form class="form-inline" role="form" action="<?php $this->text('wgScript'); ?>">
			    <div class="form-group">
				<div class="input-group">
				    <input type="hidden" name="title" value="<?php $this->text('searchtitle') ?>" />
				    <?php echo $this->makeSearchInput(array('class' => 'form-control')); ?>
				    <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
				</div>
			    </div>
			</form>
		    </div>

		    <?php
		    foreach ($this->getSidebar() as $boxName => $box) {
			?>
	    	    <div id="<?php echo Sanitizer::escapeId($box['id']) ?>"<?php echo Linker::tooltip($box['id']) ?>>
	    		<ul class="nav nav-pills nav-stacked left-margin-zero">
	    		    <li class="dropdown">
	    			<a class="side-menu-toggle" data-toggle="" onclick="" href="#"><?php echo htmlspecialchars($box['header']); ?></a>

				    <?php
				    if (is_array($box['content'])) {
					?>
					<ul class="nav-pills list-unstyled sub-side-menu" role="menu">
					    <?php
					    foreach ($box['content'] as $key => $item) {
						echo $this->makeListItem($key, $item);
					    }
					    ?>
					</ul>
					<?php
				    } else {
					echo $box['content'];
				    }
				    ?>
	    		    </li>
	    		</ul>
	    	    </div>
	    <?php
	}
	?>
		    <?php
		    if ($this->data['language_urls']) {
			?>
	    	    <ul class="nav nav-pills nav-stacked left-margin-zero">
	    		<li class="dropdown">
	    		    <a class="side-menu-toggle" data-toggle="" onclick="" href="#">Language</a>
	    		    <ul class="nav-pills list-unstyled sub-side-menu" role="menu">
	    <?php
	    foreach ($this->data['language_urls'] as $key => $langLink) {
		echo $this->makeListItem($key, $langLink);
	    }
	    ?>	
	    		    </ul>
	    		</li>
	    	    </ul>
	    <?php
	}
	?>
		</div>

		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-9" id="maincontent">
		    <h1 id="firstHeading" class="firstHeading"><?php $this->html('title'); ?></h1>
		    <hr/>
	<?php if ($this->data['subtitle']) { ?><h4 class="small" ><?php $this->html('subtitle'); ?></h4><?php } ?>
		    <?php if ($this->data['undelete']) { ?><h4 class="small" ><?php $this->html('undelete'); ?></h4><?php } ?>
		    <div id="bodyContent"><?php $this->html('bodytext'); ?></div>
		    <?php $this->html('catlinks'); ?>
		    <?php $this->html('dataAfterContent'); ?>
		</div>
	    </div>

	    <hr/>
	    <div class="row">
		<div class="col-sm-12 text-center">
		    <footer>
	<?php
	foreach ($this->getFooterIcons('icononly') as $blockName => $footerIcons) {
	    foreach ($footerIcons as $icon) {
		echo $this->getSkin()->makeFooterIcon($icon);
	    }
	}
	?>
			<a href="https://www.examsmyantra.com" title="Designed By ExamsMyantra" id="em-logo"></a>
		    </footer>
		</div>
	    </div>
	</div>	
	<a href="javascript:void(0);" id="top"><span class="glyphicon glyphicon-arrow-up"></span></a>
	<?php
	$this->printTrail();
	?>
	</body>
	</html>
	<?php
    }
}
?>