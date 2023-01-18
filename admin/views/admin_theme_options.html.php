<?php defined("SYSPATH") or die("No direct script access.");
/**
 * G3 Grey Theme - a custom theme for Gallery 3
 * This theme is designed and built by David Yin, https://www.yinfor.com
 * Copyright (C) 2023 David Yin
 *
 * Based on the Grey Dragon Theme, which was designed and built by Serguei Dosyukov,
 * whose blog you will find at http://blog.dragonsoft.us/
 * Copyright (C) 2009-2012 Serguei Dosyukov
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
  $gd_shared_installed = (module::is_active("g3grey_share") && module::info("g3grey_share"));
  if ($gd_shared_installed):
    $view = new View("gd_admin_include.html");
    $view->is_module = FALSE;
    $view->downloadid = 1;
    $view->name = "g3grey";
    $view->form = $form;
    $view->help = $help;
  else:
    $view  = '<div id="g-g3grey-admin" class="g-block">';
    $view .= "<h1>" . t("Prerequisite") . "</h1><hr>";
    $view .= "<p>" . t("This theme requires g3grey shared module to be installed and actived first.") . "</p>";
    $view .= "<p>" . t("Please download it") . ' <a href="https://forum.g2soft.net/viewforum.php?f=36">' . t("here") . "</a> " . t("and install. Make sure it is activated.") . "</p>";
    $view .= "</div>";
  endif;

  print $view;
?>   

