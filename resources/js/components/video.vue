<template>
    <div class="">
        <notifications position="top center" />

        <div class="container-fluid col-md-12">
            <div class="row justify-content-center my-5">
                <div class="col-md-8 my-5">
                    <form>
                        <div class="row justify-content-center">

                            <div class="col">
                                <div class="row form-group">
                                    <input type="text" class="col-md-10 form-control fontAwesome" v-model="searchInput" placeholder="search"
                                            >
                                    <button class="col-md-2 btn btn-default rounded-0 btnsi" style="margin-top:0px;" @click.prevent="search()"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                            <div v-show="loading" class="col-md-12 justify-content-center">
                                <img src="/img/loading.svg" alt="">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div v-if="show === 'all'">
                    <div v-for="category in categories">
                        <div class="row" v-if="category.video.length > 0">
                            <h4 class="cy pl-3"><b>{{category.name}}</b></h4>
                        </div>

                        <div class="row" v-if="category.video.length > 0">
                            <div class="col-md-4" v-for="video in category.video">
                                <video width="320" height="240" controls @play="increaseViewCount(video.id)">
                                    <source :src="video.video" type="video/mp4">
                                </video>
                                <div>
                                    <a :href="'/video/details/'+video.id"><p class="text-white font-five mb-1">{{video.title}}</p></a>
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
                </div>
                <div v-else-if="show === 'search'" class="row">
                    <div class="col-md-12">
                        <h4 class="cy pl-3">Search Result</h4>
                    </div>
                    <div v-if="searchResult.length > 0" class="row col-md-12">
                        <div v-for="result in searchResult" class="col-md-4">
                            <video width="320" height="240" controls @play="increaseViewCount(result.id)">
                                <source :src="result.video" type="video/mp4">
                            </video>
                            <div>
                                <a :href="'/video/details/'+result.id"><p class="text-white font-five mb-1">{{result.title}}</p></a>
                                <ul class="list-inline">
                                    <li class="list-inline-item text-white">
                                        <span v-for="user in users">
                                            <span v-if="user.id === result.user_id">{{user.name}}</span>
                                        </span>
                                        <i>
                                            <img class="" src="/img/verified.png" alt="verified" >
                                        </i>
                                    </li>
                                    <li class="list-inline-item text-primary ml-md-3">{{result.views}} views</li>
                                    <li class="list-inline-item text-primary">{{moment(result.created_at).fromNow()}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div v-else="" class="col-md-12">
                        <p class="text-white">No Result Found</p>
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
                searchResult:'',
                show : 'all',
                filteredList:'',
                loading:false,
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
                this.loading = true;
                axios.get(`/search/${this.searchInput}`)
                    .then((res)=> {
                        if(res.data.status == 200){
                            const data = res.data.data;
                            this.loading = false;
                            this.searchResult = data;
                            console.log(this.searchResult);
                            this.show = 'search';
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
