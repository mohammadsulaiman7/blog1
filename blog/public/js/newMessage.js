import './app';
window.Echo.channel('my-channel')
    .listen('.my-event11', (e) => {
        document.getElementById('message-content').innerHTML +=`
        <div class="position-relative">
    	<div class="chat-message-left pb-4">
                        <div>
                            <img src="../storage/profile-pictures/${e.profile}"
                                                class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                            <div class="text-muted small text-nowrap mt-2"></div>
                        </div>
                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                            <div class="font-weight-bold mb-1">${e.sender}</div>
                            ${e.message}
                        </div>
                    </div>
                    </div>`});