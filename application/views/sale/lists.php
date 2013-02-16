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
        <?php foreach($rows as $row): ?>
        <tr>
            <td><?php echo $row['uid'];?></td>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['view_count'];?></td>
            <td><?php echo $row['phone_count'];?> 通</td>
            <td><?php echo $row['favorite_count'];?></td>
            <td></td>
            <td><?php echo $row['question_count'];?></td>
            <td><?php echo $row['reply_count'];?></td>
            <td><a class="btn btn-primary" href="/sale/edit/<?php echo $row['uid']?>">管理物件</a></td>
            <td><?php echo $_house_status[$row['status']];?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
