<?php

use MagicObject\Util\File\FileUtil;

class ImageUtil
{
    public static function imageResizeMax($source, $destination, $maxwidth, $maxheight, $interlace = false, $type = 'jpeg', $quality = 80)
    {
        $source = FileUtil::fixFilePath($source);
        $destination = FileUtil::fixFilePath($destination);

        $imageinfo = getimagesize($source);
        $image = new StdClass();
        if (empty($imageinfo)) {
            if (file_exists($source)) {
                unlink($source);
            }
            return false;
        }
        $image->width  = $imageinfo[0];
        $image->height = $imageinfo[1];
        $image->type   = $imageinfo[2];
        switch ($image->type) {
            case IMAGETYPE_GIF:
                $im = @ImageCreateFromGIF($source);
                break;
            case IMAGETYPE_JPEG:
                $im = @ImageCreateFromJPEG($source);
                break;
            case IMAGETYPE_PNG:
                $im = @ImageCreateFromPNG($source);
                break;
            default:
                unlink($source);
                return false;
        }
        if (!$im) {
            return false;
        }

        $currentwidth = $image->width;
        $currentheight = $image->height;
        // adapting image width
        if ($currentwidth > $maxwidth) {
            $tmpwidth = round($maxwidth);
            $tmpheight = round($currentheight * ($tmpwidth / $currentwidth));

            $currentwidth = $tmpwidth;
            $currentheight = $tmpheight;
        }
        // adapting image height
        if ($currentheight > $maxheight) {
            $tmpheight = round($maxheight);
            $tmpwidth = round($currentwidth * ($tmpheight / $currentheight));
            $currentwidth = $tmpwidth;
            $currentheight = $tmpheight;
        }
        $im2 = imagecreatetruecolor($currentwidth, $currentheight);
        $white = imagecolorallocate($im2, 255, 255, 255);
        imagefilledrectangle($im2, 0, 0, $currentwidth, $currentheight, $white);
        imagecopyresampled($im2, $im, 0, 0, 0, 0, $currentwidth, $currentheight, $image->width, $image->height);
        if (file_exists($source)) {
            unlink($source);
        }
        if ($interlace) {
            imageinterlace($im2, true);
        }
        if ($type == 'png') {
            imagepng($im2, $destination);
        } else {
            imagejpeg($im2, $destination, $quality);
        }
        return $destination;
    }

    public static function readExifDataFile($filename)
    {
        $is = getimagesize($filename);
        if (function_exists("exif_read_data")) {
            $exif = @exif_read_data($filename, 0, true, false);
        }
        if (!empty($exif)) {
            $exif['original_width'] = $is[0];
            $exif['original_height'] = $is[1];
        }

        return $exif;
    }

    public static function packExifData($exif)
    {
        if (count($exif)) {
            $width = $exif['original_width'];
            $height = $exif['original_height'];
            if (isset($exif['IFD0']['Make']) && isset($exif['IFD0']['Model']) && strpos($exif['IFD0']['Model'], $exif['IFD0']['Make']) === 0) {
                $exif['IFD0']['Make'] = '';
            }


            $camera = self::getCameraMaker($exif);
            $time_capture = self::getCaptureTime($exif, '-');
            $latd = $latm = $lats = $longd = $longm = $longs = 0;
            if (isset($exif['GPS'])) {
                $gpsinfo = $exif['GPS'];

                $latd = self::getFromFraction(@$gpsinfo['GPSLatitude'][0]);
                $latm = self::getFromFraction(@$gpsinfo['GPSLatitude'][1]);
                $lats = self::getFromFraction(@$gpsinfo['GPSLatitude'][2]);
                
                
                $reallat = self::dmstoreal($latd, $latm, $lats);
                if (stripos(@$gpsinfo['GPSLatitudeRef'], "S") !== false) {
                    $reallat = $reallat * -1;
                }
                $latitude = "$latd; $latm; $lats " . @$gpsinfo['GPSLatitudeRef'];
                $latitude = trim($latitude, " ; ");

                $longd = self::getFromFraction(@$gpsinfo['GPSLongitude'][0]);
                $longm = self::getFromFraction(@$gpsinfo['GPSLongitude'][1]);
                $longs = self::getFromFraction(@$gpsinfo['GPSLongitude'][2]);

                $reallong = self::dmstoreal($longd, $longm, $longs);
                if (stripos(@$gpsinfo['GPSLongitudeRef'], "W") !== false) {
                    $reallong = $reallong * -1;
                }
                $longitude = "$longd; $longm; $longs " . @$gpsinfo['GPSLongitudeRef'];

                $longitude = trim($longitude, " ; ");

                $altitude = self::getFromFraction(@$gpsinfo['GPSLongiGPSAltitudetude'][0]);

                $altref = @$gpsinfo['GPSAltitudeRef'];
            } else {
                $latitude = "-";
                $longitude = "-";
                $altitude = "-";
                $altref = "";
            }
            return array(
                'width' => @$width,
                'height' => @$height,
                'time' => @$time_capture,
                'camera' => @$camera,
                'latitude' => @$latitude,
                'longitude' => @$longitude,
                'altitude' => @$altitude,
                'altref' => @$altref,
                'capture_info' => self::get_capture_info(@$exif)
            );
        }
        return null;
    }

