<?php if (!defined('THINK_PATH')) exit();?><div id="goods1">
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h4>图片预览</h4>
        </div>
        <div class="modal-body">
            <p>
                <div id="showimg">
                </div>
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" id="<?php echo ($pref); ?>_modifyimg_add" class="btn btn-small btn-info" data-dismiss="modal" data-loading-text="修剪中" >确定
            </button>
            <button type="button" id="<?php echo ($pref); ?>_modifyimg_del" class="btn btn-small" data-dismiss="modal" aria-hidden="true" >取消
            </button>
        </div>
    </div>
	  <div id="<?php echo ($pref); ?>_modalimg_edit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h4>图片预览</h4>
        </div>
        <div class="modal-body">
            <p>
                <div id="<?php echo ($pref); ?>_showimg_edit" class="show_img">
                </div>
             </p>
        </div>
        <div class="modal-footer">
            <button type="button" id="<?php echo ($pref); ?>_modifyimg_edit" class="btn btn-small btn-info" data-dismiss="modal" data-loading-text="修剪中" >确定
            </button>
            <button type="button" id="<?php echo ($pref); ?>_modifyimg_cancel" class="btn btn-small" data-dismiss="modal" aria-hidden="true" >取消
            </button>
        </div>
    </div>
	<div>
	<input type="hidden" id="src" name="src" value="" />
	<input type="hidden" id="x" name="x" value="0" />
	<input type="hidden" id="y" name="y" value="0" />
	<input type="hidden" id="w" name="w" value="140" />
	<input type="hidden" id="h" name="h" value="140" />
	<input type="hidden" id="<?php echo ($pref); ?>_edit_id" name="<?php echo ($pref); ?>_edit_id" value="" />
	</div>

    <div>
    	<div class="input-append">      
        <span class="add-on"><i class="icon-star"></i>品种</span>
		    <select name="<?php echo ($pref); ?>_assortmentSelect" class="span2"  rel="tooltip" data-placement="right" title="市/区">
        	<?php $count=count($assortment); if($count<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ foreach($assortment as $key=>$value){ $id=$value['aid']; $name=$value['aname']; ?>
            <option <?php if($aid==$id){echo "selected='selected'";} ?> value="<?php echo $name,'_',$id; ?>"><?php echo $name; ?></option>
            <?php } }?>
        </select>
		   <select name="<?php echo ($pref); ?>_goodsVarietySelect" class="span2" rel="tooltip" data-placement="right" title="">
        	<?php $count=count($goodsVariety); if($count<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ foreach($goodsVariety as $key=>$value){ $id=$value['vid']; $name=$value['vname']; ?>
            <option <?php if($vid==$id){echo "selected='selected'";} ?> value="<?php echo $name,'_',$id; ?>"><?php echo $name; ?></option>
            <?php } }?>
        </select>
		
		<input id="<?php echo ($pref); ?>_inputSearch" class="span2 inputText" type="text" placeholder="<?php echo ($spPlaceHolder); ?>" />
        <button id="<?php echo ($pref); ?>_btnSearch" class="btn" type="button" data-loading-text="搜索中..">搜索</button>

        <span style=" font-size:12px;">
		<i class=" icon-wrench"></i>操作:
		&nbsp;&nbsp;<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2_<?php echo ($pref); ?>" href="#collapseTwo_<?php echo ($pref); ?>">添加<i class=" icon-plus"></i></a>
		&nbsp;&nbsp;<a class="accordion-toggle" data-toggle="collapse" href="#<?php echo ($pref); ?>_to_edit_a"  id="<?php echo ($pref); ?>_to_edit_a">高级编辑</a><i class="icon-hand-up"></i>
		&nbsp;&nbsp;<a class="accordion-toggle" data-toggle="collapse" href="#<?php echo ($pref); ?>_to_search_a" id="<?php echo ($pref); ?>_to_search_a">查询</a><i class="icon-search"></i>
		</span>
		</div>
    </div>
    <div id="collapseTwo_<?php echo ($pref); ?>" class="<?php echo ($addClass); ?>">
        <!-- 添加goods -->
        <div class="accordion-inner">
            <div>
                <div class="modal-header">
                    <span  style="font-size:12px;"><i class="icon-star"></i>添加Goods</span>
                </div>
                <div class="modal-body">
                    <div style="float: left; margin: 0 5px 0 0;">
                        <div class="input-append">
                            <input class="span2 inputText" id="<?php echo ($pref); ?>_inputAdd" type="text" placeholder="<?php echo ($spPlaceHolder); ?>" value="" />
                        </div>
                        <div>
                            <textarea id="<?php echo ($pref); ?>_textarea_add" name="gdesc" rows="5" placeholder="商品描述"></textarea>
                        </div>
                    </div>
                    <div id="img">
                        <img src="__PUBLIC__/images/goods_demo.png" class="img-polaroid" alt="goods图片预览" />
                    </div>
                    <div style="margin: 5px 0; clear:left;" class="text-info">说明：只允许上传gif、jpg或png格式的图片，图片大小不能超过1M。
                    </div>
                    <div class="btn btn-mini btn-info btn_fileupload">
                        <span>上传图片</span>
                        <input id="<?php echo ($pref); ?>_fileupload_add" type="file" name="mypic" />
                    </div>
					<span>
                        <button id="<?php echo ($pref); ?>_btnAdd" type="button" class="btn btn-mini btn-info" data-loading-text="增加中..">增加</button>
 					</span>
                    <div  style="font-size:12px;" class="files">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div id="inforMessage" style="margin: 0 20%; text-align: center; display: <?php echo ($style); ?>" class="<?php echo ($class); ?>">
            <?php echo ($infor); ?>
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
        </div>
        <?php  $count=count($data); $nowPage=$pgInfo['nowPage']; $num=($nowPage-1)*$pgInfo['perPageRows']+1; if($count<=0){ ?>
      <div class="alert-info" style=" margin: 5px 3px; padding: 2px; text-align: center;">
            暂无数据！
        </div>
        <?php }else{ ?>
        <table class="table table-hover table-condensed" style="font-size: small;">
            <thead>
                <tr>
                    <th>
                        <button id="<?php echo ($pref); ?>_check_all" type="button" class="btn btn-mini btn-info">
                            全选
                        </button>
                        <button id="<?php echo ($pref); ?>_check_invert" type="button" class="btn btn-mini btn-info">
                            反选
                        </button>
                    </th>
                    <th>
                        名称
                    </th>
					<th class="<?php echo ($pref); ?>_fadetoggle">
				描述
					</th>
					<th class="<?php echo ($pref); ?>_fadetoggle">
						图片
					</th>
					<th class="<?php echo ($pref); ?>_fadetoggle">
						
					</th>
                    <th>
                        <button id="<?php echo ($pref); ?>_saveAll" type="button" class="btn btn-small btn-info" data-loading-text="正在保存">
                            批量保存
                        </button>
                    </th>
                    <th>
                        <button id="<?php echo ($pref); ?>_deleteAll" type="button" class="btn btn-small btn-warning" data-loading-text="正在删除">
                            批量删除
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $id=>$array){ $id=$array['gid']; $name=$array['gname']; $gdesc=$array['gdescription']; $img=$array['gimg']; ?>
                <tr>
                    <td>
                        <label class="<?php echo ($pref); ?>_checkbox">
                            <input id="<?php echo ($pref); ?>_checkbox_<?php echo $id; ?>" type="checkbox" name="<?php echo ($pref); ?>_checkbox" />
                            <?php echo $num; $num++?>
                        </label>
                    </td>
					<td>
				 <input id="<?php echo ($pref); ?>_input_<?php echo $id; ?>" name="<?php echo ($pref); ?>_text" class="input-medium" type="text" placeholder="<?php echo ($spPlaceHolder); ?>" value="<?php echo $name; ?>" />
					</td>
					<td class="<?php echo ($pref); ?>_fadetoggle">
					 <label>
                           <textarea id="<?php echo ($pref); ?>_textarea_edit_<?php echo ($id); ?>" name="gdesc" rows="3" placeholder="商品描述" ><?php echo ($gdesc); ?></textarea>
                      </label>
					</td>
                    <td class="<?php echo ($pref); ?>_fadetoggle">  
                     <img id="<?php echo ($pref); ?>_img_show_<?php echo ($id); ?>" src="<?php echo ($img); ?>" class="img-polaroid" alt="<?php echo ($name); ?>" />
                    </td>
					<td class="<?php echo ($pref); ?>_fadetoggle">
				  <div class="btn btn-mini btn-info btn_fileupload" title="修改图片">
                        <span>上传图片</span>
						<form id="<?php echo ($pref); ?>_myupload_edit_<?php echo ($id); ?>" class="myupload_form" action='uploadimg.php' method='post' enctype='multipart/form-data'>
 						<input id="<?php echo ($pref); ?>_inputfile_edit_<?php echo ($id); ?>" class="<?php echo ($pref); ?>_inputfile_edit" name="mypic" type="file" value="" />
						<input id="<?php echo ($pref); ?>_original_img_<?php echo ($id); ?>" type="hidden" value="<?php echo ($img); ?>" />
						</form>
                   </div>
				   	<div id="<?php echo ($pref); ?>_files_edit_<?php echo ($id); ?>">
                        <!-- 插入上传信息 -->
					</div>
					</td>
                    <td>
                        <button id="<?php echo ($pref); ?>_edit_<?php echo $id; ?>" type="button" class="<?php echo ($pref); ?>_edit btn btn-mini btn-info" data-loading-text="保存中..">保存
                        </button>
                    </td>
                    <td>
                        <button id="<?php echo ($pref); ?>_delete_<?php echo $id; ?>" type="button" data-toggle="modal" class="<?php echo ($pref); ?>_delete btn btn-mini btn-warning" data-loading-text="删除中.." data-target="#<?php echo ($pref); ?>_deleteModal">删除
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="pagination pagination-centered">
            <ul>
                <li>
                    <span class="label" style="color: #333333;">第<?php echo ($pgInfo['nowPage']); ?>/<?php echo ($pgInfo['totalPages']); ?>页</span>
                </li>
            </ul>
            <ul>
                <li class="<?php echo ($pgInfo['upName']); ?>">
                    <a class="<?php echo ($pref); ?>_page<?php echo ($pgInfo['upName']); ?>" id="sp_<?php echo ($pgInfo['up']); ?>" >Prev</a>
                </li>
                <?php foreach($page as $p=>$pid){ if($p==$pgInfo['nowPage']){ ?>
                <li class="<?php echo $pid['class']; ?>">
                    <a class="<?php echo ($pref); ?>_now_page" id="<?php echo ($pref); ?>_<?php echo $pid['pid']; ?>" >
                        <?php echo $p; ?>
                    </a>
                </li>
                <?php } else{ ?>
                <li>
                    <a class="<?php echo ($pref); ?>_page" id="<?php echo ($pref); ?>_<?php echo $pid; ?>" >
                        <?php echo $p; ?>
                    </a>
                </li>
                <?php } } ?>
                <li class="<?php echo ($pgInfo['downName']); ?>">
                    <a class="<?php echo ($pref); ?>_page<?php echo ($pgInfo['downName']); ?>" id="<?php echo ($pref); ?>_<?php echo ($pgInfo['down']); ?>" >Next</a>
                </li>
            </ul>
            <ul>
                <li>
                    <span class="label" style="color: #333333;">共<?php echo ($pgInfo['totalRows']); ?>条记录</span>
                </li>
            </ul>
        </div>
        <?php } ?>
        <div id="<?php echo ($pref); ?>_deleteModal" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h5>警告！</h5>
            </div>
            <div class="modal-body">
                <p>确定要删除吗？</p>
            </div>
            <div class="modal-footer">
                <button id="<?php echo ($pref); ?>_to_delete" class="btn btn-small btn-warning" data-dismiss="modal" aria-hidden="true">
                    确定
                </button>
                <button class="btn btn-small" data-dismiss="modal" aria-hidden="true">
                    取消
                </button>
            </div>
        </div>
        <div id="<?php echo ($pref); ?>_deleteAllModal" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h5>警告！</h5>
            </div>
            <div class="modal-body">
                <p>
                    确定要删除吗？
                </p>
            </div>
            <div class="modal-footer">
                <button id="<?php echo ($pref); ?>_to_deleteAll" class="btn btn-small btn-warning" data-dismiss="modal" aria-hidden="true">
                    确定
                </button>
                <button class="btn  btn-small" data-dismiss="modal" aria-hidden="true">
                    取消
                </button>
            </div>
        </div>
        <div id="<?php echo ($pref); ?>_alert_checkbox_choose" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h5 class="text-warning">警告！</h5>
            </div>
            <div class="modal-body">
                <p>
                    请选择要操作的项！
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal" aria-hidden="true">
                    确定
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
      var data_temp_goodsSet = {
		p: "<?php echo ($pgInfo['nowPage']); ?>",
		aid: "<?php echo ($aid); ?>",
		aname: "<?php echo ($aname); ?>",
		vid: "<?php echo ($vid); ?>",
		vname: "<?php echo ($vname); ?>",
		key:"<?php echo ($search); ?>"
		}
		
    pageClickByData(".<?php echo ($pref); ?>_page", data_temp_goodsSet, "<?php echo ($replaceId); ?>", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll");
    var edit = ".<?php echo ($pref); ?>_edit.btn.btn-mini.btn-info";
    mutilBtnToEdit(edit,"<?php echo ($pref); ?>_textarea_edit_","<?php echo ($pref); ?>_delimg_edit_", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editByName",data_temp_goodsSet, "<?php echo ($replaceId); ?>");
	
    var del = ".<?php echo ($pref); ?>_delete.btn.btn-mini.btn-warning";
    mutilDelBtn(del, "<?php echo ($pref); ?>_to_delete", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=deleteById",data_temp_goodsSet, "<?php echo ($replaceId); ?>");
    
    allChoose("<?php echo ($pref); ?>_check_all", "<?php echo ($pref); ?>_checkbox");
    invertChoose("<?php echo ($pref); ?>_check_invert", "<?php echo ($pref); ?>_checkbox");
    
	mutilSaveByGoods("<?php echo ($pref); ?>_saveAll","<?php echo ($pref); ?>_textarea_edit_","<?php echo ($pref); ?>_delimg_edit_", "<?php echo ($pref); ?>_checkbox", "<?php echo ($pref); ?>_alert_checkbox_choose", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editAll",data_temp_goodsSet, "<?php echo ($replaceId); ?>");
    
    mutilDel("<?php echo ($pref); ?>_deleteAll", "<?php echo ($pref); ?>_checkbox", "<?php echo ($pref); ?>_alert_checkbox_choose", "<?php echo ($pref); ?>_deleteAllModal", "<?php echo ($pref); ?>_to_deleteAll", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=deleteAll",data_temp_goodsSet, "<?php echo ($replaceId); ?>");
    
    //添加商品名称
    singleBtnToAddGoods("<?php echo ($pref); ?>_btnAdd", "<?php echo ($pref); ?>_inputAdd","<?php echo ($pref); ?>_textarea_add","<?php echo ($pref); ?>_delimg_add", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=addByName",data_temp_goodsSet, "<?php echo ($replaceId); ?>");
    
	//商品名称搜索
    singleBtn("<?php echo ($pref); ?>_btnSearch", "<?php echo ($pref); ?>_inputSearch", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll", data_temp_goodsSet,  "<?php echo ($replaceId); ?>");

	
	$("select[name='<?php echo ($pref); ?>_assortmentSelect']").change(function(){
        var Str = this.value;
        var arr = Str.split("_");
        var name = arr[0]
        var id = arr[1];
        
       var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
        ajaxRequest("post", url, {
        p: "<?php echo ($pgInfo['nowPage']); ?>",
		aid:id,
		aname:name
        }, "", "#<?php echo ($replaceId); ?>");
    });
		
	$("select[name='<?php echo ($pref); ?>_goodsVarietySelect']").change(function(){
        var Str = this.value;
        var arr = Str.split("_");
        var name = arr[0]
        var id = arr[1];
        
       var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
        ajaxRequest("post", url, {
        p: "<?php echo ($pgInfo['nowPage']); ?>",
		aid:"<?php echo ($aid); ?>",
		aname:"<?php echo ($aname); ?>",
		vid:id,
		vname:name,
        }, "", "#<?php echo ($replaceId); ?>");
    });
    
    $(document).ready(function(){
        var picW = 140;
        var picH = 140;
        var showimg = $('#showimg');
        var modifyimg = $('#img');
        var files = $(".files");
        var btn = $(".btn_fileupload span");
        var fileupload_add = $("#<?php echo ($pref); ?>_fileupload_add");
        fileupload_add.wrap("<form id='myupload' action='uploadimg.php' method='post' enctype='multipart/form-data'></form>");
      			
        fileupload_add.change(function(){ //选择文件
            var fileVal = this.value;
            if (isTextEmpty(fileVal)) {//未选择文件时
                return;
            }
            $("#myupload").ajaxSubmit({
                dataType: 'json', //数据格式为json 
                beforeSend: function(){ //开始上传 
                    showimg.empty(); //清空显示的图片
                    btn.html("上传中..."); //上传按钮显示上传中
                },
                uploadProgress: function(event, position, total, percentComplete){
					//进度条设置
                },
                success: function(data){ //成功
                    //显示上传后的图片
                    var img =data.pic;
                    //判断上传图片的大小 然后设置图片的高与宽的固定宽
                    if (data.width > picW && data.height < picH) {
                        showimg.html("<img src='" + img + "' id='cropbox' height='" + picH + "' />");
                    }
                    else 
                        if (data.width < picW && data.height > picH) {
                            showimg.html("<img src='" + img + "' id='cropbox' width='" + picW + "' />");
                        }
                        else 
                            if (data.width < picW && data.height < picH) {
                                showimg.html("<img src='" + img + "' id='cropbox' width='" + picW + "' height='" + picH + "' />");
                            }
                            else {
                                showimg.html("<img src='" + img + "' id='cropbox' />");
                            }
                    //传给php页面，进行保存的图片值
                    $("#src").val(img);
                    //截取图片的js
                    $('#cropbox').Jcrop({
                        aspectRatio: 1,
                        onSelect: updateCoords,
                        minSize: [picW, picH],
                        maxSize: [picW, picH],
                        allowSelect: false, //允许选择
                        allowResize: false, //是否允许调整大小
                        setSelect: [0, 0, picW, picH]
                    });
                    btn.html("上传图片"); //上传按钮还原
                    $('#myModal').modal({
                        keyboard: false,
                        show: true,
                        backdrop: false
                    });
                },
                error: function(xhr){ //上传失败
                    btn.html("上传失败");
                    files.html(xhr.responseText); //返回失败信息
                }
            });
        });
		
		
        //修剪
        $("#<?php echo ($pref); ?>_modifyimg_add").click(function(){
            var btn = $(this);
            var src = $("#src").val();
            var x = $('#x').val();
            var y = $('#y').val();
            var w = $('#w').val();
            var h = $('#h').val();
            var type = "post";
            var url = "modifyimg.php";
            var data = {
                src: src,
                x: x,
                y: y,
                w: w,
                h: h
            };
            $.ajax({
                type: type,
                url: url,
                data: data, // 传送的参数，json格式
                dataType: 'json',//返回的数据格式
                beforeSend: function(){
                    // showloding();
                    btn.button('loading');
                },
                success: function(msg, textStatus){
                    modifyimg.html('<img src="' + msg.pic + '"  alt="goods图片预览" />');
                   //获得后台返回的json数据，显示文件名，大小，以及删除按钮
                   files.html("<span>" + msg.name + "(" + msg.size + "k)</span> <span id='<?php echo ($pref); ?>_delimg_add' class='delimg' rel='" + msg.pic + "'>删除</span>");
					$('#myModal').modal('hide');
				},
                complete: function(XMLHttpRequest, textStatus){
                    btn.button("reset");
                    // hideLoading
                },
                error: function(){
                    // 请求出错处理
                    $('#myModal').modal('hide');
                    files.html("修剪失败.");
                    showimg.empty(); //清空图片
                    modifyimg.html('<img src="__PUBLIC__/images/goods_demo.png"  alt="goods图片预览" />');
                    fileupload_add.attr("value", "");
                }
            });
        });

		delimg(".delimg",files,showimg,modifyimg,fileupload_add);

		uploadimgEdit(".<?php echo ($pref); ?>_inputfile_edit","uploadimg.php","#<?php echo ($pref); ?>_myupload_edit_","#<?php echo ($pref); ?>_showimg_edit","#<?php echo ($pref); ?>_modalimg_edit","#<?php echo ($pref); ?>_edit_id","#<?php echo ($pref); ?>_files_edit_",picW,picH);
		
		modifyimgEdit("#<?php echo ($pref); ?>_modifyimg_edit","#<?php echo ($pref); ?>_edit_id","modifyimg.php","#<?php echo ($pref); ?>_modalimg_edit","#<?php echo ($pref); ?>_showimg_edit","#<?php echo ($pref); ?>_files_edit_","#<?php echo ($pref); ?>_img_show_");

		delimgEdit(".delimg_edit","#<?php echo ($pref); ?>_files_edit_","#<?php echo ($pref); ?>_showimg_edit","#<?php echo ($pref); ?>_img_show_","#<?php echo ($pref); ?>_inputfile_edit_","#<?php echo ($pref); ?>_original_img_");
		//隐藏
		$(".<?php echo ($pref); ?>_fadetoggle").fadeOut(0);
		_fadeToggle("#<?php echo ($pref); ?>_to_edit_a",".<?php echo ($pref); ?>_fadetoggle");
		
    });
	
	
// 批量保存
function mutilSaveByGoods(btnSaveId,prefTextArea,prefImg, checkboxName, tipInfoId, url, data, insertHtmlId) {
	var btn = $("#" + btnSaveId);
	btn.click(function() {
		var dataStr = "{";
		var isEmpty = true;
		$("input[name='" + checkboxName + "']")
				.each(
						function() {
							if ($(this).attr("checked") == "checked") {
								var arrId = (this.id).split("_");
								var tempId = arrId[arrId.length - 1];
								var textarea=$("#"+prefTextArea+tempId);
								var src=$("#"+prefImg+tempId);
								var gdesc=textarea.val();
								var img=src.attr("rel");
								img=(img=="undefined"?"":img);
								var tempValue = $("#" + arrId[0] + "_input_"+ tempId).attr("value");
								dataStr += "'" + tempId + "':{name:'" + tempValue+ "',gdesc:'"+gdesc+ "',img:'"+img+"'},";
								isEmpty = false;
							}
						});
		dataStr += "}";
		var d = window.eval("(" + dataStr + ")");
		if (isEmpty) {
			$('#' + tipInfoId).modal({
				show : true,
				keyboard : false
			})
		} else {
			$.extend(d, data);
			ajaxRequest("post", url, d, btn, "#" + insertHtmlId);
		}
	});
}



	function modifyimgEdit(btnId,editId,url,modalId,showimgId,preffiles,prefmodify){
			var btn=$(btnId);
			btn.click(function(){
			var id=$(editId).val();
		    var src = $("#src").val();
            var x = $('#x').val();
            var y = $('#y').val();
            var w = $('#w').val();
            var h = $('#h').val();
            var data = {
                src: src,
                x: x,
                y: y,
                w: w,
                h: h
            };
			var modal=$(modalId);
			var showimg=$(showimgId+id);
			var files=$(preffiles+id);
			var modify=$(prefmodify+id);
            $.ajax({
                type:  "post",
                url: url,
                data: data, // 传送的参数，json格式
                dataType: 'json',//返回的数据格式
                beforeSend: function(){
                    btn.button('loading');
                },
                success: function(msg, textStatus){
                    modify.attr('src',msg.pic);
                   //获得后台返回的json数据，显示文件名，大小，以及删除按钮
                    files.html("<span>" + msg.name + "(" + msg.size + "k)</span> <span id='<?php echo ($pref); ?>_delimg_edit_"+id+"' class='delimg_edit' rel='" + msg.pic + "'>删除</span>");
					modal.modal('hide');
				},
                complete: function(XMLHttpRequest, textStatus){
                    btn.button("reset");
                   
                },
                error: function(){
                    // 请求出错处理
                    modal.modal('hide');
                    files.html("修剪失败.");
                    showimg.empty(); //清空图片
                    btn.attr("value", "");
                }
            });
			});
		}

    function delimgEdit(btn,preffiles,showimgId,prefmodify,prefInputfile,preforigImg){
   			$(btn).live('click', function(){
			var btnId=this.id;
			var btn=$("#"+btnId);
			var arrId=btnId.split("_");
			var id=arrId[arrId.length-1];
			
			var files=$(preffiles+id);
			var showimg=$(showimgId+id);
			var modify=$(prefmodify+id);
			var inputfile=$(prefInputfile+id);
			var origImg=$(preforigImg+id);
			
			var pic = $(btn).attr("rel");
			var src=origImg.val();
			
			src=(src?src:"__PUBLIC__/images/goods_demo.png");
			 $.post("uploadimg.php?act=delimg", {
                imagename: pic
            }, function(msg){
                if (msg == 1) {
                    files.html("删除成功.");
                    showimg.empty(); //清空图片
                    modify.attr("src",src);
                    inputfile.attr("value", "");
					
                }
                else {
                    //alert(msg);
                }
            });
	});
   }
   
   
	function delimg(btn,files,showimg,modifyimg,fileupload_add){
		 $(btn).live('click', function(){
           delimgPost(btn, files, showimg, modifyimg, fileupload_add);
		});
	}
	
	function delimgPost(btn, files, showimg, modifyimg, fileupload_add){
		  var pic = $(btn).attr("rel");
            $.post("uploadimg.php?act=delimg", {
                imagename: pic
            }, function(msg){
                if (msg == 1) {
                    files.html("删除成功.");
                    showimg.empty(); //清空图片
                    modifyimg.html('<img src="__PUBLIC__/images/goods_demo.png"  alt="goods图片预览" class="img-polaroid" />');
                    fileupload_add.attr("value", "");
                }
                else {
                    //alert(msg);
                }
            });
	}
	
	
	
    function updateCoords(c){
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    };
    
    function checkCoords(){
        if (parseInt($('#w').val())) 
            return true;
        alert('Please select a crop region then press submit.');
        return false;
    };
</script>