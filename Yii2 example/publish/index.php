<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\assets\PostfinalAsset;
use \app\assets\PublishAsset;
use yii\grid\ActionColumn;
use \acerix\yii2\readmore\Readmore;


PostfinalAsset::register($this);
PublishAsset::register($this);
echo Readmore::widget();

?>

<div class="informing-text">
    <h4 class="informing-text-h4">Ваши сохраненные публикации</h4>

    <?php if ($addedPosts): ?>

        <?php

        $content = $addedPosts . ' были сохранены для редактирования и отправки в группы.';

        echo Html::tag('h4', $content, ['class' => 'informing-text-h4']) ?>
    <?php endif; ?>

</div>
<?= Html::button('Удалить все посты', ['class' => 'btn btn_posts', 'id' => 'reset-button', 'style' => 'margin-bottom: 20px']); ?>
<div class="for-posts">

    <?php

    /** @var \yii\data\ActiveDataProvider $dataProvider */
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => function ($model) {
            return \app\widgets\PublishPreview::widget([
                'model' => $model
            ]);
        },
        'summary' => false,
        'options' => [
            'class' => 'publish_post_container'
        ],
    ])
    ?>
</div>
