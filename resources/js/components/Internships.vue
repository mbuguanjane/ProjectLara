<template>
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>5</h3>

                <p>Applications</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>10<sup style="font-size: 20px">%</sup></h3>

                <p>Internships</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>5</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-md-3">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>3</h3>

                <p>Attachments</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row mt-5">
          <div class="col-12">
             <div v-if="!$gate.isAdmin()">
                 <NotFound></NotFound>
              </div>
            <div class="card" v-if="$gate.isAdmin()">

              
              <div class="card-header">
                <h3 class="card-title">Internship Data Table</h3>

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
                      <th>Title</th>
                      <th>Location</th>
                      <th>Description</th>
                      <th>Duration</th>
                      <th>Company</th>
                      <th>Vacancy</th>
                      <th>Required course</th>
                      <th>Salary</th>
                      <th>Company Name</th>
                      <th>Company Email</th>
                      <th>Company Web</th>
                      <th>Company History</th>
                      <th>Company Logo</th>
                      <th>Modify</th>
                       <th>Updated On</th>
                        <th>Created On</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="internship in internships.data" :key="internship.id" >
                      <td>{{internship.id}}</td>
                      <td>{{internship.Title}}</td>
                      <td>{{internship.location}}</td>
                      <td>{{internship.Description}}</td>
                      <td>{{internship.Duration}}</td>
                      <td>{{internship.Company}}</td>
                      <td>{{internship.Vacancy}}</td>
                      <td>{{internship.requiredcourse}}</td>
                      <td>{{internship.salary}}</td>
                      <td>{{internship.companyname}}</td>
                      <td>{{internship.companyemail}}</td>
                      <td>{{internship.companyweb}}</td>
                      <td>{{internship.companyhistory}}</td>
                      <td>{{internship.companylogo}}</td>
                      <td><span class="tag tag-success">{{internship.updated_at|myDate}}</span></td>
                      <td>{{internship.created_at | myDate}}</td>


                      <td>
                          <a href="#" @click="editModal(internship)">
                              <i class="fas fa-edit text-blue"></i>
                          </a>
                          ||
                          <a href="#" @click="deleteUser(internship.id)">
                              <i class="fas fa-trash text-red"></i>
                          </a>
                      </td>
                    </tr>
                    
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <pagination :data="internships" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="Addnew" tabindex="-1" role="dialog" aria-labelledby="AddnewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-show="!editmode" id="AddnewLabel">Add New Internship</h5>
        <h5 class="modal-title" v-show="editmode" id="AddnewLabel">Update Internship</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form @submit.prevent="editmode ? updateUser():createUser()" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
      <div class="modal-body">
             <div class="row">
                 <div class="col-md-4">
                   <div class="form-group">
                    <input v-model="form.Title" class="form-control" type="text" name="Title" placeholder="Internship Title">
                    <div style="color:red" v-if="form.errors.has('Title')" v-html="form.errors.get('Title')" />
                 </div>
                 </div>
                  <div class="col-md-4">
                          <div class="form-group">
                            <input v-model="form.location" class="form-control" type="text" name="location" placeholder="Location">
                            <div style="color:red" v-if="form.errors.has('location')" v-html="form.errors.get('location')" />
                        </div>
                  </div>
                 <div class="col-md-4">
                      <div class="form-group">
                        <textarea v-model="form.Description" class="form-control" type="text" name="Description" placeholder="Description"></textarea>
                        <div  style="color:red" v-if="form.errors.has('Description')" v-html="form.errors.get('Description')" />
                       </div>
                 </div>

                 <div class="col-md-4">
                   <div class="form-group">
                    <input v-model="form.Duration" class="form-control" type="Duration" name="Duration" placeholder="Duration">
                    <div style="color:red" v-if="form.errors.has('Duration')" v-html="form.errors.get('Duration')" />
                 </div>
                 </div>
                  <div class="col-md-4">
                          <div class="form-group">
                            <input v-model="form.Requirements" class="form-control" type="text" name="Requirements" placeholder="Requirements">
                            <div style="color:red" v-if="form.errors.has('Requirements')" v-html="form.errors.get('Requirements')" />
                        </div>
                  </div>
                 


                 <div class="col-md-4">
                   <div class="form-group">
                    <input v-model="form.Vacancy" class="form-control" type="number" name="Vacancy" placeholder="Vacancy">
                    <div style="color:red" v-if="form.errors.has('Vacancy')" v-html="form.errors.get('Vacancy')" />
                 </div>
                 </div>
                  <div class="col-md-4">
                          <div class="form-group">
                            <textarea v-model="form.requiredcourse" class="form-control" type="text" name="requiredcourse" placeholder="requiredcourse"></textarea>
                            <div style="color:red" v-if="form.errors.has('requiredcourse')" v-html="form.errors.get('requiredcourse')" />
                        </div>
                  </div>
                 <div class="col-md-4">
                      <div class="form-group">
                        <input v-model="form.deadline" class="form-control" type="date" name="deadline" placeholder="Deadline">
                        <div  style="color:red" v-if="form.errors.has('deadline')" v-html="form.errors.get('deadline')" />
                       </div>
                 </div>

                 <div class="col-md-4">
                   <div class="form-group">
                    <input v-model="form.salary" class="form-control" type="text" name="salary" placeholder="Salary">
                    <div style="color:red" v-if="form.errors.has('salary')" v-html="form.errors.get('salary')" />
                 </div>
                 </div>
                  <div class="col-md-4">
                          <div class="form-group">
                            <input v-model="form.companyname" class="form-control" type="text" name="companyname" placeholder="Company Name">
                            <div style="color:red" v-if="form.errors.has('companyname')" v-html="form.errors.get('companyname')" />
                        </div>
                  </div>
                 <div class="col-md-4">
                      <div class="form-group">
                        <input v-model="form.companyemail" class="form-control" type="text" name="companyemail" placeholder="Company Email">
                        <div  style="color:red" v-if="form.errors.has('companyemail')" v-html="form.errors.get('companyemail')" />
                       </div>
                 </div>
                  
                  <div class="col-md-4">
                   <div class="form-group">
                    <input v-model="form.companyweb" class="form-control" type="text" name="companyweb" placeholder="Company Web">
                    <div style="color:red" v-if="form.errors.has('companyweb')" v-html="form.errors.get('companyweb')" />
                 </div>
                 </div>
                  <div class="col-md-4">
                          <div class="form-group">
                            <textarea v-model="form.companyhistory" class="form-control" type="text" name="companyhistory" placeholder="Company History"></textarea>
                            <div style="color:red" v-if="form.errors.has('companyhistory')" v-html="form.errors.get('companyhistory')" />
                        </div>
                  </div>
                  <div class="col-md-4">
                       <div class="form-group">
                        <input type="file" @change="encodeImageFileAsURL" name="companylogo"/>
                        <div  style="color:red" v-if="form.errors.has('companylogo')" v-html="form.errors.get('companylogo')" /> 
                       </div>
                  </div> 
                   
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
               internships:{},
                form: new Form({
                id:'',
                Title: '',
                location:'',
                Description: '',
                Duration:'',
                Requirements: '',
                Vacancy: '',
                requiredcourse:'',
                deadline: '',
                salary:'',
                companyname: '',
                companyemail:'',
                companyweb: '',
                companyhistory:'',
                companylogo: ''
                })
            }),
            methods: {
                   encodeImageFileAsURL(element) {
                    let file = element.target.files[0];
                    let reader = new FileReader();
                    console.log(file)
                    if(file['size']<2111775)
                    {
                                reader.onloadend = (file) =>{
                                    console.log('RESULT', reader.result)
                                    this.form.companylogo=reader.result
                                }
                                reader.readAsDataURL(file);
                    }else{
                            Swal.fire(
                                        'Oops...!!',
                                        'Your file is too large to upload.',
                                        'error'
                                        )
                                       
                    }
                    
                    },

                  getResults(page = 1) {
                            this.$Progress.start();
                          axios.get('internships?page=' + page)
                            .then(response => {
                              this.$Progress.finish();
                              this.internships = response.data;
                            }).catch(()=>{
                              this.$Progress.fail();
                            })
                  },
                updateUser()
                {
                   //console.log("Updated form");
                    this.$Progress.start();
                    this.form.put('/internships/'+this.form.id).then(()=>{
                            Fire.$emit('refreshTable');
                            this.$Progress.finish();
                            $('#Addnew').modal('hide')
                            toast.fire({
                                icon: 'success',
                                title: 'Internship updated successfully'
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
                     axios.get("internships").then(({data})=>(
                         this.internships=data,
                         console.log(data)
                     )).catch((error)=>{
                        this.$Progress.fail();
                        console.log(error)
                     });
                         this.$Progress.finish();
                         console.log("nimeiitwa");
                  }else{
                    console.log("Am so sorry for this");
                  }
                },
                async createUser () {
                     this.$Progress.start();
                    this.form.post('internships').then((data)=>{
                           console.log("yesman "+data),
                            Fire.$emit('refreshTable');
                            this.$Progress.finish();
                            $('#Addnew').modal('hide')
                            toast.fire({
                                icon: 'success',
                                title: 'Internship created successfully'
                                })
                    }).catch((error)=>{
                        console.log("An error: "+error)
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
                            
                            this.form.delete('/internships/'+id).then(()=>{
                               
                                     Swal.fire(
                                        'Deleted!',
                                        'Your internship has been deleted.',
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
                   axios.get('findinternship?q='+query).then(({data})=>(
                     
                     this.internships=data,
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
