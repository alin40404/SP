<?php if (!defined('THINK_PATH')) exit();?><div id="goodspriceSet1">
        <div id="inforMessage" style="margin: 0 20% 5px; text-align: center; display: <?php echo ($style); ?>" class="<?php echo ($class); ?>">
            <?php echo ($info); ?>
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
     </div>
    <div>
    	<div class="input-prepend">    
        <span class="add-on">地区</span>
        <select name="<?php echo ($pref); ?>_prvSelect" class="span2" rel="tooltip" data-placement="right" title="省/直辖市">
        	<?php $countPrv=count($province); if($countPrv<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ foreach($province as $key=>$value){ ?>
            <option <?php if($prid==$value['pid']){echo "selected='selected'";} ?> value="<?php echo $value['pname'],'_',$value['pid']; ?>"><?php echo $value['pname']; ?></option>
            <?php } }?>
        </select>
		    <select name="<?php echo ($pref); ?>_citySelect" class="span2" rel="tooltip" data-placement="right" title="市/区">
        	<?php $countCity=count($city); if($countCity<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ foreach($city as $key=>$value){ ?>
            <option  <?php if($cityid==$value['cid']){echo "selected='selected'";} ?>   value="<?php echo $value['cname'],'_',$value['cid']; ?>"><?php echo $value['cname']; ?></option>
            <?php } }?>
        </select>
		    <select name="<?php echo ($pref); ?>_ZoneSelect" class="span2" rel="tooltip" data-placement="right" title="市/区">
        	<?php $count=count($zone); if($count<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ foreach($zone as $key=>$value){ ?>
            <option <?php if($zoneid==$value['zid']){echo "selected='selected'";} ?>  value="<?php echo $value['zname'],'_',$value['zid']; ?>"><?php echo $value['zname']; ?></option>
            <?php } }?>
        </select>
		 <span class="add-on">市场</span>
		 	<select name="<?php echo ($pref); ?>_MarketSelect" class="span2" rel="tooltip" data-placement="right" title="市场">
        	<?php $count=count($market); if($count<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ foreach($market as $key=>$value){ ?>
            <option <?php if($marketid==$value['mid']){echo "selected='selected'";} ?> value="<?php echo $value['mname'],'_',$value['mid']; ?>"><?php echo $value['mname']; ?></option>
            <?php } }?>
        </select>
		</div>
    </div>

