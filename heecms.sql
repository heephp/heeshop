# Host: localhost  (Version: 5.7.26)
# Date: 2021-01-10 17:50:16
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "heecms_ad"
#

DROP TABLE IF EXISTS `heecms_ad`;
CREATE TABLE `heecms_ad` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) DEFAULT NULL COMMENT '广告分组',
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `code` text,
  `create_users_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `ord` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`ad_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_ad"
#

INSERT INTO `heecms_ad` VALUES (2,'banner','banner1','/static/skins/default/imgs/banner1.gif','#',2,'',1,1609880100,1609881815,NULL,NULL),(3,'adcenter','adcenter1','/static/skins/default/imgs/gg1.gif','#',0,'',1,1609884384,NULL,NULL,NULL),(4,'adcenter','adcenter2','/static/skins/default/imgs/gg2.gif','#',0,'',1,1609884404,NULL,NULL,NULL),(5,'adcenter','adcenter3','/static/skins/default/imgs/gg3.gif','#',0,'',1,1609884424,NULL,NULL,NULL),(6,'adcenter','adcenter4','/static/skins/default/imgs/gg4.gif','#',0,'',1,1609884634,NULL,NULL,NULL),(7,'adcenter','adcenter5','/static/skins/default/imgs/gg5.gif','#',0,'',1,1609884648,NULL,NULL,NULL),(8,'adcenter','adcenter6','/static/skins/default/imgs/gg6.gif','#',0,'',1,1609884665,NULL,NULL,NULL);

#
# Structure for table "heecms_article"
#

DROP TABLE IF EXISTS `heecms_article`;
CREATE TABLE `heecms_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL COMMENT '分类Id',
  `create_users_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `context` text,
  `hit` int(11) DEFAULT '0' COMMENT '点击',
  `author` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `first_pic` varchar(1000) DEFAULT NULL COMMENT '首图',
  `recommend` int(1) DEFAULT '0' COMMENT '推荐',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`article_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_article"
#

INSERT INTO `heecms_article` VALUES (1,2,1,'测试内容','描述','&lt;p&gt;&lt;img src=&quot;/upload/20200425/1587782677251926.jpg&quot; title=&quot;1587782677251926.jpg&quot; alt=&quot;qiyeguanwang.jpg&quot;/&gt;&lt;/p&gt;',1,'作者','关键词',NULL,1,1587782763,NULL,NULL,NULL),(2,2,1,'测试内容标题','描述','&lt;p&gt;&lt;img src=&quot;/upload/20200425/1587782677251926.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200506/1588768789115185.png&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200506/1588760663359953.png&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200425/1587782677251926_small.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;',1,'作者','关键词,产品,网站,信息,软件','/upload/20200425/1587782677251926.jpg',1,1587782944,1589683402,NULL,NULL),(3,2,1,'标题2','描述2','&lt;p&gt;内容2&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200506/1588760663359953.png&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200425/1587782677251926_small.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200425/1587782677251926.jpg&quot;/&gt;ujnnbbhjjvjjvvjhjjvjhvjvjvjvjvjvjhvjvj&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200506/1588768789115185.png&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200506/1588760663359953.png&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200425/1587782677251926_small.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/upload/20200425/1587782677251926.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;',0,'作者2','关键词2,信息','/upload/20200425/1587782677251926.jpg',1,1587784244,1589539497,NULL,NULL),(4,2,1,'价格','31','&lt;p&gt;&lt;img src=&quot;/upload/20200506/1588760663359953.png&quot; alt=&quot;1588760663359953.png&quot;/&gt;&lt;img src=&quot;/upload/20210102/212d81fffdc88fa78a6bdbfd55b7924a.png&quot; alt=&quot;212d81fffdc88fa78a6bdbfd55b7924a.png&quot;/&gt;&lt;/p&gt;',1,'','','/upload/20210102/212d81fffdc88fa78a6bdbfd55b7924a.png',0,1589681234,1609643858,1609857029,NULL),(5,2,16,'asdfa','sdfasdf','&lt;p&gt;asdfasdf&lt;/p&gt;',1,NULL,'asdfa',NULL,0,1609660055,NULL,NULL,NULL),(6,2,1,'123','213123','&lt;p&gt;*&lt;/p&gt;',NULL,'','*',NULL,0,1609747746,1609748558,NULL,0.00);

#
# Structure for table "heecms_category"
#

DROP TABLE IF EXISTS `heecms_category`;
CREATE TABLE `heecms_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `ord` varchar(255) DEFAULT NULL,
  `create_users_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `template` varchar(255) DEFAULT NULL COMMENT '列表页模板',
  `template_detail` varchar(255) DEFAULT NULL COMMENT '详细页模板',
  `isuser` int(11) DEFAULT '0' COMMENT '是否允许用户发布',
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_category"
#

INSERT INTO `heecms_category` VALUES (1,0,'fas fa-align-justify','测试栏目','','测试 栏目','1',1,1587778965,1609755573,NULL,0.00,'/index/_list',NULL,0),(2,1,'','测试子栏目2','','子栏目','2',1,1587779599,1609755377,NULL,0.00,'/index/_list',NULL,0),(3,1,'','ceshi1','','key','3',1,1588303244,NULL,1588470128,NULL,NULL,NULL,0),(4,1,'','测试栏目22','','22','2',1,1588472248,NULL,1588473611,NULL,NULL,NULL,0),(5,1,'','测试栏目3','','11','2',1,1588473774,NULL,1588474366,NULL,NULL,NULL,0),(6,0,'fas fa-air-freshener','演示分类','','关键词1','',1,1608838295,1608838317,1608860041,NULL,NULL,NULL,0);

#
# Structure for table "heecms_comment"
#

DROP TABLE IF EXISTS `heecms_comment`;
CREATE TABLE `heecms_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL COMMENT '栏目的ID',
  `info_id` int(11) DEFAULT NULL COMMENT '对应信息的Id',
  `create_users_id` int(11) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `context` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_comment"
#

INSERT INTO `heecms_comment` VALUES (1,1,2,1,'alksjd;flas','l;akjsd;lfkajs;dfkj','asdf@asddf.com','1878787878','lasdjdflajsdlf',111,11111,1588990563),(2,1,2,1,'12312','123123','as@a.com','2938742987','98798797',222222222,333333333,1588990714);

#
# Structure for table "heecms_config"
#

