<?php

namespace WebEdit\Shop;

use WebEdit;

final class Extension extends WebEdit\Extension {

    public function loadConfiguration() { //TODO: remove config file
        $config = dirname(dirname($this->reflection->getFileName())) . '/config.neon';
        if (file_exists($config)) {
            $this->compiler->parseServices($this->getContainerBuilder(), $this->loadFromFile($config));
        }
    }

}
