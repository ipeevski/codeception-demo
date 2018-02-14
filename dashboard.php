<?php
require 'vendor/autoload.php';
include 'c3.php';

session_start();

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

if (!empty($_POST['username'])) {
    $users = [];
    for ($i = 1; $i < 10; $i++) {
        $users[] = [
            'id' => $i,
            'name' => $faker->name,
            'gender' => ($faker->boolean ? 'Female' : 'Male'),
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'registration' => $faker->date,
            'dob' => $faker->dateTimeBetween('-40 years', '-30 years')->format('d-M-Y')
        ];
    }

    $_SESSION['users'] = $users;
    $_SESSION['login'] = $_POST['username'];
} else {
    $users = $_SESSION['users'];
}
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Demo Site</title>
        <link href="main.css" rel="stylesheet">
    </head>
    <body>
        <div id="dashboard">
            <nav class="navbar navbar-dark sticky-top bg-dark navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a id="username" class="nav-link username" href="#"><?php echo $_SESSION['login'] ?></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                        <div class="sidebar-sticky">
                            <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="dashboard.php">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                <span data-feather="bar-chart-2"></span>
                                Reports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                <span data-feather="layers"></span>
                                Integrations
                                </a>
                            </li>
                            </ul>
                        </div>
                    </nav>
                    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">Dashboard</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <button class="btn btn-sm btn-outline-secondary">Share</button>
                                <button class="btn btn-sm btn-outline-secondary">Export</button>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                This week
                            </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="users-table" class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Registration Date</th>
                                    <th>Date of Birth</th>
                                </tr>
                            </thead>
                            <tbody>
<?php foreach ($users as $user) : ?>
                                <tr data-id="<?php echo $user['id'] ?>">
                                    <td><a href="user.php?id=<?php echo $user['id'] ?>"><?php echo $user['id'] ?></a></td>
                                    <td><a href="user.php?id=<?php echo $user['id'] ?>"><?php echo $user['name'] ?></a></td>
                                    <td><?php echo $user['gender'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo $user['phone'] ?></td>
                                    <td><?php echo $user['registration'] ?></td>
                                    <td><?php echo $user['dob'] ?></td>
                                </tr>
<?php endforeach ?>
                            </tbody>
                            </table>
                        </div>
                    </main>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
            feather.replace();
        </script>
    </body>
</html>