<?php

namespace Image\Service;

use Api\Action\Service\ActionController;

class ImageController extends ActionController
{
    public function indexAction() {
        return 'hello';
    }

    public function failAction() {
        throw new \Exception('failed');
    }
}