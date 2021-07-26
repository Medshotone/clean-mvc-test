<?php

namespace app\traits;

trait FileUploadTrait
{
    /**
     * @param array $fileInfo
     * @param string $path
     * @return array|string
     * array contains errors
     * string contains full img pah
     */
    private function uploadImage(array $fileInfo, string $path = '/')
    {
        $errors = array();
        $allowedExt = array('txt');
        $fileName = $fileInfo['name'];
        $explodedFileName = explode('.', $fileName);
        $fileExt = strtolower(end($explodedFileName));
        $fileSize = $fileInfo['size'];
        $fileTmp = $fileInfo['tmp_name'];

        $fileUniqueDir = substr(md5($fileName.'ranomsaltdfasdas'), 0, 7);

        if (in_array($fileExt, $allowedExt) === false) {
            $errors[] = 'Extension not allowed';
        }
        if ($fileSize > 2097152) {
            $errors[] = 'File size must be under 2mb';
        }

        if ($errors) {
            return $errors;
        }

        $dirPath = "public/{$path}/{$fileUniqueDir}";

        if (!file_exists($dirPath)) {
            if (!mkdir($dirPath, 0755, true) && !is_dir($dirPath)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dirPath));
            }
        }

        $fullPath = "{$dirPath}/{$fileName}";

        if (move_uploaded_file($fileTmp, $fullPath)) {
            return $fullPath;
        }
    }
}
