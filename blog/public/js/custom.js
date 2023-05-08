import './app'
window.Echo.channel('my-channel')
    .listen('.my-event1', (e) => {
        document.getElementById('card').innerHTML +=
            `
            <div class="projcard-container">
    <div class="projcard projcard-customcolor" style="--projcard-color: #F5AF41;">
      <div class="projcard-innerbox">
        <img class="projcard-img" src="storage/posts-media/${e.media}" />
        <div class="projcard-textbox">
          <div class="projcard-title">${e.title}</div>
          <div class="projcard-subtitle"><a href="" class="btn btn-outline-success"><i class="fa-solid fa-heart"></i></a>
            <a href="" class="btn btn-outline-secondary"><i
                    class="fa-solid fa-comment"></i></a>
            </div>
          <div class="projcard-bar"></div>
          <div class="projcard-description">${e.content}</div>
          <div class="projcard-tagbox">
            <span class="projcard-tag"><a href="" class=" text-black">${e.name}</a></span>
            <div id="comment-count">
                Comments : <br>
                Like :
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
        `
    });