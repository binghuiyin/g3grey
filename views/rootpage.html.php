<?php defined("SYSPATH") or die("No direct script access.");
/**
 * G3 Grey Theme - a custom theme for Gallery 3
 * This theme is designed and built by David Yin, https://www.yinfor.com
 * Copyright (C) 2023 David Yin
 *
 * Based on the Grey Dragon Theme, which was designed and built by Serguei Dosyukov,
 * whose blog you will find at http://blog.dragonsoft.us/
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
  $link_url = item::root()->url();
  if ($theme->allow_root_page):            
    $link_url .= $theme->permalinks["enter"];
  endif;
  if ($theme->show_root_desc):
    if ($theme->root_description):
      $root_text = $theme->root_description;
    elseif (isset($item)):
      $root_text = $item->description;
    endif;
    if ($root_text): 
      ?><div id="g-rootpage-quote"><?php echo $theme->bb2html($root_text, 1); ?></div><?php
    endif; 
  endif;

  $slideshow_list = $theme->get_slideshow_list();
  $first = TRUE;
?>
<div id="g-rootpage-roll"<?php echo ($root_text)? null : ' class="g-full"'; ?>>
  <span><a href="<?php echo $link_url ?>"><?php echo t("Click to Enter") ?></a></span>
  <div id="g-rootpage-slideshow">
    <?php foreach ($slideshow_list as $entry): ?>
      <?php $attr = $entry["@attributes"]; ?>
    <div class="slider-item" style="width: <?php echo $attr['width']; ?>px; height: <?php echo $attr["height"]; ?>px; display: <?php echo ($first)? "block" : "none"; ?>; position: absolute; z-index: 10; opacity: <?php echo ($first)? "1" : "0"; ?>;">
      <a href="<?php echo $link_url; ?>"><img width="<?php echo $attr["width"]; ?>" height="<?php echo $attr["height"]; ?>" alt="" src="<?php echo $attr["url"]; ?>" /></a>
    </div>
      <?php $first = FALSE; ?>
    <?php endforeach ?>
  </div>  
</div>
<?php if (count($slideshow_list) > 0): ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#g-rootpage-slideshow').cycle({
        fx: '<?php echo $theme->root_cyclemode; ?>'
      , timeout: <?php echo $theme->root_delay * 1000; ?>
    });
  });
</script>
<?php endif; ?>