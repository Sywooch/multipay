<?php
use yii\db\ActiveRecord;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use common\models\Language;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>

<?php
$form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2 control-label',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]);

?>
<div class="form-group" style='margin-top: 15px;'>
    
    <?= $form->field($model, 'news_title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'news_alias')->textInput(['maxlength' => true]) ?>
    
    <?=
    $form->field($model, 'news_date')->widget(\kartik\date\DatePicker::classname(), [
        'name' => 'dp_1',
        'type' => \kartik\date\DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>
    
    <?=
    $form->field($model, 'news_text')->widget(\vova07\imperavi\Widget::className(), [
        'settings' => [
            'lang' => Language::getCurrent()->lang_url,
            'minHeight' => 200,
            'paragraphize' => false,
            'cleanOnPaste' => false,
            'replaceDivs' => false,
            'linebreaks' => false,
            'allowedTags' => ['p','div','a','img', 'iframe', 'b', 'br', 'ul', 'li',
                'details', 'summary', 'span', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
                'label', 'ol', 'strong', 'italic', 'em', 'del', 'figure'],
            'plugins' => [
                'fullscreen',
                'video',
                'imagemanager',
            ],
            'imageUpload' => Url::to(['/news/image-upload']),
            'imageManagerJson' => Url::to(['/news/images-get']),
        ]
    ])->hint('Для втавки html-кода необходимо включить режим "Код". Разрешенные теги "p", "div", "a", "img", "iframe", "b", "br", "ul", "li",
                "details", "summary", "span", "h1", "h2", "h3", "h4", "h5", "h6","label", "ol", "strong", "figure"');

    ?>

    <?= $form->field($model, 'news_language')->dropDownList(ArrayHelper::map(Language::find()->all(), 'lang_url', 'lang_name')) ?>


    <?= $form->field($model, 'news_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'news_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'news_show')->checkbox([], false) ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    
</div>



