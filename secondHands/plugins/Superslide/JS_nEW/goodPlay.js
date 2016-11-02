/**
* ================================================
* title：goodPlay.js
* time: 2016-10-7
* author: 杨凤玲
* content: details.html最上方商品轮播相关js
* ================================================
*/
        /*鼠标移过，左右按钮显示*/
        jQuery(".focusBox").hover(function(){ jQuery(this).find(".prev,.next").stop(true,true).fadeTo("show",0.2) },function(){ jQuery(this).find(".prev,.next").fadeOut() });
        /*SuperSlide图片切换*/
        jQuery(".focusBox").slide({ mainCell:".pic",effect:"leftLoop", autoPlay:true, delayTime:600});
