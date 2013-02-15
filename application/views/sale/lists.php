<table class="table table-condensed">
<thead>
    <tr>
        <th>物件編號</th>
        <th>物件標題</th>
        <th>樓覽</th>
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
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['view_count'];?></td>
            <td><?php echo $row['phone_count'];?> 通</td>
            <td><?php echo $row['favorite_count'];?></td>
            <td></td>
            <td><?php echo $row['question_count'];?></td>
            <td><?php echo $row['reply_count'];?></td>
            <td><button class="btn btn-primary" type="button">管理物件</button></td>
            <td><?php echo $_house_status[$row['status']];?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
