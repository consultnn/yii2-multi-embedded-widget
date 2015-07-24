<?php

namespace consultnn\widgets;

use consultnn\multiInput\MultiInput;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;

class MultiEmbedded extends MultiInput
{
    public $embeddedModelClassName;

    public $embeddedFormName;

    public function init()
    {
        if (empty($this->rowView)) {
            throw new InvalidConfigException('rowView required');
        }

        if (empty($this->embeddedModelClassName)) {
            throw new InvalidConfigException('embeddedModelClassName required');
        }

        if (isset($this->embeddedFormName) && count($this->model->{$this->attribute}) > 0) {
            foreach ($this->model->{$this->attribute} as $embeddedModel) {
                /** @var \consultnn\embedded\EmbeddedDocument $embeddedModel */
                $embeddedModel->setFormName($this->embeddedFormName);
            }
        }
        parent::init();
    }

    private function getEmptyModel()
    {
        $emptyModel = new $this->embeddedModelClassName;
        $emptyModel->setFormName($this->embeddedFormName);
        return $emptyModel;
    }

    protected function initEmpty()
    {
        $this->model->{$this->attribute}[] = $this->getEmptyModel();
    }

    protected function renderTemplateRow()
    {
        return Json::encode(Html::tag('div', $this->renderRow('#index#', $this->getEmptyModel()), ['class' => 'template']));
    }
}