<template>
    <div class="container">
      <div class="row mt-5" v-if="$gate.isAdminOrEditor()">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Users Records</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 250px;">
                  <button type="button" class="btn btn-success btn-sm" name="button" @click="newModal">Add New<i class="fas fa-user-plus"></i></button>

                  <input type="text" name="table_search" class="form-control float-right m-l-10" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Registered At</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="user in users.data" :key="user.id">
                    <td>{{ user.name | capitalize }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.usertype | capitalize }}</td>
                    <td>{{ user.created_at | myDate }}</td>
                    <td>
                        <a href="#" @click="editModal(user)"><i class="fa fa-edit"></i></a> &nbsp / &nbsp
                        <a href="#" @click="deleteUser(user.id)"><i class="fa fa-trash red"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <pagination :data="users" @pagination-change-page="getResults"></pagination>
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div v-if="!$gate.isAdminOrEditor()">
          <not-found></not-found>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 v-show="editmode" class="modal-title">Edit User</h5>
              <h5 v-show="!editmode" class="modal-title">Add New User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.name" type="text" name="name" placeholder="Enter Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.email" type="text" name="email" placeholder="Enter Email"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.password" type="password" name="password" placeholder="Enter Password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                    </div>
                    <div class="form-group">
                      <select class="form-control" placeholder="User Type" v-model="form.usertype" :class="{ 'is-invalid': form.errors.has('usertype') }" name="usertype">
                        <option value="">Select user type</option>
                        <option value="user">User</option>
                        <option value="editor">Editor</option>
                        <option value="admin">Admin</option>
                      </select>
                      <has-error :form="form" field="usertype"></has-error>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-primary">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
          </div>
        </div>
      </div>

    </div>
</template>

<script>
    export default {
        data(){
          return {
              editmode: false,
              users : {},
              form: new Form({
                id:'',
                name :'',
                email :'',
                password:'',
                usertype :'',
              })
          }
        },
        methods:{
          getResults(page = 1) {
      			axios.get('api/user?page=' + page)
      				.then(response => {
      					this.users = response.data;
      				});
      		},
          newModal(){
            this.editmode=false;
            this.form.reset();
            this.form.clear();
            $('#addNew').modal('show');
          },
          editModal(user){
            this.editmode=true;
            this.form.reset();
            this.form.clear();
            $('#addNew').modal('show');
            this.form.fill(user);
          },
            loadUsers(){
                if(this.$gate.isAdminOrEditor()){
                  axios.get("api/user").then(({data})=>(this.users = data))
                }
            },
            deleteUser(id){
              Swal({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  //Send request to server
                  if(result.value){
                      this.form.delete('api/user/'+id).then(()=>{
                          Swal(
                            'Deleted!',
                            'User has been deleted.',
                            'success'
                          )
                          Fire.$emit('AfterCreate');
                      }).catch(()=>{
                        Swal(
                          'Failed!',
                          'Something went wrong!',
                          'error'
                        )
                      });
                  }

              })
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                    $('#addNew').modal('hide')
                    toast({
                      type: 'success',
                      title: 'User created successfully'
                    })
                })
                .catch(()=>{
                  this.$Progress.finish()
                })

            },
            updateUser(){
              this.$Progress.start();
              this.form.put('api/user/'+this.form.id)
              .then(()=>{
                $('#addNew').modal('hide')
                Swal(
                  'Updated!',
                  'User has been updated.',
                  'success'
                )
                Fire.$emit('AfterCreate');
              })
              .catch(()=>{
                this.$Progress.fail()
              })
            }
        },
        created() {
            Fire.$on('searching', ()=>{
              let query = this.$parent.search;
              axios.get('api/findUser?q=' + query)
              .then((data)=>{
                  this.users = data.data
                  console.log(data);
              })
              .catch(()=>{

              })
            })
            this.loadUsers();
            Fire.$on('AfterCreate',()=>{
              this.loadUsers();
            });
            //setInterval(()=>this.loadUsers(), 3000);
        }
    }
</script>
