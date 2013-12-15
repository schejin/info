<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <script src="http://code.jquery.com/jquery-1.10.2.js" type="text/javascript"></script> 
  <meta name='robots' content='noindex,nofollow' />
</head>
<body>
  <div class="web_wrapper">
    <div>
        <?php
         if($_GET['site'] === "sina"){
          ?>
          <!-- 分享到新浪微博 -->
          <script type="text/javascript">
            var data = {
                     img: "http://pic28.nipic.com/20130504/11533826_144119279140_2.jpg",
                     title: "测试分享新浪内容",
                     url: location.href,
                     appkey: 249736550
            }
 
           var url = 'http://v.t.sina.com.cn/share/share.php?url='+encodeURIComponent(data.url)+'&pic='+encodeURIComponent(data.img)+'&title='+encodeURIComponent(data.title)+'"&appkey="'+data.appkey+'"&pic"';
           window.location.href = url;
          </script>
        <?php
         } else if($_GET['site'] === "qq"){
         ?>          
         <!-- 分享到腾讯微博 -->
          <script type="text/javascript">
          var data = {
                     img: "http://pic23.nipic.com/20120815/10699062_174739611120_2.jpg",
                     title: "测试分享腾讯内容",
                     url: location.href,
                     appkey: 249736550
            }
 
           var url = 'http://v.t.qq.com/share/share.php?url='+encodeURIComponent(data.url)+'&pic='+encodeURIComponent(data.img)+'&title='+encodeURIComponent(data.title)+'"&appkey="'+data.appkey;
           window.location.href = url;
          </script>
        <?php
         }         
      ?>
    </div>
  </div>
</body>
</html>
