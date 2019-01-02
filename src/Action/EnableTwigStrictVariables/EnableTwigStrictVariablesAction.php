<?php

declare(strict_types=1);

namespace Ekino\Drupal\Debug\Action\EnableTwigStrictVariables;

use Ekino\Drupal\Debug\Action\AbstractOverrideTwigConfigAction;

class EnableTwigStrictVariablesAction extends AbstractOverrideTwigConfigAction
{
    /**
     * {@inheritdoc}
     */
    protected function getOverrides(): array
    {
        return array(
            'strict_variables' => true,
        );
    }
}
