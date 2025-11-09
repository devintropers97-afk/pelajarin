<?php
/**
 * Performance Optimizer
 */

class Optimizer {
    public static function enableGzipCompression() {
        if (!ob_start('ob_gzhandler')) {
            ob_start();
        }
    }
    
    public static function setBrowserCache($seconds = 86400) {
        header("Cache-Control: max-age=$seconds, public");
        header("Expires: " . gmdate('D, d M Y H:i:s', time() + $seconds) . ' GMT');
    }
    
    public static function minifyHTML($html) {
        $search = [
            '/\>[^\S ]+/s',     // strip whitespaces after tags
            '/[^\S ]+\</s',     // strip whitespaces before tags
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        ];
        
        $replace = ['>', '<', '\\1', ''];
        
        return preg_replace($search, $replace, $html);
    }
    
    public static function optimizeImage($source, $destination, $quality = 90) {
        $info = getimagesize($source);
        
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return false;
        }
        
        return imagejpeg($image, $destination, $quality);
    }
}
