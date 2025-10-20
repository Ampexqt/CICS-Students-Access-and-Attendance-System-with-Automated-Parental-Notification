<?php
session_start();
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../middleware/auth.php';

// Check authentication
try {
    requireRole('Dean');
} catch (Exception $e) {
    header('Location: ../../index.php');
    exit;
}

$message = '';
$messageType = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                try {
                    $stmt = $pdo->prepare("
                        INSERT INTO instructor (admin_id, first_name, last_name, email, password, assigned_subject, subject_code, section_handled, program) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ");
                    
                    $tempPassword = bin2hex(random_bytes(4)); // Generate 8-character temp password
                    $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);
                    
                    $stmt->execute([
                        $_SESSION['user_id'],
                        $_POST['first_name'],
                        $_POST['last_name'],
                        $_POST['email'],
                        $hashedPassword,
                        $_POST['assigned_subject'] ?? null,
                        $_POST['subject_code'] ?? null,
                        $_POST['section_handled'] ?? null,
                        $_POST['program'] ?? 'BS-InfoTech'
                    ]);
                    
                    $message = "Instructor added successfully! Password has been generated and should be sent to the instructor's email.";
                    $messageType = 'success';
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) { // Duplicate entry
                        $message = "Error: Email already exists!";
                    } else {
                        $message = "Error adding instructor: " . $e->getMessage();
                    }
                    $messageType = 'error';
                }
                break;
                
            case 'delete':
                try {
                    $stmt = $pdo->prepare("DELETE FROM instructor WHERE instructor_id = ?");
                    $stmt->execute([$_POST['instructor_id']]);
                    $message = "Instructor deleted successfully!";
                    $messageType = 'success';
                } catch (PDOException $e) {
                    $message = "Error deleting instructor: " . $e->getMessage();
                    $messageType = 'error';
                }
                break;
                
            case 'update':
                try {
                    $stmt = $pdo->prepare("
                        UPDATE instructor 
                        SET first_name = ?, last_name = ?, email = ?, assigned_subject = ?, subject_code = ?, section_handled = ?, program = ?
                        WHERE instructor_id = ?
                    ");
                    $stmt->execute([
                        $_POST['first_name'],
                        $_POST['last_name'],
                        $_POST['email'],
                        $_POST['assigned_subject'] ?? null,
                        $_POST['subject_code'] ?? null,
                        $_POST['section_handled'] ?? null,
                        $_POST['program'] ?? 'BS-InfoTech',
                        $_POST['instructor_id']
                    ]);
                    $message = "Instructor updated successfully!";
                    $messageType = 'success';
                } catch (PDOException $e) {
                    $message = "Error updating instructor: " . $e->getMessage();
                    $messageType = 'error';
                }
                break;
        }
    }
}

