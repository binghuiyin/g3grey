<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Grey Dragon Theme - a custom theme for Gallery 3
 * This theme was designed and built by Serguei Dosyukov, whose blog you will find at http://blog.dragonsoft.us
 * Copyright (C) 2009-2011 Serguei Dosyukov
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
  $gd_shared_installed = (module::is_active("greydragon") && module::info("greydragon"));
  if ($gd_shared_installed):
    $view = new View("gd_admin_include.html");
    $view->is_module = FALSE;
    $view->downloadid = 1;
    $view->name = "greydragon";
    $view->form = $form;
    $view->help = $help;
  else:
    $view  = '<div id="g-greydragon-admin" class="g-block">';
    $view .= "<h1>" . t("Prerequisite") . "</h1><hr>";
    $view .= "<p>" . t("This theme requires GreyDragon shared module to be installed and actived first.") . "</p>";
    $view .= "<p>" . t("Please download it") . ' <a href="http://codex.gallery2.org/Gallery3:Modules:greydragon" target="_blank">' . t("here") . "</a> " . t("and install. Make sure it is activated.") . "</p>";
    $view .= "</div>";
  endif;

  print $view;
?>   

