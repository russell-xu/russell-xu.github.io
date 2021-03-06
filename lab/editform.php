<?php
if (isset($_POST['cancelButton'])) {
    header("location:index.php");
    exit();
}

if (!isset($_GET["id"])) {
    die("id not found");
}

$id = $_GET["id"];

if (!is_numeric($id)) {
    die("id not number");
}


require_once("connectconfig.php");

if (isset($_POST["okButton"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $cityId = $_POST["cityId"];
    $sql = <<<multi
    update employee set 
    firstName = '$firstName',
    lastName = '$lastName',
    cityId = '$cityId'
    where employeeId = $id
    multi;
    mysqli_query($link, $sql);
    header("location:index.php");
} else {
    $sql = <<<multi
    SELECT
    *
    FROM
        employee
    WHERE
        employeeId = $id
    multi;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            padding-top: 50px;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Edit Form</h1>
    <form class="container" method="POST">
        <div class="form-group row">
            <label for="text" class="col-4 col-form-label">First Name</label>
            <div class="col-8">
                <input id="text" name="firstName" type="text" class="form-control" value="<?= $row["firstName"] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="text1" class="col-4 col-form-label">Last Name</label>
            <div class="col-8">
                <input id="text1" name="lastName" type="text" class="form-control" value="<?= $row["lastName"] ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">City</label>
            <div class="col-8">
                <div class="custom-control custom-radio custom-control-inline">
                    <input name="cityId" id="radio_0" type="radio" class="custom-control-input" value="2" <?= $row["cityId"] == 2 ? "checked" : "" ?>>
                    <label for="radio_0" class="custom-control-label">Taipei</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input name="cityId" id="radio_1" type="radio" class="custom-control-input" value="4" <?= $row["cityId"] == 4 ? "checked" : "" ?>>
                    <label for="radio_1" class="custom-control-label">Taichung</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input name="cityId" id="radio_2" type="radio" class="custom-control-input" value="6" <?= $row["cityId"] == 6 ? "checked" : "" ?>>
                    <label for="radio_2" class="custom-control-label">Tainan</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="okButton" type="submit" class="btn btn-primary">Submit</button>
                <button name="cancelButton" type="submit" class="btn btn-primary">Cancel</button>
            </div>
        </div>
    </form>
</body>

</html>