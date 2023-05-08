import './app';
window.Echo.channel('my-channel')
    .listen('.my-event2', (e) => {
    document.getElementById(`card${e.id}`).innerHTML = "";
    });
