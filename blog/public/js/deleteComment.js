import './app';
window.Echo.channel('my-channel')
    .listen('.my-event4', (e) => {
    document.getElementById(`comment${e.id}`).innerHTML = "";
    });