<div>
    <div id="<?php echo ($pref); ?>_goodsprice">
      <p>
		<div class="input-append">    
		<input id="<?php echo ($pref); ?>_inputSearch" class="span2 inputText" type="text" placeholder="<?php echo ($spPlaceHolder); ?>" />
        <button id="<?php echo ($pref); ?>_btnSearch" class="btn" type="button" data-loading-text="搜索中..">搜索</button>
	<span class="add-on">
		销售方式：
	<label style="display:inline;"><input type="radio" class="<?php echo ($pref); ?>_optionsRadios" name="<?php echo ($pref); ?>_optionsRadios" id="<?php echo ($pref); ?>_optionsRadios2" value="批发" <?php if($mtype!='零售') echo 'checked=checked'; ?>  />批发</label>
    <label style="display:inline;"><input type="radio" class="<?php echo ($pref); ?>_optionsRadios" name="<?php echo ($pref); ?>_optionsRadios" id="<?php echo ($pref); ?>_optionsRadios1" value="零售" <?php if($mtype=='零售') echo 'checked=checked'; ?> />零售</label>
		</span>
		<span class="add-on">日期：<input style=" height:20px; margin: 0px;padding:0px;" type="text" class="mh_date" name="<?php echo ($pref); ?>_date" readonly="true" value="<?php echo ($mtime); ?>" /></span>
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
					商品名称
                    </th>
					<th>
						<a id="<?php echo ($pref); ?>_units_add"   href="#<?php echo ($pref); ?>_modal_units_add" data-toggle="modal">单位&nbsp;&nbsp;&nbsp;<i class="icon-wrench"></i></a>
					</th>
					<th>
						价格           
					</th>
					<th>最低价</th>
					<th>最高价</th>
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
                <?php  foreach($data as $id=>$array){ $gid=$array['gid']; $name=$array['gname']; $id=$array['mgid']; $mtype=$array['mtype']; $price=$array['price']; $maxprice=$array['maxprice']; $minprice=$array['minprice']; $uid=$array['uid']; ?>
                <tr>
                    <td>
                        <label class="<?php echo ($pref); ?>_checkbox">
                            <input id="<?php echo ($pref); ?>_checkbox_<?php echo $id; ?>" type="checkbox" name="<?php echo ($pref); ?>_checkbox" />
                            <?php echo $num; $num++?>
                        </label>
                    </td>
					<td>
						<?php echo ($name); ?>
					</td>
					<td>
						<?php echo ($uname); ?>
			<select style="width:auto;" name="<?php echo ($pref); ?>_unitsSelect" class="span1" rel="tooltip" data-placement="right" title="市场">
        	<?php $count=count($units); if($count<=0){ ?>
            <option></option>
			<?php }else{ foreach($units as $key=>$value){ $uid0=$value['uid']; $uname0=$value['uname']; ?>
            <option <?php if($uid==$uid0){echo "selected='selected'";} ?> value="<?php echo $uname0,'_',$uid0; ?>"><?php echo $uname0; ?></option>
            <?php } }?>
        </select>
					</td>
					<td>
				 <input style="width:100px;" id="<?php echo ($pref); ?>_input_<?php echo $id; ?>" name="<?php echo ($pref); ?>_text" class="input-medium" type="text" placeholder="价格" value="<?php echo $price; ?>" />
					</td>
					<td >
				 <input style="width:100px;" id="<?php echo ($pref); ?>_input_<?php echo $id; ?>" name="<?php echo ($pref); ?>_text" class="input-medium" type="text" placeholder="价格" value="<?php echo $minprice; ?>" />
					</td>
                    <td >  
				 <input style="width:100px;" id="<?php echo ($pref); ?>_input_<?php echo $id; ?>" name="<?php echo ($pref); ?>_text" class="input-medium" type="text" placeholder="价格" value="<?php echo $maxprice; ?>" />
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
		
</p>
    </div>

</div>

    <div>
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
  
   <div id="<?php echo ($pref); ?>_modal_units_add" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 id="myModalLabel">单位管理</h4>
  </div>
  <div class="modal-body">
    <p>
   <div class="input-append">
        <input class="span2 inputText" id="<?php echo ($pref); ?>_units_inputAdd" type="text" placeholder="单位" value="" />
        <button id="<?php echo ($pref); ?>_units_btnAdd" type="button" class="<?php echo ($pref); ?>_units btn btn-info" data-loading-text="增加中..">增加</button>
    </div>
  <?php  $count=count($units); $num=1; if($count<=0){ ?>
      <div class="alert-info" style=" margin: 5px 3px; padding: 2px; text-align: center;">
            暂无数据！
        </div>
        <?php }else{ ?>
        <table class="table table-hover table-condensed" style="font-size: small;">
            <thead>
                <tr>
                    <th>
                        <button id="<?php echo ($pref); ?>_units_check_all" type="button" class="btn btn-mini btn-info">全选</button>
                        <button id="<?php echo ($pref); ?>_units_check_invert" type="button" class="btn btn-mini btn-info">反选</button>
                    </th>
                    <th>名称</th>
                    <th>
                        <button id="<?php echo ($pref); ?>_units_saveAll" type="button" rel="tooltip" title="请选择要操作的项！" class="<?php echo ($pref); ?>_units btn btn-small btn-info" data-loading-text="正在保存">批量保存</button>
                    </th>
                    <th>
                        <button id="<?php echo ($pref); ?>_units_deleteAll" type="button" rel="tooltip" title="请选择要操作的项！" class="<?php echo ($pref); ?>_units btn btn-small btn-warning" data-loading-text="正在删除">批量删除</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($units as $id=>$array){ $id=$array['uid']; $name=$array['uname']; ?>
                <tr>
                    <td>
                        <label class="<?php echo ($pref); ?>_checkbox_units">
                            <input id="<?php echo ($pref); ?>units_checkbox_<?php echo $id; ?>" type="checkbox" name="<?php echo ($pref); ?>_checkbox_units" />
                            <?php echo $num; $num++?>
                        </label>
                    </td>
                    <td>
                        <input id="<?php echo ($pref); ?>units_input_<?php echo $id; ?>" name="<?php echo ($pref); ?>_units_text" class="input-medium" type="text" placeholder="单位" value="<?php echo $name; ?>" />
                    </td>
                    <td>
                        <button id="<?php echo ($pref); ?>units_edit_<?php echo $id; ?>" type="button" class="<?php echo ($pref); ?>_units_edit btn btn-mini btn-info" data-loading-text="保存中..">保存</button>
                    </td>
                    <td>
                        <button id="<?php echo ($pref); ?>units_delete_<?php echo $id; ?>" type="button" data-toggle="modal" class="<?php echo ($pref); ?>_units_delete btn btn-mini btn-warning" data-loading-text="删除中..">删除</button>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
	
</p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-small" data-dismiss="modal" aria-hidden="true">取消</button>
  </div>
</div>
   
    </div>

</div>
<script type="text/javascript">
    var data_temp = {
		p: "<?php echo ($pgInfo['nowPage']); ?>",
		pid: "<?php echo ($prid); ?>",
		pname: "<?php echo ($pname); ?>",
		cid: "<?php echo ($cityid); ?>",
		cname: "<?php echo ($cityname); ?>",
		zid: "<?php echo ($zoneid); ?>",
		zname: "<?php echo ($zonename); ?>",
		mid: "<?php echo ($marketid); ?>",
		mname: "<?php echo ($marketname); ?>",
		mtype:"<?php echo ($mtype); ?>",
		mtime:"<?php echo ($mtime); ?>",
		key: "<?php echo ($search); ?>"
	};
    pageClickByData(".<?php echo ($pref); ?>_page", data_temp
        , "<?php echo ($replaceId); ?>", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll");
    var edit = ".<?php echo ($pref); ?>_edit.btn.btn-mini.btn-info";
    mutilBtnToEdit(edit,"<?php echo ($pref); ?>_textarea_edit_","<?php echo ($pref); ?>_delimg_edit_", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editByName", {
        p: "<?php echo ($pgInfo['nowPage']); ?>"
    }, "<?php echo ($replaceId); ?>");
	
    var del = ".<?php echo ($pref); ?>_delete.btn.btn-mini.btn-warning";
    mutilDelBtn(del, "<?php echo ($pref); ?>_to_delete", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=deleteById", {
        p: "<?php echo ($pgInfo['nowPage']); ?>"
    }, "<?php echo ($replaceId); ?>");
    
	allChoose("<?php echo ($pref); ?>_check_all", "<?php echo ($pref); ?>_checkbox");
    invertChoose("<?php echo ($pref); ?>_check_invert", "<?php echo ($pref); ?>_checkbox");
    
	allChoose("<?php echo ($pref); ?>_units_check_all", "<?php echo ($pref); ?>_checkbox_units");
    invertChoose("<?php echo ($pref); ?>_units_check_invert", "<?php echo ($pref); ?>_checkbox_units");
    
	
//	mutilSaveByGoods("<?php echo ($pref); ?>_saveAll","<?php echo ($pref); ?>_textarea_edit_","<?php echo ($pref); ?>_delimg_edit_", "<?php echo ($pref); ?>_checkbox", "<?php echo ($pref); ?>_alert_checkbox_choose", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editAll", {
//        p: "<?php echo ($pgInfo['nowPage']); ?>"
//    }, "<?php echo ($replaceId); ?>");
//    
    mutilDel("<?php echo ($pref); ?>_deleteAll", "<?php echo ($pref); ?>_checkbox", "<?php echo ($pref); ?>_alert_checkbox_choose", "<?php echo ($pref); ?>_deleteAllModal", "<?php echo ($pref); ?>_to_deleteAll", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=deleteAll", {
        p: "<?php echo ($pgInfo['nowPage']); ?>"
    }, "<?php echo ($replaceId); ?>");
    
	//添加商品单位
    singleBtnWithModal("<?php echo ($pref); ?>_units_btnAdd", "<?php echo ($pref); ?>_units_inputAdd","<?php echo ($pref); ?>_modal_units_add", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=addByUnitsName", data_temp, "<?php echo ($replaceId); ?>");

	mutilBtnWithModal(".<?php echo ($pref); ?>_units_edit","<?php echo ($pref); ?>_modal_units_add", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editByUnitsName", data_temp, "<?php echo ($replaceId); ?>");
    mutilDelBtnWithModal(".<?php echo ($pref); ?>_units_delete", "<?php echo ($pref); ?>_modal_units_add", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=deleteByUnitsId",data_temp, "<?php echo ($replaceId); ?>");
    mutilSaveBySelectWithModal("<?php echo ($pref); ?>_units_saveAll","<?php echo ($pref); ?>_checkbox_units","<?php echo ($pref); ?>_modal_units_add",  host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editAllByUnits",data_temp, "<?php echo ($replaceId); ?>");
    mutilDelBySelectWithModal("<?php echo ($pref); ?>_units_deleteAll","<?php echo ($pref); ?>_checkbox_units","<?php echo ($pref); ?>_modal_units_add",  host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=deleteAllByUnits",data_temp, "<?php echo ($replaceId); ?>");
   
	
	
    //添加商品名称
//    singleBtnToAddGoods("<?php echo ($pref); ?>_btnAdd", "<?php echo ($pref); ?>_inputAdd","<?php echo ($pref); ?>_textarea_add","<?php echo ($pref); ?>_delimg_add", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=addByName", {
//        p: "<?php echo ($pgInfo['nowPage']); ?>",
//        vid: "<?php echo ($vid); ?>"
//    }, "<?php echo ($replaceId); ?>");
//    
	//商品名称搜索
    singleBtn("<?php echo ($pref); ?>_btnSearch", "<?php echo ($pref); ?>_inputSearch", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll", {
        p: "<?php echo ($pgInfo['nowPage']); ?>",
        vid: "<?php echo ($vid); ?>",
		vname: "<?php echo ($vname); ?>"
    },  "<?php echo ($replaceId); ?>");

	
    $("select[name='<?php echo ($pref); ?>_prvSelect']").change(function(){
        var Str = this.value;
        var arr = Str.split("_");
        var name = arr[0]
        var id = arr[1];
        
        var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
        ajaxRequest("post", url, {
        p: "<?php echo ($pgInfo['nowPage']); ?>",
        pid: id,
        pname: name,
		mtype:"<?php echo ($mtype); ?>"
        }, "", "#<?php echo ($replaceId); ?>");
    });
    
	 $("select[name='<?php echo ($pref); ?>_citySelect']").change(function(){
        var Str = this.value;
        var arr = Str.split("_");
        var name = arr[0]
        var id = arr[1];
        
        var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
        ajaxRequest("post", url, {
        p: "<?php echo ($pgInfo['nowPage']); ?>",
        pid: "<?php echo ($prid); ?>",
        pname: "<?php echo ($pname); ?>",
		cid:id,
		cname:name,
		mtype:"<?php echo ($mtype); ?>"
        }, "", "#<?php echo ($replaceId); ?>");
    });
	
	$("select[name='<?php echo ($pref); ?>_ZoneSelect']").change(function(){
        var Str = this.value;
        var arr = Str.split("_");
        var name = arr[0]
        var id = arr[1];
        
       var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
        ajaxRequest("post", url, {
        p: "<?php echo ($pgInfo['nowPage']); ?>",
        pid: "<?php echo ($prid); ?>",
        pname:"<?php echo ($pname); ?>",
		cid:"<?php echo ($cityid); ?>",
		cname:"<?php echo ($cityname); ?>",
		zid:id,
		zname:name,
		mtype:"<?php echo ($mtype); ?>"
        }, "", "#<?php echo ($replaceId); ?>");
    });
	
	$("select[name='<?php echo ($pref); ?>_MarketSelect']").change(function(){
        var Str = this.value;
        var arr = Str.split("_");
        var name = arr[0]
        var id = arr[1];
        
       var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
        ajaxRequest("post", url, {
        p: "<?php echo ($pgInfo['nowPage']); ?>",
        pid: "<?php echo ($prid); ?>",
        pname: "<?php echo ($pname); ?>",
		cid:"<?php echo ($cityid); ?>",
		cname:"<?php echo ($cityname); ?>",
		zid:"<?php echo ($zoneid); ?>",
		zname:"<?php echo ($zonename); ?>",
		mid:id,
		mname:name,
		mtype:"<?php echo ($mtype); ?>"
        }, "", "#<?php echo ($replaceId); ?>");
    });
	
	
	$("input[name='<?php echo ($pref); ?>_optionsRadios']").change(function(){
		var val=$(this).val();
		var data=data_temp;
		$.extend(data,{mtype:val});

		 var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
		 ajaxRequest("post", url,data , "", "#<?php echo ($replaceId); ?>");
	});

	var temp = "";
	var inputdate = $("input[name='<?php echo ($pref); ?>_date']");
		inputdate.bind({
			focusin: function(){
				temp = $(this).val();
			}
		});
		
	function calenderChange(){
		var val=inputdate.val();
			if (temp != val) {
		var data=data_temp;
		$.extend(data,{mtime:val});
		 var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
		 ajaxRequest("post", url,data , "", "#<?php echo ($replaceId); ?>");
		}
	}
	

	
	$(document).ready(function(){
	var date=new Date();
	$("input.mh_date").manhuaDate({					       
		Event : "click",//可选				       
		Left : 0,//弹出时间停靠的左边位置
		Top : -16,//弹出时间停靠的顶部边位置
		fuhao : "-",//日期连接符默认为-
		isTime : false,//是否开启时间值默认为false
		beginY :1990 ,//年份的开始默认为1949
		endY :date.getFullYear()//年份的结束默认为2049
	});
	});


 
</script>