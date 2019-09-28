<?php
use yii\bootstrap\Modal;
use \yii\bootstrap\Carousel;
use \yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
use \yii\helpers\Url;
use kartik\datetime\DateTimePicker;


?>

<div class="publish-preview-post" id="post_<?= $model->id?>">

<div class="publish_post_header">
    <div>    <label style="padding-bottom: 10px" title="Выбрать пост">
            <input type="checkbox" id="checkbox_<?= $model->id?>" class="option-input checkbox publish_checkbox" />
        </label></div>
    <div class="btn-group"  role="group" aria-label="Basic example">

        <?php Modal::begin([
            'toggleButton' => [
                'tag' => 'button',
                'type' => 'button',
                'title' => 'Загрузить пост',
                'class' => 'btn btn_posts btn-secondary',
                'label' => '<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>'],
            'header' => '',
            'footer' => '',
            'closeButton' => ['label' => 'Закрыть']
        ]); ?>
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['publish/create-schedule',
                'id' => $model->id,
                'user_id' => $user_id,
                'status' => 0
            ])]);?>
        <?=$form->field($scheduleForm, 'group_id')->dropDownList($groups, ['prompt' => 'Выберите группу...'])->label('Выберите группу для загрузки');?>
        <?=$form->field($scheduleForm, 'dateTime')->hiddenInput(['value' => date('Y-m-d H:i:s')]);?>
        <?=Html::submitButton("Сохранить",['class' => 'btn btn-default']);?>
        <?ActiveForm::end()?>
        <?php Modal::end();?>

        <?php Modal::begin([
            'toggleButton' => [
                'tag' => 'button',
                'type' => 'button',
                'title' => 'Запланировать загрузку',
                'class' => 'btn btn_posts btn-secondary',
                'label' => '<i class="fa fa-clock-o" aria-hidden="true"></i>'],
            'header' => '',
            'footer' => '',
            'closeButton' => ['label' => 'Закрыть']
        ]); ?>
        <?php $form = ActiveForm::begin([
                'action' => Url::to(['publish/create-schedule',
            'id' => $model->id,
            'user_id' => $user_id,
            'status' => 1
        ])]);?>
        <?=$form->field($scheduleForm, 'group_id')->dropDownList($groups, ['prompt' => 'Выберите группу...'])->label('Выберите группу для загрузки');?>
        <?=$form->field($scheduleForm, 'dateTime')->widget(DateTimePicker::class, [
            'name' => 'datetime_10',
            'options' => ['placeholder' => 'Укажите время для отправки'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd hh:i',
                'startDate' => '01-Mar-2014 12:00 AM',
                'todayHighlight' => true
            ]
        ]);
        ?>
        <?=Html::submitButton("Сохранить",['class' => 'btn btn-default']);?>
        <?ActiveForm::end()?>
        <?php Modal::end();?>

        <?php Modal::begin([
            'toggleButton' => [
                'tag' => 'button',
                'type' => 'button',
                'title' =>'Редактировать пост',
                'class' => 'btn btn_posts btn-secondary publish_edit_button',
                'label' => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'],
            'header' => 'Редактировать пост',
            'footer' => '<div class="publish_post_statBlock" style="padding: 2rem; padding-bottom: 0; float: right;">
                        <div class="publish_post_statBlock__date">
                                <span>99 шлёптября 2007г</span>
                        </div>
                        <div class="publish_post_statBlock__stat">
                             <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span> 9999</span>
                             <i class="fa fa-share-square-o" aria-hidden="true"></i><span> 9999</span>
                             <i class="fa fa-comments-o" aria-hidden="true"></i><span> 9999</span>
                         </div>
                    </div>',
            'closeButton' => ['label' => 'Закрыть']
        ]);?>
            <div class="publish_post_edit" id="edit_post_<?= $model->id?>">
            <?php if(isset($photoArray)):?>
                <?php foreach($photoArray as $one):?>
                            <div class="publish_post_edit__image"  data-id_media_content="<?= $one['id']?>"><img src="<?= $one['url']?>" alt="" width="100%"></div>
                <? endforeach;?>
            <? else:?>
                <div class="publish-preview-image__image" data-id="<?= $model->id?>"><img src="/img/no_photo.jpg" alt="No Image" style="width: 100%; "> <hr></div>
            <? endif;?>
        </div>
            <?php $form = ActiveForm::begin(['action' => Url::to(['publish/edit-post','id' => $model->id])]);?>
            <?=$form->field($model, 'text')->textarea(['rows' => 10, 'cols' => 4])->label('');?>
            <?=Html::submitButton("Сохранить",['class' => 'btn btn-default']);?>
            <?ActiveForm::end()?>
        <?php Modal::end();?>

        <?php Modal::begin([
            'toggleButton' => [
                'tag' => 'button',
                'type' => 'button',
                'title' => 'Просмотр',
                'class' => 'btn btn_posts btn-secondary',
                'label' => '<i class="fa fa-eye" aria-hidden="true"></i>'],
            'header' => '',
            'footer' => '
                    <div class="publish_post_statBlock" style="padding: 2rem; padding-bottom: 0; float: right;">
                        <div class="publish_post_statBlock__date">
                                <span>99 шлёптября 2007г</span>
                        </div>
                        <div class="publish_post_statBlock__stat">
                             <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span> 9999</span>
                             <i class="fa fa-share-square-o" aria-hidden="true"></i><span> 9999</span>
                             <i class="fa fa-comments-o" aria-hidden="true"></i><span> 9999</span>
                         </div>
                    </div>
                ',
            'closeButton' => ['label' => 'Закрыть']
        ]); ?>
        <?php
        if (isset($photo)):?>
            <div class="publish-preview-image__carousel">
                <?php echo Carousel::widget([
                    'items' => $carouselItems,
                    'options' => [
                        'style' => 'width:100%',
                        'data-interval' => '12000'
                    ],
                    'controls' => [
                        '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
                        '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>',
                    ]
                ]);
                ?></div>
        <? else: ?>
            <div class="publish-preview-image__carousel" data-id="<?= $model->id ?>">
                <img src="/img/no_photo.jpg" alt="No Image" style="width: 100%; ">
                <hr>
            </div>
        <? endif; ?>
        <div class="publish-preview-content"><?= $model->text ?></div>
        <?php Modal::end(); ?>
        <button type="button" title="Копировать пост" class="btn btn_posts btn-secondary" onclick="location.href ='<?=Url::to(['publish/copy-post','id' => $model->id])?>'">
            <i class="fa fa-files-o" aria-hidden="true"></i>
        </button>
        <button type="button" title="Удалить пост" class="btn btn_posts btn-secondary" onclick="location.href ='<?=Url::to(['publish/delete-post','id' => $model->id])?>'">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>

    </div>
</div>
<div class="publish_post_schedule">
        <?php foreach($scheduleArray as $one):?>
            <div class="publish_post_schedule_elem">
                <div class="publish_post_schedule_elem__text"><?=$one['dateTime']?></div>
                <div class="publish_post_schedule_elem__status"><?=\app\models\tables\PostSchedule::getStatus($one['status'])?></div>
                <div class="publish_post_schedule_elem__delete" onclick="location.href ='<?=Url::to(['publish/delete-schedule','id' => $one['id']])?>'"><i class="fa fa-times-circle-o" aria-hidden="true"></i></div>
            </div>
        <? endforeach;?>
</div>

    <?php if(isset($photo)):?>
    <div class="publish-preview-image"><img src="<?= $photo?>" alt="VK_Photo" style="width: 100%"> <hr></div>
    <? else:?>
    <div class="publish-preview-image"><img src="/img/no_photo.jpg" alt="No Image" style="width: 100%; "> <hr></div>
    <? endif;?>
    <div class="publish-preview-content"><?= $model->text?> </div>


    <!-- TODO оставил статистику на будущее, так же этот код есть в модальном окне
    <div class="publish_post_statBlock" style="padding: 2rem; padding-bottom: 0; float: right;">
        <div class="publish_post_statBlock__date">
            <span>99 шлёптября 2007г</span>
        </div>
        <div class="publish_post_statBlock__stat">
            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><span> 9999</span>
            <i class="fa fa-share-square-o" aria-hidden="true"></i><span> 9999</span>
            <i class="fa fa-comments-o" aria-hidden="true"></i><span> 9999</span>

        </div>
    </div>
-->
</div>

