<?php

namespace lib;

class ProductValidatorCSV
{
    private $errors;
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->errors = [];
    }

    public function getListProducts()
    {
        $products = [];
        if ($this->validate())
        {
            foreach ($this->data as $row) {
                $products[$row[0]] = array(
                    'name' => $row[1],
                    'name_trans' => $row[2],
                    'price' => $row[3],
                    'small_text' => $row[4],
                    'big_text' => $row[5]
                );
            }
            return $products;
        }
        return false;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $numRow = 1;
        foreach ($this->data as &$row)
        {
            if (count($row) != 6)
            {
                $this->errors[] = "Кол-во полей в строке($numRow) должно быть 6!";
                break;
            }
            if (!is_numeric($row[0]))
            {
                $this->errors[] = "ID продукта должен быть числовым в строке($numRow)!";
                break;
            }
            $row[0] = (int)$row[0];
            $row[1] = htmlspecialchars(trim($row[1]));
            $row[2] = htmlspecialchars(trim($row[2]));
            $row[3] = (double)$row[3];
            $row[4] = mb_substr(strip_tags(trim($row[4])), 0, 30);
            if (mb_strlen($row[4]) == 0)
            {
                $row[4] = htmlspecialchars(mb_substr(strip_tags(trim($row[5])), 0, 30));
            }

            $row[5] = htmlspecialchars(trim($row[5]));
            $numRow++;
        }
        return empty($this->errors);
    }
}