/**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-7
* @Content: 后台管理系统
* @Last Modified time: 2016-11-8
* ================================================
*/
window.onload = function () {
    // 删除：
    var oTab = document.getElementById('tab1');
    var oA = oTab.getElementsByTagName('a');

    // 遍历
    for (var i = 0; i < oA.length; i++) {
        // 给每一个按钮一个索引
        oA[i].index = i;
        if (oA[i].index % 2 !== 0) {
            oA[i].onclick = function() {
                var r = confirm("确定要删除该项吗？");
                if (r == true) {
                    oTab.tBodies[0].removeChild(this.parentNode.parentNode);
                }
                else {
                    return false;
                }
            }
        };
    }
};
