<?php if (!defined('THINK_PATH')) exit();?>           <div id="tableGoods1"> 
             <div id="inforMessage" style=" margin:0 20%; text-align:center; display: <?php echo ($style); ?>;" class="<?php echo ($class); ?>"><?php echo ($infor); ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>
                        <table class="table table-hover table-condensed" style="font-size: small;">
                            <!--<caption>省市</caption>-->
                            <thead>
                                <tr>
                                    <th>
                                            <button id="check_all" type="button" class="btn btn-mini btn-info">全选</button>
                                            <button id="check_invert"  type="button" class="btn btn-mini btn-info">反选</button>
                                    </th>
                                    <th>名称</th>
                                    <th>
                                     <button type="button" class="btn btn-small btn-info">批量保存</button>
                                    </th>
                                    <th>
                                        <button type="button" class="btn btn-small btn-warning">批量删除</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $count=count($data); $nowPage=$pgInfo['nowPage']; $num=($nowPage-1)*$count+1; foreach($data as $id=>$array){ $cid=$array['cid']; $cname=$array['cname']; ?>
                                <tr>
                                    <td id="sp_<?php echo $cid; ?>">
                                         <label class="sp_checkbox"><input type="checkbox" name="sp_checkbox"/><?php echo $num; $num++?></label>
                                    </td>
                                    <td>
                                        <input id="sp_input_<?php echo $cid; ?>" class="input-medium" type="text" placeholder="<?php echo ($spPlaceHolder); ?>" value="<?php echo $cname; ?>" />
                                    </td>
                                    <td>
                                        <button id="sp_edit_<?php echo $cid; ?>" type="button" class="sp_edit btn btn-mini btn-info" data-loading-text="保存中..">保存</button>
                                    </td>
                                    <td>
                                        <a id="sp_delete_<?php echo $cid; ?>"  role="button" data-toggle="modal" class="sp_delete btn btn-mini btn-warning" data-loading-text="删除中.." href="#deleteModal">删除</a>
                                    </td>
                                </tr>
                               <?php } ?>
                            </tbody>
                        </table>
       <div class="pagination pagination-centered">
       <ul>
       <li><span class="label" style=" color: #333333;">第<?php echo ($pgInfo['nowPage']); ?>/<?php echo ($pgInfo['totalPages']); ?>页</span></li>
       </ul>
  <ul>
    <li class="<?php echo ($pgInfo['upName']); ?>"><a class="sp_page<?php echo ($pgInfo['upName']); ?>" id="sp_<?php echo ($pgInfo['up']); ?>"  href="#">Prev</a></li>
    <?php foreach($page as $p=>$pid){ if($p==$pgInfo['nowPage']){ ?>
    <li class="<?php echo $pid['class']; ?>"><a class="sp_now_page" id="sp_<?php echo $pid['pid']; ?>" href="#"><?php echo $p; ?></a></li>
    <?php } else{ ?>
    <li><a class="sp_page" id="sp_<?php echo $pid; ?>"  href="#"><?php echo $p; ?></a></li>
     <?php } } ?>
    <li class="<?php echo ($pgInfo['downName']); ?>"><a class="sp_page<?php echo ($pgInfo['downName']); ?>" id="sp_<?php echo ($pgInfo['down']); ?>"  href="#">Next</a></li>
  </ul>
         <ul>
       <li><span class="label" style=" color: #333333;">共<?php echo ($pgInfo['totalRows']); ?>条记录</span></li>
       </ul>
</div>

<div id="deleteModal" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h5>警告！</h5>
  </div>
  <div class="modal-body">
    <p>确定要删除吗？</p>
  </div>
  <div class="modal-footer">
    <button id="to_delete" class="btn btn-small btn-warning" data-dismiss="modal" aria-hidden="true">确定</button>
    <button class="btn  btn-small" data-dismiss="modal" aria-hidden="true">取消</button>
  </div>
</div>

  </div>  

       <script type="text/javascript">

              var url = host + "g=Admin&m=InforPartition&a=showAll";
              var pgClass=".sp_page";
              var insertHtmlId="#tableGoods1";
               pageClick(pgClass,insertHtmlId,url);
               
                //修改商品名称
               var edit = ".sp_edit.btn.btn-mini.btn-info";
               mutilBtn(edit,host + "g=Admin&m=InforPartition&a=editByName",{p:<?php echo ($pgInfo['nowPage']); ?>}, "tableGoods1");
               var del=".sp_delete.btn.btn-mini.btn-warning";
               mutilDelBtn(del,"to_delete",host + "g=Admin&m=InforPartition&a=deleteByCid",{p:<?php echo ($pgInfo['nowPage']); ?>}, "tableGoods1");

               $("#check_all").click(function (){
               $("input[name='sp_checkbox']").attr("checked",!$(this).attr("checked"));
               });

               $("#check_invert").click(function (){
               $("input[name='sp_checkbox']").each(function(){
               $(this).attr("checked",!this.checked);
               });
               });


       </script>