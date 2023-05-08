import './app'
window.Echo.channel('my-channel')
.listen('.my-event', (e) => {
    document.getElementById('ul2').innerHTML += `
    <div class="row">
		<div class="col-md-12">
        <ul class="comments" id="ul1">
    <li class="clearfix">
    <img src="../storage/profile-pictures/${e.profile}" class="avatar">
    <div class="post-comments">
    <p class="meta "><a href="{{route('profile',$comment->user)}}" class="text-primary text-decoration-none fw-bold">${e.name}</a></p>  
        <p>
            ${e.comment}
        </p>
    </div>
  </li>
  </ul>
  </div>
  </div>
  `
});