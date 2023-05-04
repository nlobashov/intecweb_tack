<?php
namespace lib;

class CSVHelper
{
    private function __construct(){}

    public static function exportCSV($data)
    {
        if (!is_array($data)) exit('Invalid type $data');
        $tempFile = tmpfile();
        $tempFileName = stream_get_meta_data($tempFile)['uri'];
        foreach ($data as $row)
        {
            fputcsv($tempFile, $row, ';');
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="user_products.csv"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($tempFileName));
        readfile($tempFileName);
        exit;
    }

    public static function getCSV($filename)
    {
        $csvFile = fopen($filename, 'r');
        $data = array();
        while (($row = fgetcsv($csvFile, 0, ';')) !== false)
        {
            $data[] = $row;
        }
        fclose($csvFile);
        return $data;
    }
}