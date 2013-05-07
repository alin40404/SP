<?php if (!defined('THINK_PATH')) exit();?><div id="marketgoodsSet1">
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
		
<div id="<?php echo ($pref); ?>_market_goods">
      <p>
<div>
  <div class="row-fluid">
    <div class="span6">
      <!--Sidebar content-->
	  <div class="input-prepend">    
        <span class="add-on"><i class="icon-star"></i>品种</span>
		    <select name="<?php echo ($pref); ?>_assortmentSelect" class="span4"  rel="tooltip" data-placement="right" title="市/区">
        	<?php $count=count($assortment); if($count<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ foreach($assortment as $key=>$value){ $id=$value['aid']; $name=$value['aname']; ?>
            <option <?php if($aid==$id){echo "selected='selected'";} ?> value="<?php echo $name,'_',$id; ?>"><?php echo $name; ?></option>
            <?php } }?>
        </select>
		   <select name="<?php echo ($pref); ?>_goodsVarietySelect" class="span4" rel="tooltip" data-placement="right" title="">
        	<?php $count=count($goodsVariety); if($count<=0){ ?>
            <option>---暂无数据---</option>
			<?php }else{ foreach($goodsVariety as $key=>$value){ $id=$value['vid']; $name=$value['vname']; ?>
            <option <?php if($vid==$id){echo "selected='selected'";} ?> value="<?php echo $name,'_',$id; ?>"><?php echo $name; ?></option>
            <?php } }?>
        </select>
	</div>
	<div>
	<?php $count=count($goods); ?>
	<label class="text-info"><i class="icon-arrow-right"></i>未添加goods名称(共<?php echo $count;?>种)</label>
	<div>
	<select size="10" multiple="multiple" name="<?php echo ($pref); ?>_goodsSelect_left"  rel="tooltip" data-placement="right">
        	<?php $count=count($goods); if($count>0){ foreach($goods as $key=>$value){ $id=$value['gid']; $name=$value['gname']; ?>
            <option  value="<?php echo $name,'_',$id; ?>"><?php echo $name; ?></option>
            <?php } }?>
</select>
</div>
<div>
<button type="button" id="<?php echo ($pref); ?>_left_marketgoods" class="btn btn-small">确定<i class="icon-forward"></i></button>
</div>
	</div>
    </div>
    <div class="span6">
      <!--Body content-->
	  <div style=" height:30px;" class="input-prepend">  
	  <label class="text-info">
	  	<i class="icon-pencil"></i>当前：<?php echo ($marketname); ?>
	  </label>
	  </div>
	  <?php $count=count($marketgoods); ?>
	  <label class="text-info"><i class="icon-arrow-right"></i>已添加的goods名称(共<?php echo $count;?>种)，品种:<?php echo ($vname); ?></label>
	<div>
	<select size="10" multiple="multiple" name="<?php echo ($pref); ?>_goodsSelect_right" >
        	<?php  if($count>0){ foreach($marketgoods as $key=>$value){ $id=$value['gid']; $name=$value['gname']; ?>
            <option  value="<?php echo $name,'_',$id; ?>"><?php echo $name; ?></option>
            <?php } }?>
</select>
</div>
<div>
<button type="button" id="<?php echo ($pref); ?>_right_marketgoods" class="btn btn-small"><i class="icon-backward"></i>确定</button>
<button type="button" id="<?php echo ($pref); ?>_edit_marketgoods" class="btn btn-small" data-loading-text="修改 中.">修改</button>
</div>
    </div>
  </div>
  <div style="margin-top:20px;"  class="text-warning">警告说明</div>
</div>
</p>
    </div>	
		
</div>
		
