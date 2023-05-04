<?php

namespace models;
use PDO;

class Product extends \core\Model
{
    const TABLE_NAME = 'product';

    public function getProducts(): array
    {
        $listProducts = $this->db->getRows(self::TABLE_NAME);
        if ($listProducts === false) return [];
        return $listProducts;
    }

    public function getUserProducts($userID): array
    {
        $userID = (int)$userID;
        $sql = "SELECT id, name, name_trans, price, small_text, big_text FROM " . self::TABLE_NAME .
            " WHERE user_id = :user_id";
        $query = $this->db->safeQuery($sql, ['user_id' => $userID]);
        if ($query === false) return [];
        $listProducts = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($listProducts === false) return [];
        return $listProducts;
    }

    public function updateUserProducts($userID, $products): int
    {
        $sql = "UPDATE " . self::TABLE_NAME . " SET name = :name, name_trans = :name_trans, price = :price, "
            . "small_text = :small_text, big_text = :big_text "
            . "WHERE user_id = :user_id AND id = :id";
        $countUpdated = 0;
        $params = array();
        foreach ($products as $id => $product)
        {
            $params['id'] = $id;
            $params['name'] = $product['name'];
            $params['name_trans'] = $product['name_trans'];
            $params['price'] = $product['price'];
            $params['small_text'] = $product['small_text'];
            $params['big_text'] = $product['big_text'];
            $params['user_id'] = (int)$userID;
            $query = $this->db->safeQuery($sql, $params);
            if ($query !== false) $countUpdated++;
        }
        return $countUpdated;
    }

    public function insertUserProducts($userID, $products): int
    {
        $params = array();
        $countInserts = 0;
        foreach ($products as $idProduct => $product)
        {
            $params['id'] = $idProduct;
            $params['name'] = $product['name'];
            $params['name_trans'] = $product['name_trans'];
            $params['price'] = $product['price'];
            $params['small_text'] = $product['small_text'];
            $params['big_text'] = $product['big_text'];
            $params['user_id'] = (int)$userID;
            $query = $this->insertProduct($params);
            if ($query !== false) $countInserts++;
        }
        return $countInserts;
    }

    private function insertProduct($product)
    {
        $sql = sprintf('INSERT INTO %s VALUES (:id, :name, :name_trans, :price, :small_text, :big_text, :user_id)',
        self::TABLE_NAME);
        return $this->db->safeQuery($sql, $product);
    }

}
