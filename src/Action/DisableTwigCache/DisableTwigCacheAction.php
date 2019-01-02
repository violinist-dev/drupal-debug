<?php

declare(strict_types=1);

namespace Ekino\Drupal\Debug\Action\DisableTwigCache;

use Ekino\Drupal\Debug\Action\AbstractOverrideTwigConfigAction;

class DisableTwigCacheAction extends AbstractOverrideTwigConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function getOverrides(): array
    {
        return array(
            'cache' => false,
        );
    }
}