DROP TABLE IF EXISTS `heecms_config`;
CREATE TABLE `heecms_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(9999) CHARACTER SET utf8 DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_config"
#

/*!40000 ALTER TABLE `heecms_config` DISABLE KEYS */;
INSERT INTO `heecms_config` VALUES (1,'网站名称','website_name','HeeCMS官网',NULL),(2,'网站关键词','website_keyword','HeeCMS|HeePHP框架',NULL),(3,'网站描述','website_description','',NULL),(4,'网站网址','website_url','http://c.com',NULL),(5,'网站统计','website_tongji',NULL,NULL),(6,'网站Logo','website_logo','/assets/img/logo.gif',NULL),(7,'公司名称','company_name','',NULL),(8,'公司地址','company_addr',NULL,NULL),(9,'公司电话','company_tel',NULL,NULL),(10,'公司联系人','company_contact','',NULL),(11,'公司联系人电话','company_contact_mobile','',NULL),(12,'公司邮箱','company_email','',NULL),(13,'开启验证码','is_vcode','1',NULL),(14,'上传文件目录','upload_dir','/upload/',NULL),(15,'上传文件大小','upload_size','500','单位K'),(16,'上传文件格式','upload_ext','jpg,png,gif,jpge','*.jpg,*.gif'),(17,'验证码宽度','vcode_width','100',NULL),(18,'验证码高度','vcode_heigh','36',NULL),(19,'验证码干扰数量','vcode_line_count','20','5-20'),(20,'上传文件命名','upload_file_name','md5','md5,timespan,guid'),(21,'分页数量','pagesize','0','如果该值为0，则采用系统配置的值'),(22,'新用户组','newusergroup','9','新用户注册后的用户组'),(23,'是否开启水印','watermark','1',NULL),(24,'水印位置','watermark_postion','8',NULL),(25,'水印图片','watermark_img','',NULL),(26,'水印字体','watermark_font','',NULL),(27,'水印字体大小','watermark_fontsize','16',NULL),(28,'发邮件主机','mail_smtp_server','',NULL),(29,'发邮件用户名','mail_smtp_username','',NULL),(30,'发邮件密码','mail_smtp_password','',NULL),(31,'发邮件端口','mail_smtp_port','25',NULL),(32,'发件人邮箱','mail_sender','',NULL),(33,'短信AccessKeyId','sms_accessKeyId','',NULL),(34,'短信签名','sms_SingName','','短信签名多个用半角逗号分隔'),(35,'短信模板','sms_TemplateCode','','短信模板多个用半个逗号分隔'),(36,'公司介绍','company_desc','',NULL),(37,'水印文字','watermark_txt','水印文字',NULL),(38,'验证码位数','vcode_num','4','验证码生成的位数'),(39,'验证码字符','vcode_char','lower','all所有 char字母 upper大写 lower小写 number数字'),(40,'验证码字体大小','vcode_fontsize','20',NULL),(41,'短信AccessKeySecret','sms_accessKeySecret','',NULL),(42,'网站ICP','website_icp','沪ICP备14038410号-13',NULL),(44,'网站模板目录','website_skin','default',NULL),(45,'login_qq_appid','login_qq_appid','',NULL),(46,'login_qq_appkey','login_qq_appkey','',NULL),(47,'login_qq_callback','login_qq_callback','',NULL),(48,'login_wx_appsecrt','login_wx_appsecrt','',NULL),(49,'login_wx_appid','login_wx_appid','',NULL),(50,'login_wb_appid','login_wb_appid',NULL,NULL),(51,'login_wb_appsecrt','login_wb_appsecrt','',NULL),(52,'login_wb_appkey','login_wb_appkey','',NULL),(53,'login_bd_appkey','login_bd_appkey',NULL,NULL),(54,'login_bd_appsecrt','login_bd_appsecrt','',NULL),(55,'login_bd_domain','login_bd_domain','',NULL),(56,'login_ali_appid','login_ali_appid','',NULL),(57,'login_ali_private_key','login_ali_private_key','',NULL),(58,'login_ali_public_key','login_ali_public_key','',NULL),(59,'微信支付APPID','pay_wx_appid','wx9d24e93197f03db3',NULL),(60,'微信支付商户Id','pay_wx_mchid','1338307101',NULL),(61,'微信支付商户密钥','pay_wx_key','wangyingzhe1986091288wangyingzhe',NULL),(62,'微信支付Appsecrt','pay_wx_appsecrt','0371ce107606715cf4bfb9c5c8a53741',NULL),(63,'微信支付证书','pay_wx_apiclient_cert','',NULL),(64,'微信支付证书','pay_wx_apiclient_key','',NULL),(65,'支付宝支付APPId','pay_ali_appid','2018011901968294',NULL),(66,'支付宝账号','pay_ali_account','lvstech@foxmail.com',NULL),(67,'支付宝商户私钥','pay_ali_private_key','MIIEowIBAAKCAQEAjIE8pEP9KNTvakTLGia3YmawOcvtQ+MYR4zNzLMaANf0YInIQJWiL2HY+ocPaEJlLo24uIMxVWkB48Xonz/OAdHkQ1+XM9daU8FVcrXyu4JLuhomnxelJNDdrmNMa+iXK9T+lA3xPi9C5pcgvt5Wtfz8EMZWZaPpOc7wC0YDLFCOpS3SpOTtpGfWk7S4tdxIelW2XtjiaDS+AVxROlArShgk/TEdbxP18me4FAQ3eYv/F1uD/f+1fvAeiR2cEU78aVpG3H0uBa7bSSbhmLGTFvnP0hc+i4TUeIXrmnkmIKC9hZictGcvcXZ/LnLFCAaQI8yb1bpbaOsN/23YtIAmGQIDAQABAoIBAQCB4tbUY6WcIXxRmNbIjhHo/VTbmRD1OPIw8pEtMkRPk1NuCvD8A1eyxZl3v3MWxooSxyCEMYNhmXkNvt6UmL8wH4AMaEm2utXdp1P+fwStIn4uxA3/9DPOHOdRVqpG9vUIqBXPeDQTcE1ALWUwDQnLotrCBxfHTgdEUXDGeypjw5Su6h+FIhtR3ULqxQD87+NV+AXyqThH0LXNq6ERStLi/qgYl1hrHJKn1YlFMlAufnV++Es2GkOUkt7+0xu+CRPZuNGlOdFc7QXrGh2DMwBYeh5TNXl5IbcVehwjGQA0w6EU/TvQl+anlgJk5u/ylaVztxEuLq4FqaYhTH1JVIqBAoGBAM5/Eu7em1Z8sBzfw0HQsESMQ/YTF8AjQ7SMP1kxlGqUTMPEJfKa8wT11cA4CRPMN1c092PR1izATI0xf5AAXOYQn+LFUYVmjegMBFULMGEmSDQuzOhf5Q6RqH66QthMW1Vbeo0CHvSqgoNKFWI1MkXtlrq+ynCq8mEAG+z3DSuFAoGBAK4wLwsxiqltLt2JC7+Q9jKfbSQ1yP9yTYB0mZxWBwRt64O9fcJ24BSQXJ7OpaAkH/Aij59ih71ZXicFQt23NWrhG9WlvhIyn6ukCP2JwA5dBrLOGrhpXwDK1gyURBUMIih5fz7LhKzEdzQynbqbXdbmRyqXftuLrAZ/qfQIA4KFAoGAeC3g2QDZq0Y6QTPBsgZA8EQqMYb/JaXge628GK8QT88rtivsYfvoQBTLaGm0br9F3g1HheLUIYtxgiMyuJ5dctBuHU71mQwMvuZvhwdSCth64VPzkbJt30LKq6a/zJ7z8QOimXqIhaDPAJYXR+bp8WTLergbneL/2ZB0sD9AfPkCgYBNHtg1RIH38XdGbl7dOflHAH76ATY0ow7dSMKaDRyeQWx8r3D2oFslv6TCSwvZkyTw1Nxx3NXsZ5zf+dxY/byQzYndVbyJohA/lijE2DBIK7fDgq0h6MU/PI74ksxx5SVadjB4RPNA6ts8KQzcid1KQDpSCTEJUxWe6vb8LHAhYQKBgAu2m0E0afgXoYDDVrl+ltQB8z/4swJBoaZkuVBRKMoMqXTrNgPj72PNr1vMaEEV3sehuGXiXjKJQPavlexhdOdc9eQVG3Zghqly0SKdJiDsITr6QvlLASjvOE2Y/Q9Jj2Kvuus3493OEldxIlDR8zN1+WG0oZiHA0NBg17CZAQJ',NULL),(68,'支付宝公钥','pay_ali_public_key','MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjIE8pEP9KNTvakTLGia3YmawOcvtQ+MYR4zNzLMaANf0YInIQJWiL2HY+ocPaEJlLo24uIMxVWkB48Xonz/OAdHkQ1+XM9daU8FVcrXyu4JLuhomnxelJNDdrmNMa+iXK9T+lA3xPi9C5pcgvt5Wtfz8EMZWZaPpOc7wC0YDLFCOpS3SpOTtpGfWk7S4tdxIelW2XtjiaDS+AVxROlArShgk/TEdbxP18me4FAQ3eYv/F1uD/f+1fvAeiR2cEU78aVpG3H0uBa7bSSbhmLGTFvnP0hc+i4TUeIXrmnkmIKC9hZictGcvcXZ/LnLFCAaQI8yb1bpbaOsN/23YtIAmGQIDAQAB',NULL),(70,'微信公众号encoding','pay_wx_encodingaeskey','oYXBEIiGiURMXBUNQVZAkhSaqHDysKxZsRyvemNVTNh',NULL),(71,'微信公众号Token','pay_wx_token','dsfasfdasf352345235ERTWERSgYTU56',NULL),(72,'网站首页模板','skin_index','/index',NULL),(73,'内容过滤','filtertxt','共产党|江泽民|胡锦涛|温家宝|习近平|习仲勋|贺国强|贺子珍|周永康|李长春|李德生|王岐山|姚依林|回良玉|李源潮|李干成|戴秉国|黄镇|刘延东|刘瑞龙|俞正声|黄敬|薄熙|薄一波|周小川|周建南|温云松|徐明|江泽慧|江绵恒|江绵康|李小鹏|李鹏|李小琳|朱云来|朱容基|让国人愤怒的第二代身份证|第二代身份证|文化大革命|胡海峰|六四|反共|共产党|陈良宇|老丁|莱仕德事件|fuck|地下的先烈们纷纷打来电话询问|李洪志|大纪元|真善忍|新唐人|肉棍|淫靡|你妈比|操你妈|尻|淫水|六四事件|迷昏药|迷魂药|窃听器|六合彩|买卖枪支|三唑仑|麻醉药|麻醉乙醚|短信群发器|帝国之梦|毛一鲜|黎阳平|对日强硬|出售枪支|迷药|摇头丸|西藏天葬|军长发威|PK黑社会|枪决女犯|投毒杀人|强硬发言|出售假币|监听王|昏药|侦探设备|麻醉钢枪|反华|官商勾结|升达毕业证|手机复制|戴海静|自杀指南|自杀手册|张小平|佳静安定片|蒙汗药粉|古方迷香|强效失意药|迷奸药|透视眼镜|远程偷拍|自制手枪|激情小电影|黄色小电影|天鹅之旅|盘古乐队|高校暴乱|高校群体事件|大学骚乱|高校骚乱|催情药|拍肩神药|春药|身份证生成器|枪决现场|出售手枪|麻醉枪|办理证件|办理文凭|疆独|藏独|高干子弟|高干子女|枪支弹药|血腥图片|反政府|禁书|无界浏览器|特码|成人|换妻|共匪=共框非|国民党|腐败|贪污|自慰|淫荡|骚妇|台独=台反文旁虫|法论功|三点水去论工力|李宏志|胡海峰|江湖淫娘|骆冰淫传|夫妇乐园|阿里布达年代记|爱神之传奇|不良少女日记|沧澜曲|创世之子猎艳之旅|东北风情熟女之惑|风骚侍女|海盗的悠闲生活|黑天使|黑星女侠|混蛋神风流史|狡猾的风水相师|俪影蝎心|秦青的幸福生活|四海龙女|逃亡艳旅|性启蒙|现代艳帝传奇|星光伴我淫|倚天屠龙别记|淫术炼金士|十景缎|往事追忆录|舌战法庭|少妇白洁|风月大陆|风尘劫|美少妇的哀羞|阿兵哥言语录|遥想当年春衫薄|王子淫传|神雕外传之郭襄|睡着的武神|少年阿宾|毛主席复活|蒙汗药|粗口歌|激情电影|AV|十八禁|a片|性虐待|女优|18禁|激情|耽美|金瓶梅|丝袜|美腿|毛片|少儿不宜|藏春阁|玉蒲团|隐形喷剂|反雷达测速|假币|出售枪支|出售手枪|代开发票|假钞|窃听|电话拦截系统|探测狗|手机卡复制器|监听王|手机跟踪定位器|监听器|针孔摄像|监听宝|三唑仑|迷幻药|手拍肩|迷魂香|摇头丸|麻古|胡锦涛|温家宝|共狗|政治风波|陈良宇|反政府|政府软弱|政府无能|九评|十七大代表|办证|暴力拆迁|轮暴致死|人民报|天葬|轮奸|暴力镇压|陈水扁|达赖|共匪|天安门事件|高干子弟名单|性免费电影|全裸|偷拍|偷 拍|台独|中共十七大|徐和柴学友|修炼之歌|警察殴打|新诗年鉴|李沛瑶遇害|美国凯德|肥东交警|中央军委|针对台湾|梁保华|MC军团|旧民运|伪民运|采花堂|中国劳工通讯|评中国共产党|反雷达测速|建立生活性补贴|中共走狗|中共小丑|共奴|中共恶霸|共产无赖|右派|流氓政府|原子弹制作简明教程|盘古乐队|绝食抗议|北戴河会议|邓二世|内斗退党|退团|江理论|香港六合彩|A集中营|退党|法新闻社|欧洲圆明网|亚太正悟网|大法新闻社|白宫事件|日本大使馆0R409游行|反日万人游行|六四屠杀|六四屠城|六四政变|六四之役|27军长砸洗浴中心|中共邪教|调查真相委员会|追查国际|中共暴行|大法洪传|弘法体|大法之声|江独裁|李屠夫|江恶人|江戏子|中共特务|乙醚|党内分裂|新生网|圆明网|修炼之歌|发正念|和平修炼|放下生死|大法大福|大硞弟子|大纪元|支联会|共产专制|共产极权|专政机器|共产王朝|大法洪传|毛派|法网恢恢|邓派|五套功法|宇宙最高法理|谁是新中国|法正人间|法正乾坤|正法时期|海外护法|洪发交流|报禁|党禁|鸽派|鹰派|赣江学院暴动|全国退党|绝食抗暴|维权抗暴|活体器官|中共暴政|器官移植|中共恶霸|共产无赖|中共当局|胡温政府|江罗集团|师傅法身|正派民运|中华联邦政府|亲共行动|联邦政府|流氓民运|特务民运|江贼民|中共警察|中共监狱|中共政权|中共迫害|自由联邦|中共独枭|流氓无产者|中共专制|明慧周刊|九评共产党|江泽民其人|麻古|色情|口交|秘密文件|机密文件|红头文件|政府文件|自焚|破网软件|无界浏览|亲共来源|黄色小说|台湾18DY电影|H动漫|tmd|nnd|亚热|耽美|包娃衣|粗口歌|十八禁|激情电影|禁播|H漫画|藏春阁|丁度巴拉斯|大禁|激情|少儿不宜|买春堂|苏东解体|反右题材|隐私图片|卫星接收器|卫星电视|信号拦截器|中国威胁论|新闻通气会|山西洪洞|巨额骗储|五奶小青|江湖淫娘|红楼绮梦|骆冰淫传|阿里布达年代|不良少少日记|沧澜曲|创世之子猎艳之旅|东北风情熟女之惑|风骚侍女|海盗的悠闲生活|黑天使|黑星女侠|混蛋神风流史|狡猾的风水相师|狂风暴雨|俪影蝎心|梦中的女孩|秦青的幸福生活|四海龙女|逃亡艳旅|现代艳帝传奇|星光伴我淫|倚天屠龙别记|淫术炼金士|十景缎|往事追忆录|舌战法庭|少妇白洁|风月大陆|风尘劫|美少妇的哀羞|阿兵哥言语录|遥想当年春衫薄|王子淫传|神雕外传之郭襄|睡着的武神|少年阿宾|首先使用核武器|汽车爆炸案|香港GHB水|透视眼镜|色空寺|周容重|朱蒙|汕頭頻傳擄童割器官|法輪功|六决不|清华网管|道县公安|济南建设路|老虎机|轮盘机|百家乐|连线机|模拟机|彩票机|礼品机|卢跃刚|玫瑰园|天浴|一卡多号|最淫官员|偷电|盗电|中国人都在上的四大当|总统的讲话|痛批政法委|山西黑砖窑|黑窑奴役|杨元元|梁保华|敢坐飞机吗|韩国身份证|台湾身份证|广电总局|学生暴动|镇压学生|广安第二人民医院|山不过来|胡新宇|趙紫陽|赵紫阳|自由亚州|人民报|明慧|天鹅之旅|玉蒲团|践踏中国女性|拉凳|南京大学法学院|挥发型迷药|喷雾型迷药|金伯帆|崔英杰|松花江污染|火药制作|换妻|江氏|第十六次代表|仁寿警方|愈快乐愈堕落|出售假币|麻醉枪|上海交警|最牛钉子户|淫间道|唐人电视台|嫩穴|金鳞岂是池中物|江山美人志|六合采|民警当副院长|股市民谣|股市民谣|禁断少女|卫星遭黑客攻击|萬人暴|官逼民反|中原油田|张大权|油田总部|枪淫少妇|博白县|動乱|军火价格|女死囚|劉奇葆|法lun功|女友坊|香港马会|白小姐|曾道人|一码中特|自由门|艳照门|奴役童工|性奴|计生风暴|厦门大游行|想不到的黑幕|死亡笔记|二奶|2奶|纪股票市场五卅惨案|这年头就这样|代开普通发票|代开商品发票|代开国税发票|代开地税发票|代开广告发票|代开运输发票|代开租赁发票|代开维修发票|代开建筑发票|代开安装发票|代开餐饮发票|代开服务发票|代开发票|毛爷爷复活|智能Ｈ３|智能H3|赣江学院|江西田园置业集团|海乐神|酣乐欣|高莺莺|完全自杀手册|三唑仑|法轮=FALun|李洪志|大纪元|真善忍|新唐人|淫靡|无界|广东王|口头检查|三句硬话|红海湾|升达|沈阳公安|拦截器|阻无通畅|民为法执|臭作|尾行|电车之狼|达赖|绕过封锁|新疆独立|西藏独立|新生网|新唐人|淫水|肉棍|本拉登|唐人电视台|明慧|自由亚州|无界浏览|美国之音|大紀元|崔英杰|松花江污染|汕尾事件|胡新宇|公务员工资|公务员调资|鸡吧|鸡巴|公务员的工资|反中游行|支持台湾|退党|双鞋的故事|中国军用运输机|科技精英遇难|湘阴杨林|杨林寨|湘阴县杨林|仁寿警方|死刑枪毙|金伯帆|马加爵|学生暴动|镇压学生|广安第二人民医院|死刑过程|色空寺|学生与警察|鬼村|周容|周容重|重题工|先烈的电电|身份证生成|短信猫|车牌反光|次下跪|求救遭拒|邪恶的党|出售迷药|针孔摄像机|日本小泉|小泉恶搞|江氏|温家堡|蒋彦永|灭绝罪|大揭露|突破封锁|多党执政|生成身份证|华国锋|叶剑英|邓小平|陈云|李先念|汪东兴|韦国清|乌兰夫|方毅|刘伯承|许世友|纪登奎|苏振华|李德生|吴德|余秋里|张廷发|陈永贵|陈锡联|耿飚|聂荣臻|倪志福|徐向前|彭冲|习仲勋|王震|韦国清|邓颖超|杨尚昆|杨得志|宋任穷|胡乔木|胡耀邦|倪志福|彭真|廖承志|姚依林|秦基伟|陈慕华|田纪云|乔石|江泽民|李鹏|李铁映|李瑞环|李锡铭|杨汝岱|吴学谦|宋平|胡启立|秦基伟|芮杏文|阎明复|温家宝|薄一波|丁关根|朱镕基|刘华清|杨白冰|吴邦国|邹家华|陈希同|胡锦涛|姜春云|钱其琛|尉健行|谢非|谭绍文|王汉斌|任建新|迟浩田|张万年|于永波|傅全有|李长春|李岚清|吴官正|罗干|贾庆林|黄菊|曾庆红|吴仪|王克|王瑞林|曹刚川|郭伯雄|徐才厚|王乐泉|王兆国|回良玉|刘淇|刘云山|张立昌|张德江|陈良宇|周永康|俞正声|贺国强|曾培炎|王刚|徐才厚|针孔摄像机|隐形耳机|隐形摄像头|何勇|梁光烈|廖锡龙|李继耐|国民党|粗口歌|激情电影|裸聊|女优|代考|18禁|激情|耽美|金瓶梅|藏春阁|玉蒲团|隐形喷剂|反雷达测速|假币|出售枪支|出售手枪|代开发票|英语枪手|电话拦截系统|探测狗|手机卡复制器|手机跟踪定位器|针孔摄像|仿真枪|考试作弊器|麻醉枪|开锁器|淫秽|三唑仑|手拍肩|定位器|上分器|干扰器|退币王|k粉|摇头丸|麻古|共狗|诈骗信息|销售枪支|爆炸物品|激情电影|性器官|风骚小阿姨|非常诱惑|风月宝鉴之冥府春色|风流一夜情|飞凤春宵|风情万种野玫瑰|乳房|夫妻作爱|夫妻做爱|三级片片|应召女郎|强暴|性交|性生活|香醇的诱惑|处男|性爱|奸杀|血溅红灯区|雪肌夜叉|血恋|现代靓妹仔|新七擒七纵七色狼|骚b|三级图片|淫乱|a级情片|强奸|淫乱秘史|艳丽片|香港伦理片|淫色漫画|淫片|叫春|中国性搜网|性息|阴毛|淫虫|艳舞女郎|禁宮秘史|少女换衣|偷欢|18dy|a片','使用|分隔'),(74,'替换文本','replacetxt','*','替换为的文本'),(75,'官网登录用户名','site_username','',NULL),(76,'官网安全码','site_safecode','',NULL),(77,'支付成功的订单状态','order_paysucc_state','1','默认支付成功后为支付成功  可设置为已发货 或已完成'),(78,'支付成功后生效时间','pay_succ_endtime','1','服务商品需要设置，实物商品无需设置');
/*!40000 ALTER TABLE `heecms_config` ENABLE KEYS */;

#
# Structure for table "heecms_country"
#

DROP TABLE IF EXISTS `heecms_country`;
CREATE TABLE `heecms_country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`country_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_country"
#

/*!40000 ALTER TABLE `heecms_country` DISABLE KEYS */;
INSERT INTO `heecms_country` VALUES (1,'中国','CHINA'),(2,'阿尔巴尼亚','ALB'),(3,'阿尔及利亚','DZA'),(4,'阿富汗','AFG'),(5,'阿根廷','ARG'),(6,'阿拉伯联合酋长国','ARE'),(7,'阿鲁巴','ABW'),(8,'阿曼','OMN'),(9,'阿塞拜疆','AZE'),(10,'阿森松岛','ASC'),(11,'埃及','EGY'),(12,'埃塞俄比亚','ETH'),(13,'爱尔兰','IRL'),(14,'爱沙尼亚','EST'),(15,'安道尔','AND'),(16,'安哥拉','AGO'),(17,'安圭拉','AIA'),(18,'安提瓜岛和巴布达','ATG'),(19,'奥地利','AUT'),(20,'奥兰群岛','ALA'),(21,'澳大利亚','AUS'),(22,'巴巴多斯岛','BRB'),(23,'巴布亚新几内亚','PNG'),(24,'巴哈马','BHS'),(25,'巴基斯坦','PAK'),(26,'巴拉圭','PRY'),(27,'巴勒斯坦','PSE'),(28,'巴林','BHR'),(29,'巴拿马','PAN'),(30,'巴西','BRA'),(31,'白俄罗斯','BLR'),(32,'百慕大','BMU'),(33,'保加利亚','BGR'),(34,'北马里亚纳群岛','MNP'),(35,'贝宁','BEN'),(36,'比利时','BEL'),(37,'冰岛','ISL'),(38,'波多黎各','PRI'),(39,'波兰','POL'),(40,'波斯尼亚和黑塞哥维那','BIH'),(41,'玻利维亚','BOL'),(42,'伯利兹','BLZ'),(43,'博茨瓦纳','BWA'),(44,'不丹','BTN'),(45,'布基纳法索','BFA'),(46,'布隆迪','BDI'),(47,'布韦岛','BVT'),(48,'朝鲜','PRK'),(49,'丹麦','DNK'),(50,'德国','DEU'),(51,'东帝汶','TLS'),(52,'多哥','TGO'),(53,'多米尼加','DMA'),(54,'多米尼加共和国','DOM'),(55,'俄罗斯','RUS'),(56,'厄瓜多尔','ECU'),(57,'厄立特里亚','ERI'),(58,'法国','FRA'),(59,'法罗群岛','FRO'),(60,'法属波利尼西亚','PYF'),(61,'法属圭亚那','GUF'),(62,'法属南部领地','ATF'),(63,'梵蒂冈','VAT'),(64,'菲律宾','PHL'),(65,'斐济','FJI'),(66,'芬兰','FIN'),(67,'佛得角','CPV'),(68,'弗兰克群岛','FLK'),(69,'冈比亚','GMB'),(70,'刚果','COG'),(71,'刚果民主共和国','COD'),(72,'哥伦比亚','COL'),(73,'哥斯达黎加','CRI'),(74,'格恩西岛','GGY'),(75,'格林纳达','GRD'),(76,'格陵兰','GRL'),(77,'古巴','CUB'),(78,'瓜德罗普','GLP'),(79,'关岛','GUM'),(80,'圭亚那','GUY'),(81,'哈萨克斯坦','KAZ'),(82,'海地','HTI'),(83,'韩国','KOR'),(84,'荷兰','NLD'),(85,'荷属安地列斯','ANT'),(86,'赫德和麦克唐纳群岛','HMD'),(87,'洪都拉斯','HND'),(88,'基里巴斯','KIR'),(89,'吉布提','DJI'),(90,'吉尔吉斯斯坦','KGZ'),(91,'几内亚','GIN'),(92,'几内亚比绍','GNB'),(93,'加拿大','CAN'),(94,'加纳','GHA'),(95,'加蓬','GAB'),(96,'柬埔寨','KHM'),(97,'捷克共和国','CZE'),(98,'津巴布韦','ZWE'),(99,'喀麦隆','CMR'),(100,'卡塔尔','QAT'),(101,'开曼群岛','CYM'),(102,'科科斯群岛','CCK'),(103,'科摩罗','COM'),(104,'科特迪瓦','CIV'),(105,'科威特','KWT'),(106,'克罗地亚','HRV'),(107,'肯尼亚','KEN'),(108,'库克群岛','COK'),(109,'拉脱维亚','LVA'),(110,'莱索托','LSO'),(111,'老挝','LAO'),(112,'黎巴嫩','LBN'),(113,'立陶宛','LTU'),(114,'利比里亚','LBR'),(115,'利比亚','LBY'),(116,'列支敦士登','LIE'),(117,'留尼旺岛','REU'),(118,'卢森堡','LUX'),(119,'卢旺达','RWA'),(120,'罗马尼亚','ROU'),(121,'马达加斯加','MDG'),(122,'马尔代夫','MDV'),(123,'马耳他','MLT'),(124,'马拉维','MWI'),(125,'马来西亚','MYS'),(126,'马里','MLI'),(127,'马其顿','MKD'),(128,'马绍尔群岛','MHL'),(129,'马提尼克','MTQ'),(130,'马约特岛','MYT'),(131,'曼岛','IMN'),(132,'毛里求斯','MUS'),(133,'毛里塔尼亚','MRT'),(134,'美国','USA'),(135,'美属萨摩亚','ASM'),(136,'美属外岛','UMI'),(137,'蒙古','MNG'),(138,'蒙特塞拉特','MSR'),(139,'孟加拉','BGD'),(140,'秘鲁','PER'),(141,'密克罗尼西亚','FSM'),(142,'缅甸','MMR'),(143,'摩尔多瓦','MDA'),(144,'摩洛哥','MAR'),(145,'摩纳哥','MCO'),(146,'莫桑比克','MOZ'),(147,'墨西哥','MEX'),(148,'纳米比亚','NAM'),(149,'南非','ZAF'),(150,'南极洲','ATA'),(151,'南乔治亚和南桑德威奇群岛','SGS'),(152,'瑙鲁','NRU'),(153,'尼泊尔','NPL'),(154,'尼加拉瓜','NIC'),(155,'尼日尔','NER'),(156,'尼日利亚','NGA'),(157,'纽埃','NIU'),(158,'挪威','idR'),(159,'诺福克','NFK'),(160,'帕劳群岛','PLW'),(161,'皮特凯恩','PCN'),(162,'葡萄牙','PRT'),(163,'乔治亚','GEO'),(164,'日本','JPN'),(165,'瑞典','SWE'),(166,'瑞士','CHE'),(167,'萨尔瓦多','SLV'),(168,'萨摩亚','WSM'),(169,'塞尔维亚,黑山','SCG'),(170,'塞拉利昂','SLE'),(171,'塞内加尔','SEN'),(172,'塞浦路斯','CYP'),(173,'塞舌尔','SYC'),(174,'沙特阿拉伯','SAU'),(175,'圣诞岛','CXR'),(176,'圣多美和普林西比','STP'),(177,'圣赫勒拿','SHN'),(178,'圣基茨和尼维斯','KNA'),(179,'圣卢西亚','LCA'),(180,'圣马力诺','SMR'),(181,'圣皮埃尔和米克隆群岛','SPM'),(182,'圣文森特和格林纳丁斯','VCT'),(183,'斯里兰卡','LKA'),(184,'斯洛伐克','SVK'),(185,'斯洛文尼亚','SVN'),(186,'斯瓦尔巴和扬马廷','SJM'),(187,'斯威士兰','SWZ'),(188,'苏丹','SDN'),(189,'苏里南','SUR'),(190,'所罗门群岛','SLB'),(191,'索马里','SOM'),(192,'塔吉克斯坦','TJK'),(193,'泰国','THA'),(194,'坦桑尼亚','TZA'),(195,'汤加','TON'),(196,'特克斯和凯克特斯群岛','TCA'),(197,'特里斯坦达昆哈','TAA'),(198,'特立尼达和多巴哥','TTO'),(199,'突尼斯','TUN'),(200,'图瓦卢','TUV'),(201,'土耳其','TUR'),(202,'土库曼斯坦','TKM'),(203,'托克劳','TKL'),(204,'瓦利斯和福图纳','WLF'),(205,'瓦努阿图','VUT'),(206,'危地马拉','GTM'),(207,'维尔京群岛，美属','VIR'),(208,'维尔京群岛，英属','VGB'),(209,'委内瑞拉','VEN'),(210,'文莱','BRN'),(211,'乌干达','UGA'),(212,'乌克兰','UKR'),(213,'乌拉圭','URY'),(214,'乌兹别克斯坦','UZB'),(215,'西班牙','ESP'),(216,'希腊','GRC'),(217,'新加坡','SGP'),(218,'新喀里多尼亚','NCL'),(219,'新西兰','NZL'),(220,'匈牙利','HUN'),(221,'叙利亚','SYR'),(222,'牙买加','JAM'),(223,'亚美尼亚','ARM'),(224,'也门','YEM'),(225,'伊拉克','IRQ'),(226,'伊朗','IRN'),(227,'以色列','ISR'),(228,'意大利','ITA'),(229,'印度','IND'),(230,'印度尼西亚','IDN'),(231,'英国','GBR'),(232,'英属印度洋领地','IOT'),(233,'约旦','JOR'),(234,'越南','VNM'),(235,'赞比亚','ZMB'),(236,'泽西岛','JEY'),(237,'乍得','TCD'),(238,'直布罗陀','GIB'),(239,'智利','CHL'),(240,'中非共和国','CAF');
/*!40000 ALTER TABLE `heecms_country` ENABLE KEYS */;

#
# Structure for table "heecms_guestbook"
#

DROP TABLE IF EXISTS `heecms_guestbook`;
CREATE TABLE `heecms_guestbook` (
  `guestbook_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `wx` varchar(255) DEFAULT NULL,
  `context` text,
  `create_time` int(11) DEFAULT NULL,
  `create_users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`guestbook_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_guestbook"
