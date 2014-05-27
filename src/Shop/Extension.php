<?php

namespace WebEdit\Shop;

use WebEdit;

final class Extension extends WebEdit\Extension {

    public function loadConfiguration() { //TODO
        $builder = $this->getContainerBuilder();
        $extension = new WebEdit\Reflection($this);
        $file = dirname(dirname($extension->getFileName())) . '/config.neon';
        if (file_exists($file)) {
            $config = $this->loadFromFile($file);
            $this->compiler->parseServices($builder, $config);
        }
    }

}
