function getFirstImageFromGoogleImages($keyword, $apiKey, $cx) {
    $url = "https://www.googleapis.com/customsearch/v1?q=$keyword&key=$apiKey&cx=$cx&searchType=image";

    $response = file_get_contents($url);

    if ($response === false) {
        return null; // Handle error, e.g., by returning a default image
    }

    $data = json_decode($response, true);

    if (!$data || !isset($data['items'][0]['link'])) {
        return null; // Handle error, e.g., by returning a default image
    }

    return $data['items'][0]['link'];
}

// Example usage
$keyword = 'title';
$googleApiKey = 'your_google_api_key'; // Replace with your Google Cloud API key
$googleCx = 'your_custom_search_cx'; // Replace with your Custom Search Engine ID (cx)

$imageUrl = getFirstImageFromGoogleImages($keyword, $googleApiKey, $googleCx);

if ($imageUrl) {
    echo "<img src=\"$imageUrl\" alt=\"Image related to '$keyword'\">";
} else {
    echo "No image found for '$keyword'";
}
