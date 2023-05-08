import './app'
window.Echo.channel('my-channel')
.listen('.my-event3', (e) => {
    document.getElementById('comment-count').innerHTML =
    `
    Comments : ${e.count}<br>
    Like :`
});