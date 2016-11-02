
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
        'emotion',
     ];
      editor.create();
      // 创建编辑器
      editor.$txt.html('<p><br></p>');
      // 清空编辑器
