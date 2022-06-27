<?php

namespace Core;

class Result
{
    private $data = null;

    /**
     * @var array
     */
    private array $errors = [];

    /**
     * @param  string  $error
     *
     * @return void
     */
    public function setError(string $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * @return array
     */
    public function returnSuccess(): array
    {
        return [
            'data' => $this->getData(),
            'status' => 'success',
        ];
    }

    /**
     * @return array
     */
    public function returnErrors(): array
    {
        return [
            'data' => $this->getData(),
            'status' => 'error',
            'errors' => implode("; ", $this->getErrors())
        ];
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     *
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}