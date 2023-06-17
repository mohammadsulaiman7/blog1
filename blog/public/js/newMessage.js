import './app';
window.Echo.channel('my-channel')
    .listen('.my-event11', (e) => {
        document.getElementById('at-time-message').innerHTML +=`
        <div class="chat-message-left pb-4" id="at-time-message">
        <div>
        <img src="../storage/profile-pictures/${e.profile}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
        <div class="text-muted small text-nowrap mt-2">2:34 am</div>
    </div>
    <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
        <div class="font-weight-bold mb-1 text-primary">${e.sender}</div>
        <span class="fw-bolder">${e.message}</span>
    </div>
    </div>
    `});