    public static function getCameraMaker($exif, $default = '')
    {
        if(isset($exif['IFD0']) && isset($exif['IFD0']['Make']))
        {
            return $exif['IFD0']['Make'];
        }
        else
        {
            return $default;
        }
    }

    public static function getCaptureTime($exif, $default = '')
    {
        if(isset($exif['IFD0']) && isset($exif['IFD0']['Datetime']))
        {
            return $exif['IFD0']['Datetime'];
        }
        else if(isset($exif['IFD0']) && isset($exif['IFD0']['DateTimeOriginal']))
        {
            return $exif['IFD0']['DateTimeOriginal'];
        }
        else
        {
            return $default;
        }
    }

    /**
     * Get value from fraction string
     * @param string $str
     * @return float
     */
    public static function getFromFraction($str)
    {
        $longs = 0;
        $longar = explode("/", $str);
        if (count($longar) > 1 && $longar[1]) {
            $longs = $longar[0] / $longar[1];
        }
        return $longs;
    }


    public static function dmstoreal($deg, $min, $sec)
    {
        return $deg + ((($min / 60) + ($sec)) / 3600);
    }

    public static function real2dms($val)
    {
        $tm = $val * 3600;
        $tm = round($tm);
        $h = sprintf("%02d", date("H", $tm) - 7);
        if ($h < 0) {
            $h += 24;
        }
        $m = date("i", $tm);
        $s = date("s", $tm);
        return array($h, $m, $s);
    }

