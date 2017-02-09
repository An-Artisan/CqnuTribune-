/**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-15
* @Content: 交友论坛--js
* @Last Modified time: 2016-11-17
* ================================================
*/
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
            newTotal = oldTotal + 1;
            praiseElement.innerHTML = (newTotal == 1) ? '我觉得很赞' : '我和' + oldTotal + '个人觉得很赞';
            el.innerHTML = '取消赞';
        }
        else {
            newTotal = oldTotal - 1;
            praiseElement.innerHTML = (newTotal == 0) ? '' : newTotal + '个人觉得很赞';
            el.innerHTML = '赞';
        }
        praiseElement.setAttribute('total', newTotal);
        praiseElement.style.display = (newTotal == 0) ? 'none' : 'block';
    };

    // 自己发表评论
    function replayBox(box) {
        var textarea = box.getElementsByTagName('textarea')[0];
        var lis = box.getElementsByClassName('comment')[0];
        var li = document.createElement('div');

        li.className = 'part row';
        li.setAttribute('user', 'self');

        var html = '<div class="col-md-1">'
                 + '<img class="head1" src="../img/tx2.jpg" alt="">'
                 + '</div>'
                 + '<div class="specific col-md-11">'
                 + '<p class="line"><span class="name">我：</span>' + textarea.value + '</p>'
                 + '<div class="info1">'
                 + '<p class="time">' + getTime() + '</p>'
                 + '<a href="javascript:;" class="comment-operate">删除</a>'
                 + '</div>'
                 + '</div>'

         li.innerHTML = html;
         lis.appendChild(li);
         textarea.value = '';
         textarea.onblur();

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

    // 赞回复
   function praiseReply(el) {
        var oldTotal = parseInt(el.getAttribute('total'));
        var my = parseInt(el.getAttribute('my'));
        var newTotal;

        if (my == 0) {
            newTotal = oldTotal + 1;
            el.setAttribute('total', newTotal);
            el.setAttribute('my', 1);
            el.innerHTML = newTotal + ' 取消赞';
        }
        else {
            newTotal = oldTotal - 1;
            el.setAttribute('total', newTotal);
            el.setAttribute('my', 0);
            el.innerHTML = (newTotal == 0) ? '赞' : newTotal + ' 赞';
        }
        el.style.display = (newTotal == 0) ? '' : 'inline-block';
    };

    // 操作回复或者删除
    function operateReply(el) {
        // 评论容器
        var commentBox = el.parentNode.parentNode.parentNode;
        // 分享容器
        var box = commentBox.parentNode.parentNode.parentNode.parentNode;
        var textarea = box.getElementsByTagName('textarea')[0];
        var user = commentBox.getElementsByClassName('user')[0];
        var txt = el.innerHTML;

        if (txt == '回复') {
            textarea.onfocus();
            textarea.value = '回复' + user.innerHTML;
            textarea.onkeyup();
        }
        else {
            removeNode(commentBox);
        }
    };

    // 评论的隐藏与显示
    function commentReply(el) {
        var oParent = el.parentNode.parentNode.parentNode.parentNode;
        var commentM = oParent.getElementsByClassName('comment-main')[0];

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
            var btn = p.children[1];
            var word = p.children[2];

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
