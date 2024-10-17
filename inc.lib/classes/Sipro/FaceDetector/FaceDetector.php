<?php
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
//
// @Author Karthik Tharavaad
//         karthik_tharavaad@yahoo.com
// @Contributor Maurice Svay
//              maurice@svay.Com

namespace Sipro\FaceDetector;

use GdImage;

class FaceDetector
{
    /**
     * @var array $detectionData Array containing face detection data required for the detection process.
     */
    protected $detectionData;

    /**
     * @var GdImage $canvas Image resource currently being processed for face detection.
     */
    protected $canvas;

    /**
     * @var array|null $face Information about the detected face, including position and size.
     */
    protected $face;

    /**
     * @var GdImage $reducedCanvas Resized image resource to improve detection efficiency.
     */
    private $reducedCanvas;

    /**
     * Creates a face detector with the given configuration.
     *
     * Configuration can be either passed as an array or as
     * a filepath to a serialized array file-dump.
     *
     * @param string|array $detectionData The path to detection data file or an array of detection data.
     *
     * @throws NoFaceException If detection data cannot be loaded.
     */
    public function __construct($detectionData = 'detection.dat')
    {
        if (is_array($detectionData)) {
            $this->detectionData = $detectionData;
            return;
        }
    
        if (!is_file($detectionData)) {
            // fallback to same file in this class's directory
            $detectionData = dirname(__FILE__) . DIRECTORY_SEPARATOR . $detectionData;
            
            if (!is_file($detectionData)) {
                throw new NoFaceException("Couldn't load detection data");
            }
        }
        
        $this->detectionData = unserialize(file_get_contents($detectionData));
    }

    /**
     * Detects a face in the provided image.
     *
     * @param GdImage|string $file An image resource, file path, or image string to analyze.
     *
     * @return bool Returns true if a face is detected; otherwise false.
     *
     * @throws NoFileException If the image cannot be loaded.
     */
    public function faceDetect($file)
    {
        if (is_resource($file)) {
            $this->canvas = $file;
        } elseif (is_file($file)) {
            $this->canvas = imagecreatefromjpeg($file);
        } elseif (is_string($file)) {
            $this->canvas = imagecreatefromstring($file); 
        } else {
            throw new NoFileException("Can not load $file");
        }

        $im_width = imagesx($this->canvas);
        $im_height = imagesy($this->canvas);

        //Resample before detection?
        $diff_width = 320 - $im_width;
        $diff_height = 240 - $im_height;
        if ($diff_width > $diff_height) {
            $ratio = $im_width / 320;
        } else {
            $ratio = $im_height / 240;
        }

        if ($ratio != 0) {
            $this->reducedCanvas = imagecreatetruecolor($im_width / $ratio, $im_height / $ratio);

            imagecopyresampled(
                $this->reducedCanvas,
                $this->canvas,
                0,
                0,
                0,
                0,
                $im_width / $ratio,
                $im_height / $ratio,
                $im_width,
                $im_height
            );

            $stats = $this->getImgStats($this->reducedCanvas);

            $this->face = $this->doDetectGreedyBigToSmall(
                $stats['ii'],
                $stats['ii2'],
                $stats['width'],
                $stats['height']
            );

            if ($this->face['w'] > 0) {
                $this->face['x'] *= $ratio;
                $this->face['y'] *= $ratio;
                $this->face['w'] *= $ratio;
            }
        } else {
            $stats = $this->getImgStats($this->canvas);

            $this->face = $this->doDetectGreedyBigToSmall(
                $stats['ii'],
                $stats['ii2'],
                $stats['width'],
                $stats['height']
            );
        }
        return ($this->face['w'] > 0);
    }

    /**
     * Outputs the detected face as a JPEG image.
     *
     * @return void
     */
    public function toJpeg()
    {
        $color = imagecolorallocate($this->canvas, 255, 0, 0); //red

        imagerectangle(
            $this->canvas,
            $this->face['x'],
            $this->face['y'],
            $this->face['x']+$this->face['w'],
            $this->face['y']+ $this->face['w'],
            $color
        );

        header('Content-type: image/jpeg');
        imagejpeg($this->canvas);
    }

