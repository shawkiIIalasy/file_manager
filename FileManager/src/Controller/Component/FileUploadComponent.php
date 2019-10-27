<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Client\Request;

/**
 * FileUpload component
 */

class FileUploadComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    private $uploadPath=WWW_ROOT.DS.'upload/files/';
    private $uploadFilePath="";
    protected $_defaultConfig = [];
    public function file($fileName,$tmpName)
    {

        $this->uploadFilePath =$this->uploadPath.$fileName;
        return move_uploaded_file($tmpName,$this->uploadFilePath);
    }

    public function getPath()
    {
        return $this->uploadPath;
    }

}
