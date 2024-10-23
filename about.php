<!DOCTYPE html>
<html lang="en">
<head>
    <title>About</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="about-page">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

// Bikin koneksi db
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data menu
$sql = "SELECT menu, url FROM menu";
$result = $conn->query($sql);

// ambil data about
$about_sql = "SELECT name, role, description, image_url, backward_link, forward_link FROM about WHERE id = 1";
$about_result = $conn->query($about_sql);
$about_data = $about_result->fetch_assoc();

if ($result) {
?>

<nav class="navbar navbar-expand-lg p-3">
    <div class="container fw-bolder">
        <a class="navbar-brand fs-4" href="#">Ellbendls.</a>
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
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
                $conn->close();
                ?>
            </ul>
            <div class="form-check form-switch ms-3">
                <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                <label class="form-check-label" for="darkModeSwitch">Dark Mode</label>
            </div>
        </div>
    </div>
</nav>

<?php
} else {
    echo "Error: " . $conn->error;
}
?>

<!-- About Section -->
<div class="about">
    <div class="row">
        <div class="col-lg-3 text-center">
            <img src="<?php echo $about_data['image_url']; ?>" alt="Profile Picture" class="about__image">
        </div>
        <div class="col-lg-9">
            <h1 class="about__name"><?php echo $about_data['name']; ?></h1>
            <h2 class="about__role"><?php echo $about_data['role']; ?></h2>
            <p class="about__desc">
                <?php echo $about_data['description']; ?>
            </p>
        </div>
    </div>
    <div class="navigation-arrows">
        <a href="<?php echo $about_data['backward_link']; ?>" class="btn btn--outline">
            <i class="fas fa-arrow-left"></i>
        </a>
        <a href="<?php echo $about_data['forward_link']; ?>" class="btn btn--outline">
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

<script>
document.getElementById('darkModeSwitch').addEventListener('change', function() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
});

document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('darkMode') !== 'false') {
        document.body.classList.add('dark-mode');
        document.getElementById('darkModeSwitch').checked = true;
    } else {
        document.getElementById('darkModeSwitch').checked = false;
    }
});

// efek transisi halus
document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('fade-in');
});

document.querySelectorAll('a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        document.body.classList.remove('fade-in');
        setTimeout(() => {
            window.location.href = href;
        }, 500);
    });
});
</script>
</body>
</html>