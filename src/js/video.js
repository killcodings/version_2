export default class Video {
    constructor() {
        this.youtubeVideo();
        this.localVideo();
    }


    youtubeVideo() {
        const videos = document.querySelectorAll('.video_youtube');
        videos.forEach((video) => {
            video.addEventListener('click', (e) => {
                const video = e.currentTarget;
                const videoPreview = video.querySelector('.image-func');
                const videoButton = video.querySelector('.video__button');
                const videoContainer = video.querySelector('.video__container');
                videoContainer.classList.toggle('active');
                const videoUrl = video.dataset.url;
                let iframe = document.createElement('iframe');
                iframe.setAttribute('allowfullscreen', '');
                iframe.setAttribute('autoplay', '');
                iframe.setAttribute('src', videoUrl + '?rel=0&showinfo=0&autoplay=1');
                iframe.classList.add('video__media');

                videoPreview.remove();
                videoButton.remove();
                videoContainer.appendChild(iframe);
            })
        })
    }

    localVideo() {
        const videos = document.querySelectorAll('.video_local');
        if (videos) {
            videos.forEach((video) => {
                const videoButton = video.querySelector('.video__button');
                videoButton.addEventListener('click', (e) => {
                    const videoContainer = video.querySelector('.video__container');
                    const videoPreview = video.querySelector('.video__preview');
                    const videoUrl = video.dataset.url;
                    const videoTag = document.createElement('video');
                    const videoSource = document.createElement('source');
                    videoSource.setAttribute('src', videoUrl);
                    videoTag.setAttribute('preload', 'none');
                    videoTag.autoplay = true;
                    videoTag.controls = true;
                    videoTag.appendChild(videoSource);
                    videoContainer.appendChild(videoTag);
                    videoPreview.remove();
                    videoButton.remove();
                });
            });
        }
    }
}
