<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio";

// Buat Koneksi db
$conn = new mysqli($servername, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ambil data navbar
$sql = "SELECT menu, url FROM menu";
$result = $conn->query($sql);

// ambil data contact section
$metadata_sql = "SELECT title, backward_link, forward_link, github_link, linkedin_link, instagram_link FROM contact_metadata WHERE id = 1";
$metadata_result = $conn->query($metadata_sql);
$metadata = $metadata_result->fetch_assoc();

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

<!-- Contact Section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="contact-container">
                <h2 class="text-center mb-5"><?php echo $metadata['title']; ?></h2>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <h3 class="text-center mt-5">Connect with Me</h3>
                <div class="social-links">
                    <a href="<?php echo $metadata['github_link']; ?>"><i class="fab fa-github"></i></a>
                    <a href="<?php echo $metadata['linkedin_link']; ?>"><i class="fab fa-linkedin"></i></a>
                    <a href="<?php echo $metadata['instagram_link']; ?>"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Arrows -->
<div class="navigation-arrows">
    <a href="<?php echo $metadata['backward_link']; ?>" class="btn btn--outline">
        <i class="fas fa-arrow-left"></i>
    </a>
    <a href="<?php echo $metadata['forward_link']; ?>" class="btn btn--outline">
        <i class="fas fa-home"></i>
    </a>
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
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
        document.getElementById('darkModeSwitch').checked = true;
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