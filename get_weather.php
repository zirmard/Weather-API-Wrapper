
<?php
// ***********************************************************
//   Created by Samad Toyin
//   All rights reserved (C) 2025
// ***********************************************************

include 'weather_api_wrapper.php';

// Replace this with your actual OpenWeatherMap API key
$apiKey = 'your-api-key-here';

$weather = new WeatherAPI($apiKey);

// Check if a city is provided via GET
if (isset($_GET['city'])) {
    $city = $_GET['city'];
    $weatherData = $weather->getWeatherByCity($city);

    if (is_array($weatherData)) {
        echo "<h1>Weather in {$weatherData['city']}</h1>";
        echo "<p>Temperature: {$weatherData['temperature']}°C</p>";
        echo "<p>Description: {$weatherData['description']}</p>";
        echo "<p>Humidity: {$weatherData['humidity']}%</p>";
        echo "<p>Wind Speed: {$weatherData['wind_speed']} m/s</p>";
    } else {
        echo "<p>{$weatherData}</p>";
    }
} else {
    echo "<form action='get_weather.php' method='get'>";
    echo "<label for='city'>Enter City Name:</label>";
    echo "<input type='text' id='city' name='city' required>";
    echo "<input type='submit' value='Get Weather'>";
    echo "</form>";
}
?>
