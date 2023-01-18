<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Grey Dragon Theme - a custom theme for Gallery 3
 * This theme was designed and built by Serguei Dosyukov, whose blog you will find at http://blog.dragonsoft.us
 * Copyright (C) 2009-2014 Serguei Dosyukov
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU General
 * Public License as published by the Free Software Foundation; either version 2 of the License, or (at your
 * option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write to
 * the Free Software Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
?>
<!DOCTYPE html >
<?php $theme->load_sessioninfo(); ?>
<html <?php echo $theme->html_attributes() ?> xml:lang="en" lang="en" <?php echo ($theme->is_rtl)? "dir=rtl" : null; ?> >
<?php
  $item = $theme->item();
  if (($theme->enable_pagecache) and (isset($item))):
    // Page will expire in 60 seconds
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 60).'GMT');  
    header("Cache-Control: public");
    header("Cache-Control: post-check=3600, pre-check=43200", false);
    header("Content-Type: text/html; charset=UTF-8");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  endif;
?>
<!-- <?php echo $theme->themename ?> v.<?php echo $theme->themeversion ?> (<?php echo $theme->colorpack ?> : <?php echo $theme->framepack ?>) - Copyright (c) 2009-2014 Serguei Dosyukov - All Rights Reserved -->
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<?php $theme->start_combining("script,css") ?>
<?php if ($page_title): ?>
<?php   $_title = $page_title ?> 
<?php else: ?>
<?php   if ($theme->item()): ?>
<?php     $_title = $theme->get_item_title($theme->item()); ?>
<?php   elseif ($theme->tag()): ?>
<?php     $_title = t("Photos tagged with %tag_title", array("tag_title" => $theme->bb2html($theme->tag()->name, 2))) ?>
<?php   else: /* Not an item, not a tag, no page_title specified.  Help! */ ?>
<?php     $_title = $theme->bb2html(item::root()->title, 2); ?>
<?php   endif ?>
<?php endif ?>
<title><?php echo $_title ?></title>
<meta name="title" content="<?php echo $_title ?>" /> 
<?php if ($theme->disable_seosupport): ?>
<meta name="robots" content="noindex, nofollow, noarchive" />
<meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet, noodp, noimageindex, notranslate" />
<meta name="slurp" content="noindex, nofollow, noarchive, nosnippet, noodp, noydir" />
<meta name="teoma" content="noindex, nofollow, noarchive" />
<?php endif; ?>

<!-- Internet Explorer 9 Meta tags : Start -->
<meta name="application-name" content="<?php echo $_title; ?>" />
<meta name="msapplication-tooltip" content="<?php echo t("Start"); ?> <?php echo $_title; ?>" />
<meta name="msapplication-starturl" content="<?php echo item::root()->url() ?>" />                                                     
<?php if ($theme->allow_root_page): ?>
<meta name="msapplication-task" content="name=<?php echo t("Gallery") ?>: <?php echo t("Root Page") ?>; action-uri=<?php echo item::root()->url(); ?><?php echo $theme->permalinks["root"]; ?>; icon-uri=favicon.ico" />
<meta name="msapplication-task" content="name=<?php echo t("Gallery") ?>: <?php echo t("Root Album") ?>; action-uri=<?php echo item::root()->url(); ?><?php echo $theme->permalinks["enter"]; ?>; icon-uri=favicon.ico" />
<?php else: ?>
<meta name="msapplication-task" content="name=<?php echo t("Gallery") ?>: <?php echo t("Root Album") ?>; action-uri=<?php echo item::root()->url(); ?>; icon-uri=favicon.ico" />
<?php endif; ?>
<?php if (identity::active_user()->admin): ?>
<meta name="msapplication-task-separator" content="gallery3-greydragon" />
<meta name="msapplication-task" content="name=<?php echo t("Admin") ?>: <?php echo t("Dashboard") ?>; action-uri=<?php echo url::site("admin"); ?>; icon-uri=favicon.ico" />
<?php endif; ?>
<!-- Internet Explorer 9 Meta tags : End -->
<link rel="shortcut icon" href="<?php echo $theme->favicon ?>" type="image/x-icon" />
<?php if ($theme->appletouchicon): ?>
<link rel="apple-touch-icon" href="<?php echo $theme->appletouchicon; ?>"/>
<?php endif; ?>

