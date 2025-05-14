<?php
// List of admin pages to update
$admin_pages = [
    'edit_timetable.php',
    'modify_admins.php',
    'modify_user.php',
    'edit_course.php',
    'edit_room.php',
    'edit_subject.php',
    'view_timetable.php',
    'manage_rooms.php',
    'manage_subjects.php',
    'modify_students.php'
];

foreach ($admin_pages as $page) {
    if (file_exists($page)) {
        $content = file_get_contents($page);
        
        // 1. Add admin-style.css and Font Awesome if needed
        if (strpos($content, 'admin-style.css') === false) {
            $content = preg_replace(
                '/<link rel="stylesheet" href="left-sidebar.css">/',
                '<link rel="stylesheet" href="left-sidebar.css">' . PHP_EOL . '    <link rel="stylesheet" href="admin-style.css">' . PHP_EOL . '    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">',
                $content
            );
        }
        
        // 2. Update header with admin-header class and logo container
        $content = preg_replace(
            '/<header>(\s*)<h1><img src="unilogo.png" alt="University Logo" width="161" height="149"><\/h1>/',
            '<header class="admin-header">' . PHP_EOL . '        <div class="logo-container">' . PHP_EOL . '            <img src="unilogo.png" alt="University Logo" class="logo-img" width="120" height="120">' . PHP_EOL . '        </div>',
            $content
        );
        
        // 3. Remove color style from h4 if exists
        $content = preg_replace(
            '/<h4 style="color: #EABEBF">/',
            '<h4>',
            $content
        );
        
        // 4. Update the footer
        $content = preg_replace(
            '/<footer>/',
            '<footer class="admin-footer">',
            $content
        );
        
        // 5. Update forms with admin-form class
        $content = preg_replace(
            '/class="room-form"/',
            'class="admin-form"',
            $content
        );
        
        // 6. Update tables with admin-table class
        $content = preg_replace(
            '/<table>/',
            '<table class="admin-table">',
            $content
        );
        
        // 7. Update buttons
        $content = preg_replace(
            '/<input type="submit" class="btn1" value="([^"]+)">/',
            '<button type="submit" class="btn btn-primary">$1</button>',
            $content
        );
        
        // 8. Add thead and tbody to tables if not exists
        $content = preg_replace(
            '/<table class="admin-table">(\s*)<tr>/',
            '<table class="admin-table">' . PHP_EOL . '                    <thead>' . PHP_EOL . '                        <tr>',
            $content
        );
        
        // Look for the end of header row and add tbody
        $content = preg_replace(
            '/(<\/tr>)(\s*)(?!<\/thead>)(?=<tr>)/',
            '$1' . PHP_EOL . '                    </thead>' . PHP_EOL . '                    <tbody>',
            $content
        );
        
        // Add closing tbody if not exists
        if (strpos($content, '</tbody>') === false) {
            $content = preg_replace(
                '/(<\/table>)/',
                '                    </tbody>' . PHP_EOL . '                $1',
                $content
            );
        }
        
        // 9. Update form controls
        $content = preg_replace(
            '/<input type="text" name="([^"]+)"([^>]*)>/',
            '<input type="text" name="$1" class="form-control"$2>',
            $content
        );
        
        $content = preg_replace(
            '/<select name="([^"]+)"([^>]*)>/',
            '<select name="$1" class="form-control"$2>',
            $content
        );
        
        // 10. Wrap form fields in form-group
        $content = preg_replace(
            '/(<label[^>]*>.*?<\/label>)(\s*)(<input|<select)/',
            '<div class="form-group">' . PHP_EOL . '                        $1' . PHP_EOL . '                        $3',
            $content
        );
        
        $content = preg_replace(
            '/(<input[^>]*>|<select[^>]*>.*?<\/select>)(\s*)(?!<\/div>)(<br|<input|<label|<\/form>)/',
            '$1' . PHP_EOL . '                    </div>' . PHP_EOL . '                    $3',
            $content
        );
        
        // 11. Replace simple labels with form-label class
        $content = preg_replace(
            '/<label([^>]*)>/',
            '<label$1 class="form-label">',
            $content
        );
        
        // 12. Update edit/delete links with icons
        $content = preg_replace(
            '/<a href="([^"]+)\.php\?id=([^"]+)">Edit<\/a>/',
            '<a href="$1.php?id=$2" class="btn-action edit"><i class="fa fa-edit"></i></a>',
            $content
        );
        
        $content = preg_replace(
            '/<a href="([^"]+)\.php\?delete=([^"]+)"([^>]*)>Delete<\/a>/',
            '<a href="$1.php?delete=$2"$3 class="btn-action delete"><i class="fa fa-trash"></i></a>',
            $content
        );
        
        // 13. Wrap action links in actions class
        $content = preg_replace(
            '/<td>(\s*)(<a href="[^"]+" class="btn-action)/',
            '<td class="actions">' . PHP_EOL . '                                $2',
            $content
        );
        
        // 14. Wrap section title in section-title class
        $content = preg_replace(
            '/<h2( align="center")?>([^<]+)<\/h2>/',
            '<h2 class="section-title">$2</h2>',
            $content
        );
        
        // 15. Add cards around content sections
        if (strpos($content, 'card-header') === false) {
            $content = preg_replace(
                '/(<h2 class="section-title">[^<]+<\/h2>)(\s*)(<form)/',
                '$1' . PHP_EOL . PHP_EOL . '                <div class="card">' . PHP_EOL . '                    <div class="card-header">' . PHP_EOL . '                        <h3>' . preg_replace('/<h2 class="section-title">([^<]+)<\/h2>/', '$1', '$1') . '</h3>' . PHP_EOL . '                    </div>' . PHP_EOL . '                    $3',
                $content
            );
            
            $content = preg_replace(
                '/(<\/form>)(\s*)(<h2|<\/section>|<table)/',
                '$1' . PHP_EOL . '                </div>' . PHP_EOL . PHP_EOL . '                $3',
                $content
            );
            
            $content = preg_replace(
                '/(<h2 class="section-title">[^<]+<\/h2>)(\s*)(<table)/',
                '$1' . PHP_EOL . PHP_EOL . '                <div class="card">' . PHP_EOL . '                    <div class="card-header">' . PHP_EOL . '                        <h3>' . preg_replace('/<h2 class="section-title">([^<]+)<\/h2>/', '$1', '$1') . '</h3>' . PHP_EOL . '                    </div>' . PHP_EOL . '                    $3',
                $content
            );
            
            $content = preg_replace(
                '/(<\/table>)(\s*)(<\/section>|<h2|<form)/',
                '$1' . PHP_EOL . '                </div>' . PHP_EOL . PHP_EOL . '                $3',
                $content
            );
        }
        
        // Save the updated content back to the file
        file_put_contents($page, $content);
        echo "Updated {$page} with admin styling.<br>";
    } else {
        echo "Warning: {$page} does not exist and was skipped.<br>";
    }
}

echo "<br>All admin pages have been updated with the new admin-style.css!";
?> 