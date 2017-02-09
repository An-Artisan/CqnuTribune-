/**
* ================================================
* @Author: 杨凤玲
* @Date: 2016-11-7
* @Content: 后台管理系统image.htmk js
* @Last Modified time: 2016-11-8
* ================================================
*/
window.onload = function () {

    // 图像上传
    var input = document.getElementById('input1');
    input.onchange =  function () {
        var preview = document.getElementById('img1')
        var file  = document.getElementById('input1').files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
            preview.style.width = '120px';
            preview.style.height = '120px;';
        }
        else {
            preview.src = "";
        }
    }
};
