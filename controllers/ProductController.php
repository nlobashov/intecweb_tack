<?php
namespace controllers;

use core\Controller;
use lib\CSVHelper;
use lib\ProductValidatorCSV;

class ProductController extends Controller
{
    public function index()
    {
        $model = $this->loadModel('Product');
        $this->data['products'] = $model->getProducts();
        $this->view->render($this->data);
    }

    public function export()
    {
        if (!isset($_SESSION['user_id'])) die('Error: ID пользователя не задан');
        $userID = (int)$_SESSION['user_id'];
        $model = $this->loadModel('Product');
        $products = $model->getUserProducts($userID);
        CSVHelper::exportCSV($products);
    }

    public function import()
    {
        if (!isset($_SESSION['user_id'])) die('Error: ID пользователя не задан');
        $userID = (int)$_SESSION['user_id'];
        $model = $this->loadModel('Product');
        if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] == 0)
        {
            //Загрузка файла от пользователя, парсинг CSV и валидация
            $filename = $_FILES['userfile']['tmp_name'];
            $csvData = CSVHelper::getCSV($filename);
            $productValidator = new ProductValidatorCSV($csvData);
            $productsFromFile = $productValidator->getListProducts();
            if ($productsFromFile !== false)
            {
                //Получаем текущие продукты юзера из БД для сравнения с данными из файла
                $listProductsID = array();
                foreach ($model->getUserProducts($userID) as $row)
                {
                    // Добавляем в массив все ID продуктов, которые уже есть в базе
                    $listProductsID[] = (int)$row['id'];
                }
                $listProductsForUpdate = array();
                foreach ($listProductsID as $idProduct)
                {
                    // Если в файле был продукт с ID товара из БД, то добавляем это значение в новый массив,
                    // и удаляем его из текущего массива
                    if (isset($productsFromFile[$idProduct]))
                    {
                        $listProductsForUpdate[$idProduct] = $productsFromFile[$idProduct];
                        unset($productsFromFile[$idProduct]);
                    }
                }
                $this->data['countRowUpdated'] = $model->updateUserProducts($userID, $listProductsForUpdate);
                $this->data['countRowInserts'] = $model->insertUserProducts($userID, $productsFromFile);
            }
            else
            {
                $this->data['errors']['invalid_csv'] = $productValidator->getErrors();
            }
        }
        $this->data['products'] = $model->getProducts();
        $this->view->render($this->data);
    }
}