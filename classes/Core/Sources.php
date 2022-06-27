<?php

namespace Core;

final class Sources
{
    /**
     * Тип Источника
     *
     * @var string
     */
    private string $currentSourceType = "null";

    /**
     * Источник
     *
     * @var
     */
    private $currentSource = null;

    /**
     * @return mixed
     */
    public function getCurrentSource()
    {
        return $this->currentSource;
    }

    /**
     * @return string
     */
    public function getCurrentSourceType(): string
    {
        return $this->currentSourceType;
    }

    /**
     * @param  string  $source
     *
     * @return $this
     */
    public function setSourceUrl(string $source): Sources
    {
        $this->currentSourceType = 'url';
        $this->currentSource = $source;

        return $this;
    }
}