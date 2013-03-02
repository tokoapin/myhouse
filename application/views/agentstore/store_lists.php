<table class="table table-condensed">
    <thead>
        <tr>
            <th>姓名</th>
            <th>電話</th>
            <th>性別</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($rows as $row):
        ?>
        <tr>
            <td><?php echo $row['username'];?></td>
            <td><?php echo $row['phone'];?></td>
            <td><?php echo $row['gender'];?></td>
            <td>
                <a class="btn btn-primary" data-iduser="<?php echo $row['iduser'];?>" name="view_store">View</a>
                <a class="btn btn-primary" data-iduser="<?php echo $row['iduser'];?>" name="add_store">Add</a>
                <a class="btn btn-primary" data-iduser="<?php echo $row['iduser'];?>" name="edit_store">Edit</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<script>
$(document).ready(function(){
    $('[name=view_store]').on('click', function(e){
        var uid = $(this).data('iduser');
        window.location="/agentstore/view/"+uid;
    });

    $('[name=add_store]').on('click', function(e){
        var uid = $(this).data('iduser');
        window.location="/agentstore/add/"+uid;
    });

    $('[name=edit_store]').on('click', function(e){
        var uid = $(this).data('iduser');
        window.location="/agentstore/edit/"+uid;
    });
});

</script>

