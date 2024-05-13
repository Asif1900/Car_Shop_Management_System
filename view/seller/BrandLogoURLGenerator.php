<?php
function getBrandLogoUrl($brandName) {
    // Replace spaces with dashes and convert to lowercase
    $formattedBrandName = str_replace(' ', '-', strtolower($brandName));

    // Base URL of the Clearbit Logo API
    $baseUrl = "https://logo.clearbit.com/";

    // Construct the logo URL by appending the formatted brand name to the base URL
    $logoUrl = $baseUrl . $formattedBrandName . ".com";

    // Check if the logo exists (using a HEAD request)
    $headers = get_headers($logoUrl);
    if (strpos($headers[0], "200")) {
        // If the logo exists, return the URL
        return $logoUrl;
    } else {
        // If the logo doesn't exist, return a default logo URL or an empty string
        return ""; // You can also return a default logo URL here
    }
}
?>