<script type="text/javascript">
      var data_temp_marketgoodsSet = {
		p: "<?php echo ($pgInfo['nowPage']); ?>",
		aid: "<?php echo ($aid); ?>",
		aname: "<?php echo ($aname); ?>",
		vid: "<?php echo ($vid); ?>",
		vname: "<?php echo ($vname); ?>",
		pid: "<?php echo ($prid); ?>",
		pname: "<?php echo ($pname); ?>",
		cid: "<?php echo ($cityid); ?>",
		cname: "<?php echo ($cityname); ?>",
		zid: "<?php echo ($zoneid); ?>",
		zname: "<?php echo ($zonename); ?>",
		mid: "<?php echo ($marketid); ?>",
		mname: "<?php echo ($marketname); ?>",
		key: "<?php echo ($search); ?>"
	};

	
    $("select[name='<?php echo ($pref); ?>_prvSelect']").change(function(){
        var Str = this.value;
        var arr = Str.split("_");
        var name = arr[0]
        var id = arr[1];
        
        var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=showAll";
        ajaxRequest("post", url, {
        p: "<?php echo ($pgInfo['nowPage']); ?>",
		aid:"<?php echo ($aid); ?>",
		aname:"<?php echo ($aname); ?>",
		vid:"<?php echo ($vid); ?>",
		vname:"<?php echo ($vname); ?>",
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
		aid:"<?php echo ($aid); ?>",
		aname:"<?php echo ($aname); ?>",
		vid:"<?php echo ($vid); ?>",
		vname:"<?php echo ($vname); ?>",
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
		aid:"<?php echo ($aid); ?>",
		aname:"<?php echo ($aname); ?>",
		vid:"<?php echo ($vid); ?>",
		vname:"<?php echo ($vname); ?>",
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
		aid:"<?php echo ($aid); ?>",
		aname:"<?php echo ($aname); ?>",
		vid:"<?php echo ($vid); ?>",
		vname:"<?php echo ($vname); ?>",
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
	
		$("select[name='<?php echo ($pref); ?>_assortmentSelect']").change(function(){
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
		mid:"<?php echo ($marketid); ?>",
		mname:"<?php echo ($marketname); ?>",
		aid:id,
		aname:name,
		mtype:"<?php echo ($mtype); ?>"
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
        pid: "<?php echo ($prid); ?>",
        pname: "<?php echo ($pname); ?>",
		cid:"<?php echo ($cityid); ?>",
		cname:"<?php echo ($cityname); ?>",
		zid:"<?php echo ($zoneid); ?>",
		zname:"<?php echo ($zonename); ?>",
		mid:"<?php echo ($marketid); ?>",
		mname:"<?php echo ($marketname); ?>",
		aid:"<?php echo ($aid); ?>",
		aname:"<?php echo ($aname); ?>",
		vid:id,
		vname:name,
		mtype:"<?php echo ($mtype); ?>"
        }, "", "#<?php echo ($replaceId); ?>");
    });
	//从左边移到右边
	removeSelectOption("<?php echo ($pref); ?>_left_marketgoods","<?php echo ($pref); ?>_goodsSelect_left","<?php echo ($pref); ?>_goodsSelect_right","<?php echo ($pref); ?>_alert_checkbox_choose");
	//从右边移到左边
	removeSelectOption("<?php echo ($pref); ?>_right_marketgoods","<?php echo ($pref); ?>_goodsSelect_right","<?php echo ($pref); ?>_goodsSelect_left","<?php echo ($pref); ?>_alert_checkbox_choose");
	
	$("#<?php echo ($pref); ?>_edit_marketgoods").click(function(){
		var str="{";
		$("select[name='<?php echo ($pref); ?>_goodsSelect_right'] option").each(function(){
			var val=$(this).val();
			if (val != null) {
				var arr = val.split("_");
				var name = arr[0];
				var id = arr[1];
				str+="'"+id+"':'"+name+"',";
			}
		});
		str+="}";
		var data=window.eval('('+str+')');
		$.extend(data,{get:data_temp_marketgoodsSet});
		var url = host + "g=<?php echo ($group); ?>&m=<?php echo ($module); ?>&a=editMarketgoods";
        ajaxRequest("post", url,data , "#<?php echo ($pref); ?>_edit_marketgoods", "#<?php echo ($replaceId); ?>");
	});

</script>