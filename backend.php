<?php
define('ROOTPATH', __DIR__);
if(file_exists(ROOTPATH.'/inc/vendor/autoload.php')){
  require_once(ROOTPATH.'/inc/vendor/autoload.php');
} else {
  die("Cannot find /inc/vendor/autoload.php. Did you run composer install?");
}
$gbp = new remoteFile('https://tools.hippiestation.com/pr_balances.json');
$labels1 = new remoteFile('https://api.github.com/repos/HippieStation/HippieStation/labels');
$labels2 = new remoteFile('https://api.github.com/repos/HippieStation/HippieStation/labels?page=2');
$labels3 = new remoteFile('https://api.github.com/repos/HippieStation/HippieStation/labels?page=3');

$gbp = json_decode($gbp,TRUE);
arsort($gbp);

$labels1 = json_decode($labels1);
$labels2 = json_decode($labels2);
$labels2 = json_decode($labels3);
$labels = array_merge($labels1,$labels2,$labels3);
$label_values = array(
  'Fix' => 2,
  'Refactor' => 2,
  'Code Improvement' => 1,
  'Grammar and Formatting' => 1,
  'Priority: High' => 4,
  'Priority: CRITICAL' => 5,
  'Logging' => 1,
  'Feedback' => 1,
  'Performance' => 3,
  'Feature' => -1,
  'Balance/Rebalance' => -1,
  'PRB: Reset' => '[RESET]',
);
foreach ($labels as &$l){
  $l->value = @$label_values[$l->name];
}
