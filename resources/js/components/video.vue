<template>
    <div class="">
        <notifications position="top center" />

        <div class="container-fluid col-md-12">
            <div class="row justify-content-center my-5">
                <div class="col-md-8 my-5">
                    <form>
                        <div class="row justify-content-center">

                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control fontAwesome" v-model="searchInput" placeholder="search" @keyup="search()">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <select v-model="showcategory" id="" class="form-control" style="background-color:transparent;">
                                        <option value="all">All</option>
                                        <option :value="category.id" v-for="category in categories">{{category.name}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div v-for="category in categories" v-if="showcategory === 'all' && searchInput === ''">
                    <div class="row" v-if="category.video.length > 0">
                        <h4 class="cy pl-3"><b>{{category.name}}</b></h4>
                    </div>

                    <div class="row" v-if="category.video.length > 0">
                        <div class="col-md-4" v-for="video in category.video">
                            <video width="320" height="240" controls @play="increaseViewCount(video.id)">
                                <source :src="video.video" type="video/mp4">
                            </video>
                            <div>
                                <p class="text-white font-five mb-1">{{video.title}}</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item text-white">
                                        <span v-for="user in users">
                                            <span v-if="user.id === video.user_id">{{user.name}}</span>
                                        </span>
                                        <i>
                                            <img class="" src="/img/verified.png" alt="verified" >
                                        </i>
                                    </li>
                                    <li class="list-inline-item text-primary ml-md-3">{{video.views}} views</li>
                                    <li class="list-inline-item text-primary">{{moment(video.created_at).fromNow()}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-for="category in categories" v-if="showcategory === category.id && searchInput === ''">
                    <div class="row">
                        <h4 class="cy pl-3"><b>{{category.name}}</b></h4>
                    </div>

                    <div class="row" v-if="category.video.length > 0">
                        <div class="col-md-4" v-for="video in category.video">
                            <video width="320" height="240" controls @play="increaseViewCount(video.id)">
                                <source :src="video.video" type="video/mp4">
                            </video>
                            <div>
                                <p class="text-white font-five mb-1">{{video.title}}</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item text-white">
                                        <span v-for="user in users">
                                            <span v-if="user.id === video.user_id">{{user.name}}</span>
                                        </span>
                                        <i>
                                            <img class="" src="/img/verified.png" alt="verified" >
                                        </i>
                                    </li>
                                    <li class="list-inline-item text-primary ml-md-3">{{video.views}} views</li>
                                    <li class="list-inline-item text-primary">{{moment(video.created_at).fromNow()}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row text-white" v-else>
                        <h6 class="pl-3">No video For this Category yet</h6>
                    </div>
                </div>

                <div v-if="searchInput">
                    <div class="row">
                        <h4 class="cy pl-3"><b>Search Result</b></h4>
                    </div>

                    <div class="row" v-if="filteredList.length > 0">
                        <div class="col-md-4" v-for="video in filteredList">
                            <video width="320" height="240" controls @play="increaseViewCount(video.id)">
                                <source :src="video.video" type="video/mp4">
                            </video>
                            <div>
                                <p class="text-white font-five mb-1">{{video.title}}</p>
                                <ul class="list-inline">
                                    <li class="list-inline-item text-white">
                                        <span v-for="user in users">
                                            <span v-if="user.id === video.user_id">{{user.name}}</span>
                                        </span>
                                        <i>
                                            <img class="" src="/img/verified.png" alt="verified" >
                                        </i>
                                    </li>
                                    <li class="list-inline-item text-primary ml-md-3">{{video.views}} views</li>
                                    <li class="list-inline-item text-primary">{{moment(video.created_at).fromNow()}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row text-white" v-else>
                        <h6 class="pl-3">Couldn't find searched Video</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row py-4">
                    <p class="my-1"></p>
                </div>
                <img src="img/webbanner_portrait.png" class="bimg hidden">
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
              categories:'',
                users:'',
                searchInput:'',
                showcategory : 'all',
                filteredList:'',
            }
        },
        methods:{
            fetchCategories(){
                axios.get('/category/get-all')
                    .then((res)=> {
                        if(res.data.status == 200){
                            const data = res.data.data;
                            this.categories = data;
                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },

            fetchUsers(){
                axios.get('/user/get-all')
                    .then((res)=> {
                        if(res.data.status == 200){
                            const data = res.data.data;
                            this.users = data;
                        }else{
                            console.log(res.data.data);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },

            search(){
                if(this.showcategory === 'all'){
                    this.categories.forEach(function (category){
                        let categoryVideo = category.video;

                        this.filteredList = categoryVideo.filter(video => {
                            return video.title.toLowerCase().includes(this.searchInput.toLowerCase())
                        })
                    }.bind(this));
                }else{
                    this.categories.forEach(function (category){
                       if(category.id === this.showcategory){
                            let categoryVideo = category.video;

                            this.filteredList = categoryVideo.filter(video => {
                               return video.title.toLowerCase().includes(this.searchInput.toLowerCase())
                            })
                       }
                    }.bind(this));

                }
            },

            increaseViewCount(id){
                axios.get(`/video/add-view/${id}`)
                    .then((res)=> {
                        if(res.data.status == 200){
                            const data = res.data.data;
                            this.fetchCategories();
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
            this.fetchCategories();
            this.fetchUsers();
            console.log('Component mounted.')
        }
    }
</script>
