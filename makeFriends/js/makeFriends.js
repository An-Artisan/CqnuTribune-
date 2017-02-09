/**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-15
* @Content: 交友论坛--js
* @Last Modified time: 2016-12-11
* ================================================
*/
layui.use('layer', function(){
layer.config({extend:'../../styles/moon/style.css'});
// 引用表情
layer.config({

    skin:'layer-ext-moon',

    extend:'../../styles/moon/style.css'

});
});
// 引用表情
window.onload = function() {
    var list = document.getElementById('list');
    var lis = list.children;
    var timer;


    // 删除节点
    function removeNode(node) {
        node.parentNode.removeChild(node);
    };

    // 点赞
    function praiseBox(box, el) {
        var praiseElement = box.getElementsByClassName('praise-total')[0];
        var oldTotal = parseInt(praiseElement.getAttribute('total'));
        var txt = el.innerHTML;
        var newTotal;

        if (txt == '赞') {
            $.ajax({  
              type : "post",  
              url : "../backStage/TreeHolePraise.php", 
              dataType:'json',
              data : {
                    praiseName:$('#user').text(),treeHoleId:$(box).children('div').children('span').text()
                    // 传点赞人和树洞发布人的ID
                },
              async : true,  
              // 是否异步，默认是true
              success : function(data){  
               if(data.state==0){
                layer.confirm('系统繁忙，请登录后再试~', {
                btn: ['确定'], //按钮
                icon: 5
                }, function(){
                location.reload(true);
                });
                }
              }  
            // 调用失败后，给用户提醒然后刷新页面
            });
            newTotal = oldTotal + 1;
            praiseElement.innerHTML = (newTotal == 1) ? '我觉得很赞' : '我和' + oldTotal + '个人觉得很赞';
            el.innerHTML = '已赞';
        }
        else {
            // newTotal = oldTotal - 1;
            // praiseElement.innerHTML = (newTotal == 0) ? '' : newTotal + '个人觉得很赞';
            // el.innerHTML = '赞';
            return false;
        }
        praiseElement.setAttribute('total', newTotal);
        praiseElement.style.display = (newTotal == 0) ? 'none' : 'block';
    };

    // 发表评论/点击回复按钮
    function replayBox(box) {
        if(!$('#user').size()>0){
        layer.confirm('您还未登陆，所以不能回复树洞，请先登录~', {
            btn: ['确定'], //按钮
            icon: 5
            });
        return false;
        }
        // 判断用户是否登录，如果没有登录。那么给用户提示不能回复树洞
        var treeHoleId = $(box).prev().children('span').text();
        // 获取当前树洞的id
        var senderName = $('#user').text();
        // 获取当前用户   
        var textarea = box.getElementsByTagName('textarea')[0];
        var lis = box.getElementsByClassName('comment')[0];
        var li = document.createElement('div');
        var newDiv = document.getElementById("newDiv");
        
        if (newDiv) {
            var p = document.createElement('p');
            p.innerHTML = '回复' + newDiv.innerHTML;
        }
        else {
            var p = document.createElement('p');
            p.innerHTML = '';
        }

// textarea.value = '回复' + user.innerHTML;
       
        li.className = 'part row';
        li.setAttribute('user', 'self');

        var html = '<div class="col-md-1 col-sm-1 col-xs-1">'
                 + '<img class="head1" src="../../register/img/' + $('#u_photo').text() +'" alt="">'
                 + '</div>'
                 + '<div class="specific col-md-11">'
                 + '<p class="line"><span class="user">' + $('#user').text() + '</span>' + p.innerHTML + textarea.value + '</p>'
                 + '<div class="info1">'
                 + '<p class="time">' + getTime() + '</p>'
                 + '</div>'
                 + '</div>'
        li.innerHTML = html;    
        lis.appendChild(li);
        if(!p.innerHTML == ''){
         var newDiv = document.getElementById('newDiv');
         $.ajax({  
         type : "post",  
          url : "../backStage/eachReply.php", 
          dataType:'json',
          data : {
                content: textarea.value,senderName: senderName,getterName: $.trim(newDiv.innerHTML),treeHoleId:treeHoleId
                // 传回复的内容以及回复人和树洞发布人的ID
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('回复'+newDiv.innerHTML+'成功~', {
            btn: ['确定'], //按钮
            icon: 1
            });
            }
            else {
            layer.confirm('回复'+newDiv.innerHTML+'树洞失败,稍后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            location.reload(true);
            });
            }
          }  
        // 调用成功或者失败后，给用户提醒然后刷新页面
        });
        textarea.value = '';
        textarea.onblur();
        // newDiv.parentNode.removeChild(newDiv);
        // 评论树洞
    }else{
           $.ajax({  
         type : "post",  
          url : "../backStage/replyTreeHole.php", 
          dataType:'json',
          data : {
                content: textarea.value,senderName: senderName,treeHoleId:treeHoleId
                // 传回复的内容以及回复人和树洞发布人的ID
            },
          async : true,  
          // 是否异步，默认是true
          success : function(data){  
           if(data.state!=0){
            layer.confirm('回复树洞成功~', {
            btn: ['确定'], //按钮
            icon: 1
            });
            }
            else {
            layer.confirm('发布树洞失败,稍后再试~', {
            btn: ['确定'], //按钮
            icon: 5
            }, function(){
            location.reload(true);
            });
            }
          }  
        // 调用成功或者失败后，给用户提醒然后刷新页面
        });
        textarea.value = '';
        textarea.onblur();
        // newDiv.parentNode.removeChild(newDiv);
         }
         // 树洞里面的互相回复
        }
     

        // 操作回复或者删除
    function operateReply(el) {
        // 评论容器
        var commentBox = el.parentNode.parentNode.parentNode;
        // 分享容器
        var box = commentBox.parentNode.parentNode.parentNode.parentNode;
        var textarea = box.getElementsByTagName('textarea')[0];
        var user = commentBox.getElementsByClassName('user')[0];
        var txt = el.innerHTML;

        var box2 = el.parentNode.parentNode;
        var span = box2.getElementsByTagName('span')[0];

        if (txt == '回复') {
            // 创建一个新节点
            if (!document.getElementById('newDiv')) {
                var newDiv = document.createElement('div');
                newDiv.id = 'newDiv';
                newDiv.innerHTML = span.innerHTML;
                textarea.parentNode.insertBefore(newDiv, textarea.nextSibling);
            }
            else {

                var newDiv = document.getElementById('newDiv');

                if (newDiv.innerHTML == span.innerHTML) {
                    return false
                }
                else {
                    newDiv.innerHTML = span.innerHTML;
                }
            }
            textarea.onfocus();
            textarea.value = '';
            textarea.onkeyup();
        }
        else {
            $.ajax({  
              type : "post",  
              url : "../backStage/deleteReply.php", 
              dataType:'json',
              data : {
                    p_id: $(commentBox).attr('id')
                    // 传回复的内容以及回复人和树洞发布人的ID
                },
              async : true,  
              // 是否异步，默认是true
              success : function(data){  
               if(data.state!=0){
                layer.confirm('删除回复成功~', {
                btn: ['确定'], //按钮
                icon: 1
                });
                }
                else {
                layer.confirm('删除回复失败,稍后再试~', {
                btn: ['确定'], //按钮
                icon: 5
                }, function(){
                location.reload(true);
                });
                }
              }  
            // 调用成功或者失败后，给用户提醒然后刷新页面
            });
            
            removeNode(commentBox);

        }
    };


    // 获取时间
    function getTime() {
        var t = new Date();
        var y = t.getFullYear();
        var m = t.getMonth() + 1;
        var d = t.getDay();
        var h = t.getHours();
        var mi = t.getMinutes();
        var s = t.getSeconds();

        m = m < 10 ? '0' + m : m;
        d = d < 10 ? '0' + d : d;
        h = h < 10 ? '0' + h : h;
        s = s < 10 ? '0' + s : s;
        mi = mi < 10 ? '0' + mi : mi;

        return y + '-' + m + '-' + d + ' ' + h + ':' + mi + ':' + s;
    };

    // 点赞
   function praiseReply(el) {
        var oldTotal = parseInt(el.getAttribute('total'));
        var my = parseInt(el.getAttribute('my'));
        var newTotal;
        var commentBox = el.parentNode.parentNode.parentNode;
        // 分享容器
        if (my == 0) {
            $.ajax({  
              type : "post",  
              url : "../backStage/eachReplyPriase.php", 
              dataType:'json',
              data : {
                    praiseName:$('#user').text(),p_id: $(commentBox).attr('id')
                    // 传回复的内容以及回复人和树洞发布人的ID
                },
              async : true,  
              // 是否异步，默认是true
              success : function(data){  
               if(data.state==0){
                layer.confirm('系统繁忙，请稍后再试~', {
                btn: ['确定'], //按钮
                icon: 5
                }, function(){
                location.reload(true);
                });
                }
              }  
            // 调用成功或者失败后，给用户提醒然后刷新页面
            });
            newTotal = oldTotal + 1;
            el.setAttribute('total', newTotal);
            el.setAttribute('my', 1);
            el.innerHTML = newTotal + '赞/已赞';
        }
        else {
            return false;
        }
        el.style.display = (newTotal == 0) ? '' : 'inline-block';
    };

    // 评论的隐藏与显示
    function commentReply(el) {
        var oParent = el.parentNode.parentNode.parentNode.parentNode;
        var commentM = oParent.getElementsByClassName('comment-main')[0];
        if(!$('#user').size()>0){
            layer.confirm('您还未登陆，所以不能回复树洞，请先登录~', {
            btn: ['确定'], //按钮
            icon: 5
            });
        return false;
        }
        if(commentM.style.display == 'block') {
            commentM.style.display = 'none';
            el.innerHTML = '全部评论';
        }
        else {
            commentM.style.display = 'block';
            el.innerHTML = '收起评论';
        }
    };

    for (var i = 0; i < lis.length; i++) {
        lis[i].onclick = function(e) {
            e = e || window.event;
            //获取当前所点击元素
            var el = e.srcElement || e.target;
            switch (el.className) {
                //关闭功能
                case 'close': removeNode(el.parentNode);
                break;

                //点赞功能
                //追溯到最上层的父容器 也就是box
                case 'praise': praiseBox(el.parentNode.parentNode.parentNode.parentNode, el);
                break;

                //回复按钮禁用时：点击按钮文本框不发生改变：清除定时器
                case 'btn btn-primary btn-sm btn-off': clearTimeout(timer);
                break;

                //回复按钮蓝色时：
                //获取box父节点
                case 'btn btn-primary btn-sm': replayBox(el.parentNode.parentNode.parentNode.parentNode);
                break;

                //赞回复
                case 'comment-praise': praiseReply(el);
                break;

                //评论回复/删除
                case 'comment-operate': operateReply(el);
                break;

                //评论展开与隐藏
                case 'comment-more': commentReply(el);
                break;
            }
        };

        // 文本输入框获取焦点的展开与关闭
        var textarea = lis[i].getElementsByTagName('textarea')[0];
        textarea.onfocus = function() {
            this.className = 'form-control form-control1-on';
            this.value = this.value == '评论...' ? '' : this.value;
            this.onkeyup();
        };
        textarea.onblur = function() {
            var me = this;

            if (this.value == '') {
                timer = setTimeout(function() {
                    me.className = 'form-control form-control1';
                    me.value = '评论...';
                }, 400);
            }
        };

        // 文本输入按钮的禁用与开启
        textarea.onkeyup = function() {
            var len = this.value.length;
            var p = this.parentNode;

            var btn = p.getElementsByTagName('button')[0];
            var word = p.getElementsByTagName('span')[0];

            if (len == 0 || len > 140) {
                btn.className = 'btn btn-primary btn-sm btn-off';
            }
            else {
                btn.className = 'btn btn-primary btn-sm';
            }
            word.innerHTML = len + '/140';
        };
    }
};
