<?php defined("SYSPATH") or die("No direct script access.");
/**
 * G3 Grey Theme - a custom theme for Gallery 3
 * This theme is designed and built by David Yin, https://www.yinfor.com
 * Copyright (C) 2023 David Yin
 *
 * Based on the Grey Dragon Theme, which was designed and built by Serguei Dosyukov,
 * whose blog you will find at http://blog.dragonsoft.us/
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
<?php
class g3grey_event_Core {

  static function site_menu($menu, $theme) {
    $submenu = $menu->get("add_menu");
    if (!empty($submenu)) {
      $item = $submenu->get("add_photos_item");
      if (!empty($item)) { $item->css_class("ui-icon-plus"); }

      $item = $submenu->get("add_album_item");
      if (!empty($item)) { $item->css_class("ui-icon-note"); }
    }

    $submenu = $menu->get("options_menu");
    if (!empty($submenu)) {
      $item = $submenu->get("edit_item");
      if (!empty($item)) { $item->css_class("ui-icon-pencil"); }

      $item = $submenu->get("edit_permissions");
      if (!empty($item)) { $item->css_class("ui-icon-key"); }
    }
  }

  static function read_session_cmdparam($cmd, $cookie, $default) {
    try {
      $_cmd = $_GET[$cmd]; 
    } catch (Exception $e) {
    };

    if (isset($_cmd)):
      $_var = strtolower($_cmd);
      $_from_cmd = TRUE;
      if ($_var == "default"):
        $_var = $default;
      endif;
    else:
      $_from_cmd = FALSE;
      if ($cookie):
        try { 
          $_var = $_COOKIE[$cookie];
        } catch (Exception $e) {
        };
      endif;
    endif;

    if (!isset($_var)):
      $_var = $default;
    endif;

    return $_var;
  }

  static function add_path($path) {
    $config = Kohana_Config::instance();
    $kohana_modules = $config->get("core.modules");                                                  
    array_unshift($kohana_modules, THEMEPATH . $path); 
    $config->set("core.modules",  $kohana_modules);
    Kohana::include_paths(true);
  }

  static function add_path_ex($setting, $cmd, $cookie, $path, $default) {
    $value = module::get_var("th_g3grey", $setting, $default);
    $value = self::read_session_cmdparam($cmd, $cookie, $value);

    self::add_path("g3grey/css/" . $path . "/" . $value);
  }

  static function gallery_ready() {
    self::add_path_ex("frame_pack", "framepack", "gd_framepack", "framepacks", "g3grey");
    self::add_path_ex("color_pack", "colorpack", "gd_colorpack", "colorpacks", "g3grey");
    self::add_path("custom");
  }
}
?>