
/**
* ================================================
* title：userDefined.js
* time: 2016-10-11
* author: 杨凤玲
* content: wangEditor插件中设置菜单栏图标的个数
* ================================================
*/

    var editor = new wangEditor('div1');

    // 普通的自定义菜单
    editor.config.menus = [
        'source',
        '|',
        'bold',
        'underline',
        'italic',
        'strikethrough',
        'eraser',
        'forecolor',
        'bgcolor',
        '|',
        'quote',
        'fontfamily',
        'fontsize',
        '|',
        'link',
        'unlink',
        'emotion',
        '|',
        'img',
     ];

     // 仅仅想移除某几个菜单，例如想移除『插入代码』和『全屏』菜单：
     // 其中的 wangEditor.config.menus 可获取默认情况下的菜单配置
     // editor.config.menus = $.map(wangEditor.config.menus, function(item, key) {
     //     if (item === 'insertcode') {
     //         return null;
     //     }
     //     if (item === 'fullscreen') {
     //         return null;
     //     }
     //     return item;
     // });

      editor.config.uploadImgUrl = 'http://localhost/CqnuTribune/chatRoom/backStage/upload.php';
      // 添加上传图片后台地址
      editor.config.hideLinkImg = true;
      // 隐藏网络路径图片引用功能
      editor.config.uploadImgFileName = 'myFileName';
      // 设置拖拽，复制，上传图片的共同FileName为'myFileName' 方便统一
      editor.create();
      // 创建编辑器
      editor.$txt.html('<p><br></p>');
      // 清空编辑器
