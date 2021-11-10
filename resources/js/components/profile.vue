<style scoped>
  .widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250;
  }
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-widget widget-user shadow-lg">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white" style="background: url('./img/coverimage.jpg') center center;">
                <h3 class="widget-user-username text-right">Elizabeth Pierce</h3>
                <h5 class="widget-user-desc text-right">Web Designer</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane" id="activity">
                   
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                     
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="settings">
                    <form  @keydown="form.onKeydown($event)">
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
                    <div class="form-group">
                        <input  type="file" name="file" @click="updateprofile">
                    </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>

    
</template>

<script>
    export default {
         data(){
            return{
                form: new Form({
                id:'',
                name: '',
                email:'',
                password: ''
                })
            }
           },

           methods: {
               updateprofile(e)
               {
                            var file = document
                            .querySelector('input[type=file]')
                            .files[0];
                          var reader = new FileReader();
                          reader.onload = function(e) {
                            vm.imageSrc = e.target.result             
                          };
                          reader.onerror = function(error) {
                            alert(error);
                          };
                          reader.readAsDataURL(file);
               }
           },
        mounted() {
            console.log('Component mounted.')
        },
        created()
        {
              axios.get("api/profile").then(({data})=>(this.form.fill(data)));
        }
    }
</script>
