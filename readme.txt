Readme.txt

1. info 目录以及文件说明
   /btn   主要是三张图片
   /class 主要是oauth文件
   config.php  配置数据库以及腾讯微博和新浪微博APPID以及APP secret.
   do_share.php  配置share到微博的内容
   index.html  首页文件
   info.sql  创建user表的sql语法
   user.php  显示所有user

2. 用法
2.1 将info目录放到网站跟目录
2.2 修改config.php  主要修改数据库用户名和密码，appid以及appkey
2.3 创建数据库 
    mysql -u root -p
    source info.sql
2.4 修改do_share.php 配置需要分享的内容
2.5 允许info/user.php 查看有那些用户分享了内容

3. 参考
3.1 参考QQ与Sina的OAuth2协议以及api
   qq: 
    参考腾讯微博开放平台:  http://dev.t.qq.com/
    参考api  :  https://open.t.qq.com/api/user/info 
   sina:      
    参考sina开放平台地址： http://open.weibo.com/
    参考sina api : https://api.weibo.com/2/users/show.json

3.2 说明App Key以及secret
    QQ的App Key以及secret是通过http://dev.t.qq.com/development创建的网页应用
    Sina的App Key以及secret是通过http://open.weibo.com/apps/new?sort=web创建的网站应用

4.测试访问地址：
   http://infocusphone.com/info
       