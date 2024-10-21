<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-page">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch navbar data
$sql = "SELECT menu, url FROM menu";
$result = $conn->query($sql);

// Fetch hero section data
$hero_sql = "SELECT name, description, link FROM hero_section WHERE id = 1";
$hero_result = $conn->query($hero_sql);
$hero_data = $hero_result->fetch_assoc();

if ($result) {
?>

<nav class="navbar navbar-expand-lg p-3">
    <div class="container fw-bolder">
        <a class="navbar-brand fs-4" href="#">Ellbendls.</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<li class="nav-item fs-6">';
                        echo '<a class="nav-link" href="' . $row["url"] . '">' . $row["menu"] . '</a>';
                        echo '</li>';
                    }
                } else {
                    echo '<li class="nav-item fs-6">0 results</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<?php
} else {
    echo "Error: " . $conn->error;
}
?>

<!-- Hero Section -->
<div class="about center">
    <h1>I am <span class="about__name"><?php echo $hero_data['name']; ?></span></h1>
    <p class="about__desc">
        <?php echo $hero_data['description']; ?>
    </p>

    <div class="about__contact center">
        <a href="<?php echo $hero_data['link']; ?>" class="btn btn--outline">
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>

<!-- Footer -->
<footer class="footer text-center py-3 mt-auto">
    <div class="container">
        <span>© 2024 Ellbendls.</span>
    </div>
</footer>
<!-- Footer -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>