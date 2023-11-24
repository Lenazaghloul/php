<!DOCTYPE html>
<html lang="en">
<?php include('./template/header.php') ?>
<!-- <?php echo 'hello'?> -->

<body>
    <?php include('./config/db.php') ?>


    <?php
    $errors = array('email' => '', 'name' => '',  'date_of_birth' => '', 'phone' => '', 'gender' =>'', 'grade' => '');

    if (isset($_POST['submit'])) {

        if (empty($_POST['email'])) {
            $errors['email'] = 'Email is required <br />';
        } else {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email is invalid <br />';
            }
        }

        if (empty($_POST['name'])) {
            $errors['name'] = 'Name is required <br />';
        } else {
            $name = $_POST['name'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
                $errors['name'] = 'Name must be characters only <br />';
            }
        }

        if (empty($_POST['gender'])) {
            $errors['gender'] = 'Gender is required <br />';
        }

        if (empty($_POST['date_of_birth'])) {
            $errors['date_of_birth'] = 'Date is required <br />';
        }


        if (empty($_POST['grade'])) {
            $errors['grade'] = 'Grade is required <br />';
        } else {
            $grade = mysqli_real_escape_string($conn, $_POST['grade']);
        }

        if (empty($_POST['phone'])) {
            $errors['phone'] = 'Phone number is required <br />';
        } else {
            $phone = $_POST['phone'];

            // Check if the phone number follows the Egyptian format (11 digits starting with 01)
            if (!preg_match('/^01[0-9]{9}$/', $phone)) {
                $errors['phone'] = 'Invalid phone number format (should start with 01 and be 11 digits) <br />';
            }
        }

        if (array_filter($errors)) {
            echo 'Errors in the form';
        } else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);
            $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $comment = mysqli_real_escape_string($conn, $_POST['text']);
            $grade = mysqli_real_escape_string($conn, $_POST['grade']);

           $sql = "INSERT INTO student(email, name, date_of_birth, phone, comment, gender, grade) 
            VALUES ('$email', '$name', '$date_of_birth', '$phone', '$comment', '$gender', '$grade')";

if(mysqli_query($conn, $sql)){

}else {
    echo 'error' . mysqli_error($conn);
}



echo '<h1>form is valid</h1>';
header('Location: test.php');
        }
    }
    ?>

    <section class="container grey-text">
        <h4 class="center">Add</h4>
        <form action="school.php" class="white" method="POST">
            <label for="name">Student name:</label>
            <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
            <div class="red-text"><?php echo $errors['name']; ?></div>

            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ''); ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>

            <label for="gender">Gender</label>
            <input type="radio" name="gender" value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'Male') ? 'checked' : ''; ?>>
            Male
            <input type="radio" name="gender" value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'Female') ? 'checked' : ''; ?>>
            Female
            <div class="red-text"><?php echo $errors['gender']; ?></div>


            <label for="date_of_birth">Date of birth</label>
            <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars(isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : ''); ?>">
            <div class="red-text"><?php echo $errors['date_of_birth']; ?></div>

            <label for="phone">Contact number</label>
            <input type="number" name="phone" value="<?php echo htmlspecialchars(isset($_POST['phone']) ? $_POST['phone'] : ''); ?>">
            <div class="red-text"><?php echo $errors['phone']; ?></div>

            <label for="grade">Grade</label>
            <select name="grade" id="grade">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
            </select>


            <label for="text">Comment</label>
            <textarea name="text" id="" cols="30" rows="10"></textarea>

            <div class="center">
                <input type="submit" name="submit" id="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('./template/footer.php') ?>
</body>

</html>