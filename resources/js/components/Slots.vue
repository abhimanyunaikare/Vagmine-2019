<template>
    <div class="container">
      <div class="row mt-5" v-if="$gate.isAdminOrEditor()">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Slots Records</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <button type="button" class="btn btn-success btn-sm" name="button" @click="newModal">Add New<i class="fas fa-calendar-day"></i></button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Name</th>
                    <th>Place</th>
                    <th>Program Type</th>
                    <th>Time</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="slot in slots.data" :key="slot.id">
                    <td>{{ slot.title | capitalize }}</td>
                    <td>{{ slot.place }}</td>
                    <td>{{ slot.progtype | capitalize }}</td>
                    <td>{{ slot.start_date | myDate }}</td>
                    <td>
                        <a href="#" @click="editModal(slot)"><i class="fa fa-edit"></i></a> &nbsp / &nbsp
                        <a href="#" @click="deleteSlot(slot.id)"><i class="fa fa-trash red"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <pagination :data="slots" @pagination-change-page="getResults"></pagination>
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
              <h5 v-show="editmode" class="modal-title">Edit Slot</h5>
              <h5 v-show="!editmode" class="modal-title">Add New Slot</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="editmode ? updateSlot() : createSlot()" id="myform">
                <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.title" type="text" name="title" placeholder="Enter Title"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                        <has-error :form="form" field="title"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.place" type="text" id="place" name="place" placeholder="Enter Place"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('place') }">
                        <has-error :form="form" field="place"></has-error>
                    </div>
                    <div class="form-group">
                      <select class="form-control" v-model="form.userid" :class="{ 'is-invalid': form.errors.has('userid') }" name="userid" required>
                          <option value="">Select User</option>
                          <option v-for="user in users" :value="user.id">{{user.name | capitalize }}</option>
                      </select>
                      <has-error :form="form" field="userid"></has-error>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-clock"></i></span>
                            </div>
                            <datetime use12-hour type="datetime" v-model="form.start_date" name="start_date"  placeholder="Select Start DateTime" :class="{ 'is-invalid': form.errors.has('start_date') }" class="form-control float-right" required></datetime>
                            <datetime use12-hour type="datetime" v-model="form.end_date" name="end_date"  placeholder="Select End DateTime" :class="{ 'is-invalid': form.errors.has('end_date') }" class="form-control float-right" required></datetime>
                        </div>
                        <small v-show="editmode" class="has-text-info text-primary">Start: {{ form.start_date | myDate }}</small>
                        <small v-show="editmode" class="has-text-info text-danger" style="padding-left:100px;">End: {{ form.end_date | myDate }}</small>
                        <has-error :form="form" field="start_date"></has-error>
                        <has-error :form="form" field="end_date"></has-error>
                    </div>

                    <div class="form-group">
                      <select class="form-control" v-model="form.progtype" :class="{ 'is-invalid': form.errors.has('progtype') }" name="progtype">
                        <option value="">Select Program type</option>
                        <option value="center">Meditation Center</option>
                        <option value="public">Public Program</option>
                        <option value="musical">Musical Program</option>
                      </select>
                      <has-error :form="form" field="progtype"></has-error>
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
              slots : {},
              users : {},
              form: new Form({
                id:'',
                title :'',
                place :'',
                start_date:'',
                end_date:'',
                progtype :'',
                userid :'',
              })
          }
        },
        methods:{
            loadUsers(){
                if(this.$gate.isAdminOrEditor()){
                  axios.get("api/user").then(({data})=>(this.users = data.data))
                }
            },
            getResults(page = 1) {
        			axios.get('api/slot?page=' + page)
        				.then(response => {
        					this.slots = response.data;
        				});
        		},
            newModal(){
              this.loadUsers();
              this.editmode=false;
              this.form.reset();
              this.form.clear();
              $('#addNew').modal('show');
            },
            editModal(slot){
              this.editmode=true;
              this.form.reset();
              this.form.clear();
              $('#addNew').modal('show');
              this.form.fill(slot);
            },
            loadSlots(){
                if(this.$gate.isAdminOrEditor()){
                  axios.get("api/slot").then(({data})=>(this.slots = data))
                }
            },
            deleteSlot(id){
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
                      this.form.delete('api/slot/'+id).then(()=>{
                          Swal(
                            'Deleted!',
                            'Slot has been deleted.',
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
            createSlot(){
                this.$Progress.start();
                this.form.post('api/slot')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    this.$Progress.finish();
                    $('#addNew').modal('hide')
                    toast({
                      type: 'success',
                      title: 'Slot created successfully'
                    })
                })
                .catch(()=>{
                  this.$Progress.finish()
                  Swal(
                    'Error!',
                    'Something went wrong!',
                    'error'
                  )
                })

            },
            updateSlot(){
              this.$Progress.start();
              this.form.put('api/slot/'+this.form.id)
              .then(()=>{
                $('#addNew').modal('hide')
                Swal(
                  'Updated!',
                  'Slot has been updated.',
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
              axios.get('api/findSlot?q=' + query)
              .then((data)=>{
                  this.slots = data.data
                  console.log(data);
              })
              .catch(()=>{

              })
            })
            this.loadSlots();
            Fire.$on('AfterCreate',()=>{
              this.loadSlots();
            });
            //setInterval(()=>this.loadSlots(), 3000);
        }
    }

  $(function () {
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker         : true,
      timePickerIncrement: 30,
      format             : 'MM/DD/YYYY hh:mm A'
    })
  })

</script>
