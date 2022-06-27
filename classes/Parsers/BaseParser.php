<?php

namespace Parsers;

use Core\Sources;

abstract class BaseParser implements Parser
{
    private $sourse;

    private $data;

    public function __construct(Sources $sourse)
    {
        $this->sourse = $sourse;

        $data = $this->getDataFromSource();

        if (!empty($data)) {
            $this->setData($data);
        }
    }

    /**
     * @return Sources
     */
    public function getSource(): Sources
    {
        return $this->sourse;
    }

    /**
     * @param $data
     *
     * @return void
     */
    private function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    abstract public function parse();

    /**
     * @return mixed
     */
    abstract public function getDataFromSource();
}