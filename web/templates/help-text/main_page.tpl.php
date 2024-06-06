<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>BTS help text template</title>
<style type="text/css">
<!--
body, html {
	margin: 0;
	padding: 0;
} 
i {
	color: #339;
	font-weight: bold;
	}
#wrapper {
width: 780px;
border: 4px groove red;
padding: 1em;
margin: auto;
	}
h3 {
color: green;	
}

div.infoBoxFL {
background: silver;
border: 0px solid black;
border-width: 1px;
position: relative;
margin: 1px auto;
width: 150px;
}
.infoBoxHeadingFL, .infoBoxHeading{
background: #c33;
padding: 5px;
font-weight: bold;
color: white;
}
.infoBoxHeadingFL {
border-bottom: 1px solid #000080;
}
.infoBoxContentsFL {
	 padding: 2px;
	 text-align: center;
 }
-->
</style>
</head>
<body>
<?php
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
?>
<div id="wrapper">
<h1>BTS help v1.1</h1>
<h3>This help text is WIP (work in progress), I hope to be able to update soon.</h3> 

<h4>Released under the GNU General Public License</h4>

<h3>Introduction</h3>

<p>First read the included instructions and readme's!</p>
<h4>Backup your files and database before usage, and use this contribution at your own risk!</h4>
<p>So if you continue I assume you've read the included readme's, and know what you're doing :-) </p>

<h3>Usage</h3>
<h4>Settings</h4>
<p>There should be some new settings in admin after installing. Just look into your admin configuration under "My Store" (somewhere at the bottom probably).
There is one setting to choose the default template to load, of course you need to fill in an existing template name here.
Valid template names are the names of the template directories inside catalog/templates (only alfanumeric names are allowed, and -'s and _'s, template names starting with an underscore are "secrect" (not protected, hidden only) and will not be shown in the top menu).
</p>
<h4>Templating</h4>
<p>The idea is very simple, but nevertheless it's far too much to explain it all in this document, I'l try to write a (very) short inroduction though.</p>
<p>All operations below are done inside the new <i>templates</i> directory.</p>
<p>To make changes to the main layout, edit <i>templates/your_template_dir/main_page.tpl.php</i> (you may set "your_template_dir" in admin as default template).
The files inside the <i>content/</i> (<i>templates/your_template_dir/content/</i>) directory are the templates for each page (the middle "content").
</p>
<p>For most changes only editting <i>templates/your_template_dir/main_page.tpl.php</i>, the stylesheet and may be box.tpl.php will do the job. Of course you might need to to add some images for your template too.
<h5>Using individual box templates (=optional)</h5>
<p>By default the small sideboxes use the box.tpl.php template (in the current your_template_dir/boxes/ directory).</p>
<p>The categories box uses box.tpl.php as template for example:</p>
<?php 
  require(bts_select(boxes_original, 'categories.php'));
?>
<p>It's also possible to use different templates for the small sideboxes (not for any other boxes): just add a file to the <i>templates/your_template_dir/boxes/</i> directory having the simular name as the box you need the template for (i.e. manufacturers.tpl.php, named after the <i>inlcudes/boxes/manufacturers.php</i> file) and a unique template for the box is already created.
Take a look at the contents of <i>/your_template_dir/boxes/box.tpl.php</i>, if you want to have an idea what you could/should put inside your new box template file.</p>
<p>The box below, does not use box.tpl.php as template, but uses a stripped down box template called manufacturers.tpl.php instead:</p>
<?php  
  require(bts_select(boxes_original, 'manufacturers.php'));
?>
<h3>Compatibility notes</h3>
<p>Adding admin contributions to your shop should be no problem at all, just the same as without the BTS, the BTS does not change any admin files or features.</p>
<p>Adding catalog contributions certainly becomes a bit tricky sometimes, mainly because the changes to make to the files have to be made to other files now.
Allmost all code is the same, with or without the BTS (but not all), but de PHP js and HTML are better separated. So if a contribution tells you to edit a file, it depends on the code you need to edit what file you should edit. If you need to edit <i>product_reviews_write.php</i> for example, it's possible that the changes have to be applied to <i>catalog/reviews.php</i> or <i>templates/your_template_dir/content/product_reviews_write.tpl.php</i>, or even <i>includes/javascript/product_reviews_write.js</i></p>
<p>The problem is not really with the template structure itself, but just that contributions aren't written for it.</p>
<p>The the BTS has a more or less MS3 alike template structure, so switching to MS3 may become a little easyer for BTS users. But since I have no way of knowing how the MS3 template structure will finally be, it's more guessing than knowing, so don't blame me if I guessed wrong.</p>
<h4>Note: this version is still to be used on 2.2MS only! Most of it should become obsolete after MS3 will be reased.</h4>
<hr>
<br />     

<h3>Some features</h3>
<p>"old" feature list, I hope it's still correct</p>
<ul>
<li>change the main looks of your shop by editting only some template files and the stylsheet
(mainly "main_page.tlp.php" for the main looks and "box.tpl.php" for all "small info boxes")</li>
<li>easyly (automaticly) create individual smal box tempates if you like<br />
For example take "box.tpl.php" and save it as "shopping_cart.tpl.php"
(in the "templates/.../boxes/" directory)
No further installation needed, edit "shopping_cart.tpl.php" to see it work.
(box.tpl.php still controls all other small infoboxes)</li>

<li>All small infoboxes have their own css id assigned,
so even without separate templates you can make individual boxes look different through the stylesheet.</li>

<li>Switch templates through admin
(admin::configuration::my store 'Default Template Directory' and 'Template Switching' Allowed)
and/or switch by URL.
"Secretly" work on a new template and show it to everyone you like without the need of a separate install,
and without bothering your customers.
When you decide it's ready, switch in admin, to show it to the world.</li>

<li>Use php code in the templates if you like (that's one of the main differences to the STS I think)</li>

<li>dynamic meta tags and page titles ("includes/meta_tags.php")</li>

<li> and more ....</li>
</ul>
<p>One last note (is somebody still reading this?):
The incuded templates are not ment to be used as they are! And they are not designed for great looks either. They are just examples/tests, you can use it to start creating your own template,
it might save you some time crawling through the many tables the standard osC template uses.
</p>

<p>That's all for now, I hope you like it!</p>

<p>Paul Mathot :: PandA.nl</p>
</div><!-- end #wrapper -->
</body>
</html>