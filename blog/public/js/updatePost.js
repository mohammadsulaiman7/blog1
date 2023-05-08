import './app'
window.Echo.channel('my-channel')
.listen('.my-event5', (e) => {
    document.getElementById('').innerHTML =
    document.getElementById('card-update').innerHTML =
    `
    <div class="card-body" id="card-update">
    <img src="../storage/posts-media/${e.media}" class="w-100 rounded">
    <p class="card-text">${e.content}</p>
    <a href="#" class="btn btn-outline-success"><i class="fa-solid fa-heart"></i></a>
    <a href="#" class="btn btn-outline-secondary"><i
            class="fa-solid fa-comment"></i></a>
`
});