    /**
     * Crops the detected face from the photo.
     * Should be called after the `faceDetect` function.
     * If a file name is provided, the cropped face will be saved to that file;
     * otherwise, it will be output directly to standard output.
     *
     * @param string|null $outFileName File name to store the cropped face. If null, the face will be printed to output.
     * @param int $margin Optional margin around the detected face (in pixels).
     * @param int $width Desired width of the cropped image (in pixels).
     * @param int $height Desired height of the cropped image (in pixels).
     *
     * @throws NoFaceException If no face has been detected.
     */
    public function cropFaceToJpeg($outFileName, $margin, $width, $height)
    {
        if (empty($this->face)) {
            throw new NoFaceException('No face detected');
        }

        // Menghitung ukuran crop baru
        $originalWidth = $this->face['w'] + 2 * $margin;
        $originalHeight = $this->face['w'] + 2 * $margin;

        // Menghitung rasio
        $ratioWidth = $width;
        $ratioHeight = $height;

        // Menghitung ukuran baru berdasarkan rasio
        if ($ratioWidth > $ratioHeight) {
            $newWidth = $originalWidth;
            $newHeight = (int)($newWidth * $ratioHeight / $ratioWidth);
        } else {
            $newHeight = $originalHeight;
            $newWidth = (int)($newHeight * $ratioWidth / $ratioHeight);
        }

        // Menghitung posisi tengah untuk crop
        $cropX = max(0, $this->face['x'] + $this->face['w'] / 2 - $newWidth / 2);
        $cropY = max(0, $this->face['y'] + $this->face['w'] / 2 - $newHeight / 2);

        // Memastikan crop tidak keluar dari batas gambar asli
        $cropWidth = min($newWidth, imagesx($this->canvas) - $cropX);
        $cropHeight = min($newHeight, imagesy($this->canvas) - $cropY);

        $canvas = imagecreatetruecolor($ratioWidth, $ratioHeight);
        imagecopyresampled($canvas, $this->canvas, 0, 0, $cropX, $cropY, $ratioWidth, $ratioHeight, $cropWidth, $cropHeight);

        if ($outFileName === null) {
            header('Content-type: image/jpeg');
        }

        imagejpeg($canvas, $outFileName);
    }

    /**
     * Returns the detected face data in JSON format.
     *
     * @return string JSON-encoded face data.
     */
    public function toJson()
    {
        return json_encode($this->face);
    }

    /**
     * Returns the detected face data.
     *
     * @return array|null The detected face data, or null if no face is detected.
     */
    public function getFace()
    {
        return $this->face;
    }

    /**
     * Calculates image statistics required for detection.
     *
     * @param GdImage $canvas The image resource.
     *
     * @return array Array containing image width, height, integral image, and squared integral image.
     */
    protected function getImgStats($canvas)
    {
        $image_width = imagesx($canvas);
        $image_height = imagesy($canvas);
        $iis =  $this->computeII($canvas, $image_width, $image_height);
        return array(
            'width' => $image_width,
            'height' => $image_height,
            'ii' => $iis['ii'],
            'ii2' => $iis['ii2']
        );
    }

    /**
     * Computes integral images for the given canvas.
     *
     * @param GdImage $canvas The image resource.
     * @param int $image_width The width of the image.
     * @param int $image_height The height of the image.
     *
     * @return array Array containing the integral image and the squared integral image.
     */
    protected function computeII($canvas, $image_width, $image_height)
    {
        $ii_w = $image_width+1;
        $ii_h = $image_height+1;
        $ii = array();
        $ii2 = array();

        for ($i=0; $i<$ii_w; $i++) {
            $ii[$i] = 0;
            $ii2[$i] = 0;
        }

        for ($i=1; $i<$ii_h-1; $i++) {
            $ii[$i*$ii_w] = 0;
            $ii2[$i*$ii_w] = 0;
            $rowsum = 0;
            $rowsum2 = 0;
            for ($j=1; $j<$ii_w-1; $j++) {
                $rgb = ImageColorAt($canvas, $j, $i);
                $red = ($rgb >> 16) & 0xFF;
                $green = ($rgb >> 8) & 0xFF;
                $blue = $rgb & 0xFF;
                $grey = (0.2989*$red + 0.587*$green + 0.114*$blue)>>0;  // this is what matlab uses
                $rowsum += $grey;
                $rowsum2 += $grey*$grey;

                $ii_above = ($i-1)*$ii_w + $j;
                $ii_this = $i*$ii_w + $j;

                $ii[$ii_this] = $ii[$ii_above] + $rowsum;
                $ii2[$ii_this] = $ii2[$ii_above] + $rowsum2;
            }
        }
        return array('ii'=>$ii, 'ii2' => $ii2);
    }

