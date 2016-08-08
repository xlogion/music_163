# music_163
----
- ### 说明
    
    ```
    music_163
    
    是一个网易音乐的API接口。可以方便的提供搜索、MP3、歌词、播放列表、歌手专辑、专辑详情、提取MV。
    ```
    
- ### 使用
	
	`require_once('class/music163.php');`

  `$music163 = new music163();`
	
- ### 搜索


    `$music163->search($keyword)`
    
    `$keyword` 关键词
    
	
- ### 歌曲信息
	
    `$music163->song('36990266')`
	
- ### 歌词信息
	
    `$music163->lrc('36990266')`

- ### 播放列表
	
    `$music163->getplaylists('173698052')`

- ### 歌手专辑
	
    `$music163->getartistalbums('1045123')`

- ### 专辑详情
	
    `$music163->getalbums('3406843')`

- ### 获取MV
	
    `$music163->getmv('5303000')`
