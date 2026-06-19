<?php
if (!isset($base_path))  $base_path  = '';
if (!isset($page_title)) $page_title = 'Moonly Hosting';
if (!isset($extra_css))  $extra_css  = '';
if (!isset($body_class)) $body_class = '';

require_once dirname(__FILE__) . '/config.php';
?>
<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#080b12">
    <title><?php echo htmlspecialchars($page_title); ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?php echo $base_path; ?>css/theme.css?v=<?php echo ASSET_VERSION; ?>">
    <link rel="stylesheet" href="<?php echo $base_path; ?>css/global.css?v=<?php echo ASSET_VERSION; ?>">
    <?php if ($extra_css): ?>
        <link rel="stylesheet" href="<?php echo $base_path; ?><?php echo $extra_css; ?>?v=<?php echo ASSET_VERSION; ?>">
    <?php endif; ?>

    <script>
        (function () {
            try {
                var t = localStorage.getItem('moonly_theme') || 'dark';
                document.documentElement.setAttribute('data-theme', t);
            } catch (e) {}
        })();
    </script>
</head>
<body class="<?php echo htmlspecialchars($body_class); ?>">