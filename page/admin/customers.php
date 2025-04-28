<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: adminlogin.php');
    exit;
}
require_once '../includes/config.php';
require_once '../includes/db.php';

$message = '';
$message_type = '';

if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']);
    try {
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$deleteId]);
        $message = "Customer deleted successfully.";
        $message_type = "success";
    } catch (PDOException $e) {
        $message = "Error deleting customer: " . $e->getMessage();
        $message_type = "error";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = intval($_POST['edit_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);

    try {
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE (email = ? OR username = ?) AND id != ?");
        $stmt->execute([$email, $username, $editId]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            $message = "Email or username already exists for another user.";
            $message_type = "error";
        } else {
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ?, username = ? WHERE id = ?");
            $stmt->execute([$name, $email, $username, $editId]);
            $message = "Customer updated successfully.";
            $message_type = "success";
        }
    } catch (PDOException $e) {
        $message = "Error updating customer: " . $e->getMessage();
        $message_type = "error";
    }
}

try {
    $stmt = $db->query("SELECT * FROM users");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $customers = [];
    $message = "Error fetching customers: " . $e->getMessage();
    $message_type = "error";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manage Customers | Yamaha Rox Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 20px 40px;
        }
        h1 {
            color: #003366;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .message.success {
            color: #5cb85c;
        }
        .message.error {
            color: #d52b1e;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #003366;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        .btn-edit {
            background-color: #007bff;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
        .btn-delete {
            background-color: #d52b1e;
        }
        .btn-delete:hover {
            background-color: #a82014;
        }
        .edit-form {
            display: none;
            margin-top: 10px;
            background-color: #eef3f7;
            padding: 15px;
            border-radius: 8px;
        }
        .edit-form input[type="text"],
        .edit-form input[type="email"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .edit-form button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
        }
        .edit-form button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function toggleEditForm(id) {
            const form = document.getElementById('edit-form-' + id);
            if (form.style.display === 'block') {
                form.style.display = 'none';
            } else {
                form.style.display = 'block';
            }
        }

        // Countdown and hide message after 3 seconds
        window.onload = function() {
            const messageDiv = document.querySelector('.message');
            if (messageDiv) {
                let countdown = 3;
                const originalText = messageDiv.textContent;
                const interval = setInterval(() => {
                    countdown--;
                    if (countdown > 0) {
                        messageDiv.textContent = originalText + ' Disappearing in ' + countdown + '...';
                    } else {
                        messageDiv.style.display = 'none';
                        clearInterval(interval);
                    }
                }, 1000);
            }
        };
    </script>
</head>
<body>
    <h1>Manage Customers</h1>
    <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?php echo htmlspecialchars($customer['id']); ?></td>
                <td><?php echo htmlspecialchars($customer['name']); ?></td>
                <td><?php echo htmlspecialchars($customer['email']); ?></td>
                <td><?php echo htmlspecialchars($customer['username']); ?></td>
                <td class="actions">
                    <button class="btn btn-edit" onclick="toggleEditForm(<?php echo $customer['id']; ?>)">Edit</button>
                    <a class="btn btn-delete" href="?delete_id=<?php echo $customer['id']; ?>" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
                </td>
            </tr>
            <tr id="edit-form-<?php echo $customer['id']; ?>" class="edit-form">
                <td colspan="5">
                    <form method="POST" action="customers.php">
                        <input type="hidden" name="edit_id" value="<?php echo $customer['id']; ?>" />
                        <input type="text" name="name" value="<?php echo htmlspecialchars($customer['name']); ?>" required />
                        <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required />
                        <input type="text" name="username" value="<?php echo htmlspecialchars($customer['username']); ?>" required />
                        <button type="submit">Save</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
