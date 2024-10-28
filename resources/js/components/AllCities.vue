<template>
    <v-row class="my-1">
        <v-col cols="12" md="6"><h2>All Cities</h2></v-col>
        <v-col cols="12" md="6" class="text-end">
            <v-text-field v-model="search" variant="solo" density="compact" append-inner-icon="mdi-magnify" label="Search"
                          single-line hide-details></v-text-field>
        </v-col>
    </v-row>
    <v-data-table :items="allcities" :headers="headers" :search="search" class="text-capitalize"></v-data-table>
</template>

<script>
import axios from "axios";

export default {
    name: "AllCities",
    data(){
        return{
            allcities:[],
            search:'',
            headers:[
                {title:'State ID',key:'state_id'},
                {title:'State',key:'state'},
                {title:'City ID',key:'id'},
                {title:'City',key:'name'},
                {title:'Status',key:'status'},
            ]
        }
    },
    created() {
        this.allCities();
    },
    methods:{
        allCities(){
            axios.get('/cities')
            .then((resp)=>{
                this.allcities = resp.data.cities;
            })
        }
    }
}
</script>

<style scoped>

</style>
