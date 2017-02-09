/**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-27
* @Content: 交友论坛--更多朋友界面js
* @Last Modified time: 2016-11-27
* ================================================
*/
window.onload = function() {
    var oResult = document.getElementById('result');
    var oHeart = oResult.getElementsByTagName('span');


    // 遍历
    for (var i = 0; i < oHeart.length; i++) {
        // 给每一个按钮一个索引
        oHeart[i].index = i;
        oHeart[i].flag = 0;
        oHeart[i].onclick = function() {
            if (oHeart[this.index].style.color == '' || oHeart[this.index].style.color == 'rgb(216, 216, 216)') {
                oHeart[this.index].style.color = "#f00";
            }
            else {
                oHeart[this.index].style.color = '#d8d8d8';
            }
        }
    }
    var search = document.getElementById('search');
    var select = document.getElementById('gender');
    search.onclick = function(){
        if(select.value != ''){
        window.location = "moreFriends.php?gender=" + select.value;
        }
    }

};

