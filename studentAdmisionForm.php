<?php
function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function is_checked($value, $submitted) {
    return $value === $submitted ? 'checked' : '';
}

function is_skill_checked($skill, $selected_skills) {
    return is_array($selected_skills) && in_array($skill, $selected_skills) ? 'checked' : '';
}

function is_selected($value, $submitted) {
    return $value === $submitted ? 'selected' : '';
}

$name = $email = $age = $gender = $semester = $department = '';
$skills = [];
$errors = [];
$is_valid = false;

$semesters = ['1st Semester', '2nd Semester', '3rd Semester', '4th Semester', '5th Semester', '6th Semester', '7th Semester', '8th Semester'];
$departments = ['Computer Science', 'Information Technology', 'Software Engineering', 'Data Science'];
$available_skills = ['PHP', 'JavaScript', 'Python', 'SQL', 'HTML/CSS'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
    $age = isset($_POST['age']) ? sanitize_input($_POST['age']) : '';
    $gender = isset($_POST['gender']) ? sanitize_input($_POST['gender']) : '';
    $semester = isset($_POST['semester']) ? sanitize_input($_POST['semester']) : '';
    $department = isset($_POST['department']) ? sanitize_input($_POST['department']) : '';
    
    if (isset($_POST['skills']) && is_array($_POST['skills'])) {
        foreach ($_POST['skills'] as $skill) {
            $skills[] = sanitize_input($skill);
        }
    }

    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    if (empty($age)) {
        $errors['age'] = 'Age is required.';
    } elseif (!is_numeric($age) || intval($age) <= 0) {
        $errors['age'] = 'Age must be a valid positive number.';
    }

    if (empty($gender)) {
        $errors['gender'] = 'Please select your gender.';
    }

    if (empty($semester)) {
        $errors['semester'] = 'Please select your semester.';
    }

    if (empty($department)) {
        $errors['department'] = 'Please select your department.';
    }

    if (empty($skills)) {
        $errors['skills'] = 'Please select at least one skill.';
    }

    if (empty($errors)) {
        $is_valid = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Admission Form</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; color: #333; }
        .container { max-width: 600px; background: #fff; padding: 30px; margin: 0 auto; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #2c3e50; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #34495e; }
        .input-text, select { width: 100%; padding: 10px; border: 1px solid #bdc3c7; border-radius: 4px; box-sizing: border-box; font-size: 14px; }
        .radio-group, .checkbox-group { display: flex; gap: 15px; flex-wrap: wrap; margin-top: 5px; }
        .radio-group label, .checkbox-group label { font-weight: normal; display: inline-flex; align-items: center; gap: 5px; cursor: pointer; }
        .btn-submit { background-color: #3498db; color: #fff; border: none; padding: 12px 20px; font-size: 16px; border-radius: 4px; cursor: pointer; width: 100%; transition: background 0.2s; }
        .btn-submit:hover { background-color: #2980b9; }
        .error-msg { color: #e74c3c; font-size: 13px; margin-top: 5px; display: block; }
        .alert { padding: 15px; margin-bottom: 25px; border-radius: 4px; }
        .alert-danger { background-color: #fde8e7; border-left: 5px solid #e74c3c; color: #c0392b; }
        .alert-success { background-color: #e8f8f5; border-left: 5px solid #2ecc71; color: #27ae60; }
        .success-summary ul { margin: 5px 0 0 20px; padding: 0; }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Admission Form</h2>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$is_valid): ?>
        <div class="alert alert-danger">
            <strong>Validation Failed:</strong> Please fix the errors highlighted below.
        </div>
    <?php endif; ?>

    <?php if ($is_valid): ?>
        <div class="alert alert-success success-summary">
            <strong>Success! Admission form submitted securely.</strong>
            <p><strong>Submitted Details:</strong></p>
            <ul>
                <li><strong>Name:</strong> <?php echo $name; ?></li>
                <li><strong>Email:</strong> <?php echo $email; ?></li>
                <li><strong>Age:</strong> <?php echo $age; ?></li>
                <li><strong>Gender:</strong> <?php echo $gender; ?></li>
                <li><strong>Semester:</strong> <?php echo $semester; ?></li>
                <li><strong>Department:</strong> <?php echo $department; ?></li>
                <li><strong>Skills:</strong> <?php echo implode(', ', $skills); ?></li>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" class="input-text" value="<?php echo $name; ?>">
            <?php if (isset($errors['name'])): ?>
                <span class="error-msg"><?php echo $errors['name']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" id="email" name="email" class="input-text" value="<?php echo $email; ?>">
            <?php if (isset($errors['email'])): ?>
                <span class="error-msg"><?php echo $errors['email']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="text" id="age" name="age" class="input-text" value="<?php echo $age; ?>">
            <?php if (isset($errors['age'])): ?>
                <span class="error-msg"><?php echo $errors['age']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="Male" <?php echo is_checked('Male', $gender); ?>> Male</label>
                <label><input type="radio" name="gender" value="Female" <?php echo is_checked('Female', $gender); ?>> Female</label>
                <label><input type="radio" name="gender" value="Other" <?php echo is_checked('Other', $gender); ?>> Other</label>
            </div>
            <?php if (isset($errors['gender'])): ?>
                <span class="error-msg"><?php echo $errors['gender']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="semester">Semester</label>
            <select id="semester" name="semester">
                <option value="">-- Select Semester --</option>
                <?php foreach ($semesters as $sem): ?>
                    <option value="<?php echo $sem; ?>" <?php echo is_selected($sem, $semester); ?>>
                        <?php echo $sem; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['semester'])): ?>
                <span class="error-msg"><?php echo $errors['semester']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="department">Department</label>
            <select id="department" name="department">
                <option value="">-- Select Department --</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?php echo $dept; ?>" <?php echo is_selected($dept, $department); ?>>
                        <?php echo $dept; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['department'])): ?>
                <span class="error-msg"><?php echo $errors['department']; ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Technical Skills</label>
            <div class="checkbox-group">
                <?php foreach ($available_skills as $avail_skill): ?>
                    <label>
                        <input type="checkbox" name="skills[]" value="<?php echo $avail_skill; ?>" <?php echo is_skill_checked($avail_skill, $skills); ?>>
                        <?php echo $avail_skill; ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <?php if (isset($errors['skills'])): ?>
                <span class="error-msg"><?php echo $errors['skills']; ?></span>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-submit">Submit Application</button>
    </form>
</div>

</body>
</html>
