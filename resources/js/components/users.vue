<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
             <div v-if="!$gate.isAdmin()">
                 <NotFound></NotFound>
              </div>
            <div class="card" v-if="$gate.isAdmin()">

              
              <div class="card-header">
                <h3 class="card-title">User Data Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal" >Add New <i class="fas fa-user-plus fa-fw nav-icon"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Updated At</th>
                      <th>Created At</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id" >
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td><span class="tag tag-success">{{user.updated_at|myDate}}</span></td>
                      <td>{{user.created_at | myDate}}</td>
                      <td>
                          <a href="#" @click="editModal(user)">
                              <i class="fas fa-edit text-blue"></i>
                          </a>
                          ||
                          <a href="#" @click="deleteUser(user.id)">
                              <i class="fas fa-trash text-red"></i>
                          </a>
                      </td>
                    </tr>
                    
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="Addnew" tabindex="-1" role="dialog" aria-labelledby="AddnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-show="!editmode" id="AddnewLabel">Add New</h5>
        <h5 class="modal-title" v-show="editmode" id="AddnewLabel">Update User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form @submit.prevent="editmode ? updateUser():createUser()" @keydown="form.onKeydown($event)">
      <div class="modal-body">
            
                 <div class="form-group">
                    <input v-model="form.name" class="form-control" type="text" name="name" placeholder="name">
                    <div style="color:red" v-if="form.errors.has('name')" v-html="form.errors.get('name')" />
                 </div>
                  <div class="form-group">
                    <input v-model="form.email" class="form-control" type="email" name="email" placeholder="Email Address">
                    <div style="color:red" v-if="form.errors.has('email')" v-html="form.errors.get('email')" />
                 </div>
                   <div class="form-group">
                    <input v-model="form.password" class="form-control" type="password" name="password" placeholder="Password">
                    <div  style="color:red" v-if="form.errors.has('password')" v-html="form.errors.get('password')" />
                   </div>
                   
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button   type="submit" v-show="!editmode" :disabled="form.busy" class="btn btn-primary">Create</button>
        <button   type="submit" v-show="editmode" :disabled="form.busy" class="btn btn-success">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
    </div>
</template>

<script>
    export default {
         data: () => ({
                editmode:false,
               users:{},
                form: new Form({
                id:'',
                name: '',
                email:'',
                password: ''
                })
            }),
            methods: {
                
                  getResults(page = 1) {
                            this.$Progress.start();
                          axios.get('api/user?page=' + page)
                            .then(response => {
                              this.$Progress.finish();
                              this.users = response.data;
                            }).catch(()=>{
                              this.$Progress.fail();
                            })
                  },
                updateUser()
                {
                   //console.log("Updated form");
                    this.$Progress.start();
                    this.form.put('api/user/'+this.form.id).then(()=>{
                            Fire.$emit('refreshTable');
                            this.$Progress.finish();
                            $('#Addnew').modal('hide')
                            toast.fire({
                                icon: 'success',
                                title: 'User updated successfully'
                                })
                    }).catch(()=>{
                             this.$Progress.fail();
                    });
                },
                newModal()
                {
                     this.editmode=false;
                      this.form.reset();
                      $('#Addnew').modal('show');
                },
                 editModal(user)
                {
                     this.editmode=true;
                      this.form.reset();
                      $('#Addnew').modal('show');
                      this.form.fill(user);
                },
                loadUser(){
                  if(this.$gate.isAdmin())
                  {
                     this.$Progress.start();
                     axios.get("api/user").then(({data})=>(this.users=data)).catch(()=>{
                        this.$Progress.fail();
                     });
                         this.$Progress.finish();
                         console.log("nimeiitwa");
                  }else{
                    console.log("Am so sorry for this");
                  }
                },
                async createUser () {
                     this.$Progress.start();
                    this.form.post('api/user').then(()=>{
                            Fire.$emit('refreshTable');
                            this.$Progress.finish();
                            $('#Addnew').modal('hide')
                            toast.fire({
                                icon: 'success',
                                title: 'User created successfully'
                                })
                    }).catch(()=>{
                             this.$Progress.fail();
                    });
                   
                },
                async deleteUser(id)
                {
                         Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            
                            this.form.delete('api/user/'+id).then(()=>{
                               
                                     Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                         Fire.$emit('refreshTable');
                            }).catch(()=>{

                            });
                                   
                            
                            
                        }
                        })
                }
                },
        created() {
             this.loadUser();
              Fire.$on('refreshTable',()=>{
                   this.loadUser();
              });
              Fire.$on('searching',()=>{
                  let query=this.$parent.search;
                   this.$Progress.start();
                   axios.get('api/finduser?q='+query).then(({data})=>(
                     this.users=data,
                      this.$Progress.finish()
                      )
                     ).catch(()=>{
                        this.$Progress.fail();
                     console.log("An Error occurred");
                   });
              });
            
            
        }
    }
</script>
