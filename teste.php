<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="./slick-master/slick/slick.css">
	<link rel="stylesheet" href="./slick-master/slick/slick-theme.css">
</head>

<body>
   
    <?php 
        $count=0;
        for($i=0 ;$i<=1200; $i++){
            if(fmod($i,60)==0){
                $count++;
                echo"<br>";
                echo $count;
            }
        }
    ?>
</body>
</html>
