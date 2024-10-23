<!DOCTYPE html>
<html lang="en">
<head>
    <title>Projects</title>
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

// Buat koneksi db
$conn = new mysqli($servername, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ambil data navbar
$sql = "SELECT menu, url FROM menu";
$result = $conn->query($sql);

// ambil data projects
$projects_sql = "SELECT title, description, thumbnail, github_link FROM projects";
$projects_result = $conn->query($projects_sql);


$metadata_sql = "SELECT title, backward_link, forward_link FROM projects_metadata WHERE id = 1";
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

<!-- Projects Section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="projects-container">
                <h2 class="text-center mb-5"><?php echo $metadata['title']; ?></h2>
                <div class="row">
                    <?php
                    if ($projects_result->num_rows > 0) {
                        while($row = $projects_result->fetch_assoc()) {
                            echo '<div class="col-md-6 col-lg-4 project-item">';
                            echo '<img src="' . $row["thumbnail"] . '" alt="Project Thumbnail" class="project-thumbnail">';
                            echo '<h3 class="project-title">' . $row["title"] . '</h3>';
                            echo '<p class="project-description">' . $row["description"] . '</p>';
                            echo '<div class="github-link"><a href="' . $row["github_link"] . '"><i class="fab fa-github"></i></a></div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No projects found.</p>';
                    }
                    ?>
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
        <i class="fas fa-arrow-right"></i>
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