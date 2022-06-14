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
$lang->devops = new stdclass();
$lang->devops->help = new stdClass();
$lang->devops->help->devops = <<<EOF
Perform devops operations based on zentao.

Usage
  z devops <command> [options]

Commands
  mr  <targetbranch>    Merge code from two branches and test it by pipeline.
EOF;
$lang->devops->help->mr = <<<EOF
Usage
  z [devops] mr <targetbranch>    Merge code from two branches and test it by pipeline.

Example
 z mr master
 z devops mr master
EOF;

$lang->devops->urlTip      = 'The zentao host url, eg http://zentaopms.com:';
$lang->devops->accountTip  = 'username:';
$lang->devops->pwdTip      = 'password:';
$lang->devops->checking    = 'Checking...';
$lang->devops->logging     = 'Logging...';
$lang->devops->urlInvalid  = 'The host %s is invalid, please check again:';
$lang->devops->loginFailed = 'Login failed. Please check your account and password:';