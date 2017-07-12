<?php
 include( 'convexHull.php' );

    if( isset($_POST['submit']) )
    {

        function compress($source, $destination, $quality) {

            $info = getimagesize($source);

            if ($info['mime'] == 'image/jpeg') 
                $image = imagecreatefromjpeg($source);

            elseif ($info['mime'] == 'image/gif') 
                $image = imagecreatefromgif($source);

            elseif ($info['mime'] == 'image/png') 
                $image = imagecreatefrompng($source);

            imagejpeg($image, $destination, $quality);

            return $destination;
        }
        $filename  = "aboc.jpg";

        $path      = './uploads/';
        $file      = $path.$filename;
        $source_img = $file;
        $destination_img = 'destination.jpg';

        $d = compress($source_img, $destination_img, 40);

        //sleep(10);
        $source_image = "destination.jpg";
        //echo "<img src = 'destination.jpg'/>";
        //die();
         //$source_image =  $_POST['uploaded_file']
        // creating the image
        $starting_img = imagecreatefromjpeg($source_image);
         
        // getting image information (I need only width and height)
        $im_data = getimagesize($source_image);
         
        // this will be the final image, same width and height of the original
        $final = imagecreatetruecolor($im_data[0],$im_data[1]);
        $array1 = array();
        $j = 0;
        function get_luminance($pixel){
            $pixel = sprintf('%06x',$pixel);
            $red = hexdec(substr($pixel,0,2))*0.30;
            $green = hexdec(substr($pixel,2,2))*0.59;
            $blue = hexdec(substr($pixel,4))*0.11;
            return $red+$green+$blue;
        } 
        // looping through ALL pixels!!
        for($x=0;$x<$im_data[0];$x++){
            for($y=0;$y<$im_data[1];$y++){
                $gray = 0;
                // getting gray value of all surrounding pixels
                if($x != 0 && $x != $im_data[0]-1 && $y != 0 && $y != $im_data[1]-1 ){
                 $pixel_up = get_luminance(imagecolorat($starting_img,$x,$y-1));
                $pixel_down = get_luminance(imagecolorat($starting_img,$x,$y+1)); 
                $pixel_left = get_luminance(imagecolorat($starting_img,$x-1,$y));
                $pixel_right = get_luminance(imagecolorat($starting_img,$x+1,$y));
                $pixel_up_left = get_luminance(imagecolorat($starting_img,$x-1,$y-1));
                $pixel_up_right = get_luminance(imagecolorat($starting_img,$x+1,$y-1));
                $pixel_down_left = get_luminance(imagecolorat($starting_img,$x-1,$y+1));
                $pixel_down_right = get_luminance(imagecolorat($starting_img,$x+1,$y+1)); 
                

                
                // appliying convolution mask
                $conv_x = ($pixel_up_right+($pixel_right*2)+$pixel_down_right)-($pixel_up_left+($pixel_left*2)+$pixel_down_left);
                $conv_y = ($pixel_up_left+($pixel_up*2)+$pixel_up_right)-($pixel_down_left+($pixel_down*2)+$pixel_down_right);
                
                // calculating the distance
                //$gray = sqrt($conv_x*$conv_x+$conv_y+$conv_y);    
                $gray = abs($conv_x)+abs($conv_y);
                
                // inverting the distance not to get the negative image                
                $gray = 255-$gray;
                
                // adjusting distance if it's greater than 255 or less than zero (out of color range)
                if($gray > 255){
                    $gray = 255;
                }
                if($gray < 0){
                    $gray = 0;
                }
                
                // creation of the new gray
                $new_gray  = imagecolorallocate($final,(int)$gray,(int)$gray,(int)$gray);
                
                if($gray == 0 ){
                    $array1[$j] = array($x, $y);
                    $j = $j +1;
                }

                

                
                // adding the gray pixel to the new image        
                imagesetpixel($final,$x,$y,$new_gray);
                }   
                         
            }
        }

        $array2 = convexHull($array1);
        //var_dump($array1);
        $maxX1= $array2[0][0];
        $maxY1= $array2[0][1];
        $maxX2= $array2[0][0];
        $maxY2= $array2[0][1];
        $minX1 = $array2[0][0];
        $minY1 = $array2[0][1];
        $minX2 = $array2[0][0];
        $minY2 = $array2[0][1];
        foreach ($array2 as $value1) {
                    if($value1[0] > $maxX1){
                            $maxX1 = $value1[0];
                            $maxY1 = $value1[1];
                    }
                    if($value1[0] < $minX1){
                            $minX1 = $value1[0];
                            $minY1 = $value1[1];
                    }
                    if($value1[1] > $maxY2){
                            //echo $value1[1];
                            $maxX2 = $value1[0];
                            $maxY2 = $value1[1];
                    }
                    if($value1[1] < $minY2){
                            $minX2 = $value1[0];
                            $minY2 = $value1[1];
                    }
        } 

        $abcd = ($maxY1 + $minY1)/2;
        imageline ( $final , $maxX2 , $maxY2 , $minX2, $minY2,0);
        imageline ( $final , $maxX1 , $maxY1 , $minX1 , $minY1 ,0);

        $m1 = ($maxY2 - $minY2)/($maxX2 - $minX2);
        $m2 = ($maxY1 - $minY1)/($maxX1 - $minX1);

        $m = atan(($m1 - $m2)/(1-$m1*$m2));
        $m2 = ($m*180)/(3.14);
        if($m2 < 15 || ($m2 > 165 && $m2 < 195) || $m2 > 345){
            $m3 = "NEGATIVE";
        }else{
            $m3 = "POSITIVE";
        }

        unlink($file);
        unlink("destination.jpg");
        header('Location: handdrift.php?m='.$m3);

    }
?>