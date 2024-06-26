<?php

namespace App\Helpers\Overview\DataTables;

class DataTable
{
    private array $headers = [];

    private array $rows = [];

    public function __construct(private string $name, private string $route)
    {
    }

    public static function create(string $name, string $route): self
    {
        return new self($name, $route);
    }

    public function addHeader(string $key, string $title): self
    {
        $this->headers[$key] = $title;

        return $this;
    }

    public function addRow(array $data): self
    {
        $row = [];

        foreach ($this->getHeaders() as $key => $value) {
            if (isset($data[$key])) {
                $row[$key] = $data[$key];
            } else {
                $row[$key] = '';
            }
        }

        $this->rows[] = $row;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function export(): array
    {
        $headers = array_values($this->getHeaders());

        $rows = [];
        foreach ($this->rows as $row) {
            $rows[] = array_values($row);
        }

        return [$headers, $rows];
    }
}
