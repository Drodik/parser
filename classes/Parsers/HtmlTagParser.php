<?php

namespace Parsers;

class HtmlTagParser extends BaseParser
{
    /**
     * @return array
     * @throws \Exception
     */
    public function parse(): array
    {
        $re = '/<(\w*).*?>/m';

        preg_match_all($re, $this->getData(), $matches, PREG_SET_ORDER, 0);

        $matches = array_filter(array_column($matches, 1));

        if (empty($matches)) {
            throw new \Exception("Теги не найдены");
        }

        return $matches;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getDataFromSource(): string
    {
        $data = file_get_contents($this->getSourse()->getCurrentSource());

        if (!$data) {
            throw new \Exception(
                "Отсутствуют данные из {$this->getSourse()->getCurrentSourceType()} источника"
            );
        }

        return $data;
    }
}