<?php
/*
Librato metrics tracking.
*/
class metrics {

    private $LIBRATO_URL = 'https://metrics-api.librato.com/v1/metrics';
    private $LIBRATO_API_KEY = '';
    private $LIBRATO_USERNAME = '';
    private $LIBRATO_SOURCE = '';

    private $gauges = Array();


    function track($gauge_name, $value) {
        // This populates the tracking data before it's submitted 

        $this->gauges[] = array(
            'name' => $gauge_name,
            'value' => $value,
            'source' => $this->LIBRATO_SOURCE);
    }

    function send() {
        // Send data to Librato.

        // Don't send if there's nothing to send.
        if (!$this->gauges) return;

        $curl = curl_init($this->LIBRATO_URL);

        $curl_post_data = json_encode(array('gauges' => $this->gauges));

        $headers = array('Content-Type: application/json');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);

        curl_setopt($curl, CURLOPT_USERPWD, $this->LIBRATO_USERNAME.':'.$this->LIBRATO_API_KEY);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_status != 200) {
            echo "Librato metrics posting failed.\n".
                 'http status '.$http_status."\n".
                 'Post data: '.$curl_post_data."\n";
        } else {
            // Success!

            // We reset the gauges data to prevent double sending.
            $this->gauges = Array();
        }

    }

}
?>
