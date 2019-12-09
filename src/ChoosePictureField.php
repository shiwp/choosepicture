<?php

namespace Encore\ChoosePicture;

use Encore\Admin\Form\Field;

class ChoosePictureField extends Field
{
    public $view = 'ChoosePicture::view_picture';

    public $pictures = null;
    protected $variables = null;

    public function model($model,$field){
        $data = $model->all()->toArray();
        $this->pictures = $data ? array_column($data,$field) : [];
        return $this;
    }

    public function render()
    {
        $this->variables = [
            'list'=>$this->pictures
        ];
        return parent::render();
    }
}
