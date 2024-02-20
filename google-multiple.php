function getImagesFromGoogle($keyword, $apiKey, $cx, $startIndex = 1, $num = 1) {
    $url = "https://www.googleapis.com/customsearch/v1?q=$keyword&key=$apiKey&cx=$cx&searchType=image&start=$startIndex&num=$num";

    $response = file_get_contents($url);

    if ($response === false) {
        return null; // Handle error, e.g., by returning a default image
    }

    $data = json_decode($response, true);

    if (!$data || !isset($data['items'])) {
        return null; // Handle error, e.g., by returning a default image
    }

    $images = [];
    foreach ($data['items'] as $item) {
        $images[] = $item['link'];
    }

    return $images;
}

// Example usage
$keyword = 'title';
$googleApiKey = 'your_google_api_key'; // Replace with your Google Cloud API key
$googleCx = 'your_custom_search_cx'; // Replace with your Custom Search Engine ID (cx)

$images = getImagesFromGoogle($keyword, $googleApiKey, $googleCx, 1, 3); // Retrieve 3 images starting from the first result

if (!empty($images)) {
    echo "<h1>Images related to '$keyword'</h1>";
    echo "<div style='display: flex;'>";
    foreach ($images as $imageUrl) {
        echo "<img src=\"$imageUrl\" alt=\"Image related to '$keyword'\" style='margin-right: 10px;'>";
    }
    echo "</div>";
} else {
    echo "No images found for '$keyword'";
}
