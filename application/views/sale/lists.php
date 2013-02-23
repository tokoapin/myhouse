<table class="table table-condensed">
    <thead>
        <tr>
            <th>物件編號</th>
            <th>物件標題</th>
            <th>瀏覽</th>
            <th>電話</th>
            <th>收藏</th>
            <th>剩餘時間</th>
            <th>問題</th>
            <th>待回覆</th>
            <th>管理</th>
            <th>狀態</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($rows as $row):
                $end_time = $row['add_time'] + 30*86400;
                if ($end_time < time()) {
                    $leave_time = '結束物件';
                } else {
                    $day = intval(($end_time - time())/86400);
                    $hour = intval(($end_time - time())%86400/3600);
                    $leave_time = sprintf('%s天%sH', $day, $hour);
                }
        ?>
        <tr>
            <td><?php echo $row['uid'];?></td>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['view_count'];?></td>
            <td><?php echo $row['phone_count'];?> 通</td>
            <td><?php echo $row['favorite_count'];?></td>
            <td><?php echo $leave_time; ?></td>
            <td><?php echo $row['question_count'];?></td>
            <td><?php echo $row['reply_count'];?></td>
            <td><a class="btn btn-primary manage_house" data-uid="<?php echo $row['uid'];?>" data-toggle="modal" href="#manage_house">管理物件</a></td>
            <td><?php echo $_house_status[$row['status']];?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<div id="manage_house" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<script id="manage-template" type="text/x-handlebars-template">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>{{title}}</h3>
    </div>
    <div class="modal-body">
        <p>
            <a class="btn btn-primary" href="/sale/edit/{{uid}}">修改物件</a>
            <button class="btn btn-primary reservation">預約/續約刊登</button>
            <button class="btn btn-primary deal">成交結束物件</button>
            <a class="btn btn-primary" href="/sale/edit/{{uid}}">開啟廣告</a>
            <a class="btn btn-primary" href="/sale/edit/{{uid}}">關閉廣告</a>
        </p>
    </div>
    <div id="deal" class="hide">
        <div class="modal-header">
            <h3>成交結束物件</h3>
        </div>
        <div class="modal-body">
            <p>恭喜你物件已出售/出租</p>
            <p>成交價格為：&nbsp;<input type="text" class="input-small" name="sale_price" value="{{sale_price}}" placeholder="成交價格">&nbsp;萬(請填寫，以便供後續買賣房屋者參考，謝謝您)</p>
            <p><button type="submit" class="btn">確認送出</button></p>
        </div>
    </div>
    <div id="reservation" class="hide">
        <div class="modal-header">
            <h3>預約/續約刊登</h3>
        </div>
        <div class="modal-body">
            <p><input type="radio" name="is_submit" value="1" {{#if is_submit}}checked="checked"{{/if}}>直接刊登&nbsp;<input type="radio" name="is_submit" value="0" {{#unless is_submit}}checked="checked"{{/unless}}>預約刊登時間: <input type="text" name="submit_date" value="{{submit_date}}" id="submit_date" /></p>
            <p>{{&agent_type}}&nbsp;<input type="text" class="input-small" name="agent_name" value="{{agent_name}}" />&nbsp;先生/小姐&nbsp;<input name="is_owner" type="checkbox" value="1" {{#if is_owner}}checked="checked"{{/if}}> 屋主聲名仲介誤擾</p>
            <p>聯絡電話:<input type="text" name="agent_phone" value="{{agent_phone}}" placeholder="聯絡電話"></p>
            <p><button type="submit" class="btn">確認送出</button></p>
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn btn-danger" href="/sale/edit/{{uid}}">刪除廣告</a><button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</script>
