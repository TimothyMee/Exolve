<template>
    <div class="">
        <notifications position="top center" />

        <div class="row justify-content-center mt-4">
            <!--@if(session('success'))-->
            <div class="col-md-10" v-if="alert == 'success'">
                <div class="alert alert-success">
                    <p>Comment Added successfully</p>
                </div>
            </div>
            <!--@elseif(session('error'))-->
            <div class="col-md-10" v-if="alert == 'failure'">
                <div class="alert alert-danger">
                    <p>Couldn't Add Comment. Try again later</p>
                </div>
            </div>

            <br>
            <!--@endif-->
            <div class="col-md-5">
                <video width="320" height="240" controls @play="increaseViewCount(video.id)">
                    <source :src="video.video" type="video/mp4">
                </video>
                <div v-if="authUser !== null">
                    <p class="text-white" style="">Average Rating: {{averageRatings}}</p>
                    <star-rating :star-size="20" style="color:white;" v-model="videoRating" @rating-selected="rateVideo()"></star-rating>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="font-text-bold text-primary">
                    {{video.title}}
                </h2>
                <P class="text-white">
                   {{video.description}}
                </P>

                <br><br>
                <h6 class="text-white">Category: {{video.category.name}}</h6>
                <h6 class="text-white" style="float:left">@{{video.user.name}}</h6>
                <h6 class="text-white" style="">&nbsp;|&nbsp; {{video.views}} Views </h6>

                <ul class="list-inline text-white">
                    <br>
                    <p><u>Tags:</u></p>
                    <li class="list-inline-item pr-3" v-for="tag in video.tags">{{tag}}</li>
                </ul>

                <ul class="list-inline">
                    <li class="list-inline-item pr-3"><a :href="'tel:'+video.user.phone"><img src="/img/tel.png" alt="telephone" width="20px"></a></li>
                    <li class="list-inline-item px-3"><a :href="'mailto:'+video.user.email"><img src="/img/mai.png" alt="mail" width="25px"/></a></li>
                </ul>

            </div>
            <div class="row col-md-11 col-md-offset-1">
                <div class="col-md-12">
                    <br><br>
                    <hr>
                    <h3 class="text-white">Comments</h3>
                    <hr>
                </div>
                <div class="col-md-5" v-if="!showAllComments">
                    <div v-if="comments.length < 5 && comments.length >= 1">
                        <div v-for="comment in comments"
                             style="border-top: 1px solid white; border-bottom: 1px solid white;"
                             class="container">
                            <h5 class="text-white">@{{comment.user.name}}: {{comment.comment}}</h5>
                            <p class="text-white">{{moment(comment.created_at).fromNow()}}</p>
                        </div>
                    </div>

                    <div v-else-if="comments.length >= 5">
                        <div v-for="(comment, index) in comments" v-if="index < 5"
                                style="border-top: 1px solid white; border-bottom: 1px solid white;"
                                class="container">
                            <h5 class="text-white">@{{comment.user.name}}: {{comment.comment}}</h5>
                            <p class="text-white">{{moment(comment.created_at).fromNow()}}</p>
                        </div>
                        <br><br>
                        <a href="#" @click.prevent="showAllComments = !showAllComments" style="float: right">Show all Comments</a>
                    </div>

                    <div v-else-if="comments.length == 0">
                        <h5 class="text-white">No Comments Yet</h5>
                    </div>
                </div>

                <div class="col-md-5" v-else-if="showAllComments">
                    <div>
                        <div v-for="(comment) in comments"
                             style="border-top: 1px solid white; border-bottom: 1px solid white;"
                             class="container">
                            <h5 class="text-white">@{{comment.user.name}}: {{comment.comment}}</h5>
                            <p class="text-white">{{moment(comment.created_at).fromNow()}}</p>
                        </div>
                    </div>
                    <br><br>
                    <a href="#" @click.prevent="showAllComments = !showAllComments" style="float: right">Show few Comments</a>
                </div>

                <div class="container col-md-6">
                    <form class="form" v-if="authUser !== null">
                        <textarea v-model="newComment.comment" id="" cols="30" rows="10"></textarea>
                        <input type="submit" class="btn btn-primary btn-lg col-md-3" @click.prevent="sendNewComment()">
                    </form>

                    <hr>
                    <br><br>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
              categories:'',
                video:'',
                comments:'',
                newComment:{},
                alert:'',
                showAllComments:false,
                averageRatings:0,
                videoRating:0,
                authUser:null,
                ratings:0,
            }
        },
        props:['videoId'],
        methods:{


            getVideoDetails(id){
                axios.get('/video/get-details/'+id)
                    .then((res)=> {
                        if(res.data.status === 200){
                            const data = res.data.data;
                            this.video = data[0];
                            this.video.tags = JSON.parse(this.video.tags);
                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },

            getVideoComments(id){
                axios.get('/video/comment/'+id)
                    .then((res)=> {
                        if(res.data.status === 200){
                            const data = res.data.data;
                            this.comments = data;
                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },

            getVideoRating(id){
                axios.get('/video/average-ratings/'+id)
                    .then((res)=> {
                        if(res.data.status === 200){
                            const data = res.data.data;
                            this.averageRatings = Math.round(data);
                            console.log(this.averageRatings);

                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })

                axios.get('/video/rating/'+id)
                    .then((res)=> {
                        if(res.data.status === 200){
                            const data = res.data.data;
                            this.videoRating = data[0].rating;
                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },

            increaseViewCount(id){
                axios.get(`/video/add-view/${id}`)
                    .then((res)=> {
                        if(res.data.status === 200){
                            const data = res.data.data;
                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },

            sendNewComment(){
                this.newComment.id = this.video.id;
                axios.post(`/video/comment`, this.newComment)
                    .then((res)=> {
                        if(res.data.status === 200){
                            const data = res.data.data;
                            this.alert = 'success';
                            setTimeout(
                                function()
                                {
                                    this.alert = '';
                                }.bind(this), 3000);
                            this.getVideoComments(this.video.id);
                        }else{
                            this.alert = 'failure';
                            setTimeout(
                                function()
                                {
                                    this.alert = '';
                                }.bind(this), 3000);
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },

            rateVideo(){
                axios.post(`/video/rating`, {rating: this.videoRating, id: this.video.id})
                    .then((res)=> {
                        if(res.data.status === 200){
                            const data = res.data.data;
                            this.getVideoRating(this.video.id);
                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },

            checkAuth(){
                axios.get(`/check/auth`)
                    .then((res)=> {
                        if(res.data.status === 200){
                            const data = res.data.data;
                            this.authUser = data;
                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            }
        },
        mounted() {
            this.getVideoDetails(this.videoId);
            this.getVideoComments(this.videoId);
            this.checkAuth();
            this.getVideoRating(this.videoId);
        }
    }
</script>
