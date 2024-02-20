function getFirstImageFromUnsplash($keyword) {
    $accessKey = 'your_unsplash_access_key'; // Replace with your Unsplash access key

    $url = "https://api.unsplash.com/photos/random?query=$keyword&client_id=$accessKey";

    $response = file_get_contents($url);

    if ($response === false) {
        return null; // Handle error, e.g., by returning a default image
    }

    $data = json_decode($response, true);

    if (!$data || !isset($data['urls']['regular'])) {
        return null; // Handle error, e.g., by returning a default image
    }

    return $data['urls']['regular'];
}

// Example usage
$keyword = 'title';
$imageUrl = getFirstImageFromUnsplash($keyword);

if ($imageUrl) {
    echo "<img src=\"$imageUrl\" alt=\"Image related to '$keyword'\">";
} else {
    echo "No image found for '$keyword'";
}
