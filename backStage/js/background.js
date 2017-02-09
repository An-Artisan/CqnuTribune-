/**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-10-30
* @Content: 后台管理系统的js
* @Last Modified time: 2016-11-13
* ================================================
*/

window.onload = function() {

    // 1.左侧点击菜单的显示与隐藏事件
    var oUl1 = document.getElementById('ul1')
    var oDiv = oUl1.getElementsByTagName('div');
    var oUl = oUl1.getElementsByTagName('ul');


    // 遍历
    for (var i = 0; i < oDiv.length; i++) {
        // 给每一个按钮一个索引
        oDiv[i].index = i;
        // var iHeight = oDiv[i].offsetHeight;

        oDiv[i].onclick = function() {
            if(oUl[this.index].style.display == 'block') {
                oUl[this.index].style.display = 'none';
            }
            else {
                oUl[this.index].style.display = 'block';
            }
        }
    }

    // 当前菜单栏文字变色
    var oA = oUl1.getElementsByTagName('a');
    var oSpan = oUl1.getElementsByTagName('span')

    for (var i = 0; i < oA.length; i++) {
        oA[i].index = i;
        oA[i].onclick = function() {
            for (var i = 0; i < oA.length; i++) {
                oA[i].style.color = '#c2ccd6';
            }
            this.style.color = '#fff';
        }
    }
};
