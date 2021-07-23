<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Graduates
                        <button class="btn btn-success float-right" data-toggle="modal" data-target="#add-graduate-modal" @click="addData">Add</button>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Gelar</th>
                                    <th scope="col">Is Lulus</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Gelar</th>
                                    <th scope="col">Is Lulus</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(graduate, index) in graduates" :key="graduate.id">
                                    <td>{{graduate.id}}</td>
                                    <td>{{graduate.nama}}</td>
                                    <td>{{graduate.nama_lengkap}}</td>
                                    <td v-if="graduate.foto != '-'"><img :src="'../storage/'+graduate.foto" :alt="graduate.nama_lengkap" style="width:100px; height:auto"></td>
                                    <td v-else>-</td>
                                    <td>{{graduate.jurusan}}</td>
                                    <td>{{graduate.gelar}}</td>
                                    <td>{{graduate.is_lulus ? "Lulus" : "Belum Lulus"}}</td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#update-graduate-modal" @click="editData(index)">Edit</button>
                                        <button class="btn btn-danger" @click="deleteData(index)">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-graduate-modal" tabindex="-1" role="dialog" aria-labelledby="update-graduate-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Masukan nama graduate" v-model="update_graduate.nama">
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukan nama lengkap graduate" v-model="update_graduate.nama_lengkap">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" placeholder="Masukan deskripsi graduate" v-model="update_graduate.deskripsi" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <img :src="'../storage/'+update_graduate.foto" class="img-responsive" style="max-height: 350px; max-width: 100%; display: block; margin: 0 0 15px 0;" v-if="(update_graduate.foto!='-') && (!is_foto_update)">
                            <img :src="update_graduate.foto" class="img-responsive" style="max-height: 350px; max-width: 100%; display: block; margin: 0 0 15px 0;" v-else>
                            <input type="file" class="form-control-file" placeholder="Masukan foto graduate" @change="onUpdateFotoChange" id="update_foto_upload" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control" placeholder="Masukan jurusan graduate" v-model="update_graduate.jurusan">
                        </div>
                        <div class="form-group">
                            <label>Gelar</label>
                            <input type="text" class="form-control" placeholder="Masukan gelar graduate" v-model="update_graduate.gelar">
                        </div>
                        <div class="form-group">
                            <label>Status Lulus</label>
                            <select class="form-control" v-model="update_graduate.is_lulus">
                                <option value="0" v-if="update_graduate.is_lulus==0" checked>Belum Lulus</option>
                                <option value="0" v-else>Belum Lulus</option>
                                <option value="1" v-if="update_graduate.is_lulus==1" checked>Sudah Lulus</option>
                                <option value="1" v-else>Sudah Lulus</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateData">Save changes</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-graduate-modal" tabindex="-1" role="dialog" aria-labelledby="add-graduate-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Masukan nama graduate" v-model="graduate.nama">
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukan nama lengkap graduate" v-model="graduate.nama_lengkap">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" placeholder="Masukan deskripsi graduate" v-model="graduate.deskripsi" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <img :src="graduate.foto" class="img-responsive " style="max-height: 350px; max-width: 100%; display: block; margin: 0 0 15px 0;" v-if="graduate.foto!=''">
                            <input type="file" class="form-control-file" placeholder="Masukan foto graduate" @change="onFotoChange" id="foto_upload" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control" placeholder="Masukan jurusan graduate" v-model="graduate.jurusan">
                        </div>
                        <div class="form-group">
                            <label>Gelar</label>
                            <input type="text" class="form-control" placeholder="Masukan gelar graduate" v-model="graduate.gelar">
                        </div>
                        <div class="form-group">
                            <label>Status Lulus</label>
                            <select class="form-control" v-model="graduate.is_lulus">
                                <option value="0" v-if="graduate.is_lulus==0" checked>Belum Lulus</option>
                                <option value="0" v-else>Belum Lulus</option>
                                <option value="1" v-if="graduate.is_lulus==1" checked>Sudah Lulus</option>
                                <option value="1" v-else>Sudah Lulus</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="createData">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                graduates:[],
                graduate:{
                    id:"",
                    nama:"",
                    nama_lengkap:"",
                    deskripsi:"",
                    foto:"",
                    jurusan:"",
                    gelar:"",
                    is_lulus:0,
                },
                update_graduate:[],
                is_foto_update:false,
                errors:[],
                uri:'/resource/graduates',
            }
        },
        methods:{
            loadData(){
                axios.get(this.uri).then(response=>{
                    this.graduates = response.data.graduates
                });
            },
            onFotoChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;
                this.createFoto(files[0]);
            },
            createFoto(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.graduate.foto = e.target.result;
                }
                reader.readAsDataURL(file);
            },
            onUpdateFotoChange(e){
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) return;
                this.createUpdateFoto(files[0]);
            },
            createUpdateFoto(file){
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.update_graduate.foto = e.target.result;
                }
                this.is_foto_update = true;
                reader.readAsDataURL(file);
            },
            createData(){
                let formData = new FormData();
                var foto_file = document.querySelector('#foto_upload');
                formData.append('nama', this.graduate.nama);
                formData.append('nama_lengkap', this.graduate.nama_lengkap);
                formData.append('deskripsi', this.graduate.deskripsi);
                formData.append('foto', foto_file.files[0]);
                formData.append('jurusan', this.graduate.jurusan);
                formData.append('gelar', this.graduate.gelar);
                formData.append('is_lulus', this.graduate.is_lulus);
                axios.post(this.uri, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response=>{
                    this.graduates.push(response.data.graduate);
                    toastr.success(response.data.status);
                    this.resetData();
                }).catch(error=>{
                    if (error.response.data.name){
                        this.errors.push(error.response.data.name[0]);
                    }
                    toastr.error(JSON.stringify(error.response.data));
                });
            },
            addData(){
                this.resetData();
            },
            editData(index){
                this.resetUpdateData();
                this.update_graduate = JSON.parse(JSON.stringify(this.graduates[index]));
            },
            updateData(){
                let formData = new FormData();
                var update_foto_file = document.querySelector('#update_foto_upload');
                formData.append("_method", 'PATCH');
                formData.append('nama', this.update_graduate.nama);
                formData.append('nama_lengkap', this.update_graduate.nama_lengkap);
                formData.append('deskripsi', this.update_graduate.deskripsi);
                formData.append('jurusan', this.update_graduate.jurusan);
                formData.append('gelar', this.update_graduate.gelar);
                formData.append('is_lulus', this.update_graduate.is_lulus);
                let update_foto = '';
                if (update_foto_file.files[0]){
                    update_foto = update_foto_file.files[0]
                }
                formData.append('foto', update_foto);

                axios.post(this.uri+'/'+this.update_graduate.id,formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response=>{
                    toastr.success(response.data.status);
                    this.resetUpdateData();
                    this.loadData();
                })
            },
            deleteData(index){
                let confirmBox = confirm("Do you want to delete this?");
                if (confirmBox==true) {
                    axios.delete(this.uri+"/"+this.graduates[index].id).then(response=>{
                        this.$delete(this.graduates,index);
                        toastr.success(response.data.status);
                    }).catch(error=>{
                        toastr.error("Could not delete for some reason");
                    });
                }
            },
            resetData(){
                this.errors=[];
                var foto_file = document.querySelector('#foto_upload');
                foto_file.value = "";
                this.graduate.nama = '';
                this.graduate.nama_lengkap = '';
                this.graduate.foto = '';
                this.graduate.deskripsi = '';
                this.graduate.jurusan = '';
                this.graduates.gelar = '';
                this.graduate.is_lulus = 0;
            },
            resetUpdateData(){
                this.erros=[];
                var update_foto_file = document.querySelector('#update_foto_upload');
                update_foto_file.value = "";
                this.update_graduate = []
                this.is_foto_update = false;
            }
        },
        mounted() {
            this.loadData();
            console.log('Component mounted.');
        }
    }
</script>