#

INSERT INTO `heecms_guestbook` VALUES (1,'a','b','c@q.com','133333','888888','wx111','c1122',1111111111,NULL);

#
# Structure for table "heecms_link"
#

DROP TABLE IF EXISTS `heecms_link`;
CREATE TABLE `heecms_link` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0' COMMENT '上级菜单',
  `link_group_id` int(11) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `hit` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `ord` int(11) DEFAULT '0',
  `target` varchar(255) DEFAULT NULL,
  `create_users_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`link_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_link"
#

INSERT INTO `heecms_link` VALUES (1,0,1,'','首页','/home/index/index',NULL,'',1,'_blank',NULL,1587775067,1609706077,NULL),(3,0,1,'','新闻资讯','#',NULL,'',2,'_self',NULL,1587909065,1609706166,NULL),(4,0,1,'','产品展示','#',NULL,'',3,'_self',NULL,1587909125,1609706179,NULL),(5,0,1,'','成功案例','#',NULL,'',4,'_self',NULL,1587909155,1609706209,NULL),(6,0,1,'','人才招聘','#',NULL,'',5,'_blank',NULL,1587909200,1609706292,NULL),(7,0,1,'','关于我们','#',NULL,'',6,'_blank',NULL,1587909232,1609706356,NULL),(8,0,2,'','CSDN','http://www.csdn.net',NULL,'',1,NULL,NULL,1587913259,NULL,NULL),(9,0,2,'','新浪网','http://www.sina.com.cn',NULL,'',2,NULL,NULL,1587913279,NULL,NULL),(10,0,2,'','QQ','http://www.qq.com',NULL,'',3,NULL,NULL,1587914384,NULL,NULL),(11,0,2,'','腾讯云','http://cloud.tencent.com',NULL,'',4,NULL,NULL,1587914438,NULL,NULL),(12,0,2,'','GitHub','http://www.github.com',NULL,'',5,NULL,NULL,1587914471,NULL,NULL),(13,0,2,'','阿里云','http://www.aliyun.com',NULL,'',6,NULL,NULL,1587914507,NULL,NULL),(14,0,2,'','腾讯开发平台','http://open.qq.com/',NULL,'',8,NULL,NULL,1587914606,NULL,NULL),(15,0,2,'','码云','http://www.gitee.com',NULL,'',9,NULL,NULL,1587914640,NULL,NULL),(16,0,2,'','西部数码','http://www.west.cn',NULL,'',10,NULL,NULL,1587914778,NULL,NULL),(17,0,2,'','绿松科技','http://www.lvstech.cn',NULL,'',11,NULL,NULL,1587914829,NULL,NULL),(18,0,2,'','HeePHP','http://www.heephp.com',NULL,'',12,NULL,NULL,1587914856,NULL,NULL),(20,0,3,'','关于我们','#',NULL,'',1,'_blank',NULL,1589982765,NULL,NULL),(21,0,3,'','联系我们','#',NULL,'',2,'_blank',NULL,1589982788,NULL,NULL),(22,0,3,'','产品中心','#',NULL,'',3,'_blank',NULL,1589982818,NULL,NULL),(23,0,3,'','服务项目','#',NULL,'',4,'_blank',NULL,1589983279,NULL,NULL),(24,0,3,'','招贤纳士','#',NULL,'',5,'_blank',NULL,1589983298,NULL,NULL);

