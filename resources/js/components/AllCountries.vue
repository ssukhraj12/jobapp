<template>
    <v-row class="my-1">
        <v-col cols="12" md="6"><h2>All Countries</h2></v-col>
        <v-col cols="12" md="6" class="text-end">
            <v-text-field v-model="search" variant="solo" density="compact" append-inner-icon="mdi-magnify" label="Search"
                          single-line hide-details></v-text-field>
        </v-col>
    </v-row>
    <v-data-table :items="allcountries" :headers="headers" :search="search"></v-data-table>
</template>

<script>
import axios from "axios";

export default {
    name: "AllCountries",
    data(){
        return{
            allcountries:[],
            search: '',
            headers:[
                {title:'Country',key:'name'},
                {title:'Status',key:'status'},
            ]
        }
    },
    created() {
        this.allCountries();
    },
    methods:{
        allCountries(){
            axios.get('/countries')
            .then((resp)=>{
                this.allcountries = resp.data.countries;
            })
        }
    }
}
</script>

<style scoped>

</style>
