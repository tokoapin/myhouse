<form class="form-horizontal" method="POST" action="<?php echo site_url('sale/save'); ?>">
    <div class="control-group">
        <label class="control-label">房屋型態</label>
        <div class="controls">
            <?php echo form_dropdown('type', $_house_type, (isset($item['title'])) ? $item['title'] : '');?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">廣告標題</label>
        <div class="controls">
            <input type="text" name="title" placeholder="6~20字 請儘可能醒目亮眼" value="<?php echo (isset($item['title'])) ? $item['title'] : ''; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">價金</label>
        <div class="controls">
            <input type="text" name="price" value="<?php echo (isset($item['price'])) ? $item['price'] : ''; ?>" class="input-mini" placeholder="請填數字"> 萬元，單價: <input type="text" name="per_price" value="<?php echo (isset($item['per_price'])) ? $item['per_price'] : ''; ?>" class="input-mini" placeholder="請填數字"> 萬元/坪
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">登記總坪數</label>
        <div class="controls">
            <input type="text" name="total_feet" value="<?php echo (isset($item['total_feet'])) ? $item['total_feet'] : ''; ?>" class="input-mini" placeholder="請填數字"> 坪，主建築物 <input type="text" name="major_feet" value="<?php echo (isset($item['major_feet'])) ? $item['major_feet'] : ''; ?>" class="input-mini" placeholder="請填數字"> 坪，附屬建築物 <input type="text" name="attach_feet" value="<?php echo (isset($item['attach_feet'])) ? $item['attach_feet'] : ''; ?>" class="input-mini" placeholder="請填數字"> 坪，公用部份 <input type="text" name="public_feet" value="<?php echo (isset($item['public_feet'])) ? $item['public_feet'] : ''; ?>" class="input-mini" placeholder="請填數字"> 坪，土地 <input type="text" name="land_feet" value="<?php echo (isset($item['land_feet'])) ? $item['land_feet'] : ''; ?>" class="input-mini" placeholder="請填數字"> 坪
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">格局</label>
        <div class="controls">
            <input type="text" name="room" value="<?php echo (isset($item['room'])) ? $item['room'] : ''; ?>" class="input-mini" placeholder="請填數字"> 房 <input type="text" name="parlor" value="<?php echo (isset($item['parlor'])) ? $item['parlor'] : ''; ?>" class="input-mini" placeholder="請填數字"> 廳 <input type="text" name="bathroom" value="<?php echo (isset($item['bathroom'])) ? $item['bathroom'] : ''; ?>" class="input-mini" placeholder="請填數字"> 衛 <input type="text" name="balcony" value="<?php echo (isset($item['balcony'])) ? $item['balcony'] : ''; ?>" class="input-mini" placeholder="請填數字"> 陽台  樓層: <input type="text" name="floor" value="<?php echo (isset($item['floor'])) ? $item['floor'] : ''; ?>" class="input-mini" placeholder="請填數字">/<input type="text" name="total_floor" value="<?php echo (isset($item['total_floor'])) ? $item['total_floor'] : ''; ?>" class="input-mini" placeholder="請填數字"> (層/整棟) 屋齡 <input type="text" name="age" value="<?php echo (isset($item['age'])) ? $item['age'] : ''; ?>" class="input-mini" placeholder="請填數字">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">車位</label>
        <div class="controls">
            <?php echo form_dropdown('car_num', $_car_num, (isset($item['car_num'])) ? $item['car_num'] : '', 'class="input-small"');?>&nbsp;<?php echo form_dropdown('car_type', $_car_type, (isset($item['car_type'])) ? $item['car_type'] : '', 'class="input-small"');?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">社區建案</label>
        <div class="controls">
            <input type="text" name="house_title" value="<?php echo (isset($item['house_title'])) ? $item['house_title'] : ''; ?>" placeholder="若無社區建案可不必填寫">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">地址</label>
        <div class="controls">
            <div id="container"></div><input type="text" name="number" value="<?php echo (isset($item['number'])) ? $item['number'] : ''; ?>" placeholder="門牌號碼" class="input-mini"> <input name="hidden_number" type="checkbox" value="1" <?php echo (isset($item['hidden_number']) and $item['hidden_number'] == '1') ? 'checked="checked"' : ''; ?>> 隱藏門牌號碼
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">管理費</label>
        <div class="controls">
            <input type="text" name="manager_price" value="<?php echo (isset($item['manager_price'])) ? $item['manager_price'] : ''; ?>" placeholder="請填數字"> 元/月，座向 <input type="text" name="position" value="<?php echo (isset($item['position'])) ? $item['position'] : ''; ?>" placeholder="座南朝北">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">裝潢程度</label>
        <div class="controls">
            <?php echo form_dropdown('decorating_type', $_decorating_type, (isset($item['decorating_type'])) ? $item['decorating_type'] : '', 'class="input-small"');?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">生活機能</label>
        <div class="controls">
            <?php
            foreach($_facility_type as $k => $v):
                $data = array(
                    'name' => 'facility_type[]',
                    'value' => $k,
                    'checked' => (isset($item['facility_type']) and is_array($item['facility_type']) and in_array($k, $item['facility_type'])) ? true : false
                );
                echo form_checkbox($data) . "&nbsp;" . $v;
            ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">附近交通</label>
        <div class="controls">
            <input type="text" name="traffic" value="<?php echo (isset($item['traffic'])) ? $item['traffic'] : ''; ?>" placeholder="請描述附近交通">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">帶租約</label>
        <div class="controls">
            <input type="radio" name="is_lease" value="1" <?php echo (isset($item['is_lease']) and $item['is_lease'] == '1') ? 'checked="checked"' : ''; ?>>有&nbsp;<input type="radio" name="is_lease" value="0" <?php echo ((isset($item['is_lease']) and $item['is_lease'] == '0') or $mode == 'add') ? 'checked="checked"' : ''; ?>>無
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">刊登狀態</label>
        <div class="controls">
            <input type="radio" name="is_submit" value="1" <?php echo ((isset($item['is_submit']) and $item['is_submit'] == '1') or $mode == 'add') ? 'checked="checked"' : ''; ?>>直接刊登&nbsp;<input type="radio" name="is_submit" value="0" <?php echo (isset($item['is_submit']) and $item['is_submit'] == '0') ? 'checked="checked"' : ''; ?>>預約刊登時間: <input type="text" name="submit_date" value="<?php echo (isset($item['submit_date'])) ? $item['submit_date'] : ''; ?>" id="submit_date" />
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">聯絡人</label>
        <div class="controls">
            <?php echo form_dropdown('agent_type', $_agent_type, (isset($item['agent_type'])) ? $item['agent_type'] : '', 'class="input-small"');?>&nbsp;<input type="text" name="agent_name" value="<?php echo (isset($item['agent_name'])) ? $item['agent_name'] : ''; ?>" />先生/小姐&nbsp;<input name="is_owner" type="checkbox" <?php echo (isset($item['is_owner']) and $item['is_owner'] == '1') ? 'checked="checked"' : ''; ?>> 屋主聲名仲介誤擾
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">聯絡電話</label>
        <div class="controls">
            <input type="text" name="agent_phone" value="<?php echo (isset($item['agent_phone'])) ? $item['agent_phone'] : ''; ?>" placeholder="聯絡電話">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">特色說明</label>
        <div class="controls">
            <textarea name="description" rows="6"><?php echo (isset($item['description'])) ? $item['description'] : ''; ?></textarea>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <?php if ($mode == 'add'): ?>
            <label class="checkbox">
                <input type="checkbox"> 我已詳細閱讀刊登規則
            </label>
            <?php endif;?>
            <?php if ($mode == 'edit'): ?>
            <input type="hidden" name="uid" value="<?php echo $item['uid']; ?>">
            <?php endif?>
            <input type="hidden" name="mode" value="<?php echo $mode; ?>">
            <button type="submit" class="btn">確認送出</button>
        </div>
    </div>
</form>
<script>
$(function () {
    $('#container').twzipcode({
        css: ["input-small", "input-small", "input-small"],
        countySel: "<?php echo (isset($item['county'])) ? $item['county'] : ''; ?>",
        districtSel: "<?php echo (isset($item['district'])) ? $item['district'] : ''; ?>",
        zipcodeSel: "<?php echo (isset($item['zipcode'])) ? $item['zipcode'] : ''; ?>",
        addressSel: "<?php echo (isset($item['address'])) ? $item['address'] : ''; ?>"
    });
});
</script>
