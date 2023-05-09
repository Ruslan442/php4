<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/output.css" rel="stylesheet">
    <title>RK2</title>
</head>
<body>
    <section class="w-screen h-screen py-10">
        <form method="POST" action="login.php" class="flex flex-col w-[600px] mx-auto" id="login-form">
            <legend>
                <h1 class="text-xl font-medium text-center">Авторизация</h1>
            </legend>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="border border-black-600 px-1" placeholder="mail@mail.ru" required>
    
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="border border-black-600 px-1" required>
    
            <button type="submit" class="my-5 bg-orange-500 w-[150px]" id='login-btn'>Войти</button>
            <p id="output" class="text-red-600"></p>
        </form>

    </section>
    <script>
        const form = document.getElementById('login-form');
        const output = document.getElementById('output');
        const loginBtn = document.getElementById('login-btn');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); 

            const formData = new FormData(form); 
            loginBtn.disabled = true; 

            fetch('login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Invalid')){
                    output.textContent = data; 
                    loginBtn.disabled = false; 
                }
                else {
                    window.location.href = 'index.php';
                }
            })
        });
    </script>
</body>
</html>