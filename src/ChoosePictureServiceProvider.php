<?php

namespace Encore\ChoosePicture;

use Illuminate\Support\ServiceProvider;

class ChoosePictureServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(ChoosePicture $extension)
    {
        if (! ChoosePicture::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'ChoosePicture');
        }

    }
}
