<?php
if(isset($_POST["downloadBtn"])){
    $imgURL = $_POST["file"];
    $regPattern = "/\.(jpe?g|png|gif|bmp)$/i";
    if(preg_match($regPattern, $imgURL)){
        $initCURL = curl_init($imgURL);
        curl_setopt($initCURL, CURLOPT_RETURNTRANSFER, true);
        $downloadImgLink = curl_exec($initCURL);
        curl_close($initCURL);
        header("Content-type: image/jpg");
        header("Content-Disposition: attachment;filename='image.jpg'");
        echo $downloadImgLink;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Img Download in PHP</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="preview-box">
            <div class="cancel-icon"><i class="fas fa-times"></i></div>
            <div class="img-preview">
            </div>
            <div class="content">
                <div class="img-icon"><i class="far fa-image"></i></div>
                <div class="text">Paste the image url below, <br>to see a preview or download!</div>
            </div>
        </div>
        <form action="./index.php" method="POST" class="input-data">
            <input type="text" id="field" name="file" placeholder="Paste the image url to download..." autocomplete="off">
            <input type="submit" id="button" name="downloadBtn" value="Download">
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $("#field").on("focusout", function(){
                var imgURL = $("#field").val();
                if(imgURL != ""){
                    var regPattern = /\.(jpe?g|png|gif|bmp)$/i;
                    if(regPattern.test(imgURL)){
                        var imgTag = "<img src ='" + imgURL +"' alt=''>";
                        $(".img-preview").append(imgTag);
                        $(".preview-box").addClass("imgActive");
                        $("#button").addClass("active");
                        $("#field").addClass("disabled");
                        $(".cancel-icon").on("click", function(){
                            $(".preview-box").removeClass("imgActive");
                            $("#button").removeClass("active");
                            $("#field").removeClass("disabled");
                            $(".img-preview img").remove();
                        });
                    }else{
                        alert("Invalid img URL - " + imgURL);
                        $("#field").val("");
                    }
                }
            });
        });
    </script>
</body>
</html>