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
<div id="g-search-results">
  <h1><?php  echo t("Search Results for \"%term\"", array("term" => $q)) ?> </h1>

  <?php  echo $theme->add_paginator("top"); ?>
  <div class="g-album-grid-container">
  <ul id="g-album-grid">
<?php  if (count($items)): ?>
    <?php  foreach ($items as $item): ?>
      <?php  echo $theme->get_thumb_element($item) ?>
    <?php  endforeach ?>
<?php  else: ?>
  <li><?php  echo t("No results found for <b>%term</b>", array("term" => $q)) ?></li>
<?php  endif; ?>
  </ul>
  </div>
  <?php  echo $theme->add_paginator("bottom"); ?>
</div>