const textarea = document.querySelector('textarea');

textarea.addEventListener('input', function() {
  this.style.height = 'auto';
  this.style.height = this.scrollHeight + 'px';
});


let channel = document.querySelectorAll('.channel');
let lastClickedElement = null;
let lastClickedColor = null;

let lastChannel = ''

channel.forEach(e => {
    e.addEventListener('click',function(){
        if(lastClickedElement) {
            lastClickedElement.style.backgroundColor = lastClickedColor;
        }
        lastClickedElement = this;
        lastClickedColor = this.style.backgroundColor;
        this.style.backgroundColor = '#93C5FD';

        let channelId = this.getAttribute('data-channel');
        lastChannel = channelId
        let xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.querySelector('.chat').innerHTML = xhr.responseText;
            }
        }
        
        xhr.open('POST', 'handlers/channel_output.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('channel_id=' + channelId);
    })
});

// отправка сообщения 

const form = document.querySelector('#message-form');
const messageInput = document.querySelector('#message-input');
const save = document.querySelector('#save');
  
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    if (lastChannel) {
        const formData = new FormData();
        formData.append('message', messageInput.value);
        formData.append('channel', lastChannel);
        if (save.checked) {
            formData.append('save',1);
        }
        else {
            formData.append('save',0);
        }
      
        const xhr = new XMLHttpRequest();
      
        xhr.open('POST', 'handlers/send_message.php', true);
      
        xhr.onload = () => {
          if (xhr.status === 200) {
            console.log(xhr.responseText);
          }
        };
      
        xhr.send(formData);
    }
    else {
        alert('выберете канал')
    }
  });
