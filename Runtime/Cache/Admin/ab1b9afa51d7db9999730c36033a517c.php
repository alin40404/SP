<?php if (!defined('THINK_PATH')) exit();?><div id="citySet1">
    <div>
        省/直辖市：
        <select name="<?php echo ($pref); ?>_prvSelect" class="span2" rel="tooltip" data-placement="right" title="省/直辖市">
        	<?php $countPrv=count($province); if($countPrv<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ if(!empty($prid)){ ?>
			 <option value="<?php echo ($pname); ?>_<?php echo ($prid); ?>"><?php echo ($pname); ?></option>
			<?php
 } foreach($province as $key=>$value){ if($prid!=$value['pid']){ ?>
            <option value="<?php echo $value['pname'],'_',$value['pid']; ?>"><?php echo $value['pname']; ?></option>
            <?php } } }?>
        </select>
    </div>
    <div>
        <div id="inforMessage" style="margin: 0 20%; text-align: center; display: <?php echo ($style); ?>" class="<?php echo ($class); ?>">
            <?php echo ($infor); ?>
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
        </div>
        <?php  $count=count($data); $nowPage=$pgInfo['nowPage']; $num=($nowPage-1)*$pgInfo['perPageRows']+1; if($count<=0){ ?>
        <div class="alert-info" style=" margin: 5px 3px; padding: 2px;">
            暂无数据！
        </div>
        <?php }else{ ?>
        <table class="table table-hover table-condensed" style="font-size: small;">
            <thead>
                <tr>
                    <th>
                        <button id="<?php echo ($pref); ?>_check_all" type="button" class="btn btn-mini btn-info">全选</button>
                        <button id="<?php echo ($pref); ?>_check_invert" type="button" class="btn btn-mini btn-info">反选</button>
                    </th>
                    <th>名称</th>
                    <th>
                        <button id="<?php echo ($pref); ?>_saveAll" type="button" class="btn btn-small btn-info" data-loading-text="正在保存">批量保存</button>
                    </th>
                    <th>
                        <button id="<?php echo ($pref); ?>_deleteAll" type="button" class="btn btn-small btn-warning" data-loading-text="正在删除">批量删除</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($data as $id=>$array){ $id=$array['cid']; $name=$array['cname']; ?>
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
                    <td>
                        <button id="<?php echo ($pref); ?>_edit_<?php echo $id; ?>" type="button" class="<?php echo ($pref); ?>_edit btn btn-mini btn-info" data-loading-text="保存中..">保存</button>
                    </td>
                    <td>
                        <button id="<?php echo ($pref); ?>_delete_<?php echo $id; ?>" type="button" data-toggle="modal" class="<?php echo ($pref); ?>_delete btn btn-mini btn-warning" data-loading-text="删除中.." data-target="#<?php echo ($pref); ?>_deleteModal">删除</button>
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
                    <a class="<?php echo ($pref); ?>_page<?php echo ($pgInfo['upName']); ?>" id="sp_<?php echo ($pgInfo['up']); ?>" href="#">Prev</a>
                </li>
                <?php foreach($page as $p=>$pid){ if($p==$pgInfo['nowPage']){ ?>
                <li class="<?php echo $pid['class']; ?>">
                    <a class="<?php echo ($pref); ?>_now_page" id="<?php echo ($pref); ?>_<?php echo $pid['pid']; ?>" href="#">
                        <?php echo $p; ?>
                    </a>
                </li>
                <?php } else{ ?>
                <li>
                    <a class="<?php echo ($pref); ?>_page" id="<?php echo ($pref); ?>_<?php echo $pid; ?>" href="#">
                        <?php echo $p; ?>
                    </a>
                </li>
                <?php } } ?>
                <li class="<?php echo ($pgInfo['downName']); ?>">
                    <a class="<?php echo ($pref); ?>_page<?php echo ($pgInfo['downName']); ?>" id="<?php echo ($pref); ?>_<?php echo ($pgInfo['down']); ?>" href="#">Next</a>
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
                <button id="<?php echo ($pref); ?>_to_delete" class="btn btn-small btn-warning" data-dismiss="modal" aria-hidden="true">确定</button>
                <button class="btn  btn-small" data-dismiss="modal" aria-hidden="true">取消</button>
            </div>
        </div>
        <div id="<?php echo ($pref); ?>_deleteAllModal" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5>警告！</h5>
            </div>
            <div class="modal-body">
                <p>确定要删除吗？</p>
            </div>
            <div class="modal-footer">
                <button id="<?php echo ($pref); ?>_to_deleteAll" class="btn btn-small btn-warning" data-dismiss="modal" aria-hidden="true">确定</button>
                <button class="btn  btn-small" data-dismiss="modal" aria-hidden="true">取消</button>
            </div>
        </div>
        <div id="<?php echo ($pref); ?>_alert_checkbox_choose" class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="text-warning">警告！</h5>
            </div>
            <div class="modal-body">
                <p>请选择要操作的项！</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small" data-dismiss="modal" aria-hidden="true">确定</button>
            </div>
        </div>
    </div>
    <div class="input-append">
        <input class="span2 inputText" id="<?php echo ($pref); ?>_inputAdd" type="text" placeholder="<?php echo ($spPlaceHolder); ?>" value="" />
        <button id="<?php echo ($pref); ?>_btnAdd" type="button" class="btn btn-info" data-loading-text="增加中..">增加</button>
    </div>
</div>

<script type="text/javascript">

    	pageClickByData( ".<?php echo ($pref); ?>_page",{pid:"<?php echo ($prid); ?>",pname:"<?php echo ($pname); ?>"}, "<?php echo ($replaceId); ?>", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll");
    	var edit = ".<?php echo ($pref); ?>_edit.btn.btn-mini.btn-info";
    	mutilBtn(edit, host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editByName", {p : "<?php echo ($pgInfo['nowPage']); ?>"}, "<?php echo ($replaceId); ?>");
    	var del = ".<?php echo ($pref); ?>_delete.btn.btn-mini.btn-warning";
    	mutilDelBtn(del, "<?php echo ($pref); ?>_to_delete", host+ "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=deleteById", {p :  "<?php echo ($pgInfo['nowPage']); ?>"}, "<?php echo ($replaceId); ?>");
    
    	allChoose("<?php echo ($pref); ?>_check_all", "<?php echo ($pref); ?>_checkbox");
    	invertChoose("<?php echo ($pref); ?>_check_invert", "<?php echo ($pref); ?>_checkbox");
    	mutilSave("<?php echo ($pref); ?>_saveAll", "<?php echo ($pref); ?>_checkbox", "<?php echo ($pref); ?>_alert_checkbox_choose", host+ "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editAll", {p :  "<?php echo ($pgInfo['nowPage']); ?>"}, "<?php echo ($replaceId); ?>");
    
    	mutilDel("<?php echo ($pref); ?>_deleteAll", "<?php echo ($pref); ?>_checkbox", "<?php echo ($pref); ?>_alert_checkbox_choose","<?php echo ($pref); ?>_deleteAllModal", "<?php echo ($pref); ?>_to_deleteAll", host+ "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=deleteAll", {p :  "<?php echo ($pgInfo['nowPage']); ?>"}, "<?php echo ($replaceId); ?>");
    	
    	 //添加商品名称
        singleBtn("<?php echo ($pref); ?>_btnAdd", "<?php echo ($pref); ?>_inputAdd", host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=addByName", {p :  "<?php echo ($pgInfo['nowPage']); ?>",pid:"<?php echo ($prid); ?>"}, "<?php echo ($replaceId); ?>");
 
$("select[name='<?php echo ($pref); ?>_prvSelect']").change(function(){
	var str=this.value;
	var arr=str.split("_");
	var name=arr[0]
	var id=arr[1];
	
	var url= host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
	ajaxRequest("post", url, {pid:id,pname:name}, "",  "#<?php echo ($replaceId); ?>");
})


</script>