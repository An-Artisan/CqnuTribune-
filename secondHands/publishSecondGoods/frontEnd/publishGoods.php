<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="../../css/ch-ui.admin.css">
    <link rel="stylesheet" href="../../font/css/font-awesome.min.css">
    <script type="text/javascript" src="../../../styles/layui/layui.js"></script>
    <script type="text/javascript" src="../../../styles/js/jquery-3.1.1.min.js"></script>
    <script src="../../../styles/js/loading.js"></script>
    <script type="text/javascript" src="js/publishGoods.js"></script>
</head>
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <i class="fa fa-home"></i> <a href="#">个人中心</a> &raquo; <a href="#">二手市场</a> &raquo; 商品发布
    </div>
    <!--面包屑导航 结束-->
    <div class="result_wrap">
        <form action="../backStage/publishGoods.php" onsubmit="return checkInput();" method="post" enctype="multipart/form-data">
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>商品分类：</th>
                        <td>
                            <select id="select_top_category" name="top_category">
                                <option value="0">==请选择==</option>
                                <?php 
                                    require '../../../cqnu.class/all.class/all.class.php';
                                    // 引入所有类
                                    $select = Select::create_singleton();
                                    // 获得查询对象
                                    $sql = "select * from secondhand.goods_top_type order by top_sort";
                                    // 查询所有的分类(这里主要是有可能管理员会添加分类)
                                    $result = $select->select($sql);
                                    // 得到结果集
                                    while($data = mysqli_fetch_object($result)) {
                                ?>
                                <option value="<?php echo $data->top_category;?>"><?php echo $data->top_name; }?></option>
                                <!-- 输出所有分类 -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>标题：</th>
                        <td>
                            <input type="text" id="title" class="lg" name="title">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>价格：</th>
                        <td>
                            <input type="text" id="price" class="sm" name="price">元
                            <p>现在售价</p>
                        </td>
                    </tr>
                     <tr>
                        <th><i class="require">*</i>原价：</th>
                        <td>
                            <input type="text" id="prime_cost" class="sm" name="prime_cost">元
                            <p>买来的原价</p>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>可否小刀：</th>
                        <td>
                            <select id="select_bargained" name="bargained">
                                <option value="0">==请选择==</option>
                                <option value="可小刀">可小刀</option>
                                <option value="一口价">一口价</option>
                            </select>
                        </td>
                    </tr>
                    <tr >
                        <th><i class="require">*</i>商品图片：</th>
                        <td>
                        <input type="file" id="pic" name="pic[]"  onchange="selfile();" multiple />
                        <!-- 当上传图片的状态改变时，出发selfile函数，用HTML5 files新特性显示到静态页面 -->
                        <p>PS:可一次性选择多张图片</p>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>所在地点：</th>
                        <td>
                            <select id="select_address" name="address">
                                <option value="0">==请选择==</option>
                                <?php 
                                    $select = Select::create_singleton();
                                    // 获取查询对象
                                    $sql = "select * from secondhand.goods_address order by address_sort";
                                    // 查询所有的地址(也有可能后台会添加地址)
                                    $result = $select->select($sql);
                                    // 获得结果集
                                    while($data = mysqli_fetch_object($result)) {
                                ?>
                                <option value="<?php echo $data->address_id;?>"><?php echo $data->address_name; }?></option>
                                <!-- 输出所有地址 -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>商品描述：</th>
                        <td>
                            <textarea class="lg" id="description" name="description"></textarea>
                            <p>商品的详细信息</p>
                            <p id="append"></p>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" name="submit" value="发布">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

</body>
</html>