<form class="form-horizontal">
    <div class="control-group">
        <label class="control-label">房屋型態</label>
        <div class="controls">
            <?php echo form_dropdown('house_type', $house_type);?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">廣告標題</label>
        <div class="controls">
            <input type="text" placeholder="6~20字 請儘可能醒目亮眼">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">價金</label>
        <div class="controls">
            <input type="text" class="input-mini" placeholder="請填數字"> 萬元，單價: <input type="text" class="input-mini" placeholder="請填數字"> 萬元/坪
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">登記總坪數</label>
        <div class="controls">
            <input type="text" class="input-mini" placeholder="請填數字"> 坪，主建築物 <input type="text" class="input-mini" placeholder="請填數字"> 坪，附屬建築物 <input type="text" class="input-mini" placeholder="請填數字"> 坪，公用部份 <input type="text" class="input-mini" placeholder="請填數字"> 坪，土地 <input type="text" class="input-mini" placeholder="請填數字"> 坪
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">格局</label>
        <div class="controls">
            <input type="text" class="input-mini" placeholder="請填數字"> 房 <input type="text" class="input-mini" placeholder="請填數字"> 廳 <input type="text" class="input-mini" placeholder="請填數字"> 衛 <input type="text" class="input-mini" placeholder="請填數字"> 陽台  樓層: <input type="text" class="input-mini" placeholder="請填數字">/<input type="text" class="input-mini" placeholder="請填數字"> (層/整棟) 屋齡
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">車位</label>
        <div class="controls">
            <?php echo form_dropdown('car_num', $car_num, null, 'class="input-small"');?>&nbsp;<?php echo form_dropdown('car_type', $car_type, null, 'class="input-small"');?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">社區建案</label>
        <div class="controls">
            <input type="text" placeholder="若無社區建案可不必填寫">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">社區建案</label>
        <div class="controls">
            <input type="text" placeholder="若無社區建案可不必填寫">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">管理費</label>
        <div class="controls">
            <input type="text" placeholder="請填數字"> 元/月，座向 <input type="text" placeholder="座南朝北">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">裝潢程度</label>
        <div class="controls">
            <?php echo form_dropdown('decorating_type', $_decorating_type, null, 'class="input-small"');?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">生活機能</label>
        <div class="controls">
            <?php
            foreach($_facility_type as $k => $v):
                $data = array(
                    'name'        => 'facility_type[]',
                    'value'       => $k
                );
                echo form_checkbox($data) . "&nbsp;" . $v;
            ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">附近交通</label>
        <div class="controls">
            <input type="text" placeholder="請描述附近交通">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">帶租約</label>
        <div class="controls">
            <input type="radio" name="is_contract" value="1">有&nbsp;<input type="radio" name="is_contract" value="0" checked>無
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <label class="checkbox">
                <input type="checkbox"> 我已詳細閱讀刊登規則
            </label>
            <button type="submit" class="btn">確認送出</button>
        </div>
    </div>
</form>
