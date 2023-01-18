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
<?php
  if ($theme->desc_allowbbcode):
    $_description = $theme->bb2html($item->description, 1);
  else:
    $_description = nl2br(html::purify($item->description));
  endif;

  if ($theme->is_photometa_visible):
    $_description .= '<ul class="g-metadata">' . $theme->thumb_info($item) . '</ul>';
  endif;

  switch ($theme->photo_popupbox):
    case "preview":
      $include_list = FALSE;
      $include_single = TRUE;
      break;
    case "none":
      $include_list = FALSE;
      $include_single = FALSE;
      break;
    default:
      $include_list = TRUE;
      $include_single = TRUE;
      break;
  endswitch;
?>  

<div id="g-item">
  <?php $_title = $theme->get_item_title($item, TRUE); ?>
  <div id="g-info">
    <h1><?php echo $_title ?></h1>
  </div>
  <?php echo $theme->add_paginator("top", FALSE); ?>
  <?php echo $theme->photo_top() ?>
  <?php if (($theme->photo_descmode == "top") and ($_description)): ?>
    <div id="g-info"><div class="g-description"><?php echo $_description ?></div></div>
  <?php endif; ?>
  <div id="g-photo">
    <?php echo $theme->resize_top($item) ?>
    <?php $_resizewidth = $item->resize_width;
       if (isset($theme->dynamic_siblings)) {
         $siblings = $theme->dynamic_siblings;
       } else {
         $siblings = $item->parent()->children(); 
       }
    ?>
    <div class="g-resize" style="margin-left: -<?php echo intval($_resizewidth / 2); ?>px; ">
    <?php $script  = "<script type=\"text/javascript\">\n";
       $script .= "$(document).ready(function() {\n";
       $script .= "  if (document.images) {\n";
       for ($i = 0; ($i <= count($siblings) - 1); $i++):
         if ($siblings[$i]->rand_key == $item->rand_key): ?>
           <a style="<?php echo ($siblings[$i]->rand_key == $item->rand_key)? "display: static;" : "display: none;"; ?>" title="<?php echo $theme->get_item_title($item); ?>" <?php echo ($include_single)? "class=\"g-sb-preview\"" : "target=_blank;"; ?> <?php echo ($include_list)? "rel=\"g-preview\"" : null; ?> href="<?php echo (access::can("view_full", $item))? $item->file_url() : $item->resize_url(); ?>">
           <?php echo $item->resize_img(array("id" => "g-item-id-{$item->id}", "class" => "g-resize", "alt" => $_title)) ?>
           </a>
      <?php  if (($i < count($siblings) - 1) && (!$siblings[$i+1]->is_album())):
            $script  .= "    var image_preload_n = new Image();\n    image_preload_n.src = \"" . $siblings[$i+1]->resize_url() . "\";\n"; 
          endif;
          if (($i > 0) && (!$siblings[$i-1]->is_album())):
            $script  .= "    var image_preload_p = new Image();\n    image_preload_p.src = \"" . $siblings[$i-1]->resize_url() . "\";\n"; 
          endif;
        else:
        if ($include_list): ?>
          <?php if (!$siblings[$i]->is_album()): ?>
          <a title="<?php echo $theme->get_item_title($siblings[$i]); ?>" class="g-sb-preview g-hide" rel="g-preview" href="<?php echo (access::can("view_full", $siblings[$i]))? $siblings[$i]->file_url() : $siblings[$i]->resize_url(); ?>">&nbsp;</a>
          <?php endif; ?>  
        <?php endif; ?>
      <?php endif; ?>
    <?php endfor; ?>
    <?php $script  .= "  }\n});\n</script>\n"; ?>
    <?php $_align = "";
       $_more = FALSE;
       if ($_description):
         switch ($theme->photo_descmode):
           case "overlay_top":
             $_align = "g-align-top";
             $_more = TRUE;
             break;
           case "overlay_bottom":
             $_align = "g-align-bottom";
             $_more = TRUE;
             break;
           case "overlay_top_s":
             $_align = "g-align-top g-align-static";
             break;
           case "overlay_bottom_s":
             $_align = "g-align-bottom g-align-static";
             break;
           default:
             break;
         endswitch;
       endif; ?>
  <?php  if ($_align): ?>
    <?php  if ($_more): ?>
      <span class="g-more <?php echo $_align ?>"><?php echo t("More") ?></span>
    <?php endif ?>
      <div class="g-description <?php echo $_align; ?>" style="width: <?php echo $_resizewidth - 20; ?>px;" >
        <strong><?php echo $_title ?></strong>
        <?php echo $_description ?>
      </div>
    <?php endif ?>
    </div>
    <?php echo $theme->resize_bottom($item) ?>
  </div>
  <?php if (($theme->photo_descmode == "bottom") and ($_description)): ?>
    <div id="g-info"><div class="g-description"><?php echo $_description ?></div></div>
  <?php endif; ?>
  <?php echo $theme->add_paginator("bottom", FALSE); ?>
  <?php echo $theme->photo_bottom() ?>
</div>
<?php echo $script ?>