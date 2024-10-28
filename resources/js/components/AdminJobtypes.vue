<template>
    <v-row class="my-1" align="center">
        <v-col cols="12" md="4"><h2>Job Types</h2></v-col>
        <v-col cols="12" md="4" class="text-center">
            <v-btn @click="addModal" color="success" size="small" prepend-icon="mdi-plus">Add JobType</v-btn>
        </v-col>
        <v-col cols="12" md="4" class="text-end">
            <v-text-field v-model="search" variant="solo" density="compact" append-inner-icon="mdi-magnify" label="Search"
                          single-line hide-details></v-text-field>
        </v-col>
    </v-row>
    <v-data-table :headers="headers" :items="alltypes" :search="search" density="compact">
        <template v-slot:top>
            <v-dialog v-model="dialogedit" max-width="400" persistent>
                <v-card>
                    <v-card-title class="text-h5 grey lighten-2 justify-content-between d-flex">
                        Edit Type<v-icon  @click="closeedit" class="text-h5">mdi-close</v-icon>
                    </v-card-title>
                    <v-card-text>
                        <v-form ref="form" v-model="valid">
                            <v-text-field v-model="editedItem.jobtype_title" variant="underlined" density="compact" label="Type Name"></v-text-field>
                            <v-textarea v-model="editedItem.jobtype_description" variant="underlined" density="compact" label="Type Description"></v-textarea>
                            <v-file-input v-model="editedItem.jobtype_img_url" accept="image/*" show-size clearable
                                          label="type Image" variant="underlined"></v-file-input>
                            <v-btn color="success" @click.prevent="addtype">Submit</v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-dialog>
        </template>
        <template v-slot:[`item.jobtype_img_url`]="{item}">
            <v-img contain :aspect-ratio="16/9" class="my-1"
                   :lazy-src=(cdn+item.jobtype_img_url)
                   :src=(cdn+item.jobtype_img_url)
                   :alt="item.jobtype_title"
                   :title="item.jobtype_title" max-height="100px"></v-img>
        </template>
        <template v-slot:[`item.action`] = "{item}">
            <v-btn @click="editItem(item)" color="primary" size="x-small" prepend-icon="mdi-pencil" class="me-1">Edit</v-btn>
            <v-btn @click="deleteItem(item)" color="red" size="x-small" prepend-icon="mdi-trash-can">Delete</v-btn>
        </template>
    </v-data-table>
    <v-dialog v-model="addDialog" max-width="400" persistent>
        <v-card>
            <v-card-title class="text-h5 grey lighten-2 justify-content-between d-flex">
                Add Job Type <v-icon  @click="closeedit" class="text-h5">mdi-close</v-icon>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid">
                    <v-text-field v-model="defaultItem.jobtype_title" variant="underlined" density="compact" label="Type Name"></v-text-field>
                    <v-textarea v-model="defaultItem.jobtype_description" variant="underlined" density="compact" label="Type Description"></v-textarea>
                    <v-file-input v-model="defaultItem.jobtype_img_url" accept="image/*" show-size clearable
                                  label="type Image" variant="underlined"></v-file-input>
                    <v-btn color="success" @click.prevent="addtype">Submit</v-btn>
                </v-form>
            </v-card-text>
        </v-card>

    </v-dialog>
    <v-dialog v-model="dialogDelete" max-width="400" persistent>
        <v-card>
            <v-card-text>
                Are you sure to delete this Job Type
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
    name: "AdminJobtypes",
    data(){
        return{
            valid:false,
            cdn:"http://jobappimages.s3-website.ap-south-1.amazonaws.com/",
            addDialog:false,
            dialogedit:false,
            dialogDelete:false,
            alltypes:[],
            search:'',
            headers:[
                {title:'ID',key:'jobtype_id'},
                {title:'Name',key:'jobtype_title'},
                {title:'url',key:'jobtype_slug'},
                {title:'Desc',key:'jobtype_description'},
                {title:'Image',key:'jobtype_img_url'},
                {title:'Actions',key:'action'},
            ],
            editedIndex: -1,
            editedItem: {
                jobtype_id : '',
                jobtype_title : '',
                jobtype_slug : '',
                jobtype_description: '',
                jobtype_img_url: '',
            },
            defaultItem: {
                jobtype_id : '',
                jobtype_title : '',
                jobtype_slug : '',
                jobtype_description: '',
                jobtype_img_url: '',
            },

        }
    },
    created() {
        this.allJobtypes();
    },
    methods:{
        addModal(){
            this.addDialog = true;
        },
        allJobtypes(){
            axios.get('/api/jobtypes')
            .then((resp)=>{
                this.alltypes = resp.data.jobtypes;
            })
        },
        addtype(){
            const config = {headers: { 'content-type': 'multipart/form-data' }}
            const data = {
                'jobtype_title':this.defaultItem.jobtype_title,
                'jobtype_slug':this.defaultItem.jobtype_slug,
                'jobtype_description':this.defaultItem.jobtype_description,
                'jobtype_img_url':this.defaultItem.jobtype_img_url,
            }
            axios.post('/api/jobtype/add',this.defaultItem,config)
            this.allJobtypes();
            this.addDialog = false;
        },
        editItem(item) {
            this.editedIndex = this.alltypes.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogedit = true;
        },
        deleteItem(item) {
            this.editedIndex = this.alltypes.indexOf(item)
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
