var app = new Vue({
    el: '.app',
    delimiters: ['${', '}'],
    data: {
        videos: [],
        backgrounds: [],
        videoSearch: {
            query: '',
            nsfw: true,
            finished: false
        },
        backgroundSearch: {
            query: '',
            nsfw: true,
            finished: false
        },
        currentVideo: {
            title: 'No video playing...',
            state: 'stopped',
            video: null
        },
        volume: 100,
        searchExposed: false,
        searchMode: 'video',
        youtubePlayer: null
    },
    mounted: function() {
        this.fetchVideos();
        this.fetchBackgrounds();
    },
    methods: {
        fetchVideos: function() {
            var self = this;

            self.videoSearch.finished = false;

            $.getJSON('/ajax-videos', {query: this.videoSearch.query, nsfw: !this.videoSearch.nsfw}, function(data) {
                self.videos = data;

                self.videoSearch.finished = true;
            });
        },
        fetchBackgrounds: function() {
            var self = this;

            self.backgroundSearch.finished = false;

            $.getJSON('/ajax-backgrounds', {query: this.backgroundSearch.query, nsfw: !this.backgroundSearch.nsfw}, function(data) {
                self.backgrounds = data;

                self.backgroundSearch.finished = true;
            });
        },
        setVideo: function(video) {
            // This is a reaaallly shitty way of doing this :(
            this.youtubePlayer.loadVideoById(video.youtubeId);

            this.currentVideo.title = video.title;
            this.currentVideo.video = video;
        },
        play: function() {
            this.youtubePlayer.playVideo();
            this.currentVideo.state = 'playing';
        },
        stop: function() {
            this.youtubePlayer.stopVideo();
            this.currentVideo.state = 'stopped';
        },
        pause: function() {
            this.youtubePlayer.pauseVideo();
            this.currentVideo.state = 'paused';
        },
        updateVolume: function() {
            this.youtubePlayer.setVolume(this.volume);
        },
        setVolume: function(val) {
            this.volume = val;
            this.updateVolume();
        }
    }
});

// $(function() {
//     app.mounted();
// });

function onYouTubePlayerAPIReady() {
    app.youtubePlayer = new YT.Player('asmrVideo', {
        height: '0',
        width: '0',
        events: {
            // call this function when player is ready to use
            'onReady': function() {
            },
            'onStateChange': function(event) {
                switch(event.data) {
                    case 0:
                        app.currentVideo.state = 'stopped';
                        break;
                    case 1:
                        app.setVolume(app.youtubePlayer.getVolume());
                        app.currentVideo.state = 'playing';
                        break;
                    case 2:
                        app.currentVideo.state = 'paused';
                }
            }
        }
    });
}