#
# Structure for table "heecms_link_group"
#

DROP TABLE IF EXISTS `heecms_link_group`;
CREATE TABLE `heecms_link_group` (
  `link_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `create_users_id` int(11) DEFAULT NULL,
  `disable` int(255) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`link_group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_link_group"
#

INSERT INTO `heecms_link_group` VALUES (1,'navlinks','导航菜单',1,0,1587762883,1589239277,NULL),(2,'friendlink','友情链接',1,0,1587913051,NULL,NULL),(3,'footnav','底部链接',1,0,1589982719,NULL,NULL);

#
# Structure for table "heecms_menus"
#

DROP TABLE IF EXISTS `heecms_menus`;
CREATE TABLE `heecms_menus` (
  `menus_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图标',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ord` int(255) DEFAULT '0' COMMENT '排序',
  `create_users_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`menus_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_menus"
#

/*!40000 ALTER TABLE `heecms_menus` DISABLE KEYS */;
INSERT INTO `heecms_menus` VALUES (5,0,'fas fa-link','链接','/','',3,1,1587761486,NULL,NULL),(6,5,'','链接管理','/link_group/manager','',1,1,1587761543,NULL,NULL),(8,0,'fas fa-columns','栏目','/','',1,1,1587761621,NULL,NULL),(9,8,'','栏目管理','/category/manager','',2,1,1587761691,NULL,NULL),(10,0,'fas fa-file-alt','信息','/','',2,1,1587761733,NULL,NULL),(11,10,'','信息管理','/category/managerinfo','',1,1,1587761857,1588294134,NULL),(12,0,'fab fa-modx','模型与表','/','',99,1,1588244382,1589939058,1608836380),(13,12,'','模型管理','/model/manager','',1,1,1588244418,NULL,1608836343),(14,12,'','数据表管理','/model_table/manager','',2,1,1588244441,NULL,1608836338),(15,0,'fab fa-facebook-messenger','反馈','/','',3,1,1588942737,1588943102,NULL),(16,15,'','评论管理','/comment/manager','',1,1,1588943137,NULL,NULL),(17,15,'','留言管理','/guestbook/manager','',2,1,1588943168,1588943196,NULL),(18,0,'fas fa-adjust','营销与优化','/','',5,1,1589584735,1589938296,NULL),(19,18,'','广告管理','/ad/manager','',1,1,1589584779,NULL,NULL),(20,18,'','网站优化','/seo/edit','',2,1,1589586359,NULL,NULL),(21,0,'fab fa-pagelines','模板','/','',6,1,1589938348,1589938373,NULL),(22,21,'','本地模板','/moban/manager','',1,1,1589938412,1600179784,NULL),(23,21,'','在线模板','http://moban.heecms.cn','',2,1,1589938437,1600179771,1600179819),(24,0,'fab fa-html5','页面','/','',7,1,1589939046,NULL,NULL),(25,24,'','页面管理','/page/manager','',1,1,1589939125,NULL,NULL),(26,24,'','新增页面','/page/add','',2,1,1589939157,NULL,NULL),(27,21,'','模板设置','/moban/setting','',2,1,1589949367,NULL,1600179737),(28,0,'fab fa-amazon-pay','支付','#','',8,1,1609364831,NULL,NULL),(29,28,'','订单管理','/order/manager','',1,1,1609364882,1609364928,NULL),(30,28,'','支付流水','/pay/manager','',2,1,1609366315,NULL,NULL),(31,21,'','官网模板','moban/online','',2,1,1609772637,NULL,NULL);
/*!40000 ALTER TABLE `heecms_menus` ENABLE KEYS */;

#
# Structure for table "heecms_message"
#

DROP TABLE IF EXISTS `heecms_message`;
CREATE TABLE `heecms_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `receiver_users_id` int(11) DEFAULT NULL,
  `all` int(1) DEFAULT NULL COMMENT '是否是所有人都接收',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `context` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isread` int(1) DEFAULT '0' COMMENT '是否已读  1已读 0未读',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`message_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_message"
#

/*!40000 ALTER TABLE `heecms_message` DISABLE KEYS */;
INSERT INTO `heecms_message` VALUES (3,2,1,0,'title','contet',1,1586695173,NULL,0),(4,3,1,0,'欢迎使用','欢迎使用！！',1,1587103078,1587103078,0);
/*!40000 ALTER TABLE `heecms_message` ENABLE KEYS */;

#
# Structure for table "heecms_order"
#

DROP TABLE IF EXISTS `heecms_order`;
CREATE TABLE `heecms_order` (
  `order_id` varchar(30) NOT NULL DEFAULT '',
  `sumprice` decimal(10,2) DEFAULT NULL COMMENT '总价',
  `sourceprice` decimal(10,2) DEFAULT NULL COMMENT '原价',
  `discount` decimal(10,2) DEFAULT NULL COMMENT '折扣',
  `create_users_id` int(11) DEFAULT NULL,
  `pcount` int(11) DEFAULT NULL COMMENT '商品总数',
  `state` int(2) DEFAULT '0' COMMENT '订单状态 -3已完成退款 -2已确认退款 -1申请退款 0未支付 1已支付未发货 2已发货未确认 3已确认未评论 4已评论完成',
  `address` varchar(255) DEFAULT NULL COMMENT '收件人地址',
  `mobile` varchar(255) DEFAULT NULL COMMENT '收件人手机',
  `contact` varchar(255) DEFAULT NULL COMMENT '收件人',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `paytype` varchar(255) DEFAULT NULL COMMENT '支付方式',
  `paysum` decimal(10,2) DEFAULT NULL COMMENT '支付金额',
  `paytime` int(11) DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_order"
#


#
# Structure for table "heecms_order_detail"
#

DROP TABLE IF EXISTS `heecms_order_detail`;
CREATE TABLE `heecms_order_detail` (
  `order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(30) DEFAULT NULL,
  `ptype` varchar(255) NOT NULL,
  `tid` int(11) NOT NULL,
  `num` int(11) DEFAULT NULL COMMENT '商品数量',
  `price` decimal(10,2) DEFAULT NULL COMMENT '商品单价',
  `sumprice` decimal(10,2) DEFAULT NULL COMMENT '总价',
  `create_users_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `state` int(1) NOT NULL DEFAULT '0',
  `stime` int(11) NOT NULL DEFAULT '0',
  `etime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_detail_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_order_detail"
#


#
# Structure for table "heecms_order_pay"
#

DROP TABLE IF EXISTS `heecms_order_pay`;
CREATE TABLE `heecms_order_pay` (
  `order_pay_id` varchar(30) NOT NULL DEFAULT '',
  `order_id` varchar(30) DEFAULT NULL,
  `state` int(1) DEFAULT NULL,
  `paytype` varchar(25) NOT NULL,
  `money` decimal(10,2) DEFAULT NULL,
  `restr` varchar(3000) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `create_users_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_pay_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_order_pay"
#


#
# Structure for table "heecms_pages"
#

DROP TABLE IF EXISTS `heecms_pages`;
CREATE TABLE `heecms_pages` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `body` text,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `create_users_id` int(11) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL COMMENT '路由',
  `price` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`pages_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_pages"
#

INSERT INTO `heecms_pages` VALUES (1,'111','&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;111 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;',NULL,1590026334,1590111699,1,'','','/page.php',NULL,NULL),(2,'111','&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;111 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;',1590026170,NULL,1590026216,NULL,'','','/page.php',NULL,NULL),(3,'111','&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;111 &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp;&lt;/p&gt;',1590026176,NULL,1590026212,NULL,'','','/page.php',NULL,NULL),(4,'title','&lt;p&gt;neirong neirong&amp;nbsp;&lt;/p&gt;',1590026277,1590111714,NULL,1,'keyword','miaoshu','/page','tpage',NULL);

#
# Structure for table "heecms_sys_resources"
#

DROP TABLE IF EXISTS `heecms_sys_resources`;
CREATE TABLE `heecms_sys_resources` (
  `sys_resources_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '标题',
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '路径 \\控制器\\方法',
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT '上级资源Id',
  `users_id` int(11) DEFAULT NULL COMMENT '创建人',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`sys_resources_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_sys_resources"
#

/*!40000 ALTER TABLE `heecms_sys_resources` DISABLE KEYS */;
INSERT INTO `heecms_sys_resources` VALUES (1,'用户管理','users','',0,1,1586476453,NULL,NULL),(2,'用户添加','/users/add','',1,1,1586476580,NULL,NULL),(3,'用户修改','/users/edit','',1,1,1586476617,NULL,NULL),(4,'用户保存','/users/save','',1,1,1586476661,NULL,NULL),(5,'用户删除','/users/delete','',1,1,1586476699,NULL,NULL),(6,'用户组管理','/users_group','',0,2,1586480307,NULL,NULL),(7,'用户组添加','/users_group/add','',6,2,1586480361,NULL,NULL),(8,'用户组修改','/users_group/edit','',6,3,1586480381,NULL,NULL),(9,'用户组删除','/users_group/delete','',6,1,1586480444,NULL,NULL),(10,'用户组保存','/users_group/save','',6,1,1586480471,NULL,NULL),(11,'用户管理','/users/manager','',1,1,1586481179,NULL,NULL),(12,'用户组管理','/users_group/manager','',6,1,1586481202,NULL,NULL),(13,'消息管理','message','',0,1,1586492696,NULL,NULL),(14,'消息管理','/message/manager','',13,1,1586492718,NULL,NULL),(15,'消息添加','/message/add','',13,1,1586492750,NULL,NULL),(16,'消息删除','/message/delete','',13,1,1586492777,NULL,NULL),(17,'资源管理','sys_resources','',0,1,1586492824,NULL,NULL),(18,'资源添加','/sys_resources/add','',17,1,1586492845,NULL,NULL),(19,'资源编辑','/sys_resources/edit','',17,1,1586492868,NULL,NULL),(20,'资源删除','/sys_resources/delete','',17,1,1586492912,NULL,NULL),(21,'资源保存','/sys_resources/save','',17,1,1586492933,NULL,NULL),(22,'资源管理','/sys_resources/manager','',17,1,1586492955,NULL,NULL),(23,'权限管理','users_group_sys_resources','',0,1,1586492989,NULL,NULL),(25,'权限保存','/users_group/save_sys_resource','',23,1,1586493060,NULL,NULL),(26,'菜单管理','menus','',0,1,1586493093,NULL,NULL),(27,'菜单管理','/menus/manager','',26,1,1586493120,NULL,NULL),(28,'菜单添加','/menus/add','',26,1,1586493150,NULL,NULL),(29,'菜单编辑','/menus/edit','',26,1,1586493169,NULL,NULL),(30,'菜单删除','/menus/delete','',26,1,1586493186,NULL,NULL),(31,'菜单保存','/menus/save','',26,1,1586493221,NULL,NULL),(32,'权限编辑','/users_group/sys_resource','',23,1,1586653522,NULL,NULL),(33,'消息编辑','/message/edit','',13,1,1586678131,NULL,NULL),(34,'消息保存','/message/save','',13,1,1586678174,NULL,NULL),(35,'系统设置功能','setting','',0,1,1586775690,NULL,NULL),(36,'系统设置','/index/setting','',35,1,1586775876,NULL,NULL),(37,'系统设置保存','/index/save_setting','',35,1,1586775902,NULL,NULL),(38,'消息详细','/message/detail','',13,1,1586776255,NULL,NULL),(39,'管理首页','/index/index','',35,1,1609903174,1609903351,NULL),(40,'栏目管理','#','',0,1,1609903925,NULL,NULL),(41,'栏目管理','/category/manager','',40,1,1609903935,NULL,NULL),(42,'栏目添加','/category/add','',40,1,1609904034,NULL,NULL),(43,'栏目编辑','/category/edit','',40,1,1609904052,NULL,NULL),(44,'栏目保存','/category/save','',40,1,1609904152,NULL,NULL),(45,'栏目删除','/category/delete','',40,1,1609904183,NULL,NULL),(46,'信息管理','/article','',0,1,1609904235,NULL,NULL),(47,'信息栏目管理','/category/managerinfo','',46,1,1609904249,1609904337,NULL),(48,'信息管理','/article/manager','',46,1,1609904322,NULL,NULL),(49,'信息添加','/article/add','',46,1,1609904376,NULL,NULL),(50,'信息编辑','/article/edit','',46,1,1609904393,NULL,NULL),(51,'信息保存','/article/save','',46,1,1609904409,NULL,NULL),(52,'信息删除','/article/delete','',46,1,1609904428,NULL,NULL),(53,'信息推荐','/article/recommend','',46,1,1609904470,NULL,NULL);
/*!40000 ALTER TABLE `heecms_sys_resources` ENABLE KEYS */;

#
# Structure for table "heecms_users"
#

DROP TABLE IF EXISTS `heecms_users`;
CREATE TABLE `heecms_users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `users_group_id` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL,
  `birthday` int(11) DEFAULT '0',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qq` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wechat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`users_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_users"
#

/*!40000 ALTER TABLE `heecms_users` DISABLE KEYS */;
INSERT INTO `heecms_users` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e','admin_','/upload/20210102/212d81fffdc88fa78a6bdbfd55b7924a.png',1,1,1609516800,'',1,'','121212','','','abc@qq.com','',1609732271,1609759731,NULL,2),(16,'wangyingzhe','e10adc3949ba59abbe56e057f20f883e','阿哲123',NULL,9,1,-28800,'',1,'','','','','w@w.com','',1609659577,1609759723,NULL,2);
/*!40000 ALTER TABLE `heecms_users` ENABLE KEYS */;

#
# Structure for table "heecms_users_group"
#

DROP TABLE IF EXISTS `heecms_users_group`;
CREATE TABLE `heecms_users_group` (
  `users_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isadmin` int(1) DEFAULT '0' COMMENT '是否是管理员  仅管理员可以登录后台',
  `create_users_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`users_group_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

#
# Data for table "heecms_users_group"
#

/*!40000 ALTER TABLE `heecms_users_group` DISABLE KEYS */;
INSERT INTO `heecms_users_group` VALUES (1,'超级管理员','',1,1,NULL,NULL,NULL),(2,'管理员','',1,1,NULL,NULL,NULL),(8,'管理员Test','',1,2,1587087745,NULL,0),(9,'新手上路',NULL,0,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `heecms_users_group` ENABLE KEYS */;

#
# Structure for table "heecms_users_group_sys_resources"
#

DROP TABLE IF EXISTS `heecms_users_group_sys_resources`;
CREATE TABLE `heecms_users_group_sys_resources` (
  `users_group_sys_resources_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_group_id` int(11) DEFAULT NULL,
  `sys_resources_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`users_group_sys_resources_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=421 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

#
# Data for table "heecms_users_group_sys_resources"
#

/*!40000 ALTER TABLE `heecms_users_group_sys_resources` DISABLE KEYS */;
INSERT INTO `heecms_users_group_sys_resources` VALUES (1,2,2),(2,2,3),(4,2,5),(5,2,11),(6,2,7),(7,2,8),(8,2,9),(9,2,12),(10,2,14),(11,2,27),(12,2,2),(13,2,3),(14,2,5),(15,2,11),(16,2,7),(17,2,8),(18,2,9),(19,2,12),(20,2,14),(21,2,27),(22,2,2),(23,2,3),(24,2,5),(25,2,11),(26,2,7),(27,2,8),(28,2,9),(29,2,12),(30,2,14),(31,2,18),(32,2,27),(33,2,2),(34,2,3),(35,2,5),(36,2,11),(37,2,7),(38,2,8),(39,2,9),(40,2,12),(41,2,14),(42,2,18),(43,2,21),(44,2,27),(45,2,2),(46,2,3),(47,2,5),(48,2,11),(49,2,7),(50,2,8),(51,2,9),(52,2,12),(53,2,14),(54,2,18),(55,2,19),(56,2,21),(57,2,22),(58,2,27),(63,2,2),(64,2,3),(65,2,4),(66,2,5),(67,2,11),(68,2,7),(69,2,8),(70,2,9),(71,2,10),(72,2,12),(73,2,14),(74,2,15),(75,2,18),(76,2,19),(77,2,20),(78,2,21),(79,2,22),(80,2,27),(85,2,2),(86,2,3),(87,2,4),(88,2,5),(89,2,11),(90,2,7),(91,2,8),(92,2,9),(93,2,10),(94,2,12),(95,2,14),(96,2,15),(97,2,18),(98,2,19),(99,2,20),(100,2,21),(101,2,22),(103,2,27),(108,2,2),(109,2,3),(110,2,4),(111,2,5),(112,2,11),(113,2,7),(114,2,8),(115,2,9),(116,2,10),(117,2,12),(118,2,14),(119,2,15),(120,2,18),(121,2,19),(122,2,20),(123,2,21),(124,2,22),(125,2,27),(130,2,36),(131,2,2),(132,2,3),(133,2,4),(134,2,5),(135,2,11),(136,2,7),(137,2,8),(138,2,9),(139,2,10),(140,2,12),(141,2,14),(142,2,15),(143,2,16),(144,2,33),(145,2,34),(146,2,38),(147,2,18),(148,2,19),(149,2,20),(150,2,21),(151,2,22),(152,2,25),(154,2,27),(159,2,36),(161,2,2),(162,2,3),(163,2,4),(164,2,5),(165,2,11),(166,2,7),(167,2,8),(168,2,9),(169,2,10),(170,2,12),(171,2,14),(172,2,15),(173,2,16),(174,2,33),(175,2,34),(176,2,38),(177,2,18),(178,2,19),(179,2,20),(180,2,21),(181,2,22),(182,2,25),(184,2,27),(189,2,36),(191,2,2),(192,2,3),(193,2,4),(194,2,5),(195,2,11),(196,2,7),(197,2,8),(198,2,9),(199,2,10),(200,2,12),(201,2,14),(202,2,15),(203,2,16),(204,2,33),(205,2,34),(206,2,38),(207,2,18),(208,2,19),(209,2,20),(210,2,21),(211,2,22),(212,2,25),(214,2,27),(216,2,36),(217,2,2),(218,2,3),(219,2,4),(220,2,5),(221,2,11),(222,2,7),(223,2,8),(224,2,9),(225,2,10),(226,2,12),(227,2,14),(228,2,15),(229,2,16),(230,2,33),(231,2,34),(232,2,38),(233,2,18),(234,2,19),(235,2,20),(236,2,21),(237,2,22),(238,2,25),(239,2,27),(240,2,36),(241,2,2),(242,2,3),(243,2,4),(244,2,5),(245,2,11),(246,2,7),(247,2,8),(248,2,9),(249,2,10),(250,2,12),(251,2,14),(252,2,15),(253,2,16),(254,2,33),(255,2,34),(256,2,38),(257,2,18),(258,2,19),(259,2,20),(260,2,21),(261,2,22),(262,2,25),(263,2,27),(264,2,36),(265,2,2),(266,2,3),(267,2,4),(268,2,5),(269,2,11),(270,2,7),(271,2,8),(272,2,9),(273,2,10),(274,2,12),(275,2,14),(276,2,15),(277,2,16),(278,2,33),(279,2,34),(280,2,38),(281,2,18),(282,2,19),(283,2,20),(284,2,21),(285,2,22),(286,2,25),(287,2,27),(290,2,36),(291,2,2),(292,2,3),(293,2,4),(294,2,5),(295,2,11),(296,2,7),(297,2,8),(298,2,9),(299,2,10),(300,2,12),(301,2,14),(302,2,15),(303,2,16),(304,2,33),(305,2,34),(306,2,38),(307,2,18),(308,2,19),(309,2,20),(310,2,21),(311,2,22),(312,2,25),(313,2,27),(314,2,36),(315,2,2),(316,2,3),(317,2,4),(318,2,5),(319,2,11),(320,2,7),(321,2,8),(322,2,9),(323,2,10),(324,2,12),(325,2,14),(326,2,15),(327,2,16),(328,2,33),(329,2,34),(330,2,38),(331,2,18),(332,2,19),(333,2,20),(334,2,21),(335,2,22),(336,2,25),(337,2,27),(338,2,36),(339,2,2),(340,2,3),(341,2,4),(342,2,5),(343,2,11),(344,2,7),(345,2,8),(346,2,9),(347,2,10),(348,2,12),(349,2,14),(350,2,15),(351,2,16),(352,2,33),(353,2,34),(354,2,38),(355,2,18),(356,2,19),(357,2,20),(358,2,21),(359,2,22),(360,2,25),(361,2,27),(362,2,30),(363,2,36),(364,2,2),(365,2,3),(366,2,4),(367,2,5),(368,2,11),(369,2,7),(370,2,8),(371,2,9),(372,2,10),(373,2,12),(374,2,14),(375,2,15),(376,2,16),(377,2,33),(378,2,34),(379,2,38),(380,2,18),(381,2,19),(382,2,20),(383,2,21),(384,2,22),(385,2,25),(386,2,27),(387,2,30),(388,2,36),(389,2,37),(390,8,19),(391,8,19),(392,8,18),(393,8,19),(394,2,2),(395,2,3),(396,2,4),(397,2,5),(398,2,11),(399,2,7),(400,2,8),(401,2,9),(402,2,10),(403,2,12),(404,2,14),(405,2,15),(406,2,16),(407,2,33),(408,2,34),(409,2,38),(410,2,18),(411,2,19),(412,2,20),(413,2,21),(414,2,22),(415,2,25),(416,2,27),(417,2,28),(418,2,30),(419,2,36),(420,2,37);
/*!40000 ALTER TABLE `heecms_users_group_sys_resources` ENABLE KEYS */;
