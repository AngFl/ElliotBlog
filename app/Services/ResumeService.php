<?php
/**
 *
 */

namespace App\Services;


class ResumeService
{
    protected $item;

    /**
     * ResumeService constructor.
     * @param $item
     */
    public function __construct($item = null)
    {
        $this->item = $item;
    }

    public function getResume()
    {
        $profile = "###王扶林 


- 男/ 1994
- Email：linframe@outlook.com 
- 个人博客:[ http://stardustio.me ](http://stardustio.me)
- segmentFault : https://segmentfault.com/u/render

---

### 停车场微信代扣支付系统
简介：基于微信委托代扣为用户的高效出车提供缴费便利


- [微信智慧生活行业笔记分享](https://mp.weixin.qq.com/s?__biz=MjM5NTE4Njc4NQ==&mid=2657610974&idx=1&sn=b923c5e49a8cbcba8f1d4c724ff6684c)



---
###教育背景
#####2012.09 - 2016.07&#8194;&#8194;河北师范大学&#8194;&#8194;软件学院&#8194;&#8194;软件工程&#8194;&#8194;本科
 
---

###专业技能
-  **```C、PHP7 ```**
-  **``ECMAScript 6``** 、**``Semantic-UI``**, 等前端框架, **``Gulp``** 等前端构建工具
-  **```Linux(Ubuntu)/Mac```**开发环境，**``Vagrant``** 虚拟化 **``HomeStead``** 。
-  版本控制工具：**``SVN/Git``**。
-  PHP框架：**``Laravel``**、**``Slim``**。
-  开放平台：微博开放平台/微信应用开发

---

###Keywords
**``PHP``** | **``PHP7``**| **``ECMAScript``** |**`` Semantic UI``** | **```Linux(Ubuntu)/Mac```** | **``Laravel``** | **``Slim``** | **``Kali Linux 渗透测试``** |  **``Markdown ``**



---

### 关于博客

>作为一个开发者的博客，总得需要一些开发者该有的特性：

- 发表文章和话题，已经评论都是支持Markdown格式。
- 使用交互方式更好的 实时评论功能
- 用户可以选择对内容不错的文章点赞
- 定时筛选出内容较好的文章，或者话题放置在推荐列表中
- 有好的文章和内容可以对订阅的用户进行推送 （目前可能功能实现是借助 **SendCloud** , 以后会逐渐优化~）

>有关博客的问题，我希望大家在使用的时候可以多看看~
   
- 虽然说目前还没有上线太多功能，但是还是希望大家可以遵守一点点规则。 不要做一些无聊的事，不要发广告，我会人工审核。
- 希望发表话题或者文章的用户负责任一点，在提问之前最好把问题产生的背景，尝试过的解决方案和你的预期写出来，如果有必要贴代码，**不要使用图片**，直接贴，直接贴，直接贴~
- 其实真的发表话题或博客的时候不必要使用 **大神**， **小弟** 等词，也不用写多谢，就认认真真描述你的问题和疑惑。
    
>todo 
    
- 文章推送至订阅用户的邮箱中
- Slim 开发录制视频教程
- 站内信的使用，新浪微博，以及后续微信登录等
    


>致谢

**SegmentFault** 开源的编辑器 ： https://github.com/Integ/BachEditor

**SegmentFault** 开源的Markdown解析HyperDown ： https://github.com/SegmentFault/HyperDown

**Coding** 代码托管平台。 个人的博客代码托管在上面：https://coding.net/

**阿里云** ：http://www.aliyun.com/

感谢上面的产品让我可以快速地完成个人博客的开发
                            
                        ";

        return $profile;
    }

}