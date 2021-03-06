<?php

declare(strict_types=1);

/*
 * This file is part of the ekino Drupal Debug project.
 *
 * (c) ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ekino\Drupal\Debug\Extension\Iterator;

use Drupal\Core\Extension\Discovery\RecursiveExtensionFilterIterator;

class RecursiveCustomExtensionFilterIterator extends \RecursiveFilterIterator
{
    /**
     * @var string[]
     */
    private $blacklist;

    /**
     * @param \RecursiveDirectoryIterator $iterator
     */
    public function __construct(\RecursiveDirectoryIterator $iterator)
    {
        parent::__construct($iterator);

        $drupalRecursiveExtensionFilterIterator = new RecursiveExtensionFilterIterator(new NullRecursiveIterator(), array(
            'tests',
        ));
        $refl = new \ReflectionProperty($drupalRecursiveExtensionFilterIterator, 'blacklist');
        $refl->setAccessible(true);

        $this->blacklist = $refl->getValue($drupalRecursiveExtensionFilterIterator);
    }

    /**
     * {@inheritdoc}
     */
    public function accept(): bool
    {
        $current = $this->current();
        if (null === $current) {
            return false;
        }

        $filename = $current->getFilename();
        if ('.' === $filename[0]) {
            return false;
        }

        if (!$this->isDir()) {
            return '.info.yml' === \substr($filename, -9);
        }

        if ('config' === $filename) {
            return 'modules/config' === \substr($current->getPathname(), -14);
        }

        return !\in_array($filename, $this->blacklist, true);
    }
}
