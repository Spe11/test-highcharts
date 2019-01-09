<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Form extends Model
{
    /**
     * @var  array
     */
    private $data;

    /**
     * @var  resource
     */
    public $file;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'html'],
        ];
    }

    /**
     * upload selected file
     *
     * @param   UploadedFile  $file
     *
     * @return  bool
     */
    public function upload($file)
    {
        $this->file = $file;
        if ($this->validate()) {
            $this->parse($this->file);
            $this->calculate();
            return true;
        } else {
            return false;
        }
    }

    /**
     * return parsed data
     *
     * @return  array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * parse data from file
     * 
     * @return  void
     */
    private function parse()
    {
        $html = file_get_contents($this->file->tempName);
        $DOM = new \DOMDocument();
        $DOM->loadHTML($html);
        $rows = $DOM->getElementsByTagName('tr');
        foreach ($rows as $row) {
            $index = 0;
            $rowData = [];
            $cells = $row->getElementsByTagName('td');
            foreach ($cells as $cell) {
                $rowData[$index] = $cell->nodeValue;
                $index++;
            }
            if (is_numeric($rowData[0])) {
                $this->data[$rowData[0]] = $rowData[count($rowData) - 1];
            }
        }
    }

    /**
     * calculate profit
     * 
     * @return  void
     */
    private function calculate()
    {
        $result = [];
        foreach ($this->data as $value) {
            $result[] = doubleval($value);
        }
        for ($i = 1; $i < count($result); $i++) {
            $result[$i] = $result[$i - 1] + $result[$i];
        }
        $this->data = array_combine(array_keys($this->data), $result);
    }
}
