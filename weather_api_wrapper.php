
<?php
// ***********************************************************
//   Created by Samad Toyin
//   All rights reserved (C) 2025
// ***********************************************************

class WeatherAPI {
    private $apiKey;
    private $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';

    // Constructor that sets the API key
    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    // Function to get weather data for a specific city
    public function getWeatherByCity($city) {
        // URL for API request
        $url = "{$this->baseUrl}?q={$city}&appid={$this->apiKey}&units=metric";

        // Use cURL to fetch data from the weather API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for simplicity
        $response = curl_exec($ch);
        curl_close($ch);

        // Check if the API returned data
        if ($response) {
            // Decode the JSON response into an associative array
            $data = json_decode($response, true);

            // Check if the response is valid
            if ($data['cod'] == 200) {
                return [
                    'city' => $data['name'],
                    'temperature' => $data['main']['temp'],
                    'description' => $data['weather'][0]['description'],
                    'humidity' => $data['main']['humidity'],
                    'wind_speed' => $data['wind']['speed']
                ];
            } else {
                return "Error: " . $data['message'];
            }
        } else {
            return "Unable to fetch weather data.";
        }
    }
}
?>
