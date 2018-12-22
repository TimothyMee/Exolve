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
                            <div class="mr-5">1 Vendor (s)!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#" @click.prevent="show('Vendor')">
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
                            <div class="mr-5">2 New Videos!</div>
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
                            <div class="mr-5">3 Total Videos</div>
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
                                                <p><label><strong>Address:&nbsp; </strong></label>{{props.row.title}}</p>
                                                <p><label><strong>TagLine:&nbsp; </strong></label>{{props.row.created_by}}</p>
                                                <p><label><strong>Registration No:&nbsp; </strong></label>{{props.row.status}}</p>
                                                <p><label><strong>Website:&nbsp; </strong></label>{{props.row.views}}</p>
                                                <p><label><strong>Created At:&nbsp; </strong></label>{{props.row.created_at}}</p>
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
                                                <p><label><strong>Address:&nbsp; </strong></label>{{props.row.title}}</p>
                                                <p><label><strong>TagLine:&nbsp; </strong></label>{{props.row.created_by}}</p>
                                                <p><label><strong>Registration No:&nbsp; </strong></label>{{props.row.status}}</p>
                                                <p><label><strong>Website:&nbsp; </strong></label>{{props.row.views}}</p>
                                                <p><label><strong>Created At:&nbsp; </strong></label>{{props.row.created_at}}</p>
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
                currentTableData:[],
                columns: ['id', 'title', 'created_by', 'category', 'status' , 'views', 'created_at', 'more'],
                options: {
                    headings: {
                        title: 'Title',
                        created_by : 'Uploaded By',
                        category : 'Category',
                        status : 'Status',
                        views : 'Views',
                        created_at : 'Uploaded On',
                        more : 'More'
                    },

                    sortable: ['title', 'created_by', 'views'],
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
                    axios.get('/video/all')
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

                if(value === 'new-videos'){
                    this.showTable = value;
                    axios.get('/video/pending')
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
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
