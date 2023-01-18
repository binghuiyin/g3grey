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
<div id="g-item">
  <?= $theme->photo_top() ?>

  <div id="g-info">
    <h1><?= $theme->get_item_title($item, TRUE); ?></h1>
    <div class="g-hideitem"><?= $theme->bb2html(html::purify($item->description), 1) ?></div>
  </div>

  <?= $theme->add_paginator("top", FALSE); ?>

  <div id="g-movie">
    <?= $theme->resize_top($item) ?>
    <?=  $item->movie_img(array("class" => "g-movie", "id" => "g-item-id-{$item->id}")); ?>
    <?= $theme->resize_bottom($item) ?>
  </div>

  <?= $theme->add_paginator("bottom", FALSE); ?>

  <?= $theme->photo_bottom() ?>
</div>
