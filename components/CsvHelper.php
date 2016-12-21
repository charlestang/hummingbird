<?php

namespace app\components;

use League\Csv\Writer;
use SplTempFileObject;
use yii\base\UserException;

/**
 * Description of CsvHelper
 *
 * @author charles
 */
class CsvHelper
{

    /**
     * CSV 数据导出助手
     * @param  array  $data      数据数组, MySQL查询出来的关联数组
     * @param  string $filename  CSV的文件名
     * @return int 文件的字节长度
     * @throws UserException
     */
    public static function exportDataAsCsv($data, $filename)
    {
        if (empty($data)) {
            throw new UserException("Data is empty.", 400);
        }
        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(array_keys(reset($data)));
        $csv->insertAll($data);
        $csv->setOutputBOM(Writer::BOM_UTF8);
        return $csv->output($filename);
    }
}
