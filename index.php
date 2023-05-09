<?php
    session_start();
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/output.css" rel="stylesheet">
    <title>php4</title>
</head>
<body>
    <header>
        <h1 class="text-center text-xl font-bold">Главное меню</h1>
        <p>Добро пожаловать, <?php echo $_SESSION['user_name']; ?>!</p>
        <form action="logout.php" method="POST">
            <button type="submit" class="font-semibold">Выйти</button>
        </form>
    </header> 
    <main>
        <section class="my-6 flex flex-row w-[800px] mx-auto">
            <ul class="w-[300px] min-h-[500px] bg-sky-100">
                <li class="border-2 border-sky-500 hover:bg-indigo-300 mb-1">
                    <button data-channel="0" class="channel w-full flex items-center min-h-[50px]">
                        <img class="w-[30px] mr-1" src="img/vk.png" alt="">
                        <p>Очень вкусно</p>
                    </button>
                </li>
                <li class="border-2 border-sky-500 flex hover:bg-indigo-300 items-center mb-1">
                    <button data-channel="1" class="channel w-full flex items-center min-h-[50px]">
                        <img class="w-[30px] mr-1" src="img/kr.png" alt="">
                        <p>Развитие крипторынка</p>
                    </button>
                </li>
                <li class="border-2 border-sky-500 flex hover:bg-indigo-300 items-center mb-1">
                    <button data-channel="2" class="channel w-full flex items-center min-h-[50px]">
                        <img class="w-[30px] mr-1" src="img/pr.png" alt="">
                        <p>Программисты в деле</p>
                    </button>
                </li>
            </ul>
            <div class="w-[500px] bg-sky-100 mx-5 relative">
                <div class="chat pb-20">
                    <p class="text-center mt-10 text-slate-500 text-xl">выберите чат...</p>
                </div>
                
                <form action="POST" id="message-form" class="w-11/12 mx-auto">
                    <textarea name="message" maxlength='280' id="message-input" class="absolute bottom-0 left-0 right-0 mb-10 w-11/12 mx-auto rounded-md bg-white border-0 focus:outline-none focus:ring-0 py-2 pl-3 pr-8 sm:text-sm resize-none" style="height: auto; min-height: 35px" rows="1" placeholder="Напишите сообщение..." required></textarea>
                    <button type="submit" class="hover:bg-green-300 w-[25px] h-[25px] absolute right-7 rounded-md" style="bottom:46px">
                        <img src="img/send.svg" alt="" class="w-[20px] mx-auto">
                    </button>
                    <label for="save" class="absolute bottom-0 mb-3"><input id="save" type="checkbox"><span>Сообщение видно только мне</span></label>
                </form>
            </div>
        </section>
    </main>
    <script src="js/main.js"></script>
</body>
</html>