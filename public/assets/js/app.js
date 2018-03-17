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
        searchExposed: false,
        searchMode: 'video'
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
        setVideo: function(youtubeId) {
            // This is a reaaallly shitty way of doing this :(
            var html = '<iframe class="saai" width="0" height="0" src="https://www.youtube.com/embed/' + youtubeId + '?autoplay=1" frameborder="0"></iframe>';

            $('#asmrVideo').html(html);
        }
    }
});

// $(function() {
//     app.mounted();
// });