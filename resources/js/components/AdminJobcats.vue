<template>
    <v-row class="my-1" align="center">
        <v-col cols="12" md="4"><h2>Job Categories</h2></v-col>
        <v-col cols="12" md="4" class="text-center">
            <v-btn @click="addModal" color="success" size="small" prepend-icon="mdi-plus">Add Category</v-btn>
        </v-col>
        <v-col cols="12" md="4" class="text-end">
            <v-text-field v-model="search" variant="solo" density="compact" append-inner-icon="mdi-magnify" label="Search"
                          single-line hide-details></v-text-field>
        </v-col>
    </v-row>
    <v-data-table :headers="headers" :items="allcats" :search="search">
        <template v-slot:top>
            <v-dialog v-model="dialogedit" max-width="400" persistent>
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2 justify-content-between d-flex">
                        Edit Category <v-icon  @click="closeedit" class="text-h5">mdi-close</v-icon>
                    </v-card-title>
                    <v-card-text>
                        <v-form ref="form" v-model="valid">
                            <v-text-field v-model="editedItem.jobcat_name" variant="underlined" density="compact" label="Cat Name"></v-text-field>
                            <v-textarea v-model="editedItem.jobcat_description" variant="underlined" density="compact" label="Cat Description"></v-textarea>
                            <v-file-input v-model="editedItem.jobcat_img_url" accept="image/*" show-size clearable
                                          label="Cat Image" variant="underlined"></v-file-input>
                            <v-btn color="success" @click.prevent="addcat">Submit</v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </template>
        <template v-slot:[`item.jobcat_img_url`]="{item}">
            <v-img contain :aspect-ratio="16/9" class="my-1"
                   :lazy-src=(cdn+item.jobcat_img_url)
                   :src=(cdn+item.jobcat_img_url)
                   :alt="item.jobcat_name"
                   :title="item.jobcat_name" max-height="100px"></v-img>
        </template>
        <template v-slot:[`item.action`] = "{item}">
            <v-btn @click="editItem(item)" color="primary" size="x-small" prepend-icon="mdi-pencil" class="me-1">Edit</v-btn>
            <v-btn @click="deleteItem(item)" color="red" size="x-small" prepend-icon="mdi-trash-can">Delete</v-btn>
        </template>
    </v-data-table>
    <v-dialog v-model="addDialog" max-width="400" persistent>
        <v-card>
            <v-card-title class="text-h5 grey lighten-2 justify-content-between d-flex">
                Add Category <v-icon  @click="closeedit" class="text-h5">mdi-close</v-icon>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid">
                    <v-text-field v-model="defaultItem.jobcat_name" variant="underlined" density="compact" label="Cat Name"></v-text-field>
                    <v-textarea v-model="defaultItem.jobcat_description" variant="underlined" density="compact" label="Cat Description"></v-textarea>
                    <v-file-input v-model="defaultItem.jobcat_img_url" accept="image/*" show-size clearable
                                  label="Cat Image" variant="underlined"></v-file-input>
                    <v-btn color="success" @click.prevent="addcat">Submit</v-btn>
                </v-form>
            </v-card-text>
        </v-card>

    </v-dialog>
    <v-dialog v-model="dialogDelete" max-width="400" persistent>
        <v-card>
            <v-card-text>
                Are you sure to delete this Category
            </v-card-text>
            <v-card-actions>
                <v-btn color="red">Ok</v-btn>
                <v-btn color="success" size="small"  @click="closeDelete">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import axios from "axios";

export default {
    name: "AdminJobcats",
    data(){
        return{
            valid:false,
            cdn:"http://jobappimages.s3-website.ap-south-1.amazonaws.com/",
            addDialog:false,
            dialogedit:false,
            dialogDelete:false,
            allcats:[],
            search:'',
            readers:[],
            headers:[
                {title:'ID',key:'jobcat_id'},
                {title:'Name',key:'jobcat_name'},
                {title:'url',key:'jobcat_url'},
                {title:'Desc',key:'jobcat_description'},
                {title:'Image',key:'jobcat_img_url'},
                {title:'Actions',key:'action'},
            ],
            editedIndex: -1,
            editedItem: {
                jobcat_id : '',
                jobcat_name : '',
                jobcat_url : '',
                jobcat_description: '',
                jobcat_img_url: '',
            },
            defaultItem: {
                jobcat_id : '',
                jobcat_name : '',
                jobcat_url : '',
                jobcat_description: '',
                jobcat_img_url: '',
            },
        }
    },
    created() {
        this.allCats();
    },
    methods:{
        addModal(){
            this.addDialog = true;
        },
        allCats(){
            axios.get('/api/jobcats')
            .then((resp)=>{
                this.allcats = resp.data.jobcats;
                console.log(resp.data.jobcats);
            })
        },
        addcat(){
            const config = {headers: { 'content-type': 'multipart/form-data' }}
            const data = {
                'jobcat_name':this.defaultItem.jobcat_name,
                'jobcat_url':this.defaultItem.jobcat_name,
                'jobcat_description':this.defaultItem.jobcat_description,
                'jobcat_img_url':this.defaultItem.jobcat_img_url,
            }
            axios.post('/api/jobcat/add',this.defaultItem,config)
            this.allCats();
            this.addDialog = false;
        },
        editItem(item) {
            this.editedIndex = this.allcats.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogedit = true;
        },
        deleteItem(item) {
            this.editedIndex = this.allcats.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },
        closeedit() {
            this.dialogedit = false;
            this.addDialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
    },
    watch: {
        addDialog(val) {
            val || this.closeedit();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },
}
</script>

<style scoped>

</style>
