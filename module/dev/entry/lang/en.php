<?php
/**
 * The index module english file of ZenTaoPHP.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */
$lang->entry = new stdclass();
$lang->entry->help = <<<EOF
Welcome to the Z tools for geeks. The current application is %s.
You can use z app list and z app switch appName to get all applications and switch to one.

App
 'z app list':            List available applications.

Usage
  z [feature] [command] [options]

Feature
  patch:   Manage the zentao patch.
  devops:  Perform DevOps operations.
  set:     Display and change configuration settings for current application.

Use "z [feature] --help or -h" for more information about a module.
EOF;
