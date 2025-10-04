<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подтверждение Email</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f7; margin: 0; padding: 0; }
        .container { max-width: 500px; background: white; margin: 40px auto; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #333; }
        .code { font-size: 36px; font-weight: bold; text-align: center; color: #4CAF50; letter-spacing: 8px; margin: 30px 0; }
        p { text-align: center; font-size: 16px; color: #555; }
        .footer { text-align: center; font-size: 12px; color: #999; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Подтвердите ваш Email</h1>
        <p>Введите следующий код в приложении:</p>
        <div class="code">{{  $code  }}</div>
        <p>Код действителен в течение 5 минут.</p>
        <div class="footer">
            Если вы не регистрировались на нашем сайте, просто проигнорируйте это письмо.
        </div>
    </div>
</body>
</html>
