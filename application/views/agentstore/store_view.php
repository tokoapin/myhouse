<style>
    .medium-img {
        height: 200px;
    }
</style>

<div style="float:left;">
    <img src="/assets//img/AAA.jpg" class="img-polaroid medium-img" >
</div>
<div style="float:left;">
    <dl class="dl-horizontal">
        <dt>姓名</dt>
            <dd>:<?php echo $item['username']?></dd>
        <dt>成交額</dt>
            <dd>not yet</dd>
        <dt>服務區域</dt>
            <dd>:<?php echo $item['county']?></dd>
        <dt>服務經歷</dt>
            <dd>:<?php echo $item['service']?></dd>
        <dt>Motto</dt>
            <dd>:<?php echo $item['motto']?></dd>
        <dt>業務特長</dt>
            <dd>:<?php echo $item['skill']?></dd>
        <dt>關羽我</dt>
            <dd>:<?php echo $item['aboutme']?></dd>
    </dl>
</div>

<p style="both:clear;"></>