    public static function get_capture_info($exif)
    {
        /* 
        Copyright 2013 Kamshory Developer
        */
        $exifdata = array();
        $tmpdt = array();
        if (is_array($exif)) {
            $tmpdt['Camera_Maker'] = @$exif['IFD0']['Make'];
            $tmpdt['Camera_Model'] = @$exif['IFD0']['Model'];
            $tmpdt['Capture_Time'] = self::getCaptureTime($exif, '');
            $tmpdt['Aperture_F_Number'] = @$exif['COMPUTED']['ApertureFNumber'];
            $tmpdt['Orientation'] = @$exif['IFD0']['Orientation'];
            $tmpdt['X_Resolution'] = @$exif['IFD0']['XResolution'];
            $tmpdt['Y_Resolution'] = @$exif['IFD0']['YResolution'];
            $tmpdt['YCbCr_Positioning'] = @$exif['IFD0']['YCbCrPositioning'];
            $tmpdt['Exposure_Time'] = @$exif['EXIF']['ExposureTime'];
            $tmpdt['F_Number'] = @$exif['EXIF']['FNumber'];
            $tmpdt['ISO_Speed_Ratings'] = @$exif['EXIF']['ISOSpeedRatings'];
            $tmpdt['Shutter_Speed_Value'] = @$exif['EXIF']['ShutterSpeedValue'];
            $tmpdt['Aperture_Value'] = @$exif['EXIF']['ApertureValue'];
            $tmpdt['Light_Source'] = @$exif['EXIF']['LightSource'];
            $tmpdt['Flash'] = @$exif['EXIF']['Flash'];
            $tmpdt['Focal_Length'] = @$exif['EXIF']['FocalLength'];
            $tmpdt['SubSec_Time_Original'] = @$exif['EXIF']['SubSecTimeOriginal'];
            $tmpdt['SubSec_Time_Digitized'] = @$exif['EXIF']['SubSecTimeDigitized'];
            $tmpdt['Flash_Pix_Version'] = @$exif['EXIF']['FlashPixVersion'];
            $tmpdt['Color_Space'] = @$exif['EXIF']['ColorSpace'];
            $tmpdt['Custom_Rendered'] = @$exif['EXIF']['CustomRendered'];
            $tmpdt['Exposure_Mode'] = @$exif['EXIF']['ExposureMode'];
            $tmpdt['White_Balance'] = @$exif['EXIF']['WhiteBalance'];
            $tmpdt['Digital_Zoom_Ratio'] = @$exif['EXIF']['DigitalZoomRatio'];
            $tmpdt['Scene_Capture_Type'] = @$exif['EXIF']['SceneCaptureType'];
            $tmpdt['Gain_Control'] = @$exif['EXIF']['GainControl'];
            foreach ($tmpdt as $key => $val) {
                if (@$val != "") {
                    $exifdata[$key] = $val;
                }
            }
            return $exifdata;
        }
        return null;
    }
    public static function flip_horizontal($im)
    {
        $wid = imagesx($im);
        $hei = imagesy($im);
        $im2 = imagecreatetruecolor($wid, $hei);
        for ($i = 0; $i < $wid; $i++) {
            for ($j = 0; $j < $hei; $j++) {
                $ref = imagecolorat($im, $i, $j);
                imagesetpixel($im2, ($wid - $i - 1), $j, $ref);
            }
        }
        return $im2;
    }

    public static function flip_vertical($im)
    {
        $wid = imagesx($im);
        $hei = imagesy($im);
        $im2 = imagecreatetruecolor($wid, $hei);

        for ($i = 0; $i < $wid; $i++) {
            for ($j = 0; $j < $hei; $j++) {
                $ref = imagecolorat($im, $i, $j);
                imagesetpixel($im2, $i, ($hei - $j - 1), $ref);
            }
        }
        return $im2;
    }

    public static function createThumbImage($originalfile, $destination, $dwidth, $dheight, $interlace = false, $quality = 80)
    {
        $image = new StdClass();
        $imageinfo = getimagesize($originalfile);
        if (empty($imageinfo)) {
            if (file_exists($originalfile)) {
                unlink($originalfile);
            }
            return false;
        }
        $image->width  = $imageinfo[0];
        $image->height = $imageinfo[1];
        $image->type   = $imageinfo[2];

        switch ($image->type) {
            case IMAGETYPE_GIF:
                $im = @ImageCreateFromGIF($originalfile);
                break;
            case IMAGETYPE_JPEG:
                $im = @ImageCreateFromJPEG($originalfile);
                break;
            case IMAGETYPE_PNG:
                $im = @ImageCreateFromPNG($originalfile);
                break;
            default:
                unlink($originalfile);
                return false;
        }
        //if (function_exists('imagecreatetruecolor') and $CFG->gdversion >= 2) 
        {
            $im1 = imagecreatetruecolor($dwidth, $dheight);
        }
        
        $mindim = min($image->width, $image->height);
        $xstart = 0;
        $ystart = 0;
        if ($image->width > $image->height) {
            $xstart = floor((max($image->width, $image->height) - min($image->width, $image->height)) / 2.0);
        } else {
            $ystart = floor((max($image->width, $image->height) - min($image->width, $image->height)) / 2.0);
        }
        imagecopyresampled($im1, $im, 0, 0, $xstart, $ystart, $dwidth, $dheight, $mindim, $mindim);
        if ($interlace) {
            imageinterlace($im1, true);
        }

        if (function_exists('ImageJpeg')) {
            @touch($destination);  // Helps in Safe mode
            if (
                ImageJpeg($im1, $destination, $quality)
            ) {
                @chmod($destination, 0666);
                return 1;
            }
        } else {
            error_log('PHP has not been configured to support JPEG images.  Please correct this.');
        }
        return 0;
    }
}
