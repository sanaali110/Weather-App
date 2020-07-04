<?php
$weather="";//was giving warning undefined
$error ="";// was giving warning undefined

if(array_key_exists('city',$_GET)){
    
    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=0a53d3ad17820ef6c53cc9461d1a5bbd");


    $weatherArray = json_decode($urlContents,true);
    
    if($weatherArray['cod'] == 200){


    $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'.";
    
    $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

    $weather .= "The temperature is ".$tempInCelcius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s.";


    }else{

            $error = "Couldn't find the city, please try again";

        }
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <title>Weather App</title>
  </head>
  <body>
      <div class="container-fluid">
            <div class="content">
                <h5 class="heading"> What's the weather?</h5>
                
                <form>
                    <input type="text" name="city"   class="form-control col-md-6 mb-4" style="margin: 0 auto;" id="getCity" placeholder= "Enter the name of the city">

                    <button class="btn btn-primary mb-4">Submit</button>
                    <div id="weather">
                        <?php  if($weather){
                            echo '<div class="alert alert-success" role="alert">'.$weather.
                           
                          '</div>';}else if($error){

                          echo '<div class="alert alert-danger" role="alert">'.$error.
                           
                          '</div>';
                        }   ?>
                    </div>
                </form>
            </div>

      </div>
   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="jqueryfile.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP8lNXMd15_KbqbMuQ_x6SoPhFbhhBjWI&libraries=places&callback=activatePlacesSearch"></script>    
</body>
</html>