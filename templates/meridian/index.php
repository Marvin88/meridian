<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Output as HTML5
$doc->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/bootstrap.js');
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/common.js');
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/jquery.mCustomScrollbar.min.js');
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/parallax.js');
$doc->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/template.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/style.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/parallax-styles.css');
$doc->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/jquery.mCustomScrollbar.css');

// Use of Google Font
if ($this->params->get('googleFont'))
{
	$doc->addStyleSheet('//fonts.googleapis.com/css?family=' . $this->params->get('googleFontName'));
	$doc->addStyleDeclaration("
	h1, h2, h3, h4, h5, h6, .site-title {
		font-family: '" . str_replace('+', ' ', $this->params->get('googleFontName')) . "', sans-serif;
	}");
}

// Template color
if ($this->params->get('templateColor'))
{
	$doc->addStyleDeclaration("
	body.site {
		border-top: 3px solid " . $this->params->get('templateColor') . ";
		background-color: " . $this->params->get('templateBackgroundColor') . ";
	}
	a {
		color: " . $this->params->get('templateColor') . ";
	}
	.nav-list > .active > a,
	.nav-list > .active > a:hover,
	.dropdown-menu li > a:hover,
	.dropdown-menu .active > a,
	.dropdown-menu .active > a:hover,
	.nav-pills > .active > a,
	.nav-pills > .active > a:hover,
	.btn-primary {
		background: " . $this->params->get('templateColor') . ";
	}");
}

// Check for a custom CSS file
$userCss = JPATH_SITE . '/templates/' . $this->template . '/css/user.css';

if (file_exists($userCss) && filesize($userCss) > 0)
{
	$this->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/css/user.css');
}

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
	<script src="/templates/meridian/js/jquery-3.1.0.min.js"></script>
	<jdoc:include type="head" />
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<!--body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '');
	echo ($this->direction == 'rtl' ? ' rtl' : '');
?>"-->
<body>
    <div class="windowHeight"></div>
<script>
    (function($){
        $(window).on("load",function(){
            $(".hello-text").mCustomScrollbar({
                 axis:"y",
                theme:"rounded-dark",
            });
            var scene = document.getElementById('scene');
	        var parallax = new Parallax(scene);
            $('.header-block-wrapper-js').height($('.header-block').outerHeight());
        });
        $(document).on('scroll', function(){
            scrollNow= window.pageYOffset;
            if(scrollNow>0){
                $('.header-block').addClass('fixed-top-block');
                $('.my-dropdown-menu').css('top', '67px');
            }
            else{
                $('.header-block').removeClass('fixed-top-block');
                $('.my-dropdown-menu').css('top', '76px');
            }
        });
    })(jQuery);
</script>
	<!-- Body -->
	<div class="container-fluid">
		<!--div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>"-->
			<!-- Header -->
			<div class="header-block-wrapper-js" role="banner">
				<div class="row header-block" id="inner-menu">
					<div class="col-lg-3 col-xs-7">
					    <a href="<?php echo $this->baseurl; ?>/">
						    <?php echo $logo; ?>
						    <?php if ($this->params->get('sitedescription')) : ?>
							    <?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
						    <?php endif; ?>
					    </a>
					</div>
					<div class="col-lg-4 col-lg-offset-3 hidden-xs">
                        <div class="row header-phones">
                            <div class="col-lg-6">
                                <a href="#">8 (812) 232 65 29</a>
                            </div>
                            <div class="col-lg-6">
                                <a href="#">+7 (921) 437 63 97 </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-xs-5">
					    <div class="row">
					        <div class="col-lg-10 col-lg-offset-2  menu menu-js">
						        <jdoc:include type="modules" name="position-0" style="xhtml" />
						    </div>
					    </div>
					</div>
				</div>
			</div>
			<?php if ($this->countModules('position-1')) : ?>
				<nav class="navigation" role="navigation">
					<div class="navbar pull-left">
						<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
					</div>
					<div class="nav-collapse">
						<jdoc:include type="modules" name="position-1" style="none" />
					</div>
				</nav>
			<?php endif; ?>
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
				<?php if ($this->countModules('position-8')) : ?>
					<!-- Begin Sidebar -->
					<div id="sidebar" class="span3">
						<div class="sidebar-nav">
							<jdoc:include type="modules" name="position-8" style="xhtml" />
						</div>
					</div>
					<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span; ?>">
					<!-- Begin Content -->
					<jdoc:include type="modules" name="position-3" style="xhtml" />
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<jdoc:include type="modules" name="position-2" style="none" />
					<!-- End Content -->
				</main>
				<?php if ($this->countModules('position-7')) : ?>
					<div id="aside" class="span3">
						<!-- Begin Right Sidebar -->
						<jdoc:include type="modules" name="position-7" style="well" />
						<!-- End Right Sidebar -->
					</div>
				<?php endif; ?>
			</div>
		<!--/div-->
        <!-- Footer -->
	    <div class="row footer" role="contentinfo">
		    <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			    <hr />
			    <jdoc:include type="modules" name="footer" style="none" />
			    <p class="pull-right">
				    <a href="#" id="back-top">
					    <?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
				    </a>
			    </p>
			    <p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			    </p>
		    </div>
	    </div>
	</div>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
