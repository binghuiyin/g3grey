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
<? 
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
      ?><div id="g-rootpage-quote"><?= $theme->bb2html($root_text, 1); ?></div><?
    endif; 
  endif;

  $slideshow_list = $theme->get_slideshow_list();
  $first = TRUE;
?>
<div id="g-rootpage-roll"<?= ($root_text)? null : ' class="g-full"'; ?>>
  <span><a href="<?= $link_url ?>"><?= t("Click to Enter") ?></a></span>
  <div id="g-rootpage-slideshow">
    <? foreach ($slideshow_list as $entry): ?>
      <? $attr = $entry["@attributes"]; ?>
    <div class="slider-item" style="width: <?= $attr['width']; ?>px; height: <?= $attr["height"]; ?>px; display: <?= ($first)? "block" : "none"; ?>; position: absolute; z-index: 10; opacity: <?= ($first)? "1" : "0"; ?>;">
      <a href="<?= $link_url; ?>"><img width="<?= $attr["width"]; ?>" height="<?= $attr["height"]; ?>" alt="" src="<?= $attr["url"]; ?>" /></a>
    </div>
      <? $first = FALSE; ?>
    <? endforeach ?>
  </div>  
</div>
<? if (count($slideshow_list) > 0): ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#g-rootpage-slideshow').cycle({
        fx: '<?= $theme->root_cyclemode; ?>'
      , timeout: <?= $theme->root_delay * 1000; ?>
    });
  });
</script>
<? endif; ?>