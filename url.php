<?
require_once "include.php";
if (isset($_POST['urllink'])){

    if(file_exists("input.jpg")){
        unlink("input.jpg");
    }
    if(file_exists("output_dark.jpg")){
        unlink("output_dark.jpg");
    }
    if(file_exists("output_bright.jpg")){
        unlink("output_bright.jpg");
    }
    if(file_exists("output_haven.jpg")){
        unlink("output_haven.jpg");
    }
    if(file_exists("output.jpg")){
        unlink("output.jpg");
    }

    $url = $_POST['urllink'];
    $uploadfile = "input.jpg";
    //download image from url
    copy($url, $uploadfile);
    /*
    $ch = curl_init($url);
    $fp = fopen($uploadfile, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    */

    $im = imagecreatefromjpeg($uploadfile);
    $tmp = imagefilter($im , IMG_FILTER_BRIGHTNESS, -50);
    imagejpeg($im, "output_dark.jpg");
    $im = imagecreatefromjpeg($uploadfile);
    $tmp = imagefilter($im , IMG_FILTER_BRIGHTNESS, 100);
    imagejpeg($im, "output_bright.jpg");

    imagedestroy($im);
    $im = imagecreatefromjpeg($uploadfile);
    //original
    $cmd = 'curl -X POST --form "file=@'.$uploadfile.'" --form "additional=true" --form "apikey='.$key.'" '.$host.'/1/api/async/detectfaces/v1';
    $jobID_str = `$cmd`;
    $jobID = json_decode($jobID_str, true)['jobID'];
    #echo '<h2>' . $jobID . '</h2>';
    $cmd = 'curl "'.$host.'/1/job/result/'. $jobID .'?apikey='.$key.'"';
    $result_str = `$cmd`;
    #echo $result_str;
    $results = json_decode($result_str, true)['actions'][0]['result']['face'];
    
    $red = imagecolorallocate($im, 255, 0, 0);
    
    foreach ($results as $r) {
        imagerectangle($im , intval($r['left']) , intval($r['top']) , intval($r['left']+$r['width']) , intval($r['top']+$r['height']) , $red);
        imagerectangle($im , intval($r['left'])+1 , intval($r['top'])+1 , intval($r['left']+$r['width'])-1 , intval($r['top']+$r['height'])-1 , $red);
    }
    imagejpeg($im, "output_haven.jpg");
    // dark
    $cmd = 'curl -X POST --form "file=@output_dark.jpg" --form "additional=true" --form "apikey='.$key.'" '.$host.'/1/api/async/detectfaces/v1';
    $jobID_str = `$cmd`;
    $jobID = json_decode($jobID_str, true)['jobID'];
    #echo '<h2>' . $jobID . '</h2>';
    $cmd = 'curl "'.$host.'/1/job/result/'. $jobID .'?apikey='.$key.'"';
    $result_str = `$cmd`;
    #echo $result_str;
    $results = json_decode($result_str, true)['actions'][0]['result']['face'];
    
    $red = imagecolorallocate($im, 255, 0, 0);
    
    foreach ($results as $r) {
        imagerectangle($im , intval($r['left']) , intval($r['top']) , intval($r['left']+$r['width']) , intval($r['top']+$r['height']) , $red);
        imagerectangle($im , intval($r['left'])+1 , intval($r['top'])+1 , intval($r['left']+$r['width'])-1 , intval($r['top']+$r['height'])-1 , $red);
    }

    // bright

    $cmd = 'curl -X POST --form "file=@output_bright.jpg" --form "additional=true" --form "apikey='.$key.'" '.$host.'/1/api/async/detectfaces/v1';
    $jobID_str = `$cmd`;
    $jobID = json_decode($jobID_str, true)['jobID'];
    #echo '<h2>' . $jobID . '</h2>';
    $cmd = 'curl "'.$host.'/1/job/result/'. $jobID .'?apikey='.$key.'"';
    $result_str = `$cmd`;
    #echo $result_str;
    $results = json_decode($result_str, true)['actions'][0]['result']['face'];
    
    $red = imagecolorallocate($im, 255, 0, 0);
    
    foreach ($results as $r) {
        imagerectangle($im , intval($r['left']) , intval($r['top']) , intval($r['left']+$r['width']) , intval($r['top']+$r['height']) , $red);
        imagerectangle($im , intval($r['left'])+1 , intval($r['top'])+1 , intval($r['left']+$r['width'])-1 , intval($r['top']+$r['height'])-1 , $red);
    }

    imagejpeg($im, "output.jpg");
    imagedestroy($im);
    
    //display results
    echo '<h3>Input image: </h3>';
    echo '<img id="input-img" src="' . $uploadfile . '" />';
    echo '<h3>Result of Haven on Demand Face Detection:</h3>';
    echo '<img id="output-haven-img" src="output_haven.jpg" />';
    echo '<h3>Optimized result: </h3>';
    echo '<img id="output-img" src="output.jpg"/>';
    
}
else {
    echo '<h2>Invalid URL!</h2>';
}
?>