<?php

namespace WBC\Lib\Path;

use Phalcon\Mvc\Url;

class Path extends \Phalcon\Mvc\User\Component
{
    public function tmp($id, $base, $addUiq = false)
    {
        $upload_dir = $this->getUploadDir($base.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR, $id);
        if($addUiq) {
             $upload_dir .= uniqid().DIRECTORY_SEPARATOR;
        }

        if (!is_dir($upload_dir)) {
            $oldUmask = umask(0);
            mkdir($upload_dir, 0777, true);
            umask($oldUmask);
        }
        
        return $upload_dir;
    }
    
    public function path($id, $base, $createDir = true)
    {
        $upload_dir = $this->getUploadDir($base.DIRECTORY_SEPARATOR, $id);

        if ($createDir && !is_dir($upload_dir)) {
            $oldUmask = umask(0);
            mkdir($upload_dir, 0777, true);
            umask($oldUmask);
        }
        
        return $upload_dir;
    }
    
    public function rmFiles($patch, $hasName = false, $allowEq = false)
    {
        $dir = opendir($patch);
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                $filePath = $patch . DIRECTORY_SEPARATOR . $file;
                if ( is_dir($filePath) ) { 
                    $this->rmFiles($filePath);
                    if(false === $hasName) {
                        rmdir($filePath);
                    }
                } else  {
                    if(false === $hasName || false !== strpos($file, $hasName)) {
                        if($allowEq && $file == $hasName) {
                            continue;
                        }
                        unlink($filePath);
                    }
                }
            }
        }
        closedir($dir); 

        return $this;
    }

    public function rmDir($patch)
    {
        $this->rmFiles($patch);

        if(is_dir($patch)) {
            rmdir($patch);
        }
    }

    public function movePatch($src, $dst)
    {
        $dir = opendir($src); 
        
        if (!is_dir($dst)) {
            $oldUmask = umask(0);
            mkdir($dst, 0777, true);
            umask($oldUmask);
        }
        
        while (false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) { 
                    $this->movePatch($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file); 
                } else { 
                    copy($src . DIRECTORY_SEPARATOR . $file,$dst . DIRECTORY_SEPARATOR . $file); 
                } 
            } 
        } 
        closedir($dir); 
    }

    public function getUploadDir($base, $id)
    {
        $tmp = floor(intval($id)/1000);
        $tmp = floor($tmp/10)*10;

        $folderFirstName = $tmp . 'k';
        $folderSecondName = (floor((intval($id)/1000)) - $tmp) . 'k';

        $url = new Url();
        return $url->path($base . $folderFirstName . '/' . $folderSecondName . '/' . $id . '/');
    }
}