<?php echo $theme->script("jquery.min.js"); ?>
<?php echo $theme->script("jquery.json.min.js"); ?>
<?php echo $theme->script("jquery.form.custom.js"); ?>
<?php echo $theme->script("jquery-ui.min.js"); ?>

<?php echo $theme->script("gallery.common.js") ?>
<?php /* MSG_CANCEL is required by gallery.dialog.js */ ?>
<script type="text/javascript">
  var MSG_CANCEL = <?php echo t('Cancel')->for_js() ?>;
</script>

<?php echo $theme->script("gallery.ajax.custom.js") ?>
<?php echo $theme->script("gallery.dialog.custom.js"); ?>

<?php /* These are page specific but they get combined */ ?>
<?php if ($theme->page_subtype == "photo"): ?>
<?php echo  $theme->script("jquery.scrollTo.js"); ?>
<?php elseif ($theme->page_subtype == "movie"): ?>
<?php echo  $theme->script("flowplayer.js") ?>
<?php endif ?>

<?php echo $theme->head() ?>

<?php // Theme specific CSS/JS goes last so that it can override module CSS/JS ?>
<?php echo $theme->theme_js_inject(); ?>
<?php echo $theme->theme_css_inject(); ?>
<?php echo $theme->get_combined("css");          // LOOKING FOR YOUR CSS? It's all been combined into the link ?>
<?php echo $theme->custom_css_inject(TRUE); ?>
<?php echo $theme->get_combined("script")        // LOOKING FOR YOUR JAVASCRIPT? It's all been combined into the link ?>

<?php if ($theme->thumb_inpage): ?>
<style type="text/css"> 
  #g-column-bottom #g-thumbnav-block, #g-column-top #g-thumbnav-block { display: none; } 
<?php if (((!$user->guest) or ($theme->show_guest_menu)) and ($theme->mainmenu_position == "bar")): ?>
  html { margin-top: 30px !important; }
<?php endif; ?>
</style>
<?php endif; ?>
</head>
<?php if ($theme->item()):
     $item = $theme->item();
   else:
     $item = item::root();
   endif; ?>
<body <?php echo $theme->body_attributes() ?><?php echo ($theme->show_root_page)? ' id="g-rootpage"' : null; ?> <?php echo $theme->get_bodyclass(); ?>>
<?php echo $theme->page_top() ?>                               
<?php echo $theme->site_status() ?>
<?php if (((!$user->guest) or ($theme->show_guest_menu)) and ($theme->mainmenu_position == "bar")): ?>
  <div id="g-site-menu" class="g-<?php echo $theme->mainmenu_position; ?>">
  <?php echo $theme->site_menu($theme->item() ? "#g-item-id-{$theme->item()->id}" : "") ?>
  </div>
<?php endif; ?>
<div id="g-header">
<?php echo $theme->header_top() ?>
<?php if ($theme->viewmode != "mini"): ?>
<?php   if ($header_text = module::get_var("gallery", "header_text")): ?>
<span id="g-header-text"><?php echo  $theme->bb2html($header_text, 1) ?></span>
<?php   else: ?>                                                                         
  <a id="g-logo" href="<?php echo item::root()->url() ?><?php echo ($theme->allow_root_page)? $theme->permalinks["root"] : null; ?>" title="<?php echo t("go back to the Gallery home")->for_html_attr() ?>">
    <img alt="<?php echo t("Gallery logo: Your photos on your web site")->for_html_attr() ?>" src="<?php echo $theme->logopath ?>" />
  </a>
<?php   endif; ?>
<?php endif; ?>
<?php if (((!$user->guest) or ($theme->show_guest_menu)) and ($theme->mainmenu_position != "bar")): ?>
  <div id="g-site-menu" class="g-<?php echo $theme->mainmenu_position; ?>">
  <?php echo $theme->site_menu($theme->item() ? "#g-item-id-{$theme->item()->id}" : "") ?>
  </div>
<?php endif ?>

<?php echo $theme->messages() ?>
<?php echo $theme->header_bottom() ?>

