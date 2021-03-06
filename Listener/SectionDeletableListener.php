<?php

namespace Unifik\SystemBundle\Listener;

use Unifik\SystemBundle\Lib\BaseDeletableListener;

class SectionDeletableListener extends BaseDeletableListener
{
    /**
     * @inheritedDoc
     */
    public function isDeletable($entity)
    {
        if (count($entity->getChildren()) > 0) {
            $this->addError('This section has one or more subsections.');
        }

        return $this->validate();
    }
}
