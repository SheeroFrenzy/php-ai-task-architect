<?php include 'ai_engine.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mykola Kopchenov | AI Task Architect</title>
    <style>
        body { 
            background-color: #0d1117; 
            color: #c9d1d9; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .container { 
            width: 90%; 
            max-width: 800px; 
            background: #161b22; 
            padding: 40px; 
            border-radius: 12px; 
            border: 1px solid #30363d; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        h1 { color: #58a6ff; text-align: center; margin-bottom: 10px; font-size: 2.5rem; }
        .sub-header { text-align: center; color: #8b949e; margin-bottom: 30px; }
        textarea { 
            width: 100%; 
            background: #0d1117; 
            color: #fff; 
            border: 1px solid #30363d; 
            border-radius: 8px; 
            padding: 15px; 
            box-sizing: border-box; 
            font-size: 16px; 
            resize: vertical;
        }
        .btn { 
            background-color: #238636; 
            color: white; 
            padding: 15px; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-size: 18px; 
            width: 100%; 
            margin-top: 20px; 
            font-weight: bold;
            transition: 0.3s;
        }
        .btn:hover { background-color: #2ea043; transform: translateY(-2px); }
        .output { 
            margin-top: 30px; 
            padding: 20px; 
            background: #0d1117; 
            border-left: 5px solid #238636; 
            border-radius: 4px;
            white-space: pre-wrap; 
            line-height: 1.6;
            font-family: 'Courier New', Courier, monospace;
        }
        .lang-switch { text-align: right; margin-bottom: 15px; }
        select { background: #21262d; color: #fff; border: 1px solid #30363d; padding: 5px 10px; border-radius: 5px; }
        footer { margin-top: 30px; color: #8b949e; font-size: 14px; }
        .highlight { color: #58a6ff; }
    </style>
</head>
<body>

<div class="container">
    <h1>AI Task Architect <span style="font-size: 0.5em; vertical-align: middle;">v1.1</span></h1>
    <p class="sub-header">Transform chaos into code | Zmień chaos w kod</p>

    <form method="POST">
        <div class="lang-switch">
            <select name="lang">
                <option value="en" <?php echo (isset($_POST['lang']) && $_POST['lang'] == 'en') ? 'selected' : ''; ?>>English</option>
                <option value="pl" <?php echo (isset($_POST['lang']) && $_POST['lang'] == 'pl') ? 'selected' : ''; ?>>Polski</option>
            </select>
        </div>
        <textarea name="task" rows="6" placeholder="Describe your task... / Opisz swoje zadanie..."><?php echo $_POST['task'] ?? ''; ?></textarea>
        <button type="submit" class="btn">ANALYZE / ANALIZUJ</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
        $result = processTaskWithAI($_POST['task'], $_POST['lang']);
        echo "<div class='output'><strong class='highlight'>Result / Wynik:</strong>\n\n" . htmlspecialchars($result) . "</div>";
    }
    ?>
</div>

<footer>
    Developed by <strong>Mykola Kopchenov</strong>
</footer>

</body>
</html>