# Admin Panel Modernization Guide

This guide provides step-by-step instructions for applying the new admin-style.css to all admin pages.

## Pages Already Updated:
1. admin_dashboard.php
2. manage_users.php
3. manage_timetables.php
4. manage_courses.php
5. edit_timetable.php
6. edit_room.php

## Pages Still Needing Updates:
1. modify_admins.php
2. modify_user.php  
3. manage_rooms.php
4. edit_course.php
5. edit_subject.php
6. view_timetable.php
7. manage_subjects.php
8. modify_students.php

## Modernization Steps for Each Page

For each page, follow these steps to update it with the new admin-style.css:

### 1. Update the `<head>` section
Add the admin-style.css link and Font Awesome CDN:
```html
<link rel="stylesheet" href="admin-style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
```

### 2. Update the header section
Replace the standard header with the admin-header class:
```html
<header class="admin-header">
    <div class="logo-container">
        <img src="unilogo.png" alt="University Logo" class="logo-img" width="120" height="120">
    </div>
    <h1>University Of Sicily</h1>
    <h3>Admin Portal</h3>
    <h4>Page Title</h4>
</header>
```

### 3. Add message handling for forms
For any form processing, add success/error message handling:
```php
if ($conn->query($sql) === TRUE) {
    $message = "Operation completed successfully.";
    $message_type = "success";
} else {
    $message = "Error: " . $sql . "<br>" . $conn->error;
    $message_type = "error";
}
```

And then display the message:
```php
<?php if(isset($message)): ?>
    <div class="message <?php echo $message_type; ?>">
        <i><?php echo $message_type == 'success' ? '✓' : '⚠'; ?></i> <?php echo $message; ?>
    </div>
<?php endif; ?>
```

### 4. Update section headers
Add section-title class to main section headings:
```html
<h2 class="section-title">Section Title</h2>
```

### 5. Wrap content in cards
Wrap form and table content in card elements:
```html
<div class="card">
    <div class="card-header">
        <h3>Card Title</h3>
    </div>
    <!-- Form or table content here -->
</div>
```

### 6. Update forms
Apply the admin-form class to forms and structure form elements:
```html
<form method="post" class="admin-form">
    <div class="form-group">
        <label for="field_id" class="form-label">Field Label:</label>
        <input type="text" id="field_id" name="field_name" class="form-control" required>
    </div>
    
    <!-- More form fields -->
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
```

### 7. Update tables
Add proper table structure with admin-table class:
```html
<table class="admin-table">
    <thead>
        <tr>
            <th>Column 1</th>
            <th>Column 2</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Data 1</td>
            <td>Data 2</td>
            <td class="actions">
                <a href="edit_page.php?id=123" class="btn-action edit">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="delete_page.php?id=123" class="btn-action delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    </tbody>
</table>
```

### 8. Update buttons
Replace old button styles with the new button classes:
```html
<!-- Submit buttons -->
<button type="submit" class="btn btn-primary">Submit</button>

<!-- Button groups -->
<div class="btn-group">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="other_page.php" class="btn btn-warning">Cancel</a>
</div>

<!-- Action buttons in tables -->
<a href="edit.php?id=123" class="btn-action edit">
    <i class="fa fa-edit"></i>
</a>
```

### 9. Update the footer
Add the admin-footer class to the footer:
```html
<footer class="admin-footer">
    <p>&copy; 2025 University Class Timetable. All rights reserved.</p>
</footer>
```

## Testing
After updating each page:
1. Test all functionality to ensure it still works correctly
2. Check the responsive design on different screen sizes
3. Verify form submissions and database operations
4. Ensure navigation between pages works properly

By following these steps, all admin pages will have a consistent, modern UI while maintaining their functionality. 