// Get all instructors
try {
    $stmt = $pdo->prepare("
        SELECT 
            instructor_id,
            first_name,
            last_name,
            email,
            assigned_subject,
            section_handled,
            program,
            schedule_day,
            schedule_time
        FROM instructor
        ORDER BY instructor_id DESC
    ");
    $stmt->execute();
    $instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Error loading instructors: " . $e->getMessage();
    $messageType = 'error';
    $instructors = [];
}

// Get instructor for editing if edit_id is provided
$editInstructor = null;
if (isset($_GET['edit_id'])) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM instructor WHERE instructor_id = ?");
        $stmt->execute([$_GET['edit_id']]);
        $editInstructor = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $message = "Error loading instructor for editing: " . $e->getMessage();
        $messageType = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Instructors - CICS Attendance</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .message {
            padding: 12px 16px;
            margin: 16px 0;
            border-radius: 8px;
            font-weight: 500;
        }
        .message.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }
        .message.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }
        .form-container {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 6px;
            color: #374151;
        }
        .form-input {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background: #f9fafb;
            font-weight: 600;
            color: #374151;
        }
        .actions {
            display: flex;
            gap: 8px;
        }
        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }
        .search-box {
            margin-bottom: 16px;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            width: 300px;
        }
    </style>
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h2>CICS Attendance</h2>
            </div>
            
            <nav class="nav">
                <a href="dashboard.php" class="nav-link">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                    </svg>
                    Dashboard
                </a>
                <a href="instructors.php" class="nav-link active">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Manage Instructors
                </a>
                <a href="students.php" class="nav-link">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Manage Students
                </a>
            </nav>
            
            <div class="sidebar-footer">
                <a href="../../modules/auth/logout.php" class="nav-link logout">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="header">
                <h1>Manage Instructors</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                </div>
            </header>

            <div class="content">
                <?php if ($message): ?>
                    <div class="message <?php echo $messageType; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <!-- Add/Edit Form -->
                <div class="form-container">
                    <h3><?php echo $editInstructor ? 'Edit Instructor' : 'Add New Instructor'; ?></h3>
                    <form method="POST">
                        <input type="hidden" name="action" value="<?php echo $editInstructor ? 'update' : 'add'; ?>">
                        <?php if ($editInstructor): ?>
                            <input type="hidden" name="instructor_id" value="<?php echo $editInstructor['instructor_id']; ?>">
                        <?php endif; ?>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" class="form-input" 
                                       value="<?php echo $editInstructor ? htmlspecialchars($editInstructor['first_name']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" class="form-input" 
                                       value="<?php echo $editInstructor ? htmlspecialchars($editInstructor['last_name']) : ''; ?>" required>
                            </div>
                            <div class="form-group full-width">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-input" 
                                       value="<?php echo $editInstructor ? htmlspecialchars($editInstructor['email']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Subject</label>
                                <input type="text" name="assigned_subject" class="form-input" 
                                       value="<?php echo $editInstructor ? htmlspecialchars($editInstructor['assigned_subject']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Section</label>
                                <input type="text" name="section_handled" class="form-input" 
                                       value="<?php echo $editInstructor ? htmlspecialchars($editInstructor['section_handled']) : ''; ?>">
                            </div>
                        </div>
                        
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">
                                <?php echo $editInstructor ? 'Update Instructor' : 'Add Instructor'; ?>
                            </button>
                            <?php if ($editInstructor): ?>
                                <a href="instructors.php" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

                <!-- Instructors List -->
                <div class="table-container">
                    <div style="padding: 16px; border-bottom: 1px solid #e5e7eb;">
                        <input type="text" id="searchBox" class="search-box" placeholder="Search instructors..." 
                               onkeyup="filterTable()">
                    </div>
                    
                    <table id="instructorsTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Section</th>
                                <th>ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($instructors)): ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px; color: #6b7280;">
                                        No instructors found. Add your first instructor above.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($instructors as $instructor): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($instructor['first_name'] . ' ' . $instructor['last_name']); ?></td>
                                        <td><?php echo htmlspecialchars($instructor['email']); ?></td>
                                        <td><?php echo htmlspecialchars($instructor['assigned_subject'] ?: '-'); ?></td>
                                        <td><?php echo htmlspecialchars($instructor['section_handled'] ?: '-'); ?></td>
                                        <td><?php echo 'ID: ' . $instructor['instructor_id']; ?></td>
                                        <td class="actions">
                                            <a href="?edit_id=<?php echo $instructor['instructor_id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <form method="POST" style="display: inline;" 
                                                  onsubmit="return confirm('Are you sure you want to delete this instructor?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="instructor_id" value="<?php echo $instructor['instructor_id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function filterTable() {
            const searchBox = document.getElementById('searchBox');
            const table = document.getElementById('instructorsTable');
            const rows = table.getElementsByTagName('tr');
            const filter = searchBox.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length - 1; j++) { // Exclude actions column
                    if (cells[j].textContent.toLowerCase().includes(filter)) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            }
        }

        // Auto-hide success messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('.message.success');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.opacity = '0';
                    setTimeout(function() {
                        successMessage.remove();
                    }, 300);
                }, 5000);
            }
        });
    </script>
</body>
</html>
