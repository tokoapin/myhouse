<?php echo validation_errors(); ?>

<form id="form" class="form-horizontal" method="POST" action="<?php echo site_url('agentstore/save'); ?>">
	<h3>經紀人員店舖</h3>
	<div class="control-group">
		<label class="control-label" for="motto">打招呼/工作態度/特質</label>
		<div class="controls">
			<input type="text" id="motto" name="motto" placeholder="您好，永遠將「顧客滿意」擺第一位，用心聆聽客戶的聲音，我在甜蜜屋隨時為您服務" 
			value="">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="area">服務區域</label>
		<div class="controls">
			<div id="twzipcode_area"></div>
		</div> 
	</div>
	<div class="control-group">
		<label class="control-label" for="service">服務經歷</label>
		<div class="controls">
			<input type="text" id="service" name="service" value="">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="skill">業務特長</label>
		<div class="controls">
			<input type="text" id="skill" name="skill" value="">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="aboutme">關於我</label>
		<div class="controls">
			<textarea id="aboutme" name="aboutme" rows="6"></textarea>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" ></label>
		<button type="submit" class="btn">確認送出</button>
        <input type="hidden" name="mode" value="">
        <input type="hidden" name="iduser" value="">
	</div>
</form>

<style>
	.hide {	display:none; }
</style>

<script>
$(function () {
	$('#twzipcode_area').twzipcode({
		css: ["input-small", "hide", "hide", "hide"],
		addressSel: ""
	});
});
</script>

<!-- fill the page -->
<script>
$(function () {
    var mode = '<?php echo (isset($mode)) ? "$mode" : "add" ; ?>';
    var jform = $("#form");

    if(mode === "edit")
    {
        jform.find("[name=motto]").val('<?php echo (isset($item["motto"])) ? $item["motto"] : "" ; ?>');
        jform.find("[name=service]").val('<?php echo (isset($item["service"])) ? $item["service"] : "" ; ?>');
        jform.find("[name=skill]").val('<?php echo (isset($item["skill"])) ? $item["skill"] : "" ; ?>');
        jform.find("[name=aboutme]").val('<?php echo (isset($item["aboutme"])) ? $item["aboutme"] : "" ; ?>');
    }
    else 
    {
        //debug add !
        jform.find("[name=motto]").val("hello");
        jform.find("[name=service]").val("hello1");
        jform.find("[name=skill]").val("hello2");
        jform.find("[name=aboutme]").val("hello3");
    }
    jform.find("[name=mode]").val(mode);
    jform.find("[name=iduser]").val('<?php echo (isset($item["iduser"])) ? $item["iduser"] : "" ; ?>');
});
</script>

