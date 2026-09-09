<?php
// 1. Create variables for student information
$student_name = "Alex Morgan";
$student_id   = "STU-98742";
$subject      = "Introduction to PHP";
$marks        = 85; // Change this value to test different outcomes (e.g., 45, 62, 95)

// 2. Calculate grade and status message using conditional statements
if ($marks >= 90 && $marks <= 100) {
    $grade = "A+";
    $status_message = "Outstanding performance! Keep up the brilliant work.";
} elseif ($marks >= 80) {
    $grade = "A";
    $status_message = "Excellent job! You have demonstrated a strong grasp of the material.";
} elseif ($marks >= 70) {
    $grade = "B";
    $status_message = "Good work! A solid understanding with room to grow.";
} elseif ($marks >= 60) {
    $grade = "C";
    $status_message = "Fair performance. Consider reviewing some key concepts.";
} elseif ($marks >= 50) {
    $grade = "D";
    $status_message = "You passed, but you need significant practice.";
} elseif ($marks >= 0 && $marks < 50) {
    $grade = "F";
    $status_message = "Did not meet expectations. Please see your instructor for support.";
} else {
    $grade = "Invalid";
    $status_message = "Error: Invalid marks entered.";
}

// 3. Determine Passed/Failed status
if ($marks >= 50 && $marks <= 100) {
    $result_status = "Passed";
    $badge_class = "pass-badge";
} else {
    $result_status = "Failed";
    $badge_class = "fail-badge";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Student Result Card</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .result-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            border-top: 5px solid #4a90e2;
        }
        .card-header {
            text-align: center;
            margin-bottom: 25px;
        }
        .card-header h2 {
            margin: 0;
            color: #333333;
            font-size: 24px;
        }
        .info-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 15px;
            border-bottom: 1px dashed #e1e8ed;
            padding-bottom: 8px;
        }
        .info-label {
            color: #7f8c8d;
            font-weight: 500;
        }
        .info-value {
            color: #2c3e50;
            font-weight: 600;
        }
        .status-box {
            margin-top: 25px;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
        }
        .pass-badge {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .fail-badge {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .message-box {
            margin-top: 20px;
            background-color: #f8f9fa;
            padding: 12px;
            border-left: 4px solid #7f8c8d;
            border-radius: 4px;
            font-size: 14px;
            color: #555555;
            line-height: 1.4;
        }
    </style>
</head>
<body>

    <div class="result-card">
        <div class="card-header">
            <h2>Student Result Card</h2>
        </div>
        
        <div class="info-group">
            <span class="info-label">Student Name:</span>
            <span class="info-value"><?php echo htmlspecialchars($student_name); ?></span>
        </div>
        
        <div class="info-group">
            <span class="info-label">Student ID:</span>
            <span class="info-value"><?php echo htmlspecialchars($student_id); ?></span>
        </div>
        
        <div class="info-group">
            <span class="info-label">Subject:</span>
            <span class="info-value"><?php echo htmlspecialchars($subject); ?></span>
        </div>
        
        <div class="info-group">
            <span class="info-label">Marks Obtained:</span>
            <span class="info-value"><?php echo $marks; ?> / 100</span>
        </div>
        
        <div class="info-group">
            <span class="info-label">Grade:</span>
            <span class="info-value"><?php echo $grade; ?></span>
        </div>

        <!-- Dynamic Status Badge based on pass/fail status -->
        <div class="status-box <?php echo $badge_class; ?>">
            Result: <?php echo $result_status; ?>
        </div>

        <!-- Dynamic Feedback Message -->
        <div class="message-box">
            <strong>Teacher's Remarks:</strong><br>
            <?php echo htmlspecialchars($status_message); ?>
        </div>
    </div>

</body>
</html>
