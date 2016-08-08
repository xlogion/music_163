<?php
header("content-type:application/json;charset=utf-8");
date_default_timezone_set('PRC');
include("inc/config.php");

$music163 = new music163();
//搜索
//print_r($music163->search('faded'));

//歌曲信息
print_r($music163->song('36990266'));

//歌词
print_r($music163->lrc('36990266'));

//播放列表
//print_r($music163->getplaylists('173698052'));

//歌手专辑
//print_r($music163->getartistalbums('1045123'));

//获取专辑
//print_r($music163->getalbums('3406843'));

//获取MV
//print_r($music163->getmv('5303000'));