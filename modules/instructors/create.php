<?php
// modules/instructors/create.php
header('Content-Type: application/json');

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../middleware/auth.php';

try {
    requireRole('Dean');
} catch (Throwable $e) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON payload']);
    exit;
}

// Required fields
$first = trim($data['first_name'] ?? '');
$last = trim($data['last_name'] ?? '');
$email = trim($data['email'] ?? '');
$subjectName = trim($data['subject'] ?? '');
$subjectCode = trim($data['subject_code'] ?? '');
$yearLevel = trim($data['year_level'] ?? '');
$section = trim($data['section'] ?? '');
$days = trim($data['schedule_day'] ?? '');
$time = trim($data['schedule_time'] ?? '');

$errors = [];
if ($first === '') $errors[] = 'First name is required';
if ($last === '') $errors[] = 'Last name is required';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';

if ($errors) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Validation failed', 'errors' => $errors]);
    exit;
}

try {
    $pdo->beginTransaction();

    // Ensure unique email
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM instructor WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $pdo->rollBack();
        http_response_code(409);
        echo json_encode(['success' => false, 'message' => 'Email already exists']);
        exit;
    }

    // Build section string (e.g., 1-A) - separate from subject_code
    $section_handled = '';
    if ($yearLevel !== '' && $section !== '') {
        $section_handled = $yearLevel . '-' . strtoupper($section);
    }

    // Temporary password generation (since schema requires NOT NULL)
    $tempPassword = bin2hex(random_bytes(5)); // 10 hex chars
    $passwordHash = password_hash($tempPassword, PASSWORD_DEFAULT);

    // Determine admin_id from session (fallback to 1)
    $adminId = $_SESSION['user_id'] ?? 1;

    // Insert instructor
    $stmt = $pdo->prepare('INSERT INTO instructor (admin_id, first_name, last_name, email, password, assigned_subject, subject_code, section_handled, program, schedule_day, schedule_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([
        $adminId,
        $first,
        $last,
        $email,
        $passwordHash,
        $subjectName !== '' ? $subjectName : null,
        $subjectCode !== '' ? $subjectCode : null,
        $section_handled !== '' ? $section_handled : null,
        $data['program'] ?? 'BS-InfoTech',
        $days !== '' ? $days : null,
        $time !== '' ? $time : null,
    ]);

    $instructorId = (int)$pdo->lastInsertId();

    // Optionally insert subject if code provided
    if ($subjectCode !== '') {
        try {
            $stmt = $pdo->prepare('INSERT INTO subject (subject_code, subject_name, instructor_id, section, schedule_day, schedule_time) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([
                $subjectCode,
                $subjectName !== '' ? $subjectName : $subjectCode,
                $instructorId,
                $section_handled !== '' ? $section_handled : null,
                $days !== '' ? $days : null,
                $time !== '' ? $time : null,
            ]);
        } catch (PDOException $e) {
            // If duplicate subject_code, update existing record to point to this instructor
            if ($e->errorInfo[1] == 1062) { // Duplicate entry
                $upd = $pdo->prepare('UPDATE subject SET instructor_id = ?, subject_name = ?, section = ?, schedule_day = ?, schedule_time = ? WHERE subject_code = ?');
                $upd->execute([
                    $instructorId,
                    $subjectName !== '' ? $subjectName : $subjectCode,
                    $section_handled !== '' ? $section_handled : null,
                    $days !== '' ? $days : null,
                    $time !== '' ? $time : null,
                    $subjectCode,
                ]);
            } else {
                throw $e;
            }
        }
    }

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Instructor created successfully',
        'instructor_id' => $instructorId,
        // Return temp password so admin can communicate it securely to instructor
        'temp_password' => $tempPassword
    ]);
} catch (Throwable $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error', 'error' => $e->getMessage()]);
}
                                              