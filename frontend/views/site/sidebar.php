<!-- start widget -->
<div class="widget">
    <h4 class="title">代码下载</h4>
    <div class="content download">
        <a href="https://github.com/amubb/php-yii2-blog" target="_blank" class="btn btn-default btn-block">去Github下载</a>
    </div>
</div>
<!-- end widget -->
<div class="widget">
    <h4 class="title">分类</h4>
    <div class="content category">
        <?=\common\widgets\CategoryList::widget()?>
    </div>
</div>
<!-- start tag cloud widget -->
<div class="widget">
    <h4 class="title">标签云</h4>
    <div class="content tag-cloud">
        <?=\frontend\widgets\TagCloud::widget() ?>
    </div>
</div>