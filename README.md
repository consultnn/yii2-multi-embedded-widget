Yii2 widget for multiple mongodb embedded documents
===================================================
Embedded documents behavior(https://github.com/consultnn/yii2-mongodb-embedded)

Example
=======
```
echo $form->field($model, 'phones', ['options' => ['class' => 'col-lg-6 col-sm-6']])->widget(
    \consultnn\widgets\MultiEmbedded::className(),
    [
        'form' => $form,
        'embeddedModelClassName' => \common\models\Phone::className(),
        'embeddedFormName' => Html::getInputName($model, 'phones')
    ]
);
```