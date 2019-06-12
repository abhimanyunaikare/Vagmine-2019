<style media="screen">
  .profileimg{
    float: left;
    font-size: xx-large;
  }
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
              <div class="card card-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header text-white" style="background: url('./img/photo1.png') center center; background-size: cover; height: 300px;">
                    <h3 class="widget-user-username">Elizabeth Pierce</h3>
                    <h5 class="widget-user-desc">Web Designer</h5>
                  </div>
                  <div class="widget-user-image">
                    <!-- <i class="fas fa-user-circle profileimg"></i> -->
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
                <!-- Banner end here -->
                <!-- Profile starts here -->
                <div class="card">
                    <div class="card-header p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active show" id="activity">
                          <!-- Post -->
                          <div class="post">
                            <div class="user-block">
                              <i class="fas fa-user-circle profileimg"></i>
                              <span class="username">
                                <a href="#">Jonathan Burke Jr.</a>
                                <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                              </span>
                              <span class="description">Shared publicly - 7:30 PM today</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                              Lorem ipsum represents a long-held tradition for designers,
                              typographers and the like. Some people hate it and argue for
                              its demise, but others ignore the hate as they create awesome
                              tools to help create filler text for everyone from bacon lovers
                              to Charlie Sheen fans.
                            </p>

                            <p>
                              <a href="#" class="link-black text-sm mr-2"><i class="fa fa-share mr-1"></i> Share</a>
                              <a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up mr-1"></i> Like</a>
                              <span class="float-right">
                                <a href="#" class="link-black text-sm">
                                  <i class="fa fa-comments-o mr-1"></i> Comments (5)
                                </a>
                              </span>
                            </p>

                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                          </div>
                          <!-- /.post -->

                          <!-- Post -->
                          <div class="post clearfix">
                            <div class="user-block">
                              <i class="fas fa-user-circle profileimg"></i>
                              <span class="username">
                                <a href="#">Sarah Ross</a>
                                <a href="#" class="float-right btn-tool"><i class="fa fa-times"></i></a>
                              </span>
                              <span class="description">Sent you a message - 3 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                              Lorem ipsum represents a long-held tradition for designers,
                              typographers and the like. Some people hate it and argue for
                              its demise, but others ignore the hate as they create awesome
                              tools to help create filler text for everyone from bacon lovers
                              to Charlie Sheen fans.
                            </p>

                            <form class="form-horizontal">
                              <div class="input-group input-group-sm mb-0">
                                <input class="form-control form-control-sm" placeholder="Response">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-danger">Send</button>
                                </div>
                              </div>
                            </form>
                          </div>
                          <!-- /.post -->

                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                          <!-- The timeline -->
                          <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                              <span class="bg-danger">
                                10 Feb. 2014
                              </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                              <i class="fa fa-envelope bg-primary"></i>

                              <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                  quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                  <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                  <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                              </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                              <i class="fa fa-user bg-info"></i>

                              <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                                </h3>
                              </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline item -->
                            <li>
                              <i class="fa fa-comments bg-warning"></i>

                              <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                <div class="timeline-body">
                                  Take me to your leader!
                                  Switzerland is small and neutral!
                                  We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                  <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                </div>
                              </div>
                            </li>
                            <!-- END timeline item -->

                            <li>
                              <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                          </ul>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                          <form class="form-horizontal">
                            <div class="form-group">
                              <label for="inputName" class="col-sm-2 control-label">Name</label>

                              <div class="col-sm-10">
                                <input type="email" v-model="form.name" class="form-control" name="name" id="inputName" placeholder="Name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                              <div class="col-sm-10">
                                <input type="email" v-model="form.email" class="form-control" name="email" id="inputEmail" placeholder="Email">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                              <div class="col-sm-10">
                                <textarea class="form-control" v-model="form.experience" id="inputExperience" name="experience" placeholder="Experience"></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                              <div class="col-sm-10">
                                <input type="text" class="form-control" v-model="form.skills" id="inputSkills" name="skills" placeholder="Skills">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="password" class="col-sm-2 control-label">Password</label>

                              <div class="col-sm-10">
                                <input type="password" class="form-control" v-model="form.password" id="password" name="password" placeholder="Password">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-2 col-sm-10">
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
                  <!-- Profile ends here -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
              form: new Form({
                id:'',
                name :'',
                email :'',
                password:'',
                usertype :''
              })
            }
        },
        mounted() {
            console.log('Mounted')
        },
        created(){
            axios.get("api/profile").then(({data})=>(this.form.fill(data)));
        }
    }
</script>
