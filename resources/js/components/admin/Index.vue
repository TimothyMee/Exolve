<template>
    <div class=''>
        <div class="container-fluid" >
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-users"></i>
                            </div>
                            <div class="mr-5">{{totalUsers}} Vendors!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#" @click.prevent="show('vendors')">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                              <i class="fas fa-angle-right"></i>
                             </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-video"></i>
                            </div>
                            <div class="mr-5">{{newVideos}} New Videos!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#" @click.prevent="show('new-videos')">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                              <i class="fas fa-angle-right"></i>
                             </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-video"></i>
                            </div>
                            <div class="mr-5">{{totalVideos}} Total Videos</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#" @click.prevent="show('total-videos')">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                              <i class="fas fa-angle-right"></i>
                             </span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="row">

                <div class="container bg_2">


                    <div class="col-sm-12 property_info">
                        <div class="card-body" v-if="showTable === 'home-chart'">
                            <h5 class="font-weight-bold text-white mb-5">Monthly Chart</h5>
                            <canvas id="myAreaChart" width="100%" height="30"></canvas>
                        </div>

                        <div class="card mb-3" v-if="showTable === 'total-videos'">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                All Videos</div>
                            <div class="card-body">
                                <v-client-table :data="currentTableData" :columns="columns" :options="options" class="dataTable no-footer">

                                    <span slot="more" slot-scope="props" target="_blank">
                                        <a :href="'video/details/'+props.row.id">...</a>
                                    </span>

                                    <span slot="created_by" slot-scope="props" target="_blank">
                                        {{props.row.user.name}}
                                    </span>


                                    <span slot="category" slot-scope="props" target="_blank">
                                        {{props.row.category.name}}
                                    </span>

                                    <span slot="child_row" slot-scope="props">
                                        <span class="col-md-12">
                                            <span style="text-align: center">
                                                <p><label><strong>Title:&nbsp; </strong></label>{{props.row.title}}</p>
                                                <p><label><strong>Created By:&nbsp; </strong></label>{{props.row.user.name}}</p>
                                                <p><label><strong>Status:&nbsp; </strong></label>{{props.row.status}}</p>
                                                <p><label><strong>Views:&nbsp; </strong></label>{{props.row.views}}</p>
                                                <p><label><strong>Category:&nbsp; </strong></label>{{props.row.category.name}}</p>
                                                <p><label><strong>Created At:&nbsp; </strong></label>{{moment(props.row.created_at).fromNow()}}</p>
                                            </span>
                                        </span>
                                    </span>
                                </v-client-table>
                            </div>
                            <div class="card-footer small text-muted">Updated now</div>
                        </div>

                        <div class="card mb-3" v-if="showTable === 'new-videos'">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                New Videos</div>
                            <div class="card-body">
                                <v-client-table :data="currentTableData" :columns="columns" :options="options" class="dataTable no-footer">

                                    <span slot="more" slot-scope="props" target="_blank">
                                        <a :href="'video/details/'+props.row.id">...</a>
                                    </span>

                                    <span slot="created_by" slot-scope="props" target="_blank">
                                        {{props.row.user.name}}
                                    </span>


                                    <span slot="category" slot-scope="props" target="_blank">
                                        {{props.row.category.name}}
                                    </span>

                                    <span slot="child_row" slot-scope="props">
                                        <span class="col-md-12">
                                            <span style="text-align: center">
                                                <p><label><strong>Title:&nbsp; </strong></label>{{props.row.title}}</p>
                                                <p><label><strong>Created By:&nbsp; </strong></label>{{props.row.user.name}}</p>
                                                <p><label><strong>Status:&nbsp; </strong></label>{{props.row.status}}</p>
                                                <p><label><strong>Views:&nbsp; </strong></label>{{props.row.views}}</p>
                                                <p><label><strong>Category:&nbsp; </strong></label>{{props.row.category.name}}</p>
                                                <p><label><strong>Created At:&nbsp; </strong></label>{{moment(props.row.created_at).fromNow()}}</p>
                                            </span>
                                        </span>
                                    </span>
                                </v-client-table>
                            </div>
                            <div class="card-footer small text-muted">Updated now</div>
                        </div>

                        <div class="card mb-3" v-if="showTable === 'vendors'">
                            <div class="card-header">
                                <i class="fas fa-table"></i>
                                Vendors</div>
                            <div class="card-body">
                                <v-client-table :data="currentTableData" :columns="userTableColumns" :options="userTableOptions" class="dataTable no-footer">

                                    <span slot="video" slot-scope="props" target="_blank">
                                        {{props.row.video.length}}
                                    </span>

                                    <span slot="created_at" slot-scope="props" target="_blank">
                                        {{moment(props.row.created_at).fromNow()}}
                                    </span>

                                    <span slot="child_row" slot-scope="props">
                                        <span class="col-md-12">
                                            <span style="text-align: center">
                                                <p><label><strong>Name:&nbsp; </strong></label>{{props.row.name}}</p>
                                                <p><label><strong>Email:&nbsp; </strong></label>{{props.row.email}}</p>
                                                <p><label><strong>Phone Number:&nbsp; </strong></label>{{props.row.phone}}</p>
                                                <p><label><strong>Total Video:&nbsp; </strong></label>{{props.row.video.length}}</p>
                                                <p><label><strong>Created At:&nbsp; </strong></label>{{moment(props.row.created_at).fromNow()}}</p>
                                            </span>
                                        </span>
                                    </span>
                                </v-client-table>
                            </div>
                            <div class="card-footer small text-muted">Updated now</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                showTable: 'home-chart',
                totalUsers : 0,
                totalVideos : 0,
                newVideos : 0,
                currentTableData:[],
                userTableColumns:['id', 'name', 'phone', 'email', 'video', 'created_at'],
                userTableOptions: {
                    headings: {
                        name: 'Name',
                        phone : 'Phone Number',
                        email : 'email',
                        video : 'Videos',
                        created_at : 'Joined On',
                    },

                    sortable: ['name', 'videos', 'created_at'],
                    filterable: ['name', 'videos', 'created_at'],
                    perPage:10,
                    skin: "table table-hover dataTable no-footer",
                },

                columns: ['id', 'title', 'created_by', 'status' , 'views', 'more'],
                options: {
                    headings: {
                        title: 'Title',
                        created_by : 'Uploaded By',
//                        category : 'Category',
                        status : 'Status',
                        views : 'Views',
                        created_at : 'Uploaded On',
                        more : 'More'
                    },

                    sortable: ['title', 'created_by', 'views', 'created_at'],
                    filterable: ['title', 'category', 'status'],
                    perPage:10,
                    skin: "table table-hover dataTable no-footer",
                }
            }
        },
        methods:{
            show(value){
                if(value === 'total-videos'){
                    this.showTable = value;
                    axios.get('/admin/video/all')
                        .then((res)=>{
                            if(res.data.status == 200){
                                const data = res.data.data;
                                this.currentTableData = data;
                            }else{
                                console.log(res);
                            }
                        })
                        .catch((err)=>{
                            console.log(err);
                        })
                }

                if(value === 'new-videos'){
                    this.showTable = value;
                    axios.get('/admin/video/pending')
                        .then((res)=>{
                            if(res.data.status == 200){
                                const data = res.data.data;
                                this.currentTableData = data;
                            }else{
                                console.log(res);
                            }
                        })
                        .catch((err)=>{
                            console.log(err);
                        })
                }

                if(value === 'vendors'){
                    this.showTable = value;
                    axios.get('/admin/users/get')
                        .then((res)=>{
                            if(res.data.status == 200){
                                const data = res.data.data;
                                this.currentTableData = data;
                                console.log(this.currentTableData);
                            }else{
                                console.log(res);
                            }
                        })
                        .catch((err)=>{
                            console.log(err);
                        })
                }
            },
            getDataCounts(){
                axios.get('/admin/get/statistics')
                    .then((res)=>{
                        if(res.data.status == 200){
                            const data = res.data.data;
                            this.totalUsers = data.totalUsers;
                            this.totalVideos = data.totalVideos;
                            this.newVideos = data.newVideos;
                            console.log(this.totalUsers);
                        }
                    })
                    .catch((err)=>{
                        console.log(err);
                    })
            },
        },
        mounted() {
            this.getDataCounts();
        }
    }
</script>

<style>
    .VueTables__child-row-toggler {
        width: 16px;
        height: 16px;
        line-height: 16px;
        display: block;
        margin: auto;
        text-align: center;
        cursor: pointer;
    }

    .VueTables__child-row-toggler--closed::before {
        content: "+";
    }

    .VueTables__child-row-toggler--open::before {
        content: "-";
    }

</style>