<?php

namespace App\Database;

class QueryBuilder
{
    private string $table = '';
    private array $columns = [];
    private array $where = [];
    private array $orderBy = [];

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(array $columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    public function where(string $field, string $operator, $value): self
    {
        $this->where[] = "$field $operator '" . addslashes($value) . "'";
        return $this;
    }

    public function orderBy(string $field, string $direction = 'ASC'): self
    {
        $this->orderBy[] = "$field $direction";
        return $this;
    }

    public function build(): string
    {
        $query = "SELECT ";

        $query .= empty($this->columns)
            ? "*"
            : implode(', ', $this->columns);

        $query .= " FROM {$this->table}";

        if (!empty($this->where)) {
            $query .= " WHERE " . implode(' AND ', $this->where);
        }

        if (!empty($this->orderBy)) {
            $query .= " ORDER BY " . implode(', ', $this->orderBy);
        }

        return $query . ";";
    }
}