     /**
     * Detects faces in the image using a greedy approach from big to small.
     *
     * @param array $ii Integral image.
     * @param array $ii2 Squared integral image.
     * @param int $width Width of the image.
     * @param int $height Height of the image.
     *
     * @return array|null Coordinates and size of the detected face, or null if no face is detected.
     */
    protected function doDetectGreedyBigToSmall($ii, $ii2, $width, $height)
    {
        $s_w = $width/20.0;
        $s_h = $height/20.0;
        $start_scale = $s_h < $s_w ? $s_h : $s_w;
        $scale_update = 1 / 1.2;
        for ($scale = $start_scale; $scale > 1; $scale *= $scale_update) {
            $w = (20*$scale) >> 0;
            $endx = $width - $w - 1;
            $endy = $height - $w - 1;
            $step = max($scale, 2) >> 0;
            $inv_area = 1 / ($w*$w);
            for ($y = 0; $y < $endy; $y += $step) {
                for ($x = 0; $x < $endx; $x += $step) {
                    $passed = $this->detectOnSubImage($x, $y, $scale, $ii, $ii2, $w, $width+1, $inv_area);
                    if ($passed) {
                        return array('x'=>$x, 'y'=>$y, 'w'=>$w);
                    }
                } // end x
            } // end y
        }  // end scale
        return null;
    }

    /**
     * Detects a face on a sub-image.
     *
     * @param int $x X-coordinate of the sub-image.
     * @param int $y Y-coordinate of the sub-image.
     * @param float $scale Scale of the sub-image.
     * @param array $ii Integral image.
     * @param array $ii2 Squared integral image.
     * @param int $w Width of the sub-image.
     * @param int $iiw Width of the integral image.
     * @param float $inv_area Inverse area of the sub-image.
     *
     * @return bool True if a face is detected; otherwise false.
     */
    protected function detectOnSubImage($x, $y, $scale, $ii, $ii2, $w, $iiw, $inv_area)
    {
        $mean  = ($ii[($y+$w)*$iiw + $x + $w] + $ii[$y*$iiw+$x] - $ii[($y+$w)*$iiw+$x] - $ii[$y*$iiw+$x+$w])*$inv_area;

        $vnorm = ($ii2[($y+$w)*$iiw + $x + $w]
                  + $ii2[$y*$iiw+$x]
                  - $ii2[($y+$w)*$iiw+$x]
                  - $ii2[$y*$iiw+$x+$w])*$inv_area - ($mean*$mean);

        $vnorm = $vnorm > 1 ? sqrt($vnorm) : 1;

        $count_data = count($this->detectionData);

        for ($i_stage = 0; $i_stage < $count_data; $i_stage++) {
            $stage = $this->detectionData[$i_stage];
            $trees = $stage[0];

            $stage_thresh = $stage[1];
            $stage_sum = 0;

            $count_trees = count($trees);

            for ($i_tree = 0; $i_tree < $count_trees; $i_tree++) {
                $tree = $trees[$i_tree];
                $current_node = $tree[0];
                $tree_sum = 0;
                while ($current_node != null) {
                    $vals = $current_node[0];
                    $node_thresh = $vals[0];
                    $leftval = $vals[1];
                    $rightval = $vals[2];
                    $leftidx = $vals[3];
                    $rightidx = $vals[4];
                    $rects = $current_node[1];

                    $rect_sum = 0;
                    $count_rects = count($rects);

                    for ($i_rect = 0; $i_rect < $count_rects; $i_rect++) {
                        $s = $scale;
                        $rect = $rects[$i_rect];
                        $rx = ($rect[0]*$s+$x)>>0;
                        $ry = ($rect[1]*$s+$y)>>0;
                        $rw = ($rect[2]*$s)>>0;
                        $rh = ($rect[3]*$s)>>0;
                        $wt = $rect[4];

                        $r_sum = ($ii[($ry+$rh)*$iiw + $rx + $rw]
                                  + $ii[$ry*$iiw+$rx]
                                  - $ii[($ry+$rh)*$iiw+$rx]
                                  - $ii[$ry*$iiw+$rx+$rw])*$wt;

                        $rect_sum += $r_sum;
                    }

                    $rect_sum *= $inv_area;

                    $current_node = null;

                    if ($rect_sum >= $node_thresh*$vnorm) {

                        if ($rightidx == -1) {

                            $tree_sum = $rightval;

                        } else {

                            $current_node = $tree[$rightidx];

                        }

                    } else {

                        if ($leftidx == -1) {

                            $tree_sum = $leftval;

                        } else {

                            $current_node = $tree[$leftidx];
                        }
                    }
                }

                $stage_sum += $tree_sum;
            }
            if ($stage_sum < $stage_thresh) {
                return false;
            }
        }
        return true;
    }
}
