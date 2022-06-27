<?php

namespace Core;

use Parsers\Parsers;

class Controller
{
    private Result $result;

    private Sources $source;

    private static $instance;

    private function __construct()
    {
        $this->result = new Result();

        $this->source = new Sources();
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return Result
     */
    public function getResult(): Result
    {
        return $this->result;
    }

    /**
     * @return Sources
     */
    public function getSource(): Sources
    {
        return $this->source;
    }

    /**
     * @return Parsers
     */
    public function getParsers(): Parsers
    {
        return new Parsers;
    }

    /**
     * @param  string  $sourceType  = url|file
     * @param $source
     *
     * @return array
     */
    public function getHtmlTags(string $sourceType, $source): array
    {
        $result = $this->getResult();

        if (empty($source)) {
            $result->setError('Не передан источник');

            return $result->returnErrors();
        }

        switch ($sourceType) {
            case "url":
                $this->getSource()->setSourceUrl($source);
                break;

            default:
                $result->setError("Источник не найден");
                break;
        }

        try {
            $parser = $this->getParsers()->HtmlTagParser($this->getSource());

            $result->setData($parser->parse());
        } catch (\Throwable $e) {
            $result->setError($e->getMessage());
        }

        return ($result->hasErrors()) ? $result->returnErrors() : $result->returnSuccess();
    }
}