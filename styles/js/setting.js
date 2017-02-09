/**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-17
* @Content: 顶部公用导航active相关js
* @Last Modified time: 2016-11-17
* ================================================
*/
window.onload = function() {
    var oUl = document.getElementById('ul1');
    var oLi = oUl.getElementsByTagName('li');

    for (var i = 0; i < oLi.length; i++) {
            // 给每一个按钮一个索引
            oLi[i].index = i;
            oLi[i].onclick = function() {
                for(var i = 0; i < oLi.length; i++) {
                    // 先给所有按钮的样式设置为空
                    oLi[i].className = '';
                }
                // 给当前按钮的class设置为active(被选中的)
                this.className = 'active1';
            }
        }
}
