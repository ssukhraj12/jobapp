<template>
    <v-row class="my-1">
        <v-col cols="12" md="6"><h2>All States</h2></v-col>
        <v-col cols="12" md="6" class="text-end">
            <v-text-field v-model="search" variant="solo" density="compact" append-inner-icon="mdi-magnify" label="Search"
                          single-line hide-details></v-text-field>
        </v-col>
    </v-row>
    <v-data-table :items="allstates" :headers="headers" :search="search"></v-data-table>
</template>

<script>
import axios from "axios";

export default {
    name: "AllStates",
    data(){
        return{
            allstates:[],
            search:'',
            headers:[
                {title:'Country',key:'country'},
                {title:'State',key:'name'},
                {title:'Status',key:'status'},
            ]
        }
    },
    created() {
        this.allStates();
    },
    methods:{
        allStates(){
            axios.get('/states')
            .then((resp)=>{
                this.allstates = resp.data.states;
            })
        }
    }
}
</script>

<style scoped>

</style>
