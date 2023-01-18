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
<div id="g-album-header">
  <?= $theme->album_top() ?>
  <h1><?= $theme->get_item_title($item, TRUE) ?></h1>
</div>

<?= $theme->add_paginator("top"); ?>

<? if (($theme->album_descmode == "top") and ($item->description)): ?>
  <div id="g-info"><div class="g-description"><?= $theme->bb2html(html::purify($item->description), 1); ?></div></div>
<? endif; ?>

<div class="g-album-grid-container">
<ul id="g-album-grid">
<?
  if (count($children)):
    $siblings = $item->children();
    if (($theme->disablephotopage) && (count($siblings) > count($children))):
      $j = 0;
      foreach ($siblings as $i => $sibling):
        if ($sibling->rand_key == $children[$j]->rand_key):
          echo $theme->get_thumb_element($sibling, !$theme->hidecontextmenu);
          if ($j + 1 < count($children)):
            $j++;
          endif;
        else:
          echo $theme->get_thumb_link($sibling);
        endif;
      endforeach;
    else:         
      foreach ($children as $i => $child):
        echo $theme->get_thumb_element($child, !$theme->hidecontextmenu);
      endforeach;
    endif;
  else:
    if ($user->admin || access::can("add", $item)):
      $addurl = url::site("uploader/index/$item->id"); ?>
      <li><?= t("There aren't any photos here yet! <a %attrs>Add some</a>.", array("attrs" => html::mark_clean("href=\"$addurl\" class=\"g-dialog-link\""))) ?></li>
    <? else: ?>
      <li><?= t("There aren't any photos here yet!") ?></li>
    <? endif; ?>
<? endif; ?>
</ul>
</div>

<? if (($theme->album_descmode == "bottom") and ($item->description)): ?>
  <div id="g-info"><div class="g-description"><?= $theme->bb2html(html::purify($item->description), 1) ?></div></div>
<? endif; ?>
<?= $theme->album_bottom() ?>

<?= $theme->add_paginator("bottom"); ?>
