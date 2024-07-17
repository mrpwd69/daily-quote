<?php
print_r("
<div class=\"container bg-secondary md-7\">
<form action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">
<select name=\"category\" class=\"form-control\">
    <option value=\"health\">HEALTH</option>
    <option value=\"success\">SUCCESS</option>
    <option value=\"freedom\">FREEDOM</option>
    <option value=\"happiness\">HAPPINESS</option>
    <option value=\"funny\">FUNNY</option>
    <option value=\"random\">RANDOM</option>
</select>
<button class=\"form-control\" type=\"submit\" name=\"submit\">SELECT</button>
</form>
</div>
");

$category = array("freedom", "funny", "happiness", "health", "success");
$randCategory = $category[array_rand($category)];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        if ($_POST["category"] == "health") {
            $api_url = "https://api.api-ninjas.com/v1/quotes?category=health";
        } elseif ($_POST["category"] == "success") {
            $api_url = "https://api.api-ninjas.com/v1/quotes?category=success";
        } elseif ($_POST["category"] == "freedom") {
            $api_url = "https://api.api-ninjas.com/v1/quotes?category=freedom";
        } elseif ($_POST["category"] == "happiness") {
            $api_url = "https://api.api-ninjas.com/v1/quotes?category=happiness";
        } elseif ($_POST["category"] == "funny") {
            $api_url = "https://api.api-ninjas.com/v1/quotes?category=funny";
        } elseif ($_POST["category"] == "random") {
            $api_url = "https://api.api-ninjas.com/v1/quotes?category=" . $randCategory;
        } else {
            echo "<h1 style=\"background-color:red;\">You didn't select your desired category, we cosider it as random!</h1>";
        }
    }
} else {
    $api_url = "https://api.api-ninjas.com/v1/quotes?category=" . $randCategory;
}
$api_key = "lIZw4C7qsswvcpm4TP+Scg==zin5eUlh8TFnF8Pl";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Api-Key: " . $api_key));
$response = curl_exec($ch);
$data = json_decode($response, true);
curl_close($ch);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-dark bg-gradient">
    <div class="container bg-dark md-6 text-center">
        <h1><span style="color:red;">Quote:</span><u><blockquote style="color:white;"><?php echo $data[0]["quote"] ?></blockquote></u></h1>
        <h2><span style="color:red;">Author:</span> <?php echo $data[0]["author"] ?></h2>
        <h3><span style="color:red;">Category:</span> <?php echo $data[0]["category"] ?></h3>
    </div>

</body>

</html>
