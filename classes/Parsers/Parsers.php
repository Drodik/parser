<?php

namespace Parsers;

use Core\Sources;

/**
 * @method HtmlTagParser HtmlTagParser(Sources $source)
 */
final class Parsers implements Parser
{
    /**
     * @param $name
     * @param $arguments
     *
     * @return Parser
     * @throws \Exception
     */
    public function __call($name, $arguments): Parser
    {
        try {
            $class = __NAMESPACE__ . "\\{$name}";

            return new $class($arguments[0]);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
