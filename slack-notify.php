<?php


class Dobambam {
// (string) $message - message to be passed to Slack
// (string) $room - room in which to write the message, too
// (string) $icon - You can set up custom emoji icons to use with each message
   
  
public static function slack($message,$room,$username,$url) {

        //$channel = $_GET["channel"];    
        //$msg = $_GET["msg"];
        //echo $message."<br>".$room."<br>".$username."<br>".$url."<br>";

        $room = ($room) ? $room : "general";
        $data = "payload=" . json_encode(array(
                "channel"       =>  "#{$room}",
                "username"       =>   $username,
                "text"          =>  $message               
            ));

        // You can get your webhook endpoint from your Slack settings
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        // Laravel-specific log writing method
        // Log::info("Sent to Slack: " . $message, array('context' => 'Notifications'));
        return $result;
    }
}

//Get the parametter hare
$message = $_GET["msg"];
$room = $_GET["channel"];
$username = $_GET["username"];
$url = $_GET["url"];

Dobambam::slack($message,$room,$username,$url);


?>