<style type="text/css">
body
 {
    background-color: #eef2f4;
    font-family: lato;
    margin: 0 auto;
    padding:0;
 }
 h1,h2
 {
color: #536172;
font-weight: lighter;
text-align: center;
 }
 .container
 {
    width: 800px;
    margin: 0 auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
 }
form
{
    max-width: 400px;
    margin: 0 auto;
    color:#616161;
    font-size: 18px;
    font-family: arial;
    padding: 25px;
    margin-top: 60px;
    padding: 0;
}

 input[type=text]
 {
    background-color:#fff;
    color: #536172;
    padding: 10px ;
    text-decoration: ;
    cursor: pointer;
    width: 265px;
    box-sizing: border-box;
    border: solid 1px rgba(128,145,165,1);

}

.button{
    background-color:#536172;
    border: none;
    color: #fff;
    padding: 11px 32px;
    text-decoration: none;
    cursor: pointer;    transition:0.4s;


}
.button:hover 
{
        background-color:#8091a5;   transition:0.7s; 

}


table {
    border-collapse: collapse;
    width: 400px;
    margin: 0 auto;
    text-align: center;
}

th, td {
    text-align: center;
    padding: 8px;border: solid 1px;
}

tr{background-color: #8091a5;color: #fff;}
tr:nth-child(even){background-color: #536172;color: #fff;}
 </style>
<?php
if (!empty($_GET['ip']))
{
$ipaddress = $_GET['ip'];
    function ip_details($ip)
     {
    $json = file_get_contents("http://ipapi.co/{$ip}/json/");
    $details = json_decode($json); 

    return $details;
    }

    function flag($pays)
     {
    $json = file_get_contents("http://restcountries.eu/rest/v2/name/{$pays}");
    $details = json_decode($json);    
    $flag=array();
    foreach ($details as $value) { 
    $flag[]=$value->flag;
    }
    return $value->flag;
    }

    function weather($pays,$ville)
     {
    $json_string = file_get_contents("http://api.wunderground.com/api/f920f89a8cab3de4/conditions/q/{$pays}/{$ville}.json");
    $parsed_json = json_decode($json_string);
    $weather = $parsed_json->{'current_observation'}->{'weather'};
    $temp_c = $parsed_json->{'current_observation'}->{'temp_c'};

    return $temp_c;
    }
   

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>INFORMATION BY IP </title>
    <link rel="icon" href="fav.PNG" type="image/gif" sizes="16x16">

</head>
<body>

    <div class="container">
    <H1> GET SOME INFORMATION BY <IMG SRC="ip.png" width="32">  </H1>
        <h2>Salut Madame Yemna :) </h2>
<form action="" method="get">
    <input type="text" name="ip" placeholder="Donner une @IP" onfocus="this.placeholder = ''"onblur="this.placeholder = 'Donner une @IP'"/>
    <button type="submit" class="button">ENVOYER</button>
</form>
<br/>


<div id="results" data-url="<?php if (!empty($url)) echo $url ?>">

    <?php


if (!empty($_GET['ip']))
{
    $details = ip_details($ipaddress);
   //echo $details->latitude."<br>".$details->longitude."<br>";
    
    if(strpos($details->country_name," "))
    {
   // $flag = flag($details->country);
    $weather = weather($details->region,$details->city);

    }
    else
    {
     //$flag = flag($details->country_name);
     $weather = weather($details->country_name,$details->city);

    }

 ?>
</div>



    <table>
      <tr>
        <td>Adresse IP</td>
        <td><?php echo $details->ip ?></td>
      </tr>

      <tr>
        <td>Pays</td>
        <td><?php echo $details->country_name ?></td>
      </tr>

      <tr>
        <td>Drapeau</td>
        <td><img src="http://www.countryflags.io/<?php echo $details->country ?>/shiny/64.png"  width="42"></td>


      </tr>

       <tr>
        <td>Ville</td>
        <td><?php echo $details->city; ?></td>
      </tr> 

       <tr>
        <td>Region</td>
        <td><?php echo $details->region; ?></td>
      </tr> 
       <tr>
        <td>Fournisseur Internet</td>
        <td><?php echo $details->org; ?></td>
      </tr> 
       <tr>
        <td>Meteo</td>
        <td><?php  echo $weather."°"; ?></td>
      </tr> 
    </table>

<?php } ?>
</div>
</body>
</html>