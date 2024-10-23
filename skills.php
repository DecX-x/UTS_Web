<!DOCTYPE html>
<html lang="en">
<head>
    <title>Skills</title>
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

// buat koneksi db
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ambil data navbar
$sql = "SELECT menu, url FROM menu";
$result = $conn->query($sql);

// ambil data skills
$skills_sql = "SELECT skill_name, skill_percent FROM skills";
$skills_result = $conn->query($skills_sql);


$metadata_sql = "SELECT title, backward_link, forward_link FROM skills_metadata WHERE id = 1";
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

<!-- Skills Section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="skills-container">
                <h2 class="text-center mb-5"><?php echo $metadata['title']; ?></h2>
                <div class="row justify-content-center">
                    <?php
                    if ($skills_result->num_rows > 0) {
                        while($row = $skills_result->fetch_assoc()) {
                            $skill_percent = $row["skill_percent"];
                            $skill_level = '';

                            if ($skill_percent < 65) {
                                $skill_level = 'Basic';
                            } elseif ($skill_percent <= 85) {
                                $skill_level = 'Intermediate';
                            } else {
                                $skill_level = 'Advanced';
                            }

                            echo '<div class="col-6 col-sm-6 col-md-4 mb-4">';
                            echo '<div class="skill-item mx-auto animated" data-skill="' . $row["skill_name"] . '" data-percent="' . $skill_percent . '">';
                            echo '<svg class="skill-circle">';
                            echo '<circle class="bg" cx="70" cy="70" r="70"></circle>';
                            echo '<circle class="progress" cx="70" cy="70" r="70"></circle>';
                            echo '</svg>';
                            echo '<div class="skill-text">';
                            echo '<div class="skill-percent">0%</div>';
                            echo '<div class="skill-name">' . $row["skill_name"] . '</div>';
                            echo '<div class="skill-level">' . $skill_level . '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No skills found.</p>';
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
document.addEventListener('DOMContentLoaded', () => {
    const skills = document.querySelectorAll('.skill-item');
    const animateSkill = (skill) => {
        const circle = skill.querySelector('.progress');
        const percent = skill.dataset.percent;
        const percentText = skill.querySelector('.skill-percent');
        const radius = circle.r.baseVal.value;
        const circumference = radius * 2 * Math.PI;
        const offset = circumference - (percent / 100) * circumference;
        circle.style.strokeDashoffset = offset;
        let count = 0;
        const timer = setInterval(() => {
            if (count >= percent) {
                clearInterval(timer);
            } else {
                count++;
                percentText.textContent = count + '%';
            }
        }, 15);
    };
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                animateSkill(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    skills.forEach(skill => observer.observe(skill));
});

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