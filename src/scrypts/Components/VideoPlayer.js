class VideoPlayer {
    constructor() {
        //this.videoElement = $(elementId);
        if (this.videoElement.lenght !== 0) {
            this.playerEnable = true;
        } else {
            this.playerEnable = false;
        }
    }
    play() {
        if (this.playerEnable) {
           // let player = videojs('#my-player');
          //  player.play();
        }
    }
}

export default VideoPlayer;