<?php if ($theme->loginmenu_position == "header"): ?>
<?php echo  $theme->user_menu() ?>
<?php endif; ?>
<?php if (empty($breadcrumbs)): ?>
<?php echo $theme->breadcrumb_menu(null); ?>
<?php else: ?>
<?php echo $theme->breadcrumb_menu($breadcrumbs); ?>
<?php endif; ?>
<?php echo $theme->custom_header(); ?>
</div>
<?php if (($theme->page_subtype != "login") and ($theme->page_subtype != "reauthenticate") and ($theme->sidebarvisible == "top")): ?>
<div id="g-column-top">
  <?php echo new View("sidebar.html") ?>
</div>
<?php endif; ?>
<div id="g-main">
  <div id="g-main-in">
<?php  if (!$theme->show_root_page): ?>
    <?php echo $theme->sidebar_menu($item->url()) ?>
    <div id="g-view-menu" class="g-buttonset<?php echo ($theme->sidebarallowed != "any")? " g-buttonset-shift" : null; ?>">
<?php    if ($page_subtype == "album"): ?>
      <?php echo $theme->album_menu() ?>
<?php    elseif ($page_subtype == "photo") : ?>
      <?php echo $theme->photo_menu() ?>
<?php    elseif ($page_subtype == "movie") : ?>
      <?php echo $theme->movie_menu() ?>
<?php    elseif ($page_subtype == "tag") : ?>
      <?php echo $theme->tag_menu() ?>
<?php    endif ?>
    </div>
<?php  endif; ?>
<?php switch ($theme->sidebarvisible):
     case "left":
       echo '<div id="g-column-left">';
       $closediv = TRUE;
       break;
     case "none":
     case "top":
     case "bottom":
       if (($theme->thumb_inpage) and ($page_subtype == "photo")):
         echo '<div id="g-column-right">';
         $closediv = TRUE;
       else:
         $closediv = FALSE;
       endif;
       break;
     default:
       echo '<div id="g-column-right">';
       $closediv = TRUE;
       break;
   endswitch; ?>
<?php if (($theme->page_subtype != "login") && ($theme->page_subtype != "reauthenticate")): ?>
<?php   if (($theme->sidebarvisible == "none") || ($theme->sidebarvisible == "bottom") || ($theme->sidebarvisible == "top")): ?>
<?php     if (($theme->thumb_inpage) and ($page_subtype == "photo")): ?>
<?php echo      '<div class="g-toolbar"><h1>&nbsp;</h1></div>'; ?>
<?php echo      $theme->get_block_html("thumbnav"); ?>
<?php     endif; ?>
<?php   else: ?>
<?php echo    new View("sidebar.html") ?>
<?php   endif; ?>
<?php endif ?>
<?php echo ($closediv)? "</div>" : null; ?>

<?php switch ($theme->sidebarvisible):
     case "left":
       echo '<div id="g-column-centerright">';
       break;
     case "none":
     case "top":
     case "bottom":
       if (($theme->thumb_inpage) and ($page_subtype == "photo")):
         echo '<div id="g-column-centerleft">';
       else:
         echo '<div id="g-column-centerfull">';
       endif;
       break;
     default:
       echo '<div id="g-column-centerleft">';
       break;
   endswitch;

   if ($theme->show_root_page):
     echo new View("rootpage.html");
   else:
     echo $content;
   endif; ?>
    </div> 
  </div>
</div>
<?php if (($theme->page_subtype != "login") and ($theme->page_subtype != "reauthenticate") and ($theme->sidebarvisible == "bottom")): ?>
<div id="g-column-bottom">
  <?php echo new View("sidebar.html") ?>
</div>
<?php endif; ?>
<div id="g-footer">
<?php if ($theme->viewmode != "mini"): ?>
<?php echo  $theme->footer() ?>
<?php   if ($footer_text = module::get_var("gallery", "footer_text")): ?>
<span id="g-footer-text"><?php echo  $theme->bb2html($footer_text, 1) ?></span>
<?php   endif ?>
  <?php echo $theme->credits() ?>
  <ul id="g-footer-rightside"><li><?php echo $theme->copyright ?></li></ul>
<?php   if ($theme->loginmenu_position == "default"): ?>
  <?php echo $theme->user_menu() ?>
<?php   endif; ?>
<?php endif; ?>
<?php echo $theme->custom_footer(); ?>
</div>
<?php echo $theme->page_bottom() ?>
</body>
</html>
