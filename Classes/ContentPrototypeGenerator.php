<?php

namespace Medialib\Fusion\PrototypeGenerator;

use Neos\ContentRepository\Domain\Model\NodeType;
use Neos\Flow\Annotations as Flow;
use Neos\Neos\Domain\Service\DefaultPrototypeGeneratorInterface;

/**
 * @Flow\Scope("singleton")
 * @api
 */
class ContentPrototypeGenerator implements DefaultPrototypeGeneratorInterface
{
    public function generate(NodeType $nodeType)
    {
        if (strpos($nodeType->getName(), ':') === false) {
            return '';
        }

        $prototypeName = $nodeType->getName();

        $output = [];
        $output[] = 'prototype(' . $prototypeName . ') < prototype(Carbon.Notification:Backend) {';
        $output[] = '    type = \'alert\'';
        $output[] = '    content = \'Sorry, the required prototype is not configured. <br><small>Create a Fusion prototype named <b>' . $prototypeName . '</b></small>\'';
        $output[] = '    @process.contentElementWrapping {';
        $output[] = '        expression = Neos.Neos:ContentElementWrapping';
        $output[] = '        @position = \'end 999999999\'';
        $output[] = '    }';
        $output[] = '}';

        return chr(10) . implode(chr(10), $output) . chr